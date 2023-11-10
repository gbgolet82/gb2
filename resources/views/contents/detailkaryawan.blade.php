@extends('main')

@section('karyawan', 'active')

@section('content')
    <style>
        <blade media|%20(max-width%3A%20820px)%20%7B%0D>.hidden {
            display: none !important;
        }

        .profile-image-container {
            position: relative;
            display: inline-block;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .profile-image-container:hover .overlay {
            opacity: 1;
        }

        .camera-icon i {
            color: rgb(61, 61, 61);
            font-size: 24px;
            /* Sesuaikan ukuran ikon sesuai kebutuhan Anda */
            cursor: pointer;
        }

        .text {
            color: rgb(126, 125, 125);
            font-weight: bold;
            margin-top: 5px;
        }
    </style>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item active">
                            <a href="/" class="text-primary">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="{{ route('karyawan') }}" class="text-primary">Data Karyawan</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $karyawan->nama }}</li>
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
    </div><!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="font-weight-bold">
                                <i class="fa fa-user" style="font-size: 23px"></i> <span style="font-size: 23px">Detail
                                    Karyawan</span>
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card card-success card-outline">
                                <div class="card-body box-profile">
                                    {{-- <div class="text-center">
                                        <img class="profile-user-img img-fluid rounded-circle"
                                            src="{{ asset('gambar/fotoo.jfif') }}" alt="User profile picture"
                                            style="width: 140px; height: 140px; object-fit: cover;">
                                    </div> --}}
                                    <form action="{{ route('upload.foto', $karyawan->id_karyawan) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <!-- Konten form yang lain -->
                                        <div class="text-center">
                                            <div class="profile-image-container">
                                                @if ($karyawan->foto == null)
                                                    <img class="profile-user-img img-fluid rounded-circle"
                                                        src="{{ asset('gambar/profil.png') }}" alt="User profile picture"
                                                        style="width: 140px; height: 140px; object-fit: cover;">
                                                @else
                                                    <img class="profile-user-img img-fluid rounded-circle"
                                                        src="{{ asset('gambar/profil/' . $karyawan->foto) }}"
                                                        alt="User profile picture"
                                                        style="width: 140px; height: 140px; object-fit: cover;">
                                                @endif
                                                <div class="overlay">
                                                    <input type="file" accept="image/*" name="foto"
                                                        id="profile-pic-input" onchange="form.submit()" hidden>
                                                    <label for="profile-pic-input" class="camera-icon"
                                                        id="change-profile-pic" style="font-size: 24px; color: #000;">
                                                        <i class="fa fa-camera"></i>
                                                    </label>
                                                    <div class="text">Ubah Foto</div>
                                                </div>

                                            </div>
                                        </div>

                                    </form>

                                    <h3 class="profile-username text-center">{{ $karyawan->nama }}</h3>
                                    <p class="text-muted text-center">
                                        @if ($karyawan->manajer == 1)
                                            <span class="badge badge-primary mr-1"
                                                style="font-size: 14px; border-radius: 10px;">Manajer</span>
                                        @endif
                                        @if ($karyawan->kasir == 1)
                                            <span class="badge badge-success"
                                                style="font-size: 14px; border-radius: 10px;">Kasir</span>
                                        @endif
                                        @if ($karyawan->owner == 1)
                                            <span class="badge badge-secondary"
                                                style="font-size: 14px; border-radius: 10px;">Owner</span>
                                        @endif
                                    </p>

                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                            <span class="font-weight-bold">Unit Usaha</span> <span
                                                class="float-right">{{ $karyawan->nama_usaha }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="font-weight-bold">No HP</span> <span
                                                class="float-right">{{ $karyawan->nohp }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="font-weight-bold">Alamat</span> <span
                                                class="float-right">{{ $karyawan->alamat }}</span>
                                        </li>
                                    </ul>
                                    <button class="btn btn-block text-white mt-4"
                                        style="background-color: #28a745; border-radius: 10px;" type="button"
                                        data-toggle="modal" data-target="#perbaruiData" aria-expanded="false"><i
                                            class="fa fa-save"></i> &nbsp;Edit Data
                                    </button>

                                    <div class="modal fade" id="perbaruiData" data-backdrop="static" data-keyboard="false"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true"
                                        data-target="#staticBackdrop">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">
                                                        Edit
                                                        Karyawan
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                @include('modals.edit-karyawan')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card card-success card-outline">
                                <div class="card-header"><i class="fa fa-cogs"></i><span style="font-size: 18px">
                                        Pengaturan Akun</span>
                                </div>
                                </h4>
                                <div class="card-body box-profile">
                                    <form method="POST" action="{{ route('update.password', $karyawan->id_karyawan) }}">
                                        @csrf
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <i class="fa fa-exclamation-circle"></i>
                                                Terdapat kesalahan! Silahkan cek kembali data Anda. <br>
                                            </div>
                                        @endif
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="password">Password Baru</label>
                                                <div class="input-group">
                                                    <input type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        id="password" name="password"
                                                        placeholder="Masukan password baru"
                                                        value="{{ old('password') }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text toggle-password">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                @error('password')
                                                    <div class="invalid-feedback d-block">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="password_confirmation">Konfirmasi Password</label>
                                                <div class="input-group">
                                                    <input type="password"
                                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                                        id="password_confirmation" name="password_confirmation"
                                                        placeholder="Masukan password baru"
                                                        value="{{ old('password_confirmation') }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text toggle-password">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                @error('password_confirmation')
                                                    <div class="invalid-feedback d-block">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-flex bd-highlight justify-content-end mt-0 mb-1">
                                            <div class="bd-highlight">
                                                <button class="btn btn-block text-white"
                                                    style="background-color: #28a745; border-radius: 10px;" type="submit"
                                                    value="submit" aria-expanded="false"><i class="fa fa-save"></i>
                                                    &nbsp;Edit Akun
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>


    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            // Toggle password visibility
            $('.toggle-password').click(function() {
                $(this).find('i').toggleClass('fa-eye fa-eye-slash');
                var input = $(this).closest('.input-group').find('input');
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                } else {
                    input.attr('type', 'password');
                }
            });
        });
    </script>
@endpush
