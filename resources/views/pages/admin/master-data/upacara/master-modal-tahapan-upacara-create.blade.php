
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Tahapan Upacara</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="submitData" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input class="d-none" type="hidden" id="id_upacara" name="id_upacara" value="{{$dataUpacara->id}}">
                    <input id="id_tahapan" name="id" value="" type="hidden" class="d-none">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Tahapan Upacara <span class="text-danger">*</span></label>
                        <input id="nama_tahapan" type="text" name="nama_tahapan" class="form-control @error('nama_tahapan') is-invalid @enderror" id="exampleInputEmail1" placeholder="Masukan Nama Tahapan" value="{{old('nama_tahapan')}}">
                        <div class="text-sm text-danger text-start nama_tahapan_error" id="nama_tahapan_error"></div>
                    </div>
                    <div class="form-group">
                        <label>Status Upacara <span class="text-danger">*</span></label>
                        <select id="status" name="status" class="select2bs4 form-control  @error('status') is-invalid @enderror" style="width: 100%;">
                            <option disabled selected>Pilih Status Tahapan</option>
                            @php
                                $status = old('status')
                            @endphp
                            <option @if ($status == 'awal') selected @endif  value="awal" >Awal</option>
                            <option @if ($status == 'puncak') selected @endif value="puncak" >Puncak</option>
                            <option @if ($status == 'akhir') selected @endif value="akhir" >Akhir</option>
                        </select>
                        <div class="text-sm text-danger text-start status_error" id="status_error"></div>
                    </div>
                    <div class="form-group">
                        <label>Foto Tahapan Upacara</label>
                        <div class="input-group mb-2">
                            <div class="custom-file">
                                <input type="file" id="file" class="custom-file-input @error('file') is-invalid @enderror" name="file" id="customFile" value="{{old('file')}}" >
                                <label class="custom-file-label " for="customFile">Masukan Foto Tahapan</label>
                            </div>
                        </div>
                        <div class="text-sm text-danger text-start file_error" id="file_error"></div>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Tahapan <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control  @error('deskripsi') is-invalid @enderror" rows="3" placeholder="Masukan Deskripsi Tahapan" value="{{ old('deskripsi') }}" >{{ old('deskripsi') }}</textarea>
                        <div class="text-sm text-danger text-start deskripsi_error" id="deskripsi_error"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" >Buat Tahapan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
    </script>
@endpush
