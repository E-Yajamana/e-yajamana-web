<?php

namespace App\Http\Controllers\web\auth;

use App\Http\Controllers\Controller;
use App\Models\DesaAdat;
use App\Models\Kabupaten;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use PDOException;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
     // INDEX VIEW REGISTER AWAL
    public function regisIndex(Request $request)
    {
        return view('pages.auth.register.register-index');
    }
    // INDEX VIEW REGISTER AWAL

    // FUNGSI MENENTUKAN FORM BLADE USER
    public function regisFormAkun(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['akun' =>$request->akun],[
                'akun' => 'required|in:krama,sulinggih,pemangku,sanggar,serati',
            ]);

            if($validator->fails()){
                return redirect()->route('auth.register.index')->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Registrasi',
                    'message' => 'Gagal melakukan registrasi akun, pilihlah jenis user sesuai dengan user yang disediakan!'
                ]);
            }
        // END

        // MAIN LOGIC & RETURN
            if($request->akun == 'krama'){
                $dataKabupaten = Kabupaten::all();
                $dataDesaAdat = DesaAdat::all();
                return view('pages.auth.register.register-krama-bali',compact(['dataKabupaten','dataDesaAdat']));
            }elseif($request->akun == 'sulinggih'  || $request->akun == 'pemangku'){
                $dataKabupaten = Kabupaten::all();
                return view('pages.auth.register.register-pemuput-karya',compact('dataKabupaten'))->with(['role'=> $request->akun]);
            }elseif($request->akun == 'sanggar'){
                $dataKabupaten = Kabupaten::all();
                $dataDesaAdat = DesaAdat::all();
                return view('pages.auth.register.register-sanggar',compact(['dataKabupaten','dataDesaAdat']));
            }elseif($request->akun == 'serati'){
                $dataKabupaten = Kabupaten::all();
                $dataDesaAdat = DesaAdat::all();
                return view('pages.auth.register.register-serati',compact(['dataKabupaten','dataDesaAdat']));
            }else{
                return redirect()->route('auth.register.index')->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Registrasi',
                    'message' => 'Gagal melakukan registrasi akun, pilihlah jenis user sesuai dengan user yang disediakan!'
                ]);
            }
        // END LOGIC & RETURN

    }
    // END FUNGSI MENENTUKAN FORM BLADE USER



    // FUNGSI STORE AKUN KRAMA
    public function storeRegisKrama(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'email' => 'required|email|unique:tb_user,email|min:5|max:100',
                'nomor_telepon' => 'required|unique:tb_user,nomor_telepon|numeric|digits_between:11,15',
                'nama' => 'required|regex:/^[a-z,. 0-9]+$/i|min:5|max:50',
                'tempat_lahir' => 'required|exists:tb_kabupaten_baru,name',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'password' => 'required|confirmed',
                'desa_dinas' => 'required|exists:tb_desa,id_desa',
                'desa_adat' => 'required|exists:tb_desaadat,desadat_id',
                'alamat' => 'required|regex:/^[a-z,. 0-9]+$/i|min:3|max:100',
                'lat' => 'required|numeric|regex:/^[0-9.-]+$/i',
                'lng' => 'required|numeric|regex:/^[0-9.-]+$/i',
            ],
            [
                'email.required' => "Email wajib diisi",
                'email.regex' => "Format Email tidak sesuai",
                'email.unique' => "Email sudah pernah dibuat sebelumnya",
                'email.min' => "Email minimal berjumlah 5 karakter",
                'email.max' => "Email maksimal berjumlah 100 karakter",
                'nomor_telepon.required' => "Nomor Telepon wajib diisi",
                'nomor_telepon.unique' => "Nomor Telepon sudah pernah dibuat sebelumnya",
                'nomor_telepon.numeric' => "Nomor Telepon harus berupa angka",
                'nomor_telepon.digits_between' => "Nomor Telepon disii dengan 11 sampai dengan 15 angka",
                'nama.required' => "Nama wajib diisi",
                'nama.regex' => "Format nama tidak sesuai",
                'nama.min' => "Nama minimal berjumlah 5 karakter",
                'nama.max' => "Nama maksimal berjumlah 50 karakter",
                'tempat_lahir.required' => "Tempat Lahir wajib diisi",
                'tempat_lahir.exists' => "Data tempat lahir tidak sesuai",
                'tanggal_lahir.required' => "Tanggal lahir wajib diisi",
                'tanggal_lahir.date' => "Format Tanggal lahir salah",
                'jenis_kelamin.required' => "Jenis Kelamin wajib diisi",
                'jenis_kelamin.in' => "Jenis Kelamin tidak sesuai",
                'desa_dinas.required' => "Lokasi Desa wajib diisi",
                'desa_dinas.exists' => "Lokasi Desa tidak sesuai",
                'desa_adat.required' => "Lokasi Desa Adat wajib diisi",
                'desa_adat.exists' => "Lokasi Desa Adat tidak sesuai",
                'password.required' => "Password wajib diisi",
                'password.confirmed' => "Password yang anda masukan tidak sesuai",
                'alamat.required' => "Alamat Lengkap wajib diisi",
                'alamat.regex' => "Format Alamat Lengkap tidak sesuai",
                'alamat.min' => "Alamat Lengkap minimal berjumlah 3 karakter",
                'alamat.max' => "Alamat Lengkap maksimal berjumlah 100 karakter",
                'lat.required' => "Latitude griya wajib diisi",
                'lat.numeric' => "Latitude harus berupa angka",
                'lat.regex' => "Format koordinat Latitude griya tidak sesuai",
                'lng.required' => "Longitude griya wajib diisi",
                'lng.numeric' => "Longitude harus berupa angka",
                'lng.regex' => "Format koordinat Longitude griya tidak sesuai",

            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Registrasi',
                    'message' => 'Gagal melakukan registrasi akun, silakan periksa kembali form input anda!'
                ])->withInput($request->all())->withErrors($validator->errors());
            }
        // END

        // MAIN LOGIC
            try{
                DB::beginTransaction();
                User::create([
                    'email' => $request->email,
                    'password' =>Hash::make($request->password),
                    'nomor_telepon' =>$request->nomor_telepon,
                    'role' =>'krama_bali',
                ])->Krama()->create([
                    'id_desa' => $request->desa_dinas,
                    'id_desa_adat' => $request->desa_adat,
                    'nama_krama' => $request->nama,
                    'alamat_krama' => $request->alamat,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'lat' => $request->lat,
                    'lng' => $request->lng,
                ]);
                DB::commit();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                DB::rollBack();
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Menambahkan Data Upacara',
                    'message' => 'Gagal menambahkan data upacara, apabila diperlukan mohon hubungi developer sistem`',
                ]);
            }
        // END LOGIC

        // RETURN
            return redirect()->route('auth.login')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Akun Berhasil Dibuat',
                'message' => 'Akun berhasil dibuat, gunakan email dan password untuk masuk kedalam sistem',
            ]);
        //END
    }
    // END STORE AKUN KRAMA


    public function storeRegisSanngar(Request $request)
    {

    }



}
