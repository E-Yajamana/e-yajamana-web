<?php

namespace App\Http\Controllers\api\sulinggih;

use App\Http\Controllers\Controller;
use App\Models\DetailReservasi;
use App\Models\Reservasi;
use App\Models\Upacaraku;
use Doctrine\DBAL\Query\QueryException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Mavinoo\Batch\BatchFacade;
use PDOException;

class SulinggihReservasiController extends Controller
{
    public function index(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'status' => 'nullable|in:pending,proses tangkil,proses muput,selesai,batal',
            'date_sort' => 'nullable|in:desc,asc',
            'nama_upacaraku' => 'nullable'
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

            $upacarakuQuery = function ($upacarakuQuery) {
                $upacarakuQuery->with('Upacara')->whereHas('Upacara');
            };

            // PRA FILTER
            $reservasis = Reservasi::query()->where('id_relasi', $user->id)->with([
                'Upacaraku' => $upacarakuQuery
            ])->whereHas('Upacaraku', $upacarakuQuery);

            // FILTER
            if ($request->status != null || $request->status != "") {
                $reservasis->where('status', $request->status);
            }

            if ($request->date_sort != null || $request->date_sort != "") {
                $reservasis->orderBy('created_at', $request->date_sort);
            }

            $reservasis = $reservasis->get();
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
            'message' => 'Berhasil mengambil data reservasi',
            'data' => [
                'reservasis' => $reservasis
            ],
        ], 200);
        // END
    }

    public function show($id)
    {
        // SECURITY
        $validator = Validator::make(['id' => $id], [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 403,
                'message' => 'Validation Error',
                'data' => $validator->errors(),
            ], 403);
        }
        // END

        // MAIN LOGIC
        try {
            $reservasi = Reservasi::with([
                'Upacaraku' => function ($upacarakuQuery) {
                    $upacarakuQuery->with([
                        'Upacara' => function ($upacaraQuery) {
                            $upacaraQuery->with('TahapanUpacara');
                        },
                        'User' => function ($userQuery) {
                            $userQuery->with(['Penduduk']);
                        },
                    ])->whereHas('User')->whereHas('Upacara');
                },
                'Relasi' => function ($relasiQuery) {
                    $relasiQuery->with(['PemuputKarya'])
                        ->where('id', Auth::user()->id);
                },
                'DetailReservasi' => function ($detailReservasiQuery) {
                    $detailReservasiQuery->with('TahapanUpacara');
                }
            ])
                ->whereHas('Upacaraku')
                ->whereHas('Relasi')
                ->findOrFail($id);
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
            'message' => 'Berhasil mengambil data reservasi',
            'data' => [
                'reservasi' => $reservasi
            ],
        ], 200);
        // END
    }

    public function update(Request $request)
    {
        // SECURITY
        // STEP ONE
        $validator = Validator::make($request->all(), [
            'id_reservasi' => 'required',
            'detail_reservasi' => 'required|json',
            'tanggal_tangkil' => 'nullable'
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

            $detail_reservasi = json_decode($request->detail_reservasi);

            $array_detail_reservasi = array_map(function ($object) {
                return (array) $object;
            }, $detail_reservasi);

            // DETAIL RESERVASI UPDATE
            BatchFacade::update(new DetailReservasi(), $array_detail_reservasi, 'id');
            // END

            // MASTER RESERVASI
            $status = 'pending';
            $ditolak = 0;

            foreach ($array_detail_reservasi as $index => $value) {
                if ($value['status'] == 'diterima') {
                    $status = 'proses tangkil';
                    break;
                }

                if ($value['status'] == 'ditolak' && $status != 'diterima') {
                    $ditolak += 1;
                    if ($ditolak == count($array_detail_reservasi)) {
                        $status = 'batal';
                        break;
                    }
                }

                // if ($value['status'] == 'pending') {
                //     $status = 'pending';
                // }
            }

            $reservasi = Reservasi::with(['Upacaraku'])->whereHas('Upacaraku')->findOrFail($request->id_reservasi);
            $reservasi->update(['tanggal_tangkil' => $request->tanggal_tangkil]);

            if (!$reservasi->update(['status' => $status])) {
                throw new Exception("Gagal update reservasi");
            }

            if ($reservasi->upacaraku->status != 'batal' && $reservasi->upacaraku->status != 'selesai') {
                $reservasi->Upacaraku->update(['status' => 'berlangsung']);
            }

            // END
            DB::commit();
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            DB::rollback();
            return $err;
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error',
                'data' => (object)[
                    $status
                ],
            ], 500);
        }
        // END

        // RETURN
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil memperbaharui data reservasi',
            'data' => (object)[],
        ], 200);
        // END
    }

    public function tolakReservasi(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'id_reservasi' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 40,
                'message' => 'Validation Error',
                'data' => $validator->errors(),
            ], 40);
        }
        // END

        // MAIN LOGIC
        try {
            DB::beginTransaction();
            Reservasi::findOrFail($request->id_reservasi)->update(['status' => 'ditolak']);
            DetailReservasi::where('id_reservasi', $request->id_reservasi)->update(['status' => 'ditolak']);
            DB::commit();
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            DB::rollBack();
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
            'message' => 'Berhasil menolak reservasi',
            'data' => (object)[],
        ], 200);
        // END
    }
}
