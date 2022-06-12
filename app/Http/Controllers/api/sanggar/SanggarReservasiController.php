<?php

namespace App\Http\Controllers\api\sanggar;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PDOException;

class SanggarReservasiController extends Controller
{
    public function index(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'status' => 'nullable|in:pending,proses tangkil,proses muput,selesai,batal',
            'date_sort' => 'nullable|in:desc,asc',
            'id_sanggar' => 'required|numeric',
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
            $reservasis = Reservasi::query()->where('id_sanggar', $request->id_sanggar)->with([
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
                'Sanggar',
                'DetailReservasi' => function ($detailReservasiQuery) {
                    $detailReservasiQuery->with('TahapanUpacara');
                }
            ])
                ->whereHas('Upacaraku')
                ->whereHas('Sanggar')
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
}
