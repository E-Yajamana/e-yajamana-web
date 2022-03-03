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

    public function dataAkunDetail(Request $request)
    {
        return view('pages.admin.manajemen-akun.data-akun.data-akun-detail');
    }
}
