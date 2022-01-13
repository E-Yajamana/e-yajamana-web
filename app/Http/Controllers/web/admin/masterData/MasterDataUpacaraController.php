<?php

namespace App\Http\Controllers\web\admin\masterdata;

use App\Http\Controllers\Controller;
use App\Models\Upacara;
use App\ImageHelper;
use App\Models\TahapanUpacara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use PDOException;

class MasterDataUpacaraController extends Controller
{
    public function indexDataUpacara(Request $request)
    {
        $dataUpacara = Upacara::all();
        return view('pages.admin.master-data.upacara.master-upacara-index',compact(['dataUpacara']));
    }


    public function createDataUpacara(Request $request)
    {
        return view('pages.admin.master-data.upacara.master-upacara-create');
    }

    public function storeDataUpacara(Request $request)
    {
        //Input tanpan Tahapan
        DB::beginTransaction();
        $folder = 'app/admin/master-data/upacara/';
        $filename =  ImageHelper::moveImage($request->foto_upacara,$folder);
        Upacara::create([
            'nama_upacara' => $request->nama_upacara,
            'katagori_upacara' =>$request->katagori,
            'deskripsi_upacara' =>$request->deskripsi_upacara,
            'image' =>$filename,
        ]);
        DB::commit();

        return redirect()->back()->with([
            'status' => 'fail',
            'icon' => 'error',
            'title' => 'Gagal Mengambil Data Buku',
            'message' => 'Gagal Membuat Data Buku, apabila diperlukan mohon hubungi developer sistem`',
        ]);
        //Input Tanpa Tahapan

        // Input dengan Tahapan Upacara
            DB::beginTransaction();
            $folder = 'app/admin/master-data/upacara/';
            $filename =  ImageHelper::moveImage($request->foto_upacara,$folder);

            $upacara = Upacara::create([
                'nama_upacara' => $request->nama_upacara,
                'katagori_upacara' =>$request->katagori,
                'deskripsi_upacara' =>$request->deskripsi_upacara,
                'image' =>$filename,
            ]);

            foreach($request->dataTahapan as $data)
            {
                $filename =  ImageHelper::moveImage($data['foto_tahapan'],$folder);
                $upacara->TahapanUpacara()->create([
                    'nama_tahapan' => $data['nama_tahapan'],
                    'deskripsi_tahapan' => $data['desc_tahapan'],
                    'status_upacara' => $data['status'],
                    'image' => $filename,
                ]);
            }
            DB::commit();
        // Input dengan Tahapan Upacara




    }

}
