<?php

namespace App\Http\Controllers\web\pemuput_karya\manajemen_reservasi;

use App\DateRangeHelper;
use App\Http\Controllers\Controller;
use App\Models\DetailReservasi;
use App\Models\Reservasi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use ErrorException;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Mavinoo\Batch\BatchFacade;
use NotificationHelper;
use PDOException;

class ReservasiMasukController extends Controller
{
    // INDEX VIEW DATA RESERVASI MASUK
    public function index(Request $request)
    {
        // MAIN LOGIC
            try{
                $dataReservasi = Reservasi::with(['Relasi','DetailReservasi','Upacaraku.User.Penduduk']);
                $queryDetailReservasi = function($queryDetailReservasi){
                    $queryDetailReservasi->where('status','pending');
                };
                $dataReservasi->with(['DetailReservasi'=>$queryDetailReservasi])->whereHas('DetailReservasi',$queryDetailReservasi)->whereHas('Upacaraku.User.Penduduk');
                $dataReservasi = $dataReservasi->whereIdRelasi(Auth::user()->id)->whereIn('status',['pending'])->get();
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
    // INDEX VIEW DATA RESERVASI MASUK

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
                $dataReservasi = Reservasi::with(['Upacaraku.User.Penduduk','DetailReservasi.TahapanUpacara'])
                    ->whereIdRelasi($idUser)
                    ->whereHas('Upacaraku.User.Penduduk')
                    ->whereStatus('pending')
                    ->findOrFail($request->id);
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
            return view('pages.pemuput-karya.manajemen-reservasi.pemuput-reservasi-masuk-detail',compact('dataReservasi'));
        // END RETURN

    }
    // DETAIL RESERVASI MASUK

    // VERIFIKASI RESERVASI
    public function update(Request $request)
    {
        // SECURITY
            $rules = [
                'id_reservasi' => 'required|exists:tb_reservasi,id',
                'status' => 'required',
            ];

            if($request->id_tahapan != null){
                $rules['id_tahapan'] = 'required';
                $type = 'specific';
            }else{
                $type = 'all';
            }

            $validator = Validator::make($request->all(),$rules);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Memperbarui Status',
                    'message' => 'Gagal memperbarui status ke sistem, Cek kembali alasan penolakan anda!'
                ]);
            }
        // END SECURITY

        // MAIN LOGIC
        try{
            DB::beginTransaction();

            $reservasi = Reservasi::findOrFail($request->id_reservasi);

            $user = Auth::user();
            $relasi = User::findOrFail($reservasi->id_relasi);
            $tanggal_tangkil = null;
            $keterangan = null;
            switch($type){
                case 'specific':

                    $dataDetailReservasi = [];
                    foreach ($request->id_tahapan as $key => $value) {
                        $dataDetailReservasi[] = [
                            'id' => $value,
                            'status' => $request->status[$key],
                            'keterangan' => $request->alasan_pembatalan[$key],
                        ];
                    }
                    BatchFacade::update(new DetailReservasi(), $dataDetailReservasi, 'id');

                    $ditolak = 0;
                    foreach ($request->status as $value) {
                        if ($value == 'diterima') {
                            $statusReservasi = 'proses tangkil';

                            $tanggal_tangkil = DateRangeHelper::parseSingleDate($request->tanggal_tangkil);
                            break;
                        }
                        if ($value == 'ditolak') {
                            $ditolak += 1;
                            if ($ditolak == count($request->status)) {
                                $keterangan = $request->alasan_pembatalan[0];
                                $statusReservasi = 'ditolak';
                                break;
                            }
                        }
                        if ($value == 'pending') {
                            $statusReservasi = 'pending';
                        }else{
                            $statusReservasi = '';
                        }
                    }
                    break;
                case 'all':
                    $reservasi->DetailReservasi()->update(['status'=>$request->status,'keterangan'=>$request->alasan_pembatalan]);
                    if($request->tanggal_tangkil != null){
                        $tanggal_tangkil = DateRangeHelper::parseSingleDate($request->tanggal_tangkil);
                        $statusReservasi = 'proses tangkil';
                    }else{
                        $statusReservasi = 'ditolak';
                        $keterangan = $request->alasan_pembatalan;
                    }
                    break;
                default:
                    return redirect()->back()->with([
                        'status' => 'fail',
                        'icon' => 'error',
                        'title' => 'Gagal Memperbarui Status',
                        'message' => 'Gagal memperbarui status ke sistem, Hubungi Developer untuk lebih lanjut'
                    ]);
            }

            $reservasi->update([
                'tanggal_tangkil' => $tanggal_tangkil,
                'status' => $statusReservasi,
                'keterangan' => $keterangan,
            ]);

            switch($statusReservasi){
                case 'proses tangkil':
                    $title = "RESERVASI DITERIMA";
                    $messagePemuput = "Konfirmasi Reservasi berhasil dilakukan, data Reservasi yang diterima dapat dilihat pada menu Konfirmasi Tangkil";
                    $messageKrama = "Halo Krama Bali ! Reservasi anda dengan ID : ".$request->id_reservasi." telah diterima oleh ".$user->PemuputKarya->nama_pemuput.", harap datang ke Griya pada tanggal : ".$request->tanggal_tangkil." untuk berdiskusi lebih lanjut.";
                    break;
                case 'ditolak':
                    $title = "RESERVASI DITOLAK";
                    $messagePemuput = "Berhasil menolak Reservasi. anda dapat melihat semua data Reservasi yang masuk pada menu Riwayat Reservasi";
                    $messageKrama = "Halo Krama Bali ! Reservasi anda dengan ID : ".$request->id_reservasi." telah ditolak oleh ".$user->PemuputKarya->nama_pemuput.", mohon untuk mencari pemuput karya lainnya";
                    break;
                default:
            }

            // NOTIFICATION
            NotificationHelper::sendNotification(
                [
                    'title' => $title,
                    'body' => $messagePemuput,
                    'status' => "new",
                    'image' => "normal",
                    'notifiable_id' => $user->id,
                    'type' => "pemuput",
                    'formated_created_at' => date('Y-m-d H:i:s'),
                    'formated_updated_at' => date('Y-m-d H:i:s'),
                ],
                $user
            );

            NotificationHelper::sendNotification(
                [
                    'title' => $title,
                    'body' => $messageKrama,
                    'status' => "new",
                    'image' => "sulinggih",
                    'type' => "krama",
                    'notifiable_id' => $relasi->id,
                    'formated_created_at' => date('Y-m-d H:i:s'),
                    'formated_updated_at' => date('Y-m-d H:i:s'),
                ],
                $relasi
            );
            // NOTIFICATION

            DB::commit();
        }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
            DB::rollBack();
            return redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Gagal Memperbarui Status',
                'message' => 'Gagal memperbarui status ke sistem, Hubungi Developer untuk lebih lanjut'
            ]);
        }
        // END MAIN LOGIC

        // RETURN
            return redirect()->route('pemuput-karya.manajemen-reservasi.index')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Memperbarui Status Reservasi',
                'message' => 'Berhasil Memperbarui Status Reservasi, Data terbaru dapat dilihat pada menu data muput upacara',
            ]);
        // END RETURN

    }
    // VERIFIKASI RESERVASI

}
