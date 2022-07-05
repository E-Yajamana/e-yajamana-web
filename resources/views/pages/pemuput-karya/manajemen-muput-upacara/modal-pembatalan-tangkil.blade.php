 <!-- /.content -->
 <div class="modal fade" id="modalPembatalan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header align-content-center text-center">
                <label class="modal-title h4 align-content-center w-100" id="exampleModalLabel">Pembatalan Tangkil</label>
                <button type="button" class="pl-0 close float-lg-right"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formAlasanPembatalan" action="{{route('pemuput-karya.muput-upacara.konfirmasi-tangkil.update.batal')}}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" id="idReservasi" class="d-none" value="" name="id_reservasi">
                <input type="hidden" id="idKrama" class="d-none" value="" name="id_krama">
                <div class="modal-body">
                    <div class="callout callout-info mx-1">
                        <p class="text-xs"> Masukan alasan untuk menginformasikan kembali kepada Krama Bali bahwa Reservasi telah dibatalakan.</p>
                    </div>
                    <div class="form-group px-2">
                        <label>Alasan Membatalkan Tangkil? <span class="text-danger">*</span></label>
                        <select onchange="getVal(this)" id="alasan_pembatalan" name="alasan_pembatalan" class="select2bs4 form-control " style="width: 100%;">
                             <option disabled selected>Pilih Alasan</option>
                             <option value="Krama tidak datang ke Griya">Krama tidak datang ke Griya</option>
                             <option value="Pemuput tidak dapat melakukan tangkil">Pemuput tidak dapat melakukan tangkil</option>
                             <option value="">Lainnya</option>
                        </select>
                    </div>
                    <div id="alasanLainnya" class="px-2"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-block btn-light btn-lg px-2 text-md">Batal Tangkil</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
    // BATAL/ DELETE ACTION
    function batalTangkil(id_reservasi,id_krama){
        Swal.fire({
            title: 'Peringatan',
            text : 'Apakah anda yakin akan membatalkan Tangkil Reservasi tersebut?',
            icon:'question',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Iya`,
            denyButtonText: `Tidak`,
            confirmButtonColor: '#3085d6',
            denyButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                $("#idReservasi").val(id_reservasi);
                $("#idKrama").val(id_krama);
                $("#modalPembatalan").modal();
            }
        })
    }
    // BATAL/ DELETE ACTION

    // ADD FUNCTION ADD KOLOM ALASAN RESERVASI (**)
    function getVal(sel)
    {
        var jenis = sel.value;
        if(jenis == null || jenis == ""){
            $("#alasanLainnya").append('<div class="form-group"> <label>Masukan Alasan Lainnya <span class="text-danger">*</span></label><input class="form-control" name="alasan pembatalan" placeholder="Masukan Alasan Lainnya"></div>');
        }else{
            $("#alasanLainnya").empty();
        }
    }
    // ADD FUNCTION ADD KOLOM ALASAN RESERVASI (**)



</script>
@endpush
