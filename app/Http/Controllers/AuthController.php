<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ==================== HALAMAN & FITUR ADMIN ====================

    // Menampilkan halaman form login admin
    public function showLogin()
    {
        return view('login'); // Pastikan ini view login khusus admin
    }

    // Proses login khusus admin
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek autentikasi dasar
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Validasi ketat: Hanya boleh masuk jika rolenya 'admin'
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/simaksi');
            }

            // Jika akun biasa tapi coba login di halaman admin, keluarkan kembali (logout)
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->with('error', 'Akses ditolak! Akun Anda bukan akun Administrator.')->withInput();
        }

        return back()->with('error', 'Email atau password salah!')->withInput();
    }

    // Proses logout (dapat digunakan oleh Admin maupun Pemohon)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }


    // ==================== HALAMAN & FITUR PEMOHON (USER) ====================

    // Menampilkan halaman form register pemohon
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses pendaftaran akun pemohon baru
    public function register(Request $request)
    {
        // 1. Validasi input dari form register
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // 2. Simpan data user baru ke database dengan role 'user'
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => 'user', // Otomatis diset sebagai user biasa
        ]);

        // 3. Langsung alihkan (redirect) user ke halaman login pemohon
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login dengan akun Anda.');
    }

    // Menampilkan halaman form login pemohon
    public function showUserLogin()
    {
        return view('auth.login'); // Pastikan ini view login khusus user/pemohon
    }

    // Proses login khusus pemohon (dengan tambahan proteksi redirect admin)
    public function userLogin(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // JIKA YANG LOGIN ADALAH ADMIN, LEMPAR KE HALAMAN ADMIN
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/simaksi');
            }

            // JIKA USER BIASA, LEMPAR KE HALAMAN PENDAFTARAN
            return redirect()->intended('/pendaftaran');
        }

        return back()->with('error', 'Email atau kata sandi yang Anda masukkan salah!')->withInput();
    }
}