<?php

namespace App\Http\Controllers\web\krama\upacaraku;

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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PDOException;
use Prophecy\Call\Call;
class KramaUpacarakuController extends Controller
{
    // INDEX UPACARAKU
    public function indexUpacaraku(Request $request)
    {
        $dataUpacaraku = Upacaraku::with('Upacara')->where('id_krama',Auth::user()->Krama->id)->get();
        return view('pages.krama.manajemen-upacara.upacaraku-index', compact('dataUpacaraku'));
    }
    // INDEX UPACARAKU

    // CREATE UPACARAKU
    public function createUpacaraku(Request $request)
    {
        $dataKabupaten = Kabupaten::all();
        return view('pages.krama.manajemen-upacara.upacaraku-create',compact(['dataKabupaten']));
    }
    // CREATE UPACARAKU

    // STORE UPACARAKU
    public function storeUpacaraku(Request $request)
    {

        // SECURITY
            $validator = Validator::make($request->all(),[
                'id_upacara' => 'required|exists:tb_upacara,id',
                'id_banjar_dinas' => 'required|exists:tb_m_banjar_dinas,id',
                'daterange' => 'required',
                'nama_upacara' => 'required|regex:/^[a-z,. 0-9]+$/i|min:3|max:100',
                'lokasi' => 'required|regex:/^[a-z,. 0-9]+$/i|min:3|max:100',
                'deskripsi_upacara' => 'required|regex:/^[a-z,. 0-9]+$/i|min:3|max:100',
                'lat' => 'required|numeric|regex:/^[0-9.-]+$/i',
                'lng' => 'required|numeric|regex:/^[0-9.-]+$/i',
            ],
            [
                'id_upacara.required' => "Jenis Upacara wajib diisi",
                'id_upacara.exists' => "Jenis Upacara tidak sesuai",
                'id_banjar_dinas.required' => "Banjar Dinas wajib diisi",
                'id_banjar_dinas.exists' => "Banjar Dinas tidak sesuai",
                'nama_upacara.required' => "Nama Upacara wajib diisi",
                'nama_upacara.regex' => "Format Nama Upacara tidak sesuai",
                'nama_upacara.min' => "Nama Upacara minimal berjumlah 3 karakter",
                'nama_upacara.max' => "Nama Upacara maksimal berjumlah 100 karakter",
                'lokasi.required' => "Alamat Lengkap Upacara Lengkap wajib diisi",
                'lokasi.regex' => "Format Alamat Lengkap Upacara Lengkap tidak sesuai",
                'lokasi.min' => "Alamat Lengkap Upacara Lengkap minimal berjumlah 3 karakter",
                'lokasi.max' => "Alamat Lengkap Upacara Lengkap maksimal berjumlah 100 karakter",
                'daterange.required' => "Tanggal Mulai - Selesai wajib diisi",
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
                $parseDate = Str::of($request->daterange)->explode(' - ');
                $startDate = new Carbon($parseDate[0]);
                $endDate = new Carbon($parseDate[1]);
                Upacaraku::create([
                    'id_upacara'=>$request->id_upacara,
                    'id_krama'=>Auth::user()->Krama->id,
                    'id_banjar_dinas'=>$request->id_banjar_dinas,
                    'nama_upacara'=>$request->nama_upacara,
                    'alamat_upacaraku'=>$request->lokasi,
                    'tanggal_mulai'=>$startDate->format('Y-m-d h:i:s'),
                    'tanggal_selesai'=>$endDate->format('Y-m-d h:i:s'),
                    'deskripsi_upacaraku'=>$request->deskripsi_upacara,
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
    // STORE UPACARAKU

    // DETAIL UPACARAKU
    public function detailUpacaraku(Request $request)
    {
        $dataUpacaraku = Upacaraku::with(['Upacara','Reservasi','BanjarDinas'])->findOrFail($request->id);
        return view('pages.krama.manajemen-upacara.upacaraku-detail',compact('dataUpacaraku'));
    }
    // DETAIL UPACARAKU
}
