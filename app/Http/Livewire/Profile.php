<?php

namespace App\Http\Livewire;

use App\Models\GriyaRumah;
use Livewire\Component;
use App\Models\Notification;
use App\Models\PemuputKarya;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Profile extends Component
{
    use WithFileUploads;

    public $undReadNotif;
    public $readNotif;
    public $nabe;

    public $photo;
    public $nama_sulinggih;


    public function mount()
    {
        $this->nabe = PemuputKarya::whereTipe('sulinggih')->get();
    }

    public function updateDataSulinggih()
    {
        dd($this->nama_sulinggih);
    }


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
            if(array_key_exists('type',$var['data'])){
                return ($var['data']['type'] == 'krama');
            }else{
                return $var;
            }
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
        return view('livewire.profile');
    }
}
