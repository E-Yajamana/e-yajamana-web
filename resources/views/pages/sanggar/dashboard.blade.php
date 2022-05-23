@extends('layouts.sanggar.sanggar-layout')
@section('tittle','Dashboard Sanggar')

@section('content')
    {{Auth::user()->sessionSanggar()->id}}

@endsection
