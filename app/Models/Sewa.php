<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    protected $fillable = [
    'sewa_id',
    'user_id',
    'ps_id',
    'tanggal_pesan',
    'waktu_mulai',
    'waktu_selesai',
    'durasi',
    'total_harga'
];

public function ps()
{
    return $this->belongsTo(\App\Models\Ps::class, 'ps_id', 'ps_id');
}

public function user()
{
    return $this->belongsTo(User::class, 'user_id', 'user_id');
}
protected $table = 'sewa';
protected $primaryKey = 'sewa_id';
public $incrementing = false;
protected $keyType = 'string';
public $timestamps = false;
}
