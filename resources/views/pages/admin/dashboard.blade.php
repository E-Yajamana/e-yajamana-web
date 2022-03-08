@extends('layouts.admin.admin-layout')
@section('tittle','Dashboard')

@push('css')
@endpush

@section('content')
    <section>
        <form method="POST" >
            @csrf
            <div class="form-group">
                <label>Tittle <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" id="nama_upacara" name="nama_upacara" autocomplete="off" class="form-control @error('nama_upacara') is-invalid @enderror" value="{{ old('nama_upacara') }}" placeholder="Masukan Nama Upacara">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" onclick="ajaxSend()" class="btn btn-primary">Send Notification </button>
        </form>
    </section>
@endsection

@push('js')

<script>
    function ajaxSend(){
        $.ajax({
            url: "{{route('send-notificaiton')}}",
            type: 'POST',
            dataType: "JSON",
            success: function (response) {
                console.log(response)
            },
            error: function (error) {
                console.log(error)
            },
        });
    }
</script>

@endpush
