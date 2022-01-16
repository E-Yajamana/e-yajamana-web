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
    public function regisIndex(Request $request)
    {
        return view('pages.auth.register.register-index');
    }

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
                'nomor_telepon' => 'required|unique:tb_user,nomor_telepon',
                'nama' => 'required|regex:/^[a-z,. 0-9]+$/i',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'password' => 'required|confirmedS',
                'desa_dinas' => 'required',
                'desa_adat' => 'required',
                'alamat' => 'required',
                'lat' => 'required',
                'lng' => 'required',
            ],
            [
                'nama_upacara.required' => "Nama upacara wajib diisi",
                'nama_upacara.regex' => "Format nama upacara tidak sesuai",
                'nama_upacara.min' => "Nama upacara minimal berjumlah 5 karakter",
                'nama_upacara.max' => "Nama upacara maksimal berjumlah 50 karakter",
                'nama_upacara.unique' => "Nama Upacara sudah pernah dibuat sebelumnya",
                'katagori.required' => "Katagori upacara wajib diisi",
                'katagori.in' => "Katagori Upacara tidak sesuai ",
                'foto_upacara.required' => "Gambar upacara wajib diisi",
                'foto_upacara.image' => "Gambar harus berupa foto",
                'foto_upacara.mimes' => "Format gambar harus jpeg, png atau jpg",
                'foto_upacara.size' => "Gambar maksimal berukuran 2.5 Mb",
                'deskripsi_upacara.required' => "Deskripsi upacara wajib diisi",
                'deskripsi_upacara.min' => "Deskripsi upacara minimal berjumlah 5 karakter",
                'deskripsi_upacara.max' => "Deskripsi upacara maksimal berjumlah 50 karakter",
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
