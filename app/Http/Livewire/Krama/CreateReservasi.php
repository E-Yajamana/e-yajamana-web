<?php

namespace App\Http\Livewire\Krama;

use App\Models\Upacaraku;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;


class CreateReservasi extends Component
{
    public $upacaraku;


    public function mount($id)
    {
        $validator = Validator::make(['id' =>$id],[
            'id' => 'required|exists:tb_upacaraku,id',
        ]);

        if($validator->fails()){
            return redirect()->back()->with([
                'status' => 'fail',
                'icon' => 'error',
                'title' => 'Data Upacaraku Tidak Ditemukan !',
                'message' => 'Data Upacaraku tidak ditemukan, pilihlah data dengan benar!',
            ]);
        }

        $this->upacaraku = Upacaraku::with(['Upacara'])->findOrFail($id);
    }


    public function render()
    {
        return view('livewire.krama.create-reservasi')
            ->extends('layouts.krama.krama-layout')
            ->section('content');
    }
}
