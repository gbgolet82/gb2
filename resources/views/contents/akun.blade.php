@extends('main')

@section('dashboard', 'active')


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item text-secondary">
                            Dashboard
                        </li>
                        <li class="breadcrumb-item active">Akun & Sub Akun</li>
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
                    <div class="card card-outline card-success mb-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-2 mt-3">
                                    <strong class="font-weight-bold text-center">
                                        <h4 style="color:#28a745;">AKUN & SUB AKUN</h4>
                                    </strong>
                                </div>
                                <div class="col-12 col-md-10">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 col-md-3 mb-2">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"
                                                                for="klasifikasi">Klasifikasi</span>
                                                        </div>
                                                        <select class="custom-select" id="klasifikasi">
                                                            <option value="" selected>Semua Data</option>
                                                            @php
                                                                $uniqueKlasifikasi = [];
                                                            @endphp
                                                            @foreach ($dataAkun as $klasifikasi)
                                                                @if (!empty($klasifikasi->klasifikasi_laporan) && !in_array($klasifikasi->klasifikasi_laporan, $uniqueKlasifikasi))
                                                                    <option value="{{ $klasifikasi->klasifikasi_laporan }}">
                                                                        {{ $klasifikasi->klasifikasi_laporan }}
                                                                    </option>
                                                                    @php
                                                                        $uniqueKlasifikasi[] = $klasifikasi->klasifikasi_laporan;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-3 mb-2">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"
                                                                for="inputGroupSelect01">Usaha</span>
                                                        </div>
                                                        <select class="custom-select" id="inputGroupSelect01"
                                                            name="usaha">
                                                            <option value="" selected>Semua Data</option>
                                                            @php
                                                                $uniqueUsaha = [];
                                                            @endphp
                                                            @foreach ($dataAkun as $usaha)
                                                                @if (!empty($usaha->nama_usaha) && !in_array($usaha->nama_usaha, $uniqueUsaha))
                                                                    <option value="{{ $usaha->nama_usaha }}">
                                                                        {{ $usaha->nama_usaha }}
                                                                    </option>
                                                                    @php
                                                                        $uniqueUsaha[] = $usaha->nama_usaha;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-3 mb-2">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"
                                                                for="inputGroupSelect01">Akun</span>
                                                        </div>
                                                        <select class="custom-select" id="inputGroupSelect02"
                                                            name="akun">
                                                            <option selected>Semua Data </option>
                                                            @php
                                                                $uniqueAkun = [];
                                                            @endphp
                                                            @foreach ($dataAkun as $akun)
                                                                @if (!empty($akun->akun) && !in_array($akun->akun, $uniqueAkun))
                                                                    <option value="{{ $akun->akun }}">{{ $akun->akun }}
                                                                    </option>
                                                                    @php
                                                                        $uniqueAkun[] = $akun->akun;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-3 mb-2">
                                                    <div class="input-group">
                                                        <button class="btn text-white"
                                                            style="background-color: #28a745; width:100%; border-radius: 10px;"
                                                            type="button" data-toggle="modal" data-target="#tambahData"
                                                            aria-expanded="false">
                                                            <i class="fas fa-plus-circle left-icon-holder"></i>
                                                            Tambah
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-12 col-md-3 ml-auto">
                                                    {{-- <div class="row">
                                                        <div class="col-6">
                                                            <button class="btn btn-outline-danger"
                                                                style="border-radius: 10px; width: 100%;" type="button"
                                                                id="previewPdfButton">
                                                                <i class="fas fa-file-pdf"></i> Pdf
                                                            </button>
                                                        </div> --}}
                                                    {{-- <div class="col-12"> --}}
                                                    <button id="exportButton" class="btn btn-outline-success"
                                                        style="border-radius: 10px; width:100%" type="button"
                                                        data-export="klasifikasiAkun">
                                                        <i class="fas fa-file-excel"></i> Export
                                                    </button>
                                                    {{-- </div> --}}
                                                    {{-- </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="tambahData" data-backdrop="static" data-keyboard="false"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true" data-target="#staticBackdrop">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">
                                                {!! $modelHead !!}
                                            </h5>

                                            <i class="fas fa-info-circle" data-toggle="popover" data-placement="right"
                                                data-html="true" title="Informasi!"
                                                data-content="<ol>
                                                        <li>Pilih klasifikasi yang sesuai.</li>
                                                        <li>Pilih unit usaha yang cocok dengan klasifikasi.</li>
                                                        <li>Tambahkan unit usaha jika tidak ada dalam opsi yang sesuai.</li>
                                                        <li>Selanjutnya, pilih akun yang sesuai dengan unit usaha dan klasifikasi yang telah dipilih.</li>
                                                        <li>Tambahkan akun jika tidak ada dalam opsi yang sesuai.</li>
                                                        <li>Pilih sub akun yang sesuai</li>
                                                        <li>Tambahkan sub akun jika tidak ada pada pilihan yang sesuai.</li></ol>"></i>
                                            <h6 class="info-kanan">info</h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                                id="resetData1">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @include('modals.tambah-akun')
                                    </div>
                                </div>
                            </div>

                            <table id="klasifikasiAkun" class="table table-bordered display responsive table-hover"
                                style="width: 100%">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Klasifikasi</th>
                                        <th>Usaha</th>
                                        <th>Akun</th>
                                        <th>Sub Akun 1</th>
                                        <th>Sub Akun 2</th>
                                        <th>Sub Akun 3</th>
                                        <th>Bukti Valid</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $noUrut = 1;
                                    @endphp
                                    @foreach ($dataAkun as $akun)
                                        <tr class="modal-trigger" data-toggle="modal" id="detailID"
                                            data-target="#detailKlasifikasi{{ $akun->id_key }}">
                                            <td style="width: 3%;">{{ $noUrut++ }}</td>
                                            <td style="width: 18%;">{{ $akun->klasifikasi_laporan }}</td>
                                            <td>{{ $akun->nama_usaha }}</td>
                                            <td style="width: 15%;">{{ $akun->akun }}</td>
                                            <td style="width: 13%;">{{ $akun->sub_akun_1 }}</td>
                                            <td style="width: 13%;">{{ $akun->sub_akun_2 }}</td>
                                            <td style="width: 13%;">{{ $akun->sub_akun_3 }}</td>
                                            <td>{{ $akun->bukti_valid_100rb }}<br>
                                                {{ $akun->bukti_valid_lebih100rb }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @foreach ($dataAkun as $akun)
                                <div class="modal fade" id="detailKlasifikasi{{ $akun->id_key }}" tabindex="-1"
                                    role="dialog" aria-labelledby="detailKlasifikasi{{ $akun->id_key }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                    Akun & Sub Akun
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close" id="reset">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            @include('modals.detail-klasifikasi')
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
        @if (session('error'))
            var errorModalId = "{{ session('errorModalId') }}";
            $(document).ready(function() {
                console.log(errorModalId);
                $('#detailKlasifikasi' + errorModalId).modal('show');
            });
        @endif
    </script>

    <script>
        $(document).ready(function() {
            // Tangani klik tombol Simpan
            $('#simpanButton').click(function() {
                // Tampilkan modal validasi
                $('#validasiModal').modal('show');
            });

            // Tangani klik tombol Batal pada modal validasi
            $('#close').click(function() {
                // Sembunyikan modal validasi
                $('#validasiModal').modal('hide');
                // Kembalikan modal tambahData
                $('#tambahData').modal('show');
            });

            // Tangani klik tombol Batal pada modal validasi
            $('#batalButton').click(function() {
                // Sembunyikan modal validasi
                $('#validasiModal').modal('hide');
                // Kembalikan modal tambahData
                $('#tambahData').modal('show');
            });
        });
    </script>

    <style>
        .modal-trigger {
            cursor: pointer;
        }
    </style>

    <style>
        .modal-header {
            position: relative;
        }

        .fa-info-circle {
            position: absolute;
            right: 90px;
            /* Sesuaikan posisi horizontal ikon info sesuai kebutuhan */
            top: 50%;
            /* Untuk menengahkan ikon secara vertikal */
            transform: translateY(-50%);
            /* Menengahkan ikon secara vertikal */
        }

        .info-kanan {
            position: absolute;
            right: 55px;
            top: 30%;
        }
    </style>

    <style>
        @media (max-width: 767px) {
            .modal-title {
                font-size: 1.1rem;
                /* Atur ukuran font menjadi lebih kecil untuk layar kecil */
            }

            .info-kanan {
                display: none;
                /* Sembunyikan elemen "info" pada layar kecil */
            }
        }
    </style>


    {{-- export data --}}
    <script>
        $(document).ready(function() {
            $('#exportButton').click(function() {
                // Get the selected filter values
                var klasifikasi = $('#klasifikasi').val();
                var usaha = $('#inputGroupSelect01').val();
                var akun = $('#inputGroupSelect02').val();

                // Create a flag to determine if any filters are applied
                var filtersApplied = (klasifikasi !== 'Semua Data' || usaha !== 'Semua Data' || akun !==
                    'Semua Data');

                // Create a new table for exporting
                var exportTable = $('#klasifikasiAkun').clone();

                // Check if no filters are applied, export all data
                if (!filtersApplied) {
                    exportTable.table2excel({
                        name: "Akun",
                        filename: "Akun.xlsx"
                    });
                } else {
                    // If any filter is applied, remove rows that don't match the selected filters
                    exportTable.find('tbody tr').each(function() {

                        var row = $(this);
                        var klasifikasiColumn = row.find('td:eq(1)').text();
                        var usahaColumn = row.find('td:eq(2)').text();
                        var akunColumn = row.find('td:eq(3)').text();

                        // Check if the row matches the selected filters
                        if ((klasifikasi === 'Semua Data' || klasifikasi === klasifikasiColumn) ||
                            (usaha === 'Semua Data' || usaha === usahaColumn) ||
                            (akun === 'Semua Data' || akun === akunColumn)) {
                            // If the row matches the selected filters, keep it
                            // Do nothing to this row, it will be included in the export
                        } else {
                            // If the row does not match the selected filters, remove it
                            row.remove();
                        }
                    });

                    // Export the filtered table to Excel
                    var filename = "Akun.xlsx";
                    exportTable.table2excel({
                        name: "Akun",
                        filename: filename
                    });
                }
            });
        });
    </script>

    {{-- modal tambah sub akun 1 --}}
    <script>
        // Fungsi untuk menampilkan modal
        function showNestedModal() {
            // Sembunyikan modal yang ada di belakang
            $('#tambahData').modal('hide');
            // Tampilkan modal yang baru
            $('#SubAkunModal').modal('show');
        }

        // Tambahkan event listener ke tombol
        $(document).ready(function() {
            $('.btn-success').on('click', function(e) {
                e.preventDefault();
                showNestedModal();
            });
        });
    </script>

    <script>
        // Variabel untuk menyimpan data akun dari PHP Blade
        var dataAkun = {!! json_encode($dataAkun) !!};

        // Mendapatkan elemen dropdown klasifikasi, usaha, dan akun
        var klasifikasiDropdown = document.getElementById("klasifikasi");
        var usahaDropdown = document.getElementById("inputGroupSelect01");
        var akunDropdown = document.getElementById("inputGroupSelect02");

        // Menangani pemilihan "Semua Data" pada dropdown klasifikasi
        klasifikasiDropdown.addEventListener("change", function() {

            dataAkun = {!! json_encode($dataAkun) !!};

            selectedKlasifikasi = klasifikasiDropdown.value;
            selectedUsaha = usahaDropdown.value;
            usahaDropdown.innerHTML = '<option value="" selected>Semua Data</option>';
            akunDropdown.innerHTML = '<option value="" selected>Semua Data</option>';

            var usahaOptions = [];
            var akunOptions = [];

            dataAkun.forEach(function(item) {
                if (selectedKlasifikasi === "") {
                    // Jika "Semua Data" dipilih pada klasifikasi, tampilkan semua usaha dan akun
                    if (!usahaOptions.includes(item.nama_usaha)) {
                        usahaOptions.push(item.nama_usaha);
                    }
                    if (!akunOptions.includes(item.akun)) {
                        akunOptions.push(item.akun);
                    }
                } else if (item.klasifikasi_laporan === selectedKlasifikasi) {

                    if (!usahaOptions.includes(item.nama_usaha)) {
                        usahaOptions.push(item.nama_usaha);
                    }

                    if (!akunOptions.includes(item.akun)) {
                        akunOptions.push(item.akun);
                    }
                }

            });

            usahaOptions.forEach(function(usaha) {
                var usahaOption = document.createElement("option");
                usahaOption.value = usaha;
                usahaOption.textContent = usaha;
                usahaDropdown.appendChild(usahaOption);
            });

            if (selectedKlasifikasi === "") {
                // Jika "Semua Data" dipilih pada klasifikasi, reset nilai usaha dan akun
                var KlasifikasiOption = document.createElement("option");
                selectedUsaha = "";
                selectedAkun = "";
            }
        });

        // Event listener untuk dropdown usaha
        usahaDropdown.addEventListener("change", function() {
            selectedUsaha = usahaDropdown.value;

            akunDropdown.innerHTML = '<option value="" selected>Semua Data</option>';

            var akunOptions = [];

            dataAkun.forEach(function(item) {
                if (selectedKlasifikasi === "" || item.klasifikasi_laporan === selectedKlasifikasi) {
                    if (selectedUsaha === "" || item.nama_usaha === selectedUsaha) {
                        if (!akunOptions.includes(item.akun)) {
                            akunOptions.push(item.akun);
                        }
                    }
                }
            });

            akunOptions.forEach(function(akun) {
                var akunOption = document.createElement("option");
                akunOption.value = akun;
                akunOption.textContent = akun;
                akunDropdown.appendChild(akunOption);
            });
        });


        $(document).ready(function() {
            let id; // Variabel di luar event handler

            // Ketika elemen 'tr' dengan id 'detailID' diklik
            $('tr#detailID').on('click', function() {
                console.log('aa');
                // Ambil nilai dari atribut 'data-target' pada elemen 'tr'
                var dataTargetValue = $(this).data('target');

                id = dataTargetValue.replace('#detailKlasifikasi', ''); // Mengisi variabel 'id'
                console.log(id);
            });

            $('button#batalHapusID').on('click', function() {
                console.log(id);
                $('#hapusModalDetail' + id).modal('hide'); // Menggunakan variabel 'id'
            });
        });
    </script>

    <script>
        // Fungsi untuk menutup modal ubahModalDetail
        function closeUbahModalDetail() {
            $('#ubahModalDetail').modal('hide');
        }

        // Fungsi untuk menutup modal hapusModalDetail
        // function closeHapusModalDetail() {
        //     console.log('adsfdsf');
        //     $('#hapusModalDetail').modal('hide');
        // }
    </script>
@endpush
