<?php

namespace App\Http\Controllers\web\sanggar\manajemen_reservasi;

use PDOException;
use ErrorException;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\web\pemuput_karya\manajemen_reservasi\ReservasiMasukController as Manajemen_reservasiReservasiMasukController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class ReservasiMasukController extends Controller
{
    // INDEX
    public function index()
    {
        // MAIN LOGIC
            try{
                $dataReservasi = Reservasi::with(['Relasi','DetailReservasi','Upacaraku.User.Penduduk']);
                $queryDetailReservasi = function($queryDetailReservasi){
                    $queryDetailReservasi->where('status','pending');
                };
                $dataReservasi->with(['DetailReservasi'=>$queryDetailReservasi])->whereHas('DetailReservasi',$queryDetailReservasi)->whereHas('Upacaraku.User.Penduduk');
                $dataReservasi = $dataReservasi->whereIdSanggar(session('id_sanggar'))->whereIn('status',['pending'])->get();
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return \redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Sistem Gagal Menemukan Data Reservasi Masuk !',
                    'message' => 'sistem gagal menemukan Data Reservasi Masuk, mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END LOGIC

        // RETURN
            return view('pages.pemuput-karya.manajemen-reservasi.pemuput-reservasi-masuk-index',compact('dataReservasi'));
        // END RETURN
    }
    // INDEX

    // DETAIL RESERVASI MASUK
    public function detailReservasi(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_reservasi,id',
            ]);

            if($validator->fails()){
                return redirect()->route('admin.master-data.griya.index')->with([
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
                $dataReservasi = Reservasi::with(['Upacaraku.User.Penduduk','DetailReservasi.TahapanUpacara'])->whereIdRelasi($idUser)->whereHas('Upacaraku.User.Penduduk')->whereStatus('pending')->findOrFail($request->id);
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return \redirect()->route('pemuput-karya.manajemen-reservasi.index')->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Sistem Gagal Menemukan Data Reservasi !',
                    'message' => 'sistem gagal menemukan Data Reservasi, mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END MAIN LOGIC

        $service = new Manajemen_reservasiReservasiMasukController;
        $service->update($request);

        // RETURN
            return view('pages.pemuput-karya.manajemen-reservasi.pemuput-reservasi-masuk-detail',compact('dataReservasi'));
        // END RETURN

    }
    // DETAIL RESERVASI MASUK

}
