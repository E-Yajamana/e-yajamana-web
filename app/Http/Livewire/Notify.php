<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Notify extends Component
{

    public $dataNotif;
    public $urlUser;

    public function mount(Request $request)
    {
        $this->urlUser = request()->segment(1);
    }


    public function showNotif()
    {
        session()->flash('notify','active');
        switch($this->urlUser){
            case('krama'):
                return redirect()->route('krama.profile');
                break;
            case('pemuput-karya'):
                return redirect()->route('pemuput-karya.profile');
                break;
            case('sanggar'):
                return redirect()->route('pemuput-karya.profile');
                break;
            default:
                return redirect()->route('auth.login');
        }
    }

    public function readAllNotif()
    {
        $arrayNotifKrama = $this->dataNotif->toArray();
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

        $notif = array_filter($dataNotif, function ($var) {
            if(array_key_exists('type',$var['data'])){
                switch($this->urlUser){
                    case('krama'):
                        return ($var['data']['type'] == 'krama');
                        break;
                    case('pemuput-karya'):
                        return ($var['data']['type'] == 'pemuput');
                        break;
                    case('sanggar'):
                        if($var['data']['type'] == 'sanggar'){
                            return in_array( session('id_sanggar'), $var['data']['id_sanggar']);
                        }
                        break;
                    default:
                        return $var;
                }
            }else{
                return $var;
            }
        });

        $this->dataNotif = collect($notif);

        return view('livewire.notify');
    }
}
