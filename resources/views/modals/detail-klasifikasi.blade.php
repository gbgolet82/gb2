<style>
    .badge-cr {
        position: relative;
        top: -1px;
        left: 10px;
        font-size: 14px;
        padding: 3px 5px;
        font-size: 14px;
        border-radius: 10px;
        background-color: #fd7e14;
        color: #fff;
    }

    .badge-ijo {
        position: relative;
        top: -1px;
        left: 10px;
        font-size: 14px;
        padding: 3px 5px;
        font-size: 14px;
        border-radius: 10px;
        background-color: #28a745;
        color: #fff;
    }
</style>
<div class="modal-body">
    <div class="d-flex mb-3">
        <span class="text-bold d-flex align-items-center" style="font-size: 18px">Detail Akun & Sub Akun</span>
    </div>

    @php
        $currentIdKey = $akun->id_key; // Simpan id_key terkini dalam variabel
        $errorModalId = session('errorModalId'); // Dapatkan id_key dari session
    @endphp

    @if ($currentIdKey == $errorModalId)
        @if (session('error'))
            <div class="alert alert-danger custom-rounded-box" role="alert" id="error-message">
                {{ session('error') }}
            </div>
        @endif
    @endif

    <div class="card" style="border-radius: 10px;">
        <div class="card-body p-3">
            <div class="row">
                <!-- Add your table inside the modal-body -->
                <table class="table-border table-responsive mt-1 p-1" style="border-radius: 10px;">
                    <tr style="height: 40px;">
                        <th width='400px'>Klasifikasi</th>
                        <th width='300px'>Usaha</th>
                        <th width='300px'>Akun</th>
                        <th width='480px'>Sub Akun 1</th>
                        <th width='480px'>Sub Akun 2</th>
                        <th width='480px'>Sub Akun 3</th>
                    </tr>
                    <tr>
                        <td width='400px'>{{ $akun->klasifikasi }}</td>
                        <td width='300px'>{{ $akun->nama_usaha }}</td>
                        <td width='300px'>{{ $akun->akun }}</td>
                        <td width='480px'>{{ $akun->sub_akun_1 ?? '-' }}</td>
                        <td width='480px'>{{ $akun->sub_akun_2 ?? '-' }}</td>
                        <td width='480px'>{{ $akun->sub_akun_3 ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="card" style="border-radius: 10px;">
        <div class="card-body p-3">
            <div class="row">
                <!-- Add your table inside the modal-body -->
                <table class="table-border table-responsive mt-1 p-1" style="border-radius: 10px;">
                    <tr style="height: 40px;">
                        <th width='480px'>Bukti Valid (<100 rb)</th>
                        <th width='480px'>Bukti Valid (>100 rb)</th>
                    </tr>
                    <tr>
                        <td>{{ $akun->bukti_valid_100rb }}</td>
                        <td>{{ $akun->bukti_valid_lebih100rb }}</td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <hr>
                        </td>
                    </tr>
                    <tr style="height: 40px;">
                        <th width='480px'>Tgl Input</th>
                        <th width='480px'>Diinput Oleh</th>
                    </tr>
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($akun->created_at)->format('d/m/Y') }}
                        </td>
                        <td>{{ session('nama') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex bd-highlight justify-content-end mt-3">
        <div class="bd-highlight">
            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal" id="resetData"><i
                    class="fa fa-ban"></i> Batal</button>
            <div class="btn-group">
                <button type="button" class="btn btn-success text-white toastrDefaultSuccess"
                    id="simpanDetailKlasifikasi">
                    <i class="fas fa-edit"></i> Aksi
                </button>
                <button type="button" class="btn btn-success text-white toastrDefaultSuccess dropdown-toggle"
                    data-toggle="dropdown">
                    <span class="sr-only"></span>
                </button>
                <div class="dropdown-menu">
                    {{-- <a class="dropdown-item" href="#" class="btn btn-primary" data-toggle="modal"
                        data-target="#ubahModalDetail{{ $akun->id_key }}">Ubah</a> --}}
                    <a class="dropdown-item" href="#" data-toggle="modal"
                        data-target="#hapusModalDetail{{ $akun->id_key }}">Hapus</a>
                </div>

                <!-- Modal untuk "Update" -->
                {{-- <div class="modal" tabindex="-1" id="ubahModalDetail{{ $akun->id_key }}" aria-hidden="true"
                    data-bs-backdrop="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Modal title</h5>
                                <button type="button" class="close" aria-label="Close"
                                    onclick="closeUbahModalDetail()">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Modal body text goes here.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                    onclick="closeUbahModalDetail()">Tutup</button>
                                <button type="button" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- Modal untuk "Hapus" -->
                <div class="modal fade" id="hapusModalDetail{{ $akun->id_key }}" tabindex="-1" role="dialog"
                    aria-labelledby="hapusModalDetail" aria-hidden="true">
                    <div class="modal-dialog " role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hapusModalDetail">Konfirmasi Hapus</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Anda yakin ingin menghapus data ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="batalHapusID" class="btn btn-secondary"><i
                                        class="fas fa-ban"></i> Batal</button>
                                <form method="POST" action="{{ route('hapus.akun', $akun->id_key) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="akun" value="{{ $akun->akun }}">
                                    <input type="hidden" name="sub_akun_1" value="{{ $akun->sub_akun_1 }}">
                                    <input type="hidden" name="sub_akun_2" value="{{ $akun->sub_akun_2 }}">
                                    <input type="hidden" name="sub_akun_3" value="{{ $akun->sub_akun_3 }}">
                                    <input type="hidden" name="bukti_valid_100rb"
                                        value="{{ $akun->bukti_valid_100rb }}">
                                    <input type="hidden" name="bukti_valid_lebih100rb"
                                        value="{{ $akun->bukti_valid_lebih100rb }}">
                                    <button class="btn btn-danger" type="submit"><i class='fas fa-trash'></i>
                                        Hapus</button>
                                </form>
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
    {{-- agar error session hilang ketika sudah menampilkan selama 2 detik --}}
    <script>
        @if ($currentIdKey == $errorModalId)
            @if (session('error'))
                $(document).ready(function() {
                    // Tambahkan setTimeout untuk menghapus pesan error dengan kelas "alert-danger custom-rounded-box" setelah 3 detik
                    setTimeout(function() {
                        $('.alert.alert-danger.custom-rounded-box').remove();
                    }, 2000);
                });
            @endif
        @endif
    </script>

    <script>
        // Mendengarkan klik pada tombol "Batal"
        document.getElementById("batalHapusID").addEventListener("click", function() {
            // Di sini Anda dapat menambahkan kode untuk menutup modal atau mengganti tampilan sesuai kebutuhan Anda.
            // Misalnya, jika Anda menggunakan Bootstrap modal, Anda dapat menggunakan kode berikut untuk menutup modal:
            $("#hapusModalDetail{{ $akun->id_key }}").modal("hide");
        });
    </script>

    <style>
        .custom-rounded-box {
            border-radius: 12px;
            /* Sesuaikan radius sudut sesuai keinginan Anda */
            padding: 10px;
            /* background-color: #f8d7da; */
            /* Ganti dengan warna latar belakang yang Anda inginkan */
            color: white;
            /* Ganti dengan warna teks yang Anda inginkan */
        }
    </style>
@endpush
