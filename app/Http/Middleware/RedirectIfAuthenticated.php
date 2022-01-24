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
            $krama = Krama::where('id_user',Auth::user()->id)->first();
            $pemuputKarya = Sulinggih::where('id_user',Auth::user()->id)->where('status_konfirmasi_akun','disetujui')->first();
            $sanggar = Sanggar::where('id_user',Auth::user()->id)->where('status_konfirmasi_akun','disetujui')->first();
            $serati = Serati::where('id_user',Auth::user()->id)->where('status_konfirmasi_akun','disetujui')->first();
            $admin = User::where('id',Auth::user()->id)->first();
    
            if(Auth::check() && isset($krama)){
                if(request()->segment(1) != null){
                    return redirect(route('krama.dashboard'));
                }
            }elseif(Auth::check() && isset($pemuputKarya)){
                if(request()->segment(1) != null){
                    return redirect(route('pemuput-karya.dashboard'));
                }
            }elseif(Auth::check() && isset($admin)){
                if(request()->segment(1) != null){
                    return redirect(route('admin.dashboard'));
                }
            }else{
                abort(403);
            }
        }
        return $next($request);
    }
}
