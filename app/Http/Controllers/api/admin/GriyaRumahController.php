<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Models\GriyaRumah;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDOException;

class GriyaRumahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(String $name = null, int $idBanjarDinas = null)
    {
        // SECURITY
        $validator = Validator::make([
            'name' => $name,
            'idBanjarDinas' => $idBanjarDinas
        ], [
            'name' => 'nullable|max:30',
            'idBanjarDinas' => 'nullable|numeric'
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
            $banjarDinasQuery = function ($banjarDinasQuery) {
                $banjarDinasQuery->with([
                    'DesaDinas' => function ($desaDinasQuery) {
                        $desaDinasQuery->with([
                            'Kecamatan' => function ($kecmatanQuery) {
                                $kecmatanQuery->with([
                                    'Kabupaten'
                                ]);
                            }
                        ]);
                    }
                ]);
            };

            $griyaRumahs = GriyaRumah::with([
                "BanjarDinas" => $banjarDinasQuery
            ])->whereHas("BanjarDinas");

            if ($idBanjarDinas != null && $idBanjarDinas != 0) {
                $griyaRumahs->where("id_banjar_dinas", $idBanjarDinas);
            }

            if ($name != null && $name != "semua") {
                $griyaRumahs->where('nama_griya_rumah', 'like', '%' . $name . '%');
            }

            $griyaRumahs = $griyaRumahs->get();
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
            'message' => 'Success get all data griya rumah',
            'data' => [
                'griya_rumahs' => $griyaRumahs
            ],
        ], 200);
        // END
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
