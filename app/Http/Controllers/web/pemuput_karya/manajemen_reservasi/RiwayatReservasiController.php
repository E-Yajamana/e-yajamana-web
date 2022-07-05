<?php

namespace App\Http\Controllers\web\pemuput_karya\manajemen_reservasi;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use PDOException;
use ErrorException;


class RiwayatReservasiController extends Controller
{
    public function index(Request $request)
    {
        $idUser = Auth::user()->id;
        $queryUpacaraku = function ($queryUpacaraku){
            $queryUpacaraku->with(['Upacara','User.Penduduk'])->whereHas('User.Penduduk')->whereHas('Upacara');
        };
        $dataReservasi = Reservasi::with(['DetailReservasi.TahapanUpacara','Upacaraku'=>$queryUpacaraku])->whereHas('DetailReservasi.TahapanUpacara')->whereHas('Upacaraku',$queryUpacaraku)->whereIdRelasi($idUser)->get();
        return view('pages.pemuput-karya.manajemen-reservasi.pemuput-reservasi-riwayat-index',compact('dataReservasi'));
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
                $idUser = Auth::user()->id;
                $dataReservasi = Reservasi::with(['DetailReservasi'=>function($query){
                    $query->with(['TahapanUpacara','Gambar'])->whereHas('TahapanUpacara');
                }])->whereIdRelasi($idUser)
                ->findOrFail($id);

                // dd($dataReservasi);
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return \redirect()->route('pemuput-karya.manajemen-reservasi.index')->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Sistem Gagal Menemukan Data Reservasi !',
                    'message' => 'sistem gagal menemukan Data Reservasi, mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END MAIN LOGIC

        // RETURN
            return view('pages.pemuput-karya.manajemen-reservasi.pemuput-reservasi-riwayat-detail',compact('dataReservasi'));
        // END RETURN
    }

}
