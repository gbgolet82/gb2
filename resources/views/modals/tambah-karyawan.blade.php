<form action="{{ route('tambah.karyawan') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal-body">
        <div id="form-lama">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nama">NAMA &nbsp;</label>
                    <sup class="badge rounded-pill badge-danger text-white"
                        style="background-color: rgba(230, 82, 82); font-size: 10px; padding: 4px 8px;">WAJIB</sup>
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
                    <sup class="badge rounded-pill badge-danger text-white"
                        style="background-color: rgba(230, 82, 82); font-size: 10px; padding: 4px 8px;">WAJIB</sup>
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
                    <sup class="badge rounded-pill badge-danger text-white"
                        style="background-color: rgba(230, 82, 82); font-size: 10px; padding: 4px 8px;">WAJIB</sup>
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
                    <sup class="badge rounded-pill badge-danger text-white"
                        style="background-color: rgba(230, 82, 82); font-size: 10px; padding: 4px 8px;">WAJIB</sup>
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
                    <sup class="badge rounded-pill badge-danger text-white"
                        style="background-color: rgba(230, 82, 82); font-size: 10px; padding: 4px 8px;">WAJIB</sup>
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
                    <sup class="badge rounded-pill badge-danger text-white"
                        style="background-color: rgba(230, 82, 82); font-size: 10px; padding: 4px 8px;">WAJIB</sup>
                    <textarea class="form-control" id="alamatt" name="alamat" rows="2" placeholder="Masukkan alamat"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="alamat">ROLE</label>
                    <sup class="badge rounded-pill badge-danger text-white"
                        style="background-color: rgba(230, 82, 82); font-size: 10px; padding: 4px 8px;">WAJIB</sup>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban"></i>
                        Tutup</button>
                    <button type="submit" class="btn btn-success text-white toastrDefaultSuccess" id="simpan"><i
                            class="fas fa-save" onclick="validateForm()"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

@push('script')
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
                // Lakukan validasi input di sini, misalnya:
                var nama = $("#namaa").val();
                var nomorHP = $("#nomorHP").val();
                var emaill = $("#emaill").val();
                var unitUsaha = $("#unitUsaha").val();
                var alamatt = $("#alamatt").val();
                var paswordd = $("#paswordd").val();

                // Cek apakah semua input telah diisi
                if (nama !== '' && nomorHP !== '' && emaill !== '' && unitUsaha !== '' && alamatt !== '' &&
                    passwordd !== '') {
                    // Aktifkan tombol Simpan jika semua input valid
                    $('#simpan').prop('disabled', false);
                } else {
                    // Nonaktifkan tombol Simpan jika ada input yang belum valid
                    $('#simpan').prop('disabled', true);
                }
            }

            // Panggil fungsi validateForm saat input berubah
            $('#nama').on('change', validateForm);
            $('#nomorHP').on('change', validateForm);
            $('#emaill').on('change', validateForm);
            $('#unitUsaha').on('change', validateForm);
            $('#alamatt').on('change', validateForm);
            $('#paswordd').on('change', validateForm);
        });
    </script>
@endpush
