<?php

namespace App\Http\Controllers\web\krama\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Upacara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KramaDashboardController extends Controller
{
    // VIEW DASHBOARD
    public function index(Request $request)
    {

        // dd(Upacara::count());
        return view('pages.krama.dashboard');
    }
    // VIEW DASHBOARD


}
