<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Google\Client;
use Google\Service\YouTube;

class CustomSearch extends Controller
{
     
    /**
     * @var YouTube
    */
    protected $youtube;

    /**
     * Constructor
    */
    public function __construct()
    {
        $client = new Client();
        $client->setDeveloperKey(env('YOUTUBE_API_KEY'));
        $this->youtube = new YouTube($client);
    }

    /**
     * Display search form
     *
     * @return \Illuminate\View\View
    */

    public function index()
    {
        $regions = $this->getSupportedRegions();
         
        return view('search',compact('regions'));
    }

    /**
     * Handle search request
     *
     * @param Request $request
     * @return \Illuminate\View\View
    */
    public function store(Request $request)
    {
        
        $request->validate([
            'query' => 'required',
        ]);

        $query = $request->input('query');
        
        $regions = $this->getSupportedRegions();

        $results = $this->performSearch($query);

        return view('search', [
            'results' => $results,
            'query' => $query,
            'regions' => $regions,

        ]);
 
    }

     /**
     * Perform YouTube search
     *
     * @param string $query
     * @return array
    */

    private function performSearch($query)
    {
        try {
            $searchResponse = $this->youtube->search->listSearch('snippet', [
                'q' => $query,
                'maxResults' => 10,
                'type' => 'video',
                'safeSearch' => 'strict',
            ]);
             // Debugging statement
            return $searchResponse->getItems();
        } catch (\Google\Service\Exception $e) {
            // Debugging statement
            return [];
        }
    }


    // ** Region code **/

    public function getSupportedRegions()
    {
        $response = $this->youtube->i18nRegions->listI18nRegions('snippet');
        $regions = $response->getItems();

        return $regions;
    }
        
}
