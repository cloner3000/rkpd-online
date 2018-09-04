<?php

namespace App\Http\Middleware;

use Closure;

class AdministratorMiddleware
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
        if (auth()->user()->hasRole('Administrator')) {
            return $next($request);
        }
        return error_pages(401, 'Anda tidak berhak mengakses halaman ini!');
    }
}
