<?php

namespace App\Http\Controllers\api\sulinggih;

use App\Http\Controllers\Controller;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDOException;

class SulinggihDashboardController extends Controller
{
    public function index(){
        // MAIN LOGIC
            try{
                $user = Auth::user();
                $sulinggih = $user->Sulinggih()->with('GriyaRumah')->whereHas('GriyaRumah')->firstOrFail();

                $reservasiQuery = function($reservasiQuery){
                    $reservasiQuery->with(['Upacara'])->whereHas('Upacara');
                };

                $reservasis = $sulinggih
                                ->Reservasi()
                                ->with(['Upacaraku' => $reservasiQuery])
                                ->whereHas('Upacaraku',$reservasiQuery)
                                ->where('tipe','sulinggih_pemangku')->get();

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
                    'message' => 'Server message',
                    'data' => [
                        'user' => $user,
                        'sulinggih' => $sulinggih,
                        'reservasis' => $reservasis,
                    ],
            ],200);
        // END
    }
}