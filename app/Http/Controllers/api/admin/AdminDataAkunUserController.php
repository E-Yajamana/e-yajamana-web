<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Models\Sanggar;
use App\Models\Serati;
use App\Models\Sulinggih;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminDataAkunUserController extends Controller
{
    public function index(String $status = null)
    {
        // SECURITY
        $validator = Validator::make([
            'status' => $status
        ], [
            'status' => 'nullable|in:sulinggih,pemangku,sanggar,serati,krama_bali,semua'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'data' => $validator->errors(),
            ], 400);
        }
        // END
        $userQuery = User::query();
        // MAIN LOGIC
        switch ($status) {
            case "sulinggih":
                $userSistems = $userQuery->with([
                    "Penduduk",
                    "Sulinggih" => function ($sulinggihQuery) {
                        $sulinggihQuery->where('status_konfirmasi_akun', 'disetujui');
                    },
                ])->where('role', 'sulinggih')->whereHas("Penduduk")->get();
                break;
            case "pemangku":
                $userSistems = $userQuery->with([
                    "Penduduk",
                    "Sulinggih" => function ($sulinggihQuery) {
                        $sulinggihQuery->where('status_konfirmasi_akun', 'disetujui');
                    },
                ])->where('role', 'pemangku')->whereHas("Penduduk")->whereHas('Penduduk')->get();
                break;
            case "sanggar":
                $userSistems = $userQuery->with([
                    "Penduduk",
                    "Sanggar" => function ($sanggarQuery) {
                        $sanggarQuery->where('status_konfirmasi_akun', 'disetujui');
                    },
                ])->where('role', 'sanggar')->whereHas("Penduduk")->get();
                break;
            case "serati":
                $userSistems = $userQuery->with([
                    "Penduduk",
                    "Serati" => function ($sanggarQuery) {
                        $sanggarQuery->where('status_konfirmasi_akun', 'disetujui');
                    }
                ])->where('role', 'serati')->whereHas("Penduduk")->get();
                break;
            case "krama_bali":
                $userSistems = $userQuery->with([
                    "Penduduk",
                    "Krama"
                ])->where('role', 'krama_bali')->whereHas("Penduduk")->get();
                break;
            default:
                $userSistems = $userQuery->with([
                    "Penduduk",
                    "Sulinggih" => function ($sulinggihQuery) {
                        $sulinggihQuery->where('status_konfirmasi_akun', 'disetujui');
                    },
                    "Sanggar" => function ($sanggarQuery) {
                        $sanggarQuery->where('status_konfirmasi_akun', 'disetujui');
                    },
                    "Serati" => function ($sanggarQuery) {
                        $sanggarQuery->where('status_konfirmasi_akun', 'disetujui');
                    },
                    "Krama"
                ])->whereHas("Penduduk")->get();
                break;
        }
        // END

        // RETURN
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data akun user',
            'data' => [
                'users' => $userSistems
            ],
        ], 200);
        // END
    }
}
