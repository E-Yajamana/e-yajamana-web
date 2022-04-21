<?php

namespace App\Http\Controllers\api\krama;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDOException;

class KramaProfileController extends Controller
{
    public function index()
    {
        // MAIN LOGIC
        try {
            $user = Auth::user();
            $krama = $user->Krama()->first();

            $total_upacara = $krama->Upacaraku()->count();
            $total_upacara_proses = 10;
            $total_upacara_selesai = 0;
            $total_reservasi = 2;
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
            'message' => 'Berhasil mengambil data page profile krama',
            'data' => [
                "user" => $user,
                "krama" => $krama,
                "total_upacara" => $total_upacara,
                "total_upacara_proses" => $total_upacara_proses,
                "total_upacara_selesai" => $total_upacara_selesai,
                "total_reservasi" => $total_reservasi,
            ],
        ], 200);
        // END
    }

    public function detail()
    {
        // MAIN LOGIC
        try {
            $user = User::with([
                'Penduduk' => function ($pendudukQuery) {
                    $pendudukQuery->with(['Profesi', 'Pendidikan']);
                }
            ])->findOrFail(Auth::user()->id);
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Servef Error',
                'data' => (object)[],
            ], 500);
        }
        // END

        // RETURN
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data detail profile',
            'data' => [
                'user' => $user
            ],
        ], 200);
        // END
    }
}
