@push('css')
    <script src="{{asset('base-template/dist/js/rating.js')}}"></script>
@endpush

<div class="container-fluid">
    <button class="btn btn-primary" data-toggle="modal" data-target="#myModal"> Modal Testing </button>
</div>

<div class="row">
    <div class="col-12 col-md-6" style="font-size: 2em;">
        <h5>Normal example</h5>
        <div id="review"></div>
    </div>

    <div class="col-12 col-md-6">
        <label for="starsInput">Stars</label>
        <input type="text" readonly id="starsInput" class="form-control form-control-sm">
        <div class="alert alert-primary mt-2">
            Look in the developer console to see the event callback.
        </div>
    </div>
</div>

 <!-- MODAL DETAIL POPUP USER -->
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="card-body box-profile align-content-center">
                    <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="http://127.0.0.1:8000/base-template/dist/img/logo-01.png" alt="User profile picture">
                    </div>
                    <h3 class="text-center bold mb-0 mt-3" id="nama_griya"></h3>
                    <p class="text-center mb-1 mt-1" id="alamat"></p>
                </div>
            </div>
            <div class="modal-body" id="dataSulinggih">
                <div class="col-12" id="accordion">
                    <div class="card">
                        <div class="card-header">
                            <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                <div class='user-block'>
                                    <img class='img-circle mt-1' src="{{route('image.profile.user',49)}}" alt='User Image' style="height: 48px; width:  48px">
                                    <span class='username'>
                                        <div class='btn btn-link p-0 ml-3' >I Made Rismawan Nugraha </div>
                                    </span>
                                    <span class='description'>
                                        <div class='ml-3 '>rismawan@gmail.com | <i class="fas fa-star text-warning"></i> 0.0</div>
                                    </span>
                                    <span class='description'>
                                        <div class='ml-3 '>Muput Upacara 40</div>
                                    </span>
                                </div>
                            </a>
                            <div class='card-tools'>
                                <button title="Tambahkan ke Favorit"  type='button' onclick="testing()" class='btn btn-tool float-lg-right pt-3'>
                                    <i id="favorit" class="fas fa-heart fa-sm"></i>
                                </button>
                            </div>
                        </div>
                        <div id="collapseOne" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <div class='row d-flex justify-content-center px-3'>
                                    <div class="col-6">
                                        <div class=" align-items-center">
                                            <p class="text-xs mb-0"> <strong>Tanggal Diksha :</strong> 28 Mei 2022</p>
                                            <p class="text-xs mb-0"> <strong> Nama Walaka :</strong> Belum Terdata</p>
                                            <p class="text-xs mb-0"> <strong> Nomor Telepon :</strong> 0812461238</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class=" align-items-center">
                                            <p class="text-xs mb-0"> <strong> Tipe : </strong>Sulinggih</p>
                                            <p class="text-xs mb-0"> <strong> Nama Nabe : </strong>Belum Terdata</p>
                                            <p class="text-xs mb-0"> <strong> Jenis Kelamin : </strong>Perempuan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        function testing()
        {
            $("#favorit").addClass('text-danger');
        }
        $("#review").rating({
            "value": 0,
            "click": function (e) {
                console.log(e);
                $("#starsInput").val(e.stars);
            }
        });
    </script>
@endpush



