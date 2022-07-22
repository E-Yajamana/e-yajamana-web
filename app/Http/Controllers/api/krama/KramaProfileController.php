<?php

namespace App\Http\Controllers\api\krama;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\Upacara;
use App\Models\Upacaraku;
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
            $total_upacara_proses = $krama->Upacaraku()->whereNotIn('status', ['selesai', 'batal', 'ditolak'])->count();
            $total_upacara_selesai = $krama->Upacaraku()->where('status', 'selesai')->count();
            $total_reservasi = Reservasi::where('id_user', $user->id)->count();
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

            $total_upacara = Upacaraku::where('id_krama', $user->id)->count();
            $total_upacara_process = Upacaraku::where('id_krama', $user->id)->whereNotIn('status', ['selesai', 'batal'])->count();
            $total_upacara_selesai = Upacaraku::where('id_krama', $user->id)->where('status', 'status')->count();
            $total_reservasi = Reservasi::whereHas('Upacaraku', function ($upacaraQuery) use ($user) {
                $upacaraQuery->where('id_krama', $user->id);
            })->count();
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            return $err;
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
                'user' => $user,
                'Penduduk' => $user->Penduduk,
                'total_upacara' => $total_upacara,
                'total_upacara_process' => $total_upacara_process,
                'total_upacara_selesai' => $total_upacara_selesai,
                'total_reservasi' => $total_reservasi,
            ],
        ], 200);
        // END
    }
}
