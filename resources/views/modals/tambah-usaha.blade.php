<form action="{{ route('tambah.usaha') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal-body">
        <div class="tab-content mt-1">
            <div class="tab-pane fade show active" id="nav-satu-tab" role="tabpanel" aria-labelledby="nav-satu-tab">

                <div id="form-lama">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="cariKlasifikasi">NAMA USAHA &nbsp;</label>
                            {{-- <sup class="badge rounded-pill badge-danger text-white mb-2"
                                style="background-color:rgba(230,82,82)">WAJIB</sup> --}}
                            <span style="color:rgba(230, 82, 82)">*</span>
                            <input type="text" class="form-control @error('nama_usaha') is-invalid @enderror"
                                id="namaUsaha" placeholder="Masukan nama usaha" name="nama_usaha" value="">
                            @error('nama_usaha')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="cariUnitUsaha">ALAMAT USAHA &nbsp;</label>
                            {{-- <sup class="badge rounded-pill badge-danger text-white mb-2"
                                style="background-color:rgba(230,82,82)">WAJIB</sup> --}}
                            <span style="color:rgba(230, 82, 82)">*</span>
                            <textarea class="form-control @error('alamat_usaha') is-invalid @enderror" id="AlamatUsaha" name="alamat_usaha"
                                rows="3" placeholder="Masukan alamat usaha"></textarea>
                            @error('alamat_usaha')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="cariJenisUsaha">JENIS USAHA &nbsp;</label>
                            {{-- <sup class="badge rounded-pill badge-danger text-white mb-2"
                                style="background-color:rgba(230,82,82)">WAJIB</sup> --}}
                            <span style="color:rgba(230, 82, 82)">*</span>
                            <input type="text" class="form-control @error('jenis_usaha') is-invalid @enderror"
                                id="jenis_usaha" placeholder="Masukan jenis usaha" name="jenis_usaha" value="">
                            @error('jenis_usaha')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="cariSubAkun1">PRODUK USAHA &nbsp;</label>
                            {{-- <sup class="badge rounded-pill badge-danger text-white mb-2"
                                style="background-color:rgba(230,82,82)">WAJIB</sup> --}}
                            <span style="color:rgba(230, 82, 82)">*</span>
                            <input type="text" class="form-control @error('produk_usaha') is-invalid @enderror"
                                id="produkUsaha" placeholder="Masukan produk usaha" name="produk_usaha" value="">
                            @error('produk_usaha')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- <div class="d-flex bd-highlight justify-content-end mt-3">
                        <div class="bd-highlight">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="resetData"><i
                                    class="fa fa-ban"></i>
                                Tutup</button>
                            <button type="submit" class="btn btn-success text-white toastrDefaultSuccess"
                                id="simpan"><i class="fas fa-save" onclick="validateForm()"></i> Simpan</button>
                        </div>
                    </div> --}}


                    <div class="d-flex bd-highlight justify-content-end mt-3">
                        <div class="bd-highlight">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="resetData">
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
                                    <button type="button" class="close" id="close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menyimpan?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" id="batalButton">
                                        <i class="fas fa-sync-alt"></i> Batal
                                    </button>
                                    <button type="submit" class="btn bg-success" id="konfirmasiSimpan">
                                        <i class="fas fa-check"></i> Ya, Simpan
                                    </button>
                                </div>
                            </div>
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
            // Fungsi untuk memeriksa apakah semua input telah valid
            $('#simpanButton').prop('disabled', true);

            function validateForm() {
                // Lakukan validasi input di sini, misalnya:
                var namaUsaha = $("#namaUsaha").val();
                var alamatUsaha = $("#AlamatUsaha").val();
                var jenisUsaha = $("#jenis_usaha").val();
                var produkUsaha = $("#produkUsaha").val();

                // Cek apakah semua input telah diisi
                if (namaUsaha !== '' && alamatUsaha !== '' && produkUsaha !== '' && jenisUsaha !== '') {
                    // Aktifkan tombol simpanButton jika semua input valid
                    $('#simpanButton').prop('disabled', false);
                } else {
                    // Nonaktifkan tombol simpanButton jika ada input yang belum valid
                    $('#simpanButton').prop('disabled', true);
                }
            }

            // Panggil fungsi validateForm saat input berubah
            $('#namaUsaha').on('change', validateForm);
            $('#AlamatUsaha').on('change', validateForm);
            $('#produkUsaha').on('change', validateForm);
            $('#jenis_usaha').on('change', validateForm);
        });
    </script>

    {{-- mereset data ketika klik close modal --}}
    <script>
        $(document).ready(function() {
            $('#reset').on('click', function() {
                $('#namaUsaha').val('');
                $('#AlamatUsaha').val('');
                $('#jenis_usaha').val('');
                $('#produkUsaha').val('');
            });
        });
        $(document).ready(function() {
            $('#resetData').on('click', function() {
                $('#namaUsaha').val('');
                $('#AlamatUsaha').val('');
                $('#jenis_usaha').val('');
                $('#produkUsaha').val('');
            });
        });
    </script>
@endpush
