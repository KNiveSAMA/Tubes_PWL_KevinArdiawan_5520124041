<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MahasiswaMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->hasRole('mahasiswa')) {
            abort(403, 'Akses ditolak. Hanya Mahasiswa yang dapat mengakses halaman ini.');
        }
        return $next($request);
    }
}
