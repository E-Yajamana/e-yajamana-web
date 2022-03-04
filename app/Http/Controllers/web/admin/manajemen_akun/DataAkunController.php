<?php

namespace App\Http\Controllers\web\admin\manajemen_akun;

use App\Http\Controllers\Controller;
use App\Models\Krama;
use App\Models\Sanggar;
use App\Models\Serati;
use App\Models\Sulinggih;
use Illuminate\Http\Request;

class DataAkunController extends Controller
{
    public function index(Request $request)
    {
        $dataKrama = Krama::with('User.Penduduk')->whereHas('User.Penduduk')->get();
        $dataSanggar = Sanggar::with('User.Penduduk')->whereHas('User.Penduduk')->get();
        $dataSerati = Serati::with('User.Penduduk')->whereHas('User.Penduduk')->get();
        $dataSulinggih = Sulinggih::with(['User.Penduduk','GriyaRumah'])->whereHas('User.Penduduk')->whereStatus('sulinggih')->get();
        $dataPemangku = Sulinggih::with(['User.Penduduk','GriyaRumah'])->whereHas('User.Penduduk')->whereStatus('pemangku')->get();

        return view('pages.admin.manajemen-akun.data-akun.data-akun-index',compact('dataKrama','dataSanggar','dataSerati','dataPemangku','dataSulinggih'));
    }

    public function detailPemuputKarya(Request $request)
    {
        $dataSulinggih = Sulinggih::with(['User.Penduduk','GriyaRumah.BanjarDinas.DesaDinas.Kecamatan.Kabupaten'])->findOrFail($request->id);
        return view('pages.admin.manajemen-akun.data-akun.data-akun-pemuput-karya-detail',compact('dataSulinggih'));
    }

    public function detailSanggar(Request $request)
    {
        $dataSanggar = Sanggar::with(['User.Penduduk'])->findOrFail($request->id);
        return view('pages.admin.manajemen-akun.data-akun.data-akun-sanggar-detail',compact('dataSanggar'));
    }

    public function detailSerati(Request $request)
    {
        $dataSerati = Serati::with(['User.Penduduk'])->findOrFail($request->id);
        return view('pages.admin.manajemen-akun.data-akun.data-akun-serati-detail',compact('dataSerati'));
    }

    public function detailKrama(Request $request)
    {
        $dataKrama = Krama::with(['User.Penduduk'])->findOrFail($request->id);
        return view('pages.admin.manajemen-akun.data-akun.data-akun-krama-detail',compact('dataKrama'));
    }


}
