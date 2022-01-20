<?php

namespace App\Http\Controllers\web\pemuput_karya\muput_upacara;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MuputUpacaraController extends Controller
{
    // INDEX VIEW MUPUT
    public function index(Request $request)
    {
        return view('pages.pemuput-karya.manajemen-muput-upacara.muput-index');
    }
    // INDEX VIEW MUPUT


}
