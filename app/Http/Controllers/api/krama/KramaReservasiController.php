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
            'tipe' => 'required',
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

            $detailReservasi = json_decode($request->detail_reservasi);

            $relasi = User::with(['PemuputKarya'])->findOrFail($request->id_relasi);

            $user = Auth::user();

            $reservasi = Reservasi::create([
                'id_relasi' => $request->id_relasi,
                'id_upacaraku' => $request->id_upacaraku,
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
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
                ->where('status', 'pending')->findOrFail($request->id_reservasi);

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
            'message' => 'Berhasil membatalkan reservasi',
            'data' => (object)[],
        ], 200);
        // END
    }
}
