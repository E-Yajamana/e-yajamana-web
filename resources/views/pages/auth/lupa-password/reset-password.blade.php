@extends('pages.auth.layout.master')

@section('tittle','Lupa Password')

@section('content')

    <div class="container p-lg-4">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-6 p-4">
                <div class="card card-primary">
                    <div class="card-header bg-white text-center">
                        <img class="rounded mx-auto d-block" src="{{asset('base-template/dist/img/logo-01.png') }}" alt="E-Yajamana" width="100" height="100">
                        <a href="" class="text-decoration-none h3 fw-bold">E-Yajamana</a>
                        <p class="login-box-msg mb-0 pb-0 px-0 pb-3 fw-bold mt-1">Pengubahan Kata Sandi</p>
                    </div>
                    <div class="card-body p-2">
                        <div class="text-center p-lg-3" id="text-header">
                            <p class="m-0">
                                Masukan E-Mail yang telah terhubung
                            </p>
                            <p class="m-0">
                                dengan akun E-Yajamana anda
                            </p>
                        </div>
                        <form class="px-lg-4 mb-2">
                            @csrf
                            <div class="" id="formInput">
                                <div class="form-group">
                                    <label>E-Mail</label>
                                    <div class="input-group">
                                        <input id="email" name="email" type="email" class="form-control" placeholder="Masukan E-mail">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-1 text-xs text-danger text-start" id="email_error"></div>
                                </div>
                            </div>
                            <div class=" col-12 d-flex justify-content-end p-0 mt-lg-4">
                                <button type="button" id="buttonSubmit" onclick="submitGetToken()" class="btn btn-outline-primary btn-sm btn-block">Kirim Kode OTP</button>
                            </div>
                        </form>
                    </div>
                    <div class="text-center my-xl-3 mt-lg-3 p-3">
                        <a href="" class="nav-link link-dark">E-Yajamana 2021 | All Right Reserved &copy </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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

<script type="text/javascript">
    let _token = $("input[name='_token']").val();
    let email;

    function submitGetToken(){
        email = $("#email").val();
        $.ajax({
            url: "{{ route('auth.lupa-password.request.token') }}",
            type:'POST',
            data: {
                _token : _token,
                email : email
            },
            success:function(response){
                $("#email" ).removeClass('is-invalid');
                $("#email_error" ).text("");
                $("#text-header").empty();
                $("#kodeOTP").empty();
                $("#text-header").append("<p class='m-0'>Masukan kode rahasia yang Anda</p><p class='m-0'>dapatkan dari E-mail yang telah</p><p class='m-0'>dimasukan sebelumnya</p>");
                $("#formInput").append("<div class='form-group' id='kodeOTP'><label>Kode Rahasia</label><div class='input-group'><input oninput='if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);' id='token' name='token' type='number' class='form-control' placeholder='Masukan Kode Rahasia' maxlength='5'><div class='input-group-append'><div class='input-group-text'><span class='fas fa-lock'></span> </div> </div> </div><div class='m-1 text-xs text-danger text-start' id='kodeOTP_error'></div></div>");

                Toast.fire({
                    icon: 'success',
                    title: "Berhasil Mengirim Kode OTP, Cek kembali Email anda!"
                })

                $("#token" ).attr( "maxlength", 5);
                $("#email" ).prop( "disabled", true );
                $("#buttonSubmit").attr("onclick","checkTokenOTP('"+email+"')");
                $("#buttonSubmit").text("Check Kode OTP");
            },
            error: function(response, error){
                console.log(response)
                $("#email" ).addClass('is-invalid');
                $("#email_error" ).text(response.responseJSON.data.email);
                Swal.fire({
                    icon:  'error',
                    title: 'Failed!!',
                    text: "Gagal mengirim token, cek kembali form input yang anda masukan!",
                });
            }
        });

    }

    function checkTokenOTP(email){
        let token = $("#token").val();
        $.ajax({
            url: "{{ route('auth.lupa-password.check.token') }}",
            type:'POST',
            data: {
                _token : _token,
                email : email,
                token : token
            },
            success:function(response){
                console.log(response)
                $('#kodeOTP').empty();
                $("#text-header").empty();
                $("#text-header").append('<p class="m-0">Masukan password baru dan</p><p class="m-0">konfirmasi password baru anda</p>');
                $("#formInput").append("<div class='form-group'><div class='input-group'><input name='password' id='password' type='password' class='form-control' placeholder='Password Baru'><div class='input-group-append'><div class='input-group-text'><span class='fas fa-lock'></span></div></div></div><div class='m-1 text-xs text-danger text-start' id='password_error'></div></div> <div class='form-group'><div class='input-group'><input id='password_confirmation' name='password_confirmation' type='password' class='form-control' placeholder='Konfirmasi Password Baru'><div class='input-group-append'><div class='input-group-text'><span class='fas fa-lock'></span></div></div> </div><div class='m-1 text-xs text-danger text-start' id='passwordKonfirmasi_error'></div></div>")

                Toast.fire({
                    icon: 'success',
                    title: "Kode OTP sesuai,silakan atur ulang kembali password anda!"
                })

                $("#buttonSubmit").attr("onclick","resetPassword('"+email+"',"+token+")");
                $("#buttonSubmit").text("Reset Password");
            },
            error: function(response, error){
                $("#token" ).addClass('is-invalid');
                $("#kodeOTP_error" ).text('Masukan Token OTP dengan benar!');
                Swal.fire({
                    icon:  'error',
                    title: 'Failed!!',
                    text: "Gagal mengirim mengecek token, cek kembali form input yang anda masukan!",
                });
            }
        });

    }

    function resetPassword(email,token){
        let password = $("#password").val();
        let passwordConfirmed = $("#password_confirmation").val();
        $.ajax({
            url: "{{ route('auth.lupa-password.new.password') }}",
            type:'POST',
            data: {
                _token : _token,
                email : email,
                token : token,
                password : password,
                password_confirmation : passwordConfirmed
            },
            success:function(response){
                Swal.fire({
                    icon:  'success',
                    title: 'Berhasil Merubah Password',
                    text: "Berhasil merubah password, anda dapat mencoba login kembali menggunakan password terbaru!",
                });
                setTimeout(
                function()
                {
                    window.location.href = "{{route('auth.login')}}";
                }, 2000);

            },
            error: function(response, error){
                $("#password").val('');
                $("#password_confirmation").val('');
                $("#password_confirmation" ).addClass('is-invalid');
                $("#passwordKonfirmasi_error" ).text('Password Konfirmasi tidak sesuai!');
                Swal.fire({
                    icon:  'error',
                    title: 'Failed!!',
                    text: "Harap dicek kemabli form input anda",
                });
            }
        });

    }

</script>

@endpush
