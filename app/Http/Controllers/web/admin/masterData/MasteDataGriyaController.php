<?php

namespace App\Http\Controllers\web\admin\masterData;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\DesaAdat;
use App\Models\DesaDinas;
use App\Models\GriyaRumah;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Sulinggih;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use PDOException;

class MasteDataGriyaController extends Controller
{
    // INDEX VIEW DATA LOKASI GRIYA
    public function indexDataGriya(Request $request)
    {
        $dataGriya = GriyaRumah::all();
        return view('pages.admin.master-data.griya.master-griya-index',compact('dataGriya'));
    }
    // INDEX VIEW DATA LOKASI GRIYA

    // CREATE VIEW DATABASE LOKASI GRIYA
    public function createDataGriya(Request $request)
    {
        $dataKabupaten = Kabupaten::all();
        $dataDesaAdat = DesaAdat::all();
        return view('pages.admin.master-data.griya.master-griya-create',compact(['dataKabupaten','dataDesaAdat']));
    }
    // CREATE VIEW DATABASE LOKASI GRIYA

    // STORE INPUT DATABASE LOKASI GRIYA
    public function storeDataGriya(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'nama_griya' => "required|unique:tb_griya_rumah,nama_griya_rumah|regex:/^[a-z ,.'-]+$/i|min:3|max:50",
                'alamat_griya' => "required|regex:/^[a-z,. 0-9]+$/i|min:3|max:100",
                'id_desa' =>'required|exists:tb_desa,id_desa',
                'id_desa_adat'=>'required|exists:tb_desaadat,desadat_id',
                'lat' => 'required|numeric|regex:/^[0-9.-]+$/i',
                'lng' => 'required|numeric|regex:/^[0-9.-]+$/i',
            ],
            [
                'nama_griya.required' => "Nama griya wajib diisi",
                'nama_griya.regex' => "Format nama griya tidak sesuai",
                'nama_griya.min' => "Nama griya minimal berjumlah 3 karakter",
                'nama_griya.max' => "Nama griya maksimal berjumlah 50 karakter",
                'nama_griya.unique' => "Nama griya sudah pernah dibuat sebelumnya",
                'alamat_griya.required' => "Nama griya wajib diisi",
                'alamat_griya.regex' => "Format nama griya tidak sesuai",
                'alamat_griya.min' => "Nama griya minimal berjumlah 3 karakter",
                'alamat_griya.max' => "Nama griya maksimal berjumlah 100 karakter",
                'id_desa.required' => "Lokasi Desa wajib diisi",
                'id_desa.exists' => "Lokasi Desa tidak sesuai",
                'id_desa_adat.required' => "Lokasi Desa Adat wajib diisi",
                'id_desa_adat.exists' => "Lokasi Desa Adat tidak sesuai",
                'lat.required' => "Latitude griya wajib diisi",
                'lat.numeric' => "Latitude harus berupa angka",
                'lat.regex' => "Format koordinat Latitude griya tidak sesuai",
                'lng.required' => "Longitude griya wajib diisi",
                'lng.numeric' => "Longitude harus berupa angka",
                'lng.regex' => "Format koordinat Longitude griya tidak sesuai",
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Registrasi',
                    'message' => 'Gagal melakukan registrasi akun, silakan periksa kembali form input anda!'
                ])->withInput($request->all())->withErrors($validator->errors());
            }
        // END

        // MAIN LOGIC
            try{

                DB::beginTransaction();
                GriyaRumah::create([
                    'id_desa' => $request->id_desa,
                    'id_desa_adat' => $request->id_desa_adat,
                    'nama_griya_rumah' =>$request->nama_griya,
                    'alamat_griya_rumah' =>$request->alamat_griya,
                    'lat' =>$request->lat,
                    'lng' =>$request->lng,
                ]);
                DB::commit();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                DB::rollBack();
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Menambahkan Data Griya',
                    'message' => 'Gagal menambahkan data griya, apabila diperlukan mohon hubungi developer sistem`',
                ]);
            }
        // END LOGIC

        // RETURN
            return redirect()->route('admin.master-data.griya.index')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Lokasi Griya Berhasil Dibuat',
                'message' => 'Lokasi Griya berhasil dibuat, sekarang data griya dapat digunakan',
            ]);
        //END



    }
    // END STORE INPUT DATABASE LOKASI GRIYA

    // DETAIL LOKASI GRIYA
    public function detailDataGriya(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_griya_rumah,id',
            ]);

            if($validator->fails()){
                return redirect()->route('admin.master-data.griya.index')->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Griya Tidak Ditemukan !',
                    'message' => 'Data griya tidak ditemukan, pilihlah data dengan benar !',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC & RETURN
            try{
                $dataGriya = GriyaRumah::with(['DesaAdat','Desa'])->findOrFail($request->id);;
                return view('pages.admin.master-data.griya.master-griya-detail',compact('dataGriya'));
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return \redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Sistem Gagal Menemukan Data Griya !',
                    'message' => 'sistem gagal menemukan Data Griya, mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END MAIN LOGIC & RETURN

    }
    // DETAIL LOKASI GRIYA

    // EDIT LOKASI GRIYA
    public function editDataGriya (Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_griya_rumah,id',
            ]);

            if($validator->fails()){
                return redirect()->route('admin.master-data.griya.index')->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Griya Tidak Ditemukan !',
                    'message' => 'Data griya tidak ditemukan, pilihlah data dengan benar !',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC & RETURN
            try{
                $dataGriya = GriyaRumah::with(['DesaAdat','Desa'])->findOrFail($request->id);
                $dataKabupaten = Kabupaten::all();
                $dataKecamatan = Kecamatan::all();
                $dataDesa = DesaDinas::all();
                $dataDesaAdat = DesaAdat::all();
                return view('pages.admin.master-data.griya.master-griya-edit',compact('dataGriya','dataKabupaten','dataDesaAdat','dataKecamatan','dataDesa'));
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Sistem Gagal Menemukan Data Griya !',
                    'message' => 'sistem gagal menemukan Data Griya, mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END MAIN LOGIC & RETURN

    }
    // EDIT LOKASI GRIYA

    // UPDATE INPUT DATABASE LOKASI GRIYA
    public function updateDataGriya(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'id' =>'required|exists:tb_griya_rumah,id',
                'nama_griya' => "required|regex:/^[a-z ,.'-]+$/i|min:3|max:50",
                'alamat_griya' => "required|regex:/^[a-z,. 0-9]+$/i|min:3|max:100",
                'id_desa' =>'required|exists:tb_desa,id_desa',
                'id_desa_adat'=>'required|exists:tb_desaadat,desadat_id',
                'lat' => 'required|numeric|regex:/^[0-9.-]+$/i',
                'lng' => 'required|numeric|regex:/^[0-9.-]+$/i',
            ],
            [
                'id.required' => "Id wajib diisi",
                'id.exists' => "Id tidak sesuai",
                'nama_griya.required' => "Nama griya wajib diisi",
                'nama_griya.regex' => "Format nama griya tidak sesuai",
                'nama_griya.min' => "Nama griya minimal berjumlah 3 karakter",
                'nama_griya.max' => "Nama griya maksimal berjumlah 50 karakter",
                'nama_griya.unique' => "Nama griya sudah pernah dibuat sebelumnya",
                'alamat_griya.required' => "Nama griya wajib diisi",
                'alamat_griya.regex' => "Format nama griya tidak sesuai",
                'alamat_griya.min' => "Nama griya minimal berjumlah 3 karakter",
                'alamat_griya.max' => "Nama griya maksimal berjumlah 100 karakter",
                'id_desa.required' => "Lokasi Desa wajib diisi",
                'id_desa.exists' => "Lokasi Desa tidak sesuai",
                'id_desa_adat.required' => "Lokasi Desa Adat wajib diisi",
                'id_desa_adat.exists' => "Lokasi Desa Adat tidak sesuai",
                'lat.required' => "Latitude griya wajib diisi",
                'lat.numeric' => "Latitude harus berupa angka",
                'lat.regex' => "Format koordinat Latitude griya tidak sesuai",
                'lng.required' => "Longitude griya wajib diisi",
                'lng.numeric' => "Longitude harus berupa angka",
                'lng.regex' => "Format koordinat Longitude griya tidak sesuai",
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Registrasi',
                    'message' => 'Gagal melakukan registrasi akun, silakan periksa kembali form input anda!'
                ])->withInput($request->all())->withErrors($validator->errors());
            }
        // END

        // MAIN LOGIC
            try{
                DB::beginTransaction();
                GriyaRumah::findOrFail($request->id)->update([
                    'id_desa' => $request->id_desa,
                    'id_desa_adat' => $request->id_desa_adat,
                    'nama_griya_rumah' =>$request->nama_griya,
                    'alamat_griya_rumah' =>$request->alamat_griya,
                    'lat' =>$request->lat,
                    'lng' =>$request->lng,
                ]);
                DB::commit();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                DB::rollBack();
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Menambahkan Data Griya',
                    'message' => 'Gagal menambahkan data griya, apabila diperlukan mohon hubungi developer sistem`',
                ]);
            }
        // END LOGIC

        // RETURN
            return redirect()->route('admin.master-data.griya.index')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Lokasi Griya Berhasil Dibuat',
                'message' => 'Lokasi Griya berhasil dibuat, sekarang data griya dapat digunakan',
            ]);
        //END
    }
    // END UPDATE INPUT DATABASE LOKASI GRIYA

    // DELETE INPUT DATABASE LOKASI GRIYA
    public function deleteDataGriya(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_griya_rumah,id',
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
                $useGriya = Sulinggih::where('id_griya',$request->id)->count();
                if($useGriya == 0){
                    GriyaRumah::findOrFail($request->id)->delete();
                    // RETURN
                        return redirect()->back()->with([
                            'status' => 'success',
                            'icon' => 'success',
                            'title' => 'Berhasil Menghapus Data Lokasi Griya',
                            'message' => 'Data Griya berhasil terhapus dari sistem'
                        ]);
                    // END RETURN
                }else{
                    // RETURN
                        return redirect()->back()->with([
                            'status' => 'fail',
                            'icon' => 'error',
                            'tittle' => 'Hapus Data Gagal!',
                            'message' => 'Hapus data gagal, Data Griya Masih berstatus aktif '
                        ]);
                    // END RETURN
                }
            }catch(ModelNotFoundException $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'tittle' => 'Hapus Data Gagal!',
                    'message' => 'Hapus data gagal, mohon hubungi developer untuk lebih lanjut!!'
                ]);
            }
        // END LOGIC
    }
    // END DELETE INPUT DATABASE LOKASI GRIYA



    // AJAX INPUT DATABASE LOKASI GRIYA
    public function ajaxStoreDataGriya(Request $request)
    {
        $dataGriya = GriyaRumah::create([
            'id_desa' => $request->id_desa,
            'id_desa_adat' => $request->id_desa_adat,
            'nama_griya_rumah' =>$request->nama_griya,
            'alamat_griya_rumah' =>$request->alamat_griya,
            'lat' =>$request->lat,
            'lng' =>$request->lng,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data griya',
            'data' => $dataGriya
        ],200);
    }
    // AJAX STORE DATABASE LOKASI GRIYA

    // GET AJAX DATA GIRYA
    public function ajaxGetDataGriya(Request $request)
    {
        $dataGriya = GriyaRumah::all();
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data griya',
            'data' => $dataGriya
        ],200);
    }
    // GET AJAX DATA GRIYA

}
