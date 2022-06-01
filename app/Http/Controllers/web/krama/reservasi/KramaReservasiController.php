<?php

namespace App\Http\Controllers\web\krama\reservasi;

use App\DateRangeHelper;
use App\Http\Controllers\Controller;
use App\Models\DetailReservasi;
use App\Models\GriyaRumah;
use App\Models\Reservasi;
use App\Models\Sanggar;
use App\Models\Upacaraku;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Support\Str;
use PDOException;
use Carbon\Carbon;
use Illuminate\Support\Arr;
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
                $dataUpacaraku = Upacaraku::with(['Upacara','Reservasi.DetailReservasi','Reservasi.Relasi'=>function($query){
                    $query->with(['PemuputKarya','Sanggar']);
                }])->whereHas('Reservasi.DetailReservasi')->whereHas('Reservasi.Relasi')->where('id_krama',$idKrama)->get();

                $data = [];
                foreach($dataUpacaraku as $index=>$upacara){
                    foreach($upacara->Reservasi as $reservasi){
                        $dataDetail =  '<label>'.$upacara->Upacara->nama_upacara.' | '.$upacara->Upacara->kategori_upacara.'</label>';
                        foreach($reservasi->DetailReservasi as $detailReservasi){
                            $dataDetail .= '<li>'.$detailReservasi->TahapanUpacara->nama_tahapan.' | '.Str::upper($detailReservasi->status).'</li>';
                        }
                        $tindakan = '<a title="Detail Reservasi" href="'.route('krama.manajemen-reservasi.detail',$reservasi->id).'" class="btn btn-info btn-sm mr-1"><i class="fas fa-edit"></i></a>';
                        if($reservasi->status == 'pending' || $reservasi->status == 'proses tangkil' ){
                        }

                        if($reservasi->status == 'pending'){
                            $status = 'class="bg-secondary btn-sm"';
                            $tindakan .= '<button title="Batalkan Reservasi" onclick="batalReservasi('.$reservasi->id.')" class="btn btn-danger btn-sm"> <i class="fas fa-times"></i></button>';
                        }elseif($reservasi->status == 'proses tangkil' || $reservasi->status == 'proses muput' ){
                            $status = 'class="bg-primary btn-sm"';
                            if($reservasi->status == 'proses tangkil'){
                                $tindakan .= '<button title="Batalkan Reservasi" onclick="batalReservasi('.$reservasi->id.')" class="btn btn-danger btn-sm"> <i class="fas fa-times"></i></button>';
                            }
                        }elseif($reservasi->status == 'selesai'){
                            $status = 'class="bg-success btn-sm"';
                        }else{
                            $status = 'class="bg-danger btn-sm"';
                        }
                        $data[] = ((object)[
                            "No" => $index+1,
                            "NamaUpacara" => Str::headline($upacara->nama_upacara),
                            "PemuputUpacara" => Str::headline($reservasi->getRelasi()->nama),
                            "statusReservasi" => '<div class="d-flex justify-content-center text-center"><span '.$status.' style="border-radius: 5px; width:110px;">'.Str::headline($reservasi->status).'</span></div>',
                            "tahapanReservasi" => $dataDetail,
                            "tindakan" => $tindakan,
                        ]);
                    }

                }
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
            return view('pages.krama.manajemen-reservasi.krama-reservasi-index',compact('data'));
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
                $reservasiSanggar = Reservasi::where('id_upacaraku',$request->id)->whereNotIn('status',['batal','selesai'])->whereTipe('sanggar')->pluck('id_sanggar')->toArray();
                array_push($dataUserReservasi, $user->id);

                $dataSanggar = Sanggar::with('User.Penduduk')->whereHas('User.Penduduk')->where('status_konfirmasi_akun','disetujui')->whereNotIn('id',$reservasiSanggar)->get();

                $dataPemuputKarya = GriyaRumah::query();
                $sulinggihQuery = function($sulinggihQuery) use ($dataUserReservasi){
                    $sulinggihQuery->with(['AtributPemuput','User.Penduduk'])->where('status_konfirmasi_akun','disetujui')->whereNotIn('id_user',$dataUserReservasi);
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
                $request->tipe == 'sanggar'? $tipe = 'id_sanggar' : $tipe = 'id_relasi';

                $reservasi = Reservasi::create([
                    $tipe => $request->id_relasi,
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
                // NOTIFICATION
                    switch($request->tipe){
                        case 'pemuput_karya':
                            $relasi = User::findOrFail($request->id_relasi);
                            NotificationHelper::sendNotification(
                                [
                                    'title' => "RESERVASI BARU",
                                    'body' => "Terdapat krama yang mengajukan pemuputan karya, reservasi dapat dilihat pada menu Reservasi Masuk",
                                    'status' => "new",
                                    'image' => "krama",
                                    'type' => "pemuput",
                                    'notifiable_id' => $relasi->id,
                                    'formated_created_at' => date('Y-m-d H:i:s'),
                                    'formated_updated_at' => date('Y-m-d H:i:s'),
                                ],
                                $relasi
                            );
                            $namaReservasi = $relasi->PemuputKarya->nama_pemuput;
                            break;
                        case 'sanggar':
                            $dataUserSanggar = collect([]);
                            $dataSanggar = Sanggar::with(['User'])->whereHas('User')->findOrFail($request->id_relasi);
                            $dataUserSanggar->push(collect($dataSanggar->User));
                            $sanggar = (Arr::collapse($dataUserSanggar));
                            NotificationHelper::sendMultipleNotification(
                                [
                                    'title' => "RESERVASI BARU",
                                    'body' => "Terdapat krama yang mengajukan pemuputan karya, reservasi dapat dilihat pada menu Reservasi Masuk",
                                    'status' => "new",
                                    'image' => "/logo-eyajamana.png",
                                    'type' => "sanggar",
                                    'id_sanggar' => array($request->id_relasi),
                                    'formated_created_at' => date('Y-m-d H:i:s'),
                                    'formated_updated_at' => date('Y-m-d H:i:s'),
                                ],
                                $sanggar
                            );

                            $namaReservasi = $dataSanggar->nama_sanggar;
                            break;
                        default:
                    }

                    $user = Auth::user();

                    NotificationHelper::sendNotification(
                        [
                            'title' => "PERMOHONAN RESERVASI DIBUAT",
                            'body' => "Permohonan reservasi kepada ". $namaReservasi ." telah berhasil dilakukan, dimohon untuk menunggu konfirmasi reservasi.",
                            'status' => "new",
                            'image' => "/logo-eyajamana.png",
                            'type' => "krama",
                            'url' => ''.route('krama.manajemen-upacara.upacaraku.index').'',
                            'notifiable_id' => $user->id,
                            'formated_created_at' => date('Y-m-d H:i:s'),
                            'formated_updated_at' => date('Y-m-d H:i:s'),
                        ],
                        $user
                    );
                // NOTIFICATION
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
        // MAIN LOGIC

        // RETURN
            return redirect()->route('krama.manajemen-upacara.upacaraku.detail',$request->id_upacaraku)->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Membuat Data Reservasi',
                'message' => 'Berhasil membuat data Reservasi, data reservasi dapat dilihat pada detail upacara Krama',
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
            $validator = Validator::make($request->all(),[
                'id' => 'required|exists:tb_reservasi,id',
                'alasan_pembatalan' => 'required|min:5|max:120|regex:/^[a-z,. 0-9, -]+$/i',
            ],[
                'id.required' => "Reservasi wajib diisi",
                'id.exists' => "Data Reservasi tidak sesuai",
                'alasan_pembatalan.required' => "Alasan Pembatalan wajib diisi",
                'alasan_pembatalan.regex' => "Format Alasan Pembatalan tidak sesuai",
                'alasan_pembatalan.min' => "Alasan Pembatalan minimal berjumlah 5 karakter",
                'alasan_pembatalan.max' => "Alasan Pembatalan maksimal berjumlah 120 karakter",
            ]);

            if($validator->fails()){
                return redirect()->route('krama.manajemen-reservasi.index')->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Reservasi Tidak Ditemukan !',
                    'message' => 'Reservasi tidak ditemukan, cek kembali form input yang Anda masukan!',
                ]);
            }
        // END SECURITY

        // MAIN LOGFIC
            try{
                DB::beginTransaction();
                $user = Auth::user();
                $reservasi = Reservasi::whereIn('status',['pending','proses tangkil'])->findOrFail($request->id);
                $reservasi->update(['status'=>'batal','keterangan'=>$request->alasan_pembatalan]);
                $reservasi->DetailReservasi()->update(['status'=>'batal','keterangan'=>$request->alasan_pembatalan]);
                DB::commit();
                if($reservasi->tipe == "pemuput_karya"){
                    $relasi = User::findOrFail($reservasi->id_relasi);
                    // NOTIFICATION
                    NotificationHelper::sendNotification(
                        [
                            'title' => "PEMBATALAN RESERVASI",
                            'body' => "Pembatalan Reservasi dengan ID : ".$reservasi->id." kepada Pemuput Karya ".$relasi->PemuputKarya->nama_pemuput." berhasil dilakukan.",
                            'status' => "new",
                            'image' => "normal",
                            'notifiable_id' => $user->id,
                            'formated_created_at' => date('Y-m-d H:i:s'),
                            'formated_updated_at' => date('Y-m-d H:i:s'),
                        ],
                        $user
                    );

                    NotificationHelper::sendNotification(
                        [
                            'title' => "PEMBATALAN RESERVASI",
                            'body' => $user->Penduduk->nama." membatalkan Reservasinya, dengan alasan ".$request->alasan_pembatalan.". Harap kembali mengecek jadwal Mmuput terbaru!",
                            'status' => "new",
                            'image' => "krama",
                            'notifiable_id' => $relasi->id,
                            'formated_created_at' => date('Y-m-d H:i:s'),
                            'formated_updated_at' => date('Y-m-d H:i:s'),
                        ],
                        $relasi
                    );
                }
                // NOTIFICATION
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
                $reservasi = Reservasi::findOrFail($request->id_reservasi);
                $user = Auth::user();
                $detailReservasi = DetailReservasi::create([
                    'id_reservasi'=> $request->id_reservasi,
                    'id_tahapan_upacara'=> $request->id_tahapan_upacara,
                    'tanggal_mulai'=> $start,
                    'tanggal_selesai'=> $end,
                    'status' => 'pending'
                ]);
                if($reservasi->tipe == 'pemuput_karya'){
                    $relasi = User::findOrFail($reservasi->id_relasi);
                    NotificationHelper::sendNotification(
                        [
                            'title' => 'RESERVASI TAHAPAN BARU',
                            'body' => "Terdapat penambahan Reservasi  baru dari Krama ".$user->Penduduk->nama.", harap kembali mengecek jadwal Muput terbaru",
                            'status' => "new",
                            'image' => "krama",
                            'notifiable_id' => $relasi->id,
                            'formated_created_at' => date('Y-m-d H:i:s'),
                            'formated_updated_at' => date('Y-m-d H:i:s'),
                        ],
                        $relasi
                    );
                }
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
                $reservasi = Reservasi::findOrFail($request->id_reservasi);
                $user = Auth::user();
                DetailReservasi::find($request->id_detail_reservasi)->update([
                    'id_reservasi'=> $request->id_reservasi,
                    'id_tahapan_upacara'=> $request->id_tahapan_upacara,
                    'tanggal_mulai'=> $start,
                    'tanggal_selesai'=> $end,
                    'status' => $request->status
                ]);
                if($reservasi->tipe == 'pemuput_karya'){
                    $relasi = User::findOrFail($reservasi->id_relasi);
                    NotificationHelper::sendNotification(
                        [
                            'title' => 'PERUBAHAN RESERVASI',
                            'body' => "Terdapat perubahan Reservasi dari Krama ".$user->Penduduk->nama.", harap kembali mengecek jadwal Muput terbaru",
                            'status' => "new",
                            'image' => "krama",
                            'notifiable_id' => $relasi->id,
                            'formated_created_at' => date('Y-m-d H:i:s'),
                            'formated_updated_at' => date('Y-m-d H:i:s'),
                        ],
                        $relasi
                    );
                }
                // elsenya sanggar
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
                'alasan_pembatalan' => 'required',
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
                $user = Auth::user();
                DetailReservasi::findOrFail($request->id_detail_reservasi)->update(['status'=>'batal','keterangan'=>$request->alasan_pembatalan]);
                $dataDetailReservasi = DetailReservasi::with(['Reservasi'])->whereIdReservasi($request->id_reservasi)->whereIn('status',['pending','diterima'])->count();
                $reservasi = Reservasi::findOrFail($request->id_reservasi);
                $title = "PERUBAHAN RESERVASI";
                $body = "Terdapat perubahan Reservasi dari Krama ".$user->Penduduk->nama.", harap kembali mengecek jadwal Muput terbaru";

                if($reservasi->tipe == 'pemuput_karya'){
                    $relasi = User::findOrFail($reservasi->id_relasi);
                    if($dataDetailReservasi == 0){
                        $reservasi->update(['status'=>'batal']);
                        $title = "PEMBATALAN RESERVASI";
                        $body = $user->Penduduk->nama." membatalkan Reservasinya, dengan alasan ".$request->alasan_pembatalan.". Harap kembali mengecek jadwal Mmuput terbaru!";
                        NotificationHelper::sendNotification(
                            [
                                'title' => "PEMBATALAN RESERVASI",
                                'body' => "Pembatalan Reservasi dengan ID : ".$request->id_reservasi." kepada Pemuput Karya ".$relasi->PemuputKarya->nama_pemuput." berhasil dilakukan.",
                                'status' => "new",
                                'image' => "normal",
                                'notifiable_id' => $user->id,
                                'formated_created_at' => date('Y-m-d H:i:s'),
                                'formated_updated_at' => date('Y-m-d H:i:s'),
                            ],
                            $user
                        );
                    }
                    NotificationHelper::sendNotification(
                        [
                            'title' => $title,
                            'body' => $body,
                            'status' => "new",
                            'image' => "krama",
                            'notifiable_id' => $relasi->id,
                            'formated_created_at' => date('Y-m-d H:i:s'),
                            'formated_updated_at' => date('Y-m-d H:i:s'),
                        ],
                        $relasi
                    );
                }
                // ELSE SANGGAR BELUM

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
                'title' => 'Berhasil Membatalkan Reservasi',
                'message' => 'Data Reservasi berhasil dihapus dari sistem',
                'data' =>$data
            ],200);
        // END RETURN
    }
    // AJAX DELETE RESERVASI
}
