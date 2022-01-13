<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\WilayahController;


class AdminController extends Controller
{


    public function desaShow(Request $request)
    {
        return view('pages.admin.master-data.desa');
    }

    public function upacaraShow(Request $request)
    {
        return view('pages.admin.master-data.upacara.index');
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
