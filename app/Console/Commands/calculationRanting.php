<?php

namespace App\Console\Commands;

use App\Models\PemuputKarya;
use App\Models\Sanggar;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Mavinoo\Batch\BatchFacade;

class calculationRanting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculation:ranting';

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
        $reservasiPemuput = DB::table('tb_reservasi')
            ->whereNotNull('id_relasi')
            ->whereNotNull('rating')
            ->select(DB::raw("COUNT('id') as total_reservasi"),'id_relasi',DB::raw('SUM(rating) as jumlah'))
            ->groupBy('id_relasi')
            ->get();

        $valPemuput = [];
        foreach ($reservasiPemuput as $data) {
            $valPemuput[] = [
                'id_user' => $data->id_relasi,
                'rating' => $data->jumlah/$data->total_reservasi
            ];
        }
        BatchFacade::update(new PemuputKarya(), $valPemuput, 'id_user');


        $reservasiSanggar = DB::table('tb_reservasi')
            ->whereNotNull('id_sanggar')
            ->whereNotNull('rating')
            ->select(DB::raw("COUNT('id') as total_reservasi"),'id_sanggar',DB::raw('SUM(rating) as jumlah'))
            ->groupBy('id_sanggar')
            ->get();

        $valSanggar= [];
        foreach ($reservasiSanggar as $data) {
            $valSanggar[] = [
                'id' => $data->id_sanggar,
                'rating' => $data->jumlah/$data->total_reservasi
            ];
        }

        BatchFacade::update(new Sanggar(), $valSanggar, 'id');

        info("Berhasil Mengkalkulasi Rating");

    }
}
