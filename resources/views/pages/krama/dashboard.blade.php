@extends('layouts.krama.krama-layout')
@section('tittle','Dashboard')

@push('css')

@endpush

@section('content')
<!-- Flexbox container for aligning the toasts -->
<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="min-height: 200px;">

    <!-- Then put toasts within -->
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <img src="..." class="rounded mr-2" alt="...">
        <strong class="mr-auto">Bootstrap</strong>
        <small>11 mins ago</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="toast-body">
        Hello, world! This is a toast message.
      </div>
    </div>
  </div>
  <div class="toast" role="alert" aria-live="polite" aria-atomic="true" data-delay="10000">
    <div role="alert" aria-live="assertive" aria-atomic="true">...</div>
  </div>
@endsection

@push('js')
  <script>
     $('#element').toast('show')
  </script>
@endpush
