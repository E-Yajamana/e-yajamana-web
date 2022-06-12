<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use NotificationHelper;
use PDOException;

class NotifyController extends Controller
{
    public function saveToken(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['token' => $request->token], [
                'token' => 'required',
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
                User::whereIn('fcm_token_web',[$request->token])->update([
                    'fcm_token_web' => null
                ]);
                $user = Auth::user();
                User::findOrFail($user->id)->update([
                    'fcm_token_web'=>$request->token
                ]);
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
                'message' => 'Berhasil mengupdate token',
            ], 200);
        // END
    }

    public function sendNotify(Request $request)
    {
        $relasi = User::with(['Krama'])->findOrFail(11);
        $user = Auth::user();

        NotificationHelper::sendNotification(
            [
                'title' => "RESERVASI BARU",
                'body' => "Terdapat krama yang mengajukan pemuputan karya, reservasi dapat dilihat pada menu Reservasi Masuk",
                'status' => "new",
                'image' => "krama",
                'notifiable_id' => $relasi->id,
                'formated_created_at' => date('Y-m-d H:i:s'),
                'formated_updated_at' => date('Y-m-d H:i:s'),
            ],
            $relasi
        );

    }


}
