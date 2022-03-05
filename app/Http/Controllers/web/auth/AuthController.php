<?php

namespace App\Http\Controllers\web\auth;

use App\Http\Controllers\Controller;
use App\Models\Krama;
use App\Models\Sanggar;
use App\Models\Serati;
use App\Models\Sulinggih;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use PDOException;
class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // INDEX PAGE LOGIN
    public function login(Request $request)
    {
        return view('pages.auth.login');
    }
    // INDEX PAGE LOGIN

    // POST LOGIN
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
                    switch(Auth::user()->role){
                        case 'krama_bali':
                            return redirect(route('krama.dashboard'));
                        case 'admin':
                            return redirect(route('admin.dashboard'));
                        case 'sulinggih':
                            return redirect(route('pemuput-karya.dashboard'));
                        default:
                            Auth::user()->logout;
                            return redirect()->back()->with([
                                'status' => 'fail',
                                'icon' => 'error',
                                'title' => 'Gagal Login',
                                'message' => 'Pengguna Tidak dapat digunakan!'
                            ])->withInput($request->all());
                    }
                }else{
                    return redirect()->route('auth.login')->with([
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
    // POST LOGIN

    // LOGOUT SESSION
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
    // LOGOUT SESSION

    // LUPA PASSWORD INDEX
    public function index(Request $request)
    {
        return view('pages.auth.lupa-password.reset-password');
    }
    // LUPA PASSWORD INDEX

    // VERIFY OTP
    public function verifyOTP(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'email' => 'required|email|exists:tb_user_eyajamana,email',
            ],
            [
                'email.required' => "Email tidak boleh kosong",
                'email.email' => "Masukan email yang sesuai",
                'email.exists' => "Email tidak sesuai dengan database sistem",
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

        return view('pages.auth.lupa-password.verify-otp');
    }
    // VERIFY OTP

    // RESET PASSWORD
    public function resetPassword(Request $request)
    {
        return view('pages.auth.lupa-password.reset-password');
    }
    // RESET PASSWORD


}

