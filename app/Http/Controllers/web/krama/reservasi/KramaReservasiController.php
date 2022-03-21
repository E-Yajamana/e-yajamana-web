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
use App\Models\User;
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
use NotificationHelper;

class KramaReservasiController extends Controller
{
    // INDEX RESERVASI KRAMA
    public function indexReservasi(Request $request)
    {
        // MAIN LOGIC
            try{
                $idKrama = Auth::user()->id;
                $dataReservasi = Upacaraku::with(['Reservasi.DetailReservasi','Reservasi.Relasi'=>function($query){
                    $query->with(['PemuputKarya','Sanggar']);
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
                $user = Auth::user();
                $dataUpacaraku = Upacaraku::with(['Upacara'])->findOrFail($request->id);
                $dataUserReservasi = Reservasi::where('id_upacaraku',$request->id)->whereNotIn('status',['batal','selesai'])->whereTipe('pemuput_karya')->pluck('id_relasi')->toArray();
                array_push($dataUserReservasi, $user->id);

                $dataSanggar = Sanggar::with('User.Penduduk')->whereHas('User.Penduduk')->where('status_konfirmasi_akun','disetujui')->get();

                $dataPemuputKarya = GriyaRumah::query();
                $sulinggihQuery = function($sulinggihQuery) use ($dataUserReservasi){
                    $sulinggihQuery->with(['AtributPemuput','User'])->where('status_konfirmasi_akun','disetujui')->whereNotIn('id_user',$dataUserReservasi);
                };
                $dataPemuputKarya->with([
                    'PemuputKarya' => $sulinggihQuery
                    ])->whereHas('PemuputKarya',$sulinggihQuery);
                $dataPemuputKarya = $dataPemuputKarya->get();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Menemukan Data Reservasi !',
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
                'tipe' => 'required|in:pemuput_karya,sanggar',
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

                $relasi = User::findOrFail($request->id_relasi);
                $user = Auth::user();

                // SEND NOTIFICATION
                NotificationHelper::sendNotification(
                    [
                        'title' => "RESERVASI BARU",
                        'body' => "Terdapat krama yang mengajukan pemuputan karya, reservasi dapat dilihat pada menu Reservasi Masuk",
                        'status' => "new",
                        'image' => "krama",
                        'notifiable_id' => $relasi->id,
                        'formated_created_at' => date('Y-m-d H:i:s'),
                        'formated_updated_at' => date('Y-m-d H:i:s'),
                    ],
                    $relasi
                );
                NotificationHelper::sendNotification(
                    [
                        'title' => "PERMOHONAN RESERVASI DIBUAT",
                        'body' => "Permohonan reservasi kepada " . $relasi->getRelasi($request->tipe)->nama . " telah berhasil dilakukan, dimohon untuk menunggku konfirmasi dari pihak pemuput karya",
                        'status' => "new",
                        'image' => "sulinggih",
                        'notifiable_id' => $user->id,
                        'formated_created_at' => date('Y-m-d H:i:s'),
                        'formated_updated_at' => date('Y-m-d H:i:s'),
                    ],
                    $user
                );
                // END SEND NOTIFICATION

                DB::commit();
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                DB::rollback();
                return \redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Sistem Gagal Menambahkan Data Reservasi !',
                    'message' => $err,
                ]);
            }
        // END LOGIC

        // RETURN
            return redirect()->route('krama.manajemen-reservasi.index')->with([
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
                $idUser = Auth::user()->id;
                $queryUpacaraku = function ($queryUpacaraku) use ($idUser){
                    $queryUpacaraku->with('Upacara','User')->whereIdKrama($idUser);
                };
                $dataReservasi = Reservasi::with(['Relasi.Penduduk','DetailReservasi.TahapanUpacara','Upacaraku'=> $queryUpacaraku])->whereHas('Relasi')->whereHas('Upacaraku',$queryUpacaraku)->whereHas('DetailReservasi.TahapanUpacara')->findOrFail($request->id);
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return \redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Sistem Gagal Menemukan Reservasi !',
                    'message' => 'sistem gagal  Menemukan Data Reservasi, mohon untuk menghubungi developer sistem untuk lebih lanjut!',
                ]);
            }
        // END LOGIC

        // RETURN
            return view('pages.krama.manajemen-reservasi.krama-reservasi-detail',compact('dataReservasi'));
        // ENDRETURN

    }
    // DETAIL RESERVASI KRAMA

