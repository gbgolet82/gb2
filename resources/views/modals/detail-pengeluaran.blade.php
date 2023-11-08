@php
    $selectedRole = session('selectedRole');
    $karyawanRoles = session('karyawanRoles');
@endphp

<form action="{{ route('acc.pengeluaran', $pengeluaran->id_laporan) }}" method="post" enctype="multipart/form-data">
    {{-- <form action="{{ route('acc.pengeluaran') }}" method="post" enctype="multipart/form-data"> --}}
    {{ csrf_field() }}
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
            <span class="text-bold d-flex align-items-center" style="font-size: 16px">Detail Pengeluaran</span>
            @if ($pengeluaranBelumActive == true)
                <span class="ml-auto mr-3 text-center badge-cr">Belum Dicek</span>
            @else
                <span class="ml-auto mr-3 text-center badge-ijo">Sudah Dicek</span>
            @endif
        </div>
        <div class="card" style="border-radius: 10px">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <span>Kode Laporan</span><br>
                        <span class="text-bold">{{ $pengeluaran->kode_laporan }}</span>
                    </div>
                    <div class="col-4">
                        <span>Unit Usaha</span><br>
                        <span class="text-bold">{{ $pengeluaran->usaha }}</span>
                    </div>
                    <div class="col-4">
                        <span>Kasir</span><br>
                        <span class="text-bold">{{ $pengeluaran->nama_kasir }}</span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <span>Tanggal Laporan</span><br>
                        <span
                            class="text-bold">{{ \Carbon\Carbon::parse($pengeluaran->tanggal_laporan)->format('d/m/Y H:i:s') }}</span>
                    </div>
                    <div class="col-4">
                        <span>Nominal</span><br>
                        <span class="text-bold">Rp. {{ number_format($pengeluaran->nominal, 0, ',', '.') }}</span>
                    </div>
                    <div class="col-4">
                        <span>Gambar Bukti</span><br>
                        <span>
                            <a class="text-primary" href="{{ asset('nota/' . $pengeluaran->gambar_bukti) }}"
                                target="_blank">Lihat</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="border-radius: 10px;">
            <div class="card-body p-3">
                <div class="row">
                    <!-- Add your table inside the modal-body -->
                    <table class="table-border table-hover table-responsive mt-1 p-1" style="border-radius: 10px;">
                        <tr class="bg-light" style="height: 40px;">
                            <th width='480px'>Klasifikasi</th>
                            <th width='480px'>Akun</th>
                            <th width='480px'>Sub Akun 1</th>
                            <th width='480px'>Sub Akun 2</th>
                            <th width='480px'>Sub Akun 3</th>
                        </tr>
                        <tr>
                            <td>{{ $pengeluaran->klasifikasi }}</td>
                            <td>{{ $pengeluaran->akun }}</td>
                            <td>{{ $pengeluaran->sub_akun_1 ?? '-' }}</td>
                            <td>{{ $pengeluaran->sub_akun_2 ?? '-' }}</td>
                            <td>{{ $pengeluaran->sub_akun_3 ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex">
            <span class="text-bold d-flex align-items-center mb-3" style="font-size: 16px">Catatan Pengecekan
                Manager</span>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                @if (($karyawanRoles->count() == 1 && !$karyawanRoles->contains('manajer')) || $selectedRole != 'manajer')
                    @if ($pengeluaran->status_cek == 'Belum Dicek')
                        <textarea class="form-control" id="inputCatatan" name="catatan" placeholder="Belum Dicek Manajer" rows="3"
                            disabled></textarea>
                    @else
                        <textarea class="form-control" id="inputCatatan" name="catatan" rows="2" disabled>{{ $pengeluaran->catatan }}</textarea>
                    @endif
                @else
                    @if ($pengeluaran->status_cek == 'Belum Dicek')
                        <textarea class="form-control" id="inputCatatan" name="catatan" placeholder="Masukan catatan pengecekan" rows="3"></textarea>
                    @else
                        <textarea class="form-control" id="inputCatatan" name="catatan" rows="2" disabled>{{ $pengeluaran->catatan }}</textarea>
                    @endif
                @endif
            </div>

        </div>


        {{-- <div class="d-flex bd-highlight justify-content-end mt-3">
            <div class="bd-highlight">
                <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal" id="resetData"><i
                        class="fa fa-ban"></i> Batal</button>


                @php
                    $acc = ($karyawanRoles->count() == 1 && $karyawanRoles->contains('manajer')) || $selectedRole == 'manajer';
                @endphp

                <button type="submit"
                    class="btn btn-success text-white toastrDefaultSuccess @if ($pengeluaran->status_cek == 'Sudah Dicek') disabled @endif"
                    id="simpanAcc">
                    <i class="{{ $acc ? 'fas fa-check-circle' : 'fas fa-print' }}"></i>
                    {{ $acc ? 'ACC' : 'Print' }}
                </button>

            </div>
        </div> --}}


        <div class="d-flex bd-highlight justify-content-end mt-3">
            <div class="bd-highlight">
                <div class="d-flex flex-wrap"> <!-- Added a flex-wrap container -->
                    <button type="button" class="btn btn-secondary mb-2 mr-2" data-dismiss="modal" id="resetData">
                        <i class="fa fa-ban"></i> Batal
                    </button>

                    @php
                        $acc = ($karyawanRoles->count() == 1 && $karyawanRoles->contains('manajer')) || $selectedRole == 'manajer';
                    @endphp

                    @if ($acc)
                        <button type="{{ $pengeluaran->status_cek === 'Sudah Dicek' ? 'button' : 'submit' }}"
                            class="btn btn-success text-white toastrDefaultSuccess {{ $pengeluaran->status_cek === 'Sudah Dicek' ? 'disabled' : '' }}"
                            id="simpanAcc">
                            <i class="fas fa-check-circle"></i> ACC
                        </button>
                    @else
                        <div class="dropdown">
                            <button class="btn btn-success text-white toastrDefaultSuccess dropdown-toggle"
                                type="button" id="printDropdown" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fas fa-print"></i> Print
                            </button>
                            <div class="dropdown-menu" aria-labelledby="printDropdown">
                                <a href="/print_laporan_pengeluaran/{{ $pengeluaran->id_laporan }}" target="_blank"
                                    class="dropdown-item">
                                    <i class="fas fa-print"></i> Print Struck
                                </a>
                                <a class="dropdown-item"
                                    href="/print_laporan_pengeluaran_a4/{{ $pengeluaran->id_laporan }}" target="_blank">
                                    <i class="fas fa-print"></i> Print A4
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</form>
