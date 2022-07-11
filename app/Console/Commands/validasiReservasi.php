<?php

namespace App\Console\Commands;

use App\Models\DetailReservasi;
use App\Models\Reservasi;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use NotificationHelper;

class validasiReservasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'validasi:reservasi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $query = function ($query){
            $query->with(['User.Penduduk'])->where('tanggal_mulai','<=',Carbon::now()->startOfDay());
        };
        $data = Reservasi::query()->with(['DetailReservasi','Relasi.PemuputKarya','Sanggar.User','Upacaraku'=>$query])
            ->whereHas('Upacaraku',$query)
            ->where('status','pending');
        $dataKrama = $data->get();
        $data->update([
            'status'=>'batal',
            'keterangan' => 'Pemuput Karya atau Sanggar tidak menganggapi reservasi!'
        ]);
        $idDetailReservasi = collect([]);

        foreach($dataKrama as $data){
            $idDetailReservasi->push($data->DetailReservasi()->pluck('id'));
            if($data->Relasi != null){
                $pemuput = $data->Relasi;
                $body = "Reservasi Anda pada ".$pemuput->PemuputKarya->nama_pemuput." telah otomatis dibatalkan, karena Pemuput tidak menanggapi reservasi anda";
                $type = 'pemuput_karya';
            }else{
                $pemuput = $data->Sanggar->User[0];
                $type = 'sanggar';
                $body = "Reservasi Anda pada ".$data->Sanggar->nama_sanggar." telah otomatis dibatalkan, karena Sanggar tidak menanggapi reservasi anda";
            }

            NotificationHelper::sendNotification(
                [
                    'title' => "BATAL RESERVASI",
                    'body' =>$body,
                    'status' => "new",
                    'image' => "krama",
                    'type' => "krama",
                    'notifiable_id' => $data->Upacaraku->User->id,
                    'formated_created_at' => date('Y-m-d H:i:s'),
                    'formated_updated_at' => date('Y-m-d H:i:s'),
                ],
                $data->Upacaraku->User
            );

            NotificationHelper::sendNotification(
                [
                    'title' => "BATAL RESERVASI",
                    'body' =>"Reservasi yang diajukan oleh ".$data->Upacaraku->User->Penduduk->nama." telah dibatalakan secara otomatis, karena sudah melewati batas konfirmasi!!",
                    'status' => "new",
                    'image' => "krama",
                    'type' => $type,
                    'notifiable_id' => $pemuput->id,
                    'formated_created_at' => date('Y-m-d H:i:s'),
                    'formated_updated_at' => date('Y-m-d H:i:s'),
                ],
                $pemuput
            );
        }
        $detailReservasi = collect(Arr::collapse($idDetailReservasi));
        DetailReservasi::whereIn('id', $detailReservasi)->update(['status'=>'batal']);
        info('Berhasil Megnupdate Data');

    }
}
