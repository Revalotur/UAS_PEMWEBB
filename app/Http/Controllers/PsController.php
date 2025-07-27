<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Ps;

class PsController extends Controller
{
    public function edit($ps_id)
    {
        $ps = Ps::where('ps_id', $ps_id)->firstOrFail();
            return view('admin.edit_ps', compact('ps'));
    }

    public function update(Request $request, $ps_id)
{
    $request->validate([
        'name' => 'required',
        'status' => 'required',
        'harga_per_jam' => 'required'
    ]);

    $ps = Ps::where('ps_id', $ps_id)->firstOrFail();

    $ps->name = $request->name;
    $ps->status = $request->status;
    $ps->harga_per_jam = $request->harga_per_jam;
    $ps->save();

    return redirect('/dashboard')->with('success', 'Data user berhasil diperbarui.');
}


    public function destroy($ps_id)
    {
        $ps = Ps::findOrFail($ps_id);
        $ps->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
    }

    public function create()
{
    return view('admin.tambah_ps');
}

public function add_ps(Request $request)
{
    $request->validate([
        'name' => 'required',
        'type' => 'required',
        'status' => 'required',
        'harga_per_jam' => 'required'
    ]);

    // Ambil ID terakhir
    $lastPs = Ps::orderBy('ps_id', 'desc')->first();

    if ($lastPs) {
        // Ambil angka dari format P1001 → 1001
        $lastNumber = (int) substr($lastPs->ps_id, 1);
        $newNumber = $lastNumber + 1;
    } else {
        $newNumber = 1001; // Awal jika belum ada data
    }

    // Gabungkan jadi format P1002, P1003, dst
    $newPsId = 'P' . $newNumber;

    Ps::create([
        'ps_id' => $newPsId,
        'name' => $request->name,
        'type' => $request->type,
        'status' => $request->status,
        'harga_per_jam' => $request->harga_per_jam
    ]);

    return redirect('/dashboard')->with('success', 'Data PS berhasil ditambahkan.');
}

}