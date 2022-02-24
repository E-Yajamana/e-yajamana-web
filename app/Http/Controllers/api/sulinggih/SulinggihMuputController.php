<?php

namespace App\Http\Controllers\api\sulinggih;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\Upacaraku;
use Carbon\Carbon;
use Doctrine\DBAL\Query\QueryException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDOException;

class SulinggihMuputController extends Controller
{
    public function getDetailMuput($id)
    {
        // SECURITY
        $validator = Validator::make(['id' => $id], [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'data' => (object)[],
            ], 400);
        }
        // END

        // MAIN LOGIC
        try {
            $user = Auth::user();
            $reservasi = Reservasi::with([
                'DetailReservasi' => function ($detailReservasiQuery) {
                    $detailReservasiQuery->with([
                        'TahapanUpacara'
                    ]);
                }
            ])->where('status', 'proses muput')->where('id_relasi', $user->id)->findOrFail($id);

            $upacaraku = Upacaraku::with([
                'Krama' => function ($kramaQuery) {
                    $kramaQuery->with([
                        'User' => function ($userQuery) {
                            $userQuery->with([
                                'Penduduk'
                            ]);
                        }
                    ]);
                }
            ])->where('id', $reservasi->id_upacaraku)->firstOrFail();
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
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
            'message' => 'Berhasil mengambil data upacaraku dan reservasi untuk proses tangkil',
            'data' => [
                'reservasi' => $reservasi,
                'upacaraku' => $upacaraku,
            ],
        ], 200);
        // END
    }

    public function puputKarya(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'id_detail_reservasi' => 'required|numeric',
            'id_reservasi' => 'required|numeric',
            'image_muput' => 'required|image|mimes:jpeg,bmp,png',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'data' => [
                    $validator->errors()
                ],
            ], 400);
        }
        // END

        // MAIN LOGIC
        try {
            DB::beginTransaction();

            $detailReservasiQuery = function ($detailReservasiQuery) {
                $detailReservasiQuery->with(['TahapanUpacara'])->whereHas('TahapanUpacara');
            };

            $reservasi = Reservasi::with([
                'DetailReservasi' => $detailReservasiQuery
            ])->whereHas('DetailReservasi', $detailReservasiQuery)->findOrFail($request->id_reservasi);

            $reservasi->DetailReservasi->where('id', $request->id_detail_reservasi)[0]->update(['status' => 'selesai']);

            $totalDetailReservasi = $reservasi->DetailReservasi->count();
            $countSelesai = 0;

            foreach ($reservasi->DetailReservasi as $key => $value) {
                if ($value->status == 'selesai') {
                    $countSelesai += 1;
                }
            }

            if ($countSelesai == $totalDetailReservasi) {
                $reservasi->update(['status' => 'selesai']);
            }

            DB::commit();
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            DB::rollBack();
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
            'message' => 'Berhasil puput tahapan upacara',
            'data' => (object)[],
        ], 200);
        // END
    }
}
