<?php

namespace App\Http\Controllers\web\pemuput_karya\manajemen_reservasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiwayatReservasiController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.pemuput-karya.manajemen-reservasi.pemuput-reservasi-riwayat-index');
    }
}
