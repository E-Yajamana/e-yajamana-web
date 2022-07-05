<?php

namespace App\Http\Middleware;

use App\Models\Krama;
use App\Models\PemuputKarya;
use App\Models\Sanggar;
use App\Models\Serati;
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
            $user = Auth::user();
            if($user->Role->count() == 1 && $user->Role->first()->nama_role == "admin" ){
                return redirect()->route('admin.dashboard');
            }elseif($user->Role->count() == 1 && $user->Role->first()->nama_role == "krama"){
                return redirect()->route('krama.dashboard');
            }elseif($user->Role->count() > 1){
                $exitsPemuput = PemuputKarya::whereIdUser($user->id)->whereStatusKonfirmasiAkun('disetujui')->count();
                $exitsSerati = Serati::whereIdUser($user->id)->whereStatusKonfirmasiAkun('disetujui')->count();
                $exitsSanggar = Auth::user()->Sanggar->where('status_konfirmasi_akun','disetujui')->count();
                if($exitsPemuput == 0 && $exitsSerati == 0 && $exitsSanggar  == 0){
                    return redirect(route('krama.dashboard'));
                }else{
                    return redirect()->route('select-account');
                }
            }else{
                return redirect()->route('krama.dashboard');
            }
        }else{
            Auth::logout();
            return $next($request);
        }
    }
}
