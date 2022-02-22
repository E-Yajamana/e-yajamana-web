<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDOException;

class NotificationController extends Controller
{
    public function getNotificationByIdUserandStatus($status)
    {
        // SECURITY
        $validator = Validator::make(['status' => $status], [
            'status' => 'required'
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
            $user = Auth::user();
            $notifications = $user->notifications->map(function ($value) {
                $value->title = $value->data['title'];
                $value->body = $value->data['body'];
                $value->status = $value->data['status'];
                $value->image = $value->data['image'];
                $value->formated_created_at = Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('Y-m-d H:i:s');
                $value->formated_updated_at = Carbon::createFromFormat('Y-m-d H:i:s', $value->updated_at)->format('Y-m-d H:i:s');
                return $value;
            });
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
            'message' => 'Berhasil mengambil data notifications',
            'data' => [
                'notifications' => $notifications
            ],
        ], 200);
        // END
    }

    public function readNotification(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'id_notification' => 'required',
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
            $user = Auth::user();
            $notification = $user->notifications()->where('id', $request->id_notification)->firstOrFail();

            $data = $notification->data;
            $data['status'] = "history";

            $notification->update(['read_at' => now(), 'data' => $data]);
            DB::commit();
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Server message',
                'data' => (object)[],
            ], 500);
        }
        // END

        // RETURN
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil read notification',
            'data' => (object)[],
        ], 200);
        // END
    }

    public function deleteNotification(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'id_notification' => 'required',
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
            $user = Auth::user();
            $user->notifications()->where('id', $request->id_notification)->firstOrFail()->delete();
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
            'message' => 'Berhasil delete notification',
            'data' => (object)[],
        ], 200);
        // END
    }
}
