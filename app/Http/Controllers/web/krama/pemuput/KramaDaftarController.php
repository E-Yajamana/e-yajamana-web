<?php

namespace App\Http\Controllers\web\krama\pemuput;

use App\Http\Controllers\Controller;
use App\Models\PemuputKarya;
use App\Models\Sanggar;
use App\Models\User;
use Illuminate\Http\Request;

class KramaDaftarController extends Controller
{
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

        return view('pages.krama.daftar-pemuput.index',compact('pemuputs','sanggars'));
    }

    public function detailPemuput($id)
    {
        $dataPemuput = PemuputKarya::with(['User.Penduduk','GriyaRumah.BanjarDinas.DesaDinas.Kecamatan.Kabupaten'])
            ->whereHas('User.Penduduk')
            ->whereHas('GriyaRumah.BanjarDinas.DesaDinas.Kecamatan.Kabupaten')
            ->findOrFail($id);

        return view('pages.krama.daftar-pemuput.detail-pemuput',compact('dataPemuput'));
    }

}
