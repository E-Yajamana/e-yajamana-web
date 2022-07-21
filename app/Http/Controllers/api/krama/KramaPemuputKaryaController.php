<?php

namespace App\Http\Controllers\api\krama;

use App\Http\Controllers\Controller;
use App\Models\BanjarDinas;
use App\Models\Favorit;
use App\Models\GriyaRumah;
use App\Models\PemuputKarya;
use App\Models\Sanggar;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'id_kabupaten' => 'nullable|numeric',
            'id_kecamatan' => 'nullable|numeric',
            'id_desa_dinas' => 'nullable|numeric',
            'id_banjar_dinas' => 'nullable|numeric',
            'isFavorit' => 'nullable|in:true,false'
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
            $user = Auth::user();
            $griyaRumahs = GriyaRumah::with([
                'PemuputKarya.User.Reservasi.DetailReservasi.TahapanUpacara',
                'PemuputKarya.User.Penduduk',
                'PemuputKarya.AtributPemuput',
                'PemuputKarya.FavoritUser',
            ]);
            $sanggars = Sanggar::with([
                'User',
                'Reservasi.DetailReservasi.TahapanUpacara',
                'FavoritUser',
            ]);

            // LOKASI FILTER
            if ($request->id_banjar_dinas) {
                $griyaRumahs->whereHas('BanjarDinas', function ($banjarDinasQuery) use ($request) {
                    $banjarDinasQuery->where('id', $request->id_banjar_dinas);
                });
                $sanggars->whereHas('BanjarDinas', function ($banjarDinasQuery) use ($request) {
                    $banjarDinasQuery->where('id', $request->id_banjar_dinas);
                });
            } else if ($request->id_desa_dinas) {
                $griyaRumahs->whereHas('BanjarDinas', function ($banjarDinasQuery) use ($request) {
                    $banjarDinasQuery->whereHas('DesaDinas', function ($desaDinasQuery) use ($request) {
                        $desaDinasQuery->where('id', $request->id_desa_dinas);
                    });
                });
                $sanggars->whereHas('BanjarDinas', function ($banjarDinasQuery) use ($request) {
                    $banjarDinasQuery->whereHas('DesaDinas', function ($desaDinasQuery) use ($request) {
                        $desaDinasQuery->where('id', $request->id_desa_dinas);
                    });
                });
            } else if ($request->id_kecamatan) {
                $griyaRumahs->whereHas('BanjarDinas', function ($banjarDinasQuery) use ($request) {
                    $banjarDinasQuery->whereHas('DesaDinas', function ($desaDinasQuery) use ($request) {
                        $desaDinasQuery->whereHas('Kecamatan', function ($kecamatanQuery) use ($request) {
                            $kecamatanQuery->where('id', $request->id_kecamatan);
                        });
                    });
                });
                $sanggars->whereHas('BanjarDinas', function ($banjarDinasQuery) use ($request) {
                    $banjarDinasQuery->whereHas('DesaDinas', function ($desaDinasQuery) use ($request) {
                        $desaDinasQuery->whereHas('Kecamatan', function ($kecamatanQuery) use ($request) {
                            $kecamatanQuery->where('id', $request->id_kecamatan);
                        });
                    });
                });
            } else if ($request->id_kabupaten) {
                $griyaRumahs->whereHas('BanjarDinas', function ($banjarDinasQuery) use ($request) {
                    $banjarDinasQuery->whereHas('DesaDinas', function ($desaDinasQuery) use ($request) {
                        $desaDinasQuery->whereHas('Kecamatan', function ($kecamatanQuery) use ($request) {
                            $kecamatanQuery->whereHas('Kabupaten', function ($kabupatenQuery) use ($request) {
                                $kabupatenQuery->where('id', $request->id_kabupaten);
                            });
                        });
                    });
                });
                $sanggars->whereHas('BanjarDinas', function ($banjarDinasQuery) use ($request) {
                    $banjarDinasQuery->whereHas('DesaDinas', function ($desaDinasQuery) use ($request) {
                        $desaDinasQuery->whereHas('Kecamatan', function ($kecamatanQuery) use ($request) {
                            $kecamatanQuery->whereHas('Kabupaten', function ($kabupatenQuery) use ($request) {
                                $kabupatenQuery->where('id', $request->id_kabupaten);
                            });
                        });
                    });
                });
            }

            // FILTER STATUS
            if (isset($request->status)) {
                if ($request->status == 'sulinggih') {
                    $sanggars->where('id', -1);
                    $griyaRumahs->whereHas('PemuputKarya', function ($pemuputKaryaQyery) use ($request, $user) {
                        $pemuputKaryaQyery->where('tipe', 'sulinggih');
                    });
                } else if ($request->status == 'pemangku') {
                    $sanggars->where('id', -1);
                    $griyaRumahs->whereHas('PemuputKarya', function ($pemuputKaryaQyery) use ($request, $user) {
                        $pemuputKaryaQyery->where('tipe', 'pemangku');
                    });
                } else if ($request->status == 'sanggar') {
                    $griyaRumahs->where('id', -1);
                }
            }

            if (isset($request->isFavorit)) {
                if ($request->isFavorit == true) {
                    $griyaRumahs->whereHas(
                        'PemuputKarya',
                        function ($pemuputkaryaQuery) use ($user) {
                            $pemuputkaryaQuery->whereHas('FavoritUser', function ($favoritUserQuery) use ($user) {
                                $favoritUserQuery->where('id_user', $user->id);
                            });
                        }
                    );
                    $griyaRumahs->with(
                        'PemuputKarya',
                        function ($pemuputkaryaQuery) use ($user) {
                            $pemuputkaryaQuery->whereHas('FavoritUser', function ($favoritUserQuery) use ($user) {
                                $favoritUserQuery->where('id_user', $user->id);
                            });
                        }
                    );
                    $sanggars->whereHas(
                        'FavoritUser',
                        function ($favoritUserQuery) use ($user) {
                            $favoritUserQuery->where('id_user', $user->id);
                        }
                    );
                    $sanggars->with(
                        'FavoritUser',
                        function ($favoritUserQuery) use ($user) {
                            $favoritUserQuery->where('id_user', $user->id);
                        }
                    );
                }
            }

            $griyaRumahResult = $griyaRumahs->get();
            $sanggarsResult = $sanggars->get();
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            return $err;
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
            'message' => 'Berhasil mengambil data pemuput karya',
            'data' => [
                'griya_rumahs' => $griyaRumahResult,
                'sanggars' => $sanggarsResult
            ],
        ], 200);
        // END
    }

    public function setFavorite(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'tipe_pemuput_karya' => 'required|in:sanggar,pemuput_karya'
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
            $user = Auth::user();
            $isFavorit = true;
            if ($request->tipe_pemuput_karya == 'pemuput_karya') {
                $favorite = Favorit::where('id_user', $user->id)->where('id_pemuput_karya', $request->id)->first();
                if ($favorite == null) {
                    Favorit::create([
                        'id_pemuput_karya' => $request->id,
                        'id_user' => $user->id,
                    ]);
                } else {
                    $favorite->delete();
                    $isFavorit = false;
                }
            } else {
                $favorite = Favorit::where('id_user', $user->id)->where('id_sanggar', $request->id)->first();
                if ($favorite == null) {
                    Favorit::create([
                        'id_sanggar' => $request->id,
                        'id_user' => $user->id,
                    ]);
                } else {
                    $favorite->delete();
                    $isFavorit = false;
                }
            }
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
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
            'message' => 'Success',
            'data' => [
                'isFavorit' => $isFavorit,
            ],
        ], 200);
        // END
    }
}
