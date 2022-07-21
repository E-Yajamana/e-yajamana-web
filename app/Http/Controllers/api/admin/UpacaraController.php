<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\ImageHelper;
use App\Models\TahapanUpacara;
use App\Models\Upacara;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use PDOException;
use Illuminate\Support\Facades\Storage;

class UpacaraController extends Controller
{
    public function index(String $nama)
    {
        // SECURITY
        $validator = Validator::make(['nama' => $nama], [
            'nama' => 'required|in:dewa yadnya,pitra yadnya,manusa yadnya,rsi yadnya,bhuta yadnya'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation Error',
                'data' => $validator->errors(),
            ], 400);
        }
        // END

        // MAIN LOGIC
        try {
            $upacaras = Upacara::with(['TahapanUpacara'])->where('kategori_upacara', $nama)->get();
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
            'message' => 'Berhasil mengambil data upacara',
            'data' => [
                'upacaras' => $upacaras
            ],
        ], 200);
        // END
    }

    public function store(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'nama_upacara' => 'required',
            'kategori_upacara' => 'required',
            'deskripsi_upacara' => 'required',
            'tahapan_upacara_json' => 'required|json'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validation error',
                'data' => $validator->errors(),
            ], 422);
        }
        // END

        // MAIN LOGIC
        try {
            DB::beginTransaction();
            $path = null;
            if ($request->hasFile('image-upacara')) {
                $file = $request->file('image-upacara');
                $path = 'storage/admin/master-data/upacara/' . basename(Storage::putFile('public/admin/master-data/upacara/', $file));
            }
            $upacara = Upacara::create([
                'nama_upacara' => $request->nama_upacara,
                'kategori_upacara' => $request->kategori_upacara,
                'deskripsi_upacara' => $request->deskripsi_upacara,
                'image' => $path,
            ]);

            $tahapanUpacara = json_decode($request->tahapan_upacara_json);
            foreach ($tahapanUpacara->tahapanUpacaraForms as $index => $value) {
                $path = null;
                if ($request->hasFile('image-tahapan-upacara-' . $index)) {
                    $file = $request->file('image-tahapan-upacara-' . $index);
                    $path = 'storage/admin/master-data/tahapan-upacara/' . basename(Storage::putFile('public/admin/master-data/tahapan-upacara/', $file));
                }

                TahapanUpacara::create([
                    'id_upacara' => $upacara->id,
                    'nama_tahapan' => $value->nama_tahapan,
                    'deskripsi_tahapan' => $value->deskripsi_tahapan,
                    'status_tahapan' => $value->status_tahapan,
                    'image' => $path,
                ]);
            }
            DB::commit();
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            DB::rollBack();
            return $err;
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
            'message' => 'Berhasil membuat upacara',
            'data' => [
                'upacara' => $upacara
            ],
        ], 200);
        // END
    }

    public function show($id)
    {
        // SECURITY
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 499,
                'message' => 'Validation Error',
                'data' => $validator->errors(),
            ], 499);
        }
        // END

        // MAIN LOGIC
        try {
            $upacara = Upacara::with('TahapanUpacara')->findOrFail($id);
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
            'message' => 'Berhasil mengambil data dari server',
            'data' => [
                'upacara' => $upacara
            ],
        ], 200);
        // END
    }

    public function update(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'nama_upacara' => 'required',
            'kategori_upacara' => 'required',
            'deskripsi_upacara' => 'required',
            'tahapan_upacara_json' => 'required|json',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation Error',
                'data' => $validator->errors(),
            ], 400);
        }
        // END

        // MAIN LOGIC
        try {
            DB::beginTransaction();
            $upacara = Upacara::findOrFail($request->id);
            $upacara->update([
                'nama_upacara' => $request->nama_upacara,
                'kategori_upacara' => $request->kategori_upacara,
                'deskripsi_upacara' => $request->deskripsi_upacara,
            ]);

            if ($request->hasFile('image-upacara-' . $request->id)) {
                $file = $request->file('image-upacara-' . $request->id);
                Storage::delete($upacara->image);
                $path = 'storage/admin/master-data/upacara/' . basename(Storage::putFile('public/admin/master-data/upacara/', $file));
                $upacara->update([
                    'image' => $path,
                ]);
            }
            $tahapanUpacaraJson = json_decode($request->tahapan_upacara_json);
            foreach ($tahapanUpacaraJson->tahapanUpacaraForms as $index => $value) {
                $tahapanUpacara = TahapanUpacara::findOrFail($value->id);
                $tahapanUpacara->update([
                    'nama_tahapan' => $value->nama_tahapan,
                    'deskripsi_tahapan' => $value->deskripsi_tahapan,
                    'status_tahapan' => $value->status_tahapan,
                ]);

                if ($request->hasFile('image-tahapan-upacara-' . $value->id)) {
                    $file = $request->file('image-tahapan-upacara-' . $value->id);
                    Storage::delete($tahapanUpacara->image);
                    $path = 'storage/admin/master-data/tahapan-upacara/' . basename(Storage::putFile('public/admin/master-data/tahapan-upacara/', $file));
                    $tahapanUpacara->update([
                        'image' => $path,
                    ]);
                }
            }
            DB::commit();
        } catch (ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err) {
            DB::rollBack();
            return $err;
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
            'message' => 'berhasil memperbaharui data upacara',
            'data' => (object)[],
        ], 200);
        // END
    }

    public function delete($id)
    {
        // SECURITY
        $validator = Validator::make(['id' => $id], [
            'id' => 'numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation Error',
                'data' => $validator->errors(),
            ], 400);
        }
        // END

        // MAIN LOGIC
        try {
            Upacara::findOrFail($id)->delete();
        } catch (ModelNotFoundException | PDOException $err) {
            return response()->json([
                'status' => 403,
                'message' => 'Upacara tidak ditemukan',
                'data' => (object)[],
            ], 403);
        } catch (QueryException $err) {
            return response()->json([
                'status' => 404,
                'message' => 'Upacara sudah digunakan',
                'data' => (object)[],
            ], 404);
        } catch (\Throwable | \Exception $err) {
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
            'message' => 'berhasil menghapus data upacara',
            'data' => (object)[],
        ], 200);
        // END
    }

    public function createTahapan(Request $request)
    {
        // SECURITY
        $validator = Validator::make($request->all(), [
            'id_upacara' => 'required|numeric',
            'nama_tahapan' => 'required',
            'deskripsi_tahapan' => 'required',
            'image_tahapan_upacara' => 'mimes:jpg,jpeg,png,bmp,tiff|max:4096',
            'status_tahapan' => 'required|in:awal,akhir,puncak',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation Error',
                'data' => $validator->errors(),
            ], 400);
        }
        // END

        // MAIN LOGIC
        try {
            $tahapanUpacara = TahapanUpacara::create([
                'id_upacara' => $request->id_upacara,
                'nama_tahapan' => $request->nama_tahapan,
                'deskripsi_tahapan' => $request->deskripsi_tahapan,
                'status_tahapan' => $request->status_tahapan,
            ]);

            if ($request->hasFile('image-tahapan-upacara')) {
                $file = $request->file('image-tahapan-upacara');
                $path = 'storage/admin/master-data/tahapan-upacara/' . basename(Storage::putFile('public/admin/master-data/tahapan-upacara/', $file));
                $tahapanUpacara->update([
                    'image' => $path,
                ]);
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
            'status' => 201,
            'message' => 'Berhasil create tahapan upacara',
            'data' => [
                'tahapan_upacara' => $tahapanUpacara,
            ],
        ], 201);
        // END
    }

    public function deleteTahapan($id)
    {
        // SECURITY
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation Error',
                'data' => (object)[],
            ], 400);
        }
        // END

        // MAIN LOGIC
        try {
            if (!TahapanUpacara::findOrFail($id)->delete()) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Bad Request Tahapan Upacara sudah digunakan',
                    'data' => (object)[],
                ], 400);
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
            'message' => 'Berhasil menghapus tahapan upacara',
            'data' => (object)[],
        ], 200);
        // END
    }
}
