<?php

namespace App\Http\Controllers\web\admin\masterdata;

use App\Http\Controllers\Controller;
use App\Models\Upacara;
use App\ImageHelper;
use App\Models\DetailReservasi;
use App\Models\TahapanUpacara;
use App\Models\Upacaraku;
use ErrorException;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Mockery\Expectation;
use PDOException;

class MasterDataUpacaraController extends Controller
{

    // INDEX VIEW DATA UPACARA
    public function indexDataUpacara(Request $request)
    {
        $dataUpacara = Upacara::all();
        return view('pages.admin.master-data.upacara.master-upacara-index',compact(['dataUpacara']));
    }
    // INDEX VIEW DATA UPACARA

    // CREATE DATA UPACARA
    public function createDataUpacara(Request $request)
    {
        return view('pages.admin.master-data.upacara.master-upacara-create');
    }
    // CREATE DATA UPACARA

    // STORE DATA UPACARA
    public function storeDataUpacara(Request $request)
    {
        if($request->dataTahapan == null)
        {
            // SECURITY
                $validator = Validator::make($request->all(),[
                    'nama_upacara' => 'required|regex:/^[a-z,. 0-9]+$/i|unique:tb_upacara,nama_upacara|min:5|max:50',
                    'katagori' => 'required|in:Dewa Yadnya,Pitra Yadnya,Manusa Yadnya,Rsi Yadnya,Bhuta Yadnya',
                    // 'foto_upacara' => 'required|image|mimes:png,jpg,jpeg|max:2500',
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
                    // 'foto_upacara.required' => "Gambar upacara wajib diisi",
                    // 'foto_upacara.image' => "Gambar harus berupa foto",
                    // 'foto_upacara.mimes' => "Format gambar harus jpeg, png atau jpg",
                    // 'foto_upacara.size' => "Gambar maksimal berukuran 2.5 Mb",
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
                    $filename = null;
                    if($request->foto_upacara != null || $request->foto_upacara != ''){
                        $folder = 'app/admin/master-data/upacara/';
                        $filename =  ImageHelper::moveImage($request->foto_upacara,$folder);
                    }
                    Upacara::create([
                        'nama_upacara' => $request->nama_upacara,
                        'kategori_upacara' =>$request->katagori,
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
                $validator = Validator::make($request->all(),[
                    'nama_upacara' => 'required|regex:/^[a-z,. 0-9]+$/i|unique:tb_upacara,nama_upacara|min:5|max:50',
                    'katagori' => 'required|in:Dewa Yadnya,Pitra Yadnya,Manusa Yadnya,Rsi Yadnya,Bhuta Yadnya',
                    // 'foto_upacara' => 'required|image|mimes:png,jpg,jpeg|max:2500',
                    'deskripsi_upacara' => 'required|min:8|max:1000',

                    'dataTahapan.*.nama_tahapan' => 'required',
                    'dataTahapan.*.desc_tahapan' => 'required',
                    'dataTahapan.*.status' => 'required',
                    // 'dataTahapan.*.foto_tahapan' => 'required',

                ],
                [
                    'nama_upacara.required' => "Nama upacara wajib diisi",
                    'nama_upacara.regex' => "Format nama upacara tidak sesuai",
                    'nama_upacara.min' => "Nama upacara minimal berjumlah 5 karakter",
                    'nama_upacara.max' => "Nama upacara maksimal berjumlah 50 karakter",
                    'nama_upacara.unique' => "Nama Upacara sudah pernah dibuat sebelumnya",
                    'katagori.required' => "Katagori upacara wajib diisi",
                    'katagori.in' => "Katagori Upacara tidak sesuai ",
                    // 'foto_upacara.required' => "Gambar upacara wajib diisi",
                    // 'foto_upacara.image' => "Gambar harus berupa foto",
                    // 'foto_upacara.mimes' => "Format gambar harus jpeg, png atau jpg",
                    // 'foto_upacara.size' => "Gambar maksimal berukuran 2.5 Mb",
                    'deskripsi_upacara.required' => "Deskripsi upacara wajib diisi",
                    'deskripsi_upacara.min' => "Deskripsi upacara minimal berjumlah 5 karakter",
                    'deskripsi_upacara.max' => "Deskripsi upacara maksimal berjumlah 50 karakter",
                    'dataTahapan' => "Data tahapan upacara wajib diisi"
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
                DB::beginTransaction();
                $filename = null;
                if($request->foto_upacara != null || $request->foto_upacara != ''){
                    $folder = 'app/admin/master-data/upacara/';
                    $filename =  ImageHelper::moveImage($request->foto_upacara,$folder);
                }
                $upacara = Upacara::create([
                    'nama_upacara' => $request->nama_upacara,
                    'kategori_upacara' =>$request->katagori,
                    'deskripsi_upacara' =>$request->deskripsi_upacara,
                    'image' =>$filename,
                ]);

                $tahapanUpacara = [];
                foreach($request->dataTahapan as $data)
                {
                    $filenameTahapan = null;
                    if(array_key_exists('foto_tahapan',$data)){
                        $folder = 'app/admin/master-data/upacara/tahapan/';
                        $filenameTahapan =  ImageHelper::moveImage($data['foto_tahapan'],$folder);
                    }
                    $tahapanUpacara[] = new TahapanUpacara([
                        'nama_tahapan' => $data['nama_tahapan'],
                        'deskripsi_tahapan' => $data['desc_tahapan'],
                        'status_tahapan' => $data['status'],
                        'image' => $filenameTahapan,
                    ]);
                }
                $upacara->TahapanUpacara()->saveMany($tahapanUpacara);
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
    // STORE DATA UPACARA

    // DETAIL DATA UPACARA
    public function detailDataUpacara(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_upacara,id',
            ]);

            if($validator->fails()){
                return redirect()->route('admin.master-data.upacara.detail')->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Upacara Tidak Ditemukan !',
                    'message' => 'Data Upacara tidak ditemukan, pilihlah data dengan benar !',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                $dataUpacara = Upacara::with(['TahapanUpacara'])->findOrFail($request->id);
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return \redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Sistem Gagal Menemukan Upacara !',
                    'message' => 'sistem gagal menemukan Upacara, mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END MAIN LOGIC

        // RETURN
            return view('pages.admin.master-data.upacara.master-upacara-detail', compact(['dataUpacara']));
        // END RETURN
    }
    // DETAIL DATA UPACARA

    // DETAIL DATA UPACARA
    public function editDataUpacara(Request $request)
    {
         // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_upacara,id',
            ]);

            if($validator->fails()){
                return redirect()->route('admin.master-data.upacara.detail')->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Upacara Tidak Ditemukan !',
                    'message' => 'Data griya tidak ditemukan, pilihlah data dengan benar !',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                $dataUpacara = Upacara::with(['TahapanUpacara'])->findOrFail($request->id);;
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return \redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Sistem Gagal Menemukan Data Upacara !',
                    'message' => 'sistem gagal menemukan Data Upacara, mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END MAIN LOGIC

        // RETURN
            return view('pages.admin.master-data.upacara.master-upacara-edit', compact(['dataUpacara']));
        // END RETURN
    }
    // DETAIL DATA UPACARA

    // UPDATE UPACARA
    public function updateUpacara(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'id' => 'required|exists:tb_upacara,id',
                'nama_upacara' => 'required|regex:/^[a-z,. 0-9]+$/i|min:5|max:50',
                'kategori_upacara' => 'required|in:Dewa Yadnya,Pitra Yadnya,Manusa Yadnya,Rsi Yadnya,Bhuta Yadnya',
                'deskripsi_upacara' => 'required|min:8|max:1000',
            ],
            [
                'id.required' => "ID Wajib diisi",
                'id.exists' =>"ID Tidak sesuai pada sistem",
                'nama_upacara.required' => "Nama upacara wajib diisi",
                'nama_upacara.regex' => "Format nama upacara tidak sesuai",
                'nama_upacara.min' => "Nama upacara minimal berjumlah 5 karakter",
                'nama_upacara.max' => "Nama upacara maksimal berjumlah 50 karakter",
                'nama_upacara.unique' => "Nama Upacara sudah pernah dibuat sebelumnya",
                'kategori_upacara.required' => "Katagori upacara wajib diisi",
                'kategori_upacara.in' => "Katagori Upacara tidak sesuai ",
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
                    'title' => 'Gagal Mengubah Data Upacara',
                    'message' => 'Gagal mengubah data upacara ke dalam sistem,harap kembali memeriksa form input anda'
                ])->withInput($request->all())->withErrors($validator->errors());
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                if($request->foto_upacara == null){
                    DB::beginTransaction();
                    Upacara::findOrFail($request->id)->update([
                        'nama_upacara' => $request->nama_upacara,
                        'kategori_upacara' =>$request->kategori_upacara,
                        'deskripsi_upacara' =>$request->deskripsi_upacara,
                    ]);
                    DB::commit();
                }else{
                    DB::beginTransaction();
                    $dataUpacara = Upacara::findOrFail($request->id);
                    File::delete(storage_path($dataUpacara->image));
                    $folder = 'app/admin/master-data/upacara/';
                    $filename =  ImageHelper::moveImage($request->foto_upacara,$folder);
                    $dataUpacara->update([
                        'nama_upacara' => $request->nama_upacara,
                        'kategori_upacara' =>$request->kategori_upacara,
                        'deskripsi_upacara' =>$request->deskripsi_upacara,
                        'image' =>$filename,
                    ]);
                    DB::commit();
                }
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                DB::rollBack();
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Mengubah Data Upacara',
                    'message' => 'Gagal mengubah data upacara, apabila diperlukan mohon hubungi developer sistem`',
                ]);
            }
        // END LOGIC

        //  RETURN
            return redirect()->route('admin.master-data.upacara.detail',$request->id)->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Mengubah Data Upacara',
                'message' => 'Berhasil mengubah data upacara, mohon diperiksa kembali',
            ]);
        // END RETURN

    }
    // UPDATE UPACARA

    // DELETE UPACARA
    public function deleteUpacara(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_upacara,id',
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Hapus Data Gagal',
                    'message' => 'Hapus data gagal, tidak terdapat data yang akan dihapus!',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                $upacaraku = Upacaraku::where('id_upacara',$request->id)->count();
                if($upacaraku != 0){
                    return redirect()->back()->with([
                        'status' => 'fail',
                        'icon' => 'error',
                        'title' => 'Hapus Data Gagal!',
                        'message' => 'Hapus data gagal, data upacara sedang digunakan pada sistem!'
                    ]);
                }else{
                    $upacara = Upacara::findOrFail($request->id);
                    File::delete(storage_path($upacara->image));
                    $upacara->delete();
                }
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                return redirect()->back()->with([
                    'status' => 'success',
                    'icon' => 'success',
                    'title' => 'Hapus Data Gagal!',
                    'message' => 'Hapus data gagal, mohon hubungi developer untuk lebih lanjut!!'
                ]);
            }
        // END LOGIC

        // RETURN
            return redirect()->back()->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Menghapus Data Upacara',
                'message' => 'Data Upacara berhasil terhapus dari sistem'
            ]);
        // END RETURN
    }
    // DELETE UPACARA


    // ==========> FUNCTION TAHAPAN UPACARA <========== //


    // STORE TAHAPAN UPACARA
    public function storeTahapanUpacara(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'id_upacara' => 'required|exists:tb_upacara,id',
                'nama_tahapan' => 'required|min:5|max:50',
                'status' => 'required|in:awal,puncak,akhir',
                // 'file' => 'required|image|mimes:png,jpg,jpeg|max:2500',
                'deskripsi' => 'required|min:8|max:1000',
            ],
            [
                'id_upacara.required' => "ID Upacara wajib diisi",
                'id_upacara.exists' => "Upacara tidak dapat ditemukan",
                'nama_tahapan.required' => "Nama upacara wajib diisi",
                'nama_tahapan.min' => "Nama upacara minimal berjumlah 5 karakter",
                'nama_tahapan.max' => "Nama upacara maksimal berjumlah 50 karakter",
                'nama_tahapan.unique' => "Nama Upacara sudah pernah dibuat sebelumnya",
                'status.required' => "Status upacara wajib diisi",
                'status.in' => "Status Upacara tidak sesuai ",
                // 'file.required' => "Gambar tahapan upacara wajib diisi",
                // 'file.image' => "Gambar tahapan harus berupa foto",
                // 'file.mimes' => "Format gambar tahapan harus jpeg, png atau jpg",
                // 'file.size' => "Gambar tahapan maksimal berukuran 2.5 Mb",
                'deskripsi.required' => "Deskripsi upacara wajib diisi",
                'deskripsi.min' => "Deskripsi upacara minimal berjumlah 5 karakter",
                'deskripsi.max' => "Deskripsi upacara maksimal berjumlah 50 karakter",
            ]);
            if($validator->fails()){
                return response()->json([
                    'status' => 400,
                    'message' => 'Gagal Menginput Data',
                    'error' => $validator->errors()
                ],400);
            }
        // END SECURITY

        // MAIN LOGIC
            DB::beginTransaction();
            $filename = null;
            if($request->file != null){
                $folder = 'app/admin/master-data/upacara/tahapan/';
                $filename =  ImageHelper::moveImage($request->file,$folder);
            }
            $upacara = TahapanUpacara::create([
                'id_upacara' => $request->id_upacara,
                'nama_tahapan' => $request->nama_tahapan,
                'status_tahapan' =>$request->status,
                'deskripsi_tahapan' =>$request->deskripsi,
                'image' =>$filename,
            ]);
            DB::commit();
        // END LOGIC

        // RETURN
            return response()->json([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Menambahkan Tahapan Upacara',
                'message' => 'Data Tahapan Upacara berhasil ditambahkan dari sistem',
                'data' => $upacara
            ],200);
        // END RETURN

    }
    // STORE TAHAPAN UPACARA

    // UPDATE TAHAPAN UPACARA
    public function updateTahapanUpacara(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'id' => 'required|exists:tb_tahapan_upacara,id',
                'nama_tahapan' => 'required|min:5|max:50',
                'status' => 'required|in:awal,puncak,akhir',
                'deskripsi' => 'required|min:8|max:1000',
            ],
            [
                'id.required' => "ID Tahapan Upacara wajib diisi",
                'id.exists' => "Upacara Tahapan tidak dapat ditemukan",
                'nama_tahapan.required' => "Nama upacara wajib diisi",
                'nama_tahapan.min' => "Nama upacara minimal berjumlah 5 karakter",
                'nama_tahapan.max' => "Nama upacara maksimal berjumlah 50 karakter",
                'nama_tahapan.unique' => "Nama Upacara sudah pernah dibuat sebelumnya",
                'status.required' => "Status upacara wajib diisi",
                'status.in' => "Status Upacara tidak sesuai ",
                'file.required' => "Gambar tahapan upacara wajib diisi",
                'file.image' => "Gambar tahapan harus berupa foto",
                'file.mimes' => "Format gambar tahapan harus jpeg, png atau jpg",
                'file.size' => "Gambar tahapan maksimal berukuran 2.5 Mb",
                'deskripsi.required' => "Deskripsi upacara wajib diisi",
                'deskripsi.min' => "Deskripsi upacara minimal berjumlah 5 karakter",
                'deskripsi.max' => "Deskripsi upacara maksimal berjumlah 50 karakter",
            ]);
            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Mengubah Data Tahapan Upacara',
                    'message' => 'Gagal Mengubah data tahapan upacara ke dalam sistem,harap kembali memeriksa form input anda'
                ])->withInput($request->all())->withErrors($validator->errors());
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                if($request->file == null){
                    DB::beginTransaction();
                    TahapanUpacara::findOrFail($request->id)->update([
                        'nama_tahapan' => $request->nama_tahapan,
                        'status_tahapan' =>$request->status,
                        'deskripsi_tahapan' =>$request->deskripsi,
                    ]);
                    DB::commit();
                }else{
                    DB::beginTransaction();
                    $dataTahapanUpacara = TahapanUpacara::findOrFail($request->id);
                    File::delete(storage_path($dataTahapanUpacara->image));
                    $folder = 'app/admin/master-data/upacara/tahapan/';
                    $filename =  ImageHelper::moveImage($request->file,$folder);
                    $dataTahapanUpacara->update([
                        'nama_upacara' => $request->nama_upacara,
                        'status_tahapan' =>$request->status,
                        'deskripsi_tahapan' =>$request->deskripsi,
                        'image' =>$filename,
                    ]);
                    DB::commit();
                }
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                DB::rollBack();
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Mengubah Data Tahapan Upacara',
                    'message' => 'Gagal mengubah data Tahapan upacara, apabila diperlukan mohon hubungi developer sistem`',
                ]);
            }
        // END MAIN LOGIC

        // RETURN
            return redirect()->back()->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Mengubah Tahapan Upacara',
                'message' => 'Data Tahapan Upacara berhasil diubah dari sistem'
            ]);
        // END RETURN

    }
    // UPDATE TAHAPAN UPACARA

    // DELETE TAHAPAN UPACARA
    public function deleteTahapanUpacara(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_tahapan_upacara,id',
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Hapus Data Gagal',
                    'message' => 'Hapus data gagal, tidak terdapat data yang akan dihapus!',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                $dataInDetailReservasi = DetailReservasi::where('id_tahapan_upacara',$request->id)->count();
                if($dataInDetailReservasi != 0){
                    return redirect()->back()->with([
                        'status' => 'fail',
                        'icon' => 'error',
                        'title' => 'Hapus Data Gagal!',
                        'message' => 'Hapus data gagal, data tahapan upacara sedang digunakan pada sistem!'
                    ]);
                }else{
                    $dataTahapan = TahapanUpacara::findOrFail($request->id);
                    File::delete(storage_path($dataTahapan->image));
                    $dataTahapan->delete();
                }
            }catch(ModelNotFoundException $err){
                return redirect()->back()->with([
                    'status' => 'success',
                    'icon' => 'success',
                    'tittle' => 'Hapus Data Gagal!',
                    'message' => 'Hapus data gagal, mohon hubungi developer untuk lebih lanjut!!'
                ]);
            }
        // END LOGIC

        // RETURN
            return redirect()->route('admin.master-data.upacara.index')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Menghapus Data Tahapan Upacara',
                'message' => 'Data Tahapan Upacara berhasil terhapus dari sistem'
            ]);
        // END RETURN
    }
    // DELETE TAHAPAN UPACARA

    // DETAIL DATA UPACARA
    public function detailTahapanUpacara(Request $request)
    {
         // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_tahapan_upacara,id',
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Tahapan Upacara Tidak Ditemukan !',
                    'message' => 'Data  Tahapan tidak ditemukan, pilihlah data dengan benar !',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                $dataTahapan = TahapanUpacara::with('Upacara')->findOrFail($request->id);
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return \redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Sistem Gagal Menemukan Data Griya !',
                    'message' => 'sistem gagal menemukan Data Griya, mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END MAIN LOGIC

        // RETURN
            return view('pages.admin.master-data.upacara.master-upacara-detail-tahapan', compact(['dataTahapan']));
        // END RETURN
    }
    // DETAIL DATA UPACARA

}
