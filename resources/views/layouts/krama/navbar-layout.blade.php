<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-danger navbar-badge">{{count(Auth::user()->notifications)}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Notifications</span>
                <div class="dropdown-divider"></div>
                @if (count(Auth::user()->notifications) != "" || count(Auth::user()->notifications) != null)
                    @foreach (Auth::user()->notifications->take(3) as $key => $data)
                        <a href="#" class="dropdown-item background-grey">
                            <div class="media">
                                <div class="media-body">
                                    <span class="text-xs text-primary my-4"><i class="fas fa-info-circle"></i> Info | {{$data->data['title']}}</span>
                                    <p class="text-xs ">{{$data->data['body']}}</p>
                                    <p class="text-xs text-muted"><i class="far fa-clock mr-1"></i> {{$data->created_at->diffForHumans()}}</p>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                    @endforeach
                @else
                    <a href="#" class="dropdown-item background-grey">
                        <div class="media">
                            <div class="media-body text-center mb-2">
                                <i class="fas fa-bell text-primary"></i>
                                <p class="text-xs text-center">Tidak terdapat notification </p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                @endif

                <div class="row">
                    <div class="col-6">
                        <a href="#" class="dropdown-item dropdown-footer text-xs">Tandai semua dibaca</a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="dropdown-item dropdown-footer text-xs">Lihat selengkapnya</a>
                    </div>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

@push('js')

@endpush
