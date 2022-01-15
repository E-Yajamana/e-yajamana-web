<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SulinggihController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.sulinggih.dashboard');
    }

    public function dataReservasi(Request $request)
    {
        return view('pages.sulinggih.manajemen-reservasi.reservasi-index');
    }

    public function detailReservasi(Request $request)
    {
        return view('pages.sulinggih.manajemen-reservasi.reservasi-detail');
    }


    public function riwayatReservasi(Request $request)
    {
        return view('pages.sulinggih.manajemen-reservasi.reservasi-riwayat');
    }

    public function indexMuputUpacara(Request $request)
    {
        return view('pages.sulinggih.manajemen-muput-upacara.muput-index');
    }

    public function konfrimasiTanggalTangkil(Request $request)
    {
        return view('pages.sulinggih.manajemen-muput-upacara.muput-konfirmasi-tangkil');
    }

    public function konfrimasiMuput(Request $request)
    {
        return view('pages.sulinggih.manajemen-muput-upacara.muput-konfimasi-tahapan');
    }



}


