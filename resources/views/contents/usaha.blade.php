@extends('main')

@section('dashboard', 'active')


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
                        <li class="breadcrumb-item active">Data Usaha</li>
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
                                    <div style="color:#28A745" class="h5 font-weight-bold mb-3">Jumlah <br>Usaha
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold mb-1">11 Usaha</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray"></i>
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
                                    <div style="color:#28A745" class="h5 font-weight-bold mb-3">Jumlah Produk Usaha
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold mb-1">11 Produk</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray"></i>
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
                                    <div style="color:#28A745" class="h5 font-weight-bold mb-3">Jumlah
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold mb-1">11 Data</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray"></i>
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
                                    <div style="color:#28A745" class="h5 font-weight-bold mb-3">
                                        Jumlah
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold mb-1">11 Data</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray"></i>
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
                    <div class="card card-outline card-success mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 mt-4">
                                    <strong class="font-weight-bold">
                                        <h4 style="color:#28a745;">DATA USAHA</h4>
                                    </strong>
                                </div>
                                <div class="col-9">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 col-md-4 mb-2">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" for="namaUsaha">Nama
                                                                Usaha</span>
                                                        </div>
                                                        <select class="custom-select" id="namaUsaha">
                                                            <option selected>Semua</option>
                                                            @foreach ($dataUsaha as $usaha)
                                                                <option value="{{ $usaha->nama_usaha }}">
                                                                    {{ $usaha->nama_usaha }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4 mb-2">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" for="inputGroupSelect02">Jenis
                                                                Usaha</span>
                                                        </div>
                                                        <select class="custom-select" id="inputGroupSelect02">
                                                            <option selected">Semua</option>
                                                            @php
                                                                $uniqueUsaha = [];
                                                            @endphp
                                                            @foreach ($dataUsaha as $usaha)
                                                                @if (!empty($usaha->jenis_usaha) && !in_array($usaha->jenis_usaha, $uniqueUsaha))
                                                                    <option value="{{ $usaha->jenis_usaha }}">{{ $usaha->jenis_usaha }}
                                                                    </option>
                                                                    @php
                                                                        $uniqueUsaha[] = $usaha->jenis_usaha;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="tambahData" data-backdrop="static" data-keyboard="false"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true" data-target="#staticBackdrop">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">
                                                {{ $modelHead }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close" id="reset">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @include('modals.tambah-usaha')
                                    </div>
                                </div>
                            </div>

                            <table id="example2" class="table table-bordered table-hover mt-0 pt-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Usaha</th>
                                        <th>Alamat Usaha</th>
                                        <th>Jenis Usaha</th>
                                        <th>Produk Usaha</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $noUrut = 1;
                                    @endphp
                                    @foreach ($dataUsaha as $usaha)
                                        <tr>
                                            <td style="width: 5%;">{{ $noUrut++ }}</td>
                                            <td>{{ $usaha->nama_usaha }}</td>
                                            <td>{{ $usaha->alamat_usaha }}</td>
                                            <td>{{ $usaha->jenis_usaha }}</td>
                                            <td>{{ $usaha->produk_usaha }}</td>
                                            <td width=8%>
                                                <div class="d-flex justify-content-center">
                                                    <div id="hoverText">
                                                        <a type="button"
                                                            style="color: #007bff; font-size: 18px; margin-right: 5px;"
                                                            data-toggle="modal"
                                                            data-target="#editModal{{ $usaha->id_usaha }}"><i
                                                                class="far fa-edit" title="Edit"></i></a>

                                                        <a type="button" style="color: #dc3545; font-size: 18px;"
                                                            data-toggle="modal"
                                                            data-target="#hapusModal{{ $usaha->id_usaha }}"><i
                                                                class="far fa-trash-alt" title="Hapus"></i></a>

                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- modal untuk edit usaha --}}
                            @foreach ($dataUsaha as $usaha)
                                <!-- Tambahkan modal edit dengan ID unik sesuai data -->
                                <div class="modal fade" id="editModal{{ $usaha->id_usaha }}" tabindex="-1"
                                    role="dialog" aria-labelledby="editModalLabel{{ $usaha->id_usaha }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $usaha->id_usaha }}">Edit
                                                    Data
                                                    Usaha</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Isi dengan formulir edit data sesuai kebutuhan Anda -->
                                                @include('modals.edit-usaha')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @foreach ($dataUsaha as $usaha)
                                <!-- Modal konfirmasi hapus -->
                                <div class="modal fade" id="hapusModal{{ $usaha->id_usaha }}" tabindex="-1"
                                    role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalHapusLabel">Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Anda yakin ingin menghapus data ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                                        class="fas fa-ban"></i> Batal</button>
                                                <form action="{{ route('hapus.usaha', $usaha->id_usaha) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" data-toggle="modal"
                                                        data-target="#hapusModal{{ $usaha->id_usaha }}"><i
                                                            class='fas fa-trash'></i> Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
