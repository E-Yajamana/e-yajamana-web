<?php

namespace App\Http\Controllers\web\sanggar\muput_upacara;

use App\Http\Controllers\Controller;
use App\Models\DetailReservasi;
use App\Models\Reservasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use PDOException;

class KonfirmasiMuputController extends Controller
{

    // MUPUT UPACARA INDEX
    public function index()
    {
        $sanggar = Auth::user()->sessionSanggar();
        $queryDetailReservasi = function ($queryDetailReservasi) {
            $queryDetailReservasi->with('TahapanUpacara')->whereStatus('diterima')->whereHas('TahapanUpacara');
        };
        $dataReservasi = Reservasi::with(['Upacaraku.User.Penduduk', 'Upacaraku.Upacara', 'DetailReservasi' => $queryDetailReservasi])->whereHas('DetailReservasi', $queryDetailReservasi)->whereIdSanggarAndStatus($sanggar->id, 'proses muput')->get();
        return view('pages.sanggar.manajemen-muput.konfirmasi-muput-index', compact('dataReservasi'));
    }
    // MUPUT UPACARA INDEX


    // DETAIL UPACARA
    public function detail(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' => $request->id], [
                'id' => 'required|exists:tb_detail_reservasi,id',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Tahapan Reservasi Tidak Ditemukan !',
                    'message' => 'Tahapan Reservasi tidak ditemukan, pilihlah data dengan benar !',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                $sulinggih = Auth::user();
                $queryReservasi = function ($queryReservasi) use ($sulinggih){
                    $queryReservasi->with('Upacaraku')->whereHas('Upacaraku')->where('id_relasi',$sulinggih->id);
                };
                $dataDetailReservasi = DetailReservasi::with(['Reservasi' => $queryReservasi, 'TahapanUpacara'])->whereHas('TahapanUpacara')->whereHas('Reservasi')->whereStatus('diterima')->findOrFail($request->id);
            }catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
                return \redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Internal server error  !',
                    'message' => 'Data detail muput upacara tidak tersedia, mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END LOGIC

        // RETURN
            return view('pages.pemuput-karya.manajemen-muput-upacara.konfirmasi-muput-detail', compact('dataDetailReservasi'));
        // END RETURN
    }
    // DETAIL UPACARA

}
