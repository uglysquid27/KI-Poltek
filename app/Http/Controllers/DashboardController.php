<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import your User model
use App\Models\HakCipta; // Import HakCipta model
use App\Models\KekayaanIntelektual;
use App\Models\Paten; // Import Paten model
use App\Models\DesainIndustri; // Import Paten model

class DashboardController extends Controller
{
      /**
     * Display the application dashboard with real data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
{
    // Manually retrieve the token from the cookie
    $token = $request->cookie('auth_token');
    $authenticatedUser = null;

    if ($token) {
        // Try to find the user with this token in the database
        $authenticatedUser = User::where('remember_token', $token)->first();
    }

    // If no user is authenticated based on the token
    if (!$authenticatedUser) {
        // Redirect to the login page if not authenticated
        return redirect()->route('login')->with('error', 'You must log in to access the dashboard.');
    }

    // Fetch real data for Hak Cipta, Paten, and Desain Industri with latest first sorting
    $hakCiptas = HakCipta::with('kekayaanIntelektual')
        ->orderBy('created_at', 'desc')
        ->paginate(5, ['*'], 'hakCiptaPage');
    
    $patens = Paten::with('kekayaanIntelektual')
        ->orderBy('created_at', 'desc')
        ->paginate(5, ['*'], 'patenPage');
    
    $desainIndustris = DesainIndustri::with('kekayaanIntelektual')
        ->orderBy('created_at', 'desc')
        ->paginate(5, ['*'], 'desainIndustriPage');

    // Calculate counts for dashboard cards (include Desain Industri)
    $totalApplications = HakCipta::count() + Paten::count() + DesainIndustri::count();
    $pendingApprovals = KekayaanIntelektual::where('status', 'Dalam Proses')->count();
    $approvedApplications = KekayaanIntelektual::where('status', 'Didaftar')->count();

    // Dummy data for recent activities
    $recentActivities = [
        ['description' => 'Aplikasi "Software Baru" diajukan.', 'time' => '2 jam yang lalu'],
        ['description' => 'Paten "Perangkat Cerdas" disetujui.', 'time' => 'Kemarin'],
        ['description' => 'Hak Cipta "Koleksi Seni Digital" ditinjau.', 'time' => '3 hari yang lalu'],
        ['description' => 'Desain Industri "Model Produk Baru" diajukan.', 'time' => '5 hari yang lalu'], // Add sample activity
    ];

    // Pass all data to the dashboard view
    return view('dashboard.dashboard', compact(
        'totalApplications',
        'pendingApprovals',
        'approvedApplications',
        'recentActivities',
        'authenticatedUser',
        'hakCiptas',
        'patens',
        'desainIndustris' // Add this variable
    ));
}
}
