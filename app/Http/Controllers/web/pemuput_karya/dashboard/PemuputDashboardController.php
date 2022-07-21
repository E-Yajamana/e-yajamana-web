<?php

namespace App\Http\Controllers\web\pemuput_karya\dashboard;

use App\Http\Controllers\Controller;
use App\ImageHelper;
use App\Models\DetailReservasi;
use App\Models\Reservasi;
use App\Models\Sulinggih;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Expectation;
use Illuminate\Support\Facades\Validator;
use NotificationHelper;

class PemuputDashboardController extends Controller
{
    // VIEW DASHBOARD PEMUPUT KARYA
    public function index(Request $requests)
    {
        $requests->session()->forget('id_sanggar');
        $user = Auth::user();
        $reservasi = Reservasi::whereIdRelasi($user->id)->get();
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
            ->whereTipe('pemuput_karya')
            // ->whereHas('DetailReservasi',)
            ->whereIn('status',['proses tangkil','proses muput'])
            ->whereIdRelasi($user->id)
            ->get();

        return view('pages.pemuput-karya.dashboard',compact('countData','dataJadwal'));
    }
    // VIEW DASHBOARD PEMUPUT KARYA


    public function calenderIndex(Request $request)
    {
        return view('pages.pemuput-karya.calender.pemuput-calender');
    }


}
