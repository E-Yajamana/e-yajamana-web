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
        return view('pages.sulinggih.manajemen-reservasi.data-reservasi');
    }
}
