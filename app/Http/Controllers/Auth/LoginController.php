<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session; // Needed for flash messages with back()
// Removed: use App\Models\User; // Not explicitly needed if only using Auth::attempt
// Removed: use Illuminate\Support\Facades\Hash; // Not explicitly needed if only using Auth::attempt
// Removed: use Illuminate\Support\Str; // Not needed for standard Auth
// Removed: use Illuminate\Http\Cookie; // Not needed for standard Auth

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        // Assuming your login Blade file is resources/views/login.blade.php
        return view('auth.login');
    }

    /**
     * Handle login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Regenerate the session ID for security reasons
            $request->session()->regenerate();

            // Redirect to the intended URL or the dashboard route
            // This will perform a HTTP redirect to the dashboard URL
            return redirect()->intended(route('dashboard'));
        }

        // If authentication fails, redirect back with an error message and old input
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    /**
     * Handle logout request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Log out the authenticated user

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        // Redirect to the login page with a success message
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
