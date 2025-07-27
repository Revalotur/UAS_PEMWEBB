<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Ps;
use App\Models\Games;
use App\Models\User;
use App\Models\Sewa;

class DashboardController extends Controller
{
    public function index()
    {
        // Cek session login
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Hitung jumlah data dari tabel ps
        $users = User::where('role', 'user')->get(); // Ambil semua user biasa (bukan admin)
        $jumlah_user = User::where('role', 'user')->count();
        $ps = Ps::all();
        $jumlah_ps = Ps::count();
        $jumlah_games = Games::count();
        $total_pemasukan = Sewa::sum('total_harga');
        $sewa = Sewa::all();

        // Kirim ke view
        return view('admin.dashboard', [
            'title' => 'Dashboard',
            'jumlah_ps' => $jumlah_ps,
            'jumlah_games' => $jumlah_games,
            'jumlah_user' => $jumlah_user,
            'users' => $users,
            'total_pemasukan' => $total_pemasukan,
            'ps' => $ps,
            'sewa' => $sewa
        ]);
    }
}
