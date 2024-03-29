<?php

namespace App\Http\Controllers\web\pemuput_karya\muput_upacara;

use App\Http\Controllers\Controller;
use App\ImageHelper;
use App\Models\DetailReservasi;
use App\Models\Reservasi;
use App\Models\Upacaraku;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Mockery\Expectation;
use NotificationHelper;
use PDOException;


class KonfirmasiMuputController extends Controller
{
    // MUPUT UPACARA INDEX
    public function index()
    {
        $sulinggih = Auth::user();
        $queryDetailReservasi = function ($queryDetailReservasi) {
            $queryDetailReservasi->with('TahapanUpacara')->whereStatus('diterima')->whereHas('TahapanUpacara');
        };
        $dataReservasi = Reservasi::with(['Upacaraku.User.Penduduk', 'Upacaraku.Upacara', 'DetailReservasi' => $queryDetailReservasi])
            ->whereHas('DetailReservasi', $queryDetailReservasi)
            ->whereIdRelasiAndStatus($sulinggih->id, 'proses muput')
            ->get();

        $data = [];
        foreach($dataReservasi as $index => $reservasi){
            foreach ($reservasi->DetailReservasi as $key => $detailReservasi) {
                $data[] = ((array)[
                    "No" => $index+1,
                    "Penyelengara" => $reservasi->Upacaraku->User->Penduduk->nama,
                    "Alamat" => $reservasi->Upacaraku->alamat_upacaraku,
                    "tahapanReservasi" => $detailReservasi->TahapanUpacara->nama_tahapan,
                    "waktuMulai" => Carbon::parse($detailReservasi->tanggal_mulai)->format('d M Y | H:m' ),
                    "waktuSelesai" => Carbon::parse($detailReservasi->tanggal_selesai)->format('d M Y | H:m' ),
                    "tindakan" =>  '<a href="'.route('pemuput-karya.muput-upacara.konfirmasi-muput.detail',$detailReservasi->id).'" class="btn btn-info btn-sm "><i class="fas fa-eye"></i></a><a onclick="konfirmasiMuput('.$detailReservasi->id.','.$reservasi->Upacaraku->id.')" class="btn btn-primary btn-sm mx-1"><i class="fas fa-check"></i></a><a onclick="batalMuput('.$detailReservasi->id.','.$reservasi->Upacaraku->id.')" class="btn btn-danger btn-sm "><i class="fas fa-times"></i></a>'
                ]);

            }
        }
        return view('pages.pemuput-karya.manajemen-muput-upacara.konfirmasi-muput-index', compact('data'));
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
                $sulinggih = Auth::user();
                $queryReservasi = function ($queryReservasi) use ($sulinggih){
                    $queryReservasi->with('Upacaraku')->whereHas('Upacaraku')->where('id_relasi',$sulinggih->id);
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
            return view('pages.pemuput-karya.manajemen-muput-upacara.konfirmasi-muput-detail', compact('dataDetailReservasi'));
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

            $sulinggih = Auth::user();
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
            // NOTIFICATION
            NotificationHelper::sendNotification(
                [
                    'title' => 'MUPUT UPACARA SELESAI',
                    'body' => 'Halo '.$sulinggih->PemuputKarya->nama_pemuput.", Muput Upacara pada tahapan ".$detailReservasi->TahapanUpacara->nama_tahapan." berhasil dilakukan!",
                    'status' => "new",
                    'image' => "normal",
                    'type' => "pemuput",
                    'notifiable_id' => $sulinggih->id,
                    'formated_created_at' => date('Y-m-d H:i:s'),
                    'formated_updated_at' => date('Y-m-d H:i:s'),
                ],
                $sulinggih
            );

            NotificationHelper::sendNotification(
                [
                    'title' =>"MUPUT UPACARA SELESAI",
                    'body' => "Halo Krama Bali !!, ".$sulinggih->PemuputKarya->nama_pemuput." sudah menyelesaikan Muput Upacara pada tahapan ".$detailReservasi->TahapanUpacara->nama_tahapan." ! ",
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
            return redirect()->route('pemuput-karya.muput-upacara.konfirmasi-muput.index')->with([
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
                $sulinggih = Auth::user();
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

                // NOTIFICATION
                NotificationHelper::sendNotification(
                    [
                        'title' => 'BATAL MUPUT UPACARA',
                        'body' => 'Halo '.$sulinggih->PemuputKarya->nama_pemuput." !!, pembatalan muput upacara pada tahapan ".$detailReservasi->TahapanUpacara->nama_tahapan." berhasil dilakukan!",
                        'status' => "new",
                        'image' => "normal",
                        'notifiable_id' => $sulinggih->id,
                        'formated_created_at' => date('Y-m-d H:i:s'),
                        'formated_updated_at' => date('Y-m-d H:i:s'),
                    ],
                    $sulinggih
                );

                NotificationHelper::sendNotification(
                    [
                        'title' =>"PEMBATALAN MUPUT UPACARA",
                        'body' => "Halo Krama Bali !!, ".$sulinggih->PemuputKarya->nama_pemuput." membatalkan tahapan Upacara ".$detailReservasi->TahapanUpacara->nama_tahapan." dengan alasan pembatalan : ".$request->alasan_pembatalan,
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
            return redirect()->route('pemuput-karya.muput-upacara.konfirmasi-muput.index')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Muput Upacara dibatalkan!',
                'message' => 'Data Reservasi muput dapat dilihat pada menu muput upacara, anda dapat melihat pembaruan data pada sistem',
            ]);
        //END
    }
    // BATAL MUPUT UPACARA
}
