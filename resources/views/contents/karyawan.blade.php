@extends('main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item text-secondary">
                            Dashboard
                        </li>
                        <li class="breadcrumb-item active">Data Karyawan</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <div class="col-auto">
                            {{ Carbon\Carbon::now()->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}
                        </div>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- card -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-success">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 mt-4">
                                    <strong class="font-weight-bold">
                                        <h4 style="color:#28a745;">DATA KARYAWAN</h4>
                                    </strong>
                                </div>

                                <div class="col-9">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 col-md-4 mb-2">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" for="inputGroupSelect01">Unit
                                                                Usaha</span>
                                                        </div>
                                                        <select class="custom-select" id="usaha">
                                                            <option value="">Semua
                                                            </option>
                                                            @foreach ($unit_usaha as $item)
                                                                <option value="{{ $item->nama_usaha }}">
                                                                    {{ $item->nama_usaha }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4 mb-2">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" for="jabatan">Jabatan</span>
                                                        </div>
                                                        <select class="custom-select" id="jabatan">
                                                            <option value="">Semua</option>
                                                            <option value="Owner">Owner</option>
                                                            <option value="Manajer">Manajer</option>
                                                            <option value="Kasir">Kasir</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4 mb-2">
                                                    <button class="btn btn-block text-white"
                                                        style="background-color: #28a745; border-radius: 10px;"
                                                        type="button" data-toggle="modal" data-target="#tambahData"
                                                        aria-expanded="false"><i
                                                            class="fas fa-plus-circle left-icon-holder"></i> &nbsp;
                                                        Tambah
                                                    </button>

                                                    <div class="modal fade" id="tambahData" data-backdrop="static"
                                                        data-keyboard="false" aria-labelledby="staticBackdropLabel"
                                                        aria-hidden="true" data-target="#staticBackdrop">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">
                                                                        Tambah Data Karyawan
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close"
                                                                        id="reset">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                @include('modals.tambah-karyawan')
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-3 col-md-6 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="h6 mb-3">Jumlah Karyawan
                                                    </div>
                                                    <div class="h6 mb-0 mb-1" style="color: #28a745">
                                                        {{ isset($jumlah_karyawan) ? $jumlah_karyawan : '-' }} Data </div>
                                                </div>
                                                <div class="col-auto">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="h6 mb-3">Jumlah Manajer
                                                    </div>
                                                    <div class="h6 mb-0 mb-1" style="color: #28a745">
                                                        {{ isset($jumlah_manajer) ? $jumlah_manajer : '-' }} Data</div>
                                                </div>
                                                <div class="col-auto">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="h6 mb-3"> Jumlah Kasir
                                                    </div>
                                                    <div class="h6 mb-0 mb-1" style="color: #28a745">
                                                        {{ isset($jumlah_kasir) ? $jumlah_kasir : '-' }} Data</div>
                                                </div>
                                                <div class="col-auto">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="h6 mb-3">Manajer & Kasir
                                                    </div>
                                                    <div class="h6 mb-0 mb-1" style="color: #28a745">
                                                        {{ isset($manajer_kasir) ? $manajer_kasir : '-' }} Data</div>
                                                </div>
                                                <div class="col-auto">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table id="example2" class="table table-bordered table-hover mt-0 pt-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Unit Usaha</th>
                                        <th>No HP</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karyawan as $k)
                                        <tr>
                                            <td width=5%>{{ $loop->iteration }}.</td>
                                            <td width=25% class="font-weight-bold">{{ $k->nama }}
                                            </td>
                                            <td width=15%>
                                                @if ($k->manajer == 1)
                                                    <span class="text-white badge badge-primary"
                                                        style="font-size: 14px; border-radius: 10px;">Manajer</span>
                                                @endif

                                                @if ($k->kasir == 1)
                                                    <span class="text-white badge badge-success"
                                                        style="font-size: 14px; border-radius: 10px;">Kasir</span>
                                                @endif

                                                @if ($k->owner == 1)
                                                    <span class="text-white badge badge-secondary"
                                                        style="font-size: 14px; border-radius: 10px;">Owner</span>
                                                @endif
                                            </td>

                                            <td width=20%>{{ $k->nama_usaha }}</td>
                                            <td>{{ $k->nohp }}</td>
                                            <td>
                                                <span class="text-white badge badge-success text-center text-uppercase"
                                                    style="font-size: 14px; border-radius: 10px;">{{ $k->status }}</span>
                                            </td>
                                            <td width=8%>
                                                <div class="d-flex justify-content-center">
                                                    <div id="hoverText">
                                                        <a type="button"
                                                            style="color: #046ddd; font-size: 18px; margin-right: 2px;"
                                                            href="{{ route('detail.karyawan', $k->id_karyawan) }}"><i
                                                                class="fa fa-info-circle" title="Detail"></i></a>

                                                        <a type="button" style="color: #dc3545; font-size: 18px;"><i
                                                                class="far fa-trash-alt" title="Hapus"
                                                                data-toggle="modal"
                                                                data-target="#konfirmasiHapus{{ $k->id_karyawan }}"></i></a>

                                                        <div class="modal fade" id="konfirmasiHapus{{ $k->id_karyawan }}" tabindex="-1"
                                                            role="dialog" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Konfirmasi Hapus</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Apakah Anda yakin ingin menghapus data ini?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal"><i class="fa fa-ban"></i>
                                                                            Batal</button>
                                                                        <form
                                                                            action="{{ route('hapus.karyawan', $k->id_karyawan) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger"><i
                                                                                    class="far fa-trash-alt"></i> Ya,
                                                                                Hapus</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            var table = $('#example2').DataTable();
            var usahaSelect = $('#usaha');
            var jabatanSelect = $('#jabatan');

            // Handle filter change for Akun
            usahaSelect.on('change', function() {
                var selectedUsaha = $(this).val();
                if (selectedUsaha === 'Semua') {
                    // Clear the Akun filter
                    table.columns(3).search('').draw();
                } else {
                    table.columns(3).search(selectedUsaha).draw();
                }
            });

            // Handle filter change for Sub Akun
            jabatanSelect.on('change', function() {
                var selectedJabatan = $(this).val();
                if (selectedJabatan === 'Semua') {
                    // Clear the Sub Akun filter
                    table.columns(2).search('').draw();
                } else {
                    table.columns(2).search(selectedJabatan).draw();
                }
            });
        });
    </script>
@endpush
