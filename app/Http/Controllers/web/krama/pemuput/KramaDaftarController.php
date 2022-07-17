<?php

namespace App\Http\Controllers\web\krama\pemuput;

use App\Http\Controllers\Controller;
use App\Models\PemuputKarya;
use App\Models\Sanggar;
use App\Models\Upacara;
use App\Models\Upacaraku;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\DBAL\Query\QueryException;
use PDOException;


class KramaDaftarController extends Controller
{

    // INDEX
    public function index()
    {
        $queryCountReservasi = function ($queryCountReservasi){
            $queryCountReservasi->where('status','selesai');
        };

        $queryPemuput = function ($queryPemuput){
            $queryPemuput->with(['GriyaRumah.BanjarDinas.DesaDinas.Kecamatan.Kabupaten'])->where('status_konfirmasi_akun','disetujui');
        };

        $pemuputs = User::with(['Reservasi','PemuputKarya' => $queryPemuput])
            ->whereHas('PemuputKarya',$queryPemuput)
            ->withCount(['Reservasi'=>$queryCountReservasi])
            ->get();

        $sanggars = Sanggar::with(['BanjarDinas.DesaDinas.Kecamatan.Kabupaten'])
            ->withCount(['Reservasi'=>$queryCountReservasi])
            ->whereStatusKonfirmasiAkun('disetujui')
            ->get();

        $user = User::with('FavoritPemuputKarya')->findOrFail(Auth::user()->id);

        $favPemuput = $user->FavoritPemuputKarya->pluck('id')->toArray();
        $favSanggar = $user->FavoritSanggar->pluck('id')->toArray();
        // dd($favSanggar);


        return view('pages.krama.daftar-pemuput.index',compact('pemuputs','sanggars','favPemuput','favSanggar'));
    }
    // INDEX

    // DETAIL PEMUPUT
    public function detailPemuput($id)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$id],[
                'id' => 'required|exists:tb_pemuput_karya,id',
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Pemuput Karya Tidak Ditemukan !',
                    'message' => 'Data Pemuput Karya tidak ditemukan, pilihlah data dengan benar!',
                ]);
            }
        // END SECURITY

        // MAIN
            try{
                $dataPemuput = PemuputKarya::with(['User.Penduduk','GriyaRumah.BanjarDinas.DesaDinas.Kecamatan.Kabupaten'])
                ->whereHas('User.Penduduk')
                ->whereHas('GriyaRumah.BanjarDinas.DesaDinas.Kecamatan.Kabupaten')
                ->findOrFail($id);
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                return redirect()->back()->with([
                'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Menemukan Data Reservasi !',
                    'message' => 'Data Reservasi Tidak ditemukan, mohon hubungi developer untuk lebih lanjut!',
                ]);
            }
        // END


        // RETURN
            return view('pages.krama.daftar-pemuput.detail-pemuput',compact('dataPemuput'));
        // END RETURN
    }
    // DETAIL PEMUPUT

    // DETAIL SANGGAR
    public function detailSanggar($id)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$id],[
                'id' => 'required|exists:tb_sanggar,id',
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Sanggar Tidak Ditemukan !',
                    'message' => 'Data Sanggar tidak ditemukan, pilihlah data dengan benar!',
                ]);
            }
        // END SECURITY

        // MAIN
            try{
                $sanggar = Sanggar::with(['BanjarDinas.DesaDinas.Kecamatan.Kabupaten','BanjarDinas.DesaAdat','Service'])
                    ->findOrFail($id);
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                return redirect()->back()->with([
                'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Menemukan Data Reservasi !',
                    'message' => 'Data Reservasi Tidak ditemukan, mohon hubungi developer untuk lebih lanjut!',
                ]);
            }
        // END

        // RETURN
            return view('pages.krama.daftar-pemuput.detail-sanggar',compact('sanggar'));
        // END

    }
    // DETAIL SANGGAR


    public function createReservasi($tipe, $id)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$id, 'tipe'=>$tipe],[
                'id' => 'required',
                'tipe' => 'required|in:pemuput_karya,sanggar',
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Reservasi Tidak Ditemukan !',
                    'message' => 'Data Reservasi tidak ditemukan, pilihlah data dengan benar!',
                ]);
            }
        // END SECURITY

        // MAIN
            try{
                $pemuput = [];
                switch($tipe){
                    case 'pemuput_karya':
                        $pemuputKarya = User::with('PemuputKarya')->whereHas('PemuputKarya')->findOrFail($id);
                        $pemuput['id'] = $pemuputKarya->id;
                        $pemuput['nama'] = $pemuputKarya->PemuputKarya->nama_pemuput;
                        $pemuput['tipe'] = $pemuputKarya->PemuputKarya->tipe;
                        break;
                    case 'sanggar':
                        $sanggar = Sanggar::findOrFail($id);
                        $pemuput['id'] = $sanggar->id;
                        $pemuput['nama'] =$sanggar->nama_sanggar;
                        $pemuput['tipe'] ="sanggar";
                        break;
                    default:
                }
                $upacarakus = Upacaraku::with(['Upacara.TahapanUpacara'])
                    ->whereIdKrama(Auth::user()->id)
                    ->whereNotIn('status',['batal','selesai'])
                    ->get();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                return redirect()->back()->with([
                'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Error !',
                    'message' => 'Mohon hubungi developer untuk lebih lanjut!',
                ]);
            }
        // END

        // RETURN
            return view('pages.krama.daftar-pemuput.reservasi-create',compact('pemuput','upacarakus'));
        // END RETURN

    }

}
