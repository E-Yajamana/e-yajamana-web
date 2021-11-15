<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KramaController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.krama.dashboard');
    }

    public function dataUpacaraShow(Request $request)
    {
        return view('pages.krama.manajemen-upacara.data-upacaraku-show');
    }

    public function dataUpacaraShow2(Request $request)
    {
        return view('pages.krama.manajemen-upacara.data-upacaraku-show2');
    }


    public function dataUpacaraCreate(Request $request)
    {
        return view('pages.krama.manajemen-upacara.data-upacaraku-create');
    }

    public function dataUpacaraDetail(Request $request)
    {
        return view('pages.krama.manajemen-upacara.data-upacaraku-detail');
    }


    // public function reservasi(Request $request)
    // {
    //     return view('pages.krama.reservasi.create-back-up');
    // }

    public function reservasi(Request $request)
    {
        return view('pages.krama.reservasi.create');
    }


}
