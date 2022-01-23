<?php

namespace App\Http\Controllers\api\yadnya;

use App\Http\Controllers\Controller;
use App\Models\Upacara;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDOException;

class YadnyaController extends Controller
{
    public function getUpacara($jenis_yadnya){
        // SECURITY
            $validator = Validator::make(['jenis_yadnya' => $jenis_yadnya],[
                'jenis_yadnya' => 'required',
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

                $upacaras = Upacara::where('kategori_upacara',$jenis_yadnya)->get();

            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
                return $err;
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
                        'upacaras' => $upacaras
                    ],
            ],200);
        // END
    }
}
