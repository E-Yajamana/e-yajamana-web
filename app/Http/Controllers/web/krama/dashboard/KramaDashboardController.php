<?php

namespace App\Http\Controllers\web\krama\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\Upacara;
use App\Models\Upacaraku;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KramaDashboardController extends Controller
{
    // VIEW DASHBOARD
    public function index(Request $request)
    {
        $request->session()->forget('id_sanggar');

        $user = Auth::user();
        $upacara = Upacara::all();
        $upacaraKrama = Upacaraku::with(['Upacara','Reservasi'])->withCount('Reservasi')->whereIdKrama($user->id);
        // dd($upacaraKrama->get());

        $queryPemuputStatus = function($queryPemuputStatus){
            $queryPemuputStatus->where('status_konfirmasi_akun','disetujui');
        };

        $dataUpacaraKrama = $upacaraKrama->latest()->take(4)->get();

        $countData = [
            'countUpacara' => $upacara->count(),
            'countPemuputKarya' => User::with(['PemuputKarya'=>$queryPemuputStatus])->whereHas('PemuputKarya',$queryPemuputStatus)->count(),
            'countUpacaraKrama' => $upacaraKrama->count(),
            'countReservasi' => $upacara->count(),
        ];

        $dataCountJenisYadnya = [
            $upacara->where('kategori_upacara','Dewa Yadnya')->count(),
            $upacara->where('kategori_upacara','Pitra Yadnya')->count(),
            $upacara->where('kategori_upacara','Manusa Yadnya')->count(),
            $upacara->where('kategori_upacara','Rsi Yadnya')->count(),
            $upacara->where('kategori_upacara','Bhuta Yadnya')->count(),
        ];

        // dd($dataCountJenisYadnya);
        // $incomingReservasi = Reservasi::


        return view('pages.krama.dashboard', compact('dataCountJenisYadnya','countData','dataUpacaraKrama'));
    }
    // VIEW DASHBOARD


}
