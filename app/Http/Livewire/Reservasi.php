<?php

namespace App\Http\Livewire;

use App\Models\Sanggar;
use App\Models\Upacara;
use App\Models\Upacaraku;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use stdClass;

class Reservasi extends Component
{

    public $pemuput = [];
    public $selectUpacara;

    public function mount($tipe,$id)
    {
        switch($tipe){
            case 'pemuput_karya':
                $pemuputKarya = User::with('PemuputKarya')->whereHas('PemuputKarya')->findOrFail($id);
                $this->pemuput['id'] = $pemuputKarya->id;
                $this->pemuput['nama'] = $pemuputKarya->PemuputKarya->nama_pemuput;
                $this->pemuput['tipe'] = $pemuputKarya->PemuputKarya->tipe;
                break;
            case 'sanggar':
                $sanggar = Sanggar::findOrFail($id);
                $this->pemuput['id'] = $sanggar->id;
                $this->pemuput['nama'] =$sanggar->nama_sanggar;
                $this->pemuput['tipe'] ="sanggar";
                break;
            default:
        }
    }

    public function render()
    {
        $this->selectUpacara = 0;

        return view('livewire.reservasi',[
            'upacarakus' => Upacaraku::with(['Upacara.TahapanUpacara'])->whereIdKrama(Auth::user()->id)->whereNotIn('status',['batal','selesai'])->get(),
        ])->extends('layouts.krama.krama-layout')
        ->section('content');
    }
}
