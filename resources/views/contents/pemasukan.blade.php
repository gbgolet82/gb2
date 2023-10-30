@extends('main')

@section('dashboard', 'active')


@section('content')
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
                        <div class="col-auto">
                            {{ Carbon\Carbon::now()->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}
                        </div>
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
                                <div class="col-2 mt-3">
                                    <strong class="font-weight-bold text-center">
                                        <h4 style="color:#28a745;">LAPORAN PEMASUKAN</h4>
                                    </strong>
                                </div>
                                <div class="col-10">
                                    <div class="card">
                                        <div class="card-body p-3">
                                            <div class="row">
                                                {{-- filter tanggal owner --}}
                                                @if (($karyawanRoles->count() == 1 && $karyawanRoles->contains('owner')) || $selectedRole == 'owner')
                                                    <div class="col-12 col-md-3">
                                                        <input type="text" class="form-control text-center icon-input"
                                                            id="reportrange" name="filter_daterange" readonly=""
                                                            style="background-color: white;cursor: pointer;min-width:175px;height:37.5px;">
                                                    </div>
                                                @endif

                                                {{-- filter owner --}}
                                                @if (($karyawanRoles->count() == 1 && $karyawanRoles->contains('owner')) || $selectedRole == 'owner')
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
                                                            <select class="custom-select" id="namaSub" name="sub_akun_1">
                                                                <option value="Semua" selected>Semua Data</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                @else
                                                    {{-- filter selain owner --}}
                                                    <div class="col-12 col-md-3 mb-2">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" for="usaha"
                                                                    style="width: 100px; text-align: center; display: block;">Usaha</span>
                                                            </div>
                                                            <select class="custom-select" id="usaha" name="usaha">
                                                                <option value="{{ session('id_usaha') }}" selected>
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
                                                @endif

                                                {{-- muncul ketika pemasukan belum dicek --}}
                                                @if ($pemasukanBelumActive == true)
                                                    <div class="col-3">
                                                        <div class="d-flex flex-wrap">
                                                            {{-- button tambah role kasir --}}
                                                            @if (($karyawanRoles->count() == 1 && $karyawanRoles->contains('kasir')) || $selectedRole == 'kasir')
                                                                <div class="col-md-12">
                                                                    <!-- Adjust the width as needed -->
                                                                    <button class="btn text-white w-100"
                                                                        style="background-color: #28a745; border-radius: 10px;"
                                                                        type="button" data-toggle="modal"
                                                                        data-target="#tambahData" aria-expanded="false">
                                                                        <i class="fas fa-plus-circle left-icon-holder"></i>
                                                                        Tambah
                                                                    </button>
                                                                </div>
                                                                {{-- button ekspor role manajer --}}
                                                            @elseif (($karyawanRoles->count() == 1 && $karyawanRoles->contains('manajer')) || $selectedRole == 'manajer')
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <button class="btn btn-outline-danger"
                                                                                style="border-radius: 10px; width: 100%;"
                                                                                type="button" data-toggle="modal"
                                                                                data-target="#eksporData"
                                                                                aria-expanded="false">
                                                                                <i class="fas fa-file-pdf"></i> Pdf
                                                                            </button>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <button class="btn btn-outline-success"
                                                                                style="border-radius: 10px; width: 100%;"
                                                                                type="button" data-toggle="modal"
                                                                                data-target="#eksporData"
                                                                                aria-expanded="false">
                                                                                <i class="fas fa-file-excel"></i> Excel
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    {{-- muncul ketika pemasukan sudah dicek --}}
                                                @else
                                                    {{-- button ekspor role manajer --}}
                                                    @if (($karyawanRoles->count() == 1 && $karyawanRoles->contains('manajer')) || $selectedRole == 'manajer')
                                                        <div class="col-3">
                                                            <div class="d-flex flex-wrap">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <button class="btn btn-outline-danger"
                                                                                style="border-radius: 10px; width: 100%;"
                                                                                type="button" data-toggle="modal"
                                                                                data-target="#eksporData"
                                                                                aria-expanded="false">
                                                                                <i class="fas fa-file-pdf"></i> Pdf
                                                                            </button>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <button class="btn btn-outline-success"
                                                                                style="border-radius: 10px; width: 100%;"
                                                                                type="button" data-toggle="modal"
                                                                                data-target="#eksporData"
                                                                                aria-expanded="false">
                                                                                <i class="fas fa-file-excel"></i> Excel
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>

                                            {{-- baris baru --}}
                                            <div class="row">
                                                {{-- button export role kasir --}}
                                                @if (($karyawanRoles->count() == 1 && $karyawanRoles->contains('kasir')) || $selectedRole == 'kasir')
                                                    <div class="col-12 col-md-6 align-self-center">
                                                        <span style="font-size: 16px;"><i class="fas fa-info-circle"></i>
                                                            Klik
                                                            Kode Laporan untuk
                                                            melihat detail</span>
                                                    </div>
                                                    <div class="col-12 col-md-3 ml-auto">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <button class="btn btn-outline-danger"
                                                                    style="border-radius: 10px; width: 100%;"
                                                                    type="button" data-toggle="modal"
                                                                    data-target="#eksporData" aria-expanded="false">
                                                                    <i class="fas fa-file-pdf"></i> Pdf
                                                                </button>
                                                            </div>
                                                            <div class="col-6">
                                                                <button class="btn btn-outline-success"
                                                                    style="border-radius: 10px; width: 100%;"
                                                                    type="button" data-toggle="modal"
                                                                    data-target="#eksporData" aria-expanded="false">
                                                                    <i class="fas fa-file-excel"></i> Excel
                                                                </button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    {{-- keterangan role manajer --}}
                                                @elseif(($karyawanRoles->count() == 1 && $karyawanRoles->contains('manajer')) || $selectedRole == 'manajer')
                                                    <div class="col-12 col-md-6 align-self-center">
                                                        <span style="font-size: 16px;"><i class="fas fa-info-circle"></i>
                                                            Klik
                                                            Kode
                                                            Laporan untuk
                                                            melihat detail</span>
                                                    </div>
                                                @endif
                                            </div>
                                            {{-- button dan keterangan export owner --}}
                                            @if (($karyawanRoles->count() == 1 && $karyawanRoles->contains('owner')) || $selectedRole == 'owner')
                                                <div class="row">
                                                    <div class="col-12 col-md-6 align-self-center">
                                                        <span style="font-size: 16px;"><i class="fas fa-info-circle"></i>
                                                            Klik Kode Laporan untuk
                                                            melihat detail</span>
                                                    </div>
                                                    <div class="col-12 col-md-3 ml-auto">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <button class="btn btn-outline-danger"
                                                                    style="border-radius: 10px; width: 100%;"
                                                                    type="button" data-toggle="modal"
                                                                    data-target="#eksporData" aria-expanded="false">
                                                                    <i class="fas fa-file-pdf"></i> Pdf
                                                                </button>
                                                            </div>
                                                            <div class="col-6">
                                                                <button class="btn btn-outline-success"
                                                                    style="border-radius: 10px; width: 100%;"
                                                                    type="button" data-toggle="modal"
                                                                    data-target="#eksporData" aria-expanded="false">
                                                                    <i class="fas fa-file-excel"></i> Excel
                                                                </button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
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
                                            <td style="15%" data-toggle="modal"
                                                data-target="#lihatPemasukan{{ $pemasukan->id_laporan }}">
                                                {{ $pemasukan->kode_laporan }} <br>
                                                <span class="text-white badge badge-{{ $warna }}"
                                                    style="font-size: 12px; border-radius: 10px;">{{ $pemasukan->status_cek }}</span>
                                            </td>
                                            <td style="12%">
                                                {{ \Carbon\Carbon::parse($pemasukan->tanggal_laporan)->format('d/m/Y') }}
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
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        var originalData;
        $(document).ready(function() {
            var table = $('#example2').DataTable();
            originalData = table.rows().data().toArray();
            $('#reportrange').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY',
                    separator: ' - ',
                    applyLabel: 'Pilih',
                    cancelLabel: 'Batal',
                    fromLabel: 'Dari',
                    toLabel: 'Hingga',
                    customRangeLabel: 'Pilih Tanggal',
                    weekLabel: 'Mg',
                    daysOfWeek: ['Mg', 'Sn', 'Sl', 'Rb', 'Km', 'Jm', 'Sb'],
                    monthNames: [
                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                        'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ],
                    firstDay: 1
                },
                ranges: {
                    'Hari ini': [moment(), moment()],
                    'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
                    '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
                    'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
                    'Bulan lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            }, function(start, end) {
                var filteredData = [];

                // Filter data sesuai dengan rentang tanggal yang dipilih
                originalData.forEach(function(dataRow) {
                    var dateValue = moment(dataRow[2],
                        'DD/MM/YYYY'); // Sesuaikan dengan kolom tanggal Anda

                    if (dateValue.isBetween(start, end, null, '[]')) {
                        filteredData.push(dataRow);
                    }
                });

                var table = $('#example2').DataTable();

                if (filteredData.length === 0) {
                    // Tidak ada data yang cocok, kosongkan tabel
                    table.clear().draw();
                } else {
                    // Jika ada data yang cocok, terapkan filter
                    table.clear().rows.add(filteredData).draw();
                }
            });
        });
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
@endpush
