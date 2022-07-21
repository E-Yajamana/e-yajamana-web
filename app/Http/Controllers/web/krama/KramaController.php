<?php

namespace App\Http\Controllers\web\krama;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Notification;
use App\Models\PemuputKarya;
use App\Models\Reservasi;
use App\Models\Sanggar;
use App\Models\Upacaraku;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use NotificationHelper;

class KramaController extends Controller
{
    public function profile(Request $request)
    {
        $user = Auth::user();
        $upacaraKrama = Upacaraku::query()->whereIdKrama($user->id)->get();

        $queryUpacaraku = function($queryUpacaraku) use ($user){
            $queryUpacaraku->where('id_krama',$user->id);
        };

        $reservasiKrama = Reservasi::with(['Upacaraku'=> $queryUpacaraku])->whereHas('Upacaraku',$queryUpacaraku)->get();

        $rangkumanUpacara = [
            "jumlahUpacara" => $upacaraKrama->count(),
            "jumlahUpacaraProses" =>$upacaraKrama->where('status','berlangsung')->count(),
            "jumlahUpacaraSelesai" =>$upacaraKrama->where('status','selesai')->count()
        ];

        $rangkumanReservasi = [
            'jumlahReservasi' =>$reservasiKrama->count() ,
            'jumlahDisetujui' =>$reservasiKrama->where('status','proses tangkil')->count(),
            'jumlahProses' => $reservasiKrama->where('status','proses muput')->count(),
            'jumlahTolak' =>$reservasiKrama->where('status','batal')->count() ,
        ];

        return view('pages.krama.profile.krama-profile',compact('rangkumanUpacara','rangkumanReservasi'));
    }


    public function report()
    {
        return view('pages.krama.report');
    }

}
