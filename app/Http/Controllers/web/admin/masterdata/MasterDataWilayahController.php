<?php

namespace App\Http\Controllers\web\admin\masterdata;

use App\Http\Controllers\Controller;
use App\Models\DesaAdat;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Upacara;
use Illuminate\Http\Request;

class MasterDataWilayahController extends Controller
{

    public function indexKabupaten(Request $request)
    {
        $dataKabupaten = Kabupaten::where('provinsi_id',51)->get();
        return view('pages.admin.master-data.wilayah.kabupaten',compact('dataKabupaten'));
    }

    public function indexKecamatan(Request $request)
    {
        $dataKecamatan = Kabupaten::where('provinsi_id',51)->with('Kecamatan')->get();
        return view('pages.admin.master-data.wilayah.kecamatan',compact('dataKecamatan'));
    }

    public function indexDesaDinas(Request $request)
    {
        $dataDesa = Kabupaten::where('provinsi_id',51)->with('Kecamatan.DesaDinas')->get();
        return view('pages.admin.master-data.wilayah.desa',compact('dataDesa'));
    }

    public function indexDesaAdat(Request $request)
    {
        $desaAdat = DesaAdat::all();
        return view('pages.admin.master-data.wilayah.desa-adat',compact('desaAdat'));
    }
}
