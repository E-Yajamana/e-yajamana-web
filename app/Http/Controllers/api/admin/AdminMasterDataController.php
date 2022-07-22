<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Models\BanjarDinas;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use PDOException;
use Illuminate\Database\QueryException;

class AdminMasterDataController extends Controller
{
    public function getBanjarDinas()
    {
        try {
            $banjarDinas = BanjarDinas::get();
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'data' => (object)[],
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengambil banjar dinas',
            'data' => [
                'banjar' => $banjarDinas
            ],
        ], 200);
    }
}
