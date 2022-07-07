<?php

namespace App\Http\Controllers\web\sanggar\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SanggarDashboardController extends Controller
{

    public function index(Request $request)
    {
        $id_sanggar = session()->get('id_sanggar');
        $reservasi = Reservasi::whereIdSanggar($id_sanggar)->get();
        $countData = [
            'countMuput' => $reservasi->where('status','proses muput')->count(),
            'countTangkil' => $reservasi->where('status','proses tangkil')->count(),
            'countReservasiMasuk' => $reservasi->where('status','pending')->count(),
            'countReservasi' => $reservasi->count(),
        ];
        $queryDetailReservasi = function ($queryDetailReservasi){
            $queryDetailReservasi->where('tanggal_mulai', '<=',Carbon::now()->startOfDay()->addHours(23))
                ->where('tanggal_selesai', '>=', Carbon::now()->startOfDay())
                ->where('status','diterima');
        };

        $dataJadwal = Reservasi::with(['Upacaraku.User.Penduduk','Upacaraku.Upacara','DetailReservasi'=>$queryDetailReservasi])
            ->whereHas('DetailReservasi',$queryDetailReservasi)
            ->whereTipe('sanggar')
            ->whereIn('status',['proses tangkil','proses muput'])
            ->whereIdSanggar($id_sanggar)
            ->get();

        return view('pages.sanggar.dashboard',compact('countData','dataJadwal'));
    }
}


