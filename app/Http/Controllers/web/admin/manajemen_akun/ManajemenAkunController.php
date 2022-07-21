<?php

namespace App\Http\Controllers\web\admin\manajemen_akun;

use App\Http\Controllers\Controller;
use App\Mail\KonfirmasiAkun;
use App\Models\PemuputKarya;
use App\Models\Sanggar;
use App\Models\Serati;
use Illuminate\Support\Facades\Validator;
use Exception;
use ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use PDOException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ManajemenAkunController extends Controller
{

    // INDEX VERIFIKASI
    public function indexVerifikasi(Request $request)
    {
        $dataSulinggih = PemuputKarya::with(['User.Penduduk'])->whereHas('User.Penduduk')->whereStatusKonfirmasiAkunAndTipe('pending','sulinggih')->get();
        $dataPemangku = PemuputKarya::with(['User.Penduduk'])->whereHas('User.Penduduk')->whereStatusKonfirmasiAkunAndTipe('pending','pemangku')->get();
        $dataSanggar = Sanggar::with(['User.Penduduk'])->whereHas('User.Penduduk')->whereStatusKonfirmasiAkun('pending')->get();
        $dataSerati = Serati::with(['User.Penduduk'])->whereHas('User.Penduduk')->whereStatusKonfirmasiAkun('pending')->get();
        return view('pages.admin.manajemen-akun.pengaturan-akun.verifikasi-akun-index', compact(['dataSulinggih', 'dataPemangku', 'dataSanggar','dataSerati']));
    }
    // INDEX VERIFIKASI

    // DETAIL PEMUPUT (SULINGGIHN DAN PEMANGKU)
    public function detailPemuput($id)
    {
        // SECURITY
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|exists:tb_pemuput_karya,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Data Sulinggih Tidak Ditemukan',
                'message' => 'Data pemuput karya tidak dapat ditemukan di dalam sistem',
            ]);
        }
        // END

        // MAIN LOGIC
        try{
            $dataPemuput = PemuputKarya::with(['User.Penduduk'=> function ($query) {
                $query->with(['Profesi', 'Pendidikan'])->whereHas('Profesi')->whereHas('Pendidikan');
            }, 'GriyaRumah.BanjarDinas.DesaDinas.Kecamatan.Kabupaten'])
            ->whereHas('GriyaRumah.BanjarDinas.DesaDinas.Kecamatan.Kabupaten')
            ->whereHas('User.Penduduk')
            ->whereStatusKonfirmasiAkun('pending')->findOrFail($id);
        }catch (ModelNotFoundException | Exception $err) {
            return redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Data Sulinggih Tidak Ditemukan',
                'message' => 'Data pemuput karya tidak ditemukan di dalam sistem',
            ]);
        }
        // END

        // RETURN
            return view('pages.admin.manajemen-akun.pengaturan-akun.verifikasi-akun-pemuput-karya-detail', compact('dataPemuput'));
        // END RETURN

    }
    // DETAIL PEMUPUT (SULINGGIHN DAN PEMANGKU)

    // VERIFIKASI AKUN PEMUPUT
    public function konfirmasiPemuput(Request $request)
    {
        // SECURITY
            $rules = [
                'id' => 'required|exists:tb_pemuput_karya,id',
                'status' => 'required|in:disetujui,ditolak',
            ];
            $message = ['id.required' => "ID Wajib diisi",'id.exists' =>"ID Tidak sesuai pada sistem",];
            if($request->status != 'disetujui'){
                $rules += [
                    'text_penolakan' => 'required|min:3|max:150'
                ];
                $message += [
                    'text_penolakan.required' => "Nama upacara wajib diisi",
                    'text_penolakan.regex' => "Format nama upacara tidak sesuai",
                    'text_penolakan.min' => "Nama upacara minimal berjumlah 5 karakter",
                    'text_penolakan.max' => "Nama upacara maksimal berjumlah 50 karakter",
                ];
            }
            $validator = Validator::make($request->all(),$rules,$message);

            if($validator->fails()) {
                return redirect()->route('admin.manajemen-akun.verifikasi.index')->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Validasi Error!',
                    'message' => 'Data Pemuput Karya tidak ditemukan, pilihlah data dengan benar !',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC & RETURN
            try {
                DB::beginTransaction();
                $pemuput = PemuputKarya::with(['User.Penduduk'])->findOrFail($request->id);
                switch($request->status){
                    case 'disetujui':
                        $teks =  'Hallo '.$pemuput->User->Penduduk->nama.', Selamat pengajuan Akun Pemuput Anda diterima oleh Admin E-Yajamana';
                        break;
                    case 'ditolak':
                        $teks =  'Hallo '.$pemuput->User->Penduduk->nama.', pengajuan Akun Pemuput Anda ditolak oleh Admin E-Yajamana dengan alasan : '.$request->text_penolakan;
                        break;
                    default:
                        break;
                }
                $pemuput->update([
                    'status_konfirmasi_akun' => $request->status,
                    'keterangan_konfirmasi_akun' => $request->text_penolakan
                ]);
                $data = ['text' => $teks];
                Mail::to($pemuput->User->email)->send(new KonfirmasiAkun($data));
                DB::commit();
            }catch (ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err) {
                DB::rollBack();
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Sistem Gagal Menemukan Akun Pemuput Karya !',
                    'message' => 'sistem gagal menemukan Akun Pemuput Karya, mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END MAIN LOGIC & RETURN

        // RETRUN
            return redirect()->route('admin.manajemen-akun.verifikasi.index')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Data Akun Pemuput Karya Berhasil Diperbarui',
                'message' => 'Data Akun Pemuput Karya berhasil diperbarui, data dapat dilihat pada menu Daftar Akun',
            ]);
        // END RETURN

    }
    // VERIFIKASI AKUN PEMUPUT

    //========================= SANGGAR ==================================/

    // DETAIL PEMUPUT (SULINGGIHN DAN PEMANGKU)
    public function detailSangar($id)
    {
        // SECURITY
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|exists:tb_sanggar,id',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Sanggar Tidak Ditemukan',
                    'message' => 'Data Sanggar tidak dapat ditemukan di dalam sistem',
                ]);
            }
        // END

        // MAIN LOGIC
            try{
                $dataSanggar = Sanggar::with(['User.Penduduk','BanjarDinas.DesaDinas.Kecamatan.Kabupaten'])
                ->whereHas('User.Penduduk')
                ->whereStatusKonfirmasiAkun('pending')
                ->findOrFail($id);
            }catch (ModelNotFoundException | Exception $err) {
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Sanggar Tidak Ditemukan',
                    'message' => 'Data Sanggar tidak ditemukan di dalam sistem',
                ]);
            }
        // END

        // RETURN
            return view('pages.admin.manajemen-akun.pengaturan-akun.verifikasi-akun-sanggar-detail', compact('dataSanggar'));
        // END RETURN

    }
    // DETAIL PEMUPUT (SULINGGIHN DAN PEMANGKU)

    // VERIFIKASI AKUN SERATI
    public function konfirmasiSanggar(Request $request)
    {
        // SECURITY
            $rules = [
                'id' => 'required|exists:tb_sanggar,id',
                'status' => 'required|in:disetujui,ditolak',
            ];
            $message = ['id.required' => "ID Wajib diisi",'id.exists' =>"ID Tidak sesuai pada sistem",];
            if($request->status != 'disetujui'){
                $rules += [
                    'text_penolakan' => 'required|min:3|max:150'
                ];
                $message += [
                    'text_penolakan.required' => "Nama upacara wajib diisi",
                    'text_penolakan.regex' => "Format nama upacara tidak sesuai",
                    'text_penolakan.min' => "Nama upacara minimal berjumlah 5 karakter",
                    'text_penolakan.max' => "Nama upacara maksimal berjumlah 50 karakter",
                ];
            }
            $validator = Validator::make($request->all(),$rules,$message);

            if($validator->fails()) {
                return redirect()->route('admin.manajemen-akun.verifikasi.index')->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Validasi Error!',
                    'message' => 'Data Sanggar tidak ditemukan, pilihlah data dengan benar !',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC & RETURN
            try {
                DB::beginTransaction();
                $sanggar = Sanggar::with(['User.Penduduk'])->findOrFail($request->id);

                switch($request->status){
                    case 'disetujui':
                        $teks =  'Hallo '.$sanggar->User[0]->Penduduk->nama.', Selamat pengajuan Akun Sanggar Anda diterima oleh Admin E-Yajamana';
                        break;
                    case 'ditolak':
                        $teks =  'Hallo '.$sanggar->User[0]->Penduduk->nama.', pengajuan Akun Sanggar Anda ditolak oleh Admin E-Yajamana dengan alasan : '.$request->text_penolakan;
                        break;
                    default:
                        break;
                }
                $sanggar->update([
                    'status_konfirmasi_akun' => $request->status,
                    'keterangan_konfirmasi_akun' => $request->text_penolakan
                ]);
                $data = ['text' => $teks];
                Mail::to($sanggar->User[0]->email)->send(new KonfirmasiAkun($data));
                DB::commit();
            }catch (ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err) {
                DB::rollBack();
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Sistem Gagal Menemukan Akun Sanggar !',
                    'message' => 'sistem gagal menemukan Akun Sanggar, mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END MAIN LOGIC & RETURN

        // RETRUN
            return redirect()->route('admin.manajemen-akun.verifikasi.index')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Mengkonfirmasi Akun',
                'message' => 'Berhasil Mengkonfirmasi Akun Sanggar, cek kembali data akun ',
            ]);
        // END RETURN

    }
    // VERIFIKASI AKUN SERATI

    //========================= SERATI ==================================/

    // DETAIL PEMUPUT (SULINGGIHN DAN PEMANGKU)
    public function detailSerati($id)
    {
        // SECURITY
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|exists:tb_serati,id',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Serati Tidak Ditemukan',
                    'message' => 'Data Serati tidak dapat ditemukan di dalam sistem',
                ]);
            }
        // END

        // MAIN LOGIC
            try{
                $dataSerati = Serati::with(['User.Penduduk'])
                ->whereHas('User.Penduduk')
                ->whereStatusKonfirmasiAkun('pending')
                ->findOrFail($id);
            }catch (ModelNotFoundException | Exception $err) {
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Serati Tidak Ditemukan',
                    'message' => 'Data Serati tidak ditemukan di dalam sistem',
                ]);
            }
        // END

        // RETURN
            return view('pages.admin.manajemen-akun.pengaturan-akun.verifikasi-akun-serati-detail', compact('dataSerati'));
        // END RETURN

    }
    // DETAIL PEMUPUT (SULINGGIHN DAN PEMANGKU)

    // VERIFIKASI AKUN SERATI
    public function konfirmasiSerati(Request $request)
    {
        // SECURITY
              $rules = [
                  'id' => 'required|exists:tb_serati,id',
                  'status' => 'required|in:disetujui,ditolak',
              ];
              $message = ['id.required' => "ID Wajib diisi",'id.exists' =>"ID Tidak sesuai pada sistem",];
              if($request->status != 'disetujui'){
                  $rules += [
                      'text_penolakan' => 'required|min:3|max:150'
                  ];
                  $message += [
                      'text_penolakan.required' => "Nama upacara wajib diisi",
                      'text_penolakan.regex' => "Format nama upacara tidak sesuai",
                      'text_penolakan.min' => "Nama upacara minimal berjumlah 5 karakter",
                      'text_penolakan.max' => "Nama upacara maksimal berjumlah 50 karakter",
                  ];
              }
              $validator = Validator::make($request->all(),$rules,$message);

              if($validator->fails()) {
                  return redirect()->route('admin.manajemen-akun.verifikasi.index')->with([
                      'status' => 'fail',
                      'icon' => 'error',
                      'title' => 'Validasi Error!',
                      'message' => 'Data Pemuput Karya tidak ditemukan, pilihlah data dengan benar !',
                  ]);
              }
        // END SECURITY

        // MAIN LOGIC & RETURN
            try {
                DB::beginTransaction();
                $serati = Serati::with(['User.Penduduk'])->findOrFail($request->id);
                switch($request->status){
                    case 'disetujui':
                        $teks =  'Hallo '.$serati->User->Penduduk->nama.', Selamat pengajuan Akun Serati Anda diterima oleh Admin E-Yajamana';
                        break;
                    case 'ditolak':
                        $teks =  'Hallo '.$serati->User->Penduduk->nama.', pengajuan Akun Serati Anda ditolak oleh Admin E-Yajamana dengan alasan : '.$request->text_penolakan;
                        break;
                    default:
                        break;
                }
                $serati->update([
                    'status_konfirmasi_akun' => $request->status,
                    'keterangan_konfirmasi_akun' => $request->text_penolakan
                ]);
                $data = ['text' => $teks];
                Mail::to($serati->User->email)->send(new KonfirmasiAkun($data));
                DB::commit();
            }catch (ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err) {
                DB::rollBack();
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Sistem Gagal Menemukan Akun Serati !',
                    'message' => 'sistem gagal menemukan Akun Serati, mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END MAIN LOGIC & RETURN

        // RETRUN
            return redirect()->route('admin.manajemen-akun.verifikasi.index')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Data Akun Serati Berhasil Diperbarui',
                'message' => 'Data Akun Serati Berhasil Diperbarui, cek kembali data akun ',
            ]);
        // END RETURN

    }
    // VERIFIKASI AKUN SERATI

}
