<?php

namespace App\Http\Controllers\api\krama;

use App\Http\Controllers\Controller;
use App\Models\GriyaRumah;
use App\Models\Sanggar;
use App\Models\Sulinggih;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDOException;

class KramaPemuputKaryaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'status' => 'nullable|in:sulinggih,pemangku,sanggar',
            'id_kecamatan' => 'nullable|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'data' => (object)[],
            ], 400);
        }
        // END

        // MAIN LOGIC
        try {

            $griyaRumahs = GriyaRumah::query()->with(['PemuputKarya'])->whereHas('PemuputKarya');

            $sanggars = Sanggar::query();

            if ($request->status != null && $request->status != "") {
                if ($request->status == 'sanggar') {
                    $griyaRumahs->where('id', -1);
                    $sanggars->with(['User'])->whereHas('User');
                } else {
                    $sanggars->where('id', -1);

                    $sulinggihQuery = function ($sulinggihQuery) use ($request) {
                        $sulinggihQuery
                            ->with([
                                'User' => function ($userQuery) {
                                    $userQuery->with([
                                        'Reservasi' => function ($reservasiQuery) {
                                            $reservasiQuery->with([
                                                'DetailReservasi' => function ($detailReservasiQuery) {
                                                    $detailReservasiQuery->with('TahapanUpacara');
                                                }
                                            ]);
                                        },
                                        'Penduduk'
                                    ])->whereHas('Penduduk');
                                },
                                'AtributPemuput'
                            ])
                            ->whereHas('User')
                            ->whereHas('AtributPemuput')
                            ->where('status', $request->status);
                    };

                    $griyaRumahs->with([
                        'PemuputKarya' => $sulinggihQuery
                    ])
                        ->whereHas('PemuputKarya', $sulinggihQuery);
                }
            } else {
                $sanggars->with(['User'])->whereHas('User');
                $sulinggihQuery = function ($sulinggihQuery) use ($request) {
                    $sulinggihQuery
                        ->with([
                            'User' => function ($userQuery) {
                                $userQuery->with([
                                    'Reservasi' => function ($reservasiQuery) {
                                        $reservasiQuery->with([
                                            'DetailReservasi' => function ($detailReservasiQuery) {
                                                $detailReservasiQuery->with('TahapanUpacara');
                                            }
                                        ]);
                                    },
                                    'Penduduk'
                                ])->whereHas('Penduduk');;
                            },
                            'AtributPemuput'
                        ])
                        ->whereHas('User')
                        ->whereHas('AtributPemuput');
                };

                $griyaRumahs->with([
                    'PemuputKarya' => $sulinggihQuery
                ])
                    ->whereHas('PemuputKarya', $sulinggihQuery);
            }

            if ($request->id_kecamatan != null && $request->id_kecamatan != 0) {
                // QUERY DESA
                $griyaRumahQuery = function ($griyaRumahQuery) use ($request) {
                    $griyaRumahQuery->with([
                        'BanjarDinas' => function ($banjarDinasQuery) use ($request) {
                            $banjarDinasQuery->with([
                                'DesaDinas' => function ($desaDinasQuery) use ($request) {
                                    $desaDinasQuery->with([
                                        'Kecamatan' => function ($kecamatanQuery) use ($request) {
                                            $kecamatanQuery->where('id', $request->id_kecamatan);
                                        }
                                    ]);
                                }
                            ]);
                        }
                    ]);
                };
                $griyaRumahs->with([
                    'BanjarDinas' => $griyaRumahQuery,
                ])->whereHas('BanjarDinas', $griyaRumahQuery);
            } else {
                $griyaRumahs->with(['BanjarDinas'])->whereHas('BanjarDinas');
            }

            $sanggars = $sanggars->get();
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
            'message' => 'Berhasil mengambil data pemuput  karya',
            'data' => [
                'griya_rumahs' => $griyaRumahs,
                'sanggars' => $sanggars
            ],
        ], 200);
        // END
    }
}
