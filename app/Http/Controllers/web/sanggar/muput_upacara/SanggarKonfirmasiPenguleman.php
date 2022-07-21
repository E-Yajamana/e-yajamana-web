<?php

namespace App\Http\Controllers\web\sanggar\muput_upacara;

use App\Http\Controllers\Controller;
use App\Models\Upacaraku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PDOException;
use App\Models\DetailReservasi;
use App\Models\KeteranganKonfirmasi;
use App\Models\Reservasi;
use App\DateRangeHelper;
use App\Models\Sanggar;
use App\Models\User;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use ErrorException;
use Illuminate\Support\Facades\DB;
use Mavinoo\Batch\BatchFacade;
use NotificationHelper;
class SanggarKonfirmasiPenguleman extends Controller
{
    // INDEX VIEW MUPUT
    public function indexKonfirmasiTangkil(Request $request)
    {
        try {
            $sanggar = Auth::user()->sessionSanggar();
            $dataReservasi = Reservasi::with(['DetailReservasi', 'Upacaraku.User.Penduduk'])->whereHas('DetailReservasi');
            $queryDetailReservasi = function ($queryDetailReservasi) {
                $queryDetailReservasi->where('status', 'diterima');
            };
            $dataReservasi->with(['DetailReservasi' => $queryDetailReservasi])->whereHas('DetailReservasi', $queryDetailReservasi);
            $dataReservasi = $dataReservasi->whereIdSanggarAndStatus($sanggar->id, 'proses tangkil')->orderBy('tanggal_tangkil', 'asc')->get();
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            return \redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Internal server error  !',
                'message' => 'Internal server error , mohon untuk menghubungi developer sistem !',
            ]);
        }
        // RETURN
        return view('pages.sanggar.manajemen-muput.konfirmasi-tangkil-index', compact('dataReservasi'));
        // END RETURN
    }
    // INDEX VIEW MUPUT


    // EDIT KONFIRMASI TANGKIL
    public function editKonfirmasiTangkil(Request $request)
    {
        // SECURITY
        $validator = Validator::make(['id' => $request->id], [
            'id' => 'required|exists:tb_reservasi,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Reservasi Tidak Ditemukan !',
                'message' => 'Reservasi tidak ditemukan, pilihlah data dengan benar !',
            ]);
        }
        // END SECURITY

        // MAIN LOGIC
            try{
                $sanggar = Auth::user()->sessionSanggar();
                $dataReservasi = Reservasi::with(['DetailReservasi.TahapanUpacara','Upacaraku.User.Penduduk'])
                    ->whereHas('DetailReservasi.TahapanUpacara')
                    ->whereHas('Upacaraku.User.Penduduk')
                    ->whereIdSanggarAndStatus($sanggar->id,'proses tangkil')
                    ->findOrFail($request->id);
                $dataUpacara = Reservasi::with(['Relasi','DetailReservasi.TahapanUpacara'])
                    ->whereIdUpacaraku($dataReservasi->id_upacaraku)
                    ->whereNotIn('id',[$request->id])
                    ->whereIn('status',['pending','proses tangkil'])
                    ->get();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                return \redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Reservasi Tidak ditemukan!',
                    'message' => 'Data Reservasi Tidak ditemukan , mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END LOGIC

        // RETURN
        return view('pages.sanggar.manajemen-muput.konfirmasi-tangkil-edit', compact(['dataReservasi', 'dataUpacara']));
        // END RETURN
    }
    // EDIT KONFIRMASI TANGKIL


     // TERIMA TANGIL
     public function updateKonfirmasi(Request $request)
     {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'id_reservasi' =>'required|exists:tb_reservasi,id',
                // 'data_upacara' => "required|array|min:1",
                // "data_upacara.*"  => "required",
                'data_user_reservasi' =>'required|array',
                "data_user_reservasi.*"  => "required",
            ],
            [
                'id_reservasi.required' => "ID Reservasi wajib diisi",
                'id_reservasi.exists' => "ID Reservasi tidak sesuai",
                // 'data_upacara.required' => "Data Upacara wajib diisi",
                // 'data_upacara.array' => "Data Upacara tidak lengkap",
                'data_user_reservasi.required' => "Data Reservasi wajib diisi",
                'data_user_reservasi.array' => "Data Reservasi tidak lengkap",
            ]);

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
            try{
                DB::beginTransaction();
                $sanggar = Auth::user()->sessionSanggar();

                // UPACARAKU BUAT TIDAK BISA DIEDIT AJA
                $upacaraku = Upacaraku::findOrFail($request->data_upacara[0]['id']);
                $krama = User::findOrFail($upacaraku->id_krama);

                // UPDATE DATA RESERVASI
                $reservasi = Reservasi::whereIdUpacarakuAndIdSanggar($request->data_upacara[0]['id'], $sanggar->id)
                    ->findOrFail($request->id_reservasi)->update([
                        'status' => 'proses muput'
                    ]);
                // UPDATE DATA RESERVASI

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

                // KRAMA NOTIF
                NotificationHelper::sendNotification(
                    [
                        'title' => "PENGULEMAN BERHASIL DILAKUKAN",
                        'body' => "Halo Krama !! Anda berhasil melakukan Penguleman ke sanggar.",
                        'status' => "new",
                        'image' => "normal",
                        'notifiable_id' => $krama->id,
                        'formated_created_at' => date('Y-m-d H:i:s'),
                        'formated_updated_at' => date('Y-m-d H:i:s'),
                    ],
                    $krama
                );
                // KRAMA NOTIF

                DB::commit();
            } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
                DB::rollBack();
                return \redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Reservasi Tidak ditemukan!',
                    'message' => 'Data Reservasi Tidak ditemukan , mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END LOGIC

        // RETURN
        return redirect()->route('sanggar.muput-upacara.konfirmasi-tangkil.index')->with([
            'status' => 'success',
            'icon' => 'success',
            'title' => 'Berhasil meperbarui status!',
            'message' => 'Data konfirmasi tanggkil berhasil diperbarui, anda dapat melihat pembaruan data pada sistem',
        ]);
        //END

     }
     // TERIMA TANGIL

     // BATAL TANGKIL
     public function updateBatal(Request $request)
     {
         // SECURITY
         $validator = Validator::make(
             $request->all(),
             [
                 'id_reservasi' => 'required|exists:tb_reservasi,id',
                 'alasan_pembatalan' => 'required',
             ],
             [
                 'id_reservasi.required' => "ID Reservasi wajib diisi",
                 'id_reservasi.exists' => "Reservasi tidak sesuai",
                 'alasan_pembatalan.required' => "Alasan Pembatalan wajib diisi",
             ]
         );

         if ($validator->fails()) {
             return redirect()->back()->with([
                 'status' => 'fail',
                 'icon' => 'error',
                 'title' => 'Gagal Memperbarui Status',
                 'message' => 'Gagal memperbarui status ke sistem, Cek kembali alasan penolakan anda!'
             ]);
         }
         // END SECURITY

         // MAIN LOGIC
         try {
            DB::beginTransaction();
            $sanggar = Auth::user()->sessionSanggar();
            $krama = User::findOrFail($request->id_krama);

            // UPDATE RESERVASI & DETAIL RESERVASI
            $reservasi = Reservasi::whereIdSanggar($sanggar->id)->whereStatus('proses tangkil')->findOrFail($request->id_reservasi);
            $reservasi->update([
                'status' => 'ditolak',
                'keterangan' => $request->alasan_pembatalan
            ]);
            $reservasi->DetailReservasi()->update([
                'status' => 'ditolak',
                'keterangan' => $request->alasan_pembatalan
            ]);
            // UPDATE RESERVASI & DETAIL RESERVASI


            // SELF NOTIF
            $dataUserSanggar = collect([]);
            $id_user_sanggar = $sanggar->User->pluck('id');
            $dataUserSanggar->push(collect($sanggar->User));
            $userSanggar = (Arr::collapse($dataUserSanggar));

            // NOTIFICATION
            NotificationHelper::sendMultipleNotification(
                [
                    'title' => "RESERVASI BATAL",
                    'body' => "Halo !! berhasil membatalkan Reservasi, semua data Reservasi dapat dilihat pada menu Riwayat Reservasi",
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

            // NOTIF KRAMA
            NotificationHelper::sendNotification(
                [
                    'title' => "PERUBAHAN RESERVASI",
                    'body' => "Halo Krama Bali ! Reservasi telah ditolak oleh Sanggar, dengan alasan ".$request->alasan_pembatalan.", mohon untuk mencari sanggar lainnya ",
                    'status' => "new",
                    'image' => "normal",
                    'type' => "krama",
                    'notifiable_id' => $krama->id,
                    'formated_created_at' => date('Y-m-d H:i:s'),
                    'formated_updated_at' => date('Y-m-d H:i:s'),
                ],
                $krama
            );
            // NOTIF KRAMA

             DB::commit();
         } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
             return \redirect()->back()->with([
                 'status' => 'fail',
                 'icon' => 'error',
                 'title' => 'Data Reservasi Tidak ditemukan!',
                 'message' => 'Data Reservasi Tidak ditemukan , mohon untuk menghubungi developer sistem !',
             ]);
         }
         // END LOGIC

         // RETURN
         return redirect()->route('sanggar.muput-upacara.konfirmasi-tangkil.index')->with([
             'status' => 'success',
             'icon' => 'success',
             'title' => 'Berhasil meperbarui status!',
             'message' => 'Data Penguleman Krama berhasil diperbarui, Anda dapat melihat pembaruan data pada Menu Muput Upoacara',
         ]);
         //END
     }
     // BATAL TANGKIL


}
