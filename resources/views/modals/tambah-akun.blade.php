<form action="{{ route('tambah.akun') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal-body">
        <div class="tab-content mt-1">
            <div class="tab-pane fade show active" id="nav-satu-tab" role="tabpanel" aria-labelledby="nav-satu-tab">

                <div id="form-lama">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cariKlasifikasi">KLASIFIKASI &nbsp;</label>
                            <sup class="badge rounded-pill badge-danger text-white mb-2"
                                style="background-color:rgba(230,82,82)">WAJIB</sup>
                            <select class="custom-select @error('klasifikasi') is-invalid @enderror"
                                id="inputGroupKlasifikasi" name="klasifikasi">
                                <option value="" disabled selected>Pilih Klasifikasi</option>
                                @php
                                    $uniqueAkun = [];
                                @endphp
                                @foreach ($dataAkun as $klasifikasi)
                                    @if (!empty($klasifikasi->klasifikasi_laporan) && !in_array($klasifikasi->klasifikasi_laporan, $uniqueAkun))
                                        <option value="{{ $klasifikasi->klasifikasi_laporan }}">
                                            {{ $klasifikasi->klasifikasi_laporan }}</option>
                                        @php
                                            $uniqueAkun[] = $klasifikasi->klasifikasi_laporan;
                                        @endphp
                                    @endif
                                @endforeach
                            </select>
                            @error('klasifikasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="cariUnitUsaha">UNIT USAHA &nbsp;</label>
                            <sup class="badge rounded-pill badge-danger text-white mb-2"
                                style="background-color: rgba(230, 82, 82)">WAJIB</sup>
                            <div class="d-flex align-items-center">
                                <select class="custom-select @error('usaha') is-invalid @enderror" id="inputGroupUsaha"
                                    name="usaha">
                                    <option value="" disabled selected>Pilih Unit Usaha</option>
                                    @php
                                        $uniqueUsaha = [];
                                    @endphp
                                    @foreach ($dataAkun as $usaha)
                                        @if (!empty($usaha->nama_usaha) && !in_array($usaha->nama_usaha, $uniqueUsaha))
                                            <option value="{{ $usaha->nama_usaha }}">{{ $usaha->nama_usaha }}</option>
                                            @php
                                                $uniqueUsaha[] = $usaha->nama_usaha;
                                            @endphp
                                        @endif
                                    @endforeach
                                </select>
                                @error('usaha')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12" id="akunCol">
                            <div class="form-group">
                                <label for="cariAkun">AKUN &nbsp;</label>
                                <sup class="badge rounded-pill badge-danger text-white mb-2"
                                    style="background-color: rgba(230, 82, 82)">WAJIB</sup>
                                <select class="custom-select" name="akun" id="inputGroupAkun">
                                    <option value="" disabled selected>Pilih Akun</option>
                                    <option value="tambah-akun-baru">Tambah Akun Baru</option>
                                    @php
                                        $uniqueAkun = [];
                                    @endphp
                                    @foreach ($dataAkun as $akun)
                                        <option value="{{ $akun->akun }}">{{ $akun->akun }}</option>
                                        @php
                                            $uniqueAkun[] = $akun->akun;
                                        @endphp
                                    @endforeach
                                </select>
                                @error('akun')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12" id="inputAkunBaru">
                            <div class="form-group">
                                <label for="akunBaru">AKUN BARU &nbsp;</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="input_Akun_Baru"
                                        placeholder="Masukan Akun Baru">
                                </div>
                                @error('input_Akun_Baru')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- SUB AKUN --}}
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="cariSubAkun1">SUB AKUN 1 &nbsp;</label>
                            <div class="d-flex align-items-center">
                                <select class="custom-select" name="sub_akun_1" id="inputGroupSubAkun1">
                                    <option value="" disabled selected>Pilih Sub Akun 1</option>
                                    <option value="tambah-sub-akun-1-baru">Tambah Sub Akun 1 Baru</option>
                                    @php
                                        $uniqueSubAkun1 = [];
                                    @endphp
                                    @foreach ($dataAkun as $subakun1)
                                        @if (!empty($subakun1->sub_akun_1) && !in_array($subakun1->sub_akun_1, $uniqueSubAkun1))
                                            <option value="{{ $subakun1->sub_akun_1 }}"
                                                data-akun="{{ $subakun1->akun }}">
                                                {{ $subakun1->sub_akun_1 }}
                                            </option>
                                            @php
                                                $uniqueSubAkun1[] = $subakun1->sub_akun_1;
                                            @endphp
                                        @endif
                                    @endforeach
                                </select>
                                @error('sub_akun_1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Tambahkan elemen input dengan id "inputAkunBaru" -->
                    <div class="form-row" id="inputSubAkun1Baru" style="display: none">
                        <div class="form-group col-md-12">
                            <label for="akunBaru">SUB AKUN BARU 1&nbsp;</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="input_Sub_Akun_1_Baru"
                                    placeholder="Masukan Sub Akun 1 Baru">
                            </div>
                            @error('input_Sub_Akun_1_Baru')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="cariSubAkun2">SUB AKUN 2 &nbsp;</label>
                            <div class="d-flex align-items-center">
                                <select class="custom-select" name="sub_akun_2" id="inputGroupSubAkun2">
                                    <option value="" disabled selected>Pilih Sub Akun 2</option>
                                    <option value="tambah-sub-akun-2-baru">Tambah Sub Akun 2 Baru</option>
                                    @php
                                        $uniqueSubAkun2 = [];
                                    @endphp
                                    @foreach ($dataAkun as $subakun2)
                                        @if (!empty($subakun2->sub_akun_2) && !in_array($subakun2->sub_akun_2, $uniqueSubAkun2))
                                            <option value="{{ $subakun2->sub_akun_2 }}"
                                                data-akun="{{ $subakun2->akun }}">{{ $subakun2->sub_akun_2 }}
                                            </option>
                                            @php
                                                $uniqueSubAkun2[] = $subakun2->sub_akun_2;
                                            @endphp
                                        @endif
                                    @endforeach
                                </select>
                                @error('sub_akun_2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Tambahkan elemen input dengan id "inputAkunBaru" -->
                    <div class="form-row" id="inputSubAkun2Baru" style="display: none">
                        <div class="form-group col-md-12">
                            <label for="SubAkun2Baru">SUB AKUN BARU 2&nbsp;</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="input_Sub_Akun_2_Baru"
                                    placeholder="Masukan Sub Akun 2 Baru">
                            </div>
                            @error('input_Sub_Akun_2_Baru')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="cariSubAkun3">SUB AKUN 3 &nbsp;</label>
                            <div class="d-flex align-items-center">
                                <select class="custom-select" name="sub_akun_3" id="inputGroupSubAkun3">
                                    <option value="" disabled selected>Pilih Sub Akun 3</option>
                                    <option value="tambah-sub-akun-3-baru">Tambah Sub Akun 3 Baru</option>
                                    @php
                                        $uniqueSubAkun3 = [];
                                    @endphp
                                    @foreach ($dataAkun as $subakun3)
                                        @if (!empty($subakun3->sub_akun_3) && !in_array($subakun3->sub_akun_3, $uniqueSubAkun3))
                                            <option value="{{ $subakun3->sub_akun_3 }}"
                                                data-akun="{{ $subakun3->akun }}">{{ $subakun3->sub_akun_3 }}
                                            </option>
                                            @php
                                                $uniqueSubAkun3[] = $subakun3->sub_akun_3;
                                            @endphp
                                        @endif
                                    @endforeach
                                </select>
                                @error('sub_akun_3')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Tambahkan elemen input dengan id "inputAkunBaru" -->
                    <div class="form-row" id="inputSubAkun3Baru" style="display: none">
                        <div class="form-group col-md-12">
                            <label for="SubAkun3Baru">SUB AKUN BARU 3&nbsp;</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="input_Sub_Akun_3_Baru"
                                    placeholder="Masukan Sub Akun 3 Baru">
                            </div>
                            @error('input_Sub_Akun_3_Baru')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cariBuktiValid">BUKTI VALID (<100rb) &nbsp;</label>
                                    <sup class="badge rounded-pill badge-danger text-white mb-2"
                                        style="background-color: rgba(230, 82, 82)">WAJIB</sup>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="bukti_valid_100rb"
                                            id="buktiValid100rb" placeholder="Masukan Bukti Valid (<100rb)">
                                    </div>
                                    @error('bukti_valid_100rb')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cariBuktiValid">BUKTI VALID (>100rb) &nbsp;</label>
                            <sup class="badge rounded-pill badge-danger text-white mb-2"
                                style="background-color: rgba(230, 82, 82)">WAJIB</sup>
                            <div class="input-group">
                                <input type="text" class="form-control" name="bukti_valid_lebih100rb"
                                    id="buktiValidlebih100rb" placeholder="Masukan Bukti Valid (>100rb)">
                            </div>
                            @error('bukti_valid_lebih100rb')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="modal-footer"> --}}
            {{-- <div class="d-flex bd-highlight justify-content-end mt-3">
                <div class="bd-highlight">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="resetData2"><i
                            class="fa fa-ban"></i>
                        Tutup</button>
                    <button type="submit" class="btn bg-success"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </div> --}}

            <div class="d-flex bd-highlight justify-content-end mt-3">
                <div class="bd-highlight">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="resetData2">
                        <i class="fa fa-ban"></i> Tutup
                    </button>
                    <button type="button" class="btn bg-success" id="simpanButton">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="validasiModal" tabindex="-1" role="dialog"
                aria-labelledby="validasiModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="validasiModalLabel">Konfirmasi Simpan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menyimpan?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn bg-success" id="konfirmasiSimpan">
                                Ya, Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@push('script')
    <script>
        document.getElementById("simpanButton").addEventListener("click", function() {
            // Tampilkan modal validasi
            $('#validasiModal').modal('show');
        });

        document.getElementById("konfirmasiSimpan").addEventListener("click", function() {
            // Sembunyikan modal validasi
            $('#validasiModal').modal('hide');

            // Sembunyikan tombol Simpan dan tampilkan tombol Batal
            document.getElementById("simpanButton").style.display = "none";
        });
    </script>

    {{-- untuk membuat bukti valid berdasarkan akun --}}
    <script>
        function loadBuktiValid() {
            var selectAkun = document.getElementById("inputGroupAkun");
            var inputBuktiValid100rb = document.getElementById("buktiValid100rb");
            var inputBuktiValidLebih100rb = document.getElementById("buktiValidlebih100rb");
            var selectedAkunValue = selectAkun.value;

            if (selectedAkunValue === "tambah-akun-baru") {
                // Jika memilih "Tambah Akun Baru", izinkan pengguna memasukkan data baru
                inputBuktiValid100rb.value = "";
                inputBuktiValidLebih100rb.value = "";
                inputBuktiValid100rb.removeAttribute("readonly");
                inputBuktiValidLebih100rb.removeAttribute("readonly");
            } else {
                var selectedAkunData = dataAkun.find(function(akun) {
                    return akun.akun === selectedAkunValue;
                });

                if (selectedAkunData) {
                    inputBuktiValid100rb.value = selectedAkunData.bukti_valid_100rb;
                    inputBuktiValidLebih100rb.value = selectedAkunData.bukti_valid_lebih100rb;
                    inputBuktiValid100rb.setAttribute("readonly", "readonly");
                    inputBuktiValidLebih100rb.setAttribute("readonly", "readonly");
                } else {
                    inputBuktiValid100rb.value = "";
                    inputBuktiValidLebih100rb.value = "";
                }
            }
        }

        var selectAkun = document.getElementById("inputGroupAkun");
        selectAkun.addEventListener("change", loadBuktiValid);
    </script>


    <!-- JavaScript untuk Mereset Data -->
    <script>
        document.getElementById("resetData1").addEventListener("click", function() {
            // Reset nilai input BUKTI VALID (<100rb)
            document.getElementById("inputGroupKlasifikasi").value = "";
            document.getElementById("inputGroupUsaha").value = "";
            document.getElementById("inputGroupAkun").value = "";
            document.getElementById("inputGroupSubAkun1").value = "";
            document.getElementById("inputGroupSubAKun2").value = "";
            document.getElementById("inputGroupSubAKun3").value = "";
            document.getElementById("buktiValid100rb").value = "";
            document.getElementById("buktiValidlebih100rb").value = "";
        });

        document.getElementById("resetData2").addEventListener("click", function() {
            // Reset nilai input BUKTI VALID (>100rb)
            document.getElementById("inputGroupKlasifikasi").value = "";
            document.getElementById("inputGroupUsaha").value = "";
            document.getElementById("inputGroupAkun").value = "";
            document.getElementById("inputGroupSubAkun1").value = "";
            document.getElementById("inputGroupSubAKun2").value = "";
            document.getElementById("inputGroupSubAKun3").value = "";
            document.getElementById("buktiValid100rb").value = "";
            document.getElementById("buktiValidlebih100rb").value = "";
        });
    </script>

    {{-- akun ketika menambah akun baru --}}
    <script>
        $(document).ready(function() {
            // Sembunyikan elemen inputAkunBaru saat halaman dimuat
            $("#inputAkunBaru").hide();

            // Tambahkan event listener pada elemen select
            $("#inputGroupAkun").change(function() {
                if ($(this).val() == "tambah-akun-baru") {
                    // Jika pilihan adalah "Tambah Akun Baru", sembunyikan select dan tampilkan inputAkunBaru
                    $("#inputGroupAkun").hide();
                    $("#inputAkunBaru").show();
                } else {
                    // Jika pilihan bukan "Tambah Akun Baru", tampilkan select dan sembunyikan inputAkunBaru
                    $("#inputGroupAkun").show();
                    $("#inputAkunBaru").hide();
                }
            });
        });
    </script>

    {{-- akun ketika menambah sub akun 2 baru --}}
    <script>
        $(document).ready(function() {
            // Sembunyikan elemen inputAkunBaru saat halaman dimuat
            $("#inputSubAkun2Baru").hide();

            // Tambahkan event listener pada elemen select
            $("#inputSubAkun1").change(function() {
                if ($(this).val() == "tambah-sub-akun-2-baru") {
                    // Jika pilihan adalah "Tambah Akun Baru", sembunyikan select dan tampilkan inputAkunBaru
                    $("#inputSubAkun1").hide();
                    $("#inputSubAkun2Baru").show();
                } else {
                    // Jika pilihan bukan "Tambah Akun Baru", tampilkan select dan sembunyikan inputAkunBaru
                    $("#inputSubAkun1").show();
                    $("#inputSubAkun2Baru").hide();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Sembunyikan elemen inputAkunBaru saat halaman dimuat
            $("#inputSubAkun3Baru").hide();

            // Tambahkan event listener pada elemen select
            $("#inputSubAkun2").change(function() {
                if ($(this).val() == "tambah-sub-akun-3-baru") {
                    // Jika pilihan adalah "Tambah Akun Baru", sembunyikan select dan tampilkan inputAkunBaru
                    $("#inputSubAkun2").hide();
                    $("#inputSubAkun3Baru").show();
                } else {
                    // Jika pilihan bukan "Tambah Akun Baru", tampilkan select dan sembunyikan inputAkunBaru
                    $("#inputSubAkun2").show();
                    $("#inputSubAkun3Baru").hide();
                }
            });
        });
    </script>

    {{-- enable akun, sub akun 1, sub akun 2, sub akun 3 ketika klasifikasi dan usaha sudah diinput --}}
    <script>
        $(document).ready(function() {
            // Inisialisasi elemen-elemen yang akan diaktifkan/dinonaktifkan
            var akunInput = $("#inputGroupAkun");
            var subAkun1Input = $("#inputGroupSubAkun1");
            var subAkun2Input = $("#inputGroupSubAkun2");
            var subAkun3Input = $("#inputGroupSubAkun3");
            var buktiValid100rb = $("#buktiValid100rb");
            var buktiValidlebih100rb = $("#buktiValidlebih100rb");

            // Fungsi untuk menonaktifkan elemen
            function disableInputs() {
                akunInput.prop('disabled', true);
                subAkun1Input.prop('disabled', true);
                subAkun2Input.prop('disabled', true);
                subAkun3Input.prop('disabled', true);
                buktiValid100rb.prop('disabled', true);
                buktiValidlebih100rb.prop('disabled', true);
            }

            // Fungsi untuk mengaktifkan elemen
            function enableInputs() {
                akunInput.prop('disabled', false);
                subAkun1Input.prop('disabled', false);
                subAkun2Input.prop('disabled', false);
                subAkun3Input.prop('disabled', false);
                buktiValid100rb.prop('disabled', false);
                buktiValidlebih100rb.prop('disabled', false);
            }

            // Panggil fungsi disableInputs saat halaman dimuat
            disableInputs();

            // Tangani perubahan pada input klasifikasi dan usaha
            $("#inputGroupKlasifikasi, #inputGroupUsaha").change(function() {
                if ($("#inputGroupKlasifikasi").val() !== "Pilih Klasifikasi" && $("#inputGroupUsaha")
                    .val() !== "Pilih Unit Usaha") {
                    enableInputs();
                } else {
                    disableInputs();
                }
            });
        });
    </script>

    {{-- membuat button simpan enable ketika data sudah terisi --}}
    <script>
        $(document).ready(function() {
            // Nonaktifkan tombol Simpan saat halaman dimuat
            $('#simpanAkun').prop('disabled', true);

            // Fungsi untuk memeriksa apakah ada perubahan pada input
            function validateForm() {
                // Lakukan validasi input di sini, misalnya:
                var klasifikasi = $("#inputGroupKlasifikasi").val();
                var usaha = $("#inputGroupUsaha").val();
                var akun = $("#inputGroupAkun").val();
                var subAkun1 = $("#inputGroupSubAkun1").val();
                var subAkun2 = $("#inputGroupSubAKun2").val();
                var subAkun3 = $("#inputGroupSubAKun3").val();

                // Cek apakah semua input yang Anda butuhkan telah diisi
                if (klasifikasi && usaha && akun) {
                    // Aktifkan tombol simpanAkun jika semua input valid
                    $('#simpanAkun').prop('disabled', false);
                } else {
                    // Nonaktifkan tombol simpanAkun jika ada input yang belum valid
                    $('#simpanAkun').prop('disabled', true);
                }
            }

            // Panggil fungsi validateForm saat input berubah
            $('#inputGroupKlasifikasi, #inputGroupUsaha, #inputGroupAkun')
                .on('change', validateForm);
        });
    </script>

    {{-- jquery pada akun, sub akun 1, sub akun 2, dan sub akun 3 --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data klasifikasi, usaha, dan akun (ganti dengan data yang sesuai)
            var dataKlasifikasi = {!! json_encode($dataKlasifikasi) !!};
            var dataUsaha = {!! json_encode($dataUsaha) !!};
            var dataAkun = {!! json_encode($dataAkun) !!};

            var selectKlasifikasi = document.getElementById('inputGroupKlasifikasi');
            var selectUsaha = document.getElementById('inputGroupUsaha');
            var selectAkun = document.getElementById('inputGroupAkun');
            var selectSubAkun1 = document.getElementById('inputGroupSubAkun1');
            var selectSubAkun2 = document.getElementById('inputGroupSubAkun2');
            var selectSubAkun3 = document.getElementById('inputGroupSubAkun3');

            //js untuk pilih usaha agar sesuai dengan klasifikasi
            selectKlasifikasi.addEventListener('change', function() {
                var selectedKlasifikasi = selectKlasifikasi.value;


                // Hapus opsi lama dari select "Unit Usaha"
                selectUsaha.innerHTML = '<option selected>Pilih Unit Usaha</option>';

                var existingValues = new Set(); // Membuat Set untuk menyimpan nilai yang sudah ada

                dataAkun.forEach(function(usaha) {
                    if (usaha.klasifikasi === selectedKlasifikasi) {
                        if (!existingValues.has(usaha.nama_usaha)) {
                            var option = document.createElement('option');
                            option.value = usaha.nama_usaha;
                            option.textContent = usaha.nama_usaha;
                            selectUsaha.appendChild(option);

                            existingValues.add(usaha.nama_usaha); // Menambahkan nilai ke dalam Set
                        }
                    }
                });
                selectAkun.innerHTML = '<option selected>Pilih Akun</option>';
                selectSubAkun1.innerHTML = '<option value="" selected>Pilih Sub Akun 1</option>';
                selectSubAkun2.innerHTML = '<option value="" selected>Pilih Sub Akun 2</option>';
                selectSubAkun3.innerHTML = '<option value="" selected>Pilih Sub Akun 3</option>';
            });

            // js untuk pilih akun agar sesuai dengan klasifikasi dan usaha
            selectKlasifikasi.addEventListener('change', function() {
                selectUsaha.addEventListener('change', function() {
                    var selectedKlasifikasi = selectKlasifikasi.value;
                    var selectedUsaha = selectUsaha.value;

                    // Hapus opsi lama dari select "Akun"
                    selectAkun.innerHTML = '<option value="" selected>Pilih Akun</option>';

                    var existingValues =
                        new Set(); // Membuat Set untuk menyimpan nilai yang sudah ada

                    dataAkun.forEach(function(akun) {
                        if (akun.klasifikasi === selectedKlasifikasi) {
                            var selectedUsaha = selectUsaha.value;
                            if (akun.usaha === selectedUsaha) {
                                if (!existingValues.has(akun.akun)) {
                                    var option = document.createElement('option');
                                    option.value = akun.akun;
                                    option.textContent = akun.akun;
                                    selectAkun.appendChild(option);

                                    existingValues.add(akun
                                        .akun); // Menambahkan nilai ke dalam Set
                                }
                            }
                        }
                    });
                    // Tambahkan opsi "Tambah Akun Baru" di atas
                    var optionTambahAkunBaru = document.createElement('option');
                    optionTambahAkunBaru.value = 'input_Akun_Baru'; // Perbaikan di sini
                    optionTambahAkunBaru.textContent = 'Tambah Akun Baru';
                    selectAkun.appendChild(optionTambahAkunBaru);

                    selectAkun.addEventListener("change", function() {
                        if (selectAkun.value === "input_Akun_Baru") { // Perbaikan di sini
                            inputAkunBaru.style.display = "block";
                        } else {
                            inputAkunBaru.style.display = "none";
                        }
                    });
                });

            });

            selectAkun.addEventListener('change', function() {
                var selectedAkun = selectAkun.value;
                var selectedSubAkun1 = selectSubAkun1.value;

                selectSubAkun1.innerHTML = '<option value="" selected>Pilih Sub Akun 1</option>';

                if (selectedAkun) {
                    var existingSubAkun1Values = new Set();

                    dataAkun.forEach(function(subakun1) {
                        if (subakun1.akun === selectedAkun) {
                            if (!existingSubAkun1Values.has(subakun1.sub_akun_1)) {
                                var option = document.createElement('option');
                                option.value = subakun1.sub_akun_1;
                                option.textContent = subakun1.sub_akun_1;
                                selectSubAkun1.appendChild(option);

                                existingSubAkun1Values.add(subakun1.sub_akun_1);
                            }
                        }
                    });
                }

                // Tambahkan opsi "Tambah Sub Akun 1 Baru" di atas
                var optionTambahSubAkun1Baru = document.createElement('option');
                optionTambahSubAkun1Baru.value = 'input_Sub_Akun_1_Baru';
                optionTambahSubAkun1Baru.textContent = 'Tambah Sub Akun 1 Baru';
                selectSubAkun1.appendChild(optionTambahSubAkun1Baru);


                // Mengatur opsi "" sebagai opsi default yang dinonaktifkan
                if (selectSubAkun1.length === 0) {
                    var defaultOption = document.createElement('option');
                    defaultOption.textContent = 'Pilih Sub Akun 1';
                    defaultOption.disabled = true;
                    defaultOption.selected = true;
                    selectSubAkun1.appendChild(defaultOption);
                }

                // Mendengarkan perubahan pada selectSubAkun1
                selectSubAkun1.addEventListener("change", function() {
                    if (selectSubAkun1.value === "input_Sub_Akun_1_Baru") {
                        inputSubAkun1Baru.style.display = "block";
                    } else {
                        inputSubAkun1Baru.style.display = "none";
                    }
                });

                selectSubAkun1.addEventListener('change', function() {
                    selectSubAkun2.innerHTML =
                        '<option value="" selected>Pilih Sub Akun 2</option>';

                    var existingSubAkun2Values = new Set();

                    dataAkun.forEach(function(subakun2) {
                        var selectedAkun = selectAkun.value;
                        var selectedSubAkun1 = selectSubAkun1.value;
                        if (subakun2.akun === selectedAkun && subakun2.sub_akun_1 ===
                            selectedSubAkun1) {
                            if (!existingSubAkun2Values.has(subakun2.sub_akun_2)) {
                                var option = document.createElement('option');
                                option.value = subakun2.sub_akun_2;
                                option.textContent = subakun2.sub_akun_2;
                                selectSubAkun2.appendChild(option);

                                existingSubAkun2Values.add(subakun2.sub_akun_2);
                            }
                        }
                    });

                    // Tambahkan opsi "Tambah Sub Akun 2 Baru" di bawah
                    var optionTambahSubAkun2Baru = document.createElement('option');
                    optionTambahSubAkun2Baru.value = 'input_Sub_Akun_2_Baru';
                    optionTambahSubAkun2Baru.textContent = 'Tambah Sub Akun 2 Baru';
                    selectSubAkun2.appendChild(optionTambahSubAkun2Baru);

                    // Mengatur opsi "" sebagai opsi default yang dinonaktifkan
                    if (selectSubAkun2.length === 0) {
                        var defaultOption = document.createElement('option');
                        defaultOption.textContent = 'Pilih sub akun 2';
                        defaultOption.disabled = true;
                        defaultOption.selected = true;
                        selectSubAkun2.appendChild(defaultOption);
                    }

                    // Mendengarkan perubahan pada selectSubAkun2
                    selectSubAkun2.addEventListener("change", function() {
                        if (selectSubAkun2.value === "input_Sub_Akun_2_Baru") {
                            inputSubAkun2Baru.style.display = "block";
                        } else {
                            inputSubAkun2Baru.style.display = "none";
                        }
                    });
                });
                selectSubAkun2.innerHTML = '<option value="" selected>Pilih Sub Akun 2</option>';
                selectSubAkun3.innerHTML = '<option value="" selected>Pilih Sub Akun 3</option>';
            });

            selectSubAkun1.addEventListener('change', function() {
                selectSubAkun2.addEventListener('change', function() {
                    // var selectedAkun = selectAkun.value;
                    var selectedSubAkun1 = selectSubAkun1.value;
                    var selectedSubAkun2 = selectSubAkun2.value;

                    selectSubAkun3.innerHTML =
                        '<option value="" selected>Pilih Sub Akun 3</option>';

                    var existingSubAkun3Values = new Set();

                    dataAkun.forEach(function(subakun3) {
                        // var selectedAkun = selectAkun.value;
                        var selectedSubAkun1 = selectSubAkun1.value;
                        var selectedSubAkun2 = selectSubAkun2.value;

                        if (subakun3
                            .sub_akun_1 ===
                            selectedSubAkun1 && subakun3
                            .sub_akun_2 ===
                            selectedSubAkun2) {
                            if (!existingSubAkun3Values.has(subakun3
                                    .sub_akun_3)) {
                                var option = document.createElement('option');
                                option.value = subakun3.sub_akun_3;
                                option.textContent = subakun3.sub_akun_3;
                                selectSubAkun3.appendChild(option);

                                existingSubAkun3Values.add(subakun3.sub_akun_3);
                            }
                        }
                    });

                    // Tambahkan opsi "Tambah Sub Akun 2 Baru" di bawah
                    var optionTambahSubAkun3Baru = document.createElement('option');
                    optionTambahSubAkun3Baru.value = 'input_Sub_Akun_3_Baru';
                    optionTambahSubAkun3Baru.textContent = 'Tambah Sub Akun 3 Baru';
                    selectSubAkun3.appendChild(optionTambahSubAkun3Baru);

                    // Mengatur opsi "" sebagai opsi default yang dinonaktifkan
                    if (selectSubAkun3.length === 0) {
                        var defaultOption = document.createElement('option');
                        defaultOption.textContent = 'Pilih sub akun 3';
                        defaultOption.disabled = true;
                        defaultOption.selected = true;
                        selectSubAkun3.appendChild(defaultOption);
                    }

                    // Mendengarkan perubahan pada selectSubAkun3
                    selectSubAkun3.addEventListener("change", function() {
                        if (selectSubAkun3.value === "input_Sub_Akun_3_Baru") {
                            inputSubAkun3Baru.style.display = "block";
                        } else {
                            inputSubAkun3Baru.style.display = "none";
                        }
                    });
                });
            });
        });
    </script>
@endpush
