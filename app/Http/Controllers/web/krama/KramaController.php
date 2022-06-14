<?php

namespace App\Http\Controllers\web\krama;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Notification;
use App\Models\Reservasi;
use App\Models\Upacaraku;
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

        $dataNotifikasi = [
            'new' => Notification::whereNotifiableId($user->id)->whereJsonContains('data', ['status' => 'new'])->get(),
            'history' => Notification::whereNotifiableId($user->id)->whereJsonContains('data', ['status' => 'history'])->get(),
        ];

        return view('pages.krama.profile.krama-profile',compact('rangkumanUpacara','rangkumanReservasi','dataNotifikasi'));
    }


    public function sendNotif(Request $request)
    {
        $user = Auth::user();

        NotificationHelper::sendNotification(
            [
                'title' => "REMINDER UPACARA",
                'body' => "Halo Krama, besok pada Tanggal 15 Juni 2022 terdapat jadwal tahapan upacara Piodalan yang akan diselenggarakan",
                'status' => "new",
                'image' => "/logo-eyajamana.png",
                'type' => "krama",
                'url' => ''.route('krama.manajemen-upacara.upacaraku.index').'',
                'notifiable_id' => $user->id,
                'formated_created_at' => date('Y-m-d H:i:s'),
                'formated_updated_at' => date('Y-m-d H:i:s'),
            ],
            $user
        );

        return redirect()->route('krama.profile');


    }



}
