<?php

namespace App\Http\Controllers\web\krama\upacaraku;

use App\DateRangeHelper;
use App\Http\Controllers\Controller;
use App\Models\BanjarDinas;
use App\Models\DesaAdat;
use App\Models\DesaDinas;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Upacaraku;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PDOException;
use PhpParser\Node\Expr\FuncCall;
use Prophecy\Call\Call;
class KramaUpacarakuController extends Controller
{
    // INDEX UPACARAKU
    public function indexUpacaraku(Request $request)
    {
        $dataUpacaraku = Upacaraku::with(['Upacara','Reservasi'])->where('id_krama',Auth::user()->Krama->id)->get();
        return view('pages.krama.manajemen-upacara.upacaraku-index', compact('dataUpacaraku'));
    }
    // INDEX UPACARAKU

    // CREATE UPACARAKU
    public function createUpacaraku(Request $request)
    {
        $dataKabupaten = Kabupaten::whereProvinsiId(51)->get();
        return view('pages.krama.manajemen-upacara.upacaraku-create',compact(['dataKabupaten']));
    }
    // CREATE UPACARAKU

    // STORE UPACARAKU
    public function storeUpacaraku(Request $request)
    {

        // SECURITY
            $validator = Validator::make($request->all(),[
                'id_upacara' => 'required|exists:tb_upacara,id',
                'id_banjar_dinas' => 'required|exists:tb_m_banjar_dinas,id',
                'daterange' => 'required',
                'nama_upacara' => 'required|regex:/^[a-z,. 0-9]+$/i|min:3|max:100',
                'lokasi' => 'required|regex:/^[a-z,. 0-9]+$/i|min:3|max:100',
                'deskripsi_upacara' => 'required|regex:/^[a-z,. 0-9]+$/i|min:3|max:100',
                'lat' => 'required|numeric|regex:/^[0-9.-]+$/i',
                'lng' => 'required|numeric|regex:/^[0-9.-]+$/i',
            ],
            [
                'id_upacara.required' => "Jenis Upacara wajib diisi",
                'id_upacara.exists' => "Jenis Upacara tidak sesuai",
                'id_banjar_dinas.required' => "Banjar Dinas wajib diisi",
                'id_banjar_dinas.exists' => "Banjar Dinas tidak sesuai",
                'nama_upacara.required' => "Nama Upacara wajib diisi",
                'nama_upacara.regex' => "Format Nama Upacara tidak sesuai",
                'nama_upacara.min' => "Nama Upacara minimal berjumlah 3 karakter",
                'nama_upacara.max' => "Nama Upacara maksimal berjumlah 100 karakter",
                'lokasi.required' => "Alamat Lengkap Upacara Lengkap wajib diisi",
                'lokasi.regex' => "Format Alamat Lengkap Upacara Lengkap tidak sesuai",
                'lokasi.min' => "Alamat Lengkap Upacara Lengkap minimal berjumlah 3 karakter",
                'lokasi.max' => "Alamat Lengkap Upacara Lengkap maksimal berjumlah 100 karakter",
                'daterange.required' => "Tanggal Mulai - Selesai wajib diisi",
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
                    'title' => 'Gagal Menambahkan Data Upacaraku',
                    'message' => 'Gagal Menambahkan Data Upacaraku, silakan periksa kembali form input anda!'
                ])->withInput($request->all())->withErrors($validator->errors());
            }
        // END

