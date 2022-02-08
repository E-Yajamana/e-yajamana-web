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
    public function create(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                ''
            ]);

            if($validator->fails()){

            }
        // END

        // MAIN LOGIC

        // END

        // RETURN

        // END
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
                'id_banjar_dinas' => 'required',
                'id_upacara' => 'required',
                'nama_upacara' => 'required',
                'lokasi' => 'required',
                'tanggal_mulai' => 'required',
                'tanggal_selesai' => 'required',
                'deskripsi_upacaraku' => 'required',
                'lat' => 'required',
                'lng' => 'required',
            ]);

            if($validator->fails()){
                return response()->json([
                        'status' => 400,
                        'message' => 'Validation Error',
                        'data' => $validator->errors(),
                ],400);
            }
        // END

        // MAIN LOGIC
            try{
                DB::beginTransaction();

                $user = Auth::user();

                Upacaraku::create([
                    'id_banjar_dinas' => $request->id_banjar_dinas,
                    'id_upacara' => $request->id_upacara,
                    'id_krama' => $user->krama->id,
                    'nama_upacara' => $request->nama_upacara,
                    'lokasi' => $request->lokasi,
                    'tanggal_mulai' => $request->tanggal_mulai,
                    'tanggal_selesai' => $request->tangal_selesa,
                    'deskripsi_upacaraku' => $request->desckripsi_upacaraku,
                    'status' => 'pending',
                    'lat' => $request->lat,
                    'lng' => $request->lng,
                ]);

                DB::commit();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
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
                $banjarDinasQuery = function($queryBanjarDinas){
                    $queryBanjarDinas->with([
                        'DesaDinas' => function($desaDinasQuery){
                            $desaDinasQuery->with([
                                'Kecamatan' => function($kecamatanQuery){
                                    $kecamatanQuery->with([
                                        'Kabupaten' => function($kabupatenQuery){
                                            $kabupatenQuery->with([
                                                'Provinsi'
                                            ]);
                                        }
                                    ]);
                                }
                            ]);
                        }
                    ]);
                };

                $upacara = Upacaraku::with([
                    'Upacara' => function($upacaraQuery){
                        $upacaraQuery->with(['TahapanUpacara']);
                    },
                    'BanjarDinas' => $banjarDinasQuery,
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
                    ->whereHas('BanjarDinas')
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