    // DELETE RESERVASI KRAMA
    public function deleteReservasi(Request $request)
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

        // MAIN LOGFIC
            try{
                $reservasi = Reservasi::whereIn('status',['pending','proses tangkil'])->findOrFail($request->id);
                $reservasi->update(['status'=>'batal']);
                $reservasi->DetailReservasi()->update(['status'=>'batal']);
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Menghapus Data Reservasi!',
                    'message' => 'Data Reservasi gagal dihapus, karena status reservasi telah belangsung / selesai  !',
                ]);
            }
        // MAIN LOGIC

        // RETURN
            return redirect()->route('krama.manajemen-reservasi.index')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Membatalkan Reservasi',
                'message' => 'Berhasil membatalkan Reservasi, data terbaru dapat dilihat pada menu data reservasi!',
            ]);
        // END RETURN
    }
    // DELETE RESERVASI KRAMA

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

                $data = DetailReservasi::with(['TahapanUpacara','Reservasi'])->whereIdReservasi($request->id_reservasi)->get();

            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return response()->json([
                    'status' => 400,
                    'icon' => 'error',
                    'message' => 'Gagal Menambahkan data reservasi',
                    'error' => $validator->errors()
                ],400);
            }
        // MAIN LOGIC

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

    // AJAX UPDATE RESERVASI
    public function ajaxUpdateReservasi(Request $request)
    {
         // SECURITY
            $validator = Validator::make($request->all(),[
                'id_detail_reservasi' => 'required|exists:tb_detail_reservasi,id',
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
                DetailReservasi::find($request->id_detail_reservasi)->update([
                    'id_reservasi'=> $request->id_reservasi,
                    'id_tahapan_upacara'=> $request->id_tahapan_upacara,
                    'tanggal_mulai'=> $start,
                    'tanggal_selesai'=> $end,
                    'status' => $request->status
                ]);
                DB::commit();

                $data = DetailReservasi::with(['TahapanUpacara','Reservasi'])->whereIdReservasi($request->id_reservasi)->get();

            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return response()->json([
                    'status' => 400,
                    'icon' => 'error',
                    'message' => 'Gagal Menambahkan data reservasi',
                    'error' => $validator->errors()
                ],400);
            }
        // MAIN LOGIC


        // RETURN JSON AJAX DATA
            return response()->json([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Mengubah Data Reservasi',
                'message' => 'Data Reservasi berhasil diubah dari sistem',
                'data' => $data
        ],200);
        // RETURN JSON AJAX DATA

    }
    // AJAX UPDATE RESERVASI

    // AJAX DELETE RESERVASI
    public function ajaxDeleteReservasi(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'id_detail_reservasi' => 'required|exists:tb_detail_reservasi,id',
                'id_reservasi' => 'required|exists:tb_reservasi,id',
            ],
            [
                'id_detail_reservasi.required' => "ID Reservasi wajib diisi",
                'id_detail_reservasi.exists' => 'ID Reservasi tidak sesuai dengan di sistem',
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
                DetailReservasi::findOrFail($request->id_detail_reservasi)->update(['status'=>'batal']);
                $dataDetailReservasi = DetailReservasi::whereIdReservasi($request->id_reservasi)->whereIn('status',['pending','diterima'])->count();
                if($dataDetailReservasi == 0){
                    Reservasi::findOrFail($request->id_reservasi)->update(['status'=>'batal']);
                }
                $data = DetailReservasi::with(['TahapanUpacara','Reservasi'])->whereIdReservasi($request->id_reservasi)->get();
                DB::commit();
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return response()->json([
                    'status' => 400,
                    'icon' => 'error',
                    'message' => 'Gagal Menambahkan data reservasi',
                    'error' => $validator->errors()
                ],400);
            }
        // MAIN LOGIC

        // RETURN
            return response()->json([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Membatalkan Reservasi',
                'message' => 'Data Reservasi berhasil dihapus dari sistem',
                'data' =>$data
            ],200);
        // END RETURN
    }
    // AJAX DELETE RESERVASI




}
