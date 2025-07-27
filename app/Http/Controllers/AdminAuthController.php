<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login_admin'); // Buat view login khusus admin
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required'
        ]);

        // Cari user dengan role admin
        $admin = User::where('name', $credentials['username'])
                     ->where('role', 'admin')
                     ->first();

        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            Session::put('admin_id', $admin->user_id);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah, atau bukan akun admin.'
        ])->onlyInput('username');
    }

    public function logout()
    {
        Session::forget('admin_id');
        return redirect()->route('admin.login')->with('success', 'Berhasil logout.');
    }
}
