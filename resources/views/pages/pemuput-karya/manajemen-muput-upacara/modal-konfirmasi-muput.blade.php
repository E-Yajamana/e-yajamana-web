@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <!-- Filepond stylesheet -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">

@endpush

<!-- MODAL KONFIRMASI TERIMA SEMUA DATA -->
<div class="modal fade" id="modalKonfirmasi" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header align-content-center text-center">
                <label class="modal-title h4 align-content-center w-100 text-lg m-1" id="exampleModalLabel">Konfirmasi Muput Upacara</label>
                <button type="button" class="pl-0 close float-lg-right"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('pemuput-karya.muput-upacara.konfirmasi-muput.konfirmasi')}}" method="POST" id="konfirmasiData" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="callout callout-info mx-1 px-2">
                        <p class="text-xs">Anda dapat menggungah bukti Muput Upacara pada tahapan tersebut, sebagai history Muput Upacara.</p>
                    </div>
                    <input class="d-none" name="id_detail_reservasi" id="idDetailReservasi" value="" type="hidden">
                    <input type="hidden" id="idUpacaraku" class="d-none" value="" name="id_upacaraku">
                    <div class="form-group px-2">
                        <label>Foto Bukti Muput Upacara</label>
                        <div class="input-group mb-2">
                            <div class="custom-file">
                                <input type="file" id="file" class="custom-file-input @error('file') is-invalid @enderror" name="file[]" multiple id="customFile" value="{{old('file')}}" >
                                <label class="custom-file-label " for="customFile">Masukan Foto Bukti Muput Upacara</label>
                            </div>
                        </div>
                        <div class="text-sm text-danger text-start file_error" id="file_error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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
                <label class="modal-title h4 align-content-center w-100 text-lg m-1" id="exampleModalLabel">Batal Muput Upacara</label>
                <button type="button" class="pl-0 close float-lg-right"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formAlasanPembatalan" action="{{route('pemuput-karya.muput-upacara.konfirmasi-muput.batal')}}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" id="idDetailReservasiBatal" class="d-none" value="" name="id_detail_reservasi">
                <input type="hidden" id="idUpacarakuBatal" class="d-none" value="" name="id_upacaraku">
                <div class="modal-body">
                    <div class="callout callout-info mx-1">
                        <p class="text-xs">Reservasi yang sudah ditolak, tidak dapat diubah kembali. Masukan alasan penolakan untuk menginformasikan kembali kepada Krama.</p>
                    </div>
                    <div class="form-group px-2">
                        <label>Alasan Batal Muput Upacara? <span class="text-danger">*</span></label>
                        <select id="alasan_pembatalan" onchange="getVal()" name="alasan_pembatalan" class="select2bs4 form-control " style="width: 100%;">
                            <option disabled selected>Pilih Alasan</option>
                            <option value="Kondisi tidak memungkinkan untuk Muput">Kondisi tidak memungkinkan untuk Muput</option>
                            <option value="Terdapat keperluan yang lainnya">Terdapat keperluan yang lainnya</option>
                            <option value="">Lainnya</option>
                        </select>
                    </div>
                    <div id="alasanLainnya" class="px-2"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-block btn-light btn-lg px-2 text-md">Batalkan Reservasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- MODAL TOLAK RESERVASI -->

@push('js')
    <!-- Bootstrabase-template-->
    <script src="{{asset('base-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- jquery-validation -->
    <script src="{{asset('base-template/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/jquery-validation/additional-methods.min.js')}}"></script>


    <script>
        $(function () {
            bsCustomFileInput.init();
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })

        //KONFIRMASI RESERVASI
        function konfirmasiMuput(id,id_upacaraku){
            Swal.fire({
                title: 'Pemberitahuan',
                text : 'Apakah anda ingin mengkonfirmasi selesainya Muput Tahapan Upacara tersebut?',
                icon:'question',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Terima`,
                denyButtonText: `Batal`,
                confirmButtonColor: '#3085d6',
                denyButtonColor : '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#idDetailReservasi").val(id);
                    $("#idUpacaraku").val(id_upacaraku);
                    $("#modalKonfirmasi").modal();
                }
            })
        }
        //KONFIRMASI RESERVASI

        //FUNGSI BATAL RESERVASI
        function batalMuput(idReservasi,id_upacaraku){
            Swal.fire({
                title: 'Peringatan',
                text : 'Apakah Anda yakin ingin membatalkan Muput Upacara tersebut ?',
                icon:'warning',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Iya`,
                denyButtonText: `Tidak`,
                confirmButtonColor: '#3085d6',
                denyButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#idDetailReservasiBatal").val(idReservasi);
                    $("#idUpacarakuBatal").val(id_upacaraku);
                    $("#modalTolak").modal();
                }
            })
        }
        //FUNGSI BATAL RESERVASI

        function getVal(){
            var jenis = $('#alasan_pembatalan').find(':selected').val();
            console.log(jenis)
            if(jenis == null || jenis == ""){
                $("#alasanLainnya").append('<div class="form-group"> <label>Masukan Alasan Lainnya <span class="text-danger">*</span></label><input class="form-control" name="alasan_pembatalan" placeholder="Masukan Alasan Lainnya"></div>');
                $("#alasan_pembatalan").attr('name', '');
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
        }



    </script>
@endpush
