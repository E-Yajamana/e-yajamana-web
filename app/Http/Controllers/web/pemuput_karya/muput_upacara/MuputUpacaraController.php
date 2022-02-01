<?php

namespace App\Http\Controllers\web\pemuput_karya\muput_upacara;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\DetailReservasi;
use App\Models\Reservasi;
use App\Models\Upacara;
use App\Models\Upacaraku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PDOException;

class MuputUpacaraController extends Controller
{
    // INDEX VIEW MUPUT
    public function index(Request $request)
    {
        return view('pages.pemuput-karya.manajemen-muput-upacara.muput-index');
    }
    // INDEX VIEW MUPUT

    // INDEX VIEW MUPUT
    public function indexKonfirmasiTangkil(Request $request)
    {
        try{
            $dataReservasi = Reservasi::with(['DetailReservasi','Upacaraku'])->whereHas('DetailReservasi');
            $queryDetailReservasi =function ($queryDetailReservasi){
                $queryDetailReservasi->where('status','diterima');
            };
            $dataReservasi->with(['DetailReservasi'=>$queryDetailReservasi])->whereHas('DetailReservasi',$queryDetailReservasi);
            $dataReservasi = $dataReservasi->whereIdRelasiAndStatus(Auth::user()->Sulinggih->id,'proses tangkil')->orderBy('tanggal_tangkil','asc')->get();
        }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
            return \redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Internal server error  !',
                'message' => 'Internal server error , mohon untuk menghubungi developer sistem !',
            ]);
        }
        // RETURN
            return view('pages.pemuput-karya.manajemen-muput-upacara.konfirmasi-tangkil-index',compact('dataReservasi'));
        // END RETURN
    }
    // INDEX VIEW MUPUT

    // DETAIL KONFIRMASI TANGKIL
    public function detailKonfirmasiTangkil(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_reservasi,id',
            ]);

            if($validator->fails()){
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
                $dataReservasi = Reservasi::with(['Upacaraku','DetailReservasi'])->whereHas('DetailReservasi')->findOrFail($request->id);
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                return \redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Internal server error  !',
                    'message' => 'Internal server error , mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END LOGIC

        return view('pages.pemuput-karya.manajemen-muput-upacara.konfirmasi-tangkil-detail',compact('dataReservasi'));
    }
    // DETAIL KONFIRMASI TANGKIL

    // EDIT KONFIRMASI TANGKIL
    public function editKonfirmasiTangkil(Request $request)
    {

        // $queryDetailReservasi = function($queryDetailReservasi){
        //     $queryDetailReservasi->with(['DetailReservasi'])->whereHas('DetailReservasi');
        // }

        $dataUpacara = Upacaraku::query()->with(['Reservasi','Upacara','Krama'])->whereHas('Reservasi');
        $queryReservasi =function ($queryReservasi){
            $queryReservasi->with(['Sulinggih','DetailReservasi'=> function ($queryDetailReservasi){
                $queryDetailReservasi->with('TahapanUpacara')->where('status','diterima');
            }])->where('status','proses tangkil');
        };
        $dataUpacara->with(['Reservasi'=>$queryReservasi])->whereHas('Reservasi',$queryReservasi);
        $dataUpacara = $dataUpacara->findOrFail($request->id);
        // dd($dataUpacara);

        return view('pages.pemuput-karya.manajemen-muput-upacara.konfrimasi-tangkil-edit',compact('dataUpacara'));
    }
    // EDIT KONFIRMASI TANGKIL






}
