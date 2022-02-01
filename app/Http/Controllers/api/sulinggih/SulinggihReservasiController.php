<?php

namespace App\Http\Controllers\api\sulinggih;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PDOException;

class SulinggihReservasiController extends Controller
{
    public function index(Request $request){
        // SECURITY
            $validator = Validator::make($request->all(),[
                'status' => 'nullable|in:pending,diterima,ditolak',
                'date_sort' => 'nullable|in:desc,asc',
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

                $upacarakuQuery = function($upacarakuQuery){
                    $upacarakuQuery->with('Upacara')->whereHas('Upacara');
                };

                // PRA FILTER
                $reservasis = Reservasi::query()->where('tipe','sulinggih_pemangku')->where('id_relasi',$user->Sulinggih->id)->with([
                                'Upacaraku' => $upacarakuQuery
                            ])->whereHas('Upacaraku',$upacarakuQuery);

                // FILTER
                if($request->status != null || $request->status != ""){
                    $reservasis->where('status',$request->status);
                }

                if($request->date_sort != null || $request->date_sort != ""){
                    $reservasis->orderBy('created_at',$request->date_sort);
                }

                $reservasis = $reservasis->get();

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
                    'message' => 'Berhasil mengambil data reservasi',
                    'data' => [
                        'reservasis' => $reservasis
                    ],
            ],200);
        // END
    }
}
