<?php

namespace App\Http\Controllers\web\admin\manajemen_akun;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Sulinggih;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ManajemenAkunController extends Controller
{
    public function indexVerifikasi(Request $request)
    {
        $dataSulinggih = Sulinggih::where('status_konfirmasi_akun','pending')->get();
        return view('pages.admin.manajemen-akun.pengaturan-akun.verifikasi-akun-index',compact('dataSulinggih'));
    }

    public function detailVerifikasi(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_sulinggih,id',
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Sulinggih Tidak Ditemukan',
                    'message' => 'Data sulinggih tidak dapat ditemukan di dalam sistem',
                ]);
            }
        // END

        // MAIN LOGIC
            try{
                $dataSulinggih = Sulinggih::findOrFail($request->id);
            }catch(ModelNotFoundException | Exception $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Peminjam Tidak Ditemukan',
                    'message' => 'Data Peminjam tidak ditemukan di dalam sistem',
                ]);
            }
        // END

        // RETURN
            return view('pages.admin.manajemen-akun.pengaturan-akun.verifikasi-akun-detail',compact('dataSulinggih'));
        // END RETURN

    }




}
