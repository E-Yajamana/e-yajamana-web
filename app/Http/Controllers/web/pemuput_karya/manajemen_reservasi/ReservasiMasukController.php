<?php

namespace App\Http\Controllers\web\pemuput_karya\manajemen_reservasi;

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
        $dataReservasi = Reservasi::with(['DetailReservasi','Upacaraku']);
        $queryDetailReservasi = function($queryDetailReservasi){
            $queryDetailReservasi->where('status','pending');
        };
        $dataReservasi->with(['DetailReservasi'=>$queryDetailReservasi])->whereHas('DetailReservasi',$queryDetailReservasi);
        $dataReservasi = $dataReservasi->where('id_relasi',Auth::user()->Sulinggih->id)->get();
        return view('pages.pemuput-karya.manajemen-reservasi.pemuput-reservasi-index',compact('dataReservasi'));
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
                $dataReservasi = Reservasi::with(['Upacaraku','DetailReservasi'])->findOrFail($request->id);
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return \redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Sistem Gagal Menemukan Data Reservasi !',
                    'message' => 'sistem gagal menemukan Data Reservasi, mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END MAIN LOGIC

        // RETURN
            return view('pages.pemuput-karya.manajemen-reservasi.pemuput-reservasi-detail',compact('dataReservasi'));
        // END RETURN

    }
    // DETAIL RESERVASI MASUK

    // DETAIL RESERVASI MASUK
    public function riwayatReservasi(Request $request)
    {
        return view('pages.pemuput-karya.manajemen-reservasi.pemuput-reservasi-riwayat');
    }
    // DETAIL RESERVASI MASUK

    // ALL VERIFIKASI RESERVASI
    public function allVerifikasiReservasi(Request $request)
    {

        if($request->status == 'diterima'){
            // SECURITY
                $validator = Validator::make($request->all(),[
                    'id_tahapan_reservasi' => 'required|exists:tb_detail_reservasi,id',
                    'id_reservasi' => 'required|exists:tb_reservasi,id',
                    'tanggal_tangkil' => 'required',
                ]);
                if($validator->fails()){
                    return redirect()->back()->with([
                        'status' => 'fail',
                        'icon' => 'error',
                        'title' => 'Gagal Memperbarui Status',
                        'message' => 'Gagal memperbarui status ke sistem, Hubungi Developer untuk lebih lanjut'
                    ]);
                }
            // END SECURITY

            // MAIN LOGIC
                try{
                    DB::beginTransaction();
                    $tanggal_tangkil = new Carbon($request->tanggal_tangkil);
                    Reservasi::findOrFail($request->id_reservasi)->update(['tanggal_tangkil'=>$tanggal_tangkil->format('Y-m-d h:i:s'),'status'=>'proses tangkil']);
                    DetailReservasi::whereIn('id',$request->id_tahapan_reservasi)->update(['status'=>$request->status]);
                }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                    return redirect()->back()->with([
                        'status' => 'fail',
                        'icon' => 'error',
                        'title' => 'Gagal Memperbarui Status',
                        'message' => 'Gagal memperbarui status ke sistem, Hubungi Developer untuk lebih lanjut'
                    ]);
                }
                DB::commit();
            // END MAIN LOGIC

            // RETURN
                return redirect()->back()->with([
                    'status' => 'success',
                    'icon' => 'success',
                    'title' => 'Berhasil Memperbarui Status Reservasi',
                    'message' => 'Berhasil Memperbarui Status Reservasi, Data terbaru dapat dilihat pada menu data muput upacara',
                ]);
            // END RETURN

        }elseif($request->status == 'ditolak'){
            DetailReservasi::whereIn('id',$request->id_tahapan)->update(['status'=>$request->status]);
        }else{
            return redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Gagal Memperbarui Status',
                'message' => 'Gagal memperbarui status ke sistem, Hubungi Developer untuk lebih lanjut'
            ]);
        }



    }
    // ALL VERIFIKASI RESERVASI

    // VERIFIKASI RESERVASI
    public function verifikasiReservasi(Request $request)
    {
        dd($request->all());

        // $reservasi = Reservasi::findOrFail(36);
        $dataUpdate = [
            'diterima',
            'diterima'
        ];
        // dd($request->id);
        $itemTypes = [8,9,10];

        DetailReservasi::whereIn('id',$request->id)->update(['status'=>'ditolak']);
        // dd($dataUpdate);
    }
    // VERIFIKASI RESERVASI



}
