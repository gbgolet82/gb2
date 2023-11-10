<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
    <title>Laporan Pemasukan</title>
    <link rel="icon" href="{{ public_path('gambar/gunabakti-logo.png') }}" />
</head>

<body>
    @php
        $selectedRole = session('selectedRole');
        $karyawanRoles = session('karyawanRoles');
    @endphp


    <div>
        <p
            style="margin-top:0pt; margin-bottom:8pt; margin-right:3pt; text-align:right; line-height:108%; font-size:20pt;">
            <span style="height:0pt; text-align:left; display:block; position:relative; z-index:0;">
                <img src="{{ public_path('logo/guna_bakti_logo.png') }}" width="317" height="92" alt=""
                    style="margin: 20px 0 0 auto; display: block;">
            </span>
            <strong><span style="font-family:'Times New Roman';">Laporan Pemasukan</span></strong>
        </p>

        <table cellspacing="0" cellpadding="0" style="margin-left:530pt; border-collapse:collapse;">
            <tbody>
                <tr>
                    <td style="width:60.1pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt;"><span
                                style="font-family:'Times New Roman';">Periode</span></p>
                    </td>
                    <td style="width:168pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top; ">
                        <p
                            style="margin-top:0pt; margin-bottom:0pt; text-align:right; font-size:12pt; margin-right:3pt;">
                            @if (($karyawanRoles->count() == 1 && $karyawanRoles->contains('kasir')) || $selectedRole == 'kasir')
                                <span style="font-family:'Times New Roman';">{{ $filterDate }}</span>
                            @else
                                <span style="font-family:'Times New Roman';">{{ $periode }}</span>
                            @endif
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="width:45pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt;"><span
                                style="font-family:'Times New Roman';">Unit Usaha</span></p>
                    </td>
                    <td style="width:168pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                        <p
                            style="margin-top:0pt; margin-bottom:0pt; text-align:right; font-size:12pt; margin-right:3pt;">
                            <span style="font-family:'Times New Roman';">{{ $selectedUsaha }}</span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="width:60.1pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt;"><span
                                style="font-family:'Times New Roman';">Akun</span></p>
                    </td>
                    <td style="width:168pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                        <p
                            style="margin-top:0pt; margin-bottom:0pt; text-align:right; font-size:12pt; margin-right:3pt;">
                            <span style="font-family:'Times New Roman';">{{ $selectedAkun }}</span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="width:60.1pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt;"><span
                                style="font-family:'Times New Roman';">Sub Akun 1</span></p>
                    </td>
                    <td style="width:168pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                        <p
                            style="margin-top:0pt; margin-bottom:0pt; text-align:right; font-size:12pt; margin-right:3pt;">
                            <span style="font-family:'Times New Roman';">{{ $selectedSubAkun }}</span>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr style="border: 1px solid black;">
        <div style="text-align: justify;">
            <strong style="float: left; font-family:'Times New Roman'; font-size:12pt;">Total Data : {{ $count }}
                Data</strong>
            <strong style="float: right; font-family:'Times New Roman'; font-size:12pt;">Total Pemasukan : Rp.
                {{ number_format($jumlah, 0, ',', '.') }}</strong>
        </div>
        <table cellspacing="0" cellpadding="0"
            style="width:775pt;  border:0.75pt solid #000000; border-collapse:collapse; margin-top:30pt">
            <tbody>
                <tr>
                    <td
                        style="width:16.5pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; background-color:#a8d08d;">
                        <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:11pt;"><strong><span
                                    style="font-family:'Times New Roman';">No</span></strong></p>
                    </td>
                    @if ($pemasukanBelumActive == false)
                        <td
                            style="width:60pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; background-color:#a8d08d;">
                            <p style="margin-top:5pt; margin-bottom:5pt; text-align:center; font-size:11pt;">
                                <strong><span style="font-family:'Times New Roman';">Kode Laporan</span></strong>
                            </p>
                        </td>
                        <td
                            style="width:70pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; background-color:#a8d08d;">
                            <p style="margin-top:5pt; margin-bottom:5pt; text-align:center; font-size:11pt;">
                                <strong><span style="font-family:'Times New Roman';">Tanggal Cek</span></strong>
                            </p>
                        </td>
                        <td
                            style="width:50pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; background-color:#a8d08d;">
                            <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:11pt;">
                                <strong><span style="font-family:'Times New Roman';">Tanggal Laporan</span></strong>
                            </p>
                        </td>
                        <td
                            style="width:50pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; background-color:#a8d08d;">
                            <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:11pt;">
                                <strong><span style="font-family:'Times New Roman';">Kasir</span></strong>
                            </p>
                        </td>
                        <td
                            style="width:50pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; background-color:#a8d08d;">
                            <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:11pt;">
                                <strong><span style="font-family:'Times New Roman';">Klasifikasi</span></strong>
                            </p>
                        </td>
                        <td
                            style="width:30pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; background-color:#a8d08d;">
                            <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:11pt;">
                                <strong><span style="font-family:'Times New Roman';">Usaha</span></strong>
                            </p>
                        </td>

                        <td
                            style="width:55pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; background-color:#a8d08d;">
                            <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:11pt;">
                                <strong><span style="font-family:'Times New Roman';">Akun</span></strong>
                            </p>
                        </td>
                    @else
                        <td
                            style="width:85pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; background-color:#a8d08d;">
                            <p style="margin-top:5pt; margin-bottom:5pt; text-align:center; font-size:11pt;">
                                <strong><span style="font-family:'Times New Roman';">Kode Laporan</span></strong>
                            </p>
                        </td>
                        <td
                            style="width:60pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; background-color:#a8d08d;">
                            <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:11pt;">
                                <strong><span style="font-family:'Times New Roman';">Tanggal</span></strong>
                            </p>
                        </td>
                        <td
                            style="width:60pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; background-color:#a8d08d;">
                            <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:11pt;">
                                <strong><span style="font-family:'Times New Roman';">Kasir</span></strong>
                            </p>
                        </td>
                        <td
                            style="width:65pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; background-color:#a8d08d;">
                            <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:11pt;">
                                <strong><span style="font-family:'Times New Roman';">Klasifikasi</span></strong>
                            </p>
                        </td>
                        <td
                            style="width:52.05pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; background-color:#a8d08d;">
                            <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:11pt;">
                                <strong><span style="font-family:'Times New Roman';">Usaha</span></strong>
                            </p>
                        </td>
                        <td
                            style="width:65pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; background-color:#a8d08d;">
                            <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:11pt;">
                                <strong><span style="font-family:'Times New Roman';">Akun</span></strong>
                            </p>
                        </td>
                    @endif
                    <td
                        style="width:60pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; background-color:#a8d08d;">
                        <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:11pt;"><strong><span
                                    style="font-family:'Times New Roman';">Sub Akun 1</span></strong></p>
                    </td>
                    <td
                        style="width:60pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; background-color:#a8d08d;">
                        <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:11pt;"><strong><span
                                    style="font-family:'Times New Roman';">Sub Akun 2</span></strong></p>
                    </td>
                    <td
                        style="width:60pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; background-color:#a8d08d;">
                        <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:11pt;"><strong><span
                                    style="font-family:'Times New Roman';">Sub Akun 3</span></strong></p>
                    </td>
                    <td
                        style="width:65pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; background-color:#a8d08d;">
                        <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:11pt;"><strong><span
                                    style="font-family:'Times New Roman';">Nominal</span></strong></p>
                    </td>
                </tr>
                @php
                    $noUrut = 1;
                @endphp
                @foreach ($data as $item)
                    <tr>
                        <td
                            style="width:16.5pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                            <p style="margin-top:5pt; margin-bottom:5pt; line-height:115%; font-size:11pt;"><span
                                    style="font-family:'Times New Roman';">{{ $noUrut++ }}.</span></p>
                        </td>
                        @if ($pemasukanBelumActive == false)
                            <td
                                style="width:60pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                                <p style="margin-top:5pt; margin-bottom:2pt; line-height:115%; font-size:11pt;"><span
                                        style="font-family:'Times New Roman';">{{ $item->kode_laporan }}</span>
                                <p style="margin-top:0pt; margin-bottom:3pt; line-height:115%; font-size:11pt;">
                                    @if ($item->status_cek == 'Sudah Dicek')
                                        <span>
                                            <strong style="font-size: 12px; color: #28a745"> {{ $item->status_cek }}
                                            </strong>
                                        </span>
                                    @else
                                        <span>
                                            <strong style="font-size: 12px; color: #fd7e14"> {{ $item->status_cek }}
                                            </strong>
                                        </span>
                                    @endif
                                </p>
                            </td>

                            <td
                                style="width:50pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                                <p style="margin-top:5pt; margin-bottom:0pt; line-height:115%; font-size:11pt;"><span
                                        style="font-family:'Times New Roman';">{{ \Carbon\Carbon::parse($item->tanggal_cek)->format('d/m/Y H:i:s') }}</span>
                                </p>
                                <p style="margin-top:0pt; margin-bottom:1pt; line-height:115%; font-size:11pt;">
                                    <span>
                                        <strong style="font-size: 12px;">{{ $item->nama_manager }}
                                        </strong>
                                    </span>
                                </p>
                            </td>
                            <td
                                style="width:50pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                                <p style="margin-top:5pt; margin-bottom:5pt; line-height:115%; font-size:11pt;"><span
                                        style="font-family:'Times New Roman';">{{ \Carbon\Carbon::parse($item->tanggal_laporan)->format('d/m/Y H:i:s') }}</span>
                                </p>
                            </td>
                            <td
                                style="width:52.95pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                                <p style="margin-top:5pt; margin-bottom:5pt; line-height:115%; font-size:11pt;"><span
                                        style="font-family:'Times New Roman';">{{ $item->nama_kasir }}</span></p>
                            </td>
                            <td
                                style="width:50pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                                <p style="margin-top:5pt; margin-bottom:5pt; line-height:115%; font-size:11pt;"><span
                                        style="font-family:'Times New Roman';">{{ $item->klasifikasi }}</span></p>
                            </td>
                            <td
                                style="width:30pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                                <p style="margin-top:5pt; margin-bottom:5pt; line-height:115%; font-size:11pt;"><span
                                        style="font-family:'Times New Roman';">{{ $item->usaha }}</span></p>
                            </td>
                            <td
                                style="width:51.7pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                                <p style="margin-top:5pt; margin-bottom:5pt; line-height:115%; font-size:11pt;"><span
                                        style="font-family:'Times New Roman';">{{ $item->akun }}</span></p>
                            </td>
                        @else
                            <td
                                style="width:60pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                                <p style="margin-top:5pt; margin-bottom:2pt; line-height:115%; font-size:11pt;"><span
                                        style="font-family:'Times New Roman';">{{ $item->kode_laporan }}</span>
                                <p style="margin-top:0pt; margin-bottom:3pt; line-height:115%; font-size:11pt;">
                                    @if ($item->status_cek == 'Sudah Dicek')
                                        <span>
                                            <strong style="font-size: 12px; color: #28a745"> {{ $item->status_cek }}
                                            </strong>
                                        </span>
                                    @else
                                        <span>
                                            <strong style="font-size: 12px; color: #fd7e14"> {{ $item->status_cek }}
                                            </strong>
                                        </span>
                                    @endif
                                </p>
                            </td>
                            <td
                                style="width:54.2pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                                <p style="margin-top:5pt; margin-bottom:5pt; line-height:115%; font-size:11pt;"><span
                                        style="font-family:'Times New Roman';">{{ \Carbon\Carbon::parse($item->tanggal_laporan)->format('d/m/Y H:i:s') }}</span>
                                </p>
                            </td>
                            <td
                                style="width:52.95pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                                <p style="margin-top:5pt; margin-bottom:5pt; line-height:115%; font-size:11pt;"><span
                                        style="font-family:'Times New Roman';">{{ $item->nama_kasir }}</span></p>
                            </td>
                            <td
                                style="width:57.45pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                                <p style="margin-top:5pt; margin-bottom:5pt; line-height:115%; font-size:11pt;"><span
                                        style="font-family:'Times New Roman';">{{ $item->klasifikasi }}</span></p>
                            </td>
                            <td
                                style="width:52.05pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                                <p style="margin-top:5pt; margin-bottom:5pt; line-height:115%; font-size:11pt;"><span
                                        style="font-family:'Times New Roman';">{{ $item->usaha }}</span></p>
                            </td>
                            <td
                                style="width:51.7pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                                <p style="margin-top:5pt; margin-bottom:5pt; line-height:115%; font-size:11pt;"><span
                                        style="font-family:'Times New Roman';">{{ $item->akun }}</span></p>
                            </td>
                        @endif

                        <td
                            style="width:52.45pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                            <p style="margin-top:5pt; margin-bottom:5pt; line-height:115%; font-size:11pt;"><span
                                    style="font-family:'Times New Roman';">{{ $item->sub_akun_1 ?? '-' }}</span></p>
                        </td>
                        <td
                            style="width:51.25pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                            <p style="margin-top:5pt; margin-bottom:5pt; line-height:115%; font-size:11pt;"><span
                                    style="font-family:'Times New Roman';">{{ $item->sub_akun_2 ?? '-' }}</span></p>
                        </td>
                        <td
                            style="width:51.25pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                            <p style="margin-top:5pt; margin-bottom:5pt; line-height:115%; font-size:11pt;"><span
                                    style="font-family:'Times New Roman';">{{ $item->sub_akun_3 ?? '-' }}</span></p>
                        </td>
                        <td
                            style="width:57pt; border-top-style:solid; border-top-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                            <p style="margin-top:5pt; margin-bottom:5pt; line-height:115%; font-size:11pt;"><span
                                    style="font-family:'Times New Roman';">Rp.
                                    {{ number_format($item->nominal, 0, ',', '.') }}</span></p>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p style="margin-top:0pt; margin-bottom:8pt; text-align:center;"><strong><span
                    style="font-family:'Times New Roman';">&nbsp;</span></strong></p>
    </div>
</body>

</html>
