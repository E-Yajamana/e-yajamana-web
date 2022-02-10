<?php

namespace App\Http\Controllers\web\pemuput_karya\muput_upacara;

use App\DateRangeHelper;
use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\DetailReservasi;
use App\Models\Reservasi;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Upacara;
use App\Models\Upacaraku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PDOException;

use Carbon\CarbonPeriod;


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
        $queryDetailReservasi = function ($queryDetailReservasi){
            $queryDetailReservasi->with(['Sulinggih','DetailReservasi'=>function($queryTahapanUpacara){
                $queryTahapanUpacara->with(['TahapanUpacara'])->whereHas('TahapanUpacara');
            }])->whereHas('DetailReservasi');
        };

        $dataUpacara = Upacaraku::query()->with(['Reservasi','Upacara','Krama'])->whereHas('Reservasi');
        $dataUpacara->with(['Reservasi'=>$queryDetailReservasi])->whereHas('Reservasi',$queryDetailReservasi);
        $dataUpacara = $dataUpacara->findOrFail($request->id);

        return view('pages.pemuput-karya.manajemen-muput-upacara.konfirmasi-tangkil-edit',compact('dataUpacara'));
    }
    // EDIT KONFIRMASI TANGKIL

    // UPDATE KONFIRMASI TANGIL
    public function updateKonfirmasiTangkil(Request $request)
    {

        $idSulinggih =Auth::user()->Sulinggih->id;
        list($start,$end) = DateRangeHelper::parseDateRange($request->data_upacara[0]['daterange']);
        Upacaraku::findOrFail($request->data_upacara[0]['id'])->update([
            'nama_upacara'=>$request->data_upacara[0]['nama_upacara'],
            'deskripsi_upacaraku'=>$request->data_upacara[0]['deskripsi_upacara'],
            'tanggal_mulai'=>$start,
            'tanggal_selesai'=>$end,
        ]);

        Reservasi::whereIdUpacarakuAndIdRelasi($request->data_upacara[0]['id'], $idSulinggih)->update([
            'status' => 'proses muput'
        ]);

        foreach($request->data_user_reservasi as $data)
        {
            list($start,$end) = DateRangeHelper::parseDateRange($data['daterange']);
            DetailReservasi::findOrFail($data['id'])->update([
                'tanggal_mulai' => $start,
                'tanggal_selesai' => $end,
                'keterangan' =>$data['keterangan'],
                'status' => $data['status']
            ]);
        }

        if($request->id_detail_reservasi != null){
            foreach($request->id_detail_reservasi as $index => $data){
                $detailReservasi = DetailReservasi::findOrFail($data);
                if($detailReservasi->Reservasi->status == 'proses tangkil'){
                    Reservasi::findOrFail($detailReservasi->Reservasi->id)->update(['status'=>'pending']);
                }
                list($start,$end) = DateRangeHelper::parseDateRange($request->daterange[$index]);
                $detailReservasi->update([
                    'status' => 'pending',
                    'tanggal_mulai' => $start,
                    'tanggal_selesai' => $end
                ]);

                $detailReservasi->KeteranganKonfirmasi()->create([
                    'id_sulinggih'=> $idSulinggih,
                    'keterangan'=> $request->alasan_penolakan_sulinggih[$index]
                ]);
            }
        }

    }
    // UPDATE KONFIRMASI TANGIL


}
