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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-2">
                    <div class="card ijo-kiri">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h5 font-weight-bold mb-3">Jumlah <br>Karyawan
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold mb-1" style="color: #28a745">11 Orang</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-3x text-gray"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-2">
                    <div class="card ijo-kiri">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h5 font-weight-bold mb-3">Jumlah <br>Manajer
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold mb-1" style="color: #28a745">11 Orang</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-3x text-gray"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-2">
                    <div class="card ijo-kiri">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h5 font-weight-bold mb-3"> Jumlah <br>Kasir
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold mb-1" style="color: #28a745">11 Orang</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-3x text-gray"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-2">
                    <div class="card ijo-kiri">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h5 font-weight-bold mb-3">Manajer & <br>Kasir
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold mb-1" style="color: #28a745">11 Orang</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-3x text-gray"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                                                        <select class="custom-select" id="inputGroupSelect01">
                                                            <option selected>Semua</option>
                                                            <option value="1">Toko Guna Bakti</option>
                                                            <option value="2">Penggilingan Wangon</option>
                                                            <option value="3">Produksi</option>
                                                            <option value="4">Sawah</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4 mb-2">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" for="jabatan">Jabatan</span>
                                                        </div>
                                                        <select class="custom-select" id="jabatan">
                                                            <option selected>Semua</option>
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
                                                    
                                                    <div class="modal fade" id="tambahData" data-backdrop="static" data-keyboard="false"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true"
                                                    data-target="#staticBackdrop">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                                    Tambah Data Karyawan
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close" id="reset">
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
                                            @if($k->manajer == 1)
                                                <span class="text-white badge badge-primary"
                                                      style="font-size: 14px; border-radius: 10px;">Manajer</span>
                                            @endif
                                        
                                            @if($k->kasir == 1)
                                                <span class="text-white badge badge-success"
                                                      style="font-size: 14px; border-radius: 10px;">Kasir</span>
                                            @endif

                                            @if($k->owner == 1)
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
                                                        href="{{ route('detail.karyawan', $k->id_karyawan) }}"><i class="fa fa-info-circle"
                                                            title="Detail"></i></a>

                                                    <a type="button" style="color: #dc3545; font-size: 18px;"><i
                                                            class="far fa-trash-alt" title="Hapus" data-toggle="modal"
                                                            data-target="#konfirmasiHapus"></i></a>

                                                    <div class="modal fade" id="konfirmasiHapus" tabindex="-1"
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
                                                                    <button type="button" class="btn btn-danger"
                                                                        onclick="hapusData()"><i
                                                                            class="far fa-trash-alt"></i> Ya,
                                                                        Hapus</button>
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
