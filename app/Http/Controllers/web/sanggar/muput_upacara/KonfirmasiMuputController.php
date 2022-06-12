<?php

namespace App\Http\Controllers\web\sanggar\muput_upacara;

use App\Http\Controllers\Controller;
use App\ImageHelper;
use App\Models\DetailReservasi;
use App\Models\Reservasi;
use App\Models\Upacaraku;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Arr;
use Mockery\Expectation;
use NotificationHelper;
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
                $sanggar = Auth::user()->sessionSanggar();
                $queryReservasi = function ($queryReservasi) use ($sanggar){
                    $queryReservasi->with('Upacaraku')->whereHas('Upacaraku')->where('id_sanggar',$sanggar->id);
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
            return view('pages.sanggar.manajemen-muput.konfirmasi-muput-detail', compact('dataDetailReservasi'));
        // END RETURN
    }
    // DETAIL UPACARA

     // KONFRIMASI MUPUT
     public function konfirmasiMuput(Request $request)
     {
         // SECURITY
         $validator = Validator::make($request->all(),
             [
                 'id_detail_reservasi' => 'required|exists:tb_detail_reservasi,id',
                 'id_upacaraku' => 'required|exists:tb_upacaraku,id',
                 // 'file' => 'required|image|mimes:png,jpg,jpeg|max:2500',
             ],
             [
                 'id_detail_reservasi.required' => "ID Detail Reservasi wajib diisi",
                 'id_detail_reservasi.exists' => "ID Detail Reservasi tidak sesuai",
                 // 'file.required' => "Bukti muput wajib diisi",
                 // 'file.image' => "Gambar harus berupa foto",
                 // 'file.mimes' => "Format gambar harus jpeg, png atau jpg",
                 // 'file.size' => "Gambar maksimal berukuran 2.5 Mb",
             ]
         );

         if ($validator->fails()) {
             return redirect()->back()->with([
                 'status' => 'fail',
                 'icon' => 'error',
                 'title' => 'Gagal memperbarui status!',
                 'message' => 'Gagal memperbarui status, silakan periksa kembali form input anda!'
             ])->withInput($request->all())->withErrors($validator->errors());
         }
         // END

         // MAIN LOGIC
         try {
             DB::beginTransaction();
             $sanggar = Auth::user()->sessionSanggar();
             $detailReservasi = DetailReservasi::with(['Reservasi'])->findOrFail($request->id_detail_reservasi);

             if($request->file != null){
                 foreach($request->file as $data){
                     $folder = 'app/sulinggih/bukti-muput/upacara/';
                     $filename[] = ['image'=>ImageHelper::moveImage($data, $folder)];
                 }
                 $detailReservasi->Gambar()->createMany($filename);
             }
             $upacaraku = Upacaraku::findOrFail($request->id_upacaraku);
             $krama = User::findOrFail($upacaraku->id_krama);

             $detailReservasi->update(['status' => 'selesai']);
             $countDetailReservasi = DetailReservasi::whereIdReservasi($detailReservasi->id_reservasi)->whereIn('status', ['diterima'])->count();
             $jumlahReservasi = Reservasi::whereIdUpacaraku($detailReservasi->Reservasi->id_upacaraku)->whereIn('status', ['pending','proses tangkil', 'proses muput'])->whereNotIn('id', [$detailReservasi->id_reservasi])->count();
             if ($countDetailReservasi == 0) {
                 Reservasi::findOrFail($detailReservasi->id_reservasi)->update(['status' => 'selesai']);
             }
             if ($jumlahReservasi == 0) {
                 Upacaraku::findOrFail($detailReservasi->Reservasi->id_upacaraku)->update([
                     'status' => 'selesai'
                 ]);
             }

             // SELF NOTIF
             $dataUserSanggar = collect([]);
             $id_user_sanggar = $sanggar->User->pluck('id');
             $dataUserSanggar->push(collect($sanggar->User));
             $userSanggar = (Arr::collapse($dataUserSanggar));

             // NOTIFICATION
             NotificationHelper::sendMultipleNotification(
                 [
                     'title' => "JADWAL MUPUT",
                     'body' => "Halo !! Terdapat jadwal reservasi baru yang harus dilakukan. Untuk lebih lanjut dapat dilihat pada menu Konfirmasi Muput!",
                     'status' => "new",
                     'image' => "/logo-eyajamana.png",
                     'type' => "sanggar",
                     'id_sanggar' =>array($sanggar->id),
                     'formated_created_at' => date('Y-m-d H:i:s'),
                     'formated_updated_at' => date('Y-m-d H:i:s'),
                 ],
                 $userSanggar
             );

             // SELF NOTIF
             NotificationHelper::sendNotification(
                 [
                     'title' =>"MUPUT UPACARA SELESAI",
                     'body' => "Halo Krama Bali !!, ".$sanggar->nama_sanggar." sudah menyelesaikan Muput Upacara pada tahapan ".$detailReservasi->TahapanUpacara->nama_tahapan." ! ",
                     'status' => "new",
                     'image' => "normal",
                     'type' => "krama",
                     'notifiable_id' => $krama->id,
                     'formated_created_at' => date('Y-m-d H:i:s'),
                     'formated_updated_at' => date('Y-m-d H:i:s'),
                 ],
                 $krama
             );
             // NOTIFICATION
             DB::commit();
         } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
             DB::rollBack();
             return redirect()->back()->with([
                 'status' => 'fail',
                 'icon' => 'error',
                 'title' => 'Gagal Mengkonformasi Muput',
                 'message' => 'Gagal Mengkonformasi Muput, apabila diperlukan mohon hubungi developer sistem`',
             ]);
         }
         // END LOGIC

         // RETURN
             return redirect()->route('sanggar.muput-upacara.konfirmasi-muput.index')->with([
                 'status' => 'success',
                 'icon' => 'success',
                 'title' => 'Berhasil menyelesaikan muput upacara!',
                 'message' => 'Data konfirmasi muput dapat dilihat pada menu muput upacara, anda dapat melihat pembaruan data pada sistem',
             ]);
         //END

     }
     // KONFRIMASI MUPUT


    // BATAL MUPUT UPACARA
    public function batalMuput(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(), [
                'id_detail_reservasi' => 'required|exists:tb_detail_reservasi,id',
                'id_upacaraku' => 'required|exists:tb_upacaraku,id',
                'alasan_pembatalan' => 'required',
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
                DB::beginTransaction();
                $sanggar = Auth::user()->sessionSanggar();
                $detailReservasi = DetailReservasi::findOrFail($request->id_detail_reservasi);
                $lastReservation = DetailReservasi::whereIdReservasi($detailReservasi->id_reservasi)->whereIn('status',['diterima'])->count();
                $upacaraku = Upacaraku::findOrFail($request->id_upacaraku);
                $krama = User::findOrFail($upacaraku->id_krama);
                if($lastReservation <= 1){
                    $reservasi = Reservasi::findOrFail($detailReservasi->id_reservasi);
                    $countReservasi = Reservasi::whereIdUpacaraku($reservasi->id_upacaraku)->whereIn('status',['pending','proses tagnkil','proses muput'])->count();
                    if($countReservasi <= 1){
                        $upacaraku->update(['status','selesai']);
                    }
                    $reservasi->update(['status'=>'selesai']);
                }
                $detailReservasi->update([
                    'status'=>'batal',
                    'keterangan'=>$request->alasan_pembatalan,
                ]);

                // SELF NOTIF
                $dataUserSanggar = collect([]);
                $id_user_sanggar = $sanggar->User->pluck('id');
                $dataUserSanggar->push(collect($sanggar->User));
                $userSanggar = (Arr::collapse($dataUserSanggar));

                // NOTIFICATION
                NotificationHelper::sendMultipleNotification(
                    [
                        'title' => "JADWAL MUPUT",
                        'body' => "Halo !! Terdapat jadwal reservasi baru yang harus dilakukan. Untuk lebih lanjut dapat dilihat pada menu Konfirmasi Muput!",
                        'status' => "new",
                        'image' => "/logo-eyajamana.png",
                        'type' => "sanggar",
                        'id_sanggar' =>array($sanggar->id),
                        'formated_created_at' => date('Y-m-d H:i:s'),
                        'formated_updated_at' => date('Y-m-d H:i:s'),
                    ],
                    $userSanggar
                );

                NotificationHelper::sendNotification(
                    [
                        'title' =>"PEMBATALAN MUPUT UPACARA",
                        'body' => "Halo Krama Bali !!, ".$sanggar->nama_sanggar." membatalkan tahapan Upacara ".$detailReservasi->TahapanUpacara->nama_tahapan." dengan alasan pembatalan : ".$request->alasan_pembatalan,
                        'status' => "new",
                        'image' => "normal",
                        'notifiable_id' => $krama->id,
                        'formated_created_at' => date('Y-m-d H:i:s'),
                        'formated_updated_at' => date('Y-m-d H:i:s'),
                    ],
                    $krama
                );
                // NOTIFICATION

                DB::commit();
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
            return redirect()->route('sanggar.muput-upacara.konfirmasi-muput.index')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Muput Upacara dibatalkan!',
                'message' => 'Data Reservasi muput dapat dilihat pada menu muput upacara, anda dapat melihat pembaruan data pada sistem',
            ]);
        //END
    }
    // BATAL MUPUT UPACARA


}
