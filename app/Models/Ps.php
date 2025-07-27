<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ps extends Model
{
    protected $fillable = ['ps_id','name','type', 'status', 'harga_per_jam'];

    protected $primaryKey = 'ps_id'; // sesuai dengan nama kolom di database
    public $incrementing = false;    // kalau `ps_id` bukan auto increment
    protected $keyType = 'string';  
    public $timestamps = false;
}
