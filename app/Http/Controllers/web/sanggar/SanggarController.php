<?php

namespace App\Http\Controllers\web\sanggar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SanggarController extends Controller
{
    public function setSession (Request $request)
    {
        session(['id_sanggar' => $request->id]);

        return redirect()->route('sanggar.dashboard')->with([
            'status-switch'=> 'success',
            'icon' => 'success',
            'title' => 'Berhasil masuk sebagai Sangar',
        ]);;

    }
}
