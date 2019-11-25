<?php

namespace App\Http\Middleware;

use Closure;

class UserIsLogin
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
        if ($request->session()->has('UserisLogin')) {
            return $next($request);
        } else {
            echo '<script>location.href="/home/login";</script>';
            return redirect('/home/login');
        }
    }
}
