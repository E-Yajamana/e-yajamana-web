<?php

namespace App\Http\Controllers\web\sanggar;

use App\Http\Controllers\Controller;
use App\ImageHelper;
use App\Models\DetailReservasi;
use App\Models\Kabupaten;
use App\Models\Sanggar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use PDOException;




class SanggarController extends Controller
{

    public function setSession (Request $request)
    {
        session()->forget('id_sanggar');
        session()->put(['id_sanggar' => $request->id]);
        session()->save();

        return redirect()->route('sanggar.dashboard')->with([
            'status-switch'=> 'success',
            'icon' => 'success',
            'title' => 'Berhasil masuk sebagai Sangar',
        ]);;

    }

    public function index()
    {
        $dataSanggar = Sanggar::with(["BanjarDinas.DesaDinas.Kecamatan.Kabupaten",'User.Penduduk'])->findOrFail(session('id_sanggar'));
        $anggotaSanggar = $dataSanggar->User->pluck('id')->toArray();
        array_push($anggotaSanggar,"1");
        $dataKrama = User::with('Penduduk')->whereNotIn('id',$anggotaSanggar)->get();
        $dataKabupaten = Kabupaten::whereProvinsiId(51)->get();
        return view('pages.sanggar.manajemen-sanggar.index',compact(['dataSanggar','dataKabupaten','dataKrama']));
    }

    public function store(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(), [
                'id_user' => 'exists:tb_user_eyajamana,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Validation error',
                    'data' => $validator->errors(),
                ], 400);
            }
        // END

        // MAIN LOGIC
            try {
                Sanggar::findOrFail(session('id_sanggar'))->User()->attach($request->id_user);
            } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
                return response()->json([
                    'status' => 500,
                    'message' => 'Internal Server Error',
                    'data' => (object)[],
                ], 500);
            }
        // END

        // RETURN
            return redirect()->route('manajemen-sanggar.index')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Menambahkan Anggota Sanggar',
                'message' => 'Berhasil Menambahkan Anggota Sanggar, Data terbaru dapat dilihat pada manajemen Sanggar',
            ]);
        // END RETURN
    }

    public function delete(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(), [
                'id_user' => 'exists:tb_user_eyajamana,id'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Mengeluarkan Anggota',
                    'message' => 'Gagal Mengeluarkan Anggota, Hubungi Developer untuk lebih lanjut'
                ]);
            }
        // END

        // MAIN LOGIC
            try {
                Sanggar::findOrFail(session('id_sanggar'))->User()->detach($request->id_user);
            } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
                DB::rollBack();
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Mengeluarkan Anggota',
                    'message' => 'Gagal Mengeluarkan Anggota Sanggar, Hubungi Developer untuk lebih lanjut'
                ]);
            }
        // END

        // RETURN
            return redirect()->route('manajemen-sanggar.index')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Menghapus Anggota Sanggar',
                'message' => 'Berhasil Menghapus Anggota Sanggar, Data terbaru dapat dilihat pada manajemen Sanggar',
            ]);
        // END RETURN

    }

    public function update(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(), [
                'id' => 'exists:tb_sanggar,id',
                'nama_sanggar' => "required|regex:/^[a-z ,.'-]+$/i|min:3|max:50",
                'alamat_sanggar' => "required|regex:/^[a-z,. 0-9]+$/i|min:3|max:100",
                'id_banjar_dinas' =>'required|exists:tb_m_banjar_dinas,id',
                'lat' => 'required|numeric|regex:/^[0-9.-]+$/i',
                'lng' => 'required|numeric|regex:/^[0-9.-]+$/i',

            ]);
            if ($validator->fails()) {
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Mengeluarkan Anggota',
                    'message' => 'Gagal Mengeluarkan Anggota, Hubungi Developer untuk lebih lanjut'
                ]);
            }
        // END

        // MAIN LOGIC
            try {
                $sanggar = Sanggar::findOrFail(session('id_sanggar'));
                $imageProfile = $sanggar->profile;
                $imageSkUsaha = $sanggar->sk_tanda_usaha;

                if($request->image_profile != null){
                    $folder = 'app/sanggar/profile/';
                    $imageProfile =  ImageHelper::moveImage($request->image_profile,$folder);
                }
                if($request->sk_tanda_usaha != null){
                    $folder = 'app/sanggar/profile/';
                    $imageSkUsaha =  ImageHelper::moveImage($request->sk_tanda_usaha,$folder);
                }
                $sanggar->update([
                    'id_banjar_dinas'=> $request->id_banjar_dinas,
                    'nama_sanggar'=> $request->nama_sanggar,
                    'alamat_sanggar'=> $request->alamat_sanggar,
                    'sk_tanda_usaha'=> $imageSkUsaha,
                    'profile'=> $imageProfile,
                    'lat'=> $request->lat,
                    'lng'=> $request->lng,
                ]);
            } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
                DB::rollBack();
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Mengeluarkan Anggota',
                    'message' => 'Gagal Mengeluarkan Anggota Sanggar, Hubungi Developer untuk lebih lanjut'
                ]);
            }
        // END
        // RETURN
            return redirect()->route('manajemen-sanggar.index')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Mengubah Data Sanggar ',
                'message' => 'Berhasil mengubah data sanggar , Data terbaru dapat dilihat pada manajemen Sanggar',
            ]);
        // END RETURN

    }

    public function report()
    {
        $user = Auth::user();
        $idSanggar = session('id_sanggar');
        $queryReservasi = function($queryReservasi) use ($idSanggar){
            $queryReservasi->where('id_sanggar',$idSanggar)->whereNotIn('status',['batal']);
        };

        $queryDetailReservasi = DetailReservasi::with(['Reservasi.Upacaraku.User.Penduduk','TahapanUpacara.Upacara','Reservasi'=>$queryReservasi])->whereHas('Reservasi',$queryReservasi)->whereYear('tanggal_mulai',2022);
        $detailReservasis = $queryDetailReservasi->orderBy('tanggal_mulai')->get();
        $dataReportTransaksi = $queryDetailReservasi->select(DB::raw("COUNT('id') as jumlah"),DB::raw("MONTH(tanggal_mulai) bulan"))->groupby('bulan')->get();

        $dataReportJenisYadnya = DB::table('tb_detail_reservasi')
                ->join('tb_reservasi', function($join) use ($idSanggar){
                    $join->on('tb_detail_reservasi.id_reservasi','=','tb_reservasi.id')
                    ->where('id_sanggar',$idSanggar);
                })->join('tb_tahapan_upacara', 'tb_detail_reservasi.id_tahapan_upacara', '=', 'tb_tahapan_upacara.id')
                ->join('tb_upacara', 'tb_tahapan_upacara.id_upacara', '=', 'tb_upacara.id')
                ->select(DB::raw("COUNT('id') as jumlah"),'tb_upacara.kategori_upacara')
                ->groupBy('kategori_upacara')
                ->get();

        $reportJenisYadnya = [
            'Dewa Yadnya' => 0,
            'Pitra Yadnya' => 0,
            'Rsi Yadnya' => 0,
            'Manusa Yadnya' => 0,
            'Bhuta Yadnya' => 0,
        ];
        foreach($dataReportJenisYadnya as $key => $data){
            $reportJenisYadnya[$data->kategori_upacara] = $data->jumlah;
        }

        $reportMonth = [0,0,0,0,0,0,0,0,0,0,0,0];

        foreach($dataReportTransaksi as $key => $data){
            Arr::set($reportMonth, $data->bulan-1, $data->jumlah);
        }

        return view('pages.sanggar.report',compact('reportJenisYadnya','reportMonth','detailReservasis'));
    }

}
