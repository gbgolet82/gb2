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

                                <div class="col-10 mx-auto">
                                    <div class="card col-12">
                                        <div class="card-body p-3">
                                            <div class="row">
                                                {{-- filter tanggal owner --}}
                                                @if (
                                                    ($karyawanRoles->count() == 1 && !$karyawanRoles->contains('kasir')) ||
                                                        (isset($selectedRole) && $selectedRole != 'kasir'))
                                                    <div class="col-12 col-md-3 mb-2">
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
                                                    <div class="col-12 col-md-3">
                                                        {{-- <div class="d-flex flex-wrap"> --}}
                                                        {{-- button tambah role kasir --}}
                                                        @if (($karyawanRoles->count() == 1 && $karyawanRoles->contains('kasir')) || $selectedRole == 'kasir')
                                                            {{-- <div class="col-12 col-md-3"> --}}
                                                            <!-- Adjust the width as needed -->
                                                            <button class="btn text-white w-100"
                                                                style="background-color: #28a745; border-radius: 10px;"
                                                                type="button" data-toggle="modal" data-target="#tambahData"
                                                                aria-expanded="false">
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
                                                            <button class="btn btn-outline-danger"
                                                                style="border-radius: 10px; width: 100%;" type="button"
                                                                data-toggle="modal" data-target="#eksporData"
                                                                aria-expanded="false">
                                                                <i class="fas fa-file-pdf"></i> Pdf
                                                            </button>
                                                        </div>
                                                        <div class="col-6">
                                                            <button class="btn btn-outline-success"
                                                                style="border-radius: 10px; width: 100%;" type="button"
                                                                data-toggle="modal" data-target="#eksporData"
                                                                aria-expanded="false">
                                                                <i class="fas fa-file-excel"></i> Excel
                                                            </button>
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

                    @if (($karyawanRoles->count() == 1 && $karyawanRoles->contains('owner')) || $selectedRole == 'owner')
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h5>Grafik Pemasukan Berdasarkan Usaha</h5>
                                            </div>
                                            <div>
                                                <span id="periodeUsaha"></span>
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
                                                <span id="periodeAkun"></span>
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
    @php
        $selectedRole = session('selectedRole');
        $karyawanRoles = session('karyawanRoles');
    @endphp

    @if (
        ($karyawanRoles->count() == 1 && !$karyawanRoles->contains('kasir')) ||
            (isset($selectedRole) && $selectedRole != 'kasir'))
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
                    var filteredData = originalData.filter(
                        function(dataRow) {
                            var dateValue = moment(dataRow[2], 'DD/MM/YYYY');
                            return dateValue.isBetween(start, end, null, '[]');
                        });

                    var selectedRange = $('#reportrange').data('daterangepicker').chosenLabel;
                    // console.log(start);
                    // console.log(end);
                    // console.log(dataRow);

                    if (filteredData.length === 0 && selectedRange !== '30 Hari Terakhir') {
                        table.clear().draw();
                    } else {
                        table.clear().rows.add(filteredData).draw();
                    }
                });
            });
        </script>
    @endif

    @if (($karyawanRoles->count() == 1 && $karyawanRoles->contains('owner')) || $selectedRole == 'owner')
        <script>
            $('#reportrange').on('change', function() {
                // console.log('nik');
                var filteredDate = $('#reportrange').val();
                // console.log(filteredDate);

                $('#periodeUsaha').val(filteredDate);
                $('#periodeUsaha').text(filteredDate);

                // Memisahkan rentang tanggal menjadi dua tanggal terpisah
                var dateRange = filteredDate.split(" - ");
                // var startDate = dateRange[0].replace(/\//g, '-'); // Tanggal awal
                // var endDate = dateRange[1].replace(/\//g, '-');

                var startDate = new Date(dateRange[0].replace(/\//g, '-')); // Konversi string tanggal awal ke objek Date
                var endDate = new Date(dateRange[1].replace(/\//g, '-')); // Konversi string tanggal akhir ke objek Date

                var startMonth = startDate.getMonth(); // Mendapatkan bulan dari tanggal awal
                var endMonth = endDate.getMonth(); // Mendapatkan bulan dari tanggal akhir


                // var isMultipleMonths = startDate.getMonth() !== endDate.getMonth() || startDate.getFullYear() !== endDate.getFullYear();
                // console.log(isMultipleMonths);

                console.log("Start Date:", startDate);
                console.log("End Date:", endDate);

                // console.log('/getPemasukan/' + startDate + '/' + endDate);

                $.ajax({
                    url: '/getPemasukan/' + startDate + '/' + endDate,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        var datasets = {};

                        // Array warna yang telah ditentukan
                        var colors = ['green', 'blue', 'orange', 'purple']; // Ganti warna sesuai kebutuhan

                        // Memproses data untuk setiap entri dari respons
                        data.forEach(function(item, index) {
                            var day = item.day;

                            if (!datasets[item.nama_usaha]) {
                                datasets[item.nama_usaha] = Array(31).fill(
                                    null); // Inisialisasi array 31 hari dengan nilai null
                            }
                            datasets[item.nama_usaha][day - 1] = item
                                .total_nominal; // Mengisi data sesuai dengan tanggal
                            // console.log(datasets);
                        });

                        var labels = Array.from({
                            length: 31
                        }, (_, i) => (i + 1).toString()); // Label berdasarkan tanggal 1 hingga 31

                        var chartData = {
                            labels: labels,
                            datasets: Object.keys(datasets).map(function(usaha, index) {
                                return {
                                    label: usaha,
                                    data: datasets[usaha],
                                    borderColor: colors[index % colors
                                        .length], // Gunakan warna berdasarkan indeks
                                    borderWidth: 2,
                                    fill: false
                                };
                            })
                        };

                        var ctx = document.getElementById('lineChart').getContext('2d');
                        // Hancurkan grafik sebelumnya jika ada
                        // if (window.lineChart !== undefined) {
                        //     window.lineChart.destroy();
                        // }
                        if (window.lineChart instanceof Chart) {
                            window.lineChart.destroy(); // Destroy the previous chart instance
                        }

                        // Buat grafik yang baru
                        var chart = new Chart(ctx, {
                            type: 'line',
                            data: chartData,
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    x: {
                                        type: 'category',
                                        position: 'bottom',
                                    },
                                    y: {
                                        type: 'linear',
                                    },
                                },
                            },
                        });
                        window.lineChart = chart;
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        </script>

        <script>
            $('#reportrange, #namaUsaha, #namaAkun').on('change', function() {
                // console.log('nik');
                var filteredDate = $('#reportrange').val();
                var namaUsaha = $('#namaUsaha').val();
                var namaAkun = $('#namaAkun').val();

                $('#periodeAkun').val(filteredDate);
                $('#periodeAkun').text(filteredDate);

                // Memisahkan rentang tanggal menjadi dua tanggal terpisah
                var dateRange = filteredDate.split(" - ");
                var startDate = dateRange[0].replace(/\//g, '-'); // Tanggal awal
                var endDate = dateRange[1].replace(/\//g, '-'); // Tanggal akhir

                $.ajax({
                    url: '/getPemasukan/' + startDate + '/' + endDate + '/' + namaUsaha + '/' + namaAkun,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        var datasets = {};

                        // Array warna yang telah ditentukan
                        var colors = ['green', 'blue', 'orange', 'purple']; // Ganti warna sesuai kebutuhan

                        // Memproses data untuk setiap entri dari respons
                        data.forEach(function(item, index) {
                            var day = item.day;

                            if (!datasets[item.nama_usaha + ' - ' + item.akun]) {
                                datasets[item.nama_usaha + ' - ' + item.akun] = Array(31)
                                    .fill(null);
                            }

                            datasets[item.nama_usaha + ' - ' + item.akun][day - 1] = item
                                .total_nominal;
                        });

                        var labels = Array.from({
                            length: 31
                        }, (_, i) => (i + 1).toString()); // Label berdasarkan tanggal 1 hingga 31

                        var chartData = {
                            labels: labels,
                            datasets: Object.keys(datasets).map(function(label, index) {
                                return {
                                    label: label,
                                    data: datasets[label],
                                    borderColor: colors[index % colors.length],
                                    borderWidth: 2,
                                    fill: false
                                };
                            })
                        };

                        var ctx = document.getElementById('lineChart1').getContext('2d');
                        // Hancurkan grafik sebelumnya jika ada
                        // if (window.lineChart !== undefined) {
                        //     window.lineChart.destroy();
                        // }
                        if (window.lineChart1 instanceof Chart) {
                            window.lineChart1.destroy(); // Destroy the previous chart instance
                        }

                        // Buat grafik yang baru
                        var chart = new Chart(ctx, {
                            type: 'line',
                            data: chartData,
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    x: {
                                        type: 'category',
                                        position: 'bottom',
                                    },
                                    y: {
                                        type: 'linear',
                                    },
                                },
                            },
                        });
                        window.lineChart1 = chart;
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        </script>
    @endif


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
