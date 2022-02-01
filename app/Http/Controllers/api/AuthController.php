<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\LupaPasswordMail;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
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

                    // MENENTUKAN USER
                    $krama = null;
                    $sulinggih = null;
                    switch ($user->role) {
                        case 'krama_bali':
                            $krama = $user->Krama()->firstOrFail();
                            $token = $user->createToken('e-yajamana',['role:krama_bali'])->plainTextToken;
                            break;

                        case 'sulinggih':
                            $sulinggih = $user->Sulinggih()->with(['GriyaRumah'])->whereHas('GriyaRumah')->firstOrFail();
                            $token = $user->createToken('e-yajamana',['role:sulinggih'])->plainTextToken;
                            break;

                        default:
                            throw new Exception("Role tidak ditemukan");
                            break;
                    }

                }else{
                    return response()->json([
                        'status' => 401,
                        'message' => 'Passworrd atau e-mail salah',
                        'data' => (Object)[]
                    ],401);
                }
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
                return $err;
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
                    'krama' => $krama,
                    'sulinggih' => $sulinggih
                ]
            ],200);
        // END
    }

    public function logoutUser(Request $request){
        // SECURITY
            $validator = Validator::make($request->all(),[
                'id_user' => 'required',
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
                if(!Auth::user()->currentAccessToken()->delete()){
                    throw new Exception("UNKNOWN ERROR");
                }
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
                    'message' => 'Berhasil melakukan logout',
                    'data' => (Object)[],
            ],200);
        // END
    }

    public function unauthorized(){
        return response()->json([
                'status' => 401,
                'message' => 'Unauthorized request detected',
                'data' => (Object)[],
        ],401);
    }

    public function lupaPassword(Request $request){

        // SECURITY
            $validator = Validator::make($request->all(),[
                'email' => 'required|email',
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

                // CARI EMAIL
                $user = User::where('email',$request->email)->firstOrFail();

                $digits = 5;
                $random_token = rand(pow(10, $digits-1), pow(10, $digits)-1);

                // BUAT DATA KE EMAIL VIEW
                $data = [
                    'token' => $random_token,
                ];

                // KIRIM KE EMAIL PENGGUNA
                Mail::to($user->email)->send(new LupaPasswordMail($data));

                // BUAT JSON
                $json_value = [
                            'token' => $random_token,
                            'generated_at' => date('y-m-d H:i:s'),
                            'verified' => false
                        ];

                // JSON WRAPPER
                $json_wrapper = [];

                // TAMBAH ATAU BUAT JSON
                if(json_decode($user->json_token_lupa_password) == null){
                    $json_wrapper[] = $json_value;
                }else{
                    $json_wrapper = json_decode($user->json_token_lupa_password);
                    $json_wrapper[] = $json_value;
                }

                // UPDATE MODEL
                $user->update([
                    'json_token_lupa_password' => $json_wrapper,
                ]);

            }catch(ModelNotFoundException $err){
                return response()->json([
                        'status' => 400,
                        'message' => 'E-Mail tidak ditemukan',
                        'data' => (Object)[],
                ],400);
            }catch(PDOException | QueryException | \Throwable | \Exception $err) {
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
                    'message' => 'Berhasil mengirim email',
                    'data' => (Object)[],
            ],200);
        // END
    }

    public function checkToken(Request $request){
        // SECURITY
            $validator = Validator::make($request->all(),[
                'token' => 'required|numeric',
                'email' => 'required|email',
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

                $user = User::where('email',$request->email)->firstOrFail();

                $arrayOfToken = json_decode($user->json_token_lupa_password);

                $successCheckToken = false;

                foreach ($arrayOfToken as $index => $value) {
                    if($value->token == $request->token){
                        $arrayOfToken[$index]->verified =  true;
                        $successCheckToken = true;
                        break;
                    }
                }

                if($successCheckToken){
                    $user->update([
                        'json_token_lupa_password' => json_encode($arrayOfToken)
                    ]);
                }else{
                    throw new Exception("GAGAL CHECK TOKEN");
                }

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
                    'message' => 'Berhasil mengirim email',
                    'data' => (Object)[
                        'email' => $user->email,
                    ],
            ],200);
        // END
    }

    public function createNewPassword(Request $request){
        // SECURITY
            $validator = Validator::make($request->all(),[
                'email' => 'required|email',
                'token' => 'required',
                'password' => 'required',
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

                $user = User::where('email',$request->email)->firstOrFail();

                $json_wrapper = json_decode($user->json_token_lupa_password);

                $isTokenExistsVerified = false;

                foreach ($json_wrapper as $key => $value) {
                    if($value->token == $request->token && $value->verified == true){
                        $isTokenExistsVerified = true;
                        break;
                    }
                }

                if(!$isTokenExistsVerified){
                    throw new Exception("TOKEN TIDAK DITEMUKAN");
                }

                $user->update([
                    'password' => Hash::make($request->password),
                    'json_token_lupa_password' => ''
                ]);

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
                    'message' => 'Berhasil memperbaharui password',
                    'data' => (Object)[],
            ],200);
        // END
    }
}
