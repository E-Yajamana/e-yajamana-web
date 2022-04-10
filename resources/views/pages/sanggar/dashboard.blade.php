@extends('layouts.sanggar.sanggar-layout')
@section('tittle','Dashboard Sanggar')

@section('content')
    <input class="form-control" value="{{ session('id_sanggar') }}">
    {{Auth::user()->sessionSanggar()->id}}

@endsection
