<?php

namespace App\Console\Commands;

use App\Models\Reservasi;
use Carbon\Carbon;
use Illuminate\Console\Command;
use NotificationHelper;

class reminderTangkil extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:tangkil';

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
        $dataReservasi = Reservasi::with('Sanggar','Relasi.PemuputKarya.GriyaRumah','Upacaraku.User')
            ->whereStatus('proses tangkil')
            ->whereNotNull('tanggal_tangkil')->get();
        foreach($dataReservasi as $data){
            if(Carbon::parse($data->tanggal_tangkil)->subDays(1)->format('d m Y') == Carbon::now()->startOfDay()->format('d m Y')){
                $title ="REMINDER H-1 TANGKIL";
                if($data->tipe == "pemuput_karya"){
                    $pemuput = $data->Relasi;
                    $body = "Hallo, Pengingat bahwa besok terdapat Krama akan Tangkil Ke Griya ".$data->Relasi->PemuputKarya->GriyaRumah->nama_griya_rumah;
                    $bodyKrama = "Hallo Krama, Pengingat bahwa besok terdapat jadwal Tangkil ke ".$data->Relasi->PemuputKarya->GriyaRumah->nama_griya_rumah;
                    $type = "pemuput_karya";
                }else{
                    $pemuput = $data->Sanggar->User[0];
                    $body = "Hallo, Pengingat bahwa besok terdapat Krama akan membawa Penguleman lokasi Sanggar";
                    $bodyKrama = "Hallo Krama, Pengingat bahwa besok terdapat jadwal Penguleman ke Sanggar ".$data->Sanggar->nama_sanggar;
                    $type = "sanggar";
                }

                NotificationHelper::sendNotification(
                    [
                        'title' => $title,
                        'body' => $bodyKrama,
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
                        'title' => $title,
                        'body' =>$body,
                        'status' => "new",
                        'image' => "krama",
                        'type' =>  $type,
                        'notifiable_id' => $data->Upacaraku->User->id,
                        'formated_created_at' => date('Y-m-d H:i:s'),
                        'formated_updated_at' => date('Y-m-d H:i:s'),
                    ],
                    $pemuput
                );
            }
        }
        info('Behasil Mengingatkan Tangkil');

    }
}
