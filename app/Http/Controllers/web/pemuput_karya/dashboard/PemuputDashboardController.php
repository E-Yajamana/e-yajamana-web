<?php

namespace App\Http\Controllers\web\pemuput_karya\dashboard;

use App\Http\Controllers\Controller;
use App\ImageHelper;
use App\Models\Sulinggih;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Mockery\Expectation;
use Illuminate\Support\Facades\Validator;

class PemuputDashboardController extends Controller
{
    // VIEW DASHBOARD PEMUPUT KARYA
    public function index(Request $requests)
    {
        return view('pages.pemuput-karya.dashboard');
    }
    // VIEW DASHBOARD PEMUPUT KARYA

    // GET IMAGE PROFILE SULINGGIH
     public function getProfilePemuput(Request $request)
     {
         // SECURITY
             $validator = Validator::make(['id' =>$request->id],[
                 'id' => 'required|exists:tb_user_eyajamana,id',
             ]);

             if($validator->fails()){
                 return redirect()->back()->with([
                     'status' => 'fail',
                     'icon' => 'error',
                     'title' => 'Gagal Mengambil Gambar',
                     'message' => 'Gagal Mengambil Gambar, Terdapat kendala pada sistem !!',
                 ]);
             }
         // END SECURITY

         // MAIN LOGIC
             try{
                 $path = User::findOrFail($request->id)->user_profile;
                 return ImageHelper::getImage($path);
             }catch(Expectation | ModelNotFoundException $err){
                 return redirect()->back()->with([
                     'status' => 'fail',
                     'icon' => 'error',
                     'title' => 'Gagal Mengambil Gambar',
                     'message' => 'Gagal Membuat Gambar, apabila diperlukan mohon hubungi developer sistem`',
                 ]);
             }
         // END LOGIC
     }
    // GET IMAGE PROFILE SULINGGIH

    public function calenderIndex(Request $request)
    {
        return view('pages.pemuput-karya.calender.pemuput-calender');
    }


}
