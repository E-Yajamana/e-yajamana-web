<?php

namespace App\Http\Controllers\api\sanggar;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\Sanggar;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDOException;
use Illuminate\Support\Facades\Auth;

class SanggarProfileController extends Controller
{
    public function index($id_sanggar)
    {
        // SECURITY
        $validator = Validator::make(['id_sanggar' => $id_sanggar], [
            'id_sanggar' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation Error',
                'data' => $validator->errors(),
            ], 400);
        }
        // END

        // MAIN LOGIC
        try {
            $user = User::with([
                'Penduduk' => function ($pendudukQuery) {
                    $pendudukQuery->with(['Profesi', 'Pendidikan']);
                }
            ])->findOrFail(Auth::user()->id);
            $sanggar = Sanggar::findOrFail($id_sanggar);
            $penduduk = $user->Penduduk;

            $reservasiQuery = function ($reservasiQuery) {
                $reservasiQuery->with(['Upacara'])->whereHas('Upacara');
            };

            $reservasis = Reservasi::with(['Upacaraku' => $reservasiQuery, 'DetailReservasi'])
                ->whereHas('Upacaraku', $reservasiQuery)->where('id_sanggar', $id_sanggar)->get(); 

            $total_reservasi = Reservasi::where('id_sanggar', $sanggar->id)->count();
            $total_reservasi_selesai = Reservasi::where('id_sanggar', $sanggar->id)->where('status', 'selesai')->count();
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            return $err;
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
            'message' => 'Berhasil mengambil profile sanggar',
            'data' => (object)[
                'user' => $user,
                'sanggar' => $sanggar,
                'reservasis' => $reservasis,
                'total_reservasi' => $total_reservasi,
                'total_reservasi_selesai' => $total_reservasi_selesai,
            ],
        ], 200);
        // END
    }
}
