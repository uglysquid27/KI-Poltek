<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Pastikan Anda memiliki model User
use Illuminate\Support\Facades\Hash; // Untuk memeriksa password
use Illuminate\Support\Str; // Untuk menghasilkan string acak (token)
use Illuminate\Http\Cookie; // Untuk membuat cookie secara manual

class LoginController extends Controller
{
    /**
     * Menampilkan formulir login.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        // View login Anda
        return view('auth.login');
    }

    /**
     * Menangani permintaan login secara manual (tanpa Auth::attempt).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Hasilkan token yang aman dan unik
            $token = Str::random(60);

            // Simpan token di database untuk pengguna
            $user->remember_token = $token;
            $user->save();

            // Buat cookie secara manual untuk menyimpan token
            // Nama: 'auth_token'
            // Nilai: $token
            // Kedaluwarsa: 1 minggu (60 menit * 24 jam * 7 hari)
            // Path: '/'
            // Domain: null (default ke domain saat ini)
            // Secure: false (gunakan true untuk HTTPS di produksi)
            // HttpOnly: true (mencegah akses JavaScript)
            $cookie = cookie('auth_token', $token, 60 * 24 * 7, '/', null, false, true);

            // Redirect ke dashboard dan sertakan cookie
            return redirect()->route('dashboard.dashboard')->with('success', 'Login berhasil!')->withCookie($cookie);

        }

        // Jika autentikasi gagal, redirect kembali dengan error
        return back()->with('error', 'Kredensial ini tidak cocok dengan catatan kami.')->withInput($request->only('email'));
    }

    /**
     * Menangani permintaan logout secara manual.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // Ambil token dari cookie
        $token = $request->cookie('auth_token');

        if ($token) {
            // Temukan pengguna berdasarkan token dan hapus tokennya
            $user = User::where('remember_token', $token)->first();
            if ($user) {
                $user->remember_token = null;
                $user->save();
            }
        }

        // Buat cookie kedaluwarsa untuk menghapusnya dari browser
        $expiredCookie = cookie('auth_token', null, -1, '/', null, false, true);

        // Redirect ke halaman login dan hapus cookie
        return redirect()->route('login')->with('success', 'Berhasil logout!')->withCookie($expiredCookie);
    }
}
