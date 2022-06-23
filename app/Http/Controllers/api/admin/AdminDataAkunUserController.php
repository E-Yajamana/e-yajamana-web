<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Models\PemuputKarya;
use App\Models\Sanggar;
use App\Models\Serati;
use App\Models\Sulinggih;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PDOException;
use Illuminate\Database\QueryException;

class AdminDataAkunUserController extends Controller
{
    public function index(String $status = 'krama')
    {
        // SECURITY
        $validator = Validator::make([
            'status' => $status
        ], [
            'status' => 'nullable|in:sulinggih,pemangku,sanggar,krama'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'data' => $validator->errors(),
            ], 400);
        }
        // END

        $pemuputKaryas = null;
        $sanggar = null;
        $user = null;
        switch ($status) {
            case 'krama':
                $user = User::with([
                    'Penduduk',
                    'Role' => function ($roleQuery) use ($status) {
                        $roleQuery->where('nama_role', '!=', 'admin')->where('nama_role', 'krama');
                    }
                ])->whereHas('Penduduk')->get();
                break;
            case 'pemangku':
                $pemuputKaryas = PemuputKarya::with([
                    'User',
                    'GriyaRumah',
                    'AtributPemuput' => function ($atributPemuputQuery) {
                        $atributPemuputQuery->with([
                            'Nabe'
                        ]);
                    }
                ])->where('tipe', 'pemangku')->get();
                break;
            case 'sulinggih':
                $pemuputKaryas = PemuputKarya::with([
                    'User',
                    'GriyaRumah',
                    'AtributPemuput' => function ($atributPemuputQuery) {
                        $atributPemuputQuery->with([
                            'Nabe'
                        ]);
                    }
                ])->where('tipe', 'sulinggih')->get();
                break;
            case 'sanggar':
                $sanggar = Sanggar::with(['User'])->whereHas('User')->get();
                break;
        }

        // RETURN
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data akun user',
            'data' => [
                'users' => $user,
                'pemuput_karyas' => $pemuputKaryas,
                'sanggars' => $sanggar,
            ],
        ], 200);
        // END
    }

    public function show(String $tipe, int $id)
    {
        // SECURITY
        $validator = Validator::make(['tipe' => $tipe, 'id' => $id], [
            'tipe' => 'required|in:sanggar,pemuput_karya,krama',
            'id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation Error',
                'data' => $validator->errors(),
            ], 400);
        }
        // END

        $user = null;
        $pemuput_karya = null;
        $sanggar = null;
        // MAIN LOGIC
        try {
            switch ($tipe) {
                case 'krama':
                    $user = User::with('Penduduk')->whereHas('Penduduk')->findOrFail($id);
                    break;
                case 'pemuput_karya':
                    $pemuput_karya = PemuputKarya::with([
                        'User' => function ($userQuery) {
                            $userQuery->with(['Penduduk'])->whereHas('Penduduk');
                        },
                        'GriyaRumah',
                        'AtributPemuput' => function ($atributPemuputQuery) {
                            $atributPemuputQuery->with([
                                'Nabe'
                            ]);
                        }
                    ])->whereHas('User')->findOrFail($id);
                    break;
                case 'sanggar':
                    $sanggar = Sanggar::with(['User'])->whereHas('User')->findOrFail($id);
                    break;
            }
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            return $err;
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'data' => (object)[],
            ], 500);
        }
        // END

        // RETURN
        return response()->json([
            'status' => 200,
            'message' => "Success mengambil data akun user tipe = $tipe",
            'data' => [
                'user' => $user,
                'pemuput_karya' => $pemuput_karya,
                'sanggar' => $sanggar,
                'tipe' => $tipe,
            ],
        ], 200);
        // END
    }

    public function update(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'status' => 'required|in:disetujui,ditolak,pending',
            'role' => 'required|in:pemuput_karya,sanggar'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'data' => $validator->errors(),
            ], 400);
        }
        // END

        // MAIN LOGIC
        try {
            switch ($request->status) {
                case "pemuput_karya":
                    PemuputKarya::findOrFail($request->id)->update(['status_konfirmasi_akun' => $request->status]);
                    break;
                case "sanggar":
                    Sanggar::findOrFail($request->id)->update(['status_konfirmasi_akun' => $request->status]);
                    break;
            }
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            return $err;
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'data' => (object)[],
            ], 500);
        }
        // END

        // RETURN
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil memperbaharui konfirmasi akun',
            'data' => (object)[],
        ], 200);
        // END
    }
}
