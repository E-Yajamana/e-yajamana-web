<!-- MODAL KONFIRMASI TERIMA SEMUA DATA -->
<div class="modal fade" id="modalKonfirmasi" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header align-content-center text-center">
                <label class="modal-title h4 align-content-center w-100 text-lg m-1" id="exampleModalLabel">Tentukan Tanggal Tangkil</label>
                <button type="button" class="pl-0 close float-lg-right"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('pemuput-karya.manajemen-reservasi.verifikasi.update')}}" method="POST" id="konfirmasiData">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="callout callout-info mx-1 px-2">
                        <p class="text-xs">Tentukan tanggal tangkil, yang bertujuan untuk menentukan kedatangan Krama Bali untuk berdiskusi tekait dengan Muput Upacara.</p>
                    </div>
                    <input class="d-none" name="id_reservasi" id="idReservasiTerima" value="" type="hidden">
                    <input class="d-none" name="status" value="diterima" type="hidden">
                    <div class="form-group px-2">
                        <label>Tentukan Tanggal Tangkil:</label>
                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input name="tanggal_tangkil" id="dateTangkil" type='text' class='form-control float-right' >
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- MODAL KONFIRMASI TERIMA SEMUA DATA -->

<!-- MODAL TOLAK RESERVASI -->
<div class="modal fade" id="modalTolak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header align-content-center text-center">
                <label class="modal-title h4 align-content-center w-100 text-lg m-1" id="exampleModalLabel">Tolak Reservasi</label>
                <button type="button" class="pl-0 close float-lg-right"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formAlasanPembatalan" action="{{route('pemuput-karya.manajemen-reservasi.verifikasi.update')}}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" id="idReservasiBatal" class="d-none" value="" name="id_reservasi">
                <input class="d-none" name="status" value="ditolak" type="hidden">
                <div class="modal-body">
                    <div class="callout callout-info mx-1">
                        <p class="text-xs">Reservasi yang sudah ditolak, tidak dapat diubah kembali. Masukan alasan penolakan untuk menginformasikan kembali kepada Krama.</p>
                    </div>
                    <div class="form-group px-2">
                        <label>Alasan Menolak Reservasi? <span class="text-danger">*</span></label>
                        <select id="alasan_pembatalan" name="alasan_pembatalan" class="select2bs4 form-control " style="width: 100%;">
                            <option disabled selected>Pilih Alasan</option>
                            <option value="Lokasi upacara tidak memadai">Lokasi upacara tidak memadai</option>
                            <option value="Sudah memiliki jadwal muput pada hari tersebut">Sudah memiliki jadwal Muput pada hari tersebut</option>
                            <option value="Tidak dapat melakukan Muput Jenis Upacara tersebut">Tidak dapat melakukan Muput Jenis Upacara tersebut</option>
                            <option value="">Lainnya</option>
                        </select>
                    </div>
                    <div id="alasanLainnya" class="px-2"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-block btn-light btn-lg px-2 text-md">Tolak Reservasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- MODAL TOLAK RESERVASI -->


@push('js')
    <!-- date-range-picker -->
    <script src="{{asset('base-template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- daterangepicker -->

    <script>
    // FUNGSI KONFIRMASI RESERVASI
    function konfirmasiReservasi(idReservasi,tanggal_mulai){
        Swal.fire({
            title: 'Pemberitahuan',
            text : 'Apakah Anda yakin ingin menerima semua Tahapan Reservasi tersebut?',
            icon:'question',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Terima`,
            denyButtonText: `Batal`,
            confirmButtonColor: '#3085d6',
            denyButtonColor : '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                // SET UP DATE UPACARA
                $("#idReservasiTerima").val(idReservasi);
                $('#dateTangkil').daterangepicker({
                    timePicker: true,
                    "singleDatePicker": true,
                    timePicker24Hour: true,
                    "minDate": moment(Date ()).format('DD MMMM YYYY H:mm'),
                    "maxDate": moment(tanggal_mulai).add(23,'hours').add(59,'minutes').format('DD MMMM YYYY H:mm'),
                    locale: {
                        format: 'DD MMMM YYYY H:mm',
                    },
                });
                $("#modalKonfirmasi").modal();
            }
        })
    }
    // FUNGSI KONFIRMASI RESERVASI

    //FUNGSI BATAL RESERVASI
    function tolakReservasi(idReservasi){
        Swal.fire({
            title: 'Peringatan',
            text : 'Apakah Anda yakin ingin menolak semua Tahapan Reservasi tersebut ?',
            icon:'warning',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Iya`,
            denyButtonText: `Tidak`,
            confirmButtonColor: '#3085d6',
            denyButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                $("#idReservasiBatal").val(idReservasi);
                $("#modalTolak").modal();
            }
        })
    }
    //FUNGSI BATAL RESERVASI

    $('#alasan_pembatalan').change(function(){
        var jenis = $(this).find(':selected').val();
        if(jenis == null || jenis == ""){
            $("#alasanLainnya").append('<div class="form-group"> <label>Masukan Alasan Lainnya <span class="text-danger">*</span></label><input class="form-control" name="alasan_pembatalan" placeholder="Masukan Alasan Lainnya"></div>');
            $("#alasan_pembatalan").attr('name', 'sel');
            $('#formAlasanPembatalan').validate({
                rules: {
                    alasan_pembatalan: {
                        required: true,
                    },
                },
                messages: {
                    alasan_pembatalan: {
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
        }else{
            $("#alasan_pembatalan").attr('name', 'alasan_pembatalan');
            $("#alasanLainnya").empty();
        }
    });

    </script>
@endpush

