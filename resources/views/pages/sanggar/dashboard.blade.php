@extends('layouts.sanggar.sanggar-layout')
@section('tittle','Dashboard Sanggar')

@section('content')

    <div class="row">
        <div class="col-2 ">
            <p class="w-25 m-0">{{Auth::user()->sessionSanggar()->nama_sanggar}}</p>
        </div>
    </div>

    {{Auth::user()->sessionSanggar()->id}}

@endsection
