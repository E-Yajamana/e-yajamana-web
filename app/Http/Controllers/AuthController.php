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

}
