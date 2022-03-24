<?php

namespace App\Http\Controllers\web\auth;

use App\DateRangeHelper;
use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\DBAL\Query\QueryException;
use ErrorException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PDOException;




class ProfileController extends Controller
{


    // AJAX UPDATE AKUN
    public function updateAkun(Request $request)
    {

        // SECURITY
            $user = Auth::user();
            if($request->email == $user->email && $request->nomor_telepon == $user->nomor_telepon){
                // RETURN JSON AJAX DATA
                    return response()->json([
                        'status' => 'success',
                        'icon' => 'info',
                        'title' => 'Gagal Merubah Akun',
                        'message' => 'Tidak terdapat perubahan data dari data yang sebelumnya!',
                        'field' => ['email','nomor_telepon']
                    ],400);
                // RETURN JSON AJAX DATA
            }else{
                if($request->email != $user->email && $request->nomor_telepon != $user->nomor_telepon){
                    $rules = [
                        'email' => 'required|email|unique:tb_user_eyajamana,email|min:5|max:100',
                        'nomor_telepon' => 'required|unique:tb_user_eyajamana,nomor_telepon|numeric|digits_between:11,15',
                    ];
                }elseif($request->nomor_telepon == $user->nomor_telepon){
                    $rules = [
                        'email' => 'required|email|unique:tb_user_eyajamana,email|min:5|max:100',
                        'nomor_telepon' => 'required|numeric|digits_between:11,15',
                    ];
                }else{
                    $rules = [
                        'email' => 'required|email|min:5|max:100',
                        'nomor_telepon' => 'required|unique:tb_user_eyajamana,nomor_telepon|numeric|digits_between:11,15',
                    ];
                }
            }

            $message = [
                'email.required' => "Email wajib diisi",
                'email.regex' => "Format Email tidak sesuai",
                'email.min' => "Email minimal berjumlah 5 karakter",
                'email.unique' => "Email sudah pernah dibuat sebelumnya",
                'email.max' => "Email maksimal berjumlah 100 karakter",
                'nomor_telepon.required' => "Nomor Telepon wajib diisi",
                'nomor_telepon.unique' => "Nomor Telepon sudah pernah dibuat sebelumnya",
                'nomor_telepon.numeric' => "Nomor Telepon harus berupa angka",
                'nomor_telepon.digits_between' => "Nomor Telepon disii dengan 11 sampai dengan 15 angka",
            ];

            $validator = Validator::make($request->all(),$rules,$message);
            if($validator->fails()){
                return response()->json([
                    'status' => 400,
                    'icon' => 'error',
                    'title' => 'Validation Error',
                    'message' => 'Validation Error, harap kembali mengecek form input!',
                    'data' => $validator->errors(),
                ],400);
            }
        // END

        // MAIN LOGFIC
            try{
                DB::beginTransaction();
                User::findOrFail($user->id)->update([
                    'email' => $request->email,
                    'nomor_telepon' => $request->nomor_telepon,
                ]);
                DB::commit();
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return response()->json([
                    'status' => 400,
                    'icon' => 'error',
                    'title' => 'Gagal Mengubah Info Akun',
                    'message' => 'Gagal Memperbarui Info Akun, untuk lebih lanjut mohon hubungi developer',
                    'error' => $validator->errors()
                ],400);
            }
        // MAIN LOGIC

        // RETURN JSON AJAX DATA
            return response()->json([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Mengubah Akun',
                'message' => 'Data Akun berhasil diubah dari sistem',
                'field' => ['email','nomor_telepon']
            ],200);
        // RETURN JSON AJAX DATA

    }
    // AJAX UPDATE AKUN

