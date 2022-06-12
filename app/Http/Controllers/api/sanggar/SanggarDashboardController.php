<?php

namespace App\Http\Controllers\api\sanggar;

use App\Http\Controllers\Controller;
use App\Models\Sanggar;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use PDOException;

class SanggarDashboardController extends Controller
{
    public function index(int $id_sanggar)
    {
        // VALIDATOR
        $validator = Validator::make(['id_sanggar' => $id_sanggar], [
            'id_sanggar' => 'required|numeric',
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
            $sanggar = Sanggar::findOrFail($id_sanggar);
            $reservasiQuery = function ($reservasiQuery) {
                $reservasiQuery->with(['Upacara'])->whereHas('Upacara');
            };
            $reservasis = $sanggar
                ->Reservasi()
                ->with(['Upacaraku' => $reservasiQuery, 'DetailReservasi'])
                ->whereHas('Upacaraku', $reservasiQuery)->get();
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
            'message' => 'Success get sanggar data',
            'data' => [
                'user' => $user,
                'sanggar' => $sanggar,
                'reservasis' => $reservasis,
            ],
        ], 200);
        // END
    }
}
