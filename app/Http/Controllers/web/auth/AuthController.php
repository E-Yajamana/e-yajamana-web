<?php

namespace App\Http\Controllers\web\auth;

use App\Http\Controllers\Controller;
use App\Models\Krama;
use App\Models\PemuputKarya;
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
        $this->middleware('guest', ['except' => ['logout','selectAccount','switchAccount']]);
    }

    // INDEX PAGE LOGIN
    public function login(Request $request)
    {
        return view('pages.auth.login');
    }
    // INDEX PAGE LOGIN

    // INDEX PAGE LOGIN
    public function selectAccount(Request $request)
    {
        return view('pages.auth.login.login-switch');
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
                    $user = Auth::user();
                    if($user->Role->count()== 1 && $user->Role->first()->nama_role == "admin"){
                        return redirect(route('admin.dashboard'));
                    }elseif($user->Role->count() == 1 && $user->Role->first()->nama_role == "krama"){
                        return redirect(route('krama.dashboard'));
                    }elseif($user->Role->count() > 1){
                        $exitsPemuput = PemuputKarya::whereIdUser($user->id)->whereStatusKonfirmasiAkun('disetujui')->count();
                        $exitsSerati = Serati::whereIdUser($user->id)->whereStatusKonfirmasiAkun('disetujui')->count();
                        $exitsSanggar = Auth::user()->Sanggar->where('status_konfirmasi_akun','disetujui')->count();
                        if($exitsPemuput == 0 && $exitsSerati == 0 && $exitsSanggar  == 0){
                            return redirect(route('krama.dashboard'));
                        }else{
                            return redirect()->route('select-account');
                        }
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


    // RESET PASSWORD
    public function resetPassword(Request $request)
    {
        return view('pages.auth.lupa-password.reset-password');
    }
    // RESET PASSWORD


    // RESET PASSWORD
    public function switchAccount($tipe)
    {

        // SECURITY
            $validator = Validator::make(['tipe'=> $tipe],[
                'tipe' => 'required|in:sanggar,serati,pemuput,krama',
            ],
            [
                'tipe.required' => "Tipe wajib diisi",
                'tipe.in' => "Tipe tidak sesuai ",
            ]);

        // END SECURITY

        // MAIN LOGIC
            try{
                switch ($tipe) {
                    case 'krama':
                        return redirect()->route('krama.dashboard')->with([
                            'status-switch'=> 'success',
                            'icon' => 'success',
                            'title' => 'Berhasil masuk sebagai Krama',
                        ]);
                        break;
                    case 'pemuput':
                        return redirect()->route('pemuput-karya.dashboard')->with([
                            'status-switch'=> 'success',
                            'icon' => 'success',
                            'title' => 'Berhasil masuk sebagai Pemuput',
                        ]);
                        break;
                    case 'serati':
                        return redirect()->route('krama.dashboard')->with([
                            'status-switch'=> 'success',
                            'icon' => 'success',
                            'title' => 'Berhasil masuk sebagai Serati',
                        ]);
                        break;
                    default:
                        return redirect()->route('krama.dashboard')->with([
                            'status-switch'=> 'success',
                            'icon' => 'success',
                            'title' => 'Berhasil masuk sebagai Krama',
                        ]);
                        break;
                }
            }catch(ModelNotFoundException | PDOException | ErrorException | QueryException | \Throwable | \Exception $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Login',
                    'message' => $err->getMessage()
                ]);
            }
        // END LOGIC

    }
    // RESET PASSWORD





}

