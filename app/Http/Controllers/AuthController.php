<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Class penting untuk proses otentikasi
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Fungsi ini bertugas untuk MENAMPILKAN halaman/form login.
     * Route: GET /login
     */
    public function showLogin()
    {
        // Kode ini akan mencari dan menampilkan file view yang ada di:
        // resources/views/auth/login.blade.php
        return view('auth.login');
    }

    /**
      * Fungsi ini untuk MENAMPILKAN halaman/form register.
      */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Fungsi ini bertugas untuk MEMPROSES data yang dikirim dari form login.
     * Route: POST /login
     */
    public function login(Request $request)
    {
        // 1. Validasi Input
        // Memastikan input 'email' adalah format email yang valid dan wajib diisi.
        // Memastikan input 'password' wajib diisi.
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Mencoba Proses Login
        // Auth::attempt akan otomatis:
        // - Mencari user di tabel 'users' berdasarkan email.
        // - Meng-hash password yang diinput user.
        // - Membandingkannya dengan hash password di database.
        // Argumen 'true' di sini untuk mengaktifkan fitur "Remember Me" secara default.
        if (Auth::attempt($credentials, true)) {
            // 3. Jika Login Berhasil
            $request->session()->regenerate(); // Mencegah serangan session fixation.

            // Arahkan pengguna ke halaman yang seharusnya mereka tuju sebelum login,
            // atau ke halaman '/dashboard' jika tidak ada.
            return redirect()->intended('dashboard');
        }

        // 4. Jika Login Gagal
        // Kembalikan pengguna ke halaman login.
        // ->withErrors() akan mengirimkan pesan error.
        // ->onlyInput('email') akan mengisi kembali field email dengan input sebelumnya.
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Fungsi ini bertugas untuk proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan pengguna kembali ke halaman utama.
        return redirect('/');
    }
}