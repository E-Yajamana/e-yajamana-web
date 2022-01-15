@extends('layouts.email.template-lupa-password')
@section('content')
    <p>Masukkan code berikut ini pada form kode</p><br>
    <p style="font-size:20px;"><b>{{ $data['token'] }}</b></p>
@endsection