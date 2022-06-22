<?php

namespace App\Http\Controllers\web\sanggar\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SanggarDashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.sanggar.dashboard');
    }


    public function testing(Request $request)
    {
        dd(session()->get('id_sanggar'));
    }

}


