<?php

namespace App\Http\Controllers\api\krama;

use App\Http\Controllers\Controller;
use App\Models\Upacaraku;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDOException;

class KramaDashboardController extends Controller
{
    public function index(){
        // MAIN LOGIC
            try{
                $user = Auth::user();
                $krama = $user->Krama()->first();
                $upacarakus = $krama->Upacaraku()->with(['Upacara'])->get();
                
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
                return response()->json([
                        'status' => 500,
                        'message' => 'Internal Server Error',
                        'data' => (Object)[],
                ],500);
            }
            
        // END
        
        // RETURN
            return response()->json([
                    'status' => 200,
                    'message' => 'Success Mengambil Data Home Krama',
                    'data' => [
                        "user" => $user,
                        "krama" => $krama,
                        "upacarakus" => $upacarakus
                    ],
            ],200);
        // END
    }
}
