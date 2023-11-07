@php
    $selectedRole = session('selectedRole');
    $karyawanRoles = session('karyawanRoles');
@endphp

<form action="{{ route('acc.pemasukan', $pemasukan->id_laporan) }}" method="post" enctype="multipart/form-data">
    {{-- <form action="{{ route('acc.pemasukan') }}" method="post" enctype="multipart/form-data"> --}}
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

        <blade media|%20(max-width%3A%20820px)%20%7B%0D>.hidden {
            display: none !important;
        }
    </style>
    <div class="modal-body">
        <div class="d-flex mb-3">
            <span class="text-bold d-flex align-items-center" style="font-size: 16px">Detail Pemasukan</span>
            @if ($pemasukanBelumActive == true)
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
                        <span class="text-bold">{{ $pemasukan->kode_laporan }}</span>
                    </div>
                    <div class="col-4">
                        <span>Unit Usaha</span><br>
                        <span class="text-bold">{{ $pemasukan->usaha }}</span>
                    </div>
                    <div class="col-4">
                        <span>Kasir</span><br>
                        <span class="text-bold">{{ $pemasukan->nama_kasir }}</span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <span>Tanggal Laporan</span><br>
                        <span
                            class="text-bold">{{ \Carbon\Carbon::parse($pemasukan->tanggal_laporan)->format('d/m/Y H:i:s') }}</span>
                    </div>
                    <div class="col-4">
                        <span>Nominal</span><br>
                        <span class="text-bold">Rp. {{ number_format($pemasukan->nominal, 0, ',', '.') }}</span>
                    </div>
                    <div class="col-4">
                        <span>Gambar Bukti</span><br>
                        <span>
                            <a class="text-primary" href="{{ asset('nota/' . $pemasukan->gambar_bukti) }}"
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
                            <td>{{ $pemasukan->klasifikasi }}</td>
                            <td>{{ $pemasukan->akun }}</td>
                            <td>{{ $pemasukan->sub_akun_1 ?? '-' }}</td>
                            <td>{{ $pemasukan->sub_akun_2 ?? '-' }}</td>
                            <td>{{ $pemasukan->sub_akun_3 ?? '-' }}</td>
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
                <input type="hidden" name="tanggal_cek"
                                    value="{{ old('tanggal_cek',\Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d\TH:i:s')) }}">
                @if (!($karyawanRoles->count() == 1 && $karyawanRoles->contains('manajer')) && $selectedRole != 'manajer')
                    @if ($pemasukan->status_cek == 'Belum Dicek')
                        <textarea class="form-control" id="inputCatatan" name="catatan" placeholder="Belum Dicek Manajer" rows="3"
                            disabled></textarea>
                    @else
                        <textarea class="form-control" id="inputCatatan" name="catatan" rows="2" disabled>Dicek Oleh : {{ $pemasukan->nama_manager }}, Tgl Cek : {{ \Carbon\Carbon::parse($pemasukan->tanggal_cek)->locale('id_ID')->isoFormat('D MMMM Y HH:mm:ss') }} - {{ $pemasukan->catatan }}</textarea>
                    @endif
                @else
                    @if ($pemasukan->status_cek == 'Belum Dicek')
                        <textarea class="form-control" id="inputCatatan" name="catatan" placeholder="Masukan catatan pengecekan" rows="3"></textarea>
                    @else
                        <textarea class="form-control" id="inputCatatan" name="catatan" rows="2" disabled>Dicek Oleh : {{ $pemasukan->nama_manager }}, Tgl Cek : {{ \Carbon\Carbon::parse($pemasukan->tanggal_cek)->locale('id_ID')->isoFormat('D MMMM Y HH:mm:ss') }} - {{ $pemasukan->catatan }}</textarea>
                    @endif
                @endif
            </div>

        </div>


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
                        <button type="submit"
                            class="btn btn-success text-white toastrDefaultSuccess {{ $pemasukan->status_cek === 'Sudah Dicek' ? 'disabled' : '' }}"
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
                                <a href="/print_laporan_pemasukan/{{ $pemasukan->id_laporan }}" target="_blank"
                                    class="dropdown-item">
                                    <i class="fas fa-print"></i> Print Struck
                                </a>
                                <a class="dropdown-item"
                                    href="/print_laporan_pemasukan_a4/{{ $pemasukan->id_laporan }}" target="_blank">
                                    <i class="fas fa-print"></i> Print A4
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- <a href="javascript:void(0);" onclick="printPage();"
                class="btn btn-success text-white toastrDefaultSuccess">
                <i class="fas fa-print"></i> Print
             </a>
             
             <script>
             function printPage() {
                 const printWindow = window.open("/print_laporan_pemasukan/{{ $pemasukan->id_laporan }}", "_blank");
                 if (printWindow) {
                     printWindow.onload = function() {
                         printWindow.print();
                         printWindow.onafterprint = function() {
                             printWindow.close();
                         };
                     };
                 }
             }
             </script> --}}
    </div>
</form>
