<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // MAIN LOGIC
        $totalSulinggih = User::where('role', 'sulinggih')->orWhere('role', 'pemangku')->count();
        $totalSerati = User::where('role', 'serati')->count();
        $totalSanggar = User::where('role', 'sanggar')->count();
        $totalKrama = User::where('role', 'krama_bali')->count();
        // END

        // RETURN
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data dashboard',
            'data' => [
                'totalSulinggih' => $totalSulinggih,
                'totalSerati' => $totalSerati,
                'totalSanggar' => $totalSanggar,
                'totalKrama' => $totalKrama,
            ],
        ], 200);
        // END
    }
}
