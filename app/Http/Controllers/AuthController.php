<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('pages.auth.login2');
    }

    public function registerLanding(Request $request)
    {
        return view('pages.auth.register.landing');
    }

    public function registerKrama(Request $request)
    {
        return view('pages.auth.register.krama-bali');
    }


    public function lupaPasswordLanding(Request $request)
    {
        return view('pages.auth.lupa-password.landing');
    }

    public function verifyOTP(Request $request)
    {
        return view('pages.auth.lupa-password.verify-otp');
    }

    public function resetPassword(Request $request)
    {
        return view('pages.auth.lupa-password.reset-password');
    }

}
