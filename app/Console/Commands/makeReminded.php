<?php

namespace App\Console\Commands;

use App\Models\DetailReservasi;
use App\Models\Reservasi;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Mavinoo\Batch\BatchFacade;

class makeReminded extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:reminder';

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

        $queryDetailReservasi = function($queryDetailReservasi){
            $queryDetailReservasi->where('status','diterima');
        };


        $reservasis = Reservasi::with(['DetailReservasi'=>$queryDetailReservasi])
            ->whereHas('DetailReservasi',$queryDetailReservasi)
            ->whereStatus('proses muput')
            ->get();

        $IsReminded = [];
        foreach ($reservasis as $reservasi) {
            foreach($reservasi->DetailReservasi as $detailReservasi){
                $IsReminded[] = [
                    'id' => $detailReservasi->id,
                    'reminded' =>Carbon::parse($detailReservasi->tanggal_mulai)->subDays(1)->format('Y-m-d')
                ];
            }
        }
        BatchFacade::update(new DetailReservasi(), $IsReminded, 'id');
    }
}
