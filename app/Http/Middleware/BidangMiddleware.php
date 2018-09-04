<?php

namespace App\Http\Middleware;

use App\Enum\Roles;
use Closure;

class BidangMiddleware
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
        if ($request->user()->hasRole(Roles::BES) || $request->user()->hasRole(Roles::BIPW) ||
            $request->user()->hasRole(Roles::BPE) || $request->user()->hasRole(Roles::BPMM)) {
            return $next($request);
        }
        return error_pages(401, 'Anda tidak berhak mengakses halaman ini!');
    }
}
