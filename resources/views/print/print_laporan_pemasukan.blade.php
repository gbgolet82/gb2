<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LAPORAN PEMASUKAN</title>
</head>

<body>
    &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; <img
        src="{{ asset('logo/logogb.png') }}" width="60px"><br>
    <br>
    <span style="font-size: 18px;">&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <b>UD GUNA BAKTI</b></span>
    {{-- &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Unit Usaha :GB2</b> --}}
    <br><br>
    &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; LAPORAN PEMASUKAN
    <br>
    &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;  &nbsp;&nbsp; &nbsp;P20231027003 <br>
    &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;21/09/2023 15:51:30
    <br>
    -------------------------------------------------------
    <br>
    Kasir : Zharoh Khoerunisa &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
    &nbsp;GB2
    <br>
    -------------------------------------------------------
    <br>
    Klasifikasi &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; : Pemasukan
    <br>
    Akun &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; : Asvalue
    <br>
    Sub Akun 1 &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; : Penjualan Tunai
    <br>
    Sub Akun 2 &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; : -
    <br>
    Sub Akun 3 &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; : -
    <br>
    Status &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; : <b>Belum Dicek</b>
    <br>
    -------------------------------------------------------

    <br>
    <span style="font-size: 16px;"><b>Nominal : Rp. 1.000</b></span>
    <br>

    -------------------------------------------------------
    <br>
    <?php
    // Mengatur zona waktu menjadi zona yang diinginkan (misalnya, 'Asia/Jakarta')
    date_default_timezone_set('Asia/Jakarta');
    
    // Mendapatkan waktu saat ini
    $currentDateTime = date('d/m/Y H:i:s');
    $dibuat = $laporan->created_at;
    $formattedDate = date('d/m/Y H:i:s', strtotime($dibuat));
    
    ?>
    &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;Dicetak {{ $currentDateTime }}
    <br>
    &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;Terimakasih
    <br>
    &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; UD Guna Bakti
    <br>

</body>

</html>
