<div>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            @if (!$dataNotifKrama->isEmpty())
                <span class="badge badge-danger navbar-badge">{{count($dataNotifKrama)}}</span>
            @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Notifications</span>
            <div class="dropdown-divider"></div>
            <div  @if (!$dataNotifKrama->isEmpty() && $dataNotifKrama->count() > 2 )  class="direct-chat-messages p-0" style="height: 340px"  @endif >
                @forelse ($dataNotifKrama as $notif)
                    <a href="#" class="dropdown-item">
                        <div class="media">
                            <div class="media-body">
                                <span class="text-xs text-primary my-4"><i class="fas fa-info-circle"></i> Info | {{$notif['data']['title']}}</span>
                                <p class="text-xs ">{{$notif['data']['body']}}</p>
                                <p class="text-xs text-muted"><i class="far fa-clock mr-1"></i> {{$notif['created_at']}}</p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                @empty
                    <a href="" class="dropdown-item background-grey">
                        <div class="media">
                            <div class="media-body text-center mb-2" >
                                <i class="fas fa-bell text-primary"></i>
                                <p class="text-xs text-center">Tidak terdapat notification </p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                @endforelse
            </div>
            <div class="row">
                <div class="col-6">
                    <a wire:click="readAllNotif" class="dropdown-item dropdown-footer text-xs">Tandai semua dibaca</a>
                </div>
                <div class="col-6">
                    <a wire:click="showNotif" class="dropdown-item dropdown-footer text-xs">Lihat selengkapnya</a>
                </div>
            </div>
        </div>
    </li>
</div>
