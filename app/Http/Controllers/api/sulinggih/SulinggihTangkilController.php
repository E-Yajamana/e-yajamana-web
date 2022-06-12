<?php

namespace App\Http\Controllers\api\sulinggih;

use App\Http\Controllers\Controller;
use App\Models\DetailReservasi;
use App\Models\Reservasi;
use App\Models\Upacaraku;
use Carbon\Carbon;
use Doctrine\DBAL\Query\QueryException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Mavinoo\Batch\BatchFacade;
use PDOException;

class SulinggihTangkilController extends Controller
{
    public function getDetailTangkil($id)
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
            $reservasi = Reservasi::with([
                'DetailReservasi' => function ($detailReservasiQuery) {
                    $detailReservasiQuery->with([
                        'TahapanUpacara'
                    ]);
                }
            ])->where('status', 'proses tangkil')->findOrFail($id);

            $dateNow = Carbon::now();
            $dateTangkil = Carbon::create($reservasi->tanggal_tangkil);
            $countdownmilis = $dateNow->diffInMilliseconds($dateTangkil, false);
            $isEditable = $countdownmilis < 0;

            $upacaraku = Upacaraku::with([
                'Reservasi' => function ($reservasiQuery) use ($reservasi) {
                    $reservasiQuery->with([
                        'Relasi' => function ($relasiQuery) {
                            $relasiQuery->with([
                                'Penduduk',
                                'PemuputKarya'
                            ]);
                        },
                        'Sanggar',
                        'DetailReservasi' => function ($detailReservasiQuery) {
                            $detailReservasiQuery->with([
                                'TahapanUpacara'
                            ]);
                        }
                    ])->where('id', '!=', $reservasi->id);
                },
                'User' => function ($userQuery) {
                    $userQuery->with([
                        'Penduduk'
                    ]);
                }
            ])->where('id', $reservasi->id_upacaraku)->firstOrFail();
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
            'message' => 'Berhasil mengambil data upacaraku dan reservasi untuk proses tangkil',
            'data' => [
                'reservasi' => $reservasi,
                'upacaraku' => $upacaraku,
                'isEditable' => $isEditable,
                'countdownserver' => $countdownmilis
            ],
        ], 200);
        // END
    }

    public function konfirmasiTangkil(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'id_reservasi' => 'required',
            'tahapan_json' => 'required|json',
            'tahapan_lainnya_json' => 'required|json',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'data' => (object)[],
            ], 400);
        }

        $tahapan = json_decode($request->tahapan_json);
        $tahapan_lainnya = json_decode($request->tahapan_lainnya_json);
        // END

        // MAIN LOGIC
        try {
            DB::beginTransaction();

            // RESERVASI SENDIRI
            $user = Auth::user();
            $reservasi = Reservasi::findOrFail($request->id_reservasi);
            $reservasi->update(['status' => 'proses muput']);

            $array_tahapan = array_map(function ($object) {
                return (array) $object;
            }, $tahapan);

            if ($tahapan != null) {
                BatchFacade::update(new DetailReservasi(), $array_tahapan, 'id');
            } else {
                throw new Exception("Tahapan null");
            }

            $array_tahapan = array_map(function ($object) {
                return (array) $object;
            }, $tahapan_lainnya);

            foreach ($array_tahapan as $index => $value) {
                $reservasiLainnya = Reservasi::findOrFail($value['id']);
                $reservasiLainnya->update(['status' => 'pending']);

                $detailReservasi = array_map(function ($object) {
                    return (array) $object;
                }, $value['formDetailReservasis']);

                BatchFacade::update(new DetailReservasi(), $detailReservasi, 'id');
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
            'message' => 'Berhasil melakukan konfirmasi tangkil',
            'data' => (object)[],
        ], 200);
        // END
    }
}
