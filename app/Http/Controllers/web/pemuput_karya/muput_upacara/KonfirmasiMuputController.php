<?php

namespace App\Http\Controllers\web\pemuput_karya\muput_upacara;

use App\Http\Controllers\Controller;
use App\ImageHelper;
use App\Models\DetailReservasi;
use App\Models\Reservasi;
use App\Models\Upacaraku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Mockery\Expectation;
use PDOException;


class KonfirmasiMuputController extends Controller
{
    public function index()
    {
        $idUser = Auth::user()->id;
        $queryDetailReservasi = function ($queryDetailReservasi) {
            $queryDetailReservasi->with('TahapanUpacara')->whereStatus('diterima')->whereHas('TahapanUpacara');
        };
        $dataReservasi = Reservasi::with(['Upacaraku.Krama.User.Penduduk', 'Upacaraku.Upacara', 'DetailReservasi' => $queryDetailReservasi])->whereHas('DetailReservasi', $queryDetailReservasi)->whereIdRelasiAndStatus($idUser, 'proses muput')->get();
        return view('pages.pemuput-karya.manajemen-muput-upacara.konfirmasi-muput-index', compact('dataReservasi'));
    }

    public function konfimasiMuputUpacara(Request $request)
    {
        // SECURITY
        $validator = Validator::make(
            $request->all(),
            [
                'id_detail_reservasi' => 'required|exists:tb_detail_reservasi,id',
                'file' => 'required|image|mimes:png,jpg,jpeg|max:2500',
            ],
            [
                'id_detail_reservasi.required' => "ID Detail Reservasi wajib diisi",
                'id_detail_reservasi.exists' => "ID Detail Reservasi tidak sesuai",
                'file.required' => "Bukti muput wajib diisi",
                'file.image' => "Gambar harus berupa foto",
                'file.mimes' => "Format gambar harus jpeg, png atau jpg",
                'file.size' => "Gambar maksimal berukuran 2.5 Mb",
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
            $folder = 'app/sulinggih/bukti-muput/upacara/';
            $filename =  ImageHelper::moveImage($request->file, $folder);
            $detailReservasi = DetailReservasi::with(['Reservasi'])->findOrFail($request->id_detail_reservasi);

            $detailReservasi->Gambar()->create(['image' => $filename]);
            $detailReservasi->update(['status' => 'selesai']);
            $countDetailReservasi = DetailReservasi::whereIdReservasi($detailReservasi->id_reservasi)->whereIn('status', ['diterima'])->count();
            $jumlahReservasi = Reservasi::whereIdUpacaraku($detailReservasi->Reservasi->id_upacaraku)->whereIn('status', ['proses tangkil', 'proses muput'])->whereNotIn('id', [$detailReservasi->id_reservasi])->count();
            if ($countDetailReservasi == 0) {
                Reservasi::findOrFail($detailReservasi->id_reservasi)->update(['status' => 'selesai']);
            }
            if ($jumlahReservasi == 0) {
                Upacaraku::findOrFail($detailReservasi->Reservasi->id_upacaraku)->update([
                    'status' => 'selesai'
                ]);
            }
            DB::commit();
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            DB::rollBack();
            return redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Gagal Menambahkan Data Upacara',
                'message' => 'Gagal menambahkan data upacara, apabila diperlukan mohon hubungi developer sistem`',
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
        try {
            $dataDetailReservasi = DetailReservasi::with(['Reservasi.Upacaraku', 'TahapanUpacara'])->whereHas('TahapanUpacara')->findOrFail($request->id);
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            return \redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Internal server error  !',
                'message' => 'Internal server error , mohon untuk menghubungi developer sistem !',
            ]);
        }
        // END LOGIC

        // RETURN
        return view('pages.pemuput-karya.manajemen-muput-upacara.konfirmasi-muput-detail', compact('dataDetailReservasi'));
        // END RETURN
    }
}
