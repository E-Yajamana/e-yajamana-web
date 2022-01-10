<?php

namespace App\Http\Controllers\web\auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use PDOException;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('pages.auth.login');
    }

    public function loginPost(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'email' => 'required|email',
                'password' => 'required'
            ],
            [
                'email.required' => "Email tidak boleh kosong",
                'email.email' => "Masukan email yang sesuai",
                'password.required' => "Password tidak boleh kosong",
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Login',
                    'message' => 'Gagal melakukan login ke dalam sistem, validation input form gagal'
                ])->withInput($request->all());
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                    return redirect()->route('admin.dashboard')->with([
                        'login' => 'success',
                        'iconLog' => 'success',
                        'titleLog' => 'Anda berhasil Login ke sistem',
                    ]);
                }else{
                    return redirect()->back()->with([
                        'status' => 'fail',
                        'icon' => 'error',
                        'title' => 'Gagal Login',
                        'message' => 'Email atau password yang anda masukan salah!'
                    ])->withInput($request->all());
                }
            }catch(ModelNotFoundException | PDOException | ErrorException | QueryException | \Throwable | \Exception $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Login',
                    'message' => $err->getMessage()
                ]);
            }
        // END MAIN

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login')->with([
            'status'=> 'success',
            'icon' => 'success',
            'title' => 'Berhasil Logout',
            'message' => 'Berhasil melakukan logout !',
        ]);
    }




    public function registerLanding(Request $request)
    {
        return view('pages.auth.register.landing');
    }

    public function registerKrama(Request $request)
    {
        return view('pages.auth.register.krama-bali');
    }

    public function lupaPasswordLanding(Request $request)
    {
        return view('pages.auth.lupa-password.landing');
    }

    public function verifyOTP(Request $request)
    {
        return view('pages.auth.lupa-password.verify-otp');
    }

    public function resetPassword(Request $request)
    {
        return view('pages.auth.lupa-password.reset-password');
    }
}

