<?php

namespace App\Http\Controllers\web\pemuput_karya;

use App\Http\Controllers\Controller;
use App\Models\DetailReservasi;
use App\Models\Notification;
use App\Models\Reservasi;
use App\Models\TahapanUpacara;
use App\Models\Upacara;
use App\Models\Upacaraku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class PemuputKaryaController extends Controller
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

        return view('pages.pemuput-karya.profile.pemuput-karya-profile',compact('rangkumanUpacara','rangkumanReservasi','dataNotifikasi'));
    }

    public function report()
    {
        $user = Auth::user();

        $queryReservasi = function($queryReservasi) use ($user){
            $queryReservasi->where('id_relasi',$user->id)->whereNotIn('status',['batal']);
        };

        $queryDetailReservasi = DetailReservasi::with(['Reservasi.Upacaraku.User.Penduduk','TahapanUpacara.Upacara','Reservasi'=>$queryReservasi])->whereHas('Reservasi',$queryReservasi)->whereYear('tanggal_mulai',2022);
        $detailReservasis = $queryDetailReservasi->orderBy('tanggal_mulai')->get();
        $dataReportTransaksi = $queryDetailReservasi->select(DB::raw("COUNT('id') as jumlah"),DB::raw("MONTH(tanggal_mulai) bulan"))->groupby('bulan')->get();

        $dataReportJenisYadnya = DB::table('tb_detail_reservasi')
                ->join('tb_reservasi', function($join) use ($user){
                    $join->on('tb_detail_reservasi.id_reservasi','=','tb_reservasi.id')
                    ->where('id_relasi',$user->id);
                })->join('tb_tahapan_upacara', 'tb_detail_reservasi.id_tahapan_upacara', '=', 'tb_tahapan_upacara.id')
                ->join('tb_upacara', 'tb_tahapan_upacara.id_upacara', '=', 'tb_upacara.id')
                ->select(DB::raw("COUNT('id') as jumlah"),'tb_upacara.kategori_upacara')
                ->groupBy('kategori_upacara')
                ->get();

        $reportJenisYadnya = [
            'Dewa Yadnya' => 0,
            'Pitra Yadnya' => 0,
            'Rsi Yadnya' => 0,
            'Manusa Yadnya' => 0,
            'Bhuta Yadnya' => 0,
        ];
        foreach($dataReportJenisYadnya as $key => $data){
            $reportJenisYadnya[$data->kategori_upacara] = $data->jumlah;
        }

        $reportMonth = [0,0,0,0,0,0,0,0,0,0,0,0];

        foreach($dataReportTransaksi as $key => $data){
            Arr::set($reportMonth, $data->bulan-1, $data->jumlah);
        }

        return view('pages.pemuput-karya.report',compact('reportJenisYadnya','reportMonth','detailReservasis'));

    }

}
