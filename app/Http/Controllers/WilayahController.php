<?php

namespace App\Http\Controllers;
use App\Http\Controllers\WilayahController\kabupaten;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function provinsi(Request $request)
    {
        $string = file_get_contents("provinces.json");
        $json_file = json_decode($string, true);
        return $json_file;
    }

    public function kabupaten($id)
    {
        // $idKabupaten = $request->id;
        $string = file_get_contents("wilayah/api/regencies/$id.json");
        $json_file = json_decode($string, true);
        return $json_file;
    }

    public function kecamatan($id)
    {
        $string = file_get_contents("wilayah/api/districts/$id.json");
        $json_file = json_decode($string, true);
        return $json_file;
    }

    public function desa($id)
    {
        $string = file_get_contents("wilayah/api/village/$id.json");
        $json_file = json_decode($string, true);
        return $json_file;
    }
}
