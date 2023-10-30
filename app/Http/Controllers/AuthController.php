<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('nim', $request->input('nim'))->first();
        if ($user) {
            // User ditemukan, alihkan ke dashboard atau lakukan sesuatu yang diperlukan.
            return redirect()->route('square_root.index');
        } else {
            // User belum terdaftar, tampilkan pesan kesalahan.
            return back()->with('error', 'Akun belum terdaftar.');
        }
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'name' => 'required',
            'nim' => 'required|unique:users,nim',
        ]);

        // Buat user baru
        User::create([
            'name' => $request->input('name'),
            'nim' => $request->input('nim'),
        ]);

        // Redirect ke halaman login
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function logout()
    {
        auth()->logout();
        session()->forget('inputNumber');
        return redirect()->route('login');
    }
}
