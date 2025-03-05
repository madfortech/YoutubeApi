<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        //return view('auth.login');
        abort(404);
    }

    /**
     * Redirect the user to the Youtube authentication page.
     *
     * @return \Illuminate\Http\Response
    */

    public function redirectToProvider()
    {
       
        return Socialite::driver('youtube')->redirect();
    }

    /**
     * Obtain the user information from Youtube.
     *
     * @return \Illuminate\Http\Response
    */
    public function handleProviderCallback()
    {
        
        try {
            $youtubeUser = Socialite::driver('youtube')->user();

            $user = User::where('email', $youtubeUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $youtubeUser->getName(),
                    'email' => $youtubeUser->getEmail(),
                    'youtube_id' => $youtubeUser->getId(),
                ]);
            }

            Auth::login($user);

            return redirect()->intended(route('dashboard'));
        } catch (\Throwable $th) {
            return redirect()->route('login')->with('error', 'An error occurred while trying to login with YouTube.');
        }  
  
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
