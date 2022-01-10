<?php

namespace App\Http\Controllers\web\admin\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.admin.dashboard');
    }
}
