<?php

namespace App\Http\Controllers\api\krama;

use App\Http\Controllers\Controller;
use App\Models\GriyaRumah;
use App\Models\Sanggar;
use App\Models\Sulinggih;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDOException;

class KramaPemuputKaryaController extends Controller
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
                'status' => 'nullable|in:sulinggih,pemangku,sanggar',
                'id_kecamatan' => 'nullable|numeric'
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
                
                $griyaRumahs = GriyaRumah::query();
                $sanggars = Sanggar::query();
                
                if($request->status != null && $request->status != ""){
                    if($request->status == 'sanggar' ){
                        $griyaRumahs->where('id',-1);
                        $sanggars->with(['User'])->whereHas('User');
                    }else{
                        $sanggars->where('id',-1);

                        $sulinggihQuery = function($sulinggihQuery) use ($request) {
                            $sulinggihQuery
                                ->with(['User'])
                                ->whereHas('User')
                                ->where('status',$request->status);
                        };

                        $griyaRumahs->with([
                            'Sulinggih' => $sulinggihQuery
                        ])
                        ->whereHas('Sulinggih',$sulinggihQuery);
                    }
                }else{
                        $sanggars->with(['User'])->whereHas('User');
                        $sulinggihQuery = function($sulinggihQuery) use ($request) {
                            $sulinggihQuery
                                ->with(['User'])
                                ->whereHas('User');
                        };

                        $griyaRumahs->with([
                            'Sulinggih' => $sulinggihQuery
                        ])
                        ->whereHas('Sulinggih',$sulinggihQuery);
                }

                if($request->id_kecamatan != null && $request->id_kecamatan != 0){
                    // QUERY DESA
                    $desaQuery = function($desaQuery) use ($request) {
                        $desaQuery->with([
                            'Kecamatan' => function($kecamatanQuery) use ($request) {
                                $kecamatanQuery->where('id_kecamatan',$request->id_kecamatan);
                            }
                        ])
                        ->whereHas('Kecamatan',function($kecamatanQuery) use ($request) {
                            $kecamatanQuery->where('id_kecamatan',$request->id_kecamatan);
                        });
                    };

                    $griyaRumahs->with([
                        'Desa' => $desaQuery,
                    ])->whereHas('Desa',$desaQuery);


                }else{
                    $griyaRumahs->with(['Desa'])->whereHas('Desa');
                    $sanggars->with(['Desa'])->whereHas('Desa');
                }

                $sanggars = $sanggars->get();
                $griyaRumahs = $griyaRumahs->get();

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
                    'message' => 'Berhasil mengambil data pemuput  karya',
                    'data' => [
                        'griya_rumahs' => $griyaRumahs,
                        'sanggars' => $sanggars
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
        //
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
    public function destroy($id)
    {
        //
    }
}
