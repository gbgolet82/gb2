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
                        <li class="breadcrumb-item active">Pengeluaran</li>
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
                                        <h4 style="color:#28a745;">LAPORAN PENGELUARAN</h4>
                                    </strong>
                                </div>
                                <div class="col-10">
                                    <div class="card">
                                        <div class="card-body p-3">
                                            {{-- filter role owner --}}
                                            @if (($karyawanRoles->count() == 1 && $karyawanRoles->contains('owner')) || $selectedRole == 'owner')
                                                <div class="row">
                                                    <div class="col-12 col-md-3 mb-2">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" for="usaha"
                                                                    style="width: 100px; text-align: center; display: block;">Klasifikasi</span>
                                                            </div>
                                                            <select class="custom-select" id="namaKlasifikasi"
                                                                name="klasifikasi_laporan">
                                                                <option value="Semua" selected>Semua Data</option>
                                                                @foreach ($klasifikasiOptions as $dataKlasifikasi)
                                                                    <option
                                                                        value="{{ $dataKlasifikasi->klasifikasi_laporan }}"
                                                                        @if ($dataKlasifikasi->klasifikasi_laporan === 'Semua') selected @endif>
                                                                        {{ $dataKlasifikasi->klasifikasi_laporan }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

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

                                                    <div class="col-12 col-md-3 mb-2">
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

                                                    <div class="col-12 col-md-3 mb-2">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" for="sub_akun_1"
                                                                    style="width: 100px; text-align: center; display: block;">Sub
                                                                    Akun
                                                                    1</span>
                                                            </div>
                                                            <select class="custom-select" id="namaSub" name="namaSub">
                                                                <option value="Semua" selected>Semua Data</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- filter selain role owner --}}
                                            @else
                                                <div class="row">
                                                    <div class="col-12 col-md-3 mb-2">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" for="usaha"
                                                                    style="width: 100px; text-align: center; display: block;">Klasifikasi</span>
                                                            </div>
                                                            <select class="custom-select" id="klasifikasi_laporan"
                                                                name="klasifikasi_laporan">
                                                                <option value="Semua" selected>Semua Data</option>
                                                                @foreach ($klasifikasiOptions as $dataKlasifikasi)
                                                                    <option
                                                                        value="{{ $dataKlasifikasi->klasifikasi_laporan }}"
                                                                        @if ($dataKlasifikasi->klasifikasi_laporan === 'Semua') selected @endif>
                                                                        {{ $dataKlasifikasi->klasifikasi_laporan }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

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
                                                            <select class="custom-select" id="inputSub1"
                                                                name="sub_akun_1">
                                                                <option value="Semua" selected>Semua Data</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            {{-- baris baru --}}
                                            <div class="row">
                                                {{-- muncul ketika pengeluaran belum dicek --}}
                                                @if ($pengeluaranBelumActive == true)
                                                    {{-- button export dan keterangan untuk role manajer --}}
                                                    @if (($karyawanRoles->count() == 1 && $karyawanRoles->contains('manajer')) || $selectedRole == 'manajer')
                                                        <div class="col-12 col-md-6 align-self-center">
                                                            <span style="font-size: 16px;"><i
                                                                    class="fas fa-info-circle"></i> Klik Kode Laporan untuk
                                                                melihat detail</span>
                                                        </div>
                                                        <div class="col-12 col-md-3  ml-auto">
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
                                                        {{-- button dan keterangan export untuk role owner --}}
                                                    @elseif (($karyawanRoles->count() == 1 && $karyawanRoles->contains('owner')) || $selectedRole == 'owner')
                                                        <div class="col-12 col-md-6 align-self-center">
                                                            <span style="font-size: 16px;"><i
                                                                    class="fas fa-info-circle"></i> Klik Kode Laporan untuk
                                                                melihat detail</span>
                                                        </div>
                                                        <div class="col-12 col-md-3  ml-auto">
                                                            <input type="text"
                                                                class="form-control text-center icon-input"
                                                                id="reportrange" name="filter_daterange" readonly=""
                                                                style="background-color: white;cursor: pointer;min-width:175px;height:37.5px;">
                                                        </div>
                                                        <div class="col-12 col-md-3  ml-auto">
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
                                                        {{-- button dan keterangan export untuk kasir --}}
                                                    @elseif (($karyawanRoles->count() == 1 && $karyawanRoles->contains('kasir')) || $selectedRole == 'kasir')
                                                        <div class="col-12 col-md-6 align-self-center">
                                                            <span style="font-size: 16px;"><i
                                                                    class="fas fa-info-circle"></i> Klik Kode Laporan untuk
                                                                melihat detail</span>
                                                        </div>
                                                        <div class="col-12 col-md-3  ml-auto">
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
                                                        <div class="col-12 col-md-3 ">
                                                            <button class="btn text-white w-100"
                                                                style="background-color: #28a745; border-radius: 10px;"
                                                                type="button" data-toggle="modal"
                                                                data-target="#tambahData" aria-expanded="false">
                                                                <i class="fas fa-plus-circle left-icon-holder"></i>
                                                                Tambah
                                                            </button>
                                                        </div>
                                                    @endif
                                                    {{-- muncul ketika pengeluaran sudah dicek --}}
                                                @else
                                                    <div class="col-12 col-md-6 align-self-center">
                                                        <span style="font-size: 16px;"><i class="fas fa-info-circle"></i>
                                                            Klik Kode Laporan untuk
                                                            melihat detail</span>
                                                    </div>
                                                    <div class="col-12 col-md-3  ml-auto">
                                                        <input type="text" class="form-control text-center icon-input"
                                                            id="reportrange" name="filter_daterange" readonly=""
                                                            style="background-color: white;cursor: pointer;min-width:175px;height:37.5px;">
                                                    </div>
                                                    <div class="col-12 col-md-3 ">
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
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- modal untuk tambah data, ketika pengeluaran belum dicek, role kasir --}}
                            @if ($pengeluaranBelumActive == true)
                                @if (($karyawanRoles->count() == 1 && $karyawanRoles->contains('kasir')) || $selectedRole == 'kasir')
                                    <div class="modal fade" id="tambahData" data-backdrop="static" data-keyboard="false"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true"
                                        data-target="#staticBackdrop">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">
                                                        Tambah Data Pengeluaran
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close" id="reset">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                @include('modals.tambah-pengeluaran')
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
                                        if ($pengeluaranBelumActive == true) {
                                            $warna = 'kuning';
                                        } else {
                                            $warna = 'success';
                                        }
                                    @endphp
                                    @foreach ($data as $pengeluaran)
                                        <tr>
                                            <td>{{ $noUrut++ }}</td>
                                            <td style="15%" data-toggle="modal"
                                                data-target="#lihatPengeluaran{{ $pengeluaran->id_laporan }}">
                                                {{ $pengeluaran->kode_laporan }} <br>
                                                <span class="text-white badge badge-{{ $warna }}"
                                                    style="font-size: 12px; border-radius: 10px;">{{ $pengeluaran->status_cek }}</span>
                                            </td>
                                            <td style="12%">
                                                {{ \Carbon\Carbon::parse($pengeluaran->tanggal_laporan)->format('d/m/Y H:i:s') }}
                                            </td>
                                            <td style="15%">{{ $pengeluaran->nama_kasir }}</td>
                                            <td style="15%">{{ $pengeluaran->klasifikasi }}</td>
                                            <td style="12%">{{ $pengeluaran->usaha }}</td>
                                            <td style="15%">{{ $pengeluaran->akun }}</td>
                                            <td style="18%">{{ $pengeluaran->sub_akun_1 ?? '-' }}</td>
                                            <td style="18%">{{ $pengeluaran->sub_akun_2 ?? '-' }}</td>
                                            <td style="18%">{{ $pengeluaran->sub_akun_3 ?? '-' }}</td>
                                            <td style="15%">Rp. {{ number_format($pengeluaran->nominal, 0, ',', '.') }}
                                            </td>
                                            <td style="10%"><a class="text-primary"
                                                    href="{{ asset('nota/' . $pengeluaran->gambar_bukti) }}"
                                                    target="_blank">Lihat</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @foreach ($data as $pengeluaran)
                                <div class="modal fade" id="lihatPengeluaran{{ $pengeluaran->id_laporan }}"
                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
                                    data-backdrop="static">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                    Data Laporan Pengeluaran
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close" id="reset">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            @include('modals.detail-pengeluaran')
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

            var defaultStartDate = moment().subtract(29, 'days');
            var defaultEndDate = moment();

            // Filter data untuk 30 hari terakhir saat halaman dimuat
            var defaultFilteredData = originalData.filter(function(dataRow) {
                var dateValue = moment(dataRow[2], 'DD/MM/YYYY');
                return dateValue.isBetween(defaultStartDate, defaultEndDate, null, '[]');
            });

            // Menampilkan data yang difilter pada DataTable
            table.clear().rows.add(defaultFilteredData).draw();

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
                startDate: defaultStartDate,
                endDate: defaultEndDate
            }, function(start, end) {
                var filteredData = originalData.filter(function(dataRow) {
                    var dateValue = moment(dataRow[2], 'DD/MM/YYYY');
                    return dateValue.isBetween(start, end, null, '[]');
                });

                var selectedRange = $('#reportrange').data('daterangepicker').chosenLabel;

                if (filteredData.length === 0 && selectedRange !== '30 Hari Terakhir') {
                    table.clear().draw();
                } else {
                    table.clear().rows.add(filteredData).draw();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#klasifikasi_laporan').change(function() {
                var selectedKlasifikasiId = $(this).val();

                // console.log(selectedAkunId);

                // Lakukan permintaan AJAX ke endpoint yang mengembalikan opsi sub akun 1 berdasarkan id_akun yang dipilih.
                $.ajax({
                    url: '/get-akun-options/' + selectedKlasifikasiId,
                    type: 'GET',
                    success: function(data) {
                        // Perbarui opsi sub akun 1 dengan data yang diterima dari server.
                        $('#inputAkun').empty();
                        $('#inputAkun').append($('<option>', {
                            value: 'Semua',
                            text: 'Semua Data'
                        }));
                        $.each(data, function(key, value) {
                            // console.log(key);
                            $('#inputAkun').append($('<option>', {
                                value: key,
                                text: value
                            }));
                        });
                    }
                });
            });

            $('#inputAkun').change(function() {
                var selectedKlasifikasiId = $(this).val();

                $.ajax({
                    url: '/get-sub-akun-1-options/' + selectedKlasifikasiId,
                    type: 'GET',
                    success: function(data) {
                        // Perbarui opsi sub akun 1 dengan data yang diterima dari server.
                        $('#inputSub1').empty();
                        $('#inputSub1').append($('<option>', {
                            value: 'Semua',
                            text: 'Semua Data'
                        }));
                        $.each(data, function(key, value) {
                            // console.log(key);
                            $('#inputSub1').append($('<option>', {
                                value: key,
                                text: value
                            }));
                        });
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#namaKlasifikasi, #namaUsaha').change(function() {
                var selectedKlasifikasi = $('#namaKlasifikasi').val();
                var selectedUsaha = $('#namaUsaha').val();

                // Make an AJAX request with both selected values
                $.ajax({
                    url: '/get-akun-pengeluaran/' + selectedKlasifikasi + '/' + selectedUsaha,
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

            $('#namaAkun').change(function() {
                var selectedKlasifikasiId = $(this).val();
                console.log(selectedKlasifikasiId);

                $.ajax({
                    url: '/get-sub1-pengeluaran/' + selectedKlasifikasiId,
                    type: 'GET',
                    success: function(data) {
                        // Perbarui opsi sub akun 1 dengan data yang diterima dari server.
                        $('#namaSub').empty();
                        $('#namaSub').append($('<option>', {
                            value: 'Semua',
                            text: 'Semua Data'
                        }));
                        $.each(data, function(key, value) {
                            console.log(key);
                            $('#namaSub').append($('<option>', {
                                value: key,
                                text: value
                            }));
                        });
                    }
                });
            });
        });


        $(document).ready(function() {
            // Get the table and all the select elements
            var table = $('#example2').DataTable();
            var klasifikasiSelect = $('#klasifikasi_laporan');
            var akunSelect = $('#inputAkun');
            var subSelect = $('#inputSub1');

            // Handle filter change for Akun
            klasifikasiSelect.on('change', function() {
                var selectedKlasifikasi = $(this).val();
                if (selectedKlasifikasi === 'Semua') {
                    // Clear the Akun filter
                    table.columns(4).search('').draw();

                    akunSelect.val('Semua').trigger('change');
                } else {
                    table.columns(4).search(selectedKlasifikasi, true, false).draw();
                }
            });

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

            // Initially trigger the change event to apply the initial filters
            klasifikasiSelect.trigger('change');
            akunSelect.trigger('change');
            subSelect.trigger('change');
        });

        $(document).ready(function() {
            // Get the table and all the select elements
            var table = $('#example2').DataTable();
            var klasifikasiSelect = $('#namaKlasifikasi');
            var usahaSelect = $('#namaUsaha');
            var akunSelect = $('#namaAkun');
            var subSelect = $('#namaSub');

            // Handle filter change for Akun
            klasifikasiSelect.on('change', function() {
                var selectedKlasifikasi = $(this).val();
                if (selectedKlasifikasi === 'Semua') {
                    // Clear the Akun filter
                    table.columns(4).search('').draw();

                    usahaSelect.val('Semua').trigger('change');
                } else {
                    table.columns(4).search(selectedKlasifikasi, true, false).draw();
                }
            });

            usahaSelect.on('change', function() {
                var selectedUsaha = $(this).val();
                if (selectedUsaha === 'Semua') {
                    // Clear the Akun filter
                    table.columns(5).search('').draw();

                    akunSelect.val('Semua').trigger('change');
                } else {
                    table.columns(5).search(selectedUsaha, true, false).draw();
                }
            });

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

            // Initially trigger the change event to apply the initial filters
            klasifikasiSelect.trigger('change');
            usahaSelect.trigger('change');
            akunSelect.trigger('change');
            subSelect.trigger('change');
        });
    </script>
@endpush
