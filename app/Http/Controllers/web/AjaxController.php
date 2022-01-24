<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
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
        $awal = TahapanUpacara::where('id_upacara',$request->id)->where('status_tahapan','awal')->get();
        $puncak = TahapanUpacara::where('id_upacara',$request->id)->where('status_tahapan','awal')->get();
        $akhir = TahapanUpacara::where('id_upacara',$request->id)->where('status_tahapan','awal')->get();
        $data = [
            'awal' =>$awal,
            'puncak' => $puncak,
            'akhir' => $akhir
        ];
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data griya',
            'data' => $data
        ],200);

    }

}
