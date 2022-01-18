<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;

class AjaxWilayahDropdown extends Controller
{

    public function getKecamatan($id)
    {
        $dataKecamatan = Kecamatan::where('id_kabupaten',$id)->get();
        return response()->json($dataKecamatan);
    }
}
