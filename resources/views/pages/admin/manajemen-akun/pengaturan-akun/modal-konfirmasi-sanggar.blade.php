@push('css')
    <link rel="stylesheet" href="{{ asset('base-template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush


<form id="konfirmasiSanggar" class="d-none" action="{{route('admin.manajemen-akun.verifikasi.sanggar')}}" method="post">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" id="id_sanggar" value="">
    <input type="hidden" name="status" id="status" value="disetujui">
</form>


 <!-- /.content -->
 <div class="modal fade" id="modalPembatalanSanggar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header align-content-center text-center">
                <label class="modal-title h4 align-content-center w-100" id="exampleModalLabel">Form Penolakan Akun Sanggar</label>
                <button type="button" class="pl-0 close float-lg-right"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="tolakSanggar" action="{{route('admin.manajemen-akun.verifikasi.sanggar')}}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" id="id_tolak_sanggar" class="d-none" value="" name="id">
                <input type="hidden" class="d-none" value="ditolak" name="status">
                <div class="modal-body">
                    <div class="callout callout-info mx-1">
                        <p class="text-xs"> Penentuan verifiaksi Akun, bersifat permanen,  Anda tidak dapat kembali mengubah status verifikasi akun yang sudah ditentukan.</p>
                    </div>
                    <div class="form-group px-2">
                        <label>Alasan Penolakan Akun? <span class="text-danger">*</span></label>
                        <select id="alasan_pembatalanSanggar" name="text_penolakan" class="select2bs4 form-control " style="widtb h: 100%;">
                            <option disabled selected>Pilih Alasan</option>
                            {{-- <option value="SK tidak sesuai">SK tidak sesuai</option> --}}
                            <option value="Data Tidak Lengkap">Data Tidak Lengkap</option>
                            <option value="Terdapat kecurangan data">Terdapat kecurangan data</option>
                            <option value="SK Tanda Usaha tidak sesuai">SK Tanda Usaha tidak sesuai</option>
                            <option value="">Lainnya</option>
                        </select>
                    </div>
                    <div id="alasanLainnyaSanggar" class="px-2"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-block btn-light btn-lg px-2 text-md">Tolak Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
    <script src="{{asset('base-template/plugins/select2/js/select2.full.min.js')}}"></script>

    <script>
        $(function () {
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })

        // TERIMA VERIFIKASI PEMUPUT KARYAS
        function terimaSanggar(id)
        {
            Swal.fire({
                title: 'Verifikasi',
                text : 'Apakah anda yakin akan mengkonfirmasi akun Sanggar tersebut?',
                icon:'question',
                showDenyButton: true,
                showCancelButton: false,
                denyButtonText: `Tidak`,
                confirmButtonText: `iya`,
                confirmButtonColor: '#3085d6',
                denyButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#id_sanggar').val(id);
                    $('#konfirmasiSanggar').submit();
                } else if (result.isDenied) {

                }
            })
        }
        // TERIMA VERIFIKASI PEMUPUT KARYA


        // TOLAK VERIFIKASI PEMUPUT KARYA
        function tolakSanggar(id)
        {
            console.log(id)
            Swal.fire({
                title: 'Verifikasi',
                text : 'Apakah anda yakin akan menolak akun Sanggar tersebut?',
                icon:'question',
                showDenyButton: true,
                showCancelButton: false,
                denyButtonText: `Tidak`,
                confirmButtonText: `iya`,
                confirmButtonColor: '#3085d6',
                denyButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#id_tolak_sanggar').val(id);
                    $("#modalPembatalanSanggar").modal();
                } else if (result.isDenied) {

                }
            })
        }
        // TOLAK VERIFIKASI PEMUPUT KARYA

        // ADD FUNCTION ADD KOLOM ALASAN RESERVASI (**)
        $('#alasan_pembatalanSanggar').change(function(){
            var jenis = $(this).find(':selected').val();
            if(jenis == null || jenis == ""){
                $("#alasanLainnyaSanggar").append('<div class="form-group"> <label>Masukan Alasan Lainnya <span class="text-danger">*</span></label><input class="form-control" name="text_penolakan" placeholder="Masukan Alasan Lainnya"></div>');
            }
        });
        // ADD FUNCTION ADD KOLOM ALASAN RESERVASI (**)


    </script>
@endpush
