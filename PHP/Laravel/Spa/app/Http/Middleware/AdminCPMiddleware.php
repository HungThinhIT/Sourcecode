<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class AdminCPMiddleware
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
        if(Auth::check()){
            // return redirect()->route('spa_showDashBoard');
            return $next($request);
        }
        else{
            return redirect()->route('admincp_showLogin')->withErrors(["Vui lòng đăng nhập để sử dụng hệ thống"]);
        }
    }
}
