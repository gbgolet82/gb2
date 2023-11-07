<style>
    .badge-abu {
        position: relative;
        top: -1px;
        left: 10px;
        font-size: 14px;
        padding: 3px 5px;
        font-size: 14px;
        border-radius: 10px;
        background-color: #6c757d;
        color: #fff;
    }
</style>

@php
    $selectedRole = session('selectedRole');
    $karyawanRoles = session('karyawanRoles');
    $session = session('nama_usaha');
@endphp

<form action="{{ route('tambah.pengeluaran') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal-body">
        <div class="tab-content mt-1">
            <div class="tab-pane fade show active" id="nav-satu-tab" role="tabpanel" aria-labelledby="nav-satu-tab">

                <div class="d-flex mb-3">
                    <span class="text-bold d-flex align-items-center" style="font-size: 16px">Tambah Data
                        Pengeluaran</span>
                    <span class="text-bold ml-auto text-center">
                        {{ Carbon\Carbon::now()->locale('id_ID')->isoFormat('D MMMM Y') }}</span>
                    {{-- <span class="ml-auto mr-3 text-center badge-abu">Belum Tersimpan</span> --}}
                </div>
                <div class="card" style="border-radius: 10px">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <span>Kode Laporan</span><br>
                                <span class="text-bold kode_laporan">-</span>
                                <input type="hidden" id="kode_laporan" name="kode_laporan" value="">
                            </div>
                            @if (
                                (($karyawanRoles->count() == 1 && $karyawanRoles->contains('kasir')) || $selectedRole == 'kasir') &&
                                    $session != 'SEMUA')
                                <div class="col-4">
                                    <span>Unit Usaha</span><br>
                                    <span class="text-bold">{{ session('nama_usaha') }}</span>
                                    <input type="hidden" name="id_usaha" value="{{ session('nama_usaha') }}">
                                </div>
                            @else
                                <div class="col-4">
                                    <span>Unit Usaha</span><br>
                                    <span class="text-bold"><a href="" id="toggleForm"
                                            style="color: #212529">Belum pilih&nbsp;&nbsp;<i class="fa fa-edit"></i>
                                        </a></span>
                                </div>
                            @endif
                            <div class="col-4">
                                <span>Kasir</span><br>
                                <span class="text-bold">{{ session('nama') }}</span>
                                <input type="hidden" name="id_kasir" value="{{ session('nama') }}">
                                <input type="hidden" name="tanggal_laporan"
                                    value="{{ old('tanggal_laporan',\Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d\TH:i:s')) }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div id="formContainer" style="display: none;">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputUsaha">USAHA &nbsp;</label>
                            <select class="custom-select" name="id_usaha" id="Input_Usaha">
                                <option disabled selected hidden>Pilih Usaha</option>
                                @foreach ($usahaOption as $dataUsaha)
                                    <option value="{{ $dataUsaha->id_usaha }}"
                                        @if ($dataUsaha->nama_usaha === 'Semua') selected @endif>
                                        {{ $dataUsaha->nama_usaha }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="cariKlasifikasi">KLASIFIKASI &nbsp;</label>
                        <select class="custom-select" name="id_klasifikasi" id="inputGroupKlasifikasi">
                            <option disabled selected hidden>Pilih Klasifikasi</option>
                            @foreach ($klasifikasiOptions as $dataKlasifikasi)
                                <option value="{{ $dataKlasifikasi->id_klasifikasi }}"
                                    data-klasifikasi="{{ $dataKlasifikasi->klasifikasi_laporan }}"
                                    @if ($dataKlasifikasi->klasifikasi_laporan === 'Semua') selected @endif>
                                    {{ $dataKlasifikasi->klasifikasi_laporan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="cariAkun">AKUN &nbsp;</label>
                        <select class="custom-select" name="id_akun" id="inputGroupAkun">
                            <option disabled selected hidden>Pilih Akun</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="cariSubAkun1">SUB AKUN 1 &nbsp;</label>
                        <select class="custom-select" name="id_sub_akun_1" id="inputGroupSubAkun1">
                            <option disabled selected hidden>Pilih Sub Akun 1</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="cariSubAkun2">SUB AKUN 2 &nbsp;</label>
                        <select class="custom-select" name="id_sub_akun_2" id="inputGroupSubAkun2">
                            <option disabled selected hidden>Pilih Sub Akun 2</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="cariSubAkun3">SUB AKUN 3 &nbsp;</label>
                        <select class="custom-select" name="id_sub_akun_3" id="inputGroupSubAkun3">
                            <option disabled selected hidden>Pilih Sub Akun 3</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nominal">NOMINAL &nbsp;</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="text" class="form-control @error('nominal') is-invalid @enderror"
                                id="besarNominal" placeholder="Masukan nominal" name="nominal" value=""
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                            @error('nominal')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                    <div class="form-group col-md-6">
                        <label for="gambarBukti">GAMBAR BUKTI &nbsp;</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input gambar_bukti" id="customFileInput"
                                    accept="images/png, images/gif, images/jpeg, images/pdf"
                                    aria-describedby="customFileInput" name="gambar_bukti" onchange="updateLabel()">
                                <label class="custom-file-label" for="customFileInput"
                                    aria-describedby="customFileInput">Pilih
                                    file</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex bd-highlight justify-content-end mt-3">
                    <div class="bd-highlight">
                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal" id="resetData"><i
                                class="fa fa-ban"></i>
                            Batal</button>
                        <button type="submit" class="btn btn-success text-white toastrDefaultSuccess"
                            id="simpanPemasukan"><i class="fas fa-save" onclick="validateForm()"></i>
                            Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@push('script')
    <script>
        $(document).ready(function() {
            $("#toggleForm").click(function(e) {
                e.preventDefault(); // Prevent the default link behavior (navigating to a new page)

                // Toggle the visibility of the form container
                $("#formContainer").toggle();
            });
        });

        $(document).ready(function() {
            $('#Input_Usaha').change(function() {
                var selectedOption = $(this).children("option:selected").text();
                $('#toggleForm').text(selectedOption);
            });
        });

        $(document).ready(function() {
            // Memantau perubahan dropdown "KLASIFIKASI"
            $('#inputGroupKlasifikasi').change(function() {
                var selectedKlasifikasi = $(this).find(':selected').data('klasifikasi');
                var kodeLaporan = '';

                if (selectedKlasifikasi === 'Pengeluaran OP') {
                    kodeLaporan = '{{ $kodeOP }}';
                } else if (selectedKlasifikasi === 'Pengeluaran NOP') {
                    kodeLaporan = '{{ $kodeNOP }}';
                }

                // Memperbarui tampilan kode laporan sesuai dengan pilihan
                $('.kode_laporan').text(kodeLaporan);
                $('#kode_laporan').val(kodeLaporan);
            });
        });
    </script>
    <script>
        function updateLabel() {
            const input = document.getElementById("customFileInput");
            const label = document.querySelector("[for='customFileInput']");
            if (input.files.length > 0) {
                label.textContent = input.files[0].name;
            } else {
                label.textContent = "Pilih file";
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#inputGroupAkun').select2();
            $('#inputGroupSubAkun1').select2();
            $('#inputGroupSubAkun2').select2();
            $('#inputGroupSubAkun3').select2();
        });



        function formatRupiah(angka, prefix) {
            var number_string = (angka).toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return rupiah;
        }

        $("#besarNominal").on('input', function() {
            var besarNominal = $('#besarNominal').val();
            besarNominal = besarNominal.split('.').join("");
            $('#besarNominal').val(formatRupiah(besarNominal, ''));
        });

        $(document).ready(function() {
            $('#inputGroupKlasifikasi').change(function() {
                var selectedKlasifikasiId = $(this).val();
                $('#inputGroupAkun').change(function() {
                    if ($(this).val() === 'Pilih Akun' || $(this).val() === '?') {
                        $(this).val(null);
                    }
                });

                // console.log(selectedAkunId);

                // Lakukan permintaan AJAX ke endpoint yang mengembalikan opsi sub akun 1 berdasarkan id_akun yang dipilih.
                $.ajax({
                    url: '/get-akun-opsi/' + selectedKlasifikasiId,
                    type: 'GET',
                    success: function(data) {
                        // Perbarui opsi sub akun 1 dengan data yang diterima dari server.
                        $('#inputGroupAkun').empty();
                        $('#inputGroupAkun').append($('<option>', {
                            value: null,
                            text: 'Pilih Akun',
                            // disabled: 'disabled'
                        }));
                        $.each(data, function(key, value) {
                            // console.log(key);
                            $('#inputGroupAkun').append($('<option>', {
                                value: key,
                                text: value
                            }));
                        });
                    }
                });
            });

            $('#inputGroupAkun').change(function() {
                var selectedAkunId = $(this).val();
                $('#inputGroupSubAkun1').change(function() {
                    if ($(this).val() === 'Pilih Sub Akun 1' || $(this).val() === '?') {
                        $(this).val(null);
                    }
                });

                // console.log(selectedAkunId);

                // Lakukan permintaan AJAX ke endpoint yang mengembalikan opsi sub akun 1 berdasarkan id_akun yang dipilih.
                $.ajax({
                    url: '/get-sub-akun-1-opsi/' + selectedAkunId,
                    type: 'GET',
                    success: function(data) {
                        // Perbarui opsi sub akun 1 dengan data yang diterima dari server.
                        $('#inputGroupSubAkun1').empty();
                        $('#inputGroupSubAkun1').append($('<option>', {
                            value: null,
                            text: 'Pilih Sub Akun 1',
                            // disabled: 'disabled'
                        }));
                        $.each(data, function(key, value) {
                            // console.log(key);
                            $('#inputGroupSubAkun1').append($('<option>', {
                                value: key,
                                text: value
                            }));
                        });
                    }
                });
            });

            $('#inputGroupSubAkun1').change(function() {
                var selectedAkunId = $('#inputGroupSubAkun1').val(); // Menggunakan ID dari #inputGroupAkun
                $('#inputGroupSubAkun2').change(function() {
                    if ($(this).val() === 'Pilih Sub Akun 2' || $(this).val() === '?') {
                        $(this).val(null);
                    }
                });

                // Lakukan permintaan AJAX ke endpoint yang mengembalikan opsi sub akun 2 berdasarkan id_akun yang dipilih.
                $.ajax({
                    url: '/get-sub-akun-2-opsi/' +
                        selectedAkunId, // Menggunakan ID dari #inputGroupAkun
                    type: 'GET',
                    success: function(data) {
                        // Perbarui opsi sub akun 2 dengan data yang diterima dari server.
                        $('#inputGroupSubAkun2').empty();
                        $('#inputGroupSubAkun2').append($('<option>', {
                            value: null,
                            text: 'Pilih Sub Akun 2'
                        }));
                        $.each(data, function(key, value) {
                            $('#inputGroupSubAkun2').append($('<option>', {
                                value: key,
                                text: value
                            }));
                        });
                    }
                });
            });


            $('#inputGroupSubAkun2').change(function() {
                var selectedAkunId = $('#inputGroupSubAkun2').val();
                $('#inputGroupSubAkun3').change(function() {
                    if ($(this).val() === 'Pilih Sub Akun 3' || $(this).val() === '?') {
                        $(this).val(null);
                    }
                });

                // Lakukan permintaan AJAX ke endpoint yang mengembalikan opsi sub akun 1 berdasarkan id_akun yang dipilih.
                $.ajax({
                    url: '/get-sub-akun-3-opsi/' + selectedAkunId,
                    type: 'GET',
                    success: function(data) {
                        // Perbarui opsi sub akun 1 dengan data yang diterima dari server.
                        $('#inputGroupSubAkun3').empty();
                        $('#inputGroupSubAkun3').append($('<option>', {
                            value: null,
                            text: 'Pilih Sub Akun 3',
                            // disabled: 'disabled'
                        }));
                        $.each(data, function(key, value) {
                            // console.log(key);
                            $('#inputGroupSubAkun3').append($('<option>', {
                                value: key,
                                text: value
                            }));
                        });
                    }
                });
            });
        });

        @if (
            (($karyawanRoles->count() == 1 && $karyawanRoles->contains('kasir')) || $selectedRole == 'kasir') &&
                $session == 'SEMUA')
            $(document).ready(function() {
                $('#Input_Usaha, #inputGroupKlasifikasi').change(function() {
                    var selectedUsaha = $('#Input_Usaha').val();
                    var selectedKlasifikasi = $('#inputGroupKlasifikasi').val();
                    // console.log(selectedUsaha);
                    $('#inputGroupAkun').change(function() {
                        if ($(this).val() === 'Pilih Akun' || $(this).val() === '?') {
                            $(this).val(null);
                        }
                    });

                    // console.log(selectedAkunId);

                    if (selectedUsaha && selectedKlasifikasi !== null && selectedKlasifikasi !== '') {
                        // Lakukan permintaan AJAX ke endpoint yang mengembalikan opsi sub akun 1 berdasarkan id_akun yang dipilih.
                        $.ajax({
                            url: '/ambil-akun-pengeluaran/' + selectedUsaha + '/' +
                                selectedKlasifikasi,
                            type: 'GET',
                            success: function(data) {
                                console.log(data);
                                // Perbarui opsi sub akun 1 dengan data yang diterima dari server.
                                $('#inputGroupAkun').empty();
                                $('#inputGroupAkun').append($('<option>', {
                                    value: null,
                                    text: 'Pilih Akun',
                                    // disabled: 'disabled'
                                }));
                                $.each(data, function(key, value) {
                                    // console.log(key);
                                    $('#inputGroupAkun').append($('<option>', {
                                        value: key,
                                        text: value
                                    }));
                                });
                            }
                        });
                    }
                });

                $('#inputGroupAkun').change(function() {
                    var selectedAkunId = $(this).val();
                    $('#inputGroupSubAkun1').change(function() {
                        if ($(this).val() === 'Pilih Sub Akun 1' || $(this).val() === '?') {
                            $(this).val(null);
                        }
                    });

                    // console.log(selectedAkunId);

                    // Lakukan permintaan AJAX ke endpoint yang mengembalikan opsi sub akun 1 berdasarkan id_akun yang dipilih.
                    $.ajax({
                        url: '/get-sub-akun-1-opsi/' + selectedAkunId,
                        type: 'GET',
                        success: function(data) {
                            // Perbarui opsi sub akun 1 dengan data yang diterima dari server.
                            $('#inputGroupSubAkun1').empty();
                            $('#inputGroupSubAkun1').append($('<option>', {
                                value: null,
                                text: 'Pilih Sub Akun 1',
                                // disabled: 'disabled'
                            }));
                            $.each(data, function(key, value) {
                                // console.log(key);
                                $('#inputGroupSubAkun1').append($('<option>', {
                                    value: key,
                                    text: value
                                }));
                            });
                        }
                    });
                });

                $('#inputGroupSubAkun1').change(function() {
                    var selectedAkunId = $('#inputGroupSubAkun1')
                        .val(); // Menggunakan ID dari #inputGroupAkun
                    $('#inputGroupSubAkun2').change(function() {
                        if ($(this).val() === 'Pilih Sub Akun 2' || $(this).val() === '?') {
                            $(this).val(null);
                        }
                    });

                    // Lakukan permintaan AJAX ke endpoint yang mengembalikan opsi sub akun 2 berdasarkan id_akun yang dipilih.
                    $.ajax({
                        url: '/get-sub-akun-2-opsi/' +
                            selectedAkunId, // Menggunakan ID dari #inputGroupAkun
                        type: 'GET',
                        success: function(data) {
                            // Perbarui opsi sub akun 2 dengan data yang diterima dari server.
                            $('#inputGroupSubAkun2').empty();
                            $('#inputGroupSubAkun2').append($('<option>', {
                                value: null,
                                text: 'Pilih Sub Akun 2'
                            }));
                            $.each(data, function(key, value) {
                                $('#inputGroupSubAkun2').append($('<option>', {
                                    value: key,
                                    text: value
                                }));
                            });
                        }
                    });
                });


                $('#inputGroupSubAkun2').change(function() {
                    var selectedAkunId = $('#inputGroupSubAkun2').val();
                    $('#inputGroupSubAkun3').change(function() {
                        if ($(this).val() === 'Pilih Sub Akun 3' || $(this).val() === '?') {
                            $(this).val(null);
                        }
                    });

                    // Lakukan permintaan AJAX ke endpoint yang mengembalikan opsi sub akun 1 berdasarkan id_akun yang dipilih.
                    $.ajax({
                        url: '/get-sub-akun-3-opsi/' + selectedAkunId,
                        type: 'GET',
                        success: function(data) {
                            // Perbarui opsi sub akun 1 dengan data yang diterima dari server.
                            $('#inputGroupSubAkun3').empty();
                            $('#inputGroupSubAkun3').append($('<option>', {
                                value: null,
                                text: 'Pilih Sub Akun 3',
                                // disabled: 'disabled'
                            }));
                            $.each(data, function(key, value) {
                                // console.log(key);
                                $('#inputGroupSubAkun3').append($('<option>', {
                                    value: key,
                                    text: value
                                }));
                            });
                        }
                    });
                });
            });
        @endif
    </script>
@endpush
