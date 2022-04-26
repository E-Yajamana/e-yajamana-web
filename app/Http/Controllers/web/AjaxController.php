<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\KeteranganKonfirmasi;
use App\Models\Penduduk;
use App\Models\Reservasi;
use App\Models\TahapanUpacara;
use Illuminate\Support\Facades\Validator;
use App\Models\Upacara;
use App\Models\User;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PDOException;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

    public function jenisYadnya(Request $request)
    {
        $dataUpacara = Upacara::where('kategori_upacara',$request->jenis)->get();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data griya',
            'data' => $dataUpacara
        ],200);
    }

    public function getTahapanUpacara(Request $request)
    {
        $data = TahapanUpacara::where('id_upacara',$request->id)->get();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data griya',
            'data' => $data
        ],200);

    }

    public function getDataTangkilPemuputKarya(Request $request)
    {
        $dataTangkil = Reservasi::with('Upacaraku','DetailReservasi')->whereHas('DetailReservasi')->whereHas('Upacaraku');
        $queryDetail = function ($queryDetail){
            $queryDetail->with('TahapanUpacara')->whereNotIn('status',['ditolak']);
        };
        $dataTangkil->with(['DetailReservasi'=>$queryDetail])->whereHas('DetailReservasi',$queryDetail);
        $dataTangkil = $dataTangkil->whereIdRelasi($request->id)->whereNotIn('status',['batal'])->get();
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data jadwal dari sulinggih',
            'data' => $dataTangkil
        ],200);
    }

    public function getDataTahapanReservasi(Request $request)
    {
        $dataReservasi = Reservasi::with(['Upacaraku','DetailReservasi'=> function($query){
            $query->whereNotIn('status',['batal']);
        }])->whereHas('DetailReservasi')->findOrFail($request->id);
        $dataTahapanReservasi = [];
        foreach($dataReservasi->DetailReservasi as $data){
            $dataTahapanReservasi[] = $data->id_tahapan_upacara;
        }
        $dataTahapan = TahapanUpacara::whereIdUpacara($dataReservasi->Upacaraku->id_upacara)->whereNotIn('id',$dataTahapanReservasi)->get();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data',
            'data' => $dataTahapan
        ],200);
    }

    public function getKeteranganPergantian(Request $request)
    {
        $data = KeteranganKonfirmasi::with(['Relasi.Sulinggih','DetailReservasi.Reservasi'])->whereIdDetailReservasi($request->id)->orderBy('created_at','desc')->get();
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data',
            'data' => $data
        ],200);
    }


    public function getDataPenduduk($nik)
    {
        // SECURITY
            $validator = Validator::make(['nik' => $nik],[
                'nik' => 'required|exists:tb_penduduk,nik',
            ]);
            if($validator->fails()){
                return response()->json([
                    'status' => 400,
                    'icon' => 'warning',
                    'title' => 'Gagal menemukan data penduduk...',
                    'message' => 'Untuk membuat data akun E-Yajamana, anda diminta untuk melakukan pendataan penduduk pada sistem SIKEDAT terlebih dahulu.. !!',
                    'data' => (Object)[],
                ],400);
            }
        // END

        // MAIN LOGIC
            try{
                // GET DATA PENDUDUK BY NIK
                $penduduk = Penduduk::with(['User.Role'])->whereNik($nik)->firstOrFail();

                // LOGIC HAS CEK USER
                if($penduduk->User()->exists()){
                    // CEK HAS USER PEMUPUT
                    $hasRole =$penduduk->User->Role()->pluck('id_role')->toArray();
                    $existsRole = in_array(3, $hasRole);
                    if($existsRole){
                        $statusCode = 409;
                        $result = [
                            'status' => 409,
                            'icon' => 'warning',
                            'title' => 'Pemberitahuan',
                            'message' => 'Anda tidak dapat mendaftar kembali sebagai Pemuput Karya, karena Anda sudah mempunyai akun dengan email : '.$penduduk->User->email,
                            // 'footer' => "{{route('auth.login')}}"

                        ];
                    }else{
                        $statusCode = 200;
                        $result = [
                            'status' => 200,
                            'icon' => 'info',
                            'title' => 'Pemberitahuan',
                            'message' => 'Anda sudah mempunyai akun E-Yajamana, Anda dapat mengabaikan form input data user pada step 2',
                            'data' =>$penduduk
                        ];
                    }
                }else{
                    $statusCode = 200;
                    $result = [
                        'status' => 200,
                        'icon' => 'success',
                        'title' => 'NIK terdaftar',
                        'message' => 'Berhasil menemukan data NIK, Anda dapat langsung membuat akun E-Yajamana',
                        'data' =>$penduduk
                    ];
                }
                // LOGIC HAS CEK USER
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                return response()->json([
                    'status' => 400,
                    'icon' => 'warning',
                    'title' => 'Gagal menemukan data penduduk...',
                    'message' => 'Untuk membuat data akun E-Yajamana, anda diminta untuk melakukan pendataan penduduk pada sistem SIKEDAT terlebih dahulu.. !!',
                    'data' => $err,
                ],400);
            }
        // END LOGIC

        // RETURN
            return response()->json($result,$statusCode);
        // END
    }




}
