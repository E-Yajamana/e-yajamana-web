<?php

namespace App\Http\Middleware;

use App\Models\Krama;
use App\Models\Sanggar;
use App\Models\Serati;
use App\Models\Sulinggih;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Monolog\Handler\IFTTTHandler;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if(Auth::check()){
            return redirect()->back();
        }
        return $next($request);
    }
}
