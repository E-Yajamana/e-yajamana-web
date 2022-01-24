<?php

namespace App\Http\Controllers\web\pemuput_karya\manajemen_reservasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class ReservasiMasukController extends Controller
{
    // INDEX VIEW DATA RESERVASI MASUK
    public function index(Request $request)
    {
        return view('pages.pemuput-karya.manajemen-reservasi.pemuput-reservasi-index');
    }
    // INDEX VIEW DATA RESERVASI MASUK


    // DETAIL RESERVASI MASUK
    public function detailReservasi(Request $request)
    {
        return view('pages.pemuput-karya.manajemen-reservasi.pemuput-reservasi-detail');
    }
    // DETAIL RESERVASI MASUK

    // DETAIL RESERVASI MASUK
    public function riwayatReservasi(Request $request)
    {
        return view('pages.pemuput-karya.manajemen-reservasi.pemuput-reservasi-riwayat');
    }
    // DETAIL RESERVASI MASUK

}
