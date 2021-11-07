<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.admin.dashboard');
    }



    public function kabupatenShow(Request $request)
    {
        return view('pages.admin.master-data.kabupaten');
    }

    public function kecamatanShow(Request $request)
    {
        return view('pages.admin.master-data.kecamatan');
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
