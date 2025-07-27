<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'no_hp' => 'required|string|max:20',
        'password' => 'required|string|confirmed|min:6',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => $validator->errors()->first()
        ], 422);
    }

    // Generate user_id otomatis
    $lastUser = User::orderBy('created_at', 'desc')->first();
    if ($lastUser && $lastUser->user_id) {
        $lastNumber = intval(substr($lastUser->user_id, 1));
        $newNumber = $lastNumber + 1;
    } else {
        $newNumber = 1001; // mulai dari U1001
    }

    $userId = 'U' . $newNumber;

    // Simpan user baru
    User::create([
        'user_id' => $userId,
        'name' => $request->name,
        'email' => $request->email,
        'no_hp' => $request->no_hp,
        'password' => Hash::make($request->password),
    ]);

    return response()->json([
        'status' => 'ok',
        'message' => 'Registrasi berhasil',
    ]);
}

}
