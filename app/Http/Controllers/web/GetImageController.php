<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ImageHelper;
use App\Models\TahapanUpacara;
use App\Models\Upacara;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Mockery\Expectation;
use Illuminate\Support\Facades\Validator;

class GetImageController extends Controller
{

    // GET IMAGE TB_UPACARA
    public function getImageUpacara(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
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
                $path = Upacara::findOrFail($request->id)->image;
                return ImageHelper::getImage($path);
            }catch(Expectation | ModelNotFoundException $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Mengambil Gambar Upacara',
                    'message' => 'Gagal Membuat Gambar Upacara, apabila diperlukan mohon hubungi developer sistem`',
                ]);
            }
        // END LOGIC
    }
    // GET IMAGE TB_UPACARA

    // GET IMAGE TB_TAHAPAN_UPACARA
    public function getImageTahapanUpacara(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_tahapan_upacara,id',
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Mengambil Gambar Tabapan Upacara',
                    'message' => 'Gagal Mengambil Gambar Tahapan Upacara, Terdapat kendala pada sistem !!',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                $path = TahapanUpacara::findOrFail($request->id)->image;
                return ImageHelper::getImage($path);
            }catch(Expectation | ModelNotFoundException $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Mengambil Gambar Upacara',
                    'message' => 'Gagal Membuat Gambar Upacara, apabila diperlukan mohon hubungi developer sistem`',
                ]);
            }
        // END LOGIC
    }
    // GET IMAGE TB_UPACARA
}
