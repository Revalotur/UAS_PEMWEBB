<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    // Tampilkan halaman profil
    public function edit()
    {
        $user = User::where('user_id', session('user_id'))->first();
        return view('profile', compact('user'));
    }

    // Update nama & foto sekaligus
    public function updateNama(Request $request)
    {
        $user = User::where('user_id', session('user_id'))->first();

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user->name = $request->name;
        $user->save();

        return redirect()->route('profile')->with('success', 'Nama berhasil diperbarui.');
    }

    // Update foto saja
    public function updateFoto(Request $request)
    {
        // 1. Validasi input, pastikan ada file yang dikirim
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Ambil user berdasarkan session
        $user = User::where('user_id', session('user_id'))->first();

        // 3. (PENTING) Cek jika user tidak ditemukan
        if (!$user) {
            // Jika user tidak ada, kembalikan dengan pesan error
            return redirect()->back()->with('error', 'Sesi tidak valid atau pengguna tidak ditemukan.');
        }

        // 4. Hapus foto lama jika ada
        if ($user->foto && Storage::disk('public')->exists('foto/' . $user->foto)) {
            Storage::disk('public')->delete('foto/' . $user->foto);
        }

        // 5. Simpan foto baru dan update database
        $path = $request->file('foto')->store('foto', 'public');
        $user->foto = basename($path);
        $user->save();

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
    }
    public function hapusFoto()
    {
        // 1. Ambil user berdasarkan session
        $user = User::where('user_id', session('user_id'))->first();

        // 2. (PENTING) Cek jika user tidak ditemukan
        if (!$user) {
            return redirect()->back()->with('error', 'Sesi tidak valid atau pengguna tidak ditemukan.');
        }

        // 3. Hapus file foto dari storage jika ada
        if ($user->foto && Storage::disk('public')->exists('foto/' . $user->foto)) {
            Storage::disk('public')->delete('foto/' . $user->foto);
        }

        // 4. Set kolom 'foto' di database menjadi null dan simpan
        $user->foto = null;
        $user->save();

        return redirect()->route('profile')->with('success', 'Foto profil berhasil dihapus.');
    }
}
