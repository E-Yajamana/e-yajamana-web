$('#kabupaten').on('change', function () {
    var kabupatenID = $(this).val();
    if (kabupatenID) {
        $.ajax({
            url: '/ajax/kecamatan/' + kabupatenID,
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function (dataKecamatan) {

                if (dataKecamatan.data.kecamatans.length != 0) {
                    $('#kecamatan').empty();
                    $('#desa_dinas').empty();
                    $('#id_banjar_dinas').empty();
                    $('#desa_dinas').append('<option value="0" selected>Pilih Desa Dinas</option>');
                    $('#id_banjar_dinas').append('<option value="0" selected>Pilih Banjar Dinas</option>');
                    $('#kecamatan').append('<option value="0" selected>Pilih Kecamatan</option>');
                    $.each(dataKecamatan.data.kecamatans, function (key, data) {
                        $('#kecamatan').append('<option value="' + data.id + '">' + data.name + '</option>');
                    });
                } else {
                    $('#kecamatan').empty();
                    $('#kecamatan').append('<option value="0" selected>Pilih Kecamatan</option>');
                }
            }
        })
    }
})

$('#kecamatan').on('change', function () {
    var kecamatanID = $(this).val();
    if (kecamatanID) {
        $.ajax({
            url: '/ajax/desa/' + kecamatanID,
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function (dataDesa) {

                if (dataDesa.data.desas) {
                    $('#desa_dinas').empty();
                    $('#id_banjar_dinas').empty();
                    $('#desa_dinas').append('<option value="0" selected>Pilih Desa Dinas</option>');
                    $('#id_banjar_dinas').append('<option value="0" selected>Pilih Banjar Dinas</option>');
                    $.each(dataDesa.data.desas, function (key, data) {
                        $('#desa_dinas').append('<option value="' + data.id + '">' + data.name + '</option>');
                    });
                } else {
                    $('#desa_dinas').empty();
                    $('#desa_dinas').append('<option value="0 selected>Pilih Desa Dinas</option>');
                }
            }
        })
    }
})

$('#desa_dinas').on('change', function () {
    var desaDinas = $(this).val();
    if (desaDinas) {
        $.ajax({
            url: "/ajax/banjar-dinas/" + desaDinas,
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function (dataBanjar) {
                if (dataBanjar.data.banjar.length != 0) {
                    $('#id_banjar_dinas').empty();
                    $('#id_banjar_dinas').append('<option value="0" selected>Pilih Banjar Dinas</option>');
                    $.each(dataBanjar.data.banjar, function (key, data) {
                        $('#id_banjar_dinas').append('<option value="' + data.id + '">' + data.nama_banjar_dinas + '</option>');
                    });
                } else {
                    $('#id_banjar_dinas').empty();
                    $('#id_banjar_dinas').append('<option value="0" selected>Belum terdapat banjar dinas pada Desa tersebut!</option>');
                }
            }
        })
    }
})
