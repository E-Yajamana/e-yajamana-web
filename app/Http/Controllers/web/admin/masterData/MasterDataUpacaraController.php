<?php

namespace App\Http\Controllers\web\admin\masterdata;

use App\Http\Controllers\Controller;
use App\Models\Upacara;
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
        $validator = Validator::make($request->all(),[
            'dataTahapan.*.nama_tahapan' => 'required',
            'dataTahapan.*.desc_tahapan' => 'required',
            'dataTahapan.*.status' => 'required',
            'dataTahapan.*.foto_tahapan' => 'required',
        ]);


        if($validator->fails()){
            return redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Gagal Menambahkan Data Upacara',
                'message' => 'Gagal menambahkan data upacara ke dalam sistem,harap kembali memeriksa form input anda'
            ])->withInput($request->all())->withErrors($validator->errors());
        }


        dd($request->all());

        $dataTahapanUpacara = $request->only('nama_tahapan','desc_tahapan','status','foto_tahapan');
        // dd($dataTahapanUpacara);

        if($dataTahapanUpacara == null){
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

        }else{
            // SECURITY
                $validator = Validator::make($request->all(),[
                    'nama_tahapan' => 'required',
                    'desc_tahapan' => 'required',
                    'status' => 'required',
                    'foto_tahapan' => 'required',

                    // 'nama_upacara' => 'required|regex:/^[a-z,. 0-9]+$/i|unique:tb_upacara,nama_upacara|min:5|max:50',
                    // 'katagori' => 'required|in:Dewa Yadnya,Pitra Yadnya,Manusa Yadnya,Rsi Yadnya,Bhuta Yadnya',
                    // 'foto_upacara' => 'required|image|mimes:png,jpg,jpeg|max:2500',
                    // 'deskripsi_upacara' => 'required|min:8|max:1000',
                ],
                [
                    // 'nama_upacara.required' => "Nama upacara wajib diisi",
                    // 'nama_upacara.regex' => "Format nama upacara tidak sesuai",
                    // 'nama_upacara.min' => "Nama upacara minimal berjumlah 5 karakter",
                    // 'nama_upacara.max' => "Nama upacara maksimal berjumlah 50 karakter",
                    // 'nama_upacara.unique' => "Nama Upacara sudah pernah dibuat sebelumnya",
                    // 'katagori.required' => "Katagori upacara wajib diisi",
                    // 'katagori.in' => "Katagori Upacara tidak sesuai ",
                    // 'foto_upacara.required' => "Gambar upacara wajib diisi",
                    // 'foto_upacara.image' => "Gambar harus berupa foto",
                    // 'foto_upacara.mimes' => "Format gambar harus jpeg, png atau jpg",
                    // 'foto_upacara.size' => "Gambar maksimal berukuran 2.5 Mb",
                    // 'deskripsi_upacara.required' => "Deskripsi upacara wajib diisi",
                    // 'deskripsi_upacara.min' => "Deskripsi upacara minimal berjumlah 5 karakter",
                    // 'deskripsi_upacara.max' => "Deskripsi upacara maksimal berjumlah 50 karakter",

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
        }



        // MAIN LOGIC
            try{
                DB::beginTransaction();
                Upacara::create([
                    'peminjam_id' => $request->peminjam,
                    'status' =>'masih meminjam',
                    'tanggal' =>now()
                ])->bukus()->attach($request->buku,['status'=>'Masih dipinjam']);



                DB::commit();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                DB::rollBack();
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Menambahkan Transaksi Peminjaman',
                    'message' => 'Gagal Gagal Menambahkan Transaksi Peminjaman, apabila diperlukan mohon hubungi developer sistem`',
                ]);
            }
        // END LOGIC

    }

}
