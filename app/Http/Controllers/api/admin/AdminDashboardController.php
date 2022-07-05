<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Models\PemuputKarya;
use App\Models\Sanggar;
use App\Models\Serati;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // MAIN LOGIC
        $totalSulinggih = PemuputKarya::count();
        $totalSerati = Serati::count();
        $totalSanggar = Sanggar::count();
        $totalKrama = User::count();
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
