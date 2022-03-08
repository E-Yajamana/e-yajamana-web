<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\ImageHelper;
use App\Models\GriyaRumah;
use App\Models\Krama;
use App\Models\Penduduk;
use App\Models\Sulinggih;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PDOException;

class RegisController extends Controller
{
    public function checkNik(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'nik' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation Error',
                'data' => [
                    $validator->errors(),
                ],
            ], 400);
        }
        // END

        // MAIN LOGIC
        try {
            $penduduk = Penduduk::where('nik', $request->nik)->firstOrFail();
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error',
                'data' => (object)[],
            ], 500);
        }
        // END

        // RETURN
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengechek data penduduk terintegrasi SIKEDAT',
            'data' => [
                'penduduk' => $penduduk
            ],
        ], 200);
        // END
    }

    public function postRegisterKrama(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'nik' => 'required|numeric',
            'notlp' => 'required|numeric',
            'email' => 'required|email',
            'password' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'data' => [
                    $validator->errors()
                ],
            ], 400);
        }
        // END

        // MAIN LOGIC
        try {
            DB::beginTransaction();

            $penduduk = Penduduk::doesntHave("User")->where('nik', $request->nik)->firstOrfail();

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'id_penduduk' => $penduduk->id,
                'nomor_telepon' => $request->notlp,
                'role' => 'krama_bali'
            ]);
            $krama = Krama::create([
                'id_user' => $user->id,
                'lat' => $request->lat,
                'lng' => $request->lng
            ]);

            DB::commit();
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error',
                'data' => (object)[],
            ], 500);
        }
        // END

        // RETURN
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil create krama baru',
            'data' => [
                'penduduk' => $penduduk,
                'user' => $user,
                'krama' => $krama
            ],
        ], 200);
        // END
    }

    public function postRegisterSulinggih(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'nik' => 'required|numeric',
            'notlp' => 'required|numeric',
            'email' => 'required|email',
            'password' => 'required',
            'nama_walaka' => 'required',
            'nama_sulinggih' => 'required',
            'id_pasangan' => 'nullable|numeric',
            'nama_pasangan' => 'required_without:id_pasangan|max:30',
            'id_nabe' => 'nullable|numeric',
            'nama_nabe' => 'required_without:id_nabe|max:30',
            'tanggal_diksha' => 'required|date',
            'file_sk' => 'required|mimes:pdf,jpg,png',
            'id_griya' => 'required',
            'nama_griya' => 'required_without:id_griya|max:30',
            'alamat_griya' => 'required_without:id_griya|max:30',
            'id_banjar_dinas' => 'required_without:id_griya|numeric',
            'lat' => 'required_without:id_griya',
            'lng' => 'required_without:id_griya',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 200,
                'message' => 'Validation error',
                'data' => [
                    $validator->errors()
                ],
            ], 200);
        }
        // END

        // MAIN LOGIC
        try {
            DB::beginTransaction();

            $penduduk = Penduduk::where('nik', $request->nik)->firstOrFail();

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'id_penduduk' => $penduduk->id,
                'nomor_telepon' => $request->notlp,
                'role' => 'krama_bali',
            ]);

            $sulinggih = new sulinggih();

            if ($request->id_nabe == null) {
                $sulinggih->nama_nabe = $request->nama_nabe;
            } else {
                $sulinggih->id_nabe = $request->id_nabe;
            }

            if ($request->id_pasangan == null) {
                $sulinggih->nama_pasangan = $request->nama_pasangan;
            } else {
                $sulinggih->id_pasangan = $request->id_pasangan;
            }

            if ($request->id_griya == null) {
                $griya = GriyaRumah::create([
                    'nama_griya_rumah' => $request->nama_griya,
                    'alamat_griya_rumah' => $request->alamat_griya,
                    'id_banjar_dinas' => $request->id_banjar_dinas,
                    'lat' => $request->lat,
                    'lng' => $request->lng,
                ]);

                $sulinggih->id_griya = $griya->id;
            } else {
                $sulinggih->id_griya = $request->id_griya;
            }

            $filename = null;
            if ($request->hasFile('file_sk')) {
                $folder = 'app/sulinggih/sk/';
                $filename =  ImageHelper::moveImage($request->file_sk, $folder);
            }

            $sulinggih->id_user = $user->id;
            $sulinggih->nama_walaka = $request->nama_walaka;
            $sulinggih->nama_sulinggih = $request->nama_sulinggih;
            $sulinggih->tanggal_diksha = $request->tanggal_diksha;
            $sulinggih->status = 'sulinggih';
            $sulinggih->tanggal_diksha = $request->tanggal_diksha;
            $sulinggih->sk_kesulinggihan = $filename;
            $sulinggih->status_konfirmasi_akun = 'pending';

            $sulinggih->save();

            DB::commit();
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error',
                'data' => (object)[],
            ], 500);
        }
        // END

        // RETURN
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil create data sulinggih',
            'data' => [
                'penduduk' => $penduduk,
                'user' => $user,
                'sulinggih' => $sulinggih
            ],
        ], 200);
        // END
    }

    public function getAllSulinggih()
    {
        // MAIN LOGIC
        try {
            $sulinggihs = Sulinggih::all();
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error',
                'data' => (object)[],
            ], 500);
        }
        // END

        // RETURN
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data sulinggih',
            'data' => [
                'sulinggihs' => $sulinggihs
            ],
        ], 200);
        // END
    }

    public function getAllGriya()
    {
        // MAIN LOGIC
        try {
            $griya_rumahs = GriyaRumah::all();
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error',
                'data' => (object)[],
            ], 500);
        }
        // END

        // RETURN
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil data griya',
            'data' => [
                'griya_rumahs' => $griya_rumahs
            ],
        ], 200);
        // END
    }
}
