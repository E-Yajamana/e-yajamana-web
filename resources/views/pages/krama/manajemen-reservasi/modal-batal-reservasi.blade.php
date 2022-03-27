 <!-- /.content -->
 <div class="modal fade" id="modalPembatalan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header align-content-center text-center">
                <label class="modal-title h4 align-content-center w-100" id="exampleModalLabel">Pembatalan Reservasi</label>
                <button type="button" class="pl-0 close float-lg-right"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formAlasanPembatalan" action="{{route('krama.manajemen-reservasi.delete')}}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" id="idReservasi" class="d-none" value="" name="id">
                <div class="modal-body">
                    <div class="callout callout-info mx-1">
                        <p class="text-xs">Pembatalan reservasi yang telah dibuat butuh alasan untuk menginformasikan kembali Pemuput Karya.</p>
                    </div>
                    <div class="form-group px-2">
                        <label>Alasan Membatalkan Reservasi? <span class="text-danger">*</span></label>
                        <select id="alasan_pembatalan" name="alasan_pembatalan" class="select2bs4 form-control " style="width: 100%;">
                             <option disabled selected>Pilih Alasan</option>
                             <option value="Ingin mencari Pemuput Karya lainnya">Ingin mencari Pemuput Karya lainnya</option>
                             <option value="Reservasi pada tahapan tersebut tidak jadi dilakukan">Reservasi pada tahapan tersebut tidak jadi dilakukan</option>
                             <option value="Ingin melakukan pencarian Pemuput Karya secara Offline">Ingin melakukan pencarian Pemuput Karya secara Offline</option>
                             <option value="">Lainnya</option>
                        </select>
                    </div>
                    <div id="alasanLainnya" class="px-2"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-block btn-light btn-lg px-2 text-md">Batalkan Upacara</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
    // ADD FUNCTION ADD KOLOM ALASAN RESERVASI (**)
    $('#alasan_pembatalan').change(function(){
        var jenis = $(this).find(':selected').val();
        if(jenis == null || jenis == ""){
            $("#alasanLainnya").append('<div class="form-group"> <label>Masukan Alasan Lainnya <span class="text-danger">*</span></label><input class="form-control" name="alasan pembatalan" placeholder="Masukan Alasan Lainnya"></div>');
        }
    });
    // ADD FUNCTION ADD KOLOM ALASAN RESERVASI (**)

    // BATAL RESERVASI
    function batalReservasi(id){
        Swal.fire({
            title: 'Peringatan',
            text : 'Apakah anda yakin akan membatalkan Reservasi?',
            icon:'warning',
            showDenyButton: false,
            showCancelButton: false,
            confirmButtonText: `Batal`,
            denyButtonText: `Cancel`,
            confirmButtonColor: '#3085d6',
            denyButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                $("#idReservasi").val(id);
                $("#modalPembatalan").modal();
            } else if (result.isDenied) {

            }
        })
    }
    // BATAL RESERVASI


</script>
@endpush
