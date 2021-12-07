<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\WilayahController;


class AdminController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.admin.dashboard');
    }


    // Bagian Master Data
    public function kabupatenShow(Request $request)
    {
        $wilayah = new WilayahController;
        $string = file_get_contents("provinces.json");
        $json_file = json_decode($string, true);
        $stack = [];

        foreach($json_file as $provinsi){
            $stack[] = [
                'id'=>$provinsi['id'],
                'name'=>$provinsi['name'],
                'kabupaten'=> $wilayah->kabupaten($provinsi['id']),
            ];
        }
        $result = $stack[16];
        return view('pages.admin.master-data.kabupaten',compact('result'));
    }


    public function kecamatanShow(Request $request)
    {
        $wilayahHelper = new WilayahController;
        $listKabupaten = $wilayahHelper->kabupaten(51);
        foreach($listKabupaten as $data){
            $payload[]= [
                'namaKabupaten' => $data['name'],
                'listKecamatan' => $wilayahHelper->kecamatan($data['id'])
            ];
        }
        return view('pages.admin.master-data.kecamatan', compact('payload'));
    }

    public function desaShow(Request $request)
    {


        return view('pages.admin.master-data.desa');
    }

    public function upacaraShow(Request $request)
    {
        return view('pages.admin.master-data.upacara.show');
    }

    public function upacaraDetail(Request $request)
    {
        return view('pages.admin.master-data.upacara.detail');
    }





    public function verifikasiShow(Request $request)
    {
        return view('pages.admin.manajemen-akun.verify-show-data');
    }

    public function verifikasiDetail(Request $request)
    {
        return view('pages.admin.manajemen-akun.verify-detail');
    }

    public function dataAkunShow(Request $request)
    {
        return view('pages.admin.manajemen-akun.data-akun-show');
    }

    public function dataAkunDetail(Request $request)
    {
        return view('pages.admin.manajemen-akun.data-akun-detail');
    }
}
