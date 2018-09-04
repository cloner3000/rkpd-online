<?php

namespace App\Http\Middleware;

use App\Enum\Roles;
use Closure;

class KecamatanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->hasRole(Roles::KECAMATAN)) {
            return $next($request);
        }
        return error_pages(401, 'Anda tidak berhak mengakses halaman ini!');
    }
}
