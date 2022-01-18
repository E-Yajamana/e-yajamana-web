<?php

namespace App\Http\Controllers\web\admin\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // 'tlpn' => "nullable|numeric|unique:tb_pegawai,nomor_telepon|digits_between:11,15",
        // 'tgl_lahir' => "required|date",
        // tempat_lahir' => "required|regex:/^[a-z ]+$/i|min:3|max:50",
        // 'nik' => "required|numeric|unique:tb_pegawai,nik|digits:16",
        // 'alamat' => "required|regex:/^[a-z0-9 ,.'-]+$/i|min:5",
        // 'name' => "required|regex:/^[a-z ,.'-]+$/i|min:2|max:50",
        // pendidikan_terakhir' => "required|exists:tb_lansia,pendidikan_terakhir",
        // 'tempat_lahir' => "required|regex:/^[a-z ]+$/i|min:3|max:50",
        // jumlah_anak' => "required|numeric|digits_between:1,3",
        // 'jumlah_cucu' => "required|numeric|digits_between:1,3",
        // 'jumlah_cicit' => "required|numeric|digits_between:1,3",


        return view('pages.admin.dashboard');
    }
}
