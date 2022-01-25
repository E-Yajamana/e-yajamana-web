<?php

namespace App\Http\Controllers\api\krama;

use App\Http\Controllers\Controller;
use App\Models\Upacaraku;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDOException;
use Illuminate\Support\Facades\Input;
use Symfony\Component\Console\Input\Input as InputInput;

class KramaUpacaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'nama' => 'nullable|string',
                'status' => 'nullable|string'
            ]);

            if($validator->fails()){
                return response()->json([
                        'status' => 400,
                        'message' => 'Validation error',
                        'data' => (Object)[],
                ],400);
            }
        // END

        // MAIN LOGIC
            try{

                $user = Auth::user();

                $upacarakus = Upacaraku::query()->with(['Upacara'])->whereHas('Upacara')->where('id_krama',$user->Krama->id);

                if($request->nama != null || $request->nama != ""){
                    $upacarakus->where('nama_upacara','LIKE','%'.$request->nama.'%');
                }

                if($request->status != null || $request->status != ""){
                    $upacarakus->where('status',$request->status);
                }

                $upacarakus = $upacarakus->get();

            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
                return response()->json([
                        'status' => 500,
                        'message' => 'Internal server error',
                        'data' => (Object)[],
                ],500);
            }
        // END

        // RETURN
            return response()->json([
                    'status' => 200,
                    'message' => 'Berhasil mendapatkan data upacara',
                    'data' => [
                        'upacarakus' => $upacarakus,
                    ],
            ],200);
        // END
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
            $validator = Validator::make($request->all(),[
                'id_upacara' => 'required',
                'id_desa' => 'required',
                'id_desa_adat' => 'required',
                'nama_upacara' => 'required',
                'lokasi' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'tanggal_mulai' => 'required',
                'tanggal_selesai' => 'required',
                'desc' => 'required',
            ]);

            if($validator->fails()){
                return response()->json([
                        'status' => 400,
                        'message' => 'Validation Error',
                        'data' => (Object)[],
                ],400);
            }
        // END

        // MAIN LOGIC
            try{
                DB::beginTransaction();

                $user = Auth::user();

                Upacaraku::create([
                    'id_upacara' => $request->id_upacara,
                    'id_krama' => $user->krama->id,
                    'id_desa' => $request->id_desa,
                    'id_desa_adat' => $request->id_desa_adat,
                    'nama_upacara' => $request->nama_upacara,
                    'lokasi' => $request->lokasi,
                    'lat' => $request->lat,
                    'lng' => $request->lng,
                    'status' => 'pending',
                    'tanggal_mulai' => $request->tanggal_mulai,
                    'tanggal_selesai' => $request->tangal_selesa,
                    'desc' => $request->desc,
                ]);

                DB::commit();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
                return $err;
                DB::rollBack();
                return response()->json([
                        'status' => 500,
                        'message' => 'Internal server error',
                        'data' => (Object)[],
                ],500);
            }
        // END

        // RETURN
            return response()->json([
                    'status' => 200,
                    'message' => 'Berhasil membuat upacara baru',
                    'data' => (Object)[],
            ],200);
        // END
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id_upacara)
    {
        // SECURITY
            $validator = Validator::make(['id_upacara' => $id_upacara],[
                'id_upacara' => 'required',
            ]);

            if($validator->fails()){
                return response()->json([
                        'status' => 400,
                        'message' => 'Validation error',
                        'data' => (Object)[],
                ],400);
            }
        // END

        // MAIN LOGIC
            try{
                $upacara = Upacaraku::with([
                    'Upacara' => function($upacaraQuery){
                        $upacaraQuery->with(['TahapanUpacara']);
                    },
                    'Desa' => function($desaQuery){
                        $desaQuery->with(['Kecamatan' => function($kecamatanQuery){
                            $kecamatanQuery->with(['Kabupaten' => function($provinsiQuery){
                                $provinsiQuery->with('Provinsi');
                            }]);
                        }]);
                    },
                    'DesaAdat',
                    'Reservasi' => function($reservasiQuery){
                        $reservasiQuery->with([
                            'Sulinggih',
                            'DetailReservasi' => function($detailReservasiQuery){
                                $detailReservasiQuery->with(['TahapanUpacara']);
                            }
                        ]);
                    }
                    ])
                    ->whereHas('Upacara')
                    ->whereHas('Desa')
                    ->whereHas('DesaAdat')
                    ->findOrFail($id_upacara);

            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
                return response()->json([
                        'status' => 500,
                        'message' => 'Internal server error',
                        'data' => (Object)[],
                ],500);
            }
        // END

        // RETURN
            return response()->json([
                    'status' => 200,
                    'message' => 'Berhasil mengambil data upacara',
                    'data' => [
                        'upacaraku' => $upacara
                    ],
            ],200);
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
    public function destroy($id)
    {
        //
    }
}
