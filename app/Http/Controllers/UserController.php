<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Feedback;

class UserController extends Controller
{
    public function index()
    {
        if (!Session::has('user_id')) {
            return redirect()->route('login.form')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = User::find(Session::get('user_id'));

        if (!$user) {
            return redirect()->route('login.form')->with('error', 'User tidak ditemukan.');
        }

        $feedbacks = Feedback::latest()->take(3)->get();
        return view('welcomeuser', compact('feedbacks', 'user'));
    }

    public function vip()
    {
        $user = User::where('user_id', session('user_id'))->first();

        return view('vip_room', compact('user'));
    }

    public function update(Request $request, $user_id)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'no_hp' => 'required'
    ]);

    $user = User::where('user_id', $user_id)->firstOrFail();

    $user->name = $request->name;
    $user->email = $request->email;
    $user->no_hp = $request->no_hp;
    $user->save();

    return redirect('/dashboard')->with('success', 'Data user berhasil diperbarui.');
}


    public function destroy($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
    }
}