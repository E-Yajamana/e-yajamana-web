<?php

namespace App\Http\Controllers\api\sulinggih;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PDOException;

class SulinggihProfileController extends Controller
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
                ->with(['Upacaraku' => $reservasiQuery, 'DetailReservasi'])
                ->whereHas('Upacaraku', $reservasiQuery)->get();

            $total_reservasi = Reservasi::where('id_relasi', $user->id)->count();
            $total_reservasi_selesai = Reservasi::where('id_relasi', $user->id)->where('status', 'selesai')->count();
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'data' => (object)[],
            ], 500);
        }
        // END

        // RETURN
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data sulinggih',
            'data' => [
                'user' => $user,
                'pemuput_karya' => $pemuputKarya,
                'reservasis' => $reservasis,
                'total_reservasi' => $total_reservasi,
                'total_reservasi_selesai' => $total_reservasi_selesai,
            ],
        ], 200);
        // END
    }
}
