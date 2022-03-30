<?php

namespace App\Http\Controllers\web\pemuput_karya\muput_upacara;

use App\Http\Controllers\Controller;
use App\Models\Upacaraku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PDOException;
use App\Models\DetailReservasi;
use App\Models\KeteranganKonfirmasi;
use App\Models\Reservasi;
use App\DateRangeHelper;
use App\Models\User;
use ErrorException;
use Illuminate\Support\Facades\DB;
use Mavinoo\Batch\BatchFacade;
use NotificationHelper;
use Psy\Exception\ErrorException as ExceptionErrorException;

class KonfirmasiTangkilController extends Controller
{

    // INDEX VIEW MUPUT
    public function indexKonfirmasiTangkil(Request $request)
    {
        try{
            $dataReservasi = Reservasi::with(['DetailReservasi','Upacaraku.User.Penduduk'])->whereHas('DetailReservasi');
            $queryDetailReservasi = function ($queryDetailReservasi){
                $queryDetailReservasi->where('status','diterima');
            };
            $dataReservasi->with(['DetailReservasi'=>$queryDetailReservasi])->whereHas('DetailReservasi',$queryDetailReservasi);
            $dataReservasi = $dataReservasi->whereIdRelasiAndStatus(Auth::user()->id,'proses tangkil')->orderBy('tanggal_tangkil','asc')->get();
        }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
            return \redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Internal server error  !',
                'message' => 'Internal server error , mohon untuk menghubungi developer sistem !',
            ]);
        }
        // RETURN
            return view('pages.pemuput-karya.manajemen-muput-upacara.konfirmasi-tangkil-index',compact('dataReservasi'));
        // END RETURN
    }
    // INDEX VIEW MUPUT

    // DETAIL KONFIRMASI TANGKIL
    public function detailKonfirmasiTangkil(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_reservasi,id',
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Reservasi Tidak Ditemukan !',
                    'message' => 'Reservasi tidak ditemukan, pilihlah data dengan benar !',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                $dataReservasi = Reservasi::with(['Upacaraku.User.Penduduk','DetailReservasi.TahapanUpacara'])->whereHas('DetailReservasi')->whereStatus('proses tangkil')->findOrFail($request->id);
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                return \redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Internal server error  !',
                    'message' => 'Reservasi tidak ditemukan , mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END LOGIC

        // RETRUN
            return view('pages.pemuput-karya.manajemen-muput-upacara.konfirmasi-tangkil-detail',compact('dataReservasi'));
        // END RETRUN

    }
    // DETAIL KONFIRMASI TANGKIL

    // EDIT KONFIRMASI TANGKIL
    public function editKonfirmasiTangkil(Request $request)
    {
        // SECURITY
            $validator = Validator::make(['id' =>$request->id],[
                'id' => 'required|exists:tb_reservasi,id',
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Reservasi Tidak Ditemukan !',
                    'message' => 'Reservasi tidak ditemukan, pilihlah data dengan benar !',
                ]);
            }
        // END SECURITY

        // MAIN LOGIC
            try{
                $idUser = Auth::user()->id;
                $dataReservasi = Reservasi::with(['DetailReservasi.TahapanUpacara','Upacaraku.Krama.User.Penduduk'])->whereHas('DetailReservasi.TahapanUpacara')->whereHas('Upacaraku.Krama.User.Penduduk')->whereIdRelasiAndStatus($idUser,'proses tangkil')->findOrFail($request->id);
                $dataUpacara = Reservasi::with(['Relasi','DetailReservasi.TahapanUpacara'])->whereIdUpacaraku($dataReservasi->id_upacaraku)->whereNotIn('id',[$request->id])->get();
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                return \redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Reservasi Tidak ditemukan!',
                    'message' => 'Data Reservasi Tidak ditemukan , mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END LOGIC

        // RETURN
            return view('pages.pemuput-karya.manajemen-muput-upacara.konfirmasi-tangkil-edit',compact(['dataReservasi','dataUpacara']));
        // END RETURN
    }
    // EDIT KONFIRMASI TANGKIL

    // UPDATE KONFIRMASI TANGIL
    public function updateKonfirmasiTangkil(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'id_reservasi' =>'required|exists:tb_reservasi,id',
                'data_upacara' => "required|array|min:1",
                "data_upacara.*"  => "required",
                'data_user_reservasi' =>'required|array',
                "data_user_reservasi.*"  => "required",
            ],
            [
                'id_reservasi.required' => "ID Reservasi wajib diisi",
                'id_reservasi.exists' => "ID Reservasi tidak sesuai",
                'data_upacara.required' => "Data Upacara wajib diisi",
                'data_upacara.array' => "Data Upacara tidak lengkap",
                'data_user_reservasi.required' => "Data Reservasi wajib diisi",
                'data_user_reservasi.array' => "Data Reservasi tidak lengkap",
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal memperbarui status!',
                    'message' => 'Gagal memperbarui status, silakan periksa kembali form input anda!'
                ])->withInput($request->all())->withErrors($validator->errors());
            }
        // END

        // MAIN LOGIC
            try{
                $idSulinggih =Auth::user()->id;
                list($start,$end) = DateRangeHelper::parseDateRange($request->data_upacara[0]['daterange']);
                Upacaraku::findOrFail($request->data_upacara[0]['id'])->update([
                    'nama_upacara'=>$request->data_upacara[0]['nama_upacara'],
                    'deskripsi_upacaraku'=>$request->data_upacara[0]['deskripsi_upacara'],
                    'tanggal_mulai'=>$start,
                    'tanggal_selesai'=>$end,
                    'status' => 'berlangsung'
                ]);
                Reservasi::whereIdUpacarakuAndIdRelasi($request->data_upacara[0]['id'], $idSulinggih)->findOrFail($request->id_reservasi)->update([
                    'status' => 'proses muput'
                ]);
                foreach($request->data_user_reservasi as $data)
                {
                    list($start,$end) = DateRangeHelper::parseDateRangeTime($data['daterange']);
                    DetailReservasi::findOrFail($data['id'])->update([
                        'tanggal_mulai' => $start,
                        'tanggal_selesai' => $end,
                        'keterangan' =>$data['keterangan'],
                        'status' => $data['status']
                    ]);
                }

                if($request->id_detail_reservasi != null){
                    $dataKeterangan = [];
                    foreach($request->id_detail_reservasi as $index => $data){
                        $detailReservasi = DetailReservasi::findOrFail($data);
                        // if($detailReservasi->Reservasi->status == 'proses tangkil'){
                        //     Reservasi::findOrFail($detailReservasi->Reservasi->id)->update(['status'=>'pending']);
                        // }
                        Reservasi::findOrFail($detailReservasi->Reservasi->id)->update(['status'=>'pending']);
                        list($start,$end) = DateRangeHelper::parseDateRangeTime($request->daterange[$index]);
                        $detailReservasi->update([
                            'status' => 'pending',
                            'tanggal_mulai' => $start,
                            'tanggal_selesai' => $end
                        ]);
                        $detailReservasi->KeteranganKonfirmasi()->create([
                            'id_relasi'=> $idSulinggih,
                            'keterangan'=> $request->alasan_penolakan_sulinggih[$index]
                        ]);
                    }

                }
            }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
                return \redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Data Reservasi Tidak ditemukan!',
                    'message' => 'Data Reservasi Tidak ditemukan , mohon untuk menghubungi developer sistem !',
                ]);
            }
        // END LOGIC

        // RETURN
            return redirect()->route('pemuput-karya.muput-upacara.konfirmasi-tangkil.index')->with([
                'status' => 'success',
                'icon' => 'success',
                'title' => 'Berhasil meperbarui status!',
                'message' => 'Data konfirmasi tanggkil berhasil diperbarui, anda dapat melihat pembaruan data pada sistem',
            ]);
        //END

    }
    // UPDATE KONFIRMASI TANGIL

    // UPDATE DATA TANGKIL
    public function updateData(Request $request)
    {
        // SECURITY
            $validator = Validator::make($request->all(),[
                'id_reservasi' => 'required|exists:tb_reservasi,id',
                'id_tahapan' => 'required|exists:tb_detail_reservasi,id',
                'status' => 'required',
            ]);

            if($validator->fails()){
                return redirect()->back()->with([
                    'status' => 'fail',
                    'icon' => 'error',
                    'title' => 'Gagal Memperbarui Status',
                    'message' => 'Gagal memperbarui status ke sistem, Cek kembali alasan penolakan anda!'
                ]);
            }
        // END SECURITY

        // MAIN LOGIC
        try{
            DB::beginTransaction();
            $reservasi = Reservasi::findOrFail($request->id_reservasi);

            $user = Auth::user();
            $relasi = User::findOrFail($reservasi->id_relasi);

            $ditolak = 0;
            $tanggal_tangkil = null;
            foreach ($request->status as $value) {
                if ($value == 'diterima') {
                    $statusReservasi = 'proses tangkil';
                    $tanggal_tangkil = DateRangeHelper::parseSingleDate($request->tanggal_tangkil);
                    break;
                }
                if ($value == 'ditolak') {
                    $ditolak += 1;
                    if ($ditolak == count($request->status)) {
                        $statusReservasi = 'ditolak';
                        break;
                    }
                }
                if ($value == 'pending') {
                    $statusReservasi = 'pending';
                }else{
                    $statusReservasi = 'batal';
                }
            }

            $dataDetailReservasi = [];
            foreach ($request->id_tahapan as $key => $value) {
                $dataDetailReservasi[] = [
                    'id' => $value,
                    'status' => $request->status[$key],
                    'keterangan' => $request->alasan_penolakan[$key],
                ];
            }
            BatchFacade::update(new DetailReservasi(), $dataDetailReservasi, 'id');

            $reservasi->update([
                'tanggal_tangkil' => $tanggal_tangkil,
                'status' => $statusReservasi,
                'keterangan' => $request->alasan_penolakan[0],
            ]);

            switch($statusReservasi){
                case 'proses tangkil':
                    $title = "PERUBAHAN RESERVASI";
                    $messagePemuput = "Perubahan Reservasi ID : ".$request->id_reservasi." berhasil dilakukan!,harap dicek kembali data Reservasi Anda!";
                    $messageKrama = "Halo Krama Bali ! Reservasi anda dengan ID : ".$request->id_reservasi." terdapat perubahan data status penerimaan atau tanggal tangkil, mohon dicek kembali Reservasi kalian ya, jangan sampai kelewatan!.";
                    break;
                case 'ditolak':
                    $title = "PEMBATALAN RESERVASI";
                    $messagePemuput = "Pembatalan Reservasi dengan ID : ".$request->id_reservasi." berhasil dilakukan. anda dapat melihat semua data Reservasi menu Riwayat Reservasi";
                    $messageKrama = "Halo Krama Bali ! ".$user->PemuputKarya->nama_pemuput. "  membatalkan Reservasi anda dengan ID : ".$request->id_reservasi." demgan alasan ".$request->alasan_penolakan[0].", mohon untuk mencari pemuput karya lainnya";
                    break;
                case 'pending':
                    $title = "PERUBAHAN RESERVASI";
                    $messagePemuput = "Berhasil mengubah Reservasi. Mohon untuk segera mengkonfirmasi Reservasi Masuk Anda kembal!";
                    $messageKrama = "Halo Krama Bali ! ".$user->PemuputKarya->nama_pemuput. "  mengubah Reservasi anda dengan ID : ".$request->id_reservasi.", dimohon untuk menunggu konfirmasi kembali dari pihak Pemuput Karya!";
                    break;
                default:
            }

            // NOTIFICATION
            NotificationHelper::sendNotification(
                [
                    'title' => $title,
                    'body' => $messagePemuput,
                    'status' => "new",
                    'image' => "normal",
                    'notifiable_id' => $user->id,
                    'formated_created_at' => date('Y-m-d H:i:s'),
                    'formated_updated_at' => date('Y-m-d H:i:s'),
                ],
                $user
            );
            NotificationHelper::sendNotification(
                [
                    'title' => $title,
                    'body' => $messageKrama,
                    'status' => "new",
                    'image' => "sulinggih",
                    'notifiable_id' => $relasi->id,
                    'formated_created_at' => date('Y-m-d H:i:s'),
                    'formated_updated_at' => date('Y-m-d H:i:s'),
                ],
                $relasi
            );
            // NOTIFICATION
            DB::commit();
        }catch(ModelNotFoundException | PDOException | QueryException | \Throwable | \Exception $err){
            DB::rollBack();
            return redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Gagal Memperbarui Status',
                'message' => 'Gagal memperbarui status ke sistem, Hubungi Developer untuk lebih lanjut'
            ]);
        }
        // END MAIN LOGIC

        // RETURN
        return redirect()->route('pemuput-karya.muput-upacara.konfirmasi-tangkil.index')->with([
            'status' => 'success',
            'icon' => 'success',
            'title' => 'Berhasil Memperbarui Status Reservasi',
            'message' => 'Berhasil Memperbarui Status Reservasi, Data terbaru dapat dilihat pada menu data muput upacara',
        ]);
        // END RETURN



    }
    // UPDATE DATA TANGKIL


}
