<?php

namespace App\Http\Controllers\web\pemuput_karya\muput_upacara;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonfirmasiMuputController extends Controller
{
    public function index()
    {
        $idUser = Auth::user()->id;
        $queryDetailReservasi = function ($queryDetailReservasi){
            $queryDetailReservasi->with('TahapanUpacara')->whereStatus('diterima')->whereHas('TahapanUpacara');
        };
        $dataReservasi = Reservasi::with(['Upacaraku.Krama.User.Penduduk','Upacaraku.Upacara','DetailReservasi'=>$queryDetailReservasi])->whereHas('DetailReservasi',$queryDetailReservasi)->whereIdRelasiAndStatus($idUser,'proses muput')->get();
        return view('pages.pemuput-karya.manajemen-muput-upacara.konfirmasi-muput-index',compact('dataReservasi'));
    }

    public function muputKarya(Request $request)
    {
        dd($request->all());
    }


}
