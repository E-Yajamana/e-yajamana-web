<?php

namespace App\Http\Controllers\web\pemuput_karya\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PemuputDashboardController extends Controller
{
    // VIEW DASHBOARD PEMUPUT KARYA
    public function index(Request $requests)
    {
        return view('pages.pemuput-karya.dashboard');
    }
    // VIEW DASHBOARD PEMUPUT KARYA



}
