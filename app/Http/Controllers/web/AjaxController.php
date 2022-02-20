<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\TahapanUpacara;
use App\Models\Upacara;
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
        $dataTangkil = $dataTangkil->whereIdRelasi($request->id)->whereNotIn('status',['batal','selesai'])->get();
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


}
