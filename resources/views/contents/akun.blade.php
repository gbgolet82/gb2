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
                                <div class="col-2 mt-3">
                                    <strong class="font-weight-bold text-center">
                                        <h4 style="color:#28a745;">AKUN & SUB AKUN</h4>
                                    </strong>
                                </div>
                                <div class="col-10">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 col-md-4 mb-2">
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
                                                <div class="col-12 col-md-4 mb-2">
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
                                                <div class="col-12 col-md-4 mb-2">
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
                                            </div>
                                            <div class="row ">
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
                                                <div class="col-12 col-md-3">
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

                            <table id="klasifikasiAkun" class="table table-bordered table-hover">
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
                                        <tr class="modal-trigger" data-toggle="modal"
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
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
                                    data-backdrop="static">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                    Klasifikasi & Akun
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

    {{-- export data menggunakan times new roman tetapi gridlines nya ilang --}}
    {{-- <script>
        $(document).ready(function() {
            $('#exportButton').click(function() {
                // Get the selected filter values
                var klasifikasi = $('#klasifikasi').val();
                var usaha = $('#inputGroupSelect01').val();
                var akun = $('#inputGroupSelect02').val();

                // Create a flag to determine if any filters are applied
                var filtersApplied = (klasifikasi !== 'Semua' || usaha !== 'Semua' || akun !== 'Semua');

                // Create a new table for exporting
                var exportTable = $('#example2').clone();

                // If filters are applied, remove rows that don't match the filters
                if (filtersApplied) {
                    exportTable.find('tbody tr').each(function() {
                        var row = $(this);
                        var klasifikasiColumn = row.find('td:eq(1)').text();
                        var usahaColumn = row.find('td:eq(2)').text();
                        var akunColumn = row.find('td:eq(3)').text();

                        if ((klasifikasi !== 'Semua' && klasifikasi !== klasifikasiColumn) ||
                            (usaha !== 'Semua' && usaha !== usahaColumn) ||
                            (akun !== 'Semua' && akun !== akunColumn)) {
                            row.remove();
                        }
                    });
                }

                // Set the font style to "Times New Roman" for the entire table
                exportTable.css("font-family", "Times New Roman");

                // Convert the HTML table to Excel and download it
                var htmlTable = exportTable[0].outerHTML;
                var blob = new Blob([htmlTable], {
                    type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                });
                var url = URL.createObjectURL(blob);
                var a = document.createElement("a");
                a.href = url;
                a.download = "klasifikasi&akun.xlsx";
                a.click();
            });
        });
    </script> --}}

    {{-- filter data --}}
    {{-- <script>
        $(document).ready(function() {
            $('#inputGroupSelect01').change(function() {
                var selectedOption = $(this).val(); // Mendapatkan nilai yang dipilih

                if (selectedOption === "Semua Data") {
                    // Jika "Semua Data" dipilih, tampilkan semua data yang sesuai dengan pilihan
                    // Misalnya, Anda dapat menampilkan semua data yang tersembunyi atau menghapus filter yang ada
                    $("#data-container .filterable-row").show();
                } else {
                    // Logika untuk menampilkan data sesuai dengan nilai yang dipilih
                    // Misalnya, sembunyikan semua data terlebih dahulu
                    $("#data-container .filterable-row").hide();

                    // Kemudian tampilkan data yang sesuai dengan pilihan
                    // Misalnya, $("#data-container .filterable-row[data-usaha='" + selectedOption + "']").show();
                }
            });
        });
    </script> --}}

    {{-- export data --}}
    <script>
        $(document).ready(function() {
            $('#exportButton').click(function() {
                // Get the selected filter values
                var klasifikasi = $('#klasifikasi').val();
                var usaha = $('#inputGroupSelect01').val();
                var akun = $('#inputGroupSelect02').val();

                // Create a flag to determine if any filters are applied
                var filtersApplied = (klasifikasi !== 'Semua' || usaha !== 'Semua' || akun !== 'Semua');

                // Create a new table for exporting
                var exportTable = $('#klasifikasiAkun').clone();

                // Mengatur gaya font untuk sel tertentu
                exportTable.find('td').css({
                    "font-family": "Arial", // Ganti dengan font yang Anda inginkan
                    "font-size": "12px", // Ganti dengan ukuran font yang Anda inginkan
                    "font-weight": "bold" // Ganti dengan atribut lain yang Anda inginkan
                });

                // If filters are applied, remove rows that don't match the filters
                if (filtersApplied) {
                    exportTable.find('tbody tr').each(function() {
                        var row = $(this);
                        var klasifikasiColumn = row.find('td:eq(1)').text();
                        var usahaColumn = row.find('td:eq(2)').text();
                        var akunColumn = row.find('td:eq(3)').text();

                        if ((klasifikasi !== 'Semua' && klasifikasi !== klasifikasiColumn) ||
                            (usaha !== 'Semua' && usaha !== usahaColumn) ||
                            (akun !== 'Semua' && akun !== akunColumn)) {
                            row.remove();
                        }
                    });
                }

                // Export the table to Excel
                var filename = "Klasifikasi&Akun.xlsx";
                exportTable.table2excel({
                    name: "Klasifikasi&Akun",
                    filename: filename
                });
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

    {{-- <script>
        // Fetch data from the controller
        $.get('/get-data-for-dropdowns', function(data) {
            var klasifikasiOptions = data.klasifikasiOptions;
            var usahaOptions = data.usahaOptions;
            var akunOptions = data.akunOptions;

            // Populate Klasifikasi dropdown
            var klasifikasiDropdown = $('#klasifikasi');
            klasifikasiDropdown.empty();
            klasifikasiDropdown.append('<option value="">Semua Data</option>');
            klasifikasiOptions.forEach(function(option) {
                klasifikasiDropdown.append('<option value="' + option + '">' + option + '</option>');
            });

            // Function to populate Usaha dropdown based on selected Klasifikasi
            function populateUsahaDropdown(selectedKlasifikasi) {
                var usahaDropdown = $('#usaha');
                usahaDropdown.empty();
                usahaDropdown.append('<option value="">Semua Data</option>');
                usahaOptions[selectedKlasifikasi].forEach(function(option) {
                    usahaDropdown.append('<option value="' + option + '">' + option + '</option>');
                });

                // Trigger change event to update Akun dropdown
                usahaDropdown.change();
            }

            // Event listener for changes in the "Klasifikasi" dropdown
            klasifikasiDropdown.change(function() {
                var selectedKlasifikasi = $(this).val();
                populateUsahaDropdown(selectedKlasifikasi);
            });

            // Function to populate Akun dropdown based on selected Usaha
            function populateAkunDropdown(selectedUsaha) {
                var akunDropdown = $('#akun');
                akunDropdown.empty();
                akunDropdown.append('<option value="">Semua Data</option>');
                akunOptions[selectedUsaha].forEach(function(option) {
                    akunDropdown.append('<option value="' + option + '">' + option + '</option>');
                });
            }

            // Event listener for changes in the "Usaha" dropdown
            $('#usaha').change(function() {
                var selectedUsaha = $(this).val();
                populateAkunDropdown(selectedUsaha);
            });

            // Trigger the initial population of Usaha dropdown
            klasifikasiDropdown.change();
        });
    </script> --}}

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

            akunOptions.forEach(function(akun) {
                var akunOption = document.createElement("option");
                akunOption.value = akun;
                akunOption.textContent = akun;
                akunDropdown.appendChild(akunOption);
            });

            if (selectedKlasifikasi === "") {
                // Jika "Semua Data" dipilih pada klasifikasi, reset nilai usaha dan akun
                var KlasifikasiOption = document.createElement("option");
                selectedUsaha = "";
                selectedAkun = "";
            }

        });
    </script>
@endpush
