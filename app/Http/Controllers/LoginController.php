<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Authenticate the user with the provided credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function authenticate(Request $request)
    {
        // Validate request data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        // Attempt to authenticate user
        if (Auth::attempt($credentials)) {
            // If authentication is successful, regenerate session
            $request->session()->regenerate();

            // Redirect user to intended destination
            return redirect()->intended('index');
        }

        // If authentication fails, redirect back with error message
        return back()->withErrors([
            'email' => 'Nieprawidłowy login lub hasło',
        ])->onlyInput('email');
    }

    /**
     * Log out the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Log out authenticated user
        Auth::logout();

        // Invalidate current session
        $request->session()->invalidate();

        // Regenerate CSRF token for the session
        $request->session()->regenerateToken();

        // Redirect user to the home page
        return redirect('/');
    }

}
