@component('mail::message')
    <div style="text-align: center;">
        <img src="{{ asset('logo-01.png') }}" alt="" style="width:50px;height:50px; text-align: center;">
    </div>
    <p style="margin: 0px; text-align: center;">
        <b>E-YAJAMANA</b>
        <br>
        <small style="font-size: 8px;font-style:normal;">SISTEM RESERVASI PEMUPUT KARYA</small>
    </p>
    <p style="margin: 25px 50px"></p>
    <p style="font-size:10px; text-align: center;  margin: 22px 50px;"><b>{{ $data['text'] }}</b></p>
    <p style="font-size:15px; text-align: center;"><small>E-Yajamana 2021 | All Right Reserved &copy;</small></p>
@endcomponent
