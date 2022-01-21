<?php

namespace App\Http\Controllers\web\krama\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KramaDashboardController extends Controller
{
    // VIEW DASHBOARD
    public function index(Request $request)
    {
        return view('pages.krama.dashboard');
    }
    // VIEW DASHBOARD


}
