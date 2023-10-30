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
                        <li class="breadcrumb-item active">Klasifikasi & Akun</li>
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
                                    <strong class="font-weight-bold">
                                        <h4 style="color:#28a745;">KLASIFIKASI & AKUN</h4>
                                    </strong>
                                </div>
                                <div class="col-10">
                                    <div class="card">
                                        <div class="card-body p-3">
                                            <div class="row">
                                                <div class="col-12 col-md-3 mb-2">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"
                                                                for="klasifikasi">Klasifikasi</span>
                                                        </div>
                                                        <select class="custom-select" id="klasifikasi"
                                                            >
                                                            <option value="" selected>Semua Data</option>
                                                            @foreach ($dataKlasifikasi as $klasifikasi)
                                                                <option value="{{ $klasifikasi->klasifikasi_laporan }}"
                                                                    @if ($klasifikasi->klasifikasi_laporan === 'Semua') selected @endif>
                                                                    {{ $klasifikasi->klasifikasi_laporan }}</option>
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
                                                <div class="col-3 mb-2 pl-0">
                                                    <div class="d-flex flex-wrap">
                                                        <div class="col-md-6 pr-md-1 mb-2 mb-md-0">
                                                            <!-- Adjust the width as needed -->
                                                            <button id="exportButton" class="btn btn-outline-success w-100"
                                                                style="border-radius: 10px" type="button"
                                                                data-export="example2">
                                                                <i class="fas fa-file-excel"></i> Export
                                                            </button>
                                                        </div>
                                                        <div class="col-md-6 pl-md-1">
                                                            <button class="btn text-white w-100"
                                                                style="background-color: #28a745; border-radius: 10px;"
                                                                type="button" data-toggle="modal" data-target="#tambahData"
                                                                aria-expanded="false">
                                                                <i class="fas fa-plus-circle left-icon-holder"></i> Tambah
                                                            </button>
                                                        </div>
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
                                                {!! $modelHead !!} <i class="fas fa-info-circle" data-toggle="popover"
                                                    data-placement="right" data-html="true" title="Informasi!"
                                                    data-content="<ol>
                                                        <li>Silakan pilih klasifikasi yang tersedia.</li>
                                                        <li>Pilihlah unit usaha yang sesuai dengan klasifikasi.</li>
                                                        <li>Tambahkan unit usaha jika tidak ada pada pilihan yang sesuai.</li>
                                                        <li>Selanjutnya, pilih akun yang sesuai dengan unit usaha dan klasifikasi yang telah dipilih.</li>
                                                        <li>Tambahkan akun jika tidak ada pada pilihan yang sesuai.</li>
                                                        <li>Terakhir, pilih sub akun dari yang pertama hingga yang terakhir sesuai dengan klasifikasi, unit usaha, dan akun.</li>
                                                        <li>Tambahkan sub akun jika tidak ada pada pilihan yang sesuai.</li></ol>"></i>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                                id="reset">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @include('modals.tambah-akun')
                                    </div>
                                </div>
                            </div>

                            <table id="example2" class="table table-bordered table-hover">
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
                                        <tr>
                                            <td style="width: 3%;">{{ $noUrut++ }}</td>
                                            <td style="width: 18%;">{{ $akun->klasifikasi_laporan }}</td>
                                            <td>{{ $akun->nama_usaha }}</td>
                                            <td style="width: 15%;">{{ $akun->akun }}</td>
                                            <td style="width: 13%;">{{ $akun->sub_akun_1 }}</td>
                                            <td style="width: 13%;">{{ $akun->sub_akun_2 }}</td>
                                            <td style="width: 13%;">{{ $akun->sub_akun_3 }}</td>
                                            <td>Nota</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
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
                var exportTable = $('#example2').clone();

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

    {{-- filter data --}}
    
@endpush
