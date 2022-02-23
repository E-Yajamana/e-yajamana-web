<?php

namespace App\Http\Controllers\web\pemuput_karya\manajemen_reservasi;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatReservasiController extends Controller
{
    public function index(Request $request)
    {
        $idUser = Auth::user()->id;
        $queryUpacaraku = function ($queryUpacaraku){
            $queryUpacaraku->with(['Upacara','Krama.User.Penduduk'])->whereHas('Krama.User.Penduduk')->whereHas('Upacara');
        };
        $dataReservasi = Reservasi::with(['DetailReservasi.TahapanUpacara','Upacaraku'=>$queryUpacaraku])->whereHas('DetailReservasi.TahapanUpacara')->whereHas('Upacaraku',$queryUpacaraku)->whereIdRelasi($idUser)->get();
        return view('pages.pemuput-karya.manajemen-reservasi.pemuput-reservasi-riwayat-index',compact('dataReservasi'));
    }
}
