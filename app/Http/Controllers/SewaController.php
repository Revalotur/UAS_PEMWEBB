<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Sewa;
use App\Models\User;
use App\Models\Ps;
use Carbon\Carbon;

class SewaController extends Controller
{
    public function showBookingForm()
    {
        $psList = Ps::all();
        $userId = session('user_id');
        $user = User::find($userId);
        return view('booking', compact('psList', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ps_id' => 'required',
            'tanggal_pesan' => 'required|date',
            'booking_time' => 'required',
            'duration' => 'required|integer|min:1',
        ]);

        $userId = session('user_id');
        $tanggal = $request->tanggal_pesan;
        $psId = $request->ps_id;

        $startTime = Carbon::createFromFormat('H:i', $request->booking_time);
        $endTime = $startTime->copy()->addHours((int) $request->duration);
        $now = Carbon::now();
        $today = $now->toDateString();


        // ⛔ Cek waktu yang sudah lewat
        if ($tanggal == $today && $startTime->lt($now)) {
            return redirect()->back()->with('error', 'Jam yang dipilih sudah lewat. Silakan pilih waktu yang tersedia.');
        }

        if (Carbon::parse($tanggal)->lt($now->copy()->startOfDay())) {
            return redirect()->back()->with('error', 'Tanggal yang dipilih sudah lewat.');
        }

        // 🔄 Generate sewa_id otomatis
        $last = Sewa::orderBy('sewa_id', 'desc')->first();
        $lastNumber = $last && $last->sewa_id ? intval(substr($last->sewa_id, 1)) : 0;
        $sewaId = 'S' . ($lastNumber + 1);

        // ❌ Validasi bentrok pemesanan
        $bentrok = Sewa::where('ps_id', $psId)
            ->whereDate('tanggal_pesan', $tanggal)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime, $endTime) {
                    $q->where('waktu_mulai', '<', $endTime)
                        ->where('waktu_selesai', '>', $startTime);
                });
            })
            ->exists();
        if ($bentrok) {
            return redirect()->back()->with('error', 'Ruangan / PS tersebut telah dipesan di waktu tersebut.');
        }

        // 💰 Hitung harga
        $ps = Ps::where('ps_id', $psId)->firstOrFail();
        $totalHarga = $ps->harga_per_jam * $request->duration;

        // 📝 Simpan ke database
        Sewa::create([
            'sewa_id'        => $sewaId,
            'user_id'        => $userId,
            'ps_id'          => $psId,
            'tanggal_pesan'  => $tanggal,
            'waktu_mulai'    => $startTime->format('H:i:s'),
            'waktu_selesai'  => $endTime->format('H:i:s'),
            'durasi'         => $request->duration,
            'total_harga'    => $totalHarga,
        ]);

        return redirect()->route('booking.form')->with('success', 'Pemesanan berhasil!');
    }

    public function showJadwal(Request $request)
    {
        $selectedDate = $request->input('date', now()->format('Y-m-d'));

        $psList = Ps::all();
        $sewaList = Sewa::whereDate('tanggal_pesan', $selectedDate)->get();

        $jadwal = [];

        foreach ($psList as $ps) {
            $slots = [];

            foreach ($sewaList as $sewa) {
                if ($sewa->ps_id == $ps->id || $sewa->ps_id == $ps->ps_id) {
                    $startHour = Carbon::parse($sewa->waktu_mulai)->hour;
                    $endHour = Carbon::parse($sewa->waktu_selesai)->hour;

                    for ($i = $startHour; $i < $endHour; $i++) {
                        $slots[$i] = 'Full';
                    }
                }
            }

            $jadwal[] = [
                'name' => $ps->name,
                'type' => $ps->type,
                'slots' => $slots
            ];
        }

        return view('jadwal.index', compact('jadwal', 'selectedDate'));
    }

    public function riwayatUser()
    {
        $userId = session('user_id');

        $user = User::where('user_id', $userId)->first();

        $riwayat = \App\Models\Sewa::with('ps')
            ->where('user_id', $userId)
            ->orderBy('tanggal_pesan', 'desc')
            ->orderBy('waktu_mulai', 'desc')
            ->get();

        return view('riwayat', compact('riwayat', 'user'));
    }
}
