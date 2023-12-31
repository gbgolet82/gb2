<form action="{{ route('edit.usaha', $usaha->id_usaha) }}" method="POST" id="editUsahaForm">
    @csrf
    <div id="form-lama">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="cariKlasifikasi">NAMA USAHA &nbsp;</label>
                <span style="color:rgba(230, 82, 82)">*</span>
                <input type="text" class="form-control @error('nama_usaha_edit') is-invalid @enderror"
                    id="namaUsaha_edit" placeholder="Masukan nama usaha" name="nama_usaha_edit"
                    value="{{ old('nama_usaha_edit', $usaha->nama_usaha) }}">
                @error('nama_usaha_edit')
                    <div class="invalid-feedback" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="cariUnitUsaha">ALAMAT USAHA &nbsp;</label>
                <span style="color:rgba(230, 82, 82)">*</span>
                <textarea class="form-control" id="alamatUsaha_edit" name="alamat_usaha_edit" rows="3"
                    placeholder="Masukkan alamat usaha">{{ old('alamat_usaha_edit', $usaha->alamat_usaha) }}</textarea>
                @error('alamat_usaha_edit')
                    <div class="invalid-feedback" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-row ">
            <div class="form-group col-md-12">
                <label for="cariAkun">JENIS USAHA &nbsp;</label>
                <span style="color:rgba(230, 82, 82)">*</span>
                <input type="text" class="form-control @error('jenis_usaha_edit') is-invalid @enderror"
                    id="jenisUsaha_edit" placeholder="Masukan jenis usaha" name="jenis_usaha_edit"
                    value="{{ old('jenis_usaha_edit', $usaha->jenis_usaha) }}">
                @error('jenis_usaha_edit')
                    <div class="invalid-feedback" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="cariSubAkun1">PRODUK USAHA &nbsp;</label>
                <span style="color:rgba(230, 82, 82)">*</span>
                <input type="text" class="form-control @error('produk_usaha_edit') is-invalid @enderror"
                    id="produkUsaha_edit" placeholder="Masukan produk usaha" name="produk_usaha_edit"
                    value="{{ old('produk_usaha_edit', $usaha->produk_usaha) }}">
                @error('produk_usaha_edit')
                    <div class="invalid-feedback" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>

    
</form>

@push('script')
    {{-- <div class="d-flex bd-highlight justify-content-end mt-3">
        <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal"><i class="fas fa-ban"></i>
            Tutup</button>
        <button type="submit" class="btn btn-success text-white" id="simpanPerubahan" onclick="validasiForm()">
            <i class="fas fa-save"></i> Simpan Perubahan
        </button>
    </div> --}}

    {{-- <script>
        $(document).ready(function() {
            $('#simpanPerubahan').prop('disabled', true);

            // Fungsi untuk memeriksa apakah ada perubahan pada input
            function validateForm() {
                var adaPerubahan = false;

                $(".namaUsaha_edit, .alamatUsaha_edit, .jenisUsaha_edit, .produkUsaha_edit").each(function() {
                    var namaUsahaAwal = $(this).data("namaAwal");
                    var alamatUsahaAwal = $(this).data("alamatAwal");
                    var jenisUsahaAwal = $(this).data("jenisAwal");
                    var produkUsahaAwal = $(this).data("produkAwal");

                    if ($(this).val() !== namaUsahaAwal ||
                        $(this).val() !== alamatUsahaAwal ||
                        $(this).val() !== jenisUsahaAwal ||
                        $(this).val() !== produkUsahaAwal) {
                        adaPerubahan = true;
                        return false; // Hentikan loop jika ada perubahan
                    }
                });

                // Aktifkan atau nonaktifkan tombol Simpan berdasarkan perubahan
                $('#simpanPerubahan').prop('disabled', !adaPerubahan);
            }

            // Panggil fungsi validateForm saat input berubah
            $(".namaUsaha_edit, .alamatUsaha_edit, .jenisUsaha_edit, .produkUsaha_edit").on('input', validateForm);

            // Set nilai awal untuk setiap elemen input
            $(".namaUsaha_edit, .alamatUsaha_edit, .jenisUsaha_edit, .produkUsaha_edit").each(function() {
                $(this).data("namaAwal", $(this).val());
                $(this).data("alamatAwal", $(this).val());
                $(this).data("jenisAwal", $(this).val());
                $(this).data("produkAwal", $(this).val());
            });
        });
    </script> --}}
@endpush
