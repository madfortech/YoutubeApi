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
        
        return view('search', [
            'videos' => []
        ]);
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
        $results = $this->performSearch($query);

        return view('search', [
            'videos' => $results,
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
                'safeSearch' => 'none',
            ]);
             // Debugging statement
            return $searchResponse->getItems();
        } catch (\Google\Service\Exception $e) {
            // Debugging statement
            return [];
        }
    }

 
        
}
