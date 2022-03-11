<?php

namespace App\Http\Controllers\web\krama\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Upacara;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KramaDashboardController extends Controller
{
    // VIEW DASHBOARD
    public function index(Request $request)
    {

        return view('pages.krama.dashboard');
    }
    // VIEW DASHBOARD


}
