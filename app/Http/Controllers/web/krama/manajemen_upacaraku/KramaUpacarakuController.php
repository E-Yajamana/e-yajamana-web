<?php

namespace App\Http\Controllers\web\krama\manajemen_upacaraku;

use App\Http\Controllers\Controller;
use App\Models\DesaAdat;
use App\Models\Kabupaten;
use App\Models\Upacaraku;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use PDOException;
use Prophecy\Call\Call;

class KramaUpacarakuController extends Controller
{
    // INDEX UPACARAKU
    public function indexUpacaraku(Request $request)
    {
        return view('pages.krama.manajemen-upacara.upacaraku-index');
    }
    // INDEX UPACARAKU

    // CREATE UPACARAKU
    public function createUpacaraku(Request $request)
    {
        $dataKabupaten = Kabupaten::all();
        $dataDesaAdat = DesaAdat::all();
        return view('pages.krama.manajemen-upacara.upacaraku-create',compact(['dataKabupaten','dataDesaAdat']));
    }
    // CREATE UPACARAKU

    // STORE UPACARAKU
    public function storeUpacaraku(Request $request)
    {
        // dd($request->all());
        // SECURITY
            $validator = Validator::make($request->all(),[
                'id_upacara' => 'required|exists:tb_upacara,id',
                'id_desa' => 'required|exists:tb_desa,id_desa',
                'id_desa_adat' => 'required|exists:tb_desaadat,desadat_id',
                'nama_upacara' => 'required|regex:/^[a-z,. 0-9]+$/i|min:3|max:100',
                'lokasi' => 'required|regex:/^[a-z,. 0-9]+$/i|min:3|max:100',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'deskripsi_upacara' => 'required|regex:/^[a-z,. 0-9]+$/i|min:3|max:100',
                'lat' => 'required|numeric|regex:/^[0-9.-]+$/i',
                'lng' => 'required|numeric|regex:/^[0-9.-]+$/i',
            ],
            [
                'id_upacara.required' => "Jenis Upacara wajib diisi",
                'id_upacara.exists' => "Jenis Upacara tidak sesuai",
                'id_desa.required' => "Desa wajib diisi",
                'id_desa.exists' => "Desa tidak sesuai",
                'id_desa_adat.required' => "Desa Adat wajib diisi",
                'id_desa_adat.exists' => "Desa Adat tidak sesuai",
                'nama_upacara.required' => "Nama Upacara wajib diisi",
                'nama_upacara.regex' => "Format Nama Upacara tidak sesuai",
                'nama_upacara.min' => "Nama Upacara minimal berjumlah 3 karakter",
                'nama_upacara.max' => "Nama Upacara maksimal berjumlah 100 karakter",
                'lokasi.required' => "Alamat Lengkap Upacara Lengkap wajib diisi",
                'lokasi.regex' => "Format Alamat Lengkap Upacara Lengkap tidak sesuai",
                'lokasi.min' => "Alamat Lengkap Upacara Lengkap minimal berjumlah 3 karakter",
                'lokasi.max' => "Alamat Lengkap Upacara Lengkap maksimal berjumlah 100 karakter",
                'start_date.required' => "Tanggal Mulai - Selesai wajib diisi",
                'start_date.date' => "Format Tanggal Mulai - Selesai salah",
                'end_date.required' => "Tanggal Mulai - Selesai wajib diisi",
                'end_date.date' => "Format Tanggal Mulai - Selesai salah",
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
                    'title' => 'Gagal Menambahkan Data Upacaraku',
                    'message' => 'Gagal Menambahkan Data Upacaraku, silakan periksa kembali form input anda!'
                ])->withInput($request->all())->withErrors($validator->errors());
            }
        // END

        // MAIN LOGIC
             try{
                DB::beginTransaction();
                Upacaraku::create([
                    'id_upacara'=>$request->id_upacara,
                    'id_krama'=>1,
                    'id_desa'=>$request->id_desa,
                    'id_desa_adat'=>$request->id_desa_adat,
                    'nama_upacara'=>$request->nama_upacara,
                    'lokasi'=>$request->lokasi,
                    'tanggal_mulai'=>$request->start_date,
                    'tanggal_selesai'=>$request->end_date,
                    'desc'=>$request->deskripsi_upacara,
                    'status'=> 'pending',
                    'lat'=>$request->lat,
                    'lng'=>$request->lng,
                ]);
                DB::commit();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                DB::rollBack();
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Menambahkan Data Upacara',
                    'message' => $err,
                ]);
            }
        // END LOGIC

        //RETURN
            return redirect()->route('krama.manajemen-upacara.upacaraku.index')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Akun Berhasil Dibuat',
                'message' => 'Akun berhasil dibuat, gunakan email dan password untuk masuk kedalam sistem',
            ]);
        //END


    }

}
