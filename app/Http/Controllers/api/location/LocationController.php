<?php

namespace App\Http\Controllers\api\location;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\DesaAdat;
use App\Models\DesaDinas;
use App\Models\KabupatenBaru;
use App\Models\Kecamatan;
use App\Models\ProvinsiBaru;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PDOException;

class LocationController extends Controller
{
    public function getProvinsi(){
        // MAIN LOGIC
            try{
                $provinsis = ProvinsiBaru::all();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
                return response()->json([
                        'status' => 500,
                        'message' => 'Internal Server Error',
                        'data' => (Object)[],
                ],500);
            }
        // END

        // RETURN
            return response()->json([
                    'status' => 200,
                    'message' => 'Berhasil mengambil data provinsi',
                    'data' => [
                        'provinsis' => $provinsis
                    ],
            ],200);
        // END
    }


    public function getKabupaten($id_provinsi){
        // VALIDATION
            $validator = Validator::make(['id_provinsi' => $id_provinsi],[
                'id_provinsi' => 'required|numeric'
            ]);

            if($validator->fails()){
                return response()->json([
                        'status' => 400,
                        'message' => 'Validation Error',
                        'data' => (Object)[],
                ],400);
            }
        // END

        // MAIN LOGIC
            try{

                $kabupatens = KabupatenBaru::where('id_provinsi',$id_provinsi)->get();

            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
                return response()->json([
                        'status' => 500,
                        'message' => 'Internal Server Error',
                        'data' => (Object)[],
                ],500);
            }
        // END

        // RETURN
            return response()->json([
                    'status' => 200,
                    'message' => 'Berhasil mengambil data kabupaten',
                    'data' => [
                        "kabupatens" => $kabupatens
                    ],
            ],200);
        // END
    }

    public function getKecamatan($id_kabupaten){
        // SECURITY
            $validator = Validator::make(['id_kabupaten' => $id_kabupaten],[
                'id_kabupaten' => 'required',
            ]);

            if($validator->fails()){
                return response()->json([
                        'status' => 400,
                        'message' => 'Validation Error',
                        'data' => (Object)[],
                ],400);
            }
        // END

        // MAIN LOGIC
            try{

                $kecamatans = Kecamatan::where('kabupaten_id',$id_kabupaten)->get();

            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
                return response()->json([
                        'status' => 500,
                        'message' => 'Internal Server Error',
                        'data' => (Object)[],
                ],500);
            }
        // END

        // RETURN
            return response()->json([
                    'status' => 200,
                    'message' => 'Berhasil mengambil data kecamatan',
                    'data' => [
                        'kecamatans' => $kecamatans
                    ],
            ],200);
        // END
    }

    public function getDesaDinas($id_kecamatan){
        // SECURITY
            $validator = Validator::make(['id_kecamatan' => $id_kecamatan],[
                'id_kecamatan' => 'required',
            ]);

            if($validator->fails()){
                return response()->json([
                        'status' => 400,
                        'message' => 'Validation Error',
                        'data' => (Object)[],
                ],400);
            }
        // END

        // MAIN LOGIC
            try{

                $desas = DesaDinas::where('kecamatan_id',$id_kecamatan)->get();

            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
                return response()->json([
                        'status' => 500,
                        'message' => 'Internal Server Error',
                        'data' => (Object)[],
                ],500);
            }
        // END

        // RETURN
            return response()->json([
                    'status' => 200,
                    'message' => 'Berhasil mengambil data desa',
                    'data' => [
                        'desas' => $desas
                    ],
            ],200);
        // END
    }

    public function getDesaAdat(){
        // MAIN LOGIC
            try{

                $desaadats = DesaAdat::get(['desadat_id','desadat_nama']);

            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
                return $err;
                return response()->json([
                        'status' => 500,
                        'message' => 'Internal server error',
                        'data' => (Object)[],
                ],500);
            }
        // END

        // RETURN
            return response()->json([
                    'status' => 200,
                    'message' => 'Berhasil mengambil data desa adat',
                    'data' => [
                        'desaadats' => $desaadats
                    ],
            ],200);
        // END
    }

    public function getKecamatanByProvinsiId($id_provinsi){
        // SECURITY
            $validator = Validator::make(['id_provinsi' => $id_provinsi],[
                'id_provinsi' => 'required|numeric'
            ]);

            if($validator->fails()){
                return response()->json([
                        'status' => 400,
                        'message' => 'Validation error',
                        'data' => (Object)[],
                ],400);
            }
        // END

        // MAIN LOGIC
            try{

                $kecamatans = Kecamatan::whereHas('Kabupaten',function($kabupatenQuery) use ($id_provinsi) {
                                                $kabupatenQuery->where('id_provinsi',$id_provinsi);
                                            })->get();

            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
                return response()->json([
                        'status' => 500,
                        'message' => 'Internal server error',
                        'data' => (Object)[],
                ],500);
            }
        // END

        // RETURN
            return response()->json([
                    'status' => 200,
                    'message' => 'Berhasil mengambil data kecamatan berdasarkan id',
                    'data' => [
                        'kecamatans' => $kecamatans
                    ],
            ],200);
        // END
    }
}
