<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import your User model

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        // Manually get the token from the cookie
        $token = $request->cookie('auth_token');
        $authenticatedUser = null;

        if ($token) {
            // Try to find a user with this token
            $authenticatedUser = User::where('remember_token', $token)->first();
        }

        // If no authenticated user found based on the token
        if (!$authenticatedUser) {
            // Redirect to the login page if not authenticated
            return redirect()->route('login');
        }

        // If authenticated, you can now use $authenticatedUser for user-specific data
        // For example: $userName = $authenticatedUser->name;

        // In a real application, you would fetch data here
        $dashboardData = [
            'totalApplications' => 120,
            'pendingApprovals' => 15,
            'approvedApplications' => 105,
            'recentActivities' => [
                ['description' => 'Application "New Software" submitted.', 'time' => '2 hours ago'],
                ['description' => 'Patent "Smart Device" approved.', 'time' => 'Yesterday'],
                ['description' => 'Copyright "Digital Art Collection" reviewed.', 'time' => '3 days ago'],
            ],
            'loggedInUserEmail' => $authenticatedUser->email, // Example of using authenticated user data
        ];

        // Pass data to the view, using the correct path
        return view('dashboard.dashboard', $dashboardData);
    }
}
