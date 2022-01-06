<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PDOException;

class AuthController extends Controller
{
    public function loginUser(Request $request){
        // SECURITY
            $validator = Validator::make($request->all(),[
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 400,
                    'message' => 'Validasi Gagal',
                    'data' => (Object)[]
                ],400);
            }
        // END

        // MAIN LOGIC
            try{
                if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                    $user = Auth::user();
                    $krama = $user->Krama;
                    $token = $user->createToken('e-yajamana')->plainTextToken;
                }else{
                    return response()->json([
                        'status' => 401,
                        'message' => 'Passworrd atau e-mail salah',
                        'data' => (Object)[]
                    ],401);
                }
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
                return response()->json([
                    'status' => 500,
                    'message' => 'Internal Server Error',
                    'data' => (Object)[]
                ],500);
            }
        // END

        // RETURN
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil melakukan login',
                'data' => (Object)[
                    'token' => $token,
                    'user' => $user,
                    'krama' => $krama
                ]
            ],200);
        // END
    }
}
