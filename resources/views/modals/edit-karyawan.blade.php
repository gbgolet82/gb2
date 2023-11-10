<form action="{{ route('update.karyawan', $karyawan->id_karyawan) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal-body">
        <div class="tab-content mt-1">
            <div class="tab-pane fade show active" id="nav-satu-tab" role="tabpanel" aria-labelledby="nav-satu-tab">
                <div id="form-lama">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama">NAMA &nbsp;</label>
                            <span style="color:rgba(230, 82, 82)">*</span>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                id="nama" placeholder="Masukan nama usaha" name="nama"
                                value="{{ $karyawan->nama }}" onkeydown="return /[a-z, ]/i.test(event.key)">
                            @error('nama')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nomor_hp">NOMOR HP &nbsp;</label>
                            <span style="color:rgba(230, 82, 82)">*</span>
                            <input type="text" class="form-control @error('nohp') is-invalid @enderror"
                                id="nohp" placeholder="Masukan nomor hp" name="nohp"
                                value="{{ $karyawan->nohp }}"
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
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" placeholder="Masukan email" name="email"
                                value="{{ $karyawan->email }}">
                            @error('email')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="unit_usaha">UNIT USAHA &nbsp;</label>
                            <span style="color:rgba(230, 82, 82)">*</span>
                            <select class="form-control" id="unit_usaha" name="id_usaha">
                                @foreach ($unit_usaha as $item)
                                    <option value="{{ $item->id_usaha }}"
                                        {{ $karyawan->id_usaha == $item->id_usaha ? 'selected' : '' }}>
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
                            <textarea class="form-control" id="alamat" name="alamat" rows="2" placeholder="Masukkan alamat">{{ $karyawan->alamat }}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="alamat">ROLE</label>
                            <span style="color:rgba(230, 82, 82)">*</span>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="manajer" name="manajer"
                                    {{ $karyawan->manajer ? 'checked' : '' }}>
                                <label class="form-check-label" for="manajer">Manajer</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="kasir" name="kasir"
                                    {{ $karyawan->kasir ? 'checked' : '' }}>
                                <label class="form-check-label" for="kasir">Kasir</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="owner" name="owner"
                                    {{ $karyawan->owner ? 'checked' : '' }}>
                                <label class="form-check-label" for="owner">Owner</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex bd-highlight justify-content-end mt-3">
                        <div class="bd-highlight">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="fa fa-ban"></i>
                                Tutup</button>
                            <button type="submit" class="btn btn-success text-white toastrDefaultSuccess"
                                id="simpan"><i class="fas fa-save"></i> Simpan</button>
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
            // Inisialisasi tombol "Simpan" sebagai nonaktif
            $('#simpan').prop('disabled', true);

            // Fungsi untuk memeriksa perubahan pada input form
            function checkChanges() {
                var nama = $("#nama").val();
                var nohp = $("#nohp").val();
                var email = $("#email").val();
                var id_usaha = $("#unit_usaha").val();
                var alamat = $("#alamat").val();
                var manajer = $("#manajer").prop('checked');
                var kasir = $("#kasir").prop('checked');
                var owner = $("#owner").prop('checked');

                // Cek apakah ada data yang diubah atau ada data yang kosong
                if (
                    nama === '' || nohp === '' || email === '' || id_usaha === '' || alamat === ''
                ) {
                    $('#simpan').prop('disabled', true);
                } else if (
                    nama !== '{{ $karyawan->nama }}' ||
                    nohp !== '{{ $karyawan->nohp }}' ||
                    email !== '{{ $karyawan->email }}' ||
                    id_usaha !== '{{ $karyawan->id_usaha }}' ||
                    alamat !== '{{ $karyawan->alamat }}' ||
                    manajer !== {{ $karyawan->manajer }} ||
                    kasir !== {{ $karyawan->kasir }} ||
                    owner !== {{ $karyawan->owner }}
                ) {
                    $('#simpan').prop('disabled', false);
                } else {
                    $('#simpan').prop('disabled', true);
                }
            }

            // Panggil fungsi checkChanges saat input/form berubah
            $('#nama, #nohp, #email, #unit_usaha, #alamat, #manajer, #kasir, #owner').on('input change',
                checkChanges);
        });
    </script>
@endpush
