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
            $validator = Validator::make($request->all(),[
                'id_relasi' => 'required',
                'id_upacaraku' => 'required',
                'tipe' => 'required',
                'detail_reservasi' => 'required|json',
            ]);
            
            if($validator->fails()){
                return response()->json([
                        'status' => 400,
                        'message' => 'Validataion error',
                        'data' => (Object)[],
                ],400);
            }
        // END
        
        // MAIN LOGIC
            try{
                $detailReservasi = json_decode($request->detail_reservasi);

                DB::beginTransaction();

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

                DB::commit();

            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
                
                DB::rollback();
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
                    'message' => 'Berhasil menambahakn data reservasi',
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
