<?php

namespace App\Http\Controllers\web\admin\masterData;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Monolog\Handler\IFTTTHandler;
use PDOException;

class MasterDataLayananController extends Controller
{
    // INDEX
    public function index()
    {
        $services = Service::latest()->get();
        return view('pages.admin.master-data.master-layanan-index',compact('services'));
    }
    // INDEX

    // UPDATE OR CREATE
    public function storeOrUpdate(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'nama_service' => 'required|regex:/^[a-z,. 0-9]+$/i|unique:tb_service,nama_service|min:5|max:50',
                'deskripsi_service' => 'required|min:8|max:1000',
            ],
            [
                'nama_service.required' => "Nama service sanggar wajib diisi",
                'nama_service.regex' => "Format nama service sanggar tidak sesuai",
                'nama_service.min' => "Nama service sanggar minimal berjumlah 5 karakter",
                'nama_service.max' => "Nama service sanggar maksimal berjumlah 50 karakter",
                'nama_service.unique' => "Nama service sanggar sudah pernah dibuat sebelumnya",
                'deskripsi_service.required' => "Deskripsi service sanggar wajib diisi",
                'deskripsi_service.min' => "Deskripsi service sanggar minimal berjumlah 5 karakter",
                'deskripsi_service.max' => "Deskripsi service sanggar maksimal berjumlah 50 karakter",
            ]);
            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Validasi Error',
                    'message' => 'Validasi form error,harap kembali memeriksa form input anda'
                ])->withInput($request->all())->withErrors($validator->errors());
            }
        // END SECURITY

        // MAIN
            try{
                DB::beginTransaction();
                Service::updateOrCreate(
                    ['id' => $request->id],
                    ['nama_service' => $request->nama_service,'deskripsi_service' => $request->deskripsi_service]
                );
                if($request->id != null){
                    $message = "Diperbarui";
                }else{
                    $message = "Dibuat";
                }
                DB::commit();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                DB::rollBack();
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Error',
                    'message' => 'Service Sanggar Gagal '.$message.', apabila diperlukan mohon hubungi developer sistem`',
                ]);
            }
        // END MAIN

        // RETURN
            return redirect()->route('admin.master-data.service-sanggar')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Service Sanggar Berhasil '.$message,
                'message' => 'Service Sanggar berhasil '.$message.', data terbaru dapat dilihat pada menu jenis service sanggar',
            ]);
        //END

    }
    // UPDATE OR CREATE


    // DELETE
    public function delete(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_service,id',
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
                Service::findOrFail($request->id)->delete();
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
                'title' => 'Berhasil Menghapus Data Jenis Service Sanggar',
                'message' => 'Data Jenis Service Sanggar berhasil terhapus dari sistem'
            ]);
        // END RETURN

    }
    // DELETE
}
