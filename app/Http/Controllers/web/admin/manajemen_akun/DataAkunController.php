<?php

namespace App\Http\Controllers\web\admin\manajemen_akun;

use App\Http\Controllers\Controller;
use App\Models\Krama;
use App\Models\PemuputKarya;
use App\Models\Sanggar;
use App\Models\Serati;
use App\Models\Sulinggih;
use App\Models\User;
use Illuminate\Http\Request;

class DataAkunController extends Controller
{
    // INDEX
    public function index(Request $request)
    {
        $dataKrama = User::with('Penduduk')->whereHas('Penduduk')->get();
        $dataSanggar = Sanggar::with('User.Penduduk')->whereHas('User.Penduduk')->get();
        $dataSerati = Serati::with('User.Penduduk')->whereHas('User.Penduduk')->get();
        $dataSulinggih = PemuputKarya::with(['User.Penduduk','GriyaRumah','AtributPemuput'])->whereHas('User.Penduduk')->whereTipe('sulinggih')->get();
        $dataPemangku = PemuputKarya::with(['User.Penduduk','GriyaRumah','AtributPemuput'])->whereHas('User.Penduduk')->whereTipe('pemangku')->get();

        return view('pages.admin.manajemen-akun.data-akun.data-akun-index',compact('dataKrama','dataSanggar','dataSerati','dataPemangku','dataSulinggih'));
    }
    // INDEX

    // PEMUPUT DETAIL
    public function detailPemuput(Request $request)
    {
        $dataPemuput = PemuputKarya::with(['User.Penduduk','GriyaRumah.BanjarDinas.DesaDinas.Kecamatan.Kabupaten'])->whereHas('User.Penduduk')->whereHas('GriyaRumah.BanjarDinas.DesaDinas.Kecamatan.Kabupaten')->findOrFail($request->id);
        return view('pages.admin.manajemen-akun.data-akun.data-akun-pemuput-karya-detail',compact('dataPemuput'));
    }
    // PEMUPUT DETAIL


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
        $dataKrama = User::with(['Penduduk'])->findOrFail($request->id);
        return view('pages.admin.manajemen-akun.data-akun.data-akun-krama-detail',compact('dataKrama'));
    }


}
