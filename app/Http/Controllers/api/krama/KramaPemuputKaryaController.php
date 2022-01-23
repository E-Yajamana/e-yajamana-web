<?php

namespace App\Http\Controllers\api\krama;

use App\Http\Controllers\Controller;
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
                
                $sulinggihs = Sulinggih::query();

                if($request->status != null || $request->status != ""){
                    $sulinggihs->where('status',$request->status);
                }

                if($request->id_kecamatan != null || $request->id_kecamatan != ""){
                    $desaQuery = function($desaQuery) use ($request) {
                                    $desaQuery->where('id_kecamatan',$request->id_kecamatan)
                                                ->whereHas('Kecamatan');
                    };

                    $griyaRumahQuery = function($griyaRumahQuery) use ($desaQuery){
                                    $griyaRumahQuery->with(['Desa' => $desaQuery])
                                                    ->whereHas('Desa',$desaQuery);
                    };

                    $sulinggihs->with([
                        'GriyaRumah' => $griyaRumahQuery
                    ])->whereHas('GriyaRumah',$griyaRumahQuery);

                }else{
                    $sulinggihs->with(['GriyaRumah'])->whereHas('GriyaRumah');
                }

                $sulinggihs = $sulinggihs->get();

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
                        'markereyajamanas' => $sulinggihs
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
