<?php

namespace App\Http\Controllers\web\sanggar\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SanggarDashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.sanggar.dashboard');
    }
}
