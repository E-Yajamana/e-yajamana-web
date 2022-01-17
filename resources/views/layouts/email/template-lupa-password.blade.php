<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUPA PASSWORD</title>
</head>
<body>
    <table style="width:100%;">
        <thead style="background: linear-gradient(to bottom, #ffffff 44%, #0000cc 200%);">
            <tr>
                <th style="text-align: center;">
                    <img src="{{ asset('logo-01.png') }}" alt="" style="width:50px;height:50px;">
                    <p style="margin: 0px;">
                        E-YAJAMANA <br>
                        <small style="font-size: 8px;font-style:normal;">SISTEM RESERVASI PEMUPUT KARYA</small>
                    </p>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center;">
                    @yield("email-content")
                </td>
            </tr>
        </tbody>
        <tfoot style="background: linear-gradient(to bottom, #0000cc -200%, #ffffff 74%);">
            <tr>
                <td style="font-size:8px;">
                    <p style="text-align: center;"><small>E-Yajamana 2021 | All Right Reserved &copy;</small></p>
                </td>
            </tr>
        </tfoot>
    </table>
</body>
</html>