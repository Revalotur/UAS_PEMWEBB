<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CekAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Cek session admin_id
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login')->with('error', 'Silakan login sebagai admin.');
        }

        return $next($request);
    }
}
