<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class EnsureAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is NOT logged in
        if (! Auth::check()) {
            // If not logged in, redirect them to the login page
            // You can also add a flash message here, e.g., session()->flash('error', 'Please log in to access this page.');
            return redirect()->route('login');
        }

        // If logged in, proceed with the request
        return $next($request);
    }
}
