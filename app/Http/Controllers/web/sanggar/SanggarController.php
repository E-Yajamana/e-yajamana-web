<?php

namespace App\Http\Controllers\web\sanggar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SanggarController extends Controller
{
    public function setSession (Request $request)
    {
        session()->forget('id_sanggar');
        session()->put(['id_sanggar' => $request->id]);
        session()->save();

        return redirect()->route('sanggar.dashboard')->with([
            'status-switch'=> 'success',
            'icon' => 'success',
            'title' => 'Berhasil masuk sebagai Sangar',
        ]);;

    }

}
