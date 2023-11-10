<form action="{{ route('tambah.karyawan') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal-body">
        <div id="form-lama">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nama">NAMA &nbsp;</label>
                    <span style="color:rgba(230, 82, 82)">*</span>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="namaa"
                        placeholder="Masukan nama usaha" name="nama" value=""
                        onkeydown="return /[a-z, ]/i.test(event.key)">
                    @error('nama')
                        <div class="invalid-feedback" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="nomor_hp">NOMOR HP &nbsp;</label>
                    <span style="color:rgba(230, 82, 82)">*</span>
                    <input type="text" class="form-control @error('nomor_hp') is-invalid @enderror" id="nomorHP"
                        placeholder="Masukan nomor hp" name="nohp" value=""
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                    @error('nohp')
                        <div class="invalid-feedback" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-row ">
                <div class="form-group col-md-6">
                    <label for="email">EMAIL &nbsp;</label>
                    <span style="color:rgba(230, 82, 82)">*</span>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="emaill"
                        placeholder="Masukan email" name="email" value="">
                    @error('email')
                        <div class="invalid-feedback" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="password">PASSWORD &nbsp;</label>
                    <span style="color:rgba(230, 82, 82)">*</span>
                    <div class="input-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="passwordd" placeholder="Masukan password" name="password" value="">
                        <div class="input-group-append">
                            <span class="input-group-text" id="show-hide-password">
                                <i class="fa fa-eye-slash" aria-hidden="true" onclick="togglePasswordVisibility()"></i>
                            </span>
                        </div>
                    </div>
                    @error('password')
                        <div class="invalid-feedback" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="unit_usaha">UNIT USAHA &nbsp;</label>
                    <span style="color:rgba(230, 82, 82)">*</span>
                    <select class="form-control" id="unitUsaha" name="id_usaha">
                        @foreach ($unit_usaha as $item)
                            <option value="" disabled selected hidden>Pilih unit usaha
                            </option>
                            <option value="{{ $item->id_usaha }}">
                                {{ $item->nama_usaha }}
                            </option>
                        @endforeach
                    </select>

                    @error('id_usaha')
                        <div class="invalid-feedback" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="alamat">ALAMAT </label>
                    <span style="color:rgba(230, 82, 82)">*</span>
                    <textarea class="form-control" id="alamatt" name="alamat" rows="2" placeholder="Masukkan alamat"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="alamat">ROLE</label>
                    <span style="color:rgba(230, 82, 82)">*</span>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="manajer" name="manajer">
                        <label class="form-check-label" for="manajer">Manajer</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="kasir" name="kasir">
                        <label class="form-check-label" for="kasir">Kasir</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="owner" name="owner">
                        <label class="form-check-label" for="owner">Owner</label>
                    </div>
                </div>
            </div>

            <div class="d-flex bd-highlight justify-content-end mt-3">
                <div class="bd-highlight">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="resetDat"><i class="fa fa-ban"></i>
                        Batal</button>
                    <button type="submit" class="btn btn-success text-white toastrDefaultSuccess" id="simpan"><i
                            class="fas fa-save" onclick="validateForm()"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

@push('script')
    <script>
        // Fungsi untuk mereset nilai-nilai formulir input ke nilai default
        function resetForm() {
            document.getElementById("namaa").value = ''; // Reset nilai "Nominal" menjadi kosong
            document.getElementById("nomorHP").value = ''; // Reset nilai "Nominal" menjadi kosong
            document.getElementById("emaill").value = ''; // Reset nilai "Nominal" menjadi kosong
            document.getElementById("passwordd").value = ''; // Reset nilai "Nominal" menjadi kosong
            document.getElementById("alamatt").value = ''; // Reset nilai "Nominal" menjadi kosong
            document.getElementById("unitUsaha").selectedIndex = 0; // Reset pilihan "Usaha" ke yang pertama
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });

            document.getElementById('simpan').disabled = true;
        }
        document.getElementById("resetDat").addEventListener("click", resetForm);
    </script>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("passwordd");
            var passwordIcon = document.getElementById("show-hide-password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordIcon.innerHTML =
                    '<i class="fa fa-eye" aria-hidden="true" onclick="togglePasswordVisibility()"></i>';
            } else {
                passwordInput.type = "password";
                passwordIcon.innerHTML =
                    '<i class="fa fa-eye-slash" aria-hidden="true" onclick="togglePasswordVisibility()"></i>';
            }
        }

        $(document).ready(function() {
            // Fungsi untuk memeriksa apakah semua input telah valid
            $('#simpan').prop('disabled', true);

            function validateForm() {
                var nama = $("#namaa").val();
                var nomorHP = $("#nomorHP").val();
                var emaill = $("#emaill").val();
                var unitUsaha = $("#unitUsaha").val();
                var alamatt = $("#alamatt").val();
                var paswordd = $("#paswordd").val();

                // Periksa apakah salah satu kotak centang telah dicentang
                var isRoleSelected = $("#manajer").is(":checked") || $("#kasir").is(":checked") || $("#owner").is(
                    ":checked");

                // Cek apakah semua input telah diisi dan minimal satu kotak centang telah dicentang
                if (nama !== '' && nomorHP !== '' && emaill !== '' && unitUsaha !== '' && alamatt !== '' &&
                    paswordd !== '' && isRoleSelected) {
                    // Aktifkan tombol Simpan jika semua input valid
                    $('#simpan').prop('disabled', false);
                } else {
                    // Nonaktifkan tombol Simpan jika ada input yang belum valid
                    $('#simpan').prop('disabled', true);
                }
            }

            // Panggil fungsi validateForm saat input berubah atau kotak centang dicentang/unchecked
            $('#namaa, #nomorHP, #emaill, #unitUsaha, #alamatt, #paswordd, #manajer, #kasir, #owner').on('change',
                validateForm);
        });
    </script>
@endpush
