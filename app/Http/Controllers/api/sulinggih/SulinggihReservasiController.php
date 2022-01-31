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
                'status' => 'nullable|in:pending,proses tangkil,proses muput,selesai,batal',
                'date_sort' => 'nullable|in:desc,asc',
                'nama_upacaraku' => 'nullable'
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

                $upacarakuQuery = function($upacarakuQuery) use ($request) {
                    if($request->nama_upacaraku != null || $request->nama_upacaraku != ""){
                        $upacarakuQuery->where('nama_upacara','LIKE','%'.$request->nama_upacaraku.'%');
                    }
                    $upacarakuQuery->with('Upacara')->whereHas('Upacara');
                };

                $reservasis = Reservasi::query()->where('tipe','sulinggih_pemangku')->where('id_relasi',$user->Sulinggih->id)->with([
                                'Upacaraku' => $upacarakuQuery
                            ])->whereHas('Upacaraku',$upacarakuQuery);

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

    public function show($id_reservasi){
        // SECURITY
            $validator = Validator::make(['id' => $id_reservasi],[
                'id' => 'required|numeric'
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
                
                $tahapanUpacaraQuery = function($tahapanUpacaraQuery){
                    $tahapanUpacaraQuery->with(['Upacara'])->whereHas('Upacara');
                };

                $detailReservasiQuery = function($detailReservasiQuery) use ($tahapanUpacaraQuery){
                    $detailReservasiQuery->with([
                        'TahapanUpacara' => $tahapanUpacaraQuery
                        ])->whereHas('TahapanUpacara',$tahapanUpacaraQuery);
                };

                $kramaQuery = function($kramaQuery){
                    $kramaQuery->with(['User'])->whereHas('User');
                };

                $upacarakuQuery = function($upacarakuQuery) use ($kramaQuery) {
                    $upacarakuQuery->with([
                        'Upacara',
                        'Krama' => $kramaQuery
                        ])
                        ->whereHas('Upacara')
                        ->whereHas('Krama',$kramaQuery);
                };

                $reservasi = Reservasi::with([
                    'DetailReservasi' => $detailReservasiQuery,
                    'Upacaraku' => $upacarakuQuery
                    ])
                    ->whereHas('Upacaraku',$upacarakuQuery)
                    ->whereHas('DetailReservasi',$detailReservasiQuery)
                    ->where('tipe','sulinggih_pemangku')->where('id_relasi', $user->Sulinggih->id);
                
                $reservasi = $reservasi->findOrFail($id_reservasi);

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
                    'message' => 'Berhasil mengambil data reservasi dengan ID',
                    'data' => [
                        'reservasi' => $reservasi
                    ],
            ],200);
        // END
    }
}
