<?php

namespace App\Http\Controllers\web\auth;

use App\DateRangeHelper;
use App\Http\Controllers\Controller;
use App\ImageHelper;
use App\Models\AtributPemuput;
use App\Models\DesaAdat;
use App\Models\GriyaRumah;
use App\Models\Kabupaten;
use App\Models\PemuputKarya;
use App\Models\Sanggar;
use App\Models\Serati;
use App\Models\Sulinggih;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;
use PDOException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

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
                return view('pages.auth.register.register-krama');
            }elseif($request->akun == 'sulinggih'){
                $dataKabupaten = Kabupaten::whereProvinsiId(51)->get();
                $dataSulinggih = PemuputKarya::with(['User'])->whereHas('User')->whereTipe('sulinggih')->whereNull('id_pasangan')->whereStatusKonfirmasiAkun('disetujui')->get();
                $dataGriya = GriyaRumah::all();
                return view('pages.auth.register.register-sulinggih',compact('dataKabupaten','dataSulinggih','dataGriya'));
            }elseif($request->akun == 'sanggar'){
                $dataKabupaten = Kabupaten::whereProvinsiId(51)->get();
                return view('pages.auth.register.register-sanggar', compact('dataKabupaten'));
            }elseif($request->akun == 'serati'){
                $dataKabupaten = Kabupaten::whereProvinsiId(51)->get();
                return view('pages.auth.register.register-serati',compact('dataKabupaten'));
            }elseif($request->akun == 'pemangku'){
                $dataKabupaten = Kabupaten::whereProvinsiId(51)->get();
                $dataGriya = GriyaRumah::all();
                $dataPemangku = PemuputKarya::whereHas('User')->whereHas('User')->whereTipe('pemangku')->whereNull('id_pasangan')->whereStatusKonfirmasiAkun('disetujui')->get();
                return view('pages.auth.register.register-pemangku',compact(['dataKabupaten','dataGriya','dataPemangku']));
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


    // STORE AKUN SULINGGIH NEW INTEGERATION
    public function storeRegisSulinggih(Request $request)
    {
        // SECURITY
            // VALIDASI DEFAULT
            $rules = [
                'nama_pemuput' => 'required|regex:/^[a-z,. 0-9, -]+$/i|min:5|max:50',
            ];
            $message = [
                'nama_pemuput.required' => "Nama Sulinggih wajib diisi",
                'nama_pemuput.regex' => "Format Nama Sulinggih tidak sesuai",
                'nama_pemuput.min' => "Nama Sulinggih minimal berjumlah 5 karakter",
                'nama_pemuput.max' => "Nama Sulinggih maksimal berjumlah 50 karakter",
            ];
            // VALIDASI DEFAULT

            // USER CHECK
            if($request->id_user != null && $request->id_user != ""){
                $rules += [
                    'id_user' => 'required|unique:tb_pemuput_karya,id_user',
                ];
                $message += [
                    'id_user.required' => "ID User wajib diisi",
                    'id_user.unique' => "ID User tidak boleh sama",
                ];
            }else{
                $rules += [
                    'id_penduduk' => 'required|unique:tb_user_eyajamana,id_penduduk',
                    'email' => 'required|email|unique:tb_user_eyajamana,email|min:5|max:100',
                    'password' => 'required|confirmed',
                    'nomor_telepon' => 'unique:tb_user_eyajamana,nomor_telepon|numeric|digits_between:11,15',
                ];
                $message += [
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
                ];
            }
            // USER CHECK

            // PEMUPUT CHECK
            if($request->id_pasangan != 0 && $request->id_pasangan != ""){
                $rules += [
                    'id_pasangan' => 'required|exists:tb_pemuput_karya,id',
                ];
                $message += [
                    'id_pasangan.required' => "ID Pasangan wajib diisi",
                    'id_pasangan.exists' => "ID Pasangan tidak sesuai",
                ];
            }else{
                $rules += [
                    'file' => "required|image|mimes:png,jpg,jpeg|max:2500",
                    'tanggal_diksha' => 'required|date',
                ];
                if($request->id_nabe != 0){
                    $rules += [
                        'id_nabe' => 'required|exists:tb_pemuput_karya,id',
                    ];
                }
                if($request->nama_griya != null && $request->nama_griya != ""){
                    $rules += [
                        'nama_griya' => "required|regex:/^[a-z ,.'-]+$/i|min:3|max:50",
                        'alamat_griya' => "required|regex:/^[a-z,. 0-9]+$/i|min:3|max:100",
                        'kabupaten' => 'required|exists:tb_m_kabupaten,id',
                        'id_banjar_dinas' => 'required|exists:tb_m_banjar_dinas,id',
                        'lat' => 'required|numeric|regex:/^[0-9.-]+$/i',
                        'lng' => 'required|numeric|regex:/^[0-9.-]+$/i',
                    ];
                }
            }
            $validator = Validator::make($request->all(),$rules,$message);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Registrasi',
                    'message' => 'Gagal melakukan registrasi akun, silakan periksa kembali form input anda..!!'
                ])->withInput($request->all())->withErrors($validator->errors());
            }
        // END SECURITY

        // MAIN LOGIC
        try{
            DB::beginTransaction();
            if($request->id_user != null && $request->id_user != ""){
                $user = User::findOrFail($request->id_user);
                $role = 3;
            }else{
                $user = User::create([
                    'id_penduduk' => $request->id_penduduk,
                    'email'=> $request->email,
                    'password'=> Hash::make($request->password),
                    'nomor_telepon'=> $request->nomor_telepon,
                    'user_profile'=> 'app/default/profile/user.jpg',
                ]);
                $role = [2,3];
            }
            $user->Role()->attach($role);

            // PEMUPUT CREATE
            if($request->id_pasangan != 0 && $request->id_pasangan != ""){
                $pasangan = PemuputKarya::findOrFail($request->id_pasangan);
                $newPemuput = PemuputKarya::create([
                    'id_user' => $user->id,
                    'id_griya' => $pasangan->id_griya,
                    'id_pasangan' => $pasangan->id,
                    'id_atribut' => $pasangan->id_atribut,
                    'nama_pemuput' => $request->nama_pemuput,
                    'status_konfirmasi_akun' => 'pending',
                    'tipe' => 'sulinggih',
                ]);
                $pasangan->update(['id_pasangan' => $newPemuput->id]);
            }else{
                if($request->nama_griya != null && $request->nama_griya != ""){
                    $griya = GriyaRumah::create([
                        'nama_griya_rumah'=> $request->nama_griya,
                        'alamat_griya_rumah'=> $request->alamat_griya,
                        'id_banjar_dinas'=> $request->id_banjar_dinas,
                        'lat'=> $request->lat,
                        'lng'=> $request->lng,
                    ]);
                    $idGriya = $griya->id;
                }else{
                    $idGriya = $request->id_griya;
                }

                $idNabe = $request->id_nabe;
                $idPasangan = null;
                if($request->id_nabe == 0){
                    $idNabe = null;
                }
                $tanggalDiksha = DateRangeHelper::defaultSingleDate($request->tanggal_diksha);
                $filename =  ImageHelper::moveImage($request->file,'app/sulinggih/sk/');
                AtributPemuput::create([
                    'id_nabe' => $idNabe,
                    'sk_pemuput' => $filename,
                    'tanggal_diksha' => $tanggalDiksha,
                ])->PemuputKarya()->create([
                    'id_user' => $user->id,
                    'id_griya' => $idGriya,
                    'id_pasangan' => $idPasangan,
                    'nama_pemuput' => $request->nama_pemuput,
                    'status_konfirmasi_akun' => 'pending',
                    'tipe' => 'sulinggih',
                ]);
            }
            DB::commit();
        }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
            DB::rollBack();
            return redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Gagal Menambahkan Data Akun',
                'message' => 'Gagal menambahkan data akun, apabila diperlukan mohon hubungi developer sistem`',
            ]);
        }
        // END MAIN LOGIC


        //  RETURN
            return redirect()->route('auth.login')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Membuat Akun Sulinggih',
                'message' => 'Berhasil membuat akun sulinggih, mohon tunggu proses email verifikasi telebih dahulu untuk menggunakan akun',
            ]);
        // END LOGIC

    }
    // STORE AKUN SULINGGIH  INTEGERATION

    // SANGGAR STORE AKUN NEW INTEGERATION
    public function storeRegisSanggar(Request $request)
    {
        // SECURITY
            $rules = [
                'nama_sanggar' => 'required|regex:/^[a-z,. 0-9, -]+$/i|min:5|max:50',
                'alamat_sanggar' => "required|regex:/^[a-z,. 0-9]+$/i|min:3|max:100",
                'file' => "required|image|mimes:png,jpg,jpeg|max:2500",
                'id_desa' => 'required|exists:tb_m_desa_dinas,id',
            ];
            $message = [
                'nama_sanggar.required' => "Nama Sulinggih wajib diisi",
                'nama_sanggar.regex' => "Format Nama Sulinggih tidak sesuai",
                'nama_sanggar.min' => "Nama Sulinggih minimal berjumlah 5 karakter",
                'nama_sanggar.max' => "Nama Sulinggih maksimal berjumlah 50 karakter",
                'alamat_sanggar.required' => "Alamat Sanggar wajib diisi",
                'alamat_sanggar.regex' => "Format Alamat Sanggar tidak sesuai",
                'alamat_sanggar.min' => "Alamat Sanggar minimal berjumlah 3 karakter",
                'alamat_sanggar.max' => "Alamat Sanggar maksimal berjumlah 100 karakter",
                'file.required' => "Gambar SK Tanda Usaha wajib diisi",
                'file.image' => "Gambar harus berupa foto",
                'file.mimes' => "Format gambar harus jpeg, png atau jpg",
                'file.size' => "Gambar maksimal berukuran 2.5 Mb",
                'id_desa.required' => "Lokasi Desa Dinas wajib diisi",
                'id_desa.exists' => "Lokasi Desa Dinas tidak sesuai",
            ];
            // VALIDASI DEFAULT

            // USER CHECK
            if($request->id_user != null && $request->id_user != ""){
                $rules += [
                    'id_user' => 'required|unique:tb_pemuput_karya,id_user',
                ];
                $message += [
                    'id_user.required' => "ID User wajib diisi",
                    'id_user.unique' => "ID User tidak boleh sama",
                ];
            }else{
                $rules += [
                    'id_penduduk' => 'required|unique:tb_user_eyajamana,id_penduduk',
                    'email' => 'required|email|unique:tb_user_eyajamana,email|min:5|max:100',
                    'password' => 'required|confirmed',
                    'nomor_telepon' => 'unique:tb_user_eyajamana,nomor_telepon|numeric|digits_between:11,15',
                ];
                $message += [
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
                ];
            }
            // USER CHECK

            $validator = Validator::make($request->all(),$rules,$message);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Registrasi',
                    'message' => 'Gagal melakukan registrasi akun, silakan periksa kembali form input anda..!!'
                ])->withInput($request->all())->withErrors($validator->errors());
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                DB::beginTransaction();
                if($request->id_user != null && $request->id_user != ""){
                    $user = User::with('Role')->findOrFail($request->id_user);
                    $hasRole =$user->Role()->pluck('id_role')->toArray();
                    $existsRole = in_array(5, $hasRole);
                    if(!$existsRole){
                        $user->Role()->attach(5);
                    }
                }else{
                    $user = User::create([
                        'id_penduduk' => $request->id_penduduk,
                        'email'=> $request->email,
                        'password'=> Hash::make($request->password),
                        'nomor_telepon'=> $request->nomor_telepon,
                        'user_profile'=> 'app/default/profile/user.jpg',
                    ]);
                    $role = [2,5];
                    $user->Role()->attach($role);
                }

                $filename =  ImageHelper::moveImage($request->file,'app/sanggar/sk_tanda_usaha/');
                $sanggar = Sanggar::create([
                    'id_desa_dinas'=>$request->id_desa,
                    'nama_sanggar'=>$request->nama_sanggar,
                    'alamat_sanggar'=>$request->alamat_sanggar,
                    'sk_tanda_usaha'=>$filename,
                    'lat'=>$request->lat,
                    'lng'=>$request->lng,
                    'status_konfirmasi_akun'=>'pending'
                ]);
                $user->Sanggar()->attach($sanggar->id);

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
                'message' => 'Berhasil membuat akun Sanggar, mohon tunggu proses verifikasi telebih dahulu untuk menggunakan akun Sanggar',
            ]);
        // END LOGIC
    }
    // SANGGAR STORE AKUN NEW INTEGERATION

    // KRAMA STORE AKUN NEW INTEGERATION
    public function storeRegisKrama(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'id_penduduk' => 'required|unique:tb_user_eyajamana,id_penduduk',
                'email' => 'required|email|unique:tb_user_eyajamana,email|min:5|max:100',
                'password' => 'required|confirmed',
                'nomor_telepon' => 'unique:tb_user_eyajamana,nomor_telepon|numeric|digits_between:11,15',
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
                User::create([
                    'id_penduduk' => $request->id_penduduk,
                    'email'=> $request->email,
                    'password'=> Hash::make($request->password),
                    'nomor_telepon'=> $request->nomor_telepon,
                    'user_profile'=> 'app/default/profile/user.jpg',
                    'lat'=> $request->lat ,
                    'lng'=> $request->lng ,
                ])->Role()->attach([2]);

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
                'title' => 'Berhasil Membuat Akun Krama Bali',
                'message' => 'Berhasil membuat akun Krama Bali, anda dapat Login untuk masuk ke sistem E-Yajamana',
            ]);
        // END LOGIC

    }
    // KRAMA STORE AKUN NEW INTEGERATION

    // PEMANGKU STORE AKUN NEW INTEGERATION
    public function storeRegisPemangku(Request $request)
    {
        // SECURITY
            // VALIDASI DEFAULT
            $rules = [
                'nama_pemuput' => 'required|regex:/^[a-z,. 0-9, -]+$/i|min:5|max:50',
            ];
            $message = [
                'nama_pemuput.required' => "Nama Sulinggih wajib diisi",
                'nama_pemuput.regex' => "Format Nama Sulinggih tidak sesuai",
                'nama_pemuput.min' => "Nama Sulinggih minimal berjumlah 5 karakter",
                'nama_pemuput.max' => "Nama Sulinggih maksimal berjumlah 50 karakter",
            ];
            // VALIDASI DEFAULT

            // USER CHECK
            if($request->id_user != null && $request->id_user != ""){
                $rules += [
                    'id_user' => 'required|unique:tb_pemuput_karya,id_user',
                ];
                $message += [
                    'id_user.required' => "ID User wajib diisi",
                    'id_user.unique' => "ID User tidak boleh sama",
                ];
            }else{
                $rules += [
                    'id_penduduk' => 'required|unique:tb_user_eyajamana,id_penduduk',
                    'email' => 'required|email|unique:tb_user_eyajamana,email|min:5|max:100',
                    'password' => 'required|confirmed',
                    'nomor_telepon' => 'unique:tb_user_eyajamana,nomor_telepon|numeric|digits_between:11,15',
                ];
                $message += [
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
                ];
            }
            // USER CHECK

            // PEMUPUT CHECK
            if($request->id_pasangan != 0 && $request->id_pasangan != ""){
                $rules += [
                    'id_pasangan' => 'required|exists:tb_pemuput_karya,id',
                ];
                $message += [
                    'id_pasangan.required' => "ID Pasangan wajib diisi",
                    'id_pasangan.exists' => "ID Pasangan tidak sesuai",
                ];
            }else{
                $rules += [
                    'tanggal_diksha' => 'required|date',
                ];
                if($request->nama_griya != null && $request->nama_griya != ""){
                    $rules += [
                        'nama_griya' => "required|regex:/^[a-z ,.'-]+$/i|min:3|max:50",
                        'alamat_griya' => "required|regex:/^[a-z,. 0-9]+$/i|min:3|max:100",
                        'kabupaten' => 'required|exists:tb_m_kabupaten,id',
                        'id_banjar_dinas' => 'required|exists:tb_m_banjar_dinas,id',
                        'lat' => 'required|numeric|regex:/^[0-9.-]+$/i',
                        'lng' => 'required|numeric|regex:/^[0-9.-]+$/i',
                    ];
                }
            }
            $validator = Validator::make($request->all(),$rules,$message);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Registrasi',
                    'message' => 'Gagal melakukan registrasi akun, silakan periksa kembali form input anda..!!'
                ])->withInput($request->all())->withErrors($validator->errors());
            }
        // END SECURITY

        // MAIN LOGIC
        try{
            DB::beginTransaction();
            if($request->id_user != null && $request->id_user != ""){
                $user = User::findOrFail($request->id_user);
                $role = 3;
            }else{
                $user = User::create([
                    'id_penduduk' => $request->id_penduduk,
                    'email'=> $request->email,
                    'password'=> Hash::make($request->password),
                    'nomor_telepon'=> $request->nomor_telepon,
                    'user_profile'=> 'app/default/profile/user.jpg',
                ]);
                $role = [2,3];
            }
            $user->Role()->attach($role);

            // PEMUPUT CREATE
            if($request->id_pasangan != 0 && $request->id_pasangan != ""){
                $pasangan = PemuputKarya::findOrFail($request->id_pasangan);
                $newPemuput = PemuputKarya::create([
                    'id_user' => $user->id,
                    'id_griya' => $pasangan->id_griya,
                    'id_pasangan' => $pasangan->id,
                    'id_atribut' => $pasangan->id_atribut,
                    'nama_pemuput' => $request->nama_pemuput,
                    'status_konfirmasi_akun' => 'pending',
                    'tipe' => 'pemangku',
                ]);
                $pasangan->update(['id_pasangan' => $newPemuput->id]);
            }else{
                if($request->nama_griya != null && $request->nama_griya != ""){
                    $griya = GriyaRumah::create([
                        'nama_griya_rumah'=> $request->nama_griya,
                        'alamat_griya_rumah'=> $request->alamat_griya,
                        'id_banjar_dinas'=> $request->id_banjar_dinas,
                        'lat'=> $request->lat,
                        'lng'=> $request->lng,
                    ]);
                    $idGriya = $griya->id;
                }else{
                    $idGriya = $request->id_griya;
                }
                $idPasangan = null;

                $tanggalDiksha = DateRangeHelper::defaultSingleDate($request->tanggal_diksha);
                AtributPemuput::create([
                    'tanggal_diksha' => $tanggalDiksha,
                ])->PemuputKarya()->create([
                    'id_user' => $user->id,
                    'id_griya' => $idGriya,
                    'id_pasangan' => $idPasangan,
                    'nama_pemuput' => $request->nama_pemuput,
                    'status_konfirmasi_akun' => 'pending',
                    'tipe' => 'pemangku',
                ]);
            }
            DB::commit();
        }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
            DB::rollBack();
            return redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Gagal Menambahkan Data Akun',
                'message' => 'Gagal menambahkan data akun, apabila diperlukan mohon hubungi developer sistem`',
            ]);
        }
        // MAIN LOGIC

        //  RETURN
            return redirect()->route('auth.login')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Membuat Akun Pemangku',
                'message' => 'Berhasil membuat akun Pemangku, mohon tunggu proses email verifikasi telebih dahulu untuk menggunakan akun',
            ]);
        // END LOGIC
    }
    // PEMANGKU STORE AKUN NEW INTEGERATION

    // SERATI STORE AKUN NEW INTEGERATION
    public function storeRegisSerati(Request $request)
    {
        // SECURITY
            // VALIDASI DEFAULT
            $rules = [
                'nama_pemuput' => 'required|regex:/^[a-z,. 0-9, -]+$/i|min:5|max:50',
            ];
            $message = [
                'nama_pemuput.required' => "Nama Sulinggih wajib diisi",
                'nama_pemuput.regex' => "Format Nama Sulinggih tidak sesuai",
                'nama_pemuput.min' => "Nama Sulinggih minimal berjumlah 5 karakter",
                'nama_pemuput.max' => "Nama Sulinggih maksimal berjumlah 50 karakter",
            ];
            // VALIDASI DEFAULT

            // USER CHECK
            if($request->id_user != null && $request->id_user != ""){
                $rules += [
                    'id_user' => 'required|unique:tb_serati,id_user',
                ];
                $message += [
                    'id_user.required' => "ID User wajib diisi",
                    'id_user.unique' => "ID User tidak boleh sama",
                ];
            }else{
                $rules += [
                    'id_penduduk' => 'required|unique:tb_user_eyajamana,id_penduduk',
                    'email' => 'required|email|unique:tb_user_eyajamana,email|min:5|max:100',
                    'password' => 'required|confirmed',
                    'nomor_telepon' => 'unique:tb_user_eyajamana,nomor_telepon|numeric|digits_between:11,15',
                ];
                $message += [
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
                ];
            }
            // USER CHECK

            $validator = Validator::make($request->all(),$rules,$message);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Registrasi',
                    'message' => 'Gagal melakukan registrasi akun, silakan periksa kembali form input anda..!!'
                ])->withInput($request->all())->withErrors($validator->errors());
            }
        // END SECURITY

        // MAIN LOGIC
        try{
            DB::beginTransaction();
            if($request->id_user != null && $request->id_user != ""){
                $user = User::findOrFail($request->id_user);
                $role = 5;
            }else{
                $user = User::create([
                    'id_penduduk' => $request->id_penduduk,
                    'email'=> $request->email,
                    'password'=> Hash::make($request->password),
                    'nomor_telepon'=> $request->nomor_telepon,
                    'user_profile'=> 'app/default/profile/user.jpg',
                ]);
                $role = [2,5];
            }
            $user->Role()->attach($role);
            Serati::create([
                'id_user'=>$user->id,
                'nama_serati'=>$request->nama_pemuput,
                'status_konfirmasi_akun'=>'pending',
            ]);
            DB::commit();
        }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
            DB::rollBack();
            return redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Gagal Menambahkan Data Akun',
                'message' => 'Gagal menambahkan data akun, apabila diperlukan mohon hubungi developer sistem`',
            ]);
        }
        // MAIN LOGIC

        //  RETURN
            return redirect()->route('auth.login')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Membuat Akun Serati',
                'message' => 'Berhasil membuat akun Serati, mohon tunggu proses email verifikasi telebih dahulu untuk menggunakan akun',
            ]);
        // END LOGIC


    }
    // SERATI STORE AKUN NEW INTEGERATION



}
