<?php

namespace App\Http\Controllers\web\admin\manajemen_akun;

use App\Http\Controllers\Controller;
use App\Models\Sanggar;
use Illuminate\Support\Facades\Validator;
use App\Models\Sulinggih;
use Exception;
use ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use PDOException;
use Illuminate\Http\Request;

class ManajemenAkunController extends Controller
{

    // VIEW INDEX VERIFIKASI DATA
    public function indexVerifikasi(Request $request)
    {
        $dataSulinggih = Sulinggih::where('status_konfirmasi_akun','pending')->where('status','sulinggih')->get();
        $dataPemangku = Sulinggih::with('User')->where('status_konfirmasi_akun','pending')->where('status','pemangku')->get();
        $dataSanggar = Sanggar::where('status_konfirmasi_akun','pending')->get();
        return view('pages.admin.manajemen-akun.pengaturan-akun.verifikasi-akun-index',compact(['dataSulinggih','dataPemangku','dataSanggar']));
    }
    // VIEW INDEX VERIFIKASI DATA

    // UPDATE TERIMA VERIFIKASI DATA PEMUPUT KARYA (SULINGGIHN DAN PEMANGKU)
    public function updateStatusAkunPemuputKarya(Request $request)
    {
         // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_sulinggih,id',
            ]);

            if($validator->fails()){
                return redirect()->route('admin.manajemen-akun.verifikasi.index')->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Sulinggih Tidak Ditemukan !',
                    'message' => 'Data Sulinggih tidak ditemukan, pilihlah data dengan benar !',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC & RETURN
            try{
                Sulinggih::findOrFail($request->id)->update(['status_konfirmasi_akun'=>'disetujui']);
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Sistem Gagal Menemukan Sulinggih !',
                    'message' => 'sistem gagal menemukan Sulinggih, mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END MAIN LOGIC & RETURN

        // RETRUN
            return redirect()->route('admin.manajemen-akun.verifikasi.index')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Data Sulinggih Berhasil Diperbarui',
                'message' => 'Data Sulinggih Berhasil Diperbarui, cek kembali data sulinggih ',
             ]);
        // END RETURN

    }
    // UPDATE TERIMA VERIFIKASI DATA PEMUPUT KARYA (SULINGGIHN DAN PEMANGKU)

    // UPDATE TOLAK VERIFIKASI DATA PEMUPUT KARYA (SULINGGIHN DAN PEMANGKU)
    public function updateStatusTolakAkunPemuputKarya(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'id' => 'required|exists:tb_sulinggih,id',
                'text_penolakan' => 'required|min:3|max:150'
            ]);

            if($validator->fails()){
                return redirect()->route('admin.manajemen-akun.verifikasi.index')->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Pemuput Karya Tidak Ditemukan !',
                    'message' => 'Data Pemuput Karya tidak ditemukan, pilihlah data dengan benar !',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC & RETURN
            try{
                Sulinggih::findOrFail($request->id)->update([
                    'status_konfirmasi_akun'=>'ditolak',
                    'keterangan_konfirmasi_akun'=> $request->text_penolakan
                ]);
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
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
                'title' => 'Data Akun Sulinggih Berhasil Diperbarui',
                'message' => 'Data Akun Sulinggih Berhasil Diperbarui, cek kembali data Sanggar ',
            ]);
        // END RETURN

    }
    // UPDATE TOLAK VERIFIKASI DATA PEMUPUT KARYA (SULINGGIHN DAN PEMANGKU)

    // DETAIL DATA VERIFIKASI AKUN PEMUPUT KARYA (SULINGGIHN DAN PEMANGKU)
    public function detailDataVerifikasiPemuputKarya(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_sulinggih,id',
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Sulinggih Tidak Ditemukan',
                    'message' => 'Data sulinggih tidak dapat ditemukan di dalam sistem',
                ]);
            }
        // END

        // MAIN LOGIC
            try{
                $dataSulinggih = Sulinggih::where('status_konfirmasi_akun','pending')->with(['User.Penduduk'=>function($query){
                    $query->with(['Profesi','Pendidikan'])->whereHas('Profesi')->whereHas('Pendidikan');
                },'GriyaRumah.BanjarDinas.DesaDinas.Kecamatan.Kabupaten','Nabe','Pasangan'])->findOrFail($request->id);
            }catch(ModelNotFoundException | Exception $err){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Sulinggih Tidak Ditemukan',
                    'message' => 'Data Sulinggih tidak ditemukan di dalam sistem',
                ]);
            }
        // END

        // RETURN
            return view('pages.admin.manajemen-akun.pengaturan-akun.verifikasi-akun-pemuput-karya-detail',compact('dataSulinggih'));
        // END RETURN

    }
    // DETAIL DATA VERIFIKASI AKUN PEMUPUT KARYA (SULINGGIHN DAN PEMANGKU)


    // UPDATE TERIMA VERIFIKASI DATA SANGGAR
    public function updateStatusAkunSanggar(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_sanggar,id',
            ]);

            if($validator->fails()){
                return redirect()->route('admin.manajemen-akun.verifikasi.index')->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Sanggar Tidak Ditemukan !',
                    'message' => 'Data Sanggar tidak ditemukan, pilihlah data dengan benar !',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC & RETURN
            try{
                Sanggar::findOrFail($request->id)->update(['status_konfirmasi_akun'=>'disetujui']);
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
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
                'title' => 'Data Akun Sanggar Berhasil Diperbarui',
                'message' => 'Data Akun Sanggar Berhasil Diperbarui, cek kembali data Sanggar ',
            ]);
        // END RETURN
    }
    // UPDATE TERIMA VERIFIKASI DATA SANGGAR

    // UPDATE TOLAK VERIFIKASI DATA SANGGAR
    public function updateStatusTolakAkunSanggar(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'id' => 'required|exists:tb_sanggar,id',
                'text_penolakan' => 'required|min:3|max:150'
            ]);

            if($validator->fails()){
                return redirect()->route('admin.manajemen-akun.verifikasi.index')->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Sanggar Tidak Ditemukan !',
                    'message' => 'Data Sanggar tidak ditemukan, pilihlah data dengan benar !',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC & RETURN
            try{
                Sanggar::findOrFail($request->id)->update([
                    'status_konfirmasi'=>'ditolak',
                    'keterangan_konfirmasi_akun'=> $request->text_penolakan
                ]);
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
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
                'title' => 'Data Akun Sanggar Berhasil Diperbarui',
                'message' => 'Data Akun Sanggar Berhasil Diperbarui, cek kembali data Sanggar ',
            ]);
        // END RETURN
    }
    // UPDATE TOLAK VERIFIKASI DATA SANGGAR

     // DETAIL DATA VERIFIKASI AKUN PEMUPUT KARYA (SULINGGIHN DAN PEMANGKU)
     public function detailDataVerifikasiSanggar(Request $request)
     {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_sanggar,id',
            ]);

            if($validator->fails()){
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
                $dataSanggar = Sanggar::where('status_konfirmasi_akun','pending')->with(['User','DesaAdat','Desa'])->findOrFail($request->id);
             }catch(ModelNotFoundException | Exception $err){
                 return redirect()->back()->with([
                     'status' => 'fail',
                     'icon' => 'error',
                     'title' => 'Data Sanggar Tidak Ditemukan',
                     'message' => 'Data Sanggar tidak ditemukan di dalam sistem',
                 ]);
             }
         // END

         // RETURN
             return view('pages.admin.manajemen-akun.pengaturan-akun.verifikasi-akun-sanggar-detail',compact('dataSanggar'));
         // END RETURN

     }
     // DETAIL DATA VERIFIKASI AKUN PEMUPUT KARYA (SULINGGIHN DAN PEMANGKU)



}
