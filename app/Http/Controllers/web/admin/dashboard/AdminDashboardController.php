<?php

namespace App\Http\Controllers\web\admin\dashboard;

use App\Http\Controllers\Controller;
use App\Models\GriyaRumah;
use App\Models\Reservasi;
use App\Models\Upacara;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $upacara = Upacara::all();

        $countData = [
            'countUser' => User::all()->count(),
            'countUpacara' =>  $upacara->count(),
            'countGriya' => GriyaRumah::all()->count(),
            'countReservasiUser' => Reservasi::all()->count(),
        ];


        $countJenisYadnya = [
            $upacara->where('kategori_upacara','Manusa Yadnya')->count(),
            $upacara->where('kategori_upacara','Pitra Yadnya')->count(),
            $upacara->where('kategori_upacara','Manusa Yadnya')->count(),
            $upacara->where('kategori_upacara','Rsi Yadnya')->count(),
            $upacara->where('kategori_upacara','Bhuta Yadnya')->count(),
        ];

        return view('pages.admin.dashboard', compact('countData','countJenisYadnya'));
    }
}
