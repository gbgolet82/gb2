{{-- <form action="{{ route('detail.klasifikasi', $akun->id_key) }}" method="post" enctype="multipart/form-data"> --}}
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
</style>
<div class="modal-body">
    <div class="d-flex mb-3">
        <span class="text-bold d-flex align-items-center" style="font-size: 18px">Detail Klasifikasi Akun</span>
    </div>
    <div class="card" style="border-radius: 10px;">
        <div class="card-body p-3">
            <div class="row">
                <!-- Add your table inside the modal-body -->
                <table class="table-border table-responsive mt-1 p-1" style="border-radius: 10px;">
                    <tr style="height: 40px;">
                        <th width='480px'>Klasifikasi</th>
                        <th width='480px'>Usaha</th>
                        <th width='480px'>Akun</th>
                        <th width='480px'>Sub Akun 1</th>
                        <th width='480px'>Sub Akun 2</th>
                        <th width='480px'>Sub Akun 3</th>
                    </tr>
                    <tr>
                        <td>{{ $akun->klasifikasi }}</td>
                        <td>{{ $akun->nama_usaha }}</td>
                        <td>{{ $akun->akun }}</td>
                        <td align="center">{{ $akun->sub_akun_1 ?? '-' }}</td>
                        <td align="center">{{ $akun->sub_akun_2 ?? '-' }}</td>
                        <td align="center">{{ $akun->sub_akun_3 ?? '-' }}</td>
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
                        <th width='480px'>Bukti Valid (transaksi < 100 rb)</th>
                        <th width='480px'>Bukti Valid (transaksi > 100 rb)</th>
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

    {{-- <div class="card" style="border-radius: 10px">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <span>Kode Laporan</span><br>
                            <span class="text-bold">{{ $akun->kode_laporan }}</span>
                        </div>
                        <div class="col-4">
                            <span>Unit Usaha</span><br>
                            <span class="text-bold">{{ $akun->usaha }}</span>
                        </div>
                        <div class="col-4">
                            <span>Kasir</span><br>
                            <span class="text-bold">{{ $akun->nama_kasir }}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            <span>Tanggal Laporan</span><br>
                            <span
                                class="text-bold">{{ \Carbon\Carbon::parse($akun->tanggal_laporan)->format('d/m/Y H:i:s') }}</span>
                        </div>
                        <div class="col-4">
                            <span>Nominal</span><br>
                            <span class="text-bold">Rp. {{ number_format($akun->nominal, 0, ',', '.') }}</span>
                        </div>
                        <div class="col-4">
                            <span>Gambar Bukti</span><br>
                            <span>
                                <a class="text-primary second-modal-trigger" data-toggle="modal"
                                    data-target="#gambarModall{{ $akun->id_klasifikasi }}">Lihat</a>
                            </span>
                            <div class="modal fade" id="gambarModall{{ $akun->id_klasifikasi }}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
                                data-backdrop="static">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Gambar Bukti</h5>
                                            <button type="button" class="close" data-toggle="modal"
                                                data-target="#lihatPemasukan{{ $akun->id_klasifikasi }}"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body"
                                            style="display: flex; justify-content: center; align-items: center;">
                                            <img src="{{ asset('nota/' . $akun->gambar_bukti) }}" alt="Gambar Bukti"
                                                style="width: 450px; height: 450px;">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                data-toggle="modal"
                                                data-target="#lihatPemasukan{{ $akun->id_klasifikasi }}">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

    <div class="d-flex bd-highlight justify-content-end mt-3">
        <div class="bd-highlight">
            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal" id="resetData"><i
                    class="fa fa-ban"></i> Batal</button>
            <button type="submit" class="btn btn-success text-white toastrDefaultSuccess"
                id="simpanDetailKlasifikasi"><i class="fas fa-print"></i>
                Aksi</button>
        </div>
    </div>
</div>
</form>
