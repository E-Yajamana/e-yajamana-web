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

    public function regisFormAkun(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['akun' =>$request->akun],[
                'akun' => 'required|in:krama,sulinggih,pemangku,sanggar,serati',
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Registrasi',
                    'message' => 'Gagal melakukan registrasi akun, pilihlah jenis user sesuai dengan user yang disediakan!'
                ]);
            }
        // END

        // MAIN LOGIC
            if($request->akun == 'krama')
            {
                $dataKabupaten = Kabupaten::all();
                $dataDesaAdat = DesaAdat::all();
                return view('pages.auth.register.krama-bali',compact(['dataKabupaten','dataDesaAdat']));
            }elseif($request->akun == 'sulinggih')
            {
                dd('sulinggih');
            }

        // END LOGIC

    }

    public function storeRegisKrama(Request $request)
    {

        dd($request->all());
        // SECURITY
            $validator = Validator::make($request->all(),[
                'email' => 'required',
                'nomor_telepon' => 'required',
                'nama' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'password' => 'required',
                'password_confirmation' => 'required',
                'desa_dinas' => 'required',
                'desa_adat' => 'required',
                'alamat' => 'required',
                'lat' => 'required',
                'lng' => 'required',
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
                ])->Krama()->save([
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


    }


}
