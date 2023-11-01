{{-- @extends('admin.template') --}}

<html>

<head>
    <style>
        @media (max-width: 767px) {
            .hidden-mobile {
                width: 20%;
                height: 10%;
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 50%;
            }
        }
    </style>

    <!-- <style>
         @media (max-width: 767px) {
         .hidden-mobile1 {
           margin: 0;
          height: 100%;
          overflow: hidden
         }
         }
          </style> -->

    <style>
        input::-ms-reveal,
        input::-ms-clear {
            display: none;
        }
    </style>

    <style>
        body {
            font-family: "Source Sans Pro", "Nunito", sans-serif;
            /* background-color: white; */
            /* background-image: url("Frame.png"); */
            background-image: url("gambar/Frame.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: top;
            background-attachment: fixed;
            height: 100vh;
            background-color: #9FE27C;
        }

        .card-none-color {
            background-color: white;
            border-radius: 10px;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 700;
        }

        a {
            text-decoration: none !important;
            color: inherit;
        }

        .password-icon {
            position: absolute;
            right: 15px;
            top: 10px;
            z-index: 1000;
        }

        /* --------------------- */
        .btn-primary {
            background-color: #28a745;
            border: none;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #F0FDF1;
            border-color: #F0FDF1;
        }

        .show>.btn-primary.dropdown-toggle {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-primary:not(:disabled):not(.disabled).active,
        .btn-primary:not(:disabled):not(.disabled):active,
        .show>.btn-primary.dropdown-toggle {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-primary.focus,
        .btn-primary:focus {
            color: #fff;
            background-color: #28a745;
            border-color: ##28a745;
            box-shadow: 0 0 0 0.2rem #9FE27C;
        }

        /* ------------------------ */

        .form-control:focus {
            background-color: #fff;
            border-color: white;
            outline: 0;
            box-shadow: 0 0 0 0.2rem #9FE27C;
        }

        .warna-utama {
            color: #28a745;
        }

        a:hover {
            color: #F0FDF1;
        }

        /* .bg-utama {
            background-color: #f1f1f1;
        } */
        .bg-utama1 {
            background-color: #28a745;
        }

        .no-bg {
            background-color: white;
        }

        .border-left-0 {
            border-left: 0px;
        }

        .border-right-0 {
            border-right: 0px;
        }

        .card-title {
            text-align: left;
            /* Meratakan teks ke tengah secara horizontal */
            color: white;
            /* Warna teks */
            margin-bottom: 30px;
            /* Menambahkan jarak yang lebih besar antara garis dan tulisan */
        }

        .card-title::after {
            content: '';
            /* Membuat elemen konten kosong */
            display: block;
            /* Mengubahnya menjadi elemen blok */
            border-bottom: 3px solid white;
            /* Menambahkan garis putih di bawah teks */
            margin-top: 30px;
            /* Menambahkan jarak antara garis dan tulisan */
        }

        /* .centered-text {
            text-align: center;
            padding: 5px;
        } */
    </style>
    <!-- Required meta tags -->
    <!-- FONT AWESOME 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://kit.fontawesome.com/93c5b8f77e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://kit.fontawesome.com/93c5b8f77e.css" crossorigin="anonymous">
    <!-- FONT AWESOME 5 -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" type="img/png" href="title.png">

    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <link rel="icon" href="{!! asset('gambar/gunabakti-logo.png') !!}" />
    <title>GUNA BAKTI | LOGIN</title>

    <link rel="stylesheet" type="text/css" href="/casgpo/asset/css/ppg.css">

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o), m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script',
            'https://www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-57652882-8', 'auto');
        ga('send', 'pageview');
    </script>
</head>

<body>
    @if (session('alert'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            @if (isset(session('alert')[0]))
                Swal.fire({
                    icon: 'error',
                    text: "Silahkan untuk login kembali!",
                    customClass: {
                        popup: 'small-alert' // Tambahkan kelas CSS "small-alert" di sini
                    }
                });
            @endif
        </script>
        @if (session('error'))
            <script>
                // Tampilkan pesan kesalahan dengan JavaScript (misalnya dengan SweetAlert)
                Swal.fire({
                    icon: 'error',
                    text: '{{ session('error') }}',
                    customClass: {
                        popup: 'small-alert' // Tambahkan kelas CSS "small-alert" di sini
                    }
                });
                @php
                    session()->forget('error');
                @endphp
            </script>
        @endif

    @endif


    <div class="container h-100">
        <div class="row h-100 justify-content-center align-item-center ">
            <div
                class="col-lg-3 bg-utama1 col-md-7 col-sm-12 card-none-color shadow-lg p-lg-4 p-md-4 p-sm-3 mx-3 mt-3 mb-3 align-self-center">
                <h3 class="card-title mt-2">Sistem Laporan Pemasukan & Pengeluaran</h3><br>
                <p class="text-white">Mekanisme pencatatan laporan pemasukan & pengeluaran serta analisa laba rugi
                    berbasis website</p>
            </div>
            <style>
                .bold-white-hr {
                    border: 0;
                    height: 2px;
                    /* Atur tinggi garis sesuai kebutuhan Anda */
                    background-color: white;
                    font-weight: bold;
                    /* Membuat tebal (bold) */
                }
            </style>


            <div class="col-lg-5 col-md-7 col-sm-12 card-none-color shadow-lg p-lg-4 p-md-4 p-sm-3 mx-3 mb-3 align-self-center"
                id="tunggal">
                <h3 class="mt-3">Login Akun</h3>
                <p>Silahkan masukkan Nomor HP dan Kata Sandi Anda untuk melanjutkan
                    ke Sistem.
                    <span data-toggle="popover"
                        data-content="Login akun untuk mengakses fitur laporan pemasukan & pengeluaran"><i
                            class="fas fa-info-circle"></i></span>
                </p>

                <form id="form1" name="form1" class="mb-3 mt-md-3" action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-group small">
                        <label class="font-weight-bold text-secondary">Nomor HP</label>
                        <div class="input-group ">
                            <div class="input-group-append">
                                <span class="input-group-text no-bg"> <i class="fas fa-phone"></i>
                                </span>
                            </div>
                            <input autofocus type="text" class="form-control @error('nohp') is-invalid @enderror"
                                id="nohp" aria-describeby="nohpHelp" name="nohp" placeholder="Masukan Nomor HP"
                                pattern="[0-9]+" value="{{ old('nohp') }}">
                            @error('nohp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group small">
                        <label class="font-weight-bold text-secondary">Kata Sandi</label>
                        <div class="input-group ">
                            <div class="input-group-append">
                                <span class="input-group-text no-bg"> <i class="fas fa-lock"></i>
                                </span>
                            </div>
                            <input type="password"
                                class="form-control 
                                @error('password')
                                is-invalid
                                @enderror
                                "
                                id="password" name="password" placeholder="Masukan Kata Sandi">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <i style="font-size: 17px;color: black;" class="password-icon mdi mdi-eye-off warna-utama"
                                type="toggle" onclick="myFunction()"></i>
                        </div>
                    </div>

                    <p href class="text-right mt-2 small">
                        <a href="#" class="warna-utama">Lupa kata sandi?</a>
                    </p>

                    <input type="hidden" name="lt" value="LT-21110667-L1HEcj1ZlM2QlJjSgJlFzG2hctwcTm">
                    <input type="hidden" name="execution" value="e2s1">
                    <input type="hidden" name="_eventId" value="submit">
                    <div class="form-group">
                        {{-- <button type="submit" class="btn btn-success btn-block"><i class="fas fa-sign-in-alt"></i>
                            Login</button> --}}
                        <button type="submit" class="btn btn-success btn-block" id="loginButton"><i
                                class="fas fa-sign-in-alt"></i>
                            Login</button>

                    </div>
                    <hr style="margin: 2px;">

                    <div class="text-center mt-3">UD GUNA BAKTI © 2023</div>
                </form>


                <p class="text-center small">
                    Dikembangkan oleh <a class="warna-utama" href="http://www.golet.co.id/" target="_blank">PT Golet
                        Digital Solusi </a>
                    &nbsp;
                </p>
            </div>


        </div>

        <script>
            document.getElementById('modeTamuButton').addEventListener('click', function() {
                // Cek apakah pengguna sudah login atau belum
                @if (Auth::check())
                    // Pengguna sudah login, cek apakah password tidak kosong
                    @if (!empty(Auth::user()->password))
                        // Password tidak kosong, alihkan ke halaman "konsultasi"
                        window.location.href = "{{ URL::to('/konsultasi') }}";
                    @else
                        // Password kosong, tampilkan pesan
                        alert('Anda belum login, silakan login terlebih dahulu!');
                    @endif
                @else
                    // Pengguna belum login, tampilkan pesan
                    alert('Anda belum login, silakan login terlebih dahulu!');
                @endif
            });
        </script>
        <script>
            function myFunction() {
                var x = document.getElementById("password");
                var eyeIcon = document.querySelector(".password-icon");

                if (x.type === "password") {
                    x.type = "text";
                    eyeIcon.classList.remove("mdi-eye-off");
                    eyeIcon.classList.add("mdi-eye");

                } else {
                    x.type = "password";
                    eyeIcon.classList.remove("mdi-eye");
                    eyeIcon.classList.add("mdi-eye-off");
                }
            }
        </script>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
        </script>

        <!-- Tambahkan SweetAlert2 CSS dan JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if (session('success'))
            <input type="hidden" id="success-message" value="{{ session('success') }}">
        @endif

        @if (session('error'))
            <input type="hidden" id="error-message" value="{{ session('error') }}">
        @endif

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            var timeout = 3000;

            if ('{{ session('success') }}') {
                setTimeout(function() {
                    Swal.fire({
                        icon: 'success',
                        title: '{{ session('success') }}',
                        timer: timeout,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                }, timeout);
            }

            if ('{{ session('error') }}') {
                setTimeout(function() {
                    Swal.fire({
                        icon: 'error',
                        title: '{{ session('error') }}',
                        timer: timeout,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                }, timeout);
            }
        </script>

        <script>
            $(function() {
                $('[data-toggle="popover"]').popover({
                    trigger: 'hover',
                    // placement: 'bottom'
                });
            });
        </script>


</body>

</html>
