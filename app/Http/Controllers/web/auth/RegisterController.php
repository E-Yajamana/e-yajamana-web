<?php

namespace App\Http\Controllers\web\auth;

use App\DateRangeHelper;
use App\Http\Controllers\Controller;
use App\ImageHelper;
use App\Models\DesaAdat;
use App\Models\GriyaRumah;
use App\Models\Kabupaten;
use App\Models\Sanggar;
use App\Models\Sulinggih;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;
use PDOException;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

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
                return view('pages.auth.register.register-krama-bali',compact(['dataKabupaten','dataDesaAdat']));
            }elseif($request->akun == 'sulinggih'){
                $dataKabupaten = Kabupaten::whereProvinsiId(51)->get();
                $queryUser = function ($queryUser){
                    $queryUser->whereRole('sulinggih');
                };
                $dataSulinggih = Sulinggih::with(['User'=> $queryUser])->whereHas('User',$queryUser)->get();
                $dataGriya = GriyaRumah::all();
                return view('pages.auth.register-new.register-sulinggih',compact('dataKabupaten','dataSulinggih','dataGriya'));
            }elseif($request->akun == 'sanggar'){
                return view('pages.auth.register-new.register-sanggar');
            }elseif($request->akun == 'serati'){
                $dataKabupaten = Kabupaten::all();
                $dataDesaAdat = DesaAdat::all();
                return view('pages.auth.register.register-serati',compact(['dataKabupaten','dataDesaAdat']));
            }elseif($request->akun == 'pemangku'){
                $dataKabupaten = Kabupaten::all();
                $dataDesaAdat = DesaAdat::all();
                return view('pages.auth.register.register-pemangku',compact(['dataKabupaten','dataDesaAdat']));
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
                'nama' => 'required|regex:/^[a-z,. 0-9, -]+$/i|min:5|max:50',
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

    // START STORE AKUN SANGGAR
    public function storeRegisSanngar(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'file' => 'required|image|mimes:png,jpg,jpeg|max:2500',
                'email' => 'required|email|unique:tb_user,email|min:5|max:100',
                'nomor_telepon' => 'required|unique:tb_user,nomor_telepon|numeric|digits_between:11,15',
                'nama_pengelola' => 'required|regex:/^[a-z,. 0-9, -]+$/i|min:5|max:50',
                'nama_sanggar' => 'required|regex:/^[a-z,. 0-9, -]+$/i|min:5|max:50',
                'password' => 'required|confirmed',
                'desa_dinas' => 'required|exists:tb_desa,id_desa',
                'desa_adat' => 'required|exists:tb_desaadat,desadat_id',
                'alamat' => 'required|regex:/^[a-z,. 0-9]+$/i|min:3|max:100',
                'lat' => 'required|numeric|regex:/^[0-9.-]+$/i',
                'lng' => 'required|numeric|regex:/^[0-9.-]+$/i',
            ],
            [
                'file.required' => "Gambar SK Tanda Usaha wajib diisi",
                'file.image' => "Gambar SK Tanda Usaha harus berupa foto",
                'file.mimes' => "Format gambar harus jpeg, png atau jpg",
                'file.size' => "Gambar maksimal berukuran 2.5 Mb",
                'email.required' => "Email wajib diisi",
                'email.regex' => "Format Email tidak sesuai",
                'email.unique' => "Email sudah pernah dibuat sebelumnya",
                'email.min' => "Email minimal berjumlah 5 karakter",
                'email.max' => "Email maksimal berjumlah 100 karakter",
                'nomor_telepon.required' => "Nomor Telepon wajib diisi",
                'nomor_telepon.unique' => "Nomor Telepon sudah pernah dibuat sebelumnya",
                'nomor_telepon.numeric' => "Nomor Telepon harus berupa angka",
                'nomor_telepon.digits_between' => "Nomor Telepon disii dengan 11 sampai dengan 15 angka",
                'nama_sanggar.required' => "Nama Sanggar wajib diisi",
                'nama_sanggar.regex' => "Format Nama Sanggar tidak sesuai",
                'nama_sanggar.min' => "Nama Sanggar minimal berjumlah 5 karakter",
                'nama_sanggar.max' => "Nama Sanggar maksimal berjumlah 50 karakter",
                'nama_pengelola.required' => "Nama Pengelola wajib diisi",
                'nama_pengelola.regex' => "Format Nama Pengelola tidak sesuai",
                'nama_pengelola.min' => "Nama Pengelola minimal berjumlah 5 karakter",
                'nama_pengelola.max' => "Nama Pengelola maksimal berjumlah 50 karakter",
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
                $folder = 'app/sanggar/sk_tanda_usaha/';
                $filename =  ImageHelper::moveImage($request->file,$folder);
                User::create([
                    'email' => $request->email,
                    'password' =>Hash::make($request->password),
                    'nomor_telepon' =>$request->nomor_telepon,
                    'role' =>'sanggar',
                ])->Sanggar()->create([
                    'id_desa' => $request->desa_dinas,
                    'id_desa_adat' => $request->desa_adat,
                    'nama_sanggar' => $request->nama_sanggar,
                    'nama_pengelola' => $request->nama_pengelola,
                    'alamat_sanggar' => $request->alamat,
                    'sk_tanda_usaha' => $filename,
                    'status_konfirmasi' => 'pending',
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

        //  RETURN
            return redirect()->route('auth.login')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Membuat Akun Sanggar',
                'message' => 'Berhasil membuat akun sanggar, mohon tunggu proses email verifikasi telebih dahulu untuk menggunakan akun',
            ]);
        // END LOGIC
    }
    // END STORE AKUN SANGGAR

    // STORE AKUN SERATI
    public function storeRegisSerati(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'email' => 'required|email|unique:tb_user,email|min:5|max:100',
                'nomor_telepon' => 'required|unique:tb_user,nomor_telepon|numeric|digits_between:11,15',
                'nama' => 'required|regex:/^[a-z,. 0-9, -]+$/i|min:5|max:50',
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
                    'role' =>'serati',
                ])->Serati()->create([
                    'nama_serati' => $request->nama,
                    'alamat_serati' => $request->alamat,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'status_konfirmasi' => 'pending',
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

        //  RETURN
            return redirect()->route('auth.login')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Membuat Akun Serati',
                'message' => 'Berhasil membuat akun serati, mohon tunggu proses email verifikasi telebih dahulu untuk menggunakan akun',
            ]);
        // END LOGIC

    }
    // STORE AKUN SERATI

    // STORE AKUN SULINGGIH
    public function storeRegisSulinggih(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'nama_walaka' => 'required|regex:/^[a-z,. 0-9, -]+$/i|min:5|max:50',
                'nama_sulinggih' => 'required|regex:/^[a-z,. 0-9, -]+$/i|min:5|max:50',
                'nama_pasangan' => 'required|regex:/^[a-z,. 0-9, -]+$/i|min:5|max:50',
                'tanggal_diksha' => 'required|date',
                'pendidikan' => 'required|in:SD,SMP,SMA/SMK,SARJANA,MAGISTER,Doktor',
                'pekerjaan' => 'required|regex:/^[a-z,. 0-9, -]+$/i|min:5|max:50',
                'lokasi_griya' => 'required|exists:tb_griya_rumah,id',
                'email' => 'required|email|unique:tb_user,email|min:5|max:100',
                'password' => 'required|confirmed',
                'nomor_telepon' => 'required|unique:tb_user,nomor_telepon|numeric|digits_between:11,15',
                'tempat_lahir' => 'required|exists:tb_kabupaten_baru,name',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'file' => 'required|image|mimes:png,jpg,jpeg|max:2500',
            ],
            [

                'nama_walaka.required' => "Nama Walaka wajib diisi",
                'nama_walaka.regex' => "Format Nama Walaka tidak sesuai",
                'nama_walaka.min' => "Nama Walaka minimal berjumlah 5 karakter",
                'nama_walaka.max' => "Nama Walaka maksimal berjumlah 50 karakter",
                'nama_sulinggih.required' => "Nama Sulinggih wajib diisi",
                'nama_sulinggih.regex' => "Format Nama Sulinggih tidak sesuai",
                'nama_sulinggih.min' => "Nama Sulinggih minimal berjumlah 5 karakter",
                'nama_sulinggih.max' => "Nama Sulinggih maksimal berjumlah 50 karakter",
                'nama_pasangan.required' => "Nama Pasangan wajib diisi",
                'nama_pasangan.regex' => "Format Nama Pasangan tidak sesuai",
                'nama_pasangan.min' => "Nama Pasangan minimal berjumlah 5 karakter",
                'nama_pasangan.max' => "Nama Pasangan maksimal berjumlah 50 karakter",
                'tanggal_diksha.required' => "Tanggal Diksha wajib diisi",
                'tanggal_diksha.date' => "Format Tanggal Diksha salah",
                'pendidikan.required' => "Pendidikan wajib diisi",
                'pendidikan.in' => "Data Pendidikan tidak sesuai",
                'pekerjaan.required' => "Pekerjaan wajib diisi",
                'pekerjaan.regex' => "Format Pekerjaan tidak sesuai",
                'pekerjaan.min' => "Pekerjaan minimal berjumlah 5 karakter",
                'pekerjaan.max' => "Pekerjaan maksimal berjumlah 50 karakter",
                'lokasi_griya.required' => "Lokasi Griya wajib diisi",
                'lokasi_griya.exists' => "Data Lokasi Griya tidak sesuai",
                'email.required' => "Email wajib diisi",
                'email.regex' => "Format Email tidak sesuai",
                'email.unique' => "Email sudah pernah dibuat sebelumnya",
                'email.min' => "Email minimal berjumlah 5 karakter",
                'email.max' => "Email maksimal berjumlah 100 karakter",
                'password.required' => "Password wajib diisi",
                'password.confirmed' => "Password yang anda masukan tidak sesuai",
                'nomor_telepon.required' => "Nomor Telepon wajib diisi",
                'nomor_telepon.unique' => "Nomor Telepon sudah pernah dibuat sebelumnya",
                'nomor_telepon.numeric' => "Nomor Telepon harus berupa angka",
                'nomor_telepon.digits_between' => "Nomor Telepon disii dengan 11 sampai dengan 15 angka",
                'tempat_lahir.required' => "Tempat Lahir wajib diisi",
                'tempat_lahir.exists' => "Data tempat lahir tidak sesuai",
                'tanggal_lahir.required' => "Tanggal lahir wajib diisi",
                'tanggal_lahir.date' => "Format Tanggal lahir salah",
                'jenis_kelamin.required' => "Jenis Kelamin wajib diisi",
                'jenis_kelamin.in' => "Jenis Kelamin tidak sesuai",
                'file.required' => "Gambar SK Kesulinggihan wajib diisi",
                'file.image' => "Gambar SK Kesulinggihan harus berupa foto",
                'file.mimes' => "Format gambar harus jpeg, png atau jpg",
                'file.size' => "Gambar maksimal berukuran 2.5 Mb",

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
                $folder = 'app/sulinggih/sk/';
                $filename =  ImageHelper::moveImage($request->file,$folder);
                User::create([
                    'email' => $request->email,
                    'password' =>Hash::make($request->password),
                    'nomor_telepon' =>$request->nomor_telepon,
                    'role' =>'sulinggih',
                ])->Sulinggih()->create([
                    'nama_walaka' => $request->nama_walaka,
                    'nama_sulinggih' => $request->nama_sulinggih,
                    'nama_pasangan' => $request->nama_pasangan,
                    'tanggal_diksha' => $request->tanggal_diksha,
                    'pendidikan' => $request->pendidikan,
                    'pekerjaan' => $request->pekerjaan,
                    'id_griya' => $request->lokasi_griya,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'nabe' => $request->nabe,
                    'status_konfirmasi_akun' => 'pending',
                    'sk_kesulinggihan' => $filename,
                ]);
                DB::commit();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                DB::rollBack();
                File::delete(storage_path($filename));
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Menambahkan Data Akun Sulinggih',
                    'message' => 'Gagal menambahkan data akun sulinggih, apabila diperlukan mohon hubungi developer sistem`',
                ]);
            }
        // END LOGIC

        //  RETURN
            return redirect()->route('auth.login')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Membuat Akun Sulinggih',
                'message' => 'Berhasil membuat akun sulinggih, mohon tunggu proses email verifikasi telebih dahulu untuk menggunakan akun',
            ]);
        // END LOGIC
    }
    // STORE AKUN SULINGGIH

    // STORE AKUN PEMANGKU
    public function storeRegisPemangku(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'nama_sulinggih' => 'required|regex:/^[a-z,. 0-9, -]+$/i|min:5|max:50',
                'pendidikan' => 'required|in:SD,SMP,SMA/SMK,SARJANA,MAGISTER,Doktor',
                'pekerjaan' => 'required|regex:/^[a-z,. 0-9, -]+$/i|min:5|max:50',
                'lokasi_griya' => 'required|exists:tb_griya_rumah,id',
                'email' => 'required|email|unique:tb_user,email|min:5|max:100',
                'password' => 'required|confirmed',
                'nomor_telepon' => 'required|unique:tb_user,nomor_telepon|numeric|digits_between:11,15',
                'tempat_lahir' => 'required|exists:tb_kabupaten_baru,name',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            ],
            [
                'nama_sulinggih.required' => "Nama Pemangku wajib diisi",
                'nama_sulinggih.regex' => "Format Nama Pemangku tidak sesuai",
                'nama_sulinggih.min' => "Nama Pemangku minimal berjumlah 5 karakter",
                'nama_sulinggih.max' => "Nama Pemangku maksimal berjumlah 50 karakter",
                'pendidikan.required' => "Pendidikan wajib diisi",
                'pendidikan.in' => "Data Pendidikan tidak sesuai",
                'pekerjaan.required' => "Pekerjaan wajib diisi",
                'pekerjaan.regex' => "Format Pekerjaan tidak sesuai",
                'pekerjaan.min' => "Pekerjaan minimal berjumlah 5 karakter",
                'pekerjaan.max' => "Pekerjaan maksimal berjumlah 50 karakter",
                'lokasi_griya.required' => "Lokasi Griya wajib diisi",
                'lokasi_griya.exists' => "Data Lokasi Griya tidak sesuai",
                'email.required' => "Email wajib diisi",
                'email.regex' => "Format Email tidak sesuai",
                'email.unique' => "Email sudah pernah dibuat sebelumnya",
                'email.min' => "Email minimal berjumlah 5 karakter",
                'email.max' => "Email maksimal berjumlah 100 karakter",
                'password.required' => "Password wajib diisi",
                'password.confirmed' => "Password yang anda masukan tidak sesuai",
                'nomor_telepon.required' => "Nomor Telepon wajib diisi",
                'nomor_telepon.unique' => "Nomor Telepon sudah pernah dibuat sebelumnya",
                'nomor_telepon.numeric' => "Nomor Telepon harus berupa angka",
                'nomor_telepon.digits_between' => "Nomor Telepon disii dengan 11 sampai dengan 15 angka",
                'tempat_lahir.required' => "Tempat Lahir wajib diisi",
                'tempat_lahir.exists' => "Data tempat lahir tidak sesuai",
                'tanggal_lahir.required' => "Tanggal lahir wajib diisi",
                'tanggal_lahir.date' => "Format Tanggal lahir salah",
                'jenis_kelamin.required' => "Jenis Kelamin wajib diisi",
                'jenis_kelamin.in' => "Jenis Kelamin tidak sesuai",

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
                    'role' =>'pemangku',
                ])->Sulinggih()->create([
                    'nama_sulinggih' => $request->nama_sulinggih,
                    'pendidikan' => $request->pendidikan,
                    'pekerjaan' => $request->pekerjaan,
                    'id_griya' => $request->lokasi_griya,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'status_konfirmasi_akun' => 'pending',
                ]);
                DB::commit();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                DB::rollBack();
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Menambahkan Data Akun Sulinggih',
                    'message' => 'Gagal menambahkan data akun sulinggih, apabila diperlukan mohon hubungi developer sistem`',
                ]);
            }
        // END LOGIC

        //  RETURN
            return redirect()->route('auth.login')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Membuat Akun Pemangku',
                'message' => 'Berhasil membuat akun Pemangku, mohon tunggu proses email verifikasi telebih dahulu untuk menggunakan akun',
            ]);
        // END LOGIC
    }
    // STORE AKUN PEMANGKU

    // STORE AKUN SULINGGIH NEW INTEGERATION
    public function storeNewRegisSulinggih(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'id_penduduk' => 'required|exists:tb_penduduk,id',
                'email' => 'required|email|unique:tb_user_eyajamana,email|min:5|max:100',
                'password' => 'required|confirmed',
                'nomor_telepon' => 'unique:tb_user_eyajamana,nomor_telepon|numeric|digits_between:11,15',
                'nama_walaka' => 'required|regex:/^[a-z,. 0-9, -]+$/i|min:5|max:50',
                'nama_sulinggih' => 'required|regex:/^[a-z,. 0-9, -]+$/i|min:5|max:50',
                'tanggal_diksha' => 'required|date',
            ],
            [
                'id_penduduk.required' => "ID Penduduk wajib diisi",
                'id_penduduk.exists' => "ID penduduk tidak sesuai",
                'email.required' => "Email wajib diisi",
                'email.regex' => "Format Email tidak sesuai",
                'email.unique' => "Email sudah pernah dibuat sebelumnya",
                'email.min' => "Email minimal berjumlah 5 karakter",
                'email.max' => "Email maksimal berjumlah 100 karakter",
                'password.required' => "Password wajib diisi",
                'password.confirmed' => "Password yang anda masukan tidak sesuai",
                'nomor_telepon.required' => "Nomor Telepon wajib diisi",
                'nomor_telepon.unique' => "Nomor Telepon sudah pernah dibuat sebelumnya",
                'nomor_telepon.numeric' => "Nomor Telepon harus berupa angka",
                'nomor_telepon.digits_between' => "Nomor Telepon disii dengan 11 sampai dengan 15 angka",
                'nama_walaka.required' => "Nama Walaka wajib diisi",
                'nama_walaka.regex' => "Format Nama Walaka tidak sesuai",
                'nama_walaka.min' => "Nama Walaka minimal berjumlah 5 karakter",
                'nama_walaka.max' => "Nama Walaka maksimal berjumlah 50 karakter",
                'nama_sulinggih.required' => "Nama Sulinggih wajib diisi",
                'nama_sulinggih.regex' => "Format Nama Sulinggih tidak sesuai",
                'nama_sulinggih.min' => "Nama Sulinggih minimal berjumlah 5 karakter",
                'nama_sulinggih.max' => "Nama Sulinggih maksimal berjumlah 50 karakter",
                'tanggal_diksha.required' => "Tanggal Diksha wajib diisi",
                'tanggal_diksha.date' => "Format Tanggal Diksha salah",
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Registrasi',
                    'message' => 'Gagal melakukan registrasi akun, silakan periksa kembali form input anda!'
                ])->withInput($request->all())->withErrors($validator->errors());
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                DB::beginTransaction();
                $user = User::create([
                    'id_penduduk' => $request->id_penduduk,
                    'email'=> $request->email,
                    'password'=> Hash::make($request->password),
                    'nomor_telepon'=> $request->nomor_telepon,
                    'user_profile'=> 'app/default/profile/user.jpg',
                    'role'=> 'sulinggih',
                ]);
                $namaPasangan = $request->nama_pasangan;
                $namaNabe = $request->nama_nabe;
                $tanggalDiksha = DateRangeHelper::defaultSingleDate($request->tanggal_diksha);
                $folder = 'app/sulinggih/sk/';
                $filename =  ImageHelper::moveImage($request->file,$folder);

                if($request->nama_griya != null && $request->nama_griya != ""){
                    //  SECURITY FORM GRIYA
                        $validator = Validator::make($request->all(),[
                            'nama_griya' => "required|regex:/^[a-z ,.'-]+$/i|min:3|max:50",
                            'alamat_griya' => "required|regex:/^[a-z,. 0-9]+$/i|min:3|max:100",
                            'kabupaten' => 'required|exists:tb_m_kabupaten,id',
                            'id_banjar_dinas' => 'required|exists:tb_m_banjar_dinas,id',
                            'lat' => 'required|numeric|regex:/^[0-9.-]+$/i',
                            'lng' => 'required|numeric|regex:/^[0-9.-]+$/i',
                        ],
                        [
                            'nama_griya.required' => "Nama griya wajib diisi",
                            'nama_griya.regex' => "Format nama griya tidak sesuai",
                            'nama_griya.min' => "Nama griya minimal berjumlah 3 karakter",
                            'nama_griya.max' => "Nama griya maksimal berjumlah 50 karakter",
                            'alamat_griya.required' => "Nama griya wajib diisi",
                            'alamat_griya.regex' => "Format nama griya tidak sesuai",
                            'alamat_griya.min' => "Nama griya minimal berjumlah 3 karakter",
                            'alamat_griya.max' => "Nama griya maksimal berjumlah 100 karakter",
                            'kabupaten.required' => "Lokasi Kabupaten wajib diisi",
                            'kabupaten.exists' => "Lokasi Kabupaten tidak sesuai",
                            'id_banjar_dinas.required' => "Lokasi Banjar Dinas wajib diisi",
                            'id_banjar_dinas.exists' => "Lokasi Banjar Dinas tidak sesuai",
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
                                'message' => 'Gagal melakukan registrasi akun, silakan periksa kembali form Griya anda!'
                            ])->withInput($request->all())->withErrors($validator->errors());
                        }
                    // END SECURITY FORM GRIYA

                    // CREATE FUNCTION
                    GriyaRumah::create([
                        'nama_griya_rumah'=> $request->nama_griya,
                        'alamat_griya_rumah'=> $request->alamat_griya,
                        'id_banjar_dinas'=> $request->id_banjar_dinas,
                        'lat'=> $request->lat,
                        'lng'=> $request->lng,
                    ])->Sulinggih()->create([
                        'id_user' => $user->id,
                        'id_nabe' => $request->id_nabe,
                        'id_pasangan' => $request->id_pasangan,
                        'nama_walaka' => $request->nama_walaka,
                        'nama_sulinggih' => $request->nama_sulinggih,
                        'nama_pasangan' => $namaPasangan,
                        'nama_nabe' => $namaNabe,
                        'tanggal_diksha' => $tanggalDiksha->format('Y-m-d'),
                        'status' => 'sulinggih' ,
                        'sk_kesulinggihan' => $filename,
                        'status_konfirmasi_akun' => 'pending',
                    ]);
                }else{
                    $user->Sulinggih()->create([
                        'id_griya' => $request->id_griya,
                        'id_nabe' => $request->id_nabe,
                        'id_pasangan' => $request->id_pasangan,
                        'nama_walaka' => $request->nama_walaka,
                        'nama_sulinggih' => $request->nama_sulinggih,
                        'nama_pasangan' => $namaPasangan,
                        'nama_nabe' => $namaNabe,
                        'tanggal_diksha' => $tanggalDiksha->format('Y-m-d'),
                        'status' => 'sulinggih' ,
                        'sk_kesulinggihan' => $filename,
                        'status_konfirmasi_akun' => 'pending',
                    ]);
                }
                DB::commit();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                // File::delete(storage_path($filename));
                DB::rollBack();
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Menambahkan Data Akun Sulinggih',
                    'message' => 'Gagal menambahkan data akun sulinggih, apabila diperlukan mohon hubungi developer sistem`',
                ]);
            }
        // END LOGIC

        //  RETURN
            return redirect()->route('auth.login')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Membuat Akun Sulinggih',
                'message' => 'Berhasil membuat akun sulinggih, mohon tunggu proses email verifikasi telebih dahulu untuk menggunakan akun',
            ]);
        // END LOGIC
    }
    // STORE AKUN SULINGGIH NEW INTEGERATION

    // SANGGAR STORE AKUN NEW INTEGERATION
    public function storeNewRegisSanggar(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'id_penduduk' => 'required|exists:tb_penduduk,id',
                'email' => 'required|email|unique:tb_user_eyajamana,email|min:5|max:100',
                'password' => 'required|confirmed',
                'nomor_telepon' => 'unique:tb_user_eyajamana,nomor_telepon|numeric|digits_between:11,15',
                'nama_sanggar' => 'required|regex:/^[a-z,. 0-9, -]+$/i|min:5|max:50',
                'alamat_sanggar' => "required|regex:/^[a-z,. 0-9]+$/i|min:3|max:100",
                'lat' => 'required|numeric|regex:/^[0-9.-]+$/i',
                'lng' => 'required|numeric|regex:/^[0-9.-]+$/i',
            ],
            [
                'id_penduduk.required' => "ID Penduduk wajib diisi",
                'id_penduduk.exists' => "ID penduduk tidak sesuai",
                'email.required' => "Email wajib diisi",
                'email.regex' => "Format Email tidak sesuai",
                'email.unique' => "Email sudah pernah dibuat sebelumnya",
                'email.min' => "Email minimal berjumlah 5 karakter",
                'email.max' => "Email maksimal berjumlah 100 karakter",
                'password.required' => "Password wajib diisi",
                'password.confirmed' => "Password yang anda masukan tidak sesuai",
                'nomor_telepon.required' => "Nomor Telepon wajib diisi",
                'nomor_telepon.unique' => "Nomor Telepon sudah pernah dibuat sebelumnya",
                'nomor_telepon.numeric' => "Nomor Telepon harus berupa angka",
                'nomor_telepon.digits_between' => "Nomor Telepon disii dengan 11 sampai dengan 15 angka",
                'nama_sanggar.required' => "Nama Sanggar wajib diisi",
                'nama_sanggar.regex' => "Format Nama Sanggar tidak sesuai",
                'nama_sanggar.min' => "Nama Sanggar minimal berjumlah 5 karakter",
                'nama_sanggar.max' => "Nama Sanggar maksimal berjumlah 50 karakter",
                'alamat_sanggar.required' => "Alamat Sanggar wajib diisi",
                'alamat_sanggar.regex' => "Format Alamat Sanggar tidak sesuai",
                'alamat_sanggar.min' => "Alamat Sanggar minimal berjumlah 3 karakter",
                'alamat_sanggar.max' => "Alamat Sanggar maksimal berjumlah 100 karakter",
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
        // END SECURITY

        // MAIN LOGIC
            try{
                DB::beginTransaction();
                $folder = 'app/sanggar/sk_tanda_usaha/';
                $filename =  ImageHelper::moveImage($request->file,$folder);
                User::create([
                    'id_penduduk' => $request->id_penduduk,
                    'email'=> $request->email,
                    'password'=> Hash::make($request->password),
                    'nomor_telepon'=> $request->nomor_telepon,
                    'user_profile'=> 'app/default/profile/user.jpg',
                    'role'=> 'sanggar',
                ])->Sanggar()->create([
                    'nama_sanggar'=> $request->nama_sanggar ,
                    'alamat_sanggar'=> $request->alamat_sanggar,
                    'sk_tanda_usaha'=> $filename,
                    'lat'=> $request->lat ,
                    'lng'=> $request->lng ,
                    'status_konfirmasi_akun'=> 'pending',
                ]);
                DB::commit();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                DB::rollBack();
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Menambahkan Data Akun Sanggar',
                    'message' => 'Gagal menambahkan data akun Sanggar, apabila diperlukan mohon hubungi developer sistem`',
                ]);
            }
        //END MAIN LOGIC

        //  RETURN
            return redirect()->route('auth.login')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Membuat Akun Sanggar',
                'message' => 'Berhasil membuat akun Sanggar, mohon tunggu proses email verifikasi telebih dahulu untuk menggunakan akun',
            ]);
        // END LOGIC
    }
    // SANGGAR STORE AKUN NEW INTEGERATION





}
