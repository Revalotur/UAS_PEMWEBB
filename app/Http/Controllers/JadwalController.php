<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sewa;
use App\Models\Ps;
use Carbon\Carbon;
use App\Models\User;

class JadwalController extends Controller
{
    public function showJadwal(Request $request)
    {
        $tanggal = $request->input('tanggal') ?? now()->toDateString();

        $psList = Ps::all();
        $jadwal = [];

        $userId = session('user_id');
        $user = User::find($userId);

        foreach ($psList as $ps) {
            $jadwal[$ps->ps_id] = [
                'name' => $ps->name,
                'type' => $ps->type,
                'slots' => array_fill(7, 16, null), // Jam 7 - 22
            ];

            // Ambil semua booking PS ini di tanggal tersebut
            $bookings = Sewa::with('user')
                ->where('ps_id', $ps->ps_id)
                ->whereDate('tanggal_pesan', $tanggal)
                ->get();

            foreach ($bookings as $booking) {
                $start = Carbon::parse($booking->waktu_mulai)->hour;
                $end = Carbon::parse($booking->waktu_selesai)->hour;

                for ($i = $start; $i < $end; $i++) {
                    $jadwal[$ps->ps_id]['slots'][$i] = 'Full';
                }
            }
        }

        return view('jadwal', [
            'jadwal' => $jadwal,
            'tanggal' => $tanggal,
            'psList' => $psList,
            'user' => $user
        ]);
    }
}
