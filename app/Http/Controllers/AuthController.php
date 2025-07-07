<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admins.dashboard-admin');
        }
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        // Validasi input tidak kosong
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $credentials = $request->only('username', 'password');
        
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admins.dashboard-admin')
                         ->with('success', 'Login berhasil!');
        }
        
        // Redirect back to welcome page with errors and a flag to show the modal
        return redirect()->route('welcome')
            ->withInput($request->except('password'))
            ->withErrors([
                'login' => 'Username atau password salah',
            ])
            ->with('showLoginModal', true); // Add this session flag
    }
    
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logout berhasil');
    }
}