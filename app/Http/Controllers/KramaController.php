<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KramaController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.krama.dashboard');
    }



    public function dataUpacaraDetail(Request $request)
    {
        return view('pages.krama.manajemen-upacara.data-upacaraku-detail');
    }

    public function showReservasi(Request $request)
    {
        return view('pages.krama.reservasi.show');
    }

    public function createReservasi(Request $request)
    {
        return view('pages.krama.reservasi.create');
    }


}
