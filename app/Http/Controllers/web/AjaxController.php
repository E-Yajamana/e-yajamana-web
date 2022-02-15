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
        // $awal = TahapanUpacara::where('id_upacara',$request->id)->where('status_tahapan','awal')->get();
        // $puncak = TahapanUpacara::where('id_upacara',$request->id)->where('status_tahapan','awal')->get();
        // $akhir = TahapanUpacara::where('id_upacara',$request->id)->where('status_tahapan','awal')->get();
        // $data = [
        //     'awal' =>$awal,
        //     'puncak' => $puncak,
        //     'akhir' => $akhir
        // ];
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
            $queryDetail->with('TahapanUpacara')->where('status','diterima');
        };
        $dataTangkil->with(['DetailReservasi'=>$queryDetail])->whereHas('DetailReservasi',$queryDetail);
        $dataTangkil = $dataTangkil->whereIdRelasi($request->id)->whereNotIn('status',['pending','batal','selesai'])->get();
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data griya',
            'data' => $dataTangkil
        ],200);
    }


}
