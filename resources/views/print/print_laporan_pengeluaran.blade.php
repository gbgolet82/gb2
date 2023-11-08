<?php
// Mengatur zona waktu menjadi zona yang diinginkan (misalnya, 'Asia/Jakarta')
date_default_timezone_set('Asia/Jakarta');

// Mendapatkan waktu saat ini
$currentDateTime = date('d/m/Y H:i:s');
$dibuat = $laporan->created_at;
$formattedDate = date('d/m/Y H:i:s', strtotime($dibuat));
$tanggal_laporan = date('d/m/Y H:i:s', strtotime($data->tanggal_laporan));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LAPORAN PENGELUARAN</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <br>
    <table width=" 332.64px">


        <tr>
            <td colspan="4">
                <center><img src="{{ asset('logo/logogb.png') }}" width="60px"></center>

            </td>
        </tr>

        <tr>
            <td colspan="4">
                <center>
                    <span style="font-size: 18px;">
                        <b>UD
                            GUNA
                            BAKTI</b>
                    </span>
                </center>
            </td>
        </tr>

        <tr>
            <td colspan="4">
                <center>
                    <br>
                    LAPORAN PENGELUARAN
                    <br>
                    {{ $data->kode_laporan }}
                    <br>
                    {{ $tanggal_laporan }}
                    <br>
                    ---------------------------------------------------
                </center>
            </td>
        </tr>

        <tr>
            <td>Kasir</td>
            <td>:</td>
            <td>{{ $data->nama_kasir }}</td>
            <td>{{ $data->usaha }}</td>

        </tr>

        <tr>
            <center>
                <td colspan="4">
                    ---------------------------------------------------
                </td>
            </center>
        </tr>

        <tr>
            <center>
                <td>Klasifikasi</td>
                <td>:</td>
                <td colspan="2">{{ $data->klasifikasi }}</td>
            </center>
        </tr>

        <tr>
            <center>
                <td>Akun</td>
                <td>:</td>
                <td colspan="2">{{ $data->akun }}</td>
            </center>
        </tr>

        <tr>
            <center>
                <td>Sub Akun 1</td>
                <td>:</td>
                <td colspan="2">{{ $data->sub_akun_1 ?? '-' }}</td>
            </center>
        </tr>

        <tr>
            <center>
                <td>Sub Akun 2</td>
                <td>:</td>
                <td colspan="2">{{ $data->sub_akun_2 ?? '-' }}</td>
            </center>
        </tr>

        <tr>
            <center>
                <td>Sub Akun 3</td>
                <td>:</td>
                <td colspan="2">{{ $data->sub_akun_3 ?? '-' }}</td>
            </center>
        </tr>

        <tr>
            <center>
                <td>Status</td>
                <td>:</td>
                <td colspan="2"><b>{{ $data->status_cek }}</b></td>
            </center>
        </tr>


        <tr>
            <center>
                <td colspan="4">
                    ---------------------------------------------------
                </td>
            </center>
        </tr>


        <tr>
            <td colspan="4">

                <b>Nominal : Rp. {{ number_format($data->nominal, 0, ',', '.') }}</b>

            </td>
        </tr>

        <tr>
            <td colspan="4">
                <center>
                    ---------------------------------------------------
                </center>
            </td>
        </tr>


        <tr>
            <td colspan="4">
                <center>
                    Dicetak {{ $currentDateTime }}
                </center>
            </td>
        </tr>

        <tr>
            <td colspan="4">
                <center>
                    Terimakasih
                </center>
            </td>
        </tr>

        <tr>

            <td colspan="4">
                <center>
                    UD Guna Bakti
                </center>
            </td>

        </tr>

        <tr>
            <td colspan="3">
                <br>
                <center>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-success"
                        id="printButton">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                </center>
            </td>
        </tr>
        </tbody>
    </table>

    <br>

    <style>
        @media print {
            #printButton {
                display: none;
            }
        }
    </style>

    <script>
        // Fungsi untuk menjalankan pencetakan otomatis
        function autoPrint() {
            // Mencetak halaman saat tombol ditekan
            window.print();
        }

        // Menambahkan event listener ke tombol
        const printButton = document.getElementById("printButton");
        printButton.addEventListener("click", autoPrint);
    </script>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
