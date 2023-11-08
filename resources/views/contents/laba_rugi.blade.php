@extends('main')

@section('laba_rugi', 'active')


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
                        <li class="breadcrumb-item active">Laba Rugi</li>
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

    {{-- <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-2">
                    <div class="card ijo-kiri">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h5 font-weight-bold mb-3">Keuntungan <br> Tertinggi
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold mb-1" style="color: #28a745">11 Orang</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-3x text-gray"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-2">
                    <div class="card ijo-kiri">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h5 font-weight-bold mb-3">Keuntungan <br>Terendah
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold mb-1" style="color: #28a745">11 Orang</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-3x text-gray"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-2">
                    <div class="card ijo-kiri">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h5 font-weight-bold mb-3"> Pemasukan <br>Tertinggi

                                    </div>
                                    <div class="h5 mb-0 font-weight-bold mb-1" style="color: #28a745">11 Orang</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-3x text-gray"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-2">
                    <div class="card ijo-kiri">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h5 font-weight-bold mb-3">Pemasukan<br>Terendah

                                    </div>
                                    <div class="h5 mb-0 font-weight-bold mb-1" style="color: #28a745">11 Orang</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-3x text-gray"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

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
                                        <h4 style="color:#28a745;">LABA & RUGI</h4>
                                    </strong>
                                </div>

                                <div class="col-10 mx-auto">
                                    <div class="card col-12">
                                        <div class="card-body p-3">

                                            <form action="{{ route('filter_laba_rugi') }}" method="GET">
                                                <div class="row">


                                                    {{-- <div class="col-12 col-md-3 mb-2">
                                                        <input type="text" class="form-control text-center icon-input"
                                                            id="reportrange" name="filter_daterange" readonly=""
                                                            style="background-color: white;cursor: pointer;min-width:175px;height:37.5px;">
                                                    </div> --}}


                                                    <div class="col-12 col-md-3 mb-2">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                    style="width: 100px; text-align: center; display: block;">Bulan</span>
                                                            </div>
                                                            <select class="custom-select" name="bulan"
                                                                onchange="this.form.submit()">
                                                                <option value=""
                                                                    {{ request('bulan') == '' ? 'selected' : '' }}>Semua
                                                                    Data</option>
                                                                <option value="01"
                                                                    {{ request('bulan') == '01' ? 'selected' : '' }}>Januari
                                                                </option>
                                                                <option value="02"
                                                                    {{ request('bulan') == '02' ? 'selected' : '' }}>
                                                                    Februari</option>
                                                                <option value="03"
                                                                    {{ request('bulan') == '03' ? 'selected' : '' }}>Maret
                                                                </option>
                                                                <option value="04"
                                                                    {{ request('bulan') == '04' ? 'selected' : '' }}>April
                                                                </option>
                                                                <option value="05"
                                                                    {{ request('bulan') == '05' ? 'selected' : '' }}>Mei
                                                                </option>
                                                                <option value="06"
                                                                    {{ request('bulan') == '06' ? 'selected' : '' }}>Juni
                                                                </option>
                                                                <option value="07"
                                                                    {{ request('bulan') == '07' ? 'selected' : '' }}>Juli
                                                                </option>
                                                                <option value="08"
                                                                    {{ request('bulan') == '08' ? 'selected' : '' }}>
                                                                    Agustus</option>
                                                                <option value="09"
                                                                    {{ request('bulan') == '09' ? 'selected' : '' }}>
                                                                    September</option>
                                                                <option value="10"
                                                                    {{ request('bulan') == '10' ? 'selected' : '' }}>
                                                                    Oktober</option>
                                                                <option value="11"
                                                                    {{ request('bulan') == '11' ? 'selected' : '' }}>
                                                                    November</option>
                                                                <option value="12"
                                                                    {{ request('bulan') == '12' ? 'selected' : '' }}>
                                                                    Desember</option>
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="col-12 col-md-3 mb-2">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                    style="width: 100px; text-align: center; display: block;">Tahun</span>
                                                            </div>
                                                            <select class="custom-select" name="tahun"
                                                                onchange="this.form.submit()">
                                                                <option value=""
                                                                    {{ request('tahun') == '' ? 'selected' : '' }}>Semua
                                                                    Data</option>
                                                                @foreach ($tahun_get as $th)
                                                                    <option value="{{ $th->tahun }}"
                                                                        {{ request('tahun') == $th->tahun ? 'selected' : '' }}>
                                                                        {{ $th->tahun }}
                                                                    </option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>


                                                    <div class="col-12 col-md-3 mb-2">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                    style="width: 100px; text-align: center; display: block;">Usaha</span>
                                                            </div>
                                                            <select class="custom-select" name="usaha"
                                                                onchange="this.form.submit()">
                                                                <option value=""
                                                                    {{ request('usaha') == '' ? 'selected' : '' }}>Semua
                                                                    Data</option>
                                                                @foreach ($usahaOption as $dataUsaha)
                                                                    <option value="{{ $dataUsaha->nama_usaha }}"
                                                                        {{ request('usaha') == $dataUsaha->nama_usaha ? 'selected' : '' }}>
                                                                        {{ $dataUsaha->nama_usaha }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-3 mb-2">
                                                        <div class="input-group">
                                                            <button class="btn btn-outline-danger"
                                                                style="border-radius: 10px; width: 100%;" type="button"
                                                                data-toggle="modal" data-target="#eksporData"
                                                                aria-expanded="false">
                                                                <i class="fas fa-file-pdf"></i> Pdf
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <br> <br>
                                                    <div class="col-12 col-md-12 mb-2 mb-md-0 align-self-center">
                                                        <span style="font-size: 16px;"><i class="fas fa-info-circle"></i>
                                                            Pilih filter untuk menampilkan data</span>
                                                    </div>


                                                </div>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xl-3 col-md-6 mb-2">
                                        <div class="card ">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="h5 font-weight-bold mb-3">Keuntungan Tertinggi
                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold mb-1" style="color: #28a745">
                                                            November 2023</div>
                                                    </div>
                                                    <div class="col-auto">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 mb-2">
                                        <div class="card ">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="h5 font-weight-bold mb-3">Keuntungan Terendah
                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold mb-1" style="color: #28a745">
                                                            November 2023</div>
                                                    </div>
                                                    <div class="col-auto">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 mb-2">
                                        <div class="card ">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="h5 font-weight-bold mb-3"> Pemasukan Tertinggi

                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold mb-1" style="color: #28a745">
                                                            November 2023</div>
                                                    </div>
                                                    <div class="col-auto">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 mb-2">
                                        <div class="card ">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="h5 font-weight-bold mb-3">Pemasukan Terendah

                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold mb-1" style="color: #28a745">
                                                            November 2023</div>
                                                    </div>
                                                    <div class="col-auto">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <canvas id="myChart" width="400" height="200"></canvas> --}}
                            <h5>Grafik Laba & Rugi </h5>
                            <canvas id="myChart" width="200px" height="50"></canvas>

                        </div>
                    </div>



                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        @if ($bulan == null && $tahun)

            var ctx = document.getElementById('myChart');
            var config = {
                type: 'bar',
                options: {
                    legendCallback: function(chart) {
                        var text = [];
                        text.push('<ul class="' + chart.id + '-legend">');
                        var data = chart.data;
                        var datasets = data.datasets;
                        if (datasets.length) {
                            for (var i = 0; i < datasets.length; ++i) {
                                text.push('<li>');
                                if (datasets[i].type == 'line') {
                                    text.push('<span class="' + datasets[i].type + '" style="background-color:' +
                                        datasets[i].backgroundColor + '"></span>');
                                } else {
                                    text.push('<span class="' + datasets[i].type + '" style="background-color:' +
                                        datasets[i].backgroundColor + '"></span>');
                                }
                                text.push(datasets[i].label);
                                text.push('</li>');
                            }
                        }
                        text.push('</ul>');
                        return text.join('');
                    },
                    legend: {
                        display: false,
                    },
                    scales: {
                        xAxes: [{
                            type: "category",
                            id: "axis-bar",
                        }, {
                            type: "time",
                            id: "axis-time",
                            display: false,
                        }, ],
                    },
                },
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                            label: "Keuntungan",
                            type: "line",
                            backgroundColor: "white", // Atur latar belakang menjadi transparan
                            borderColor: "rgb(0, 128, 0,1)",
                            borderWidth: 3,
                            fill: false,
                            xAxisID: "axis-bar", // Menggunakan sumbu waktu yang sama dengan Dataset2 dan Dataset3
                            data: [
                                <?php foreach ($nominal_bulan_keuntungan as $keuntungan_bulanan) : ?>
                                <?= $keuntungan_bulanan ?>,
                                <?php endforeach; ?>
                            ] // Inisialisasi data dengan nilai 0
                        },
                        {
                            label: "Pemasukan",
                            type: "bar",
                            backgroundColor: "rgba(255, 99, 132, 0.6)",
                            borderColor: "rgba(255, 99, 132, 1)",
                            borderWidth: 3,
                            fill: true,
                            xAxisID: "axis-bar",
                            data: [
                                <?php foreach ($nominal_bulan_pemasukan as $nominal_pemasukan_bulanan) : ?>
                                <?= $nominal_pemasukan_bulanan ?>,
                                <?php endforeach; ?>
                            ]
                        },
                        {
                            label: "Pengeluaran",
                            type: "bar",
                            backgroundColor: "rgba(54, 162, 235, 0.6)",
                            borderColor: "rgba(54, 162, 235,1)",
                            borderWidth: 3,
                            fill: true,
                            xAxisID: "axis-bar",
                            data: [
                                <?php foreach ($nominal_bulan_pengeluaran as $nominal_pengeluaran_bulanan) : ?>
                                <?= $nominal_pengeluaran_bulanan ?>,
                                <?php endforeach; ?>
                            ]
                        }
                    ]
                },

            };

            var myChart = new Chart(ctx, config);
            var legend = myChart.generateLegend();
            document.getElementById("legend").innerHTML = legend;
        @elseif ($bulan && $tahun)

            var ctx = document.getElementById('myChart');
            var tahunDipilih = <?= $tahun ?>; // Ganti ini dengan tahun yang sesuai dari PHP
            var bulanDipilih = <?= $bulan ?>; // Ganti ini dengan bulan yang sesuai dari PHP

            // Fungsi untuk mengambil jumlah hari dalam bulan tertentu
            function getDaysInMonth(year, month) {
                return new Date(year, month, 0).getDate();
            }

            // Menghitung jumlah hari dalam bulan yang dipilih
            var jumlahHari = getDaysInMonth(tahunDipilih, bulanDipilih);

            // Membuat array label tanggal dari 1 hingga jumlah hari
            var labels = [];
            for (var i = 1; i <= jumlahHari; i++) {
                labels.push(i);
            }

            // Data untuk grafik
            var config = {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                            label: "Keuntungan",
                            type: "line",
                            backgroundColor: "white",
                            borderColor: "rgb(0, 128, 0,1)",
                            borderWidth: 3,
                            fill: false,
                            xAxisID: "axis-bar",
                            data: [
                                <?php foreach ($nominal_harian_keuntungan as $keuntungan) : ?>
                                <?= $keuntungan ?>,
                                <?php endforeach; ?>
                            ]
                        },
                        {
                            label: "Pemasukan",
                            type: "bar",
                            backgroundColor: "rgba(255, 99, 132, 0.6)",
                            borderColor: "rgba(255, 99, 132, 1)",
                            borderWidth: 3,
                            fill: true,
                            xAxisID: "axis-bar",
                            data: [
                                <?php foreach ($nominal_harian_pemasukan as $nominal_pemasukan) : ?>
                                <?= $nominal_pemasukan ?>,
                                <?php endforeach; ?>
                            ]
                        },
                        {
                            label: "Pengeluaran",
                            type: "bar",
                            backgroundColor: "rgba(54, 162, 235, 0.6)",
                            borderColor: "rgba(54, 162, 235,1)",
                            borderWidth: 3,
                            fill: true,
                            xAxisID: "axis-bar",
                            data: [
                                <?php foreach ($nominal_harian_pengeluaran as $nominal_pengeluaran) : ?>
                                <?= $nominal_pengeluaran ?>,
                                <?php endforeach; ?>
                            ]
                        }
                    ]
                }
            };
            var myChart = new Chart(ctx, config);
        @else

            var ctx = document.getElementById('myChart');
            var tahunData = <?= json_encode($tahun_get->pluck('tahun')->toArray()) ?>; // Mengambil tahun dari hasil query
            // Anda dapat menyesuaikan tahun yang diambil sesuai dengan hasil query

            // Data dummy untuk keuntungan, pemasukan, dan pengeluaran (sesuai jumlah tahun)
            var dataKeuntungan = [];
            var dataPemasukan = [];
            var dataPengeluaran = [];
            for (var i = 0; i < tahunData.length; i++) {
                dataKeuntungan.push(Math.random() * 100000);
                dataPemasukan.push(Math.random() * 100000);
                dataPengeluaran.push(Math.random() * 100000);
            }

            // Data untuk grafik
            var config = {
                type: 'bar',
                data: {
                    labels: tahunData,
                    datasets: [{
                            label: "Keuntungan",
                            type: "line",
                            backgroundColor: "white",
                            borderColor: "rgb(0, 128, 0,1)",
                            borderWidth: 3,
                            fill: false,
                            xAxisID: "axis-bar",
                            data: dataKeuntungan
                        },
                        {
                            label: "Pemasukan",
                            type: "bar",
                            backgroundColor: "rgba(255, 99, 132, 0.6)",
                            borderColor: "rgba(255, 99, 132, 1)",
                            borderWidth: 3,
                            fill: true,
                            xAxisID: "axis-bar",
                            data: dataPemasukan
                        },
                        {
                            label: "Pengeluaran",
                            type: "bar",
                            backgroundColor: "rgba(54, 162, 235, 0.6)",
                            borderColor: "rgba(54, 162, 235,1)",
                            borderWidth: 3,
                            fill: true,
                            xAxisID: "axis-bar",
                            data: dataPengeluaran
                        }
                    ]
                }
            };
            var myChart = new Chart(ctx, config);
        @endif
    </script>
@endpush
