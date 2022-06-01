<?php

namespace App\Http\Livewire\Krama;

use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;


class Profile extends Component
{

    public $undReadNotif;
    public $readNotif;

    public function deleteNotif($id)
    {
        // SECURITY
                $validator = Validator::make(['id' =>$id],[
                'id' => 'required|exists:notifications,id',
            ]);
            if($validator->fails()){
                $this->dispatchBrowserEvent('swal:modal', [
                    'icon' => 'error',
                    'title' => 'Gagal menghapus Notification',
                ]);
            }
        // END SECURITY
        session()->flash('notify','active');

        Notification::findOrFail($id)->delete();
        $this->dispatchBrowserEvent('swal:modal', [
            'icon' => 'success',
            'title' => 'Berhasil menghapus Notification',
        ]);
    }

    public function bacaNotif($id)
    {
        // SECURITY
                $validator = Validator::make(['id' =>$id],[
                'id' => 'required|exists:notifications,id',
            ]);
            if($validator->fails()){
                $this->dispatchBrowserEvent('swal:modal', [
                    'icon' => 'error',
                    'title' => 'Gagal menghapus Notification',
                ]);
            }
        // END SECURITY
        session()->flash('notify','active');
        $user = Auth::user();
        $notification = $user->notifications->where('id', $id)->firstOrFail();
        $data = $notification->data;
        $data['status'] = "history";

        $notification->update(['read_at' => now(), 'data' => $data]);

        $this->dispatchBrowserEvent('swal:modal', [
            'icon' => 'success',
            'title' => 'Berhasil membaca Notification',
        ]);
    }


    public function render()
    {
        $notifUnRead = Auth::user()->unreadNotifications->toArray();
        $readNotif = Auth::user()->readNotifications->toArray();
        $notifUnRead = array_filter($notifUnRead, function ($var) {
            return ($var['data']['type'] == 'krama');
        });
        $readNotif = array_filter($readNotif, function ($var) {
            if(array_key_exists('type',$var['data'])){
                return ($var['data']['type'] == 'krama');
            }else{
                return $var;
            }
        });

        $this->undReadNotif = collect($notifUnRead);
        $this->readNotif = collect($readNotif);

        return view('livewire.krama.profile');
    }
}
