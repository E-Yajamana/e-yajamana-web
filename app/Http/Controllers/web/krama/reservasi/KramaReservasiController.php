<?php

namespace App\Http\Controllers\web\krama\reservasi;

use App\Http\Controllers\Controller;
use App\Models\GriyaRumah;
use App\Models\Sanggar;
use App\Models\Upacaraku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Doctrine\DBAL\Query\QueryException;
use PDOException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class KramaReservasiController extends Controller
{
    // INDEX RESERVASI KRAMA
    public function indexReservasi(Request $request)
    {
        return view('pages.krama.manajemen-reservasi.krama-reservasi-index');
    }
    // INDEX RESERVASI KRAMA

    // CRAETE RESERVASI KRAMA
    public function createReservasi(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_upacaraku,id',
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Upacaraku Tidak Ditemukan !',
                    'message' => 'Data Upacaraku tidak ditemukan, pilihlah data dengan benar!',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                $dataUpacaraku = Upacaraku::with(['Upacara'])->findOrFail($request->id);

                $dataSanggar = Sanggar::where('status_konfirmasi_akun','disetujui')->get();
                $dataPemuputKarya = GriyaRumah::query()->with('Sulinggih')->whereHas('Sulinggih');
                $sulinggihQuery = function($sulinggihQuery){
                    $sulinggihQuery->with('User')->where('status_konfirmasi_akun','disetujui');
                };
                $dataPemuputKarya->with([
                    'Sulinggih' => $sulinggihQuery
                ])->whereHas('Sulinggih',$sulinggihQuery);
                $dataPemuputKarya = $dataPemuputKarya->get();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Reservasi Tidak ditemukan !',
                    'message' => 'Data Reservasi Tidak ditemukan, mohon hubungi developer untuk lebih lanjut!',
                ]);
            }
        // END LOGIC

        // RETRUN
            // dd($dataPemuputKarya);
            return view('pages.krama.manajemen-reservasi.krama-reservasi-create',compact(['dataUpacaraku','dataPemuputKarya','dataSanggar']));
        // END RETURN
    }
    // CRAETE RESERVASI KRAMA


    // STORE RESERVASI KRAMA
    public function storeReservasi(Request $request)
    {
        dd($request->all());
    }
    // STORE RESERVASI KRAMA


}
