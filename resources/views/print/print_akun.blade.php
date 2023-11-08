<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data->usaha . ' - ' . $data->kode_laporan . '.pdf' }}</title>
</head>

<body>
    <div style="float: right">
        <h2>Akun & Sub Akun</h2>
    </div>
    <br><br><br>
    <table width=100%>
        <tr>
            <td style="width:30%" rowspan="3"> <img width="250px;" src="{{ public_path('logo/guna_bakti_logo.png') }}">
            </td>
            <td style="width:10%"></td>

            <td style="width:10%"></td>
            <td style="width:20%">Kode Laporan</td>
            <td style="width:30%;text-align:right;">{{ $data->kode_laporan }}</td>
        </tr>

        <tr>

            <td style="width:10%"></td>

            <td style="width:10%"></td>

            <td style="width:20%">Tanggal</td>
            <td style="width:20%; text-align:right;">{{ $tanggal_laporan }}</td>
        </tr>

        <tr>

            <td style="width:10%"></td>

            <td style="width:10%"></td>

            <td style="width:20%">Status</td>

            <td style="width:20%;text-align:right;">
                @if ($data->status_cek == 'Sudah Dicek')
                    <span style="background-color: green; color: white; padding: 5px; border-radius: 4px;">
                        <b style="font-size: 14px;"> {{ $data->status_cek }} </b>
                    </span>
                @else
                    <span style="background-color: rgb(255, 157, 0); color: white; padding: 5px; border-radius: 4px;">
                        <b style="font-size: 14px;"> {{ $data->status_cek }} </b>
                    </span>
                @endif

            </td>
        </tr>

        <tr>
            <td colspan="2">
                <b>
                    {{-- <hr style="border: 1px solid black;"> --}}


                </b>
            </td>
            <td></td>
            <td colspan="3">
                <b>
                    {{-- <hr style="border: 1px solid black;"> --}}


                </b>
            </td>
        </tr>

        <tr>
            <td colspan="6">
                <hr style="border: 1px solid black;">

            </td>
        </tr>
    </table>


    <br>

    <table style="width: 100%">
        <tr>
            <td style="width: 50%">Kasir&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
                {{ $data->nama_kasir }}</td>
            <td></td>
        </tr>

        <tr>
            <td>Unit Usaha&nbsp; : {{ $data->usaha }}</td>
            <td></td>
        </tr>
    </table>

    <h4>Detail Laporan </h4>

    <table style="width: 100%; ">
        <tr style="background-color: rgb(0, 90, 128), 102, 128;padding:10px;">
            <td><b style="color: white">Klasifikasi</b></td>
            <td><b style="color: white">Akun</b></td>
            <td><b style="color: white">Sub Akun 1</b></td>
            @if ($data->sub_akun_2)
                <td><b style="color: white">Sub Akun 2</b></td>
            @endif

            @if ($data->sub_akun_3)
                <td><b style="color: white">Sub Akun 3</b></td>
            @endif
        </tr>

        <tr style="background-color: rgb(175, 191, 198), 102, 128 ;padding:10px;">
            <td>{{ $data->klasifikasi }}
            </td>
            <td> {{ $data->akun }}</td>
            <td>{{ $data->sub_akun_1 ?? '-' }}</td>
            @if ($data->sub_akun_2)
                <td>{{ $data->sub_akun_2 ?? '-' }}</td>
            @endif
            @if ($data->sub_akun_3)
                <td>{{ $data->sub_akun_3 ?? '-' }}</td>
            @endif
        </tr>
    </table>

    <br><br>
    <table style="width: 100%" >
        <tr>
            <td style="width: 45%"></td>
            <td style="width: 15%">
                Nominal <br>
                Terbilang
            </td>
            <td  style="width: 1%">
                : <br>
                :
            </td>
            <td style="text-align: right"><b> Rp. {{ number_format($data->nominal, 0, ',', '.') }}</b> <br>
                {{ ucfirst(terbilang($data->nominal)) }}  Rupiah
            </td>
        </tr>

    </table>


</body>

</html>
