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

        if($request->dataTahapan == null)
        {
            // SECURITY
                $validator = Validator::make($request->all(),[
                    'nama_upacara' => 'required|regex:/^[a-z,. 0-9]+$/i|unique:tb_upacara,nama_upacara|min:5|max:50',
                    'katagori' => 'required|in:Dewa Yadnya,Pitra Yadnya,Manusa Yadnya,Rsi Yadnya,Bhuta Yadnya',
                    'foto_upacara' => 'required|image|mimes:png,jpg,jpeg|max:2500',
                    'deskripsi_upacara' => 'required|min:8|max:1000',
                ],
                [
                    'nama_upacara.required' => "Nama upacara wajib diisi",
                    'nama_upacara.regex' => "Format nama upacara tidak sesuai",
                    'nama_upacara.min' => "Nama upacara minimal berjumlah 5 karakter",
                    'nama_upacara.max' => "Nama upacara maksimal berjumlah 50 karakter",
                    'nama_upacara.unique' => "Nama Upacara sudah pernah dibuat sebelumnya",
                    'katagori.required' => "Katagori upacara wajib diisi",
                    'katagori.in' => "Katagori Upacara tidak sesuai ",
                    'foto_upacara.required' => "Gambar upacara wajib diisi",
                    'foto_upacara.image' => "Gambar harus berupa foto",
                    'foto_upacara.mimes' => "Format gambar harus jpeg, png atau jpg",
                    'foto_upacara.size' => "Gambar maksimal berukuran 2.5 Mb",
                    'deskripsi_upacara.required' => "Deskripsi upacara wajib diisi",
                    'deskripsi_upacara.min' => "Deskripsi upacara minimal berjumlah 5 karakter",
                    'deskripsi_upacara.max' => "Deskripsi upacara maksimal berjumlah 50 karakter",
                ]);
                if($validator->fails()){
                    return redirect()->back()->with([
                        'status' => 'fail',
                        'icon' => 'error',
                        'title' => 'Gagal Menambahkan Data Upacara',
                        'message' => 'Gagal menambahkan data upacara ke dalam sistem,harap kembali memeriksa form input anda'
                    ])->withInput($request->all())->withErrors($validator->errors());
                }
            // END SECURITY

            // MAIN LOGIC
                try{
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
                }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                    DB::rollBack();
                    return redirect()->back()->with([
                        'status' => 'fail',
                        'icon' => 'error',
                        'title' => 'Gagal Menambahkan Data Upacara',
                        'message' => 'Gagal menambahkan data upacara, apabila diperlukan mohon hubungi developer sistem`',
                    ]);
                }
            // END LOGIC

            //  RETURN
                return redirect()->route('admin.master-data.upacara.index')->with([
                    'status' => 'success',
                    'icon' => 'success',
                    'title' => 'Berhasil Membuat Data Upacara',
                    'message' => 'Berhasil membuat data upacara, mohon diperiksa kembali',
                ]);
            // END RETURN

        }else{
            // SECURITY
                // dd($request->dataTahapan);
                $validator = Validator::make($request->all(),[
                    'nama_upacara' => 'required|regex:/^[a-z,. 0-9]+$/i|unique:tb_upacara,nama_upacara|min:5|max:50',
                    'katagori' => 'required|in:Dewa Yadnya,Pitra Yadnya,Manusa Yadnya,Rsi Yadnya,Bhuta Yadnya',
                    'foto_upacara' => 'required|image|mimes:png,jpg,jpeg|max:2500',
                    'deskripsi_upacara' => 'required|min:8|max:1000',

                    'dataTahapan.*.nama_tahapan' => 'required|min:5|max:50',
                    'dataTahapan.*.desc_tahapan' => 'required|min:8|max:1000',
                    'dataTahapan.*.status' => 'required|in:awal,puncak,akhir',
                    'dataTahapan.*.foto_tahapan' => 'required|image|mimes:png,jpg,jpeg|max:2500',

                ],
                [
                    'nama_upacara.required' => "Nama upacara wajib diisi",
                    'nama_upacara.regex' => "Format nama upacara tidak sesuai",
                    'nama_upacara.min' => "Nama upacara minimal berjumlah 5 karakter",
                    'nama_upacara.max' => "Nama upacara maksimal berjumlah 50 karakter",
                    'nama_upacara.unique' => "Nama Upacara sudah pernah dibuat sebelumnya",
                    'katagori.required' => "Katagori upacara wajib diisi",
                    'katagori.in' => "Katagori Upacara tidak sesuai ",
                    'foto_upacara.required' => "Gambar upacara wajib diisi",
                    'foto_upacara.image' => "Gambar harus berupa foto",
                    'foto_upacara.mimes' => "Format gambar harus jpeg, png atau jpg",
                    'foto_upacara.size' => "Gambar maksimal berukuran 2.5 Mb",
                    'deskripsi_upacara.required' => "Deskripsi upacara wajib diisi",
                    'deskripsi_upacara.min' => "Deskripsi upacara minimal berjumlah 5 karakter",
                    'deskripsi_upacara.max' => "Deskripsi upacara maksimal berjumlah 50 karakter",
                    'dataTahapan' => "Data tahapan upacara wajib diisi"
                ]);
                if($validator->fails()){
                    return redirect()->back()->with([
                        'status' => 'fail',
                        'icon' => 'error',
                        'dataTahapan' => $request->dataTahapan,
                        'title' => 'Gagal Menambahkan Data Upacara',
                        'message' => 'Gagal menambahkan data upacara ke dalam sistem,harap kembali memeriksa form input anda'
                    ])->withInput($request->all())->withErrors($validator->errors());
                }
            // END SECURITY

            // MAIN LOGIC
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
            // END LOGIC

            //  RETURN
                return redirect()->route('admin.master-data.upacara.index')->with([
                    'status' => 'success',
                    'icon' => 'success',
                    'title' => 'Berhasil Membuat Data Upacara',
                    'message' => 'Berhasil membuat data upacara, mohon diperiksa kembali',
                ]);
            // END RETURN

        }

    }

}
