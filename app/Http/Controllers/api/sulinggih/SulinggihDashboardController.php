<?php

namespace App\Http\Controllers\api\sulinggih;

use App\Http\Controllers\Controller;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDOException;

class SulinggihDashboardController extends Controller
{
    public function index()
    {
        // MAIN LOGIC
        try {
            $user = Auth::user();
            $pemuputKarya = $user->PemuputKarya()->with('GriyaRumah')->whereHas('GriyaRumah')->firstOrFail();

            $reservasiQuery = function ($reservasiQuery) {
                $reservasiQuery->with(['Upacara'])->whereHas('Upacara');
            };

            $reservasis = $user
                ->Reservasi()
                ->with(['Upacaraku' => $reservasiQuery])
                ->whereHas('Upacaraku', $reservasiQuery)->get();
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            return $err;
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error',
                'data' => (object)[],
            ], 500);
        }
        // END

        // RETURN
        return response()->json([
            'status' => 200,
            'message' => 'Server message',
            'data' => [
                'user' => $user,
                'pemuput_karya' => $pemuputKarya,
                'reservasis' => $reservasis,
            ],
        ], 200);
        // END
    }
}
