<?php

namespace App\Http\Livewire\Krama;
use Carbon\Carbon;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class Notif extends Component
{
    public $dataNotifKrama;

    public function showNotif()
    {
        session()->flash('notify','active');
        return redirect()->route('krama.profile');
    }

    public function readAllNotif()
    {
        $arrayNotifKrama = $this->dataNotifKrama->toArray();
        $idNotif = array_column($arrayNotifKrama, 'id');
        $dataNotif = array_map(function ($object) {
            $object['data']['status'] = 'history';
            $object['read_at'] = now();
            return (array) $object;
        }, $arrayNotifKrama);

        Notification::whereIn('id',$idNotif)->update(['read_at'=>now()]);
    }

    public function render()
    {
        $dataArray = Auth::user()->unreadNotifications->toArray();
        $dataNotif = array_map(function ($object) {
            $object['created_at'] = Carbon::parse($object['created_at'])->diffForHumans();
            return (array) $object;
        }, $dataArray);

        $notifKrama = array_filter($dataNotif, function ($var) {
            if(array_key_exists('type',$var['data'])){
                return ($var['data']['type'] == 'krama');
            }else{
                return $var;
            }
        });

        $this->dataNotifKrama = collect($notifKrama);

        return view('livewire.krama.notif');
    }
}
