<?php

namespace App\Http\Controllers\web\krama\reservasi;

use App\Http\Controllers\Controller;
use App\Models\GriyaRumah;
use App\Models\Sanggar;
use App\Models\Upacaraku;
use Illuminate\Http\Request;

class KramaReservasiController extends Controller
{
    // INDEX RESERVASI KRAMA
    public function indexReservasi(Request $request)
    {
        return view('pages.krama.manajemen-reservasi.krama-reservasi-index');
    }
    // INDEX RESERVASI KRAMA

    // INDEX RESERVASI KRAMA
    public function createReservasi(Request $request)
    {
        $dataUpacara = Upacaraku::with(['Upacara'])->findOrFail($request->id);
        $dataSanggar = Sanggar::where('status_konfirmasi_akun','disetujui')->get();
        $dataGriya = GriyaRumah::with('Sulinggih')->whereHas('Sulinggih')->get();
        dd($dataGriya);
        return view('pages.krama.manajemen-reservasi.krama-reservasi-create',compact(['dataUpacara']));
    }
    // INDEX RESERVASI KRAMA

}
