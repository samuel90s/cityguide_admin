<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Cek apakah pengguna memiliki role admin (role == 1)
        if (Auth::check() && Auth::user()->role == 1) {
            return $next($request);
        }

        // Redirect jika pengguna tidak memiliki akses
        abort(403, 'Unauthorized action.');
    }
}
