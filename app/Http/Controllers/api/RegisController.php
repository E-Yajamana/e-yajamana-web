<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\ImageHelper;
use App\Models\AtributPemuput;
use App\Models\GriyaRumah;
use App\Models\PemuputKarya;
use App\Models\Penduduk;
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
            $penduduk = Penduduk::with(['User'])->where('nik', $request->nik)->firstOrFail();
        } catch (ModelNotFoundException | PDOException $err) {
            return response()->json([
                'status' => 403,
                'message' => 'Bad Request Exception',
                'data' => (object)[],
            ], 403);
        } catch (QueryException | \Throwable | \Exception $err) {
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
                'penduduk' => $penduduk,
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

            $penduduk = Penduduk::where('nik', $request->nik)->firstOrfail();

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'id_penduduk' => $penduduk->id,
                'nomor_telepon' => $request->notlp,
                'role' => 'krama_bali',
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
                'user' => $user
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
            'file_sk' => 'nullable|mimes:pdf,jpg,png',
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
                'role' => 'pemuput_karya',
                'lat' => $request->lat,
                'lng' => $request->lng,
            ]);

            $sulinggih = new PemuputKarya();

            if ($request->id_pasangan == null || $request->id_pasangan == 0) {
                $filename = null;
                if ($request->hasFile('file_sk')) {
                    $folder = 'app/sulinggih/sk/';
                    $filename =  ImageHelper::moveImage($request->file_sk, $folder);
                }

                $atributePemuput = new AtributPemuput();

                if ($request->id_nabe != null && $request->id_nabe != 0) {
                    $atributePemuput->id_nabe = $request->id_nabe;
                }

                $atributePemuput->sk_pemuput = $filename;
                $atributePemuput->tanggal_diksha = $request->tanggal_diksha;
                $atributePemuput->save();

                $sulinggih->id_atribut = $atributePemuput->id;
            } else {
                $pasanganPemuput = PemuputKarya::findOrFail($request->id_pasangan);

                $sulinggih->id_atribut = $pasanganPemuput->id_atribut;
                $sulinggih->id_pasangan = $request->id_pasangan;
            }

            if ($request->id_griya == null || $request->id_griya == 0) {
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

            $sulinggih->id_user = $user->id;
            $sulinggih->nama_pemuput = $request->nama_sulinggih;
            $sulinggih->tipe = 'sulinggih';
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
            $pemuputKaryas = PemuputKarya::with(['AtributPemuput'])->get();
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
                'sulinggihs' => $pemuputKaryas
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