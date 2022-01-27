<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekUser
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
            // dd(Auth::user()->Sulinggih->status_konfirmasi_akun);
            switch(Auth::user()->role){
                case('admin'):
                    if(Auth::user()->role == $role){
                        return $next($request);
                    }else{
                        return redirect()->back()->with([
                            'status' => 'fail',
                            'icon' => 'error',
                            'title' => 'Hak Akses Dibatasi !',
                            'message' => 'Mohon untuk login terlebih dahulu',
                        ]);;
                    }
                case('sulinggih'):
                    if(Auth::user()->Sulinggih->status_konfirmasi_akun == 'disetujui'){
                        // dd(Auth::user()->role == $role);
                        if(Auth::user()->role == $role){
                            return $next($request);
                        }else{
                            return redirect()->back()->with([
                                'status' => 'fail',
                                'icon' => 'error',
                                'title' => 'Hak Akses Dibatasi !',
                                'message' => 'Akses halaman tidak tersedia pada akun ini',
                            ]);
                        }
                    }else{
                        Auth::logout();
                        return redirect()->route('auth.login')->with([
                            'status' => 'fail',
                            'icon' => 'error',
                            'title' => 'Gagal Login !',
                            'message' => 'Akun anda belum terverifikasi, Mohon untuk login terlebih dahulu',
                        ]);
                    }
                case('krama_bali'):
                    if(Auth::user()->role == $role){
                        return $next($request);
                    }else{
                        return redirect()->back()->with([
                            'status' => 'fail',
                            'icon' => 'error',
                            'title' => 'Hak Akses Dibatasi !',
                            'message' => 'Mohon untuk login terlebih dahulu',
                        ]);;
                    }
                default:
                    return redirect()->back()->with([
                        'status' => 'fail',
                        'icon' => 'error',
                        'title' => 'Hak Akses Dibatasi !',
                        'message' => 'Mohon untuk login terlebih dahulu',
                    ]);;
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
