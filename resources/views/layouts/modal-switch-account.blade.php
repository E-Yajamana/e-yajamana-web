<div class="modal fade" id="switchAccount" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="card-body box-profile align-content-center">
                    <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/base-template/dist/img/logo-01.png" alt="User profile picture">
                    </div>
                    <h3 class="text-center bold mb-0 mt-3">Ganti Akun</h3>
                    <div class="d-flex align-items-center justify-content-center">
                        <p style="width: 65%" class="text-center mb-1 mt-1 ">Anda dapat mengganti Role Akun yang anda miliki:</p>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                @foreach (Auth::user()->Role as $data)
                    @switch($data->nama_role)
                        @case('pemuput_karya')
                            @if (Auth::user()->PemuputKarya->status_konfirmasi_akun == 'disetujui')
                                <div class="card shadow collapsed-card mt-3">
                                    <div class="card-header">
                                        <div class="user-block">
                                            <img class="img-circle" src="{{asset("base-template/dist/img/marker/sanggar.png")}}" alt="User Image">
                                            <span class="username"><a href="{{route('switch-account','pemuput')}}" class="stretched-link  ml-2 p-0 btn btn-link">{{ucfirst(Auth::user()->PemuputKarya->tipe)}}</a></span>
                                            <span class="description">
                                                <div class="ml-2">{{Auth::user()->PemuputKarya->nama_pemuput}}</div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @break
                        @case('sanggar')
                            @forelse (Auth::user()->Sanggar->where('status_konfirmasi_akun','disetujui') as $data)
                                <form action="{{route('sanggar.session')}}" method="POST">
                                    @csrf
                                    <input value="{{$data->id}}" type="hidden" class="d-none" name="id">
                                    <div class="card shadow collapsed-card mt-3">
                                        <div class="card-header">
                                            <div class="user-block">
                                                <img class="img-circle" src="{{route("image.profile.sanggar",$data->id)}}" alt="User Image">
                                                <span class="username"><button type="submit" class="stretched-link  ml-2 p-0 btn btn-link">Sanggar</button></span>
                                                <span class="description">
                                                    <div class="ml-2">{{$data->nama_sanggar}}</div>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @empty
                            @endforelse
                            @break
                        @case('serati')
                            @if (Auth::user()->Serati->status_konfirmasi_akun == 'disetujui')
                                <div class="card shadow collapsed-card mt-3">
                                    <div class="card-header">
                                        <div class="user-block">
                                            <img class="img-circle" src="{{asset("base-template/dist/img/marker/sanggar.png")}}" alt="User Image">
                                            <span class="username"><a href="#" class="stretched-link  ml-2 p-0 btn btn-link">{{ucfirst(Auth::user()->Serati->tipe)}}</a></span>
                                            <span class="description">
                                                <div class="ml-2">{{Auth::user()->Serati->nama_serati}}</div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @break
                        @default
                            <div class="card shadow collapsed-card mt-3">
                                <div class="card-header">
                                    <div class="user-block">
                                        <img class="img-circle" src="{{asset("base-template/dist/img/marker/griya.png")}}" alt="User Image">
                                        <span class="username"><a href="{{route('switch-account','krama')}}" class="stretched-link  ml-2 p-0 btn btn-link">Krama</a></span>
                                        <span class="description">
                                            <div class="ml-2">{{Auth::user()->Penduduk->nama}}</div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                    @endswitch
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        function switchAccount(){
            $('#switchAccount').modal()
        }
    </script>
@endpush

@push('js')
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        @if(Session::has('status-switch'))
            Toast.fire({
                icon:  @if(Session::has('icon')){!! '"'.Session::get('icon').'"' !!} @else 'question' @endif,
                title:  @if(Session::has('title')){!! '"'.Session::get('title').'"' !!} @else 'question' @endif,
            })
        @endif

    </script>
@endpush

