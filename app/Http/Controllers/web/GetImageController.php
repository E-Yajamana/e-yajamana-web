<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ImageHelper;
use App\Models\PemuputKarya;
use App\Models\TahapanUpacara;
use App\Models\AtributPemuput;
use App\Models\Upacara;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Mockery\Expectation;
use Illuminate\Support\Facades\Validator;

class GetImageController extends Controller
{

    // PROFILE
    public function profile($id)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$id],[
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
                $path = User::findOrFail($id)->user_profile;
                return ImageHelper::getImage($path);
            }catch(\Exception | ModelNotFoundException $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Mengambil Gambar',
                    'message' => 'Gagal Membuat Gambar, apabila diperlukan mohon hubungi developer sistem`',
                ]);
            }
        // END LOGIC
    }
    // PROFILE

    // SK KESULINGGIHAN
    public function skPemuput($id)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$id],[
                'id' => 'required|exists:tb_atribut_pemuput,id',
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
                $path = AtributPemuput::findOrFail($id)->sk_pemuput;
                return ImageHelper::getImage($path);
            }catch(\Exception | ModelNotFoundException $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Mengambil Gambar',
                    'message' => 'Gagal Membuat Gambar, apabila diperlukan mohon hubungi developer sistem`',
                ]);
            }
        // END LOGIC
    }
    // SK KESULINGGIHAN


    // UPACARA
    public function upacara($id)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$id],[
                'id' => 'required|exists:tb_upacara,id',
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Mengambil Gambar Upacara',
                    'message' => 'Gagal Mengambil Gambar Upacara, Terdapat kendala pada sistem !!',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                $path = Upacara::findOrFail($id)->image;
                return ImageHelper::getImage($path);
            }catch(\Exception | ModelNotFoundException $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Mengambil Gambar Upacara',
                    'message' => 'Gagal Membuat Gambar Upacara, apabila diperlukan mohon hubungi developer sistem`',
                ]);
            }
        // END LOGIC
    }
    // UPACARA

    // TAHAPAN UPACARA
    public function tahapanUpacara($id)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$id],[
                'id' => 'required|exists:tb_tahapan_upacara,id',
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Mengambil Gambar Upacara',
                    'message' => 'Gagal Mengambil Gambar Upacara, Terdapat kendala pada sistem !!',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                $path = TahapanUpacara::findOrFail($id)->image;
                return ImageHelper::getImage($path);
            }catch(\Exception | ModelNotFoundException $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Mengambil Gambar Upacara',
                    'message' => 'Gagal Membuat Gambar Upacara, apabila diperlukan mohon hubungi developer sistem`',
                ]);
            }
        // END LOGIC
       }
       // TAHAPAN UPACARA






}
