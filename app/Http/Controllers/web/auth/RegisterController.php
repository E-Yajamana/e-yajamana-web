<?php

namespace App\Http\Controllers\web\auth;

use App\Http\Controllers\Controller;
use App\Models\DesaAdat;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
                $dataKabupaten = Kabupaten::where('id_provinsi',51)->get();
                $dataDesaAdat = DesaAdat::all();
                return view('pages.auth.register.krama-bali',compact(['dataKabupaten','dataDesaAdat']));
            }elseif($request->akun == 'sulinggih')
            {
                dd('sulinggih');
            }

        // END LOGIC

    }

    public function regisKrama(Request $request)
    {
        dd($request->all());
    }


}
