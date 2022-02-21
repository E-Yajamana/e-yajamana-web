<!-- MODAL KONFIRMASI TERIMA SEMUA DATA -->
<div class="modal fade" id="modalKonfirmasi" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Verifikasi Reservasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('pemuput-karya.manajemen-reservasi.all-verifikasi')}}" method="POST" id="konfirmasiData">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input class="d-none" name="id_reservasi" id="idReservasiTerima" value="" type="hidden">
                    <input class="d-none" name="status" value="diterima" type="hidden">
                    <div id="id_tahapan">
                        {{-- Data Tahapan --}}
                    </div>
                    <div class="form-group">
                        <label>Tentukan Tanggal Tangkil:</label>
                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                            <input name="tanggal_tangkil" type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime" />
                            <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button onclick="terimaSemua()" type="button" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- MODAL KONFIRMASI TERIMA SEMUA DATA -->

<!-- MODAL BATAL RESERVASI SEMUA DATA -->
<div class="modal fade" id="modalBatalReservasi" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Verifikasi Reservasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('pemuput-karya.manajemen-reservasi.all-verifikasi')}}" method="POST" id="batalData">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input class="d-none" name="id_reservasi" id="idReservasiBatal" value="" type="hidden">
                    <input class="d-none" name="status" value="ditolak" type="hidden">
                    <div id="id_tahapan_batal">
                        {{-- Data Tahapan --}}
                    </div>
                    <div class="form-group">
                        <label>Alasan Penolakan</label>
                        <textarea name="alasan_penolakan" class="form-control @error('alasan_penolakan') is-invalid @enderror" rows="4" placeholder="Masukan Alasan Penolakan Reservasi">{{old('alasan_penolakan')}}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button onclick="tolakSemua()" type="button" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- MODAL BATAL RESERVASI SEMUA DATA -->

<!-- ALERT FORM INPUT MODAL -->
@push('js')
    <script type="text/javascript">

        //FUNGSI KONFIRMASI RESERVASI
        function konfirmasiReservasi(idReservasi,tgl){
            $("#idReservasiTerima").val(idReservasi);
            var dataTahapan =  document.getElementsByName('id_tahapan_reservasi_'+idReservasi+'[]');
            for (var i = 0; i < dataTahapan.length; i++) {
                $("#id_tahapan").append("<input class='d-none' name='id_tahapan_reservasi[]' id='idReservasi' value='"+dataTahapan[i].value+"' type='hidden'>")
            }
            Swal.fire({
                title: 'Pemberitahuan',
                text : 'Apakah anda ingin menerima semua reservasi tersebut?',
                icon:'question',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Terima`,
                denyButtonText: `Batal`,
                confirmButtonColor: '#3085d6',
                denyButtonColor : '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    if(tgl == ''){
                        $("#modalKonfirmasi").modal();
                    }else{
                        $("#konfirmasiData").submit();
                    }
                }
            })
        }

        //FUNGSI BATAL RESERVASI
        function tolakReservasi(idReservasi){
            $("#modalBatalReservasi").modal();
            $("#idReservasiBatal").val(idReservasi);
            var dataTahapan =  document.getElementsByName('id_tahapan_reservasi_'+idReservasi+'[]');
            for (var i = 0; i < dataTahapan.length; i++) {
                $("#id_tahapan_batal").append("<input class='d-none' name='id_tahapan_reservasi[]' id='idReservasi' value='"+dataTahapan[i].value+"' type='hidden'>")
            }
        }
    </script>
@endpush
<!-- ALERT FORM INPUT MODAL -->


<!-- VALIDASI FORM INPUT MODAL -->
@push('js')
    <!-- jquery-validation -->
    <script src="{{asset('base-template/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/jquery-validation/additional-methods.min.js')}}"></script>

    <script type="text/javascript">
        $(".form-control").rules("add", {
            required:true,
        });

        $('#batalData').validate({
            rules: {
                alasan_penolakan: {
                    required: true,
                    minlength: 3
                },
            },
            messages: {
                alasan_penolakan: {
                    required: "Alasan penolakan wajib diisi",
                    minlength: "Alasan penolakan minimal berjumlah 3 karakter"
                },
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.addClass('ml-1 invalid-feedback text-start');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        $('#konfirmasiData').validate({
            rules: {
                tanggal_tangkil: {
                    required: true,
                },
            },
            messages: {
                tanggal_tangkil: {
                    required: "Tanggal Tangkil Wajib diisi",
                },
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.addClass('ml-1 invalid-feedback text-start');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        function terimaSemua(){
            var form = $("#konfirmasiData");
            if(form.valid()==true){
                $("#konfirmasiData").submit();
            }
        }

        function tolakSemua(){
            var form = $("#batalData");
            if(form.valid()==true){
                $("#batalData").submit();
            }
        }
    </script>
@endpush
<!-- VALIDASI FORM INPUT MODAL -->


