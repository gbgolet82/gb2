@extends('main')

@section('dashboard', 'active')


@section('content')
    <style>
        @media (max-width: 768px) {

            /* Perubahan untuk tampilan mobile */
            .col-md-3 {
                width: 100%;
                /* Membuat elemen dengan kelas col-md-3 menjadi lebar penuh pada tampilan mobile */
                margin-bottom: 10px;
                /* Memberikan margin bawah untuk elemen dengan kelas col-md-3 pada tampilan mobile */
            }

            .icon-input {
                min-width: 100%;
                /* Memperbesar lebar input field pada tampilan mobile */
                height: 37.5px;
                /* Mengatur tinggi input field pada tampilan mobile */
            }

            .btn {
                width: 100%;
                /* Membuat tombol menjadi lebar penuh pada tampilan mobile */
            }
        }
    </style>

    <!-- Content Header (Page header) -->
    <style>
        .badge-kuning {
            /* position: relative; */
            font-size: 14px;
            padding: 3px 5px;
            font-size: 14px;
            border-radius: 6px;
            background-color: #fd7e14;
            color: #fff;
        }

        td[data-toggle="modal"] {
            cursor: pointer;
        }

        <blade media|%20(max-width%3A%20820px)%20%7B%0D>.hidden {
            display: none !important;
        }
    </style>

    @php
        $selectedRole = session('selectedRole');
        $karyawanRoles = session('karyawanRoles');
        // dd($selectedRole);
    @endphp

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item text-secondary">
                            Dashboard
                        </li>
                        <li class="breadcrumb-item active">Pemasukan</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-secondary">
                            {{ Carbon\Carbon::now()->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-success mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-2 mt-3 text-center">
                                    <strong class="font-weight-bold">
                                        <h4 style="color:#28a745;">LAPORAN PEMASUKAN</h4>
                                    </strong>
                                </div>

                                @php
                                    $session = session('nama_usaha');
                                    // dd($session);
                                @endphp

                                <div class="col-10 mx-auto">
                                    <div class="card col-12">
                                        <div class="card-body p-3">

                                            <div class="row">
                                                @if (
                                                    ($karyawanRoles->count() == 1 && !$karyawanRoles->contains('kasir')) ||
                                                        (isset($selectedRole) && $selectedRole != 'kasir'))
                                                    <div class="col-12 col-md-3 mb-2">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <select class="custom-select" name="bulan" id="Bulan">
                                                                    <option disabled selected hidden>Bulan</option>
                                                                    <option value="Semua">Semua</option>
                                                                    <option value="01">Januari</option>
                                                                    <option value="02">Februari</option>
                                                                    <option value="03">Maret</option>
                                                                    <option value="04">April</option>
                                                                    <option value="05">Mei</option>
                                                                    <option value="06">Juni</option>
                                                                    <option value="07">Juli</option>
                                                                    <option value="08">Agustus</option>
                                                                    <option value="09">September</option>
                                                                    <option value="10">Oktober</option>
                                                                    <option value="11">November</option>
                                                                    <option value="12">Desember</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-6">
                                                                <select class="custom-select" name="tahun" id="Tahun">
                                                                    <option value="Semua">Semua</option>
                                                                    <option disabled selected hidden>Tahun</option>
                                                                    @foreach ($tahun_get as $th)
                                                                        <option value="{{ $th->tahun }}">
                                                                            {{ $th->tahun }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- filter owner --}}
                                                @if (
                                                    (($karyawanRoles->count() == 1 && $karyawanRoles->contains('kasir')) || $selectedRole == 'kasir') &&
                                                        $session != 'SEMUA')
                                                    {{-- filter selain owner --}}
                                                    <div class="col-12 col-md-3 mb-2">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" for="usaha"
                                                                    style="width: 100px; text-align: center; display: block;">Usaha</span>
                                                            </div>
                                                            <select class="custom-select" id="usaha" name="usaha">
                                                                <option value="{{ session('nama_usaha') }}" selected>
                                                                    {{ session('nama_usaha') }}</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-3 mb-2">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" for="akun"
                                                                    style="width: 100px; text-align: center; display: block;">Akun</span>
                                                            </div>
                                                            <select class="custom-select" id="inputAkun" name="akun">
                                                                <option value="Semua" selected>Semua Data</option>
                                                                @foreach ($akunOptions as $dataAkun)
                                                                    <option value="{{ $dataAkun->akun }}"
                                                                        @if ($dataAkun->akun === 'Semua') selected @endif>
                                                                        {{ $dataAkun->akun }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3 mb-2">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" for="sub_akun_1"
                                                                    style="width: 100px; text-align: center; display: block;">Sub
                                                                    Akun
                                                                    1</span>
                                                            </div>
                                                            <select class="custom-select" id="inputSub" name="sub_akun_1">
                                                                <option value="Semua" selected>Semua Data</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-12 col-md-3 mb-2">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" for="usaha"
                                                                    style="width: 100px; text-align: center; display: block;">Usaha</span>
                                                            </div>
                                                            <select class="custom-select" id="namaUsaha" name="usaha">
                                                                <option value="Semua" selected>Semua Data</option>
                                                                @foreach ($usahaOption as $dataUsaha)
                                                                    <option value="{{ $dataUsaha->nama_usaha }}"
                                                                        @if ($dataUsaha->nama_usaha === 'Semua') selected @endif>
                                                                        {{ $dataUsaha->nama_usaha }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" for="akun"
                                                                    style="width: 100px; text-align: center; display: block;">Akun</span>
                                                            </div>
                                                            <select class="custom-select" id="namaAkun" name="akun">
                                                                <option value="Semua" selected>Semua Data</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" for="sub_akun_1"
                                                                    style="width: 100px; text-align: center; display: block;">Sub
                                                                    Akun
                                                                    1</span>
                                                            </div>
                                                            <select class="custom-select" id="namaSub"
                                                                name="sub_akun_1">
                                                                <option value="Semua" selected>Semua Data</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- muncul ketika pemasukan belum dicek --}}
                                                @if ($pemasukanBelumActive == true)
                                                    <div class="col-12 col-md-3">
                                                        {{-- <div class="d-flex flex-wrap"> --}}
                                                        {{-- button tambah role kasir --}}
                                                        @if (($karyawanRoles->count() == 1 && $karyawanRoles->contains('kasir')) || $selectedRole == 'kasir')
                                                            {{-- <div class="col-12 col-md-3"> --}}
                                                            <!-- Adjust the width as needed -->
                                                            <button class="btn text-white w-100"
                                                                style="background-color: #28a745; border-radius: 10px;"
                                                                type="button" data-toggle="modal"
                                                                data-target="#tambahData" aria-expanded="false">
                                                                <i class="fas fa-plus-circle left-icon-holder"></i>
                                                                Tambah
                                                            </button>
                                                        @endif
                                                        {{-- </div> --}}
                                                    </div>
                                                @endif
                                            </div>



                                            <div class="row">
                                                <div class="col-12 col-md-6 mb-2 mb-md-0 align-self-center">
                                                    <span style="font-size: 16px;"><i class="fas fa-info-circle"></i>
                                                        Klik Kode Laporan untuk
                                                        melihat detail</span>
                                                </div>
                                                <div class="col-12 col-md-3 ml-auto">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <form id="cetakForm" action="{{ route('cetak.laporan') }}"
                                                                target="_blank" method="POST">
                                                                @csrf
                                                                @if (
                                                                    ($karyawanRoles->count() == 1 && !$karyawanRoles->contains('kasir')) ||
                                                                        (isset($selectedRole) && $selectedRole != 'kasir'))
                                                                    <input type="hidden" id="filter_bulan_hidden"
                                                                        name="filter_bulan">
                                                                    <input type="hidden" id="filter_tahun_hidden"
                                                                        name="filter_tahun">
                                                                @endif
                                                                <input type="hidden" id="usaha_hidden" name="usaha">
                                                                <input type="hidden" id="akun_hidden" name="akun">
                                                                <input type="hidden" id="sub_akun_1_hidden"
                                                                    name="sub_akun_1">
                                                                @if (
                                                                    (($karyawanRoles->count() == 1 && $karyawanRoles->contains('kasir')) || $selectedRole == 'kasir') &&
                                                                        $session != 'SEMUA')
                                                                    <button class="btn btn-outline-danger"
                                                                        style="border-radius: 10px; width: 100%;"
                                                                        type="submit" aria-expanded="false"
                                                                        onclick="simpanForm()">
                                                                        <i class="fas fa-file-pdf"></i> Pdf
                                                                    </button>
                                                                @else
                                                                    <button class="btn btn-outline-danger"
                                                                        style="border-radius: 10px; width: 100%;"
                                                                        type="submit" aria-expanded="false"
                                                                        onclick="submitForm()">
                                                                        <i class="fas fa-file-pdf"></i> Pdf
                                                                    </button>
                                                                @endif
                                                            </form>
                                                        </div>
                                                        <div class="col-6">
                                                            @if ($pemasukanBelumActive == true)
                                                                <button id="exportButtonPemasukanBelum"
                                                                    class="btn btn-outline-success"
                                                                    style="border-radius: 10px; width:100%"
                                                                    type="button">
                                                                    <i class="fas fa-file-excel"></i> Export
                                                                </button>
                                                            @else
                                                                <button id="exportButtonPemasukanAcc"
                                                                    class="btn btn-outline-success"
                                                                    style="border-radius: 10px; width:100%"
                                                                    type="button">
                                                                    <i class="fas fa-file-excel"></i> Export
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- modal tambah data kalo menu pemasukan belum dicek & role kasir --}}
                            @if ($pemasukanBelumActive == true)
                                @if (($karyawanRoles->count() == 1 && $karyawanRoles->contains('kasir')) || $selectedRole == 'kasir')
                                    <div class="modal fade" id="tambahData" data-backdrop="static" data-keyboard="false"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true"
                                        data-target="#staticBackdrop">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">
                                                        Tambah Data Pemasukan
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close" id="reset">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                @include('modals.tambah-pemasukan')
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Kode Laporan</th>
                                        <th>Tanggal</th>
                                        <th>Kasir</th>
                                        <th>Klasifikasi</th>
                                        <th>Usaha</th>
                                        <th>Akun</th>
                                        <th>Sub Akun 1</th>
                                        <th>Sub Akun 2</th>
                                        <th>Sub Akun 3</th>
                                        <th>Nominal</th>
                                        <th>Gambar Bukti</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $noUrut = 1;
                                        if ($pemasukanBelumActive == true) {
                                            $warna = 'kuning';
                                        } else {
                                            $warna = 'success';
                                        }
                                    @endphp
                                    @foreach ($data as $pemasukan)
                                        <tr>

                                            <td>{{ $noUrut++ }}</td>
                                            <td style="10%"><a href="#" class="text-black font-weight-bold"
                                                    style="color: #212529;" data-toggle="modal"
                                                    data-target="#lihatPemasukan{{ $pemasukan->id_laporan }}">
                                                    {{ $pemasukan->kode_laporan }}
                                                </a>
                                                <br>
                                                <span class="text-white badge badge-{{ $warna }}"
                                                    style="font-size: 12px; border-radius: 10px;">{{ $pemasukan->status_cek }}</span>

                                            </td>
                                            <td style="12%">
                                                {{ \Carbon\Carbon::parse($pemasukan->tanggal_laporan)->format('d/m/Y H:i:s') }}
                                                {{-- {{ \Carbon\Carbon::parse($pemasukan->tanggal_laporan)->format('d/m/Y H:i:s') }} --}}
                                            </td>
                                            <td style="15%">{{ $pemasukan->nama_kasir }}</td>
                                            <td style="15%">{{ $pemasukan->klasifikasi }}</td>
                                            <td style="12%">{{ $pemasukan->usaha }}</td>
                                            <td style="15%">{{ $pemasukan->akun }}</td>
                                            <td style="18%">{{ $pemasukan->sub_akun_1 ?? '-' }}</td>
                                            <td style="18%">{{ $pemasukan->sub_akun_2 ?? '-' }}</td>
                                            <td style="18%">{{ $pemasukan->sub_akun_3 ?? '-' }}</td>
                                            <td style="15%">Rp. {{ number_format($pemasukan->nominal, 0, ',', '.') }}
                                            </td>
                                            <td style="10%"><a class="text-primary"
                                                    href="{{ asset('nota/' . $pemasukan->gambar_bukti) }}"
                                                    target="_blank">Lihat</a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @foreach ($data as $pemasukan)
                                <div class="modal fade" id="lihatPemasukan{{ $pemasukan->id_laporan }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
                                    data-backdrop="static">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                    Data Laporan Pemasukan
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close" id="reset">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            @include('modals.detail-pemasukan')
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if (
                        (($karyawanRoles->count() == 1 && $karyawanRoles->contains('owner')) || $selectedRole == 'owner') &&
                            $pemasukanBelumActive == false)
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h5>Grafik Pemasukan Berdasarkan Usaha</h5>
                                            </div>
                                            <div>
                                                <span id="periodeUsaha" class="text-center"
                                                    style="font-size: 14px"></span>
                                            </div>
                                        </div>
                                        <div class="chart-container">
                                            <canvas id="lineChart" style="width: 100%; height: 300px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <!-- Untuk layar kecil (mobile) akan menempati seluruh lebar -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h5>Grafik Pemasukan Berdasarkan Akun</h5>
                                            </div>
                                            <div>
                                                <span id="periodeAkun" class="text-center"
                                                    style="font-size: 14px"></span>
                                            </div>
                                        </div>
                                        <div class="chart-container">
                                            <canvas id="lineChart1" style="width: 100%; height: 300px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            // Simpan instance DataTable dalam variabel
            var table = $('#example2').DataTable();
            // Tangani perubahan nilai pada select bulan dan tahun
            $('select[name="bulan"]').change(function() {
                var bulan = $('select[name="bulan"]').val();
                var filterBulan = '/' + bulan + '/';

                if (bulan === 'Semua') {
                    // Clear the Akun filter
                    table.columns(2).search('').draw();
                } else {
                    table.columns(2).search(filterBulan).draw();
                }
            });

            $('select[name="tahun"]').change(function() {
                var tahun = $('select[name="tahun"]').val();
                var filterTahun = tahun;

                if (tahun === 'Semua') {
                    // Clear the Akun filter
                    table.columns(2).search('').draw();
                } else {
                    table.columns(2).search(filterTahun).draw();
                }
            });
        });
    </script>

    <script>
        function submitForm() {
            @php
                $selectedRole = session('selectedRole');
                $karyawanRoles = session('karyawanRoles');
            @endphp

            @if (
                ($karyawanRoles->count() == 1 && !$karyawanRoles->contains('kasir')) ||
                    (isset($selectedRole) && $selectedRole != 'kasir'))
                var filterBulan = document.getElementById('Bulan').value;
                document.getElementById('filter_bulan_hidden').value = filterBulan;
                var filterTahun = document.getElementById('Tahun').value;
                document.getElementById('filter_tahun_hidden').value = filterTahun;
            @endif
            var selectedUsaha = document.getElementById('namaUsaha').value;
            var selectedAkun = document.getElementById('namaAkun').value;
            var selectedSubAkun = document.getElementById('namaSub').value;

            // Assigning the values to hidden input fields within the form

            document.getElementById('usaha_hidden').value = selectedUsaha;
            document.getElementById('akun_hidden').value = selectedAkun;
            document.getElementById('sub_akun_1_hidden').value = selectedSubAkun;

            // Submit the form
            document.getElementById('cetakForm').submit();

        }

        function simpanForm() {
            var selectedUsaha = document.getElementById('usaha').value;
            var selectedAkun = document.getElementById('inputAkun').value;
            var selectedSubAkun = document.getElementById('inputSub').value;

            // Assigning the values to hidden input fields within the form
            document.getElementById('usaha_hidden').value = selectedUsaha;
            document.getElementById('akun_hidden').value = selectedAkun;
            document.getElementById('sub_akun_1_hidden').value = selectedSubAkun;

            // Submit the form
            document.getElementById('cetakForm').submit();

        }
    </script>

    <script>
        $(document).ready(function() {
            $('#inputAkun').change(function() {
                var selectedAkunId = $(this).val();

                // console.log(selectedAkunId);

                // Lakukan permintaan AJAX ke endpoint yang mengembalikan opsi sub akun 1 berdasarkan id_akun yang dipilih.
                $.ajax({
                    url: '/get-sub-akun-1-options/' + selectedAkunId,
                    type: 'GET',
                    success: function(data) {
                        // Perbarui opsi sub akun 1 dengan data yang diterima dari server.
                        $('#inputSub').empty();
                        $('#inputSub').append($('<option>', {
                            value: 'Semua',
                            text: 'Semua Data'
                        }));
                        $.each(data, function(key, value) {
                            // console.log(key);
                            $('#inputSub').append($('<option>', {
                                value: key,
                                text: value
                            }));
                        });
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#namaUsaha').change(function() {
                var selectedUsahaId = $(this).val();

                console.log(selectedUsahaId);

                // Lakukan permintaan AJAX ke endpoint yang mengembalikan opsi sub akun 1 berdasarkan id_akun yang dipilih.
                $.ajax({
                    url: '/get-akun-filter/' + selectedUsahaId,
                    type: 'GET',
                    success: function(data) {
                        // Perbarui opsi sub akun 1 dengan data yang diterima dari server.
                        $('#namaAkun').empty();
                        $('#namaAkun').append($('<option>', {
                            value: 'Semua',
                            text: 'Semua Data'
                        }));
                        $.each(data, function(key, value) {
                            // console.log(key);
                            $('#namaAkun').append($('<option>', {
                                value: key,
                                text: value
                            }));
                        });
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#namaAkun').change(function() {
                var selectedAkun = $(this).val();

                console.log(selectedAkun);

                // Lakukan permintaan AJAX ke endpoint yang mengembalikan opsi sub akun 1 berdasarkan id_akun yang dipilih.
                $.ajax({
                    url: '/get-sub1-filter/' + selectedAkun,
                    type: 'GET',
                    success: function(data) {
                        // Perbarui opsi sub akun 1 dengan data yang diterima dari server.
                        $('#namaSub').empty();
                        $('#namaSub').append($('<option>', {
                            value: 'Semua',
                            text: 'Semua Data'
                        }));
                        $.each(data, function(key, value) {
                            // console.log(key);
                            $('#namaSub').append($('<option>', {
                                value: key,
                                text: value
                            }));
                        });
                    }
                });
            });
        });
    </script>

    <script>
        // Memasukkan kode di dalam fungsi ready
        $(document).ready(function() {
            var table = $('#example2').DataTable();
            var akunSelect = $('#inputAkun');
            var subSelect = $('#inputSub');

            // Handle filter change for Akun
            akunSelect.on('change', function() {
                var selectedAkun = $(this).val();
                if (selectedAkun === 'Semua') {
                    // Clear the Akun filter
                    table.columns(6).search('').draw();

                    // Clear the Sub Akun filter as well
                    subSelect.val('Semua').trigger('change');
                } else {
                    table.columns(6).search(selectedAkun).draw();
                }
            });

            // Handle filter change for Sub Akun
            subSelect.on('change', function() {
                var selectedSub = $(this).val();
                if (selectedSub === 'Semua') {
                    // Clear the Sub Akun filter
                    table.columns(7).search('').draw();
                } else {
                    table.columns(7).search(selectedSub).draw();
                }
            });

            // Initially trigger the change event for Akun and Sub Akun filters
            akunSelect.trigger('change');
            subSelect.trigger('change');
        });
    </script>

    <script>
        // Memasukkan kode di dalam fungsi ready
        $(document).ready(function() {
            var table = $('#example2').DataTable();
            var usahaSelect = $('#namaUsaha');
            var akunSelect = $('#namaAkun');
            var subSelect = $('#namaSub');

            // Handle filter change for Akun
            usahaSelect.on('change', function() {
                var selectedUsaha = $(this).val();
                if (selectedUsaha === 'Semua') {
                    // Clear the Akun filter
                    table.columns(5).search('').draw();

                    // Clear the Sub Akun filter as well
                    akunSelect.val('Semua').trigger('change');
                } else {
                    table.columns(5).search(selectedUsaha).draw();
                }
            });
            akunSelect.on('change', function() {
                var selectedAkun = $(this).val();
                if (selectedAkun === 'Semua') {
                    // Clear the Akun filter
                    table.columns(6).search('').draw();

                    // Clear the Sub Akun filter as well
                    subSelect.val('Semua').trigger('change');
                } else {
                    table.columns(6).search(selectedAkun).draw();
                }
            });

            // Handle filter change for Sub Akun
            subSelect.on('change', function() {
                var selectedSub = $(this).val();
                if (selectedSub === 'Semua') {
                    // Clear the Sub Akun filter
                    table.columns(7).search('').draw();
                } else {
                    table.columns(7).search(selectedSub).draw();
                }
            });

            // Initially trigger the change event for Akun and Sub Akun filters
            akunSelect.trigger('change');
            subSelect.trigger('change');
            usahaSelect.trigger('change');
        });
    </script>

    {{-- Export Excel --}}
    <script>
        $(document).ready(function() {
            $('#exportButtonPemasukanBelum').on('click', function() {
                // Mendapatkan nilai filter
                var filterBulan = $('select[name="bulan"]').val();
                console.log(filterBulan);
                var filterTahun = $('select[name="tahun"]').val();
                var selectedUsaha = $('#namaUsaha').val();
                var selectedAkun = $('#namaAkun').val();
                var selectedSubAkun = $('#namaSub').val();

                // Mendapatkan data dari DataTable
                var table = $('#example2').DataTable();
                var data = table.rows().data().toArray();

                // Membangun URL untuk ekspor
                var exportUrl =
                    `/export-excel-pemasukan-belum-acc?filter_bulan=${filterBulan}&filter_tahun=${filterTahun}&usaha=${selectedUsaha}&akun=${selectedAkun}&sub_akun_1=${selectedSubAkun}`;


                // Auto redirect ke exportUrl
                window.location.href = exportUrl;
            });

            $('#exportButtonPemasukanAcc').on('click', function() {
                // Mendapatkan nilai filter
                var filterBulan = $('select[name="bulan"]').val();
                
                var filterTahun = $('select[name="tahun"]').val();
                var selectedUsaha = $('#namaUsaha').val();
                var selectedAkun = $('#namaAkun').val();
                var selectedSubAkun = $('#namaSub').val();

                // Mendapatkan data dari DataTable
                var table = $('#example2').DataTable();
                var data = table.rows().data().toArray();

                // Membangun URL untuk ekspor
                var exportUrl =
                    `/export-excel-pemasukan-acc?filter_bulan=${filterBulan}&filter_tahun=${filterTahun}&usaha=${selectedUsaha}&akun=${selectedAkun}&sub_akun_1=${selectedSubAkun}`;


                // Auto redirect ke exportUrl
                window.location.href = exportUrl;
            });
        });
    </script>
@endpush
