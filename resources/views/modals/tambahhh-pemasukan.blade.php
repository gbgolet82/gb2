<form action="#" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal-body">

        <div class="tab-content mt-1">
            <div class="tab-pane fade show active" id="nav-satu-tab" role="tabpanel" aria-labelledby="nav-satu-tab">

                <div id="form-lama">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="kode_laporan">KODE LAPORAN &nbsp;</label>
                            <sup class="badge rounded-pill badge-danger text-white"
                                style="background-color: rgba(230, 82, 82); font-size: 10px; padding: 4px 8px;">WAJIB</sup>
                            <input type="text" class="form-control @error('kode_laporan') is-invalid @enderror"
                                id="kode_laporan" placeholder="Masukan kode laporan" name="kode_laporan" value=""
                                readonly>
                            @error('kode_laporan')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tanggal_laporan">TANGGAL &nbsp;</label>
                            <sup class="badge rounded-pill badge-danger text-white"
                                style="background-color: rgba(230, 82, 82); font-size: 10px; padding: 4px 8px;">WAJIB</sup>
                            <input type="datetime-local"
                                class="form-control @error('tanggal_laporan') is-invalid @enderror" id="tanggalLaporan"
                                name="tanggal_laporan"
                                value="{{ old('tanggal_laporan',\Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d\TH:i:s')) }}">

                            @error('tanggal_laporan')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="id_kasir">KASIR &nbsp;</label>
                            <sup class="badge rounded-pill badge-danger text-white"
                                style="background-color: rgba(230, 82, 82); font-size: 10px; padding: 4px 8px;">WAJIB</sup>
                            <input type="text" class="form-control @error('id_kasir') is-invalid @enderror"
                                id="namaKasir" placeholder="Masukan nama kasir" name="id_kasir"
                                value="{{ session('nama') }}" readonly>
                            {{-- <input type="hidden" name="id_manager" value="{{ $managerId }}"> --}}
                            @error('id_kasir')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="id_usaha">UNIT USAHA &nbsp;</label>
                            <sup class="badge rounded-pill badge-danger text-white"
                                style="background-color: rgba(230, 82, 82); font-size: 10px; padding: 4px 8px;">WAJIB</sup>
                            <input type="text" class="form-control @error('id_usaha') is-invalid @enderror"
                                id="namaUsaha" placeholder="Masukan nama usaha" name="id_usaha"
                                value="{{ $usaha->nama_usaha }}" readonly>
                            @error('id_usaha')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row ">
                        <div class="form-group col-md-6">
                            <label for="cariAkun">AKUN &nbsp;</label>
                            <sup class="badge rounded-pill badge-danger text-white mb-2"
                                style="background-color: rgba(230, 82, 82)">WAJIB</sup>
                            <select class="custom-select" name="id_akun" id="inputGroupAkun">
                                <option disabled selected hidden>Pilih Akun</option>
                                @foreach ($akunOptions as $dataAkun)
                                    <option value="{{ $dataAkun->id_akun }}"
                                        @if ($dataAkun->akun === 'Semua') selected @endif>
                                        {{ $dataAkun->akun }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cariSubAkun1">SUB AKUN 1 &nbsp;</label>
                            <sup class="badge rounded-pill badge-danger text-white mb-2"
                                style="background-color: rgba(230, 82, 82)">WAJIB</sup>
                            <select class="custom-select" name="id_sub_akun_1" id="inputGroupSubAkun1">
                                <option disabled selected hidden>Pilih Sub Akun 1</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        {{-- <div class="form-group col-md-6">
                            <label for="cariSubAkun2">SUB AKUN 2 &nbsp;</label>
                            <select class="custom-select" name="sub_akun_2" id="inputGroupSubAKun2">
                                <option selected>Pilih Sub Akun 2</option>
                            </select>
                        </div> --}}
                        <div class="form-group col-md-6">
                            <label for="cariSubAkun2">SUB AKUN 2 &nbsp;</label>
                            <sup class="badge rounded-pill badge-danger text-white mb-2"
                                style="background-color: rgba(230, 82, 82)">WAJIB</sup>
                            <select class="custom-select" name="id_sub_akun_2" id="inputGroupSubAkun2">
                                <option disabled selected hidden>Pilih Sub Akun 2</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="cariSubAkun3">SUB AKUN 3 &nbsp;</label>
                            <sup class="badge rounded-pill badge-danger text-white mb-2"
                                style="background-color: rgba(230, 82, 82)">WAJIB</sup>
                            <select class="custom-select" name="id_sub_akun_3" id="inputGroupSubAkun3">
                                <option disabled selected hidden>Pilih Sub Akun 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nominal">NOMINAL &nbsp;</label>
                            <sup class="badge rounded-pill badge-danger text-white"
                                style="background-color: rgba(230, 82, 82); font-size: 10px; padding: 4px 8px;">WAJIB</sup>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" class="form-control @error('nominal') is-invalid @enderror"
                                    id="besarNominal" placeholder="Masukan nominal" name="nominal" value=""
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                @error('nominal')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="gambarBukti">GAMBAR BUKTI &nbsp;</label>
                            <sup class="badge rounded-pill badge-danger text-white mb-2"
                                style="background-color: rgba(230, 82, 82)">WAJIB</sup>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input gambar_bukti" id="customFileInput"
                                        accept="images/png, images/gif, images/jpeg, images/pdf"
                                        aria-describedby="customFileInput" name="gambar_bukti"
                                        onchange="updateLabel()">
                                    <label class="custom-file-label" for="customFileInput"
                                        aria-describedby="customFileInput">Pilih file</label>
                                </div>
                            </div>
                        </div>

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

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="status_cek">STATUS CEK &nbsp;</label>
                            <sup class="badge rounded-pill badge-danger text-white"
                                style="background-color: rgba(230, 82, 82); font-size: 10px; padding: 4px 8px;">WAJIB</sup>
                            <input type="text" class="form-control @error('status_cek') is-invalid @enderror"
                                id="statusCek" placeholder="Status cek" name="status_cek" value="Belum Dicek"
                                readonly>
                        </div>
                    </div>
                    <div class="d-flex bd-highlight justify-content-end mt-3">
                        <div class="bd-highlight">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="resetData"><i
                                    class="fa fa-ban"></i>
                                Tutup</button>
                            <button type="submit" class="btn btn-success text-white toastrDefaultSuccess"
                                id="simpanPemasukan"><i class="fas fa-save" onclick="validateForm()"></i>
                                Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@push('script')
    <script>
         $(document).ready(function() {
            var kodeLaporan = document.getElementById("kode_laporan");
            kodeLaporan.value = "{{ $kodeLaporan }}";
        });

        $(document).ready(function() {
            // $('#inputGroupAkun').select2();
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
                    url: '/get-sub-akun-1-select/' + selectedAkunId,
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
                    url: '/get-sub-akun-2-select/' +
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
                    url: '/get-sub-akun-3-select/' + selectedAkunId,
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
    </script>
@endpush
