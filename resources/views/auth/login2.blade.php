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
            background-image: url('{{ asset('Frame.png') }}');
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

        .capitalize-first {
            text-transform: capitalize;
            font-size: 15px;
        }

        .bold-white-hr {
            border: 0;
            height: 2px;
            /* Atur tinggi garis sesuai kebutuhan Anda */
            background-color: white;
            font-weight: bold;
            /* Membuat tebal (bold) */
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

    <div class="container h-100">
        <div class="row h-100 justify-content-center align-item-center ">
            <div
                class="col-lg-3 bg-utama1 col-md-7 col-sm-12 card-none-color shadow-lg p-lg-4 p-md-4 p-sm-3 mx-3 mt-3 mb-3 align-self-center">
                <h3 class="card-title mt-2">Sistem Laporan Pemasukan & Pengeluaran</h3><br>
                <p class="text-white">Mekanisme pencatatan laporan pemasukan & pengeluaran serta analisa laba rugi
                    berbasis website</p>
            </div>


            <div class="col-lg-5 col-md-7 col-sm-12 card-none-color shadow-lg p-lg-4 p-md-4 p-sm-3 mx-3 mb-3 align-self-center"
                id="rangkap">
                <div class="d-flex justify-content-start">
                    <a href="{{ route('login') }}" class="btn btn-sm custom-button p-0 ml-2 text-success"
                        style="font-size: 17px;" title="Logout">
                        <i class="fa fa-arrow-right fa-rotate-180 text-success" style="font-size: 22px;"></i>
                        <span>&nbsp;LOGOUT</span>
                    </a>
                </div>

                <div class="col-lg-11 bg-utama1 card-none-color shadow-lg p-lg-2 p-md-4 p-sm-3 mx-1 mb-3 mt-3">
                    <span class="text-white text-uppercase font-weight-bold" style="font-size:17px;">
                        {{-- <i class="fa fa-user-circle"></i> --}}
                        &nbsp;{{ session('nama') }}</span>
                    <!-- Adjust the margin-bottom (mb) value as needed -->
                    <hr class="mb-1 mt-2 bold-white-hr">
                    <span class="text-white"> <i class="fa fa-phone"></i> &nbsp;{{ session('nohp') }}</span> <br>
                    <span class="text-white"> <i class="fa fa-map-marker"></i> &nbsp; {{ session('nama_usaha') }}</span>
                    <!-- Replace with the actual user's name -->
                </div>
                <h5 class="mt-4">Pilih Jabatan Akun <i class="fas fa-info-circle" style="font-size: 16px;"></i></h5>

                <span>Anda terdaftar dengan rangkap 2 jabatan, silahkan pilih salah satu untuk memulai
                    <span data-toggle="popover"
                        data-content="Login akun untuk mengakses fitur laporan pemasukan & pengeluaran"></span>
                </span>
                <style>
                    .custom-card {
                        border-radius: 20px;
                        /* Mengatur radius sudut (rounded corners) */
                        padding: 5px;
                        /* Mengatur jarak padding */
                    }
                </style>
                @foreach ($karyawanRoles as $role)
                    <div class="col-lg-11 bg-utama2 card-none-color shadow-lg p-lg-2 p-md-4 p-sm-3 mx-1 mb-3 mt-3">
                        <div class="row" style="cursor: pointer; font-size:15px;"
                            onclick="redirectToDashboard('{{ route('selectRole', ['role' => $role]) }}')">
                            <div class="col-8">
                                <h6 class="text-success mt-2 mb-1 capitalize-first"> &nbsp;<i class="fa fa-id-card"></i>
                                    &nbsp;{{ $role }}
                                </h6>
                            </div>
                            <style>
                                .custom-card {
                                    border: none;
                                    /* Menghilangkan border */
                                    background-color: #ffffff;
                                }
                            </style>
                            <div class="col-4">
                                <div class="card custom-card">
                                    <a href="{{ route('selectRole', ['role' => $role]) }}"
                                        class="btn btn-sm custom-button p-0">
                                        <div class="card-body p-0 d-flex align-items-center justify-content-center">
                                            <span class="align-middle text-success" style="font-size:15px">Pilih
                                                &nbsp;<i class="fa fa-arrow-right ml-2 align-middle"
                                                    style="font-size:15px"></i>
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        function redirectToDashboard(route) {
                            window.location.href = route;
                        }
                    </script>
                @endforeach


                {{-- <div class="col-lg-11 bg-utama1 card-none-color shadow-lg p-lg-2 p-md-4 p-sm-3 mx-1 mb-4 mt-3">
                    <div class="row">
                        <div class="col-8">
                            <h6 class="text-white mt-2 mb-1"> &nbsp;<i class="fa fa-id-card"></i> &nbsp;Owner</h6>
                        </div>
                        <div class="col-4">
                            <div class="card custom-card">
                                <button class="btn btn-sm custom-button p-0" type="button">
                                    <div class="card-body p-0 d-flex align-items-center justify-content-center">
                                        <span class="align-middle">Pilih &nbsp;<i
                                                class="far fa-arrow-alt-circle-right ml-2 align-middle"
                                                style="font-size:19px"></i></span>
                                    </div>
                                </button>
                            </div>

                        </div>


                    </div>
                </div> --}}
                <p class="text-center small mt-4">
                    Dikembangkan oleh <a class="warna-utama" href="http://www.golet.co.id/" target="_blank">PT Golet
                        Digital Solusi </a>
                    &nbsp;
                </p>


            </div>


        </div>

        {{-- <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script> --}}
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
