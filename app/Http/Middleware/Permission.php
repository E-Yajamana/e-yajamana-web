<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if(Auth::check()){
            $user = Auth::user();
            switch($role){
                case('admin'):
                    if($user ->Role->first()->nama_role == 'ADMIN'){
                        return $next($request);
                    }else{
                        return redirect()->back()->with([
                            'status' => 'fail',
                            'icon' => 'error',
                            'title' => 'Hak Akses Dibatasi !',
                            'message' => 'Mohon untuk login terlebih dahulu',
                        ]);
                    }
                case('krama'):
                    if($user->Role()->where('nama_role','Krama')->exists()){
                        return $next($request);
                    }else{
                        return redirect()->back()->with([
                            'status' => 'fail',
                            'icon' => 'error',
                            'title' => 'Hak Akses Dibatasi !',
                            'message' => 'Anda tidak dapat mengakses pada menu tersebut!',
                        ]);;
                    }
                case('pemuput'):
                    if($user->Role()->where('nama_role','Pemuput_Karya')->exists()){
                        if($user->PemuputKarya->status_konfirmasi_akun != 'disetujui'){
                            if(Auth::user()->Sanggar->where('status_konfirmasi_akun','disetujui')->count() != 0){
                                return redirect()->route('select-account')->with([
                                    'status' => 'fail',
                                    'icon' => 'error',
                                    'title' => 'Hak Akses Dibatasi !',
                                    'message' => 'Anda tidak dapat mengakses menu tersebut, akun Anda tidak mendukung menu tersebut!!',
                                ]);
                            }else{
                                return redirect()->route('krama.dashboard')->with([
                                    'status' => 'fail',
                                    'icon' => 'error',
                                    'title' => 'Hak Akses Dibatasi !',
                                    'message' => 'Anda tidak dapat mengakses menu tersebut, akun Anda tidak mendukung menu tersebut!!',
                                ]);
                            }
                        }else{
                            return $next($request);
                        }
                    }else{
                        return redirect()->back()->with([
                            'status' => 'fail',
                            'icon' => 'error',
                            'title' => 'Hak Akses Dibatasi !',
                            'message' => 'Anda tidak dapat mengakses menu tersebut!',
                        ]);;
                    }
                case('login'):
                    return $next($request);
                case('sanggar'):
                    return $next($request);
                default:
                    return redirect()->route('select-account')->with([
                        'status' => 'fail',
                        'icon' => 'error',
                        'title' => 'Gagal Login !',
                        'message' => 'Hak akses dibatasi, Anda tidak dapat mengakses menu tersebut!',
                    ]);
            }
        }else{
            return redirect()->route('auth.login')->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Gagal Login !',
                'message' => 'Mohon untuk login terlebih dahulu',
            ]);;
        }
    }
}