        // MAIN LOGIC
             try{
                DB::beginTransaction();
                list($start,$end) = DateRangeHelper::parseDateRange($request->daterange);
                Upacaraku::create([
                    'id_upacara'=>$request->id_upacara,
                    'id_krama'=>Auth::user()->Krama->id,
                    'id_banjar_dinas'=>$request->id_banjar_dinas,
                    'nama_upacara'=>$request->nama_upacara,
                    'alamat_upacaraku'=>$request->lokasi,
                    'tanggal_mulai'=>$start,
                    'tanggal_selesai'=>$end,
                    'deskripsi_upacaraku'=>$request->deskripsi_upacara,
                    'status'=> 'pending',
                    'lat'=>$request->lat,
                    'lng'=>$request->lng,
                ]);
                DB::commit();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                DB::rollBack();
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Menambahkan Data Upacara',
                    'message' => $err,
                ]);
            }
        // END LOGIC

        //RETURN
            return redirect()->route('krama.manajemen-upacara.upacaraku.index')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Menambhakan Upacara   ',
                'message' => 'Upacara berhasil dibuat,anda dapat mereservais pemuput upacara pada upacara anda!',
            ]);
        //END
    }
    // STORE UPACARAKU

    // DETAIL UPACARAKU
    public function detailUpacaraku(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_upacaraku,id',
            ]);

            if($validator->fails()){
                return redirect()->route('krama.manajemen-upacara.upacaraku.index')->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Upacara Tidak Ditemukan !',
                    'message' => 'Data Upacara tidak ditemukan, pilihlah data dengan benar !',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                $dataUpacaraku = Upacaraku::with(['Upacara','Reservasi' => function ($query){
                    $query->with(['Relasi.Sulinggih','Relasi.Sanggar','DetailReservasi.TahapanUpacara']);
                },'BanjarDinas'])->whereIdKrama(Auth::user()->Krama->id)->findOrFail($request->id);
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return \redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Sistem Gagal Menemukan Data Upacaraku !',
                    'message' => 'sistem gagal menemukan Data Upacaraku, mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END MAIN LOGIC

        // RETURN
            return view('pages.krama.manajemen-upacara.upacaraku-detail',compact('dataUpacaraku'));
        // RETURN

    }
    // DETAIL UPACARAKU

    // EDIT UPACARAKU
    public function editUpacaraku(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_upacaraku,id',
            ]);

            if($validator->fails()){
                return redirect()->route('krama.manajemen-upacara.upacaraku.index')->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Upacara Tidak Ditemukan !',
                    'message' => 'Data Upacara tidak ditemukan, pilihlah data dengan benar !',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                $dataUpacaraku = Upacaraku::with('Upacara')->withCount(['Reservasi'=>function ($query) {
                    $query->whereIn('status', ['proses muput','selesai']);
                }])->whereIdKrama(Auth::user()->Krama->id)->findOrFail($request->id);
                $dataKabupaten = Kabupaten::where('provinsi_id',51)->get();
                $dataKecamatan = Kecamatan::all();
                $dataDesa = DesaDinas::all();
                $dataBanjarDinas = BanjarDinas::all();
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return \redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Sistem Gagal Menemukan Data Upacara !',
                    'message' => 'sistem gagal menemukan Data Upacara, mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END MAIN LOGIC

        // RETURN
            return view('pages.krama.manajemen-upacara.upacaraku-edit',compact('dataKabupaten','dataUpacaraku','dataKecamatan','dataDesa','dataBanjarDinas'));
        // RETURN
    }
    // EDIT UPACARAKU

    // UPDATE UPACARAKU
    public function updateUpacaraku(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'id_upacaraku' => 'required|exists:tb_upacaraku,id',
                'id_banjar_dinas' => 'required|exists:tb_m_banjar_dinas,id',
                'nama_upacara' => 'required|regex:/^[a-z,. 0-9]+$/i|min:3|max:100',
                'alamat_upacaraku' => 'required|regex:/^[a-z,. 0-9]+$/i|min:3|max:100',
                'deskripsi_upacaraku' => 'required|regex:/^[a-z,. 0-9]+$/i|min:3|max:100',
                'lat' => 'required|numeric|regex:/^[0-9.-]+$/i',
                'lng' => 'required|numeric|regex:/^[0-9.-]+$/i',
            ],
            [
                'id_upacaraku.required' => "Upacaraku wajib diisi",
                'id_upacaraku.required' => "Upacaraku wajib diisi",
                'id_banjar_dinas.required' => "Banjar Dinas wajib diisi",
                'id_banjar_dinas.exists' => "Banjar Dinas tidak sesuai",
                'nama_upacara.required' => "Nama Upacara wajib diisi",
                'nama_upacara.regex' => "Format Nama Upacara tidak sesuai",
                'nama_upacara.min' => "Nama Upacara minimal berjumlah 3 karakter",
                'nama_upacara.max' => "Nama Upacara maksimal berjumlah 100 karakter",
                'alamat_upacaraku.required' => "Alamat Lengkap Upacara Lengkap wajib diisi",
                'alamat_upacaraku.regex' => "Format Alamat Lengkap Upacara Lengkap tidak sesuai",
                'alamat_upacaraku.min' => "Alamat Lengkap Upacara Lengkap minimal berjumlah 3 karakter",
                'alamat_upacaraku.max' => "Alamat Lengkap Upacara Lengkap maksimal berjumlah 100 karakter",
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
                    'title' => 'Gagal Menambahkan Data Upacaraku',
                    'message' => 'Gagal Menambahkan Data Upacaraku, silakan periksa kembali form input anda!'
                ])->withInput($request->all())->withErrors($validator->errors());
            }
        // END

        // MAIN LOGIC
            try{
                if($request->daterange == null || $request->id_upacara == null){
                    DB::beginTransaction();
                    Upacaraku::findOrFail($request->id_upacaraku)->update([
                        'id_krama'=>Auth::user()->Krama->id,
                        'id_banjar_dinas'=>$request->id_banjar_dinas,
                        'nama_upacara'=>$request->nama_upacara,
                        'alamat_upacaraku'=>$request->alamat_upacaraku,
                        'deskripsi_upacaraku'=>$request->deskripsi_upacaraku,
                        'status'=> $request->status,
                        'lat'=>$request->lat,
                        'lng'=>$request->lng,
                    ]);
                    DB::commit();
                }else{
                    DB::beginTransaction();
                    list($start,$end) = DateRangeHelper::parseDateRange($request->daterange);
                    Upacaraku::findOrFail($request->id_upacaraku)->update([
                        'id_upacara'=>$request->id_upacara,
                        'id_krama'=>Auth::user()->Krama->id,
                        'id_banjar_dinas'=>$request->id_banjar_dinas,
                        'nama_upacara'=>$request->nama_upacara,
                        'alamat_upacaraku'=>$request->alamat_upacaraku,
                        'tanggal_mulai'=>$start,
                        'tanggal_selesai'=>$end,
                        'deskripsi_upacaraku'=>$request->deskripsi_upacaraku,
                        'status'=> $request->status,
                        'lat'=>$request->lat,
                        'lng'=>$request->lng,
                    ]);
                    DB::commit();
                }
            }catch(ModelNotFoundException | PDOException | QueryException | ErrorException | \Throwable | \Exception $err){
                return \redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Sistem Gagal Menemukan Data Upacara !',
                    'message' => 'sistem gagal menemukan Data Upacara, mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END MAIN LOGIC

        //RETURN
            return redirect()->back()->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil Mengubah Data Upacara',
                'message' => 'Data Upacara berhasil diubah,anda dapat melihat perubahan pada detail upacara anda!',
            ]);
        //END
    }
    // UPDATE UPACARAKU

    // DELETE UPACARAKU
    public function deleteUpacaraku(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_upacaraku,id',
            ]);

            if($validator->fails()){
                return redirect()->route('krama.manajemen-upacara.upacaraku.index')->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Upacara Tidak Ditemukan !',
                    'message' => 'Data Upacara tidak ditemukan, pilihlah data dengan benar !',
                ]);
            }
        // END SECURITY

        $dataUpacaraku = Upacaraku::with(['Reservasi.DetailReservasi'])->withCount(['Reservasi'=>function($query){
            $query->whereIn('status',['proses muput','selesai']);
        }])->findOrFail($request->id);

        if($dataUpacaraku->reservasi_count == 0){
            $dataUpacaraku->update(['status'=>'batal']);
            $dataUpacaraku->Reservasi()->update(['status'=>'batal']);
            foreach( $dataUpacaraku->Reservasi as $data){
                $data->DetailReservasi()->update(['status'=>'batal']);
            }
        }else{
            return \redirect()->route('krama.manajemen-upacara.upacaraku.index')->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Gagal Mengahapus Data !',
                'message' => 'sistem gagal menghapus data upacara, terdapat reservasi yang Sedang Berlangsung/Selesai pada upacara !',
            ]);
        }

        // RETURN
            return redirect()->route('krama.manajemen-upacara.upacaraku.index')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil menghapus data upacara',
                'message' => 'Data Upacara berhasil dihapus,anda dapat melihat perubahan pada detail upacara anda!',
            ]);
        // END RETURN

    }
    // DELETE UPACARAKU

}
