<?php

namespace App\Http\Controllers\api\sulinggih;

use App\Http\Controllers\Controller;
use App\ImageHelper;
use App\Models\Reservasi;
use App\Models\Upacaraku;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Doctrine\DBAL\Query\QueryException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PDOException;
use NotificationHelper;
use App\Models\DetailReservasi;
use App\Models\User;

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
                    ])->where('status', 'diterima');
                }
            ])->findOrFail($id);

            $upacaraku = Upacaraku::with([
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

            $file = $request->file('image_muput');
            $path = ImageHelper::moveImage($file, 'app/sulinggih/bukti-muput/upacara/');

            $detailReservasiQuery = function ($detailReservasiQuery) {
                $detailReservasiQuery->with(['TahapanUpacara'])->whereHas('TahapanUpacara');
            };

            $reservasi = Reservasi::with([
                'DetailReservasi' => $detailReservasiQuery
            ])->whereHas('DetailReservasi', $detailReservasiQuery)->findOrFail($request->id_reservasi);

            $detailReservasi = $reservasi->DetailReservasi->where('id', $request->id_detail_reservasi)->first();
            $detailReservasi->update(['status' => 'selesai']);
            $detailReservasi->Gambar()->create(['image' => $path]);

            $isReservasiSelesai = $detailReservasi->Reservasi->isDetailReservasiDone();
            if ($isReservasiSelesai) {
                // $detailReservasi->Reservasi->Update(['status' => 'selesai']);
            }
            $isUpacarakuSelesai = $detailReservasi->Reservasi->Upacaraku->isReservasiDone();
            if ($isUpacarakuSelesai) {
                $detailReservasi->Reservasi->Upacaraku->Update(['status' => 'selesai']);
            }

            DB::commit();
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | Exception $err) {
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

    public function batalMuput(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'id_detail_reservasi' => 'required|exists:tb_detail_reservasi,id',
            'alasan_pembatalan' => 'required',
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
            DB::beginTransaction();
            $detailReservasi = DetailReservasi::with(['Reservasi.Upacaraku'])
                ->whereHas('Reservasi', function ($reservasiQuery) {
                    $reservasiQuery->whereHas('Upacaraku');
                })->findOrFail($request->id_detail_reservasi);
            $detailReservasi->update([
                'status' => 'batal',
                'keterangan' => $request->alasan_pembatalan
            ]);
            $isReservasiSelesai = $detailReservasi->Reservasi->isDetailReservasiDone();
            if ($isReservasiSelesai) {
                $detailReservasi->Reservasi->Update(['status' => 'selesai']);
            }
            $isUpacarakuSelesai = $detailReservasi->Reservasi->Upacaraku->isReservasiDone();
            if ($isUpacarakuSelesai) {
                $detailReservasi->Reservasi->Upacaraku->Update(['status' => 'selesai']);
            }
            DB::commit();
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
            'message' => 'Berhasil membatalkan muput upacara',
            'data' => (object)[],
        ], 200);
        // END
    }
}
