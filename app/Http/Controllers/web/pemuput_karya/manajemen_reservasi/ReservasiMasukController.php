<?php

namespace App\Http\Controllers\web\pemuput_karya\manajemen_reservasi;

use App\DateRangeHelper;
use App\Http\Controllers\Controller;
use App\Models\DetailReservasi;
use App\Models\Reservasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use ErrorException;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use PDOException;

class ReservasiMasukController extends Controller
{
    // INDEX VIEW DATA RESERVASI MASUK
    public function index(Request $request)
    {
        // MAIN LOGIC
            try{
                $dataReservasi = Reservasi::with(['Relasi','DetailReservasi','Upacaraku.Krama.User.Penduduk']);
                $queryDetailReservasi = function($queryDetailReservasi){
                    $queryDetailReservasi->where('status','pending');
                };
                $dataReservasi->with(['DetailReservasi'=>$queryDetailReservasi])->whereHas('DetailReservasi',$queryDetailReservasi);
                $dataReservasi = $dataReservasi->whereIdRelasi(Auth::user()->id)->whereIn('status',['pending','proses tangkil'])->get();
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
                $dataReservasi = Reservasi::with(['Upacaraku.Krama.User.Penduduk','DetailReservasi'])->whereIdRelasi($idUser)->whereHas('Upacaraku.Krama.User')->findOrFail($request->id);
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
    public function verifikasiReservasi(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'id_tahapan' => 'required|exists:tb_detail_reservasi,id',
                'id_reservasi' => 'required|exists:tb_reservasi,id',
                'status_reservasi' => 'required|in:pending,proses tangkil,batal,proses muput,selesai',
                'status' => 'required',
            ]);

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
            if($request->tanggal_tanggkil == null){
                DB::beginTransaction();
                $tanggal_tangkil = new Carbon($request->tanggal_tangkil);
                Reservasi::findOrFail($request->id_reservasi)->update(['status'=>$request->status_reservasi,'tanggal_tangkil'=>$tanggal_tangkil->format('Y-m-d h:i:s')]);
                foreach($request->id_tahapan as $index => $data){
                    DetailReservasi::findOrFail($data)->update([
                        'keterangan' => $request->alasan_penolakan[$index],
                        'status' => $request->status[$index]
                    ]);
                }
                DB::commit();
            }else{
                DB::beginTransaction();
                $tanggal_tangkil = DateRangeHelper::parseSingleDate($request->tanggal_tangkil);
                dd($tanggal_tangkil);
                Reservasi::findOrFail($request->id_reservasi)->update(['status'=>$request->status_reservasi,'tanggal_tangkil'=>$tanggal_tangkil->format('Y-m-d h:i:s')]);
                foreach($request->id_tahapan as $index => $data){
                    DetailReservasi::findOrFail($data)->update([
                        'keterangan' => $request->alasan_penolakan[$index],
                        'status' => $request->status[$index]
                    ]);
                }
                DB::commit();
            }
        }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
            return redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Gagal Memperbarui Status',
                'message' => 'Gagal memperbarui status ke sistem, Hubungi Developer untuk lebih lanjut'
            ]);
        }
        // END LOGIC

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

    // ALL VERIFIKASI RESERVASI
    public function allVerifikasiReservasi(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'id_tahapan_reservasi' => 'required|exists:tb_detail_reservasi,id',
                'id_reservasi' => 'required|exists:tb_reservasi,id',
                'status' => 'required|in:ditolak,diterima'
            ]);
            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Menerima Reservasi',
                    'message' => 'Gagal memperbarui status ke sistem, Hubungi Developer untuk lebih lanjut'
                ]);
            }
        // END SECURITY

        // MAIN LOGIC
        try{
            if($request->status == 'diterima'){
                DB::beginTransaction();
                if($request->tanggal_tangkil != null){
                    $tanggal_tangkil = DateRangeHelper::parseSingleDate($request->tanggal_tangkil);
                    Reservasi::findOrFail($request->id_reservasi)->update([
                        'tanggal_tangkil'=>$tanggal_tangkil,
                        'status'=>'proses tangkil'
                    ]);
                    DetailReservasi::whereIn('id',$request->id_tahapan_reservasi)->update(['status'=>$request->status]);
                }else{
                    Reservasi::findOrFail($request->id_reservasi)->update([
                        'status'=>'batal',
                        'tanggal_tangkil'=>null
                ]);
                    DetailReservasi::whereIn('id',$request->id_tahapan_reservasi)->update(['status'=>$request->status]);
                }
                DB::commit();
            }else{
                DB::beginTransaction();
                Reservasi::findOrFail($request->id_reservasi)->update(['keterangan'=>$request->alasan_penolakan,'status'=>'batal']);
                DetailReservasi::whereIn('id',$request->id_tahapan_reservasi)->update(['status'=>$request->status]);
                DB::commit();
            }
        }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
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
    // ALL VERIFIKASI RESERVASI
}