    // AJAX UPDATE PASSWORD
    public function updatePassword(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'password_lama' => 'required',
                'password' => 'required|max:50|confirmed',
            ],
            [
                'password_lama.required' => "Password lama wajib diisi",
                'password.required' => "Password baru wajib diisi",
                'password.max' => "Password maksimal 50 karakter",
                'password.confirmed' => "Konfirmasi password tidak sesuai",
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 400,
                    'icon' => 'error',
                    'title' => 'Validation Error',
                    'message' => 'Validation Error, harap kembali mengecek form input!',
                    'data' => $validator->errors(),
                ],400);
            }
        // END

        // MAIN LOGFIC
            try{
                $user = Auth::user();
                $isCheckOldPassword = (Hash::check($request->password_lama, $user->password));
                $isCheckNewPassword = (Hash::check($request->password, $user->password));

                if($isCheckOldPassword){
                    if(!$isCheckNewPassword){
                        DB::beginTransaction();
                        User::findOrFail($user->id)->update([
                            'password' => Hash::make($request->password)
                        ]);
                        DB::commit();
                    }else{
                        return response()->json([
                            'status' => 400,
                            'icon' => 'info',
                            'title' => 'Gagal Mengubah Password',
                            'message' => 'Tidak terjadi perubahan password atau Password Baru sama dengan Password Lama',
                            'error' => $validator->errors()
                        ],400);
                    }
                }else{
                    return response()->json([
                        'status' => 400,
                        'icon' => 'error',
                        'title' => 'Gagal Mengubah Password',
                        'message' => 'Gagal mengubah password, Password Lama yang anda masukan tidak sesuai!',
                        'error' => $validator->errors()
                    ],400);
                }
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return response()->json([
                    'status' => 400,
                    'icon' => 'error',
                    'title' => 'Gagal Mengubah Password',
                    'message' => 'Gagal Memperbarui Password, untuk lebih lanjut mohon hubungi developer',
                    'error' => $validator->errors()
                ],400);
            }
        // MAIN LOGIC

        // RETURN JSON AJAX DATA
            return response()->json([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Mengubah Password',
                'message' => 'Data Password berhasil diubah dari sistem',
                'field' => ['password_lama','password','password_confirmation']
            ],200);
        // RETURN JSON AJAX DATA
    }
    // AJAX UPDATE PASSWORD

    // DATA DIRI UPDATE
    public function updateDataDiri(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'profesi_id' => 'required|in:1,2,3,4,5,8,10',
                'pendidikan_id' => 'required|in:1,2,3,4,5,6,7,8,9,10,11',
                'agama' => 'required|in:hindu,buddha,islam,katolik,khonghucu,protestan',
                'nama' => 'required|regex:/^[a-z,. 0-9, -]+$/i|min:5|max:50',
                'nama_alias' => 'required|regex:/^[a-z,. 0-9, -]+$/i|min:3|max:50',
                'tempat_lahir' => 'required|regex:/^[a-z,. 0-9, -]+$/i|min:5|max:50',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'golongan_darah' => 'required|in:A,AB,B,O',
                'status_perkawinan' => 'required|in:belum kawin,kawin,cerai hidup,cerai mati',
            ],
            [
                'nama.required' => "Nama wajib diisi",
                'nama.regex' => "Format nama tidak sesuai",
                'nama.min' => "Nama minimal berjumlah 5 karakter",
                'nama.max' => "Nama maksimal berjumlah 50 karakter",
                'nama_alias.required' => "Nama Alias wajib diisi",
                'nama_alias.regex' => "Format Nama Alias tidak sesuai",
                'nama_alias.min' => "Nama Alias minimal berjumlah 3 karakter",
                'nama_alias.max' => "Nama Alias maksimal berjumlah 50 karakter",
                'profesi_id.required' => "Profesi wajib diisi",
                'profesi_id.in' => "Format Profesi tidak sesuai",
                'pendidikan_id.required' => "Pendidikan wajib diisi",
                'pendidikan_id.in' => "Format Pendidikan tidak sesuai",
                'agama.required' => "Agama wajib diisi",
                'agama.in' => "Format Agama tidak sesuai",
                'tempat_lahir.required' => "Tempat Lahir wajib diisi",
                'tempat_lahir.regex' => "Format Tempat Lahir tidak sesuai",
                'tempat_lahir.min' => "Tempat Lahir minimal berjumlah 5 karakter",
                'tempat_lahir.max' => "Tempat Lahir maksimal berjumlah 50 karakter",
                'tanggal_lahir.required' => "Tanggal Lahir wajib diisi",
                'tanggal_lahir.date' => "Format Tanggal Lahir tidak sesuai",
                'jenis_kelamin.required' => "Jenis Kelamin wajib diisi",
                'jenis_kelamin.in' => "Format Jenis Kelamin tidak sesuai",
                'golongan_darah.required' => "Golongan Darah wajib diisi",
                'golongan_darah.in' => "Format Golongan Darah tidak sesuai",
                'status_perkawinan.required' => "Status Perkawinan Krama wajib diisi",
                'status_perkawinan.in' => "Format Status Perkawinan Krama tidak sesuai",
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 400,
                    'icon' => 'error',
                    'title' => 'Validation Error',
                    'message' => 'Validation Error, harap kembali mengecek form input!',
                    'data' => $validator->errors(),
                ],400);
            }
        // END

        // MAIN LOGFIC
            try{
                $user = Auth::user();
                DB::beginTransaction();
                $tanggal_lahir = DateRangeHelper::defaultSingleDate($request->tanggal_lahir)->format('Y-m-d');
                Penduduk::findOrFail($user->id_penduduk)->update([
                    'profesi_id'=> $request->profesi_id,
                    'pendidikan_id'=> $request->pendidikan_id,
                    'agama'=> $request->agama,
                    'nama'=> $request->nama,
                    'nama_alias'=> $request->nama_alias,
                    'gelar_depan'=> $request->gelar_depan,
                    'gelar_belakang'=> $request->gelar_belakang,
                    'tempat_lahir'=> $request->tempat_lahir,
                    'tanggal_lahir'=> $tanggal_lahir,
                    'jenis_kelamin'=> $request->jenis_kelamin,
                    'golongan_darah'=> $request->golongan_darah,
                    // 'status_perkawinan'=> $request->status_perkawinan,
                ]);
                DB::commit();
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return response()->json([
                    'status' => 400,
                    'icon' => 'error',
                    'title' => 'Gagal Mengubah Data Diri',
                    'message' => 'Gagal Mengubah Data Diri, untuk lebih lanjut mohon hubungi developer',
                ],400);
            }
        // MAIN LOGIC

        // RETURN JSON AJAX DATA
            return response()->json([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Mengubah Data Diri',
                'message' => 'Data Data diri berhasil diubah dari sistem',
            ],200);
        // RETURN JSON AJAX DATA

    }
    // DATA DIRI UPDATE

    // PEMETAAN LOKASI UPDATE
    public function updatePemetaan(Request $request)
    {

    }
    // PEMETAAN LOKASI UPDATE




}
