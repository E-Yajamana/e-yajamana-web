<?php

namespace App\Http\Controllers\web\krama\reservasi;

use App\Http\Controllers\Controller;
use App\Models\GriyaRumah;
use App\Models\Reservasi;
use App\Models\Sanggar;
use App\Models\Sulinggih;
use App\Models\Upacaraku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Support\Str;
use PDOException;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class KramaReservasiController extends Controller
{
    // INDEX RESERVASI KRAMA
    public function indexReservasi(Request $request)
    {
        // $dataReservasi = Upacaraku::query()->with('Reservasi')->whereHas('Reservasi')->get();
        $dataReservasi = Upacaraku::query();
        $queryReservasi = function($queryReservasi){
            $queryReservasi->with('DetailReservasi')->whereHas('DetailReservasi');
        };
        $dataReservasi->with('Reservasi',$queryReservasi)->whereHas('Reservasi');
        $dataReservasi = $dataReservasi->where('id_krama',Auth::user()->Krama->id)->get();

        // dd($dataReservasi);

        // $dataReservasi = Reservasi::with(['DetailReservasi','Sulinggih']);
        // $queryUpacaraku = function ($queryUpacaraku){
        //     $queryUpacaraku->where('id_krama',Auth::user()->Krama->id);
        // };

        // $dataReservasi->with('Upacaraku',$queryUpacaraku)->whereHas('Upacaraku',$queryUpacaraku)->whereHas('DetailReservasi');

        // $dataReservasi = $dataReservasi->get();
        // // dd($dataReservasi);


        return view('pages.krama.manajemen-reservasi.krama-reservasi-index',compact('dataReservasi'));
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
                $dataUserReservasi = Reservasi::where('id_upacaraku',$request->id)->pluck('id_relasi');
                $dataPemuputKarya = GriyaRumah::query();
                $sulinggihQuery = function($sulinggihQuery) use ($dataUserReservasi){
                    $sulinggihQuery->with('User')->where('status_konfirmasi_akun','disetujui')->whereNotIn('id',$dataUserReservasi);
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
            return view('pages.krama.manajemen-reservasi.krama-reservasi-create',compact(['dataUpacaraku','dataPemuputKarya','dataSanggar']));
        // END RETURN
    }
    // CRAETE RESERVASI KRAMA

    // STORE RESERVASI KRAMA
    public function storeReservasi(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'id_relasi' => 'required',
                'id_upacaraku' => 'required|exists:tb_upacaraku,id',
                'tipe' => 'required|in:sulinggih_pemangku,sanggar',
                'data_detail.*.idTahapan' => 'required',
                'data_detail.*.tanggal' => 'required',
            ],
            [
                'id_relasi.required' => "ID Relasi wajib diisi",
                'id_upacaraku.required' => 'ID Upacaraku wajib diisi',
                'id_upacaraku.exists' => 'Id Upacaraku tidak sesuai dengan di sistem',
                'tipe.required' => 'Tipe input wajib diisi',
                'tipe.in' => 'Tipe tidak sesuai dengan yang disediakan',
            ]);
            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Menambahkan Data Reservasi',
                    'message' => 'Gagal menambahkan data reservasi,harap kembali memeriksa form input anda'
                ])->withInput($request->all())->withErrors($validator->errors());
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                DB::beginTransaction();
                $reservasi = Reservasi::create([
                    'id_relasi' => $request->id_relasi,
                    'id_upacaraku' =>$request->id_upacaraku,
                    'tipe' =>$request->tipe,
                    'status' =>'pending',
                ]);

                foreach($request->data_detail as $data){
                    $parseDate = Str::of($data['tanggal'])->explode(' - ');
                    $startDate = new Carbon($parseDate[0]);
                    $endDate = new Carbon($parseDate[1]);
                    $reservasi->DetailReservasi()->create([
                        'id_tahapan_upacara' => $data['idTahapan'],
                        'tanggal_mulai' => $startDate->format('Y-m-d h:i:s'),
                        'tanggal_selesai' => $endDate->format('Y-m-d h:i:s'),
                        'status' => 'pending',
                    ]);
                }

                DB::commit();
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return \redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Sistem Gagal Menambahkan Data Reservasi !',
                    'message' => 'sistem gagal menambahkan data reservasi, mohon untuk menghubungi developer sistem untuk lebih lanjut!',
                ]);
            }
        // END LOGIC

        // RETURN
            return redirect()->route('krama.manajemen-upacara.upacaraku.index')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Membuat Data Upacara',
                'message' => 'Berhasil membuat data upacara, mohon diperiksa kembali',
            ]);
        // END RETURN

    }
    // STORE RESERVASI KRAMA





}
