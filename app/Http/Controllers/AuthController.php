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
        // Validasi credentials
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        
        // Cek apakah login fields kosong
        if (empty($credentials['username']) || empty($credentials['password'])) {
            return back()->withErrors([
                'username' => empty($credentials['username']) ? 'Username tidak boleh kosong' : null,
                'password' => empty($credentials['password']) ? 'Password tidak boleh kosong' : null,
            ])->withInput($request->except('password'));
        }
        
        // Coba login dengan guard admin
        if (Auth::guard('admin')->attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password']
        ])) {
            $request->session()->regenerate();
            return redirect()->route('admins.dashboard-admin')->with('success', 'Berhasil login');
        }
        
        // Jika gagal login
        return back()->withErrors([
            'login' => 'Username atau password salah'
        ])->withInput($request->except('password'));
    }
    
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Berhasil logout');
    }
}