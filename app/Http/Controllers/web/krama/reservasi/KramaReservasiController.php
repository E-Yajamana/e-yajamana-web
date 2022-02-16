<?php

namespace App\Http\Controllers\web\krama\reservasi;

use App\DateRangeHelper;
use App\Http\Controllers\Controller;
use App\Models\DetailReservasi;
use App\Models\GriyaRumah;
use App\Models\Reservasi;
use App\Models\Sanggar;
use App\Models\Sulinggih;
use App\Models\TahapanUpacara;
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
        // MAIN LOGIC
            try{
                $idKrama = Auth::user()->Krama->id;
                $dataReservasi = Upacaraku::with(['Reservasi.DetailReservasi','Reservasi.Relasi'=>function($query){
                    $query->with(['Sulinggih','Sanggar']);
                }])->whereHas('Reservasi.DetailReservasi')->whereHas('Reservasi.Relasi')->where('id_krama',$idKrama)->get();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Reservasi Tidak ditemukan !',
                    'message' => 'Data Reservasi Tidak ditemukan, mohon hubungi developer untuk lebih lanjut!',
                ]);
            }
        // END MAIN LOGIC

        // RETURN
            return view('pages.krama.manajemen-reservasi.krama-reservasi-index',compact('dataReservasi'));
        // END RETURN

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
                $dataUserReservasi = Reservasi::where('id_upacaraku',$request->id)->pluck('id_relasi');

                $dataSanggar = Sanggar::with('User.Penduduk')->whereHas('User.Penduduk')->where('status_konfirmasi_akun','disetujui')->whereNotIn('id_user',$dataUserReservasi)->get();

                $dataPemuputKarya = GriyaRumah::query();
                $sulinggihQuery = function($sulinggihQuery) use ($dataUserReservasi){
                    $sulinggihQuery->with('User')->where('status_konfirmasi_akun','disetujui')->whereNotIn('id_user',$dataUserReservasi);
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
                    'status' =>'pending',
                ]);

                $dataDetailReservasi = [];
                foreach($request->data_detail as $data){
                    list($start,$end) = DateRangeHelper::parseDateRangeTime($data['tanggal']);
                    $dataDetailReservasi[] = [
                        'id_tahapan_upacara' => $data['idTahapan'],
                        'tanggal_mulai' => $start,
                        'tanggal_selesai' => $end,
                        'status' => 'pending',
                    ];
                }
                $reservasi->DetailReservasi()->createMany($dataDetailReservasi);
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

    // DETAIL RESERVASI KRAMA
    public function detailReservasi(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_reservasi,id',
            ]);

            if($validator->fails()){
                return redirect()->route('krama.manajemen-upacara.upacaraku.index')->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Reservasi Tidak Ditemukan !',
                    'message' => 'Data Reservasi tidak ditemukan, pilihlah data dengan benar !',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                $dataReservasi = Reservasi::with(['Upacaraku.Upacara','Relasi.Penduduk','DetailReservasi.TahapanUpacara'])->whereHas('Relasi')->whereHas('DetailReservasi.TahapanUpacara')->findOrFail($request->id);
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
            return view('pages.krama.manajemen-reservasi.krama-reservasi-detail',compact('dataReservasi'));
        // ENDRETURN

    }
    // DETAIL RESERVASI KRAMA

    // AJAX STORE RESERVASI
    public function ajaxStoreReservasi(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'id_reservasi' => 'required|exists:tb_reservasi,id',
                'id_tahapan_upacara' => 'required|exists:tb_tahapan_upacara,id',
                'daterange' => 'required',
            ],
            [
                'id_reservasi.required' => "ID Reservasi wajib diisi",
                'id_reservasi.exists' => 'ID Reservasi tidak sesuai dengan di sistem',
                'id_tahapan_upacara.required' => 'Tahapan Upacara wajib diisi',
                'id_tahapan_upacara.exists' => 'Tahapan Upacara tidak sesuai dengan di sistem',
            ]);
            if($validator->fails()){
                return response()->json([
                    'status' => 400,
                    'icon' => 'error',
                    'message' => 'Gagal Menambahkan data reservasi',
                    'error' => $validator->errors()
                ],400);
            }
        // END SECURITY

        // MAIN LOGFIC
        try{
            DB::beginTransaction();
            list($start,$end) = DateRangeHelper::parseDateRangeTime($request->daterange);
            $detailReservasi = DetailReservasi::create([
                'id_reservasi'=> $request->id_reservasi,
                'id_tahapan_upacara'=> $request->id_tahapan_upacara,
                'tanggal_mulai'=> $start,
                'tanggal_selesai'=> $end,
                'status' => 'pending'
            ]);
            DB::commit();

            $data = DetailReservasi::with('TahapanUpacara')->whereIdReservasi($request->id_reservasi)->get();

        }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
            return response()->json([
                'status' => 400,
                'icon' => 'error',
                'message' => 'Gagal Menambahkan data reservasi',
                'error' => $validator->errors()
            ],400);
        }
        // MAIN LOGFIC

        // RETURN
                return response()->json([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Menambahkan Data Reservasi',
                'message' => 'Data Reservasi berhasil ditambahkan dari sistem',
                'data' => $data
            ],200);
        // END RETURN

    }
    // AJAX STORE RESERVASI



}
