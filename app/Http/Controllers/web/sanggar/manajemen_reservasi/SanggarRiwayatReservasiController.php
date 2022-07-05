<?php

namespace App\Http\Controllers\web\sanggar\manajemen_reservasi;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use PDOException;
use ErrorException;

class SanggarRiwayatReservasiController extends Controller
{
    public function index(Request $request)
    {
        $idUser = Auth::user()->sessionSanggar()->id;
        $queryUpacaraku = function ($queryUpacaraku){
            $queryUpacaraku->with(['Upacara','User.Penduduk'])->whereHas('User.Penduduk')->whereHas('Upacara');
        };
        $dataReservasi = Reservasi::with(['DetailReservasi.TahapanUpacara','Upacaraku'=>$queryUpacaraku])->whereHas('DetailReservasi.TahapanUpacara')->whereHas('Upacaraku',$queryUpacaraku)->whereIdSanggar($idUser)->get();
        return view('pages.sanggar.manajemen-reservasi.sanggar-riwayat-index',compact('dataReservasi'));
    }


    public function detail($id)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$id],[
                'id' => 'required|exists:tb_reservasi,id',
            ]);

            if($validator->fails()){
                return redirect()->route('pemuput-karya.manajemen-reservasi.riwayat.index')->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Reservasi Tidak Ditemukan !',
                    'message' => 'Data Reservasi tidak ditemukan, pilihlah data dengan benar !',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                $idUser = Auth::user()->sessionSanggar()->id;
                $dataReservasi = Reservasi::with(['DetailReservasi'=>function($query){
                    $query->with(['TahapanUpacara','Gambar'])->whereHas('TahapanUpacara');
                }])->whereIdSanggar($idUser)
                ->findOrFail($id);

                // dd($dataReservasi);
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return \redirect()->route('sanggar.manajemen-reservasi.riwayat.index')->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Sistem Gagal Menemukan Data Reservasi !',
                    'message' => 'sistem gagal menemukan Data Reservasi, mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END MAIN LOGIC

        // RETURN
            return view('pages.sanggar.manajemen-reservasi.sanggar-riwayat-detail',compact('dataReservasi'));
        // END RETURN
    }

}
