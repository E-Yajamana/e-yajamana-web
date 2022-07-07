<?php

namespace App\Console\Commands;

use App\Models\DetailReservasi;
use Carbon\Carbon;
use Illuminate\Console\Command;
use NotificationHelper;

class reminderMuput extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:muput';

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
        $from = Carbon::now()->startOfDay();
        $to = Carbon::now()->startOfDay()->addHours(23);

        $DetailReservasis = DetailReservasi::with(['Reservasi.Upacaraku.User','TahapanUpacara','Reservasi.Sanggar','Reservasi.Relasi.PemuputKarya.GriyaRumah'])
            ->whereNotNull('reminded')
            ->whereBetween('reminded',[$from,$to])
            ->get();

        foreach($DetailReservasis as $detailreservasi){
            $title ="REMINDER H-1 MUPUT UPACARA";
            if($detailreservasi->Reservasi->tipe == 'pemuput_karya'){
                $pemuput = $detailreservasi->Reservasi->Relasi;
                $bodyKrama = "Hallo Krama, mengingatkan kembali bahwa besok terdapat jadwal muput upacara pada tahapan ".$detailreservasi->TahapanUpacara->nama_tahapan." oleh ".$pemuput->nama_pemuput;
            }else{
                $pemuput = $detailreservasi->Reservasi->Sanggar->User[0];
                $bodyKrama = "Hallo Krama, mengingatkan kembali bahwa besok terdapat jadwal muput upacara pada tahapan ".$detailreservasi->TahapanUpacara->nama_tahapan." oleh ".$pemuput->nama_sanggar;
            }
            $body = "Hallo, mengingatkan kembali bahwa besok terdapat jadwal muput upacara pada tahapan ".$detailreservasi->TahapanUpacara->nama_tahapan;

            NotificationHelper::sendNotification(
                [
                    'title' => $title,
                    'body' => $bodyKrama,
                    'status' => "new",
                    'image' => "krama",
                    'type' => "krama",
                    'notifiable_id' => $detailreservasi->Reservasi->Upacaraku->User->id,
                    'formated_created_at' => date('Y-m-d H:i:s'),
                    'formated_updated_at' => date('Y-m-d H:i:s'),
                ],
                $detailreservasi->Reservasi->Upacaraku->User
            );

            NotificationHelper::sendNotification(
                [
                    'title' => $title,
                    'body' =>$body,
                    'status' => "new",
                    'image' => "krama",
                    'type' => "krama",
                    'notifiable_id' => $pemuput->id,
                    'formated_created_at' => date('Y-m-d H:i:s'),
                    'formated_updated_at' => date('Y-m-d H:i:s'),
                ],
                $pemuput
            );
        }
    }
}
