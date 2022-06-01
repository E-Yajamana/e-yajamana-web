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
            'status' => 'nullable|in:sulinggih,pemangku,sanggar,serati,krama'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'data' => $validator->errors(),
            ], 400);
        }
        // END

        $userQuery = User::with([
            'Penduduk',
            'Role' => function ($roleQuery) {
                $roleQuery->where('nama_role', '!=', 'admin');
            }
        ])->whereHas('Penduduk')->get();

        // RETURN
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data akun user',
            'data' => [
                'users' => $userQuery
            ],
        ], 200);
        // END
    }
}
