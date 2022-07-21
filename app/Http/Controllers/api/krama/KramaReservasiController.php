<?php

namespace App\Http\Controllers\api\krama;

use App\Http\Controllers\Controller;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\DetailReservasi;
use App\Models\Reservasi;
use App\Models\Sanggar;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Mavinoo\Batch\BatchFacade;
use NotificationHelper;
use PDOException;

class KramaReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'id_relasi' => 'required',
            'id_upacaraku' => 'required',
            'tipe' => 'required|in:sanggar,pemuput_karya',
            'detail_reservasi' => 'required|json',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validataion error',
                'data' => [
                    'errors' => $validator->errors()
                ],
            ], 400);
        }
        // END

        // MAIN LOGIC
        try {
            DB::beginTransaction();
            $user = Auth::user();

            $detailReservasi = json_decode($request->detail_reservasi);

            if ($request->tipe == "pemuput_karya") {
                $relasi = User::with(['PemuputKarya'])->findOrFail($request->id_relasi);

                $reservasi = Reservasi::create([
                    'id_relasi' => $request->id_relasi,
                    'id_upacaraku' => $request->id_upacaraku,
                    'tipe' => $request->tipe,
                    'status' => 'pending'
                ]);

                $detailReservasi = json_decode($request->detail_reservasi);

                $insertArray = [];

                foreach ($detailReservasi->formDetailReservasis as $key => $value) {
                    $value = (array)$value;
                    $value['id_reservasi'] = $reservasi->id;
                    $value['status'] = 'pending';
                    $insertArray[] = $value;
                }

                DetailReservasi::insert($insertArray);

                NotificationHelper::sendNotification(
                    [
                        'title' => "RESERVASI BARU",
                        'body' => "Terdapat krama yang mengajukan pemuputan karya, reservasi dapat dilihat pada menu Reservasi Masuk",
                        'status' => "new",
                        'image' => "krama",
                        'notifiable_id' => $relasi->id,
                        'formated_created_at' => date('Y-m-d H:i:s'),
                        'formated_updated_at' => date('Y-m-d H:i:s'),
                    ],
                    $relasi
                );

                NotificationHelper::sendNotification(
                    [
                        'title' => "PERMOHONAN RESERVASI DIBUAT",
                        'body' => "Permohonan reservasi kepada " . $relasi->PemuputKarya->nama_pemuput . " telah berhasil dilakukan, dimohon untuk menunggu konfirmasi dari pihak pemuput karya",
                        'status' => "new",
                        'image' => "sulinggih",
                        'notifiable_id' => $user->id,
                        'formated_created_at' => date('Y-m-d H:i:s'),
                        'formated_updated_at' => date('Y-m-d H:i:s'),
                    ],
                    $user
                );
            } else {
                $sanggar = Sanggar::findOrFail($request->id_relasi);

                $reservasi = Reservasi::create([
                    'id_sanggar' => $request->id_relasi,
                    'id_upacaraku' => $request->id_upacaraku,
                    'tipe' => $request->tipe,
                    'status' => 'pending'
                ]);

                $detailReservasi = json_decode($request->detail_reservasi);

                $insertArray = [];

                foreach ($detailReservasi->formDetailReservasis as $key => $value) {
                    $value = (array)$value;
                    $value['id_reservasi'] = $reservasi->id;
                    $value['status'] = 'pending';
                    $insertArray[] = $value;
                }

                DetailReservasi::insert($insertArray);

                NotificationHelper::sendNotification(
                    [
                        'title' => "PERMOHONAN RESERVASI DIBUAT",
                        'body' => "Permohonan reservasi kepada " . $sanggar->nama_sanggar . " telah berhasil dilakukan, dimohon untuk menunggu konfirmasi dari pihak pemuput karya",
                        'status' => "new",
                        'image' => "sanggar",
                        'notifiable_id' => $user->id,
                        'formated_created_at' => date('Y-m-d H:i:s'),
                        'formated_updated_at' => date('Y-m-d H:i:s'),
                    ],
                    $user
                );
            }

            DB::commit();
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            DB::rollback();
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
            'message' => 'Berhasil menambahakn data reservasi',
            'data' => (object)[],
        ], 200);
        // END
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_reservasi)
    {
        // SECURITY
        $validator = Validator::make(['id_reservasi' => $id_reservasi], [
            'id_reservasi' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'data' => $validator->errors(),
            ], 400);
        }
        // END

        // MAIN LOGIC
        try {
            $reservasi = Reservasi::with([
                'DetailReservasi' => function ($queryReservasi) {
                    $queryReservasi->with([
                        'TahapanUpacara' => function ($tahapanUpacaraQuery) {
                            $tahapanUpacaraQuery->with(['Upacara']);
                        }
                    ]);
                },
                'Upacaraku' => function ($queryUpacaraku) {
                    $queryUpacaraku->with([
                        'Upacara' => function ($queryUpacara) {
                            $queryUpacara->with(['TahapanUpacara']);
                        }
                    ]);
                },
                'Relasi' => function ($relasiQuery) {
                    $relasiQuery->with([
                        'Penduduk',
                        'PemuputKarya'
                    ]);
                },
                'Sanggar'
            ])->findOrFail($id_reservasi);
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
            'message' => 'Berhasil Mengambil data reservasi',
            'data' => [
                'reservasi' => $reservasi
            ],
        ], 200);
        // END
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'id_reservasi' => 'required|numeric',
            'detail_reservasi' => 'required|json',
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

            $reservasi = Reservasi::with(['Relasi' => function ($relasiQuery) {
                $relasiQuery->with(['PemuputKarya']);
            }])->findOrFail($request->id_reservasi);

            DetailReservasi::where('id_reservasi', $request->id_reservasi)->delete();

            $detailReservasi = json_decode($request->detail_reservasi);

            $insertArray = [];

            foreach ($detailReservasi->formDetailReservasis as $key => $value) {
                $value = (array)$value;
                $value['id_reservasi'] = $request->id_reservasi;
                $value['status'] = 'pending';
                $insertArray[] = $value;
            }

            DetailReservasi::insert($insertArray);

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
            'message' => 'Berhasil memperbaharui reservasi',
            'data' => (object)[],
        ], 200);
        // END
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'id_reservasi' => 'required|numeric',
            'keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation Fail',
                'data' => $validator->errors(),
            ], 400);
        }
        // END

        // MAIN LOGIC
        try {
            DB::beginTransaction();

            $reservasi = Reservasi::with(['Relasi', 'Upacaraku', 'DetailReservasi'])
                ->whereHas('Relasi')
                ->whereHas('Upacaraku')
                ->where('status', 'pending')->orWhere('status', 'batal')->findOrFail($request->id_reservasi);

            $reservasi->update(['status' => 'batal']);

            $array_detail_reservasi = array_map(function ($object) {
                $object['status'] = 'batal';
                return (array) $object;
            }, $reservasi->DetailReservasi->toArray());

            BatchFacade::update(new DetailReservasi(), $array_detail_reservasi, 'id');

            $result = NotificationHelper::sendNotification(
                [
                    'title' => "Reservasi Dibatalkan",
                    'body' => "Reservasi anda dengan ID : {$reservasi->id} telah dibatalkan\n\nPesan Krama : {$request->keterangan}",
                    'status' => "new",
                    'image' => "warning",
                    'notifiable_id' => $reservasi->id_relasi,
                    'formated_created_at' => date('Y-m-d H:i:s'),
                    'formated_updated_at' => date('Y-m-d H:i:s'),
                ],
                $reservasi->Relasi
            );

            DB::commit();
        } catch (ModelNotFoundException | PDOException | QueryException $err) {
            DB::rollBack();
            return $err;
            return response()->json([
                'status' => 403,
                'message' => 'Reservasi tidak ditemukan',
                'data' => (object)[],
            ], 403);
        } catch (\Throwable | \Exception $err) {
            DB::rollBack();
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
            'message' => 'Berhasil membatalkan reservasi',
            'data' => (object)[],
        ], 200);
        // END
    }

    public function setRating(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'rating' => 'required|numeric',
            'keterangan_rating' => 'nullable',
            'id' => 'required|numeric'
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
            Reservasi::findOrFail($request->id)->update([
                'rating' => $request->rating,
                'keterangan_rating' => $request->keterangan_rating
            ]);
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
            'message' => 'Berhasil memperbaharui rating',
            'data' => (object)[],
        ], 200);
        // END
    }
}
