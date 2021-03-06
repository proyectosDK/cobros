<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class Admin
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
        if(Auth::user()->tipo_usuario_id == 2)
            return redirect()->route('home')->withStatus(__('NO tiene autorización para esta acción.'));
        else
            return $next($request);
    }
}
