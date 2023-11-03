@extends('main')

@section('laba_rugi', 'active')


@section('content')
    <style>
        @media (max-width: 768px) {

            /* Perubahan untuk tampilan mobile */
            .col-md-3 {
                width: 100%;
                /* Membuat elemen dengan kelas col-md-3 menjadi lebar penuh pada tampilan mobile */
                margin-bottom: 10px;
                /* Memberikan margin bawah untuk elemen dengan kelas col-md-3 pada tampilan mobile */
            }

            .icon-input {
                min-width: 100%;
                /* Memperbesar lebar input field pada tampilan mobile */
                height: 37.5px;
                /* Mengatur tinggi input field pada tampilan mobile */
            }

            .btn {
                width: 100%;
                /* Membuat tombol menjadi lebar penuh pada tampilan mobile */
            }
        }
    </style>

    <!-- Content Header (Page header) -->
    <style>
        .badge-kuning {
            /* position: relative; */
            font-size: 14px;
            padding: 3px 5px;
            font-size: 14px;
            border-radius: 6px;
            background-color: #fd7e14;
            color: #fff;
        }

        td[data-toggle="modal"] {
            cursor: pointer;
        }

        <blade media|%20(max-width%3A%20820px)%20%7B%0D>.hidden {
            display: none !important;
        }
    </style>

    @php
        $selectedRole = session('selectedRole');
        $karyawanRoles = session('karyawanRoles');
        // dd($selectedRole);
    @endphp

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item text-secondary">
                            Dashboard
                        </li>
                        <li class="breadcrumb-item active">Laba Rugi</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-secondary">
                            {{ Carbon\Carbon::now()->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-success mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-2 mt-3 text-center">
                                    <strong class="font-weight-bold">
                                        <h4 style="color:#28a745;">LABA & RUGI</h4>
                                    </strong>
                                </div>

                                <div class="col-10 mx-auto">
                                    <div class="card col-12">
                                        <div class="card-body p-3">
                                            <div class="row">
                                           
                                            </div>



                                            <div class="row">
                                                <div class="col-12 col-md-6 mb-2 mb-md-0 align-self-center">
                                                    <span style="font-size: 16px;"><i class="fas fa-info-circle"></i>
                                                        Klik Kode Laporan untuk
                                                        melihat detail</span>
                                                </div>
                                                <div class="col-12 col-md-3 ml-auto">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <button class="btn btn-outline-danger"
                                                                style="border-radius: 10px; width: 100%;" type="button"
                                                                data-toggle="modal" data-target="#eksporData"
                                                                aria-expanded="false">
                                                                <i class="fas fa-file-pdf"></i> Pdf
                                                            </button>
                                                        </div>
                                                        <div class="col-6">
                                                            <button class="btn btn-outline-success"
                                                                style="border-radius: 10px; width: 100%;" type="button"
                                                                data-toggle="modal" data-target="#eksporData"
                                                                aria-expanded="false">
                                                                <i class="fas fa-file-excel"></i> Excel
                                                            </button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Kode Laporan</th>
                                        <th>Tanggal</th>
                                        <th>Kasir</th>
                                        <th>Klasifikasi</th>
                                        <th>Usaha</th>
                                        <th>Akun</th>
                                        <th>Sub Akun 1</th>
                                        <th>Sub Akun 2</th>
                                        <th>Sub Akun 3</th>
                                        <th>Nominal</th>
                                        <th>Gambar Bukti</th>

                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table> --}}

                            
                     
                        </div>
                    </div>

            

                </div>
            </div>
        </div>
    </section>
@endsection

