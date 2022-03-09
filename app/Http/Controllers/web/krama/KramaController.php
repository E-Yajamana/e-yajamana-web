<?php

namespace App\Http\Controllers\web\krama;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KramaController extends Controller
{
    public function profile(Request $request)
    {
        return view('pages.krama.profile.krama-profile');
    }
}
