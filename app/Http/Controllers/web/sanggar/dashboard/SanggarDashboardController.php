<?php

namespace App\Http\Controllers\web\sanggar\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SanggarDashboardController extends Controller
{
    public function index(Request $request)
    {
        // dd(session('id_sanggar'));
        return view('pages.sanggar.dashboard');
    }


    public function testing(Request $request)
    {
        dd(session()->get('id_sanggar'));
    }

}


