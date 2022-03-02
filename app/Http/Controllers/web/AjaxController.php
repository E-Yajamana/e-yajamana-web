<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\KeteranganKonfirmasi;
use App\Models\Penduduk;
use App\Models\Reservasi;
use App\Models\TahapanUpacara;
use Illuminate\Support\Facades\Validator;
use App\Models\Upacara;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PDOException;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

    public function jenisYadnya(Request $request)
    {
        $dataUpacara = Upacara::where('kategori_upacara',$request->jenis)->get();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data griya',
            'data' => $dataUpacara
        ],200);
    }

    public function getTahapanUpacara(Request $request)
    {
        $data = TahapanUpacara::where('id_upacara',$request->id)->get();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data griya',
            'data' => $data
        ],200);

    }

    public function getDataTangkilPemuputKarya(Request $request)
    {
        $dataTangkil = Reservasi::with('Upacaraku','DetailReservasi')->whereHas('DetailReservasi')->whereHas('Upacaraku');
        $queryDetail = function ($queryDetail){
            $queryDetail->with('TahapanUpacara')->whereNotIn('status',['ditolak']);
        };
        $dataTangkil->with(['DetailReservasi'=>$queryDetail])->whereHas('DetailReservasi',$queryDetail);
        $dataTangkil = $dataTangkil->whereIdRelasi($request->id)->whereNotIn('status',['batal'])->get();
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data jadwal dari sulinggih',
            'data' => $dataTangkil
        ],200);
    }

    public function getDataTahapanReservasi(Request $request)
    {
        $dataReservasi = Reservasi::with(['Upacaraku','DetailReservasi'=> function($query){
            $query->whereNotIn('status',['batal']);
        }])->whereHas('DetailReservasi')->findOrFail($request->id);
        $dataTahapanReservasi = [];
        foreach($dataReservasi->DetailReservasi as $data){
            $dataTahapanReservasi[] = $data->id_tahapan_upacara;
        }
        $dataTahapan = TahapanUpacara::whereIdUpacara($dataReservasi->Upacaraku->id_upacara)->whereNotIn('id',$dataTahapanReservasi)->get();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data',
            'data' => $dataTahapan
        ],200);
    }

    public function getKeteranganPergantian(Request $request)
    {
        $data = KeteranganKonfirmasi::with(['Relasi.Sulinggih','DetailReservasi.Reservasi'])->whereIdDetailReservasi($request->id)->orderBy('created_at','desc')->get();
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data',
            'data' => $data
        ],200);
    }


    public function getDataPenduduk($nik)
    {
        // SECURITY
            $validator = Validator::make(['nik' => $nik],[
                'nik' => 'required|exists:tb_penduduk,nik',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 400,
                    'message' => 'Validation Error',
                    'data' => (Object)[],
                ],400);
            }
        // END

        // MAIN LOGIC
            try{
                // $penduduk = Penduduk::where('nik','like','%'.$nik.'%')->get();
                $penduduk = Penduduk::whereNik($nik)->firstOrFail();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'fail',
                    'tittle' => 'Hapus Data Gagal!',
                    'message' => 'Hapus data gagal, mohon hubungi developer untuk lebih lanjut!!'
                ]);
            }
        // END LOGIC

        // RETURN
            return response()->json([
                'status' => 200,
                'icon' => 'success',
                'tittle' => 'NIK Terdaftar',
                'message' => 'Berhasil mengambil data nik,anda dapat membuat akun E-Yajamana',
                'data' => $penduduk
            ],200);
        // END
    }




}
