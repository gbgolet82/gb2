<style>
    @media (max-width: 50px) {
        .hidden {
            display: none !important;
        }
    }
</style>

<aside class="main-sidebar sidebar-light-success elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link">
        <img src="{{ asset('gambar/logoo.png') }}" alt="GUNA BAKTI" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-bold">GUNA BAKTI</span>
    </a>

    <style>
        .badge {
            font-size: 70%;
        }

        .badge-br {
            position: relative;
            top: -1px;
            left: 10px;
            font-size: 12px;
            padding: 3px 5px;
            font-size: 12px;
            border-radius: 10px;
            background-color: #fd7e14;
            color: #fff;
        }

        .badge-br2 {
            position: relative;
            top: -1px;
            left: 10px;
            font-size: 12px;
            padding: 3px 5px;
            font-size: 12px;
            border-radius: 10px;
            background-color: #28a745;
            color: #fff;
        }

        .custom-icon {
            font-weight: bold;
            /* Jika ingin menjaga tebal */
        }
    </style>


    @php
        $selectedRole = session('selectedRole');
        $karyawanRoles = session('karyawanRoles');
        // dd(session('nama_usaha'));
    @endphp

    <div class="sidebar">
        <div class="text-center">
            <h5 class="btn-hilang mt-3">
                @if (session('nama_usaha') == 'SEMUA')
                    UD GUNA BAKTI
                @elseif(session('nama_usaha') == 'Wangon')
                    WANGON
                @elseif(session('nama_usaha') == 'Sawah')
                    SAWAH
                @elseif(session('nama_usaha') == 'Produksi')
                    PRODUKSI
                @elseif(session('nama_usaha') == 'GB2')
                    GB2
                @endif
                <p></p>
            </h5>
            <span class="btn-hilang">{{ session('nama') }}</span>
            <br>


            @if ($selectedRole)
                <div class="badge badge-success"><strong>{{ $selectedRole }}</strong></div>
            @else
                @if ($karyawanRoles->count() === 1)
                    <div class="badge badge-success"><strong>{{ $karyawanRoles->first() }}</strong></div>
                @else
                    <div class="badge badge-success"><strong>Peran Default</strong></div>
                @endif
            @endif

            <br>
            <a href="/data-detail-karyawan/{{ session('id_karyawan') }}" class="btn btn-white btn-sm btn-hilang"><i class="fas fa-cog"></i>
                <p> Pengaturan</p>
            </a>
            <a href="{{ route('logout') }}" class="btn btn-white btn-sm btn-hilang"><i class="fa fa-sign-out-alt"></i>
                <p> Keluar</p>
            </a>
        </div>
        <hr>
        <!-- Sidebar Menu -->

        @php
            $owner = ($karyawanRoles->count() == 1 && $karyawanRoles->contains('owner')) || $selectedRole == 'owner';
            $manajer = ($karyawanRoles->count() == 1 && $karyawanRoles->contains('manajer')) || $selectedRole == 'manajer';
            $kasir = ($karyawanRoles->count() == 1 && $karyawanRoles->contains('kasir')) || $selectedRole == 'kasir';
        @endphp
        <nav class="mt-1">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if ($owner)
                    {{-- <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item @yield('dashboard')">
                            <a href="{{ route('dashboard') }}"
                                class="nav-link @if (Request::url() == route('dashboard')) active @endif">
                                <i class="bi bi-house-door-fill custom-icon"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                    </ul> --}}
                    <li class="nav-header font-weight-bolder">Data Master</li>
                    <li class="nav-item @yield('usaha')">
                        <a href="{{ route('usaha') }}" class="nav-link @if (Request::url() == route('usaha')) active @endif">
                            <i class="bi bi-bar-chart-line-fill custom-icon"></i>
                            <p>
                                Unit Usaha
                            </p>
                        </a>
                    </li>
                    <li class="nav-item @yield('karyawan')">
                        <a href="{{ route('karyawan') }}"
                            class="nav-link @if (Request::url() == route('karyawan') || Request::routeIs('detail.karyawan')) active @endif">
                            <i class="bi bi-person-fill custom-icon"></i>
                            <p>
                                Data Karyawan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item @yield('akun')">
                        <a href="{{ route('akun') }}" class="nav-link @if (Request::url() == route('akun')) active @endif">
                            <i class="fas fa-server"></i>
                            <p>
                                Akun & Sub Akun
                            </p>
                        </a>
                    </li>
                    <li class="nav-header font-weight-bolder mt-1">Data Laporan</li>
                    <li class="nav-item @yield('labarugi')">
                        <a href="{{ route('laba_rugi') }}"
                            class="nav-link  @if (Request::url() == route('laba_rugi')) active @endif">
                            <i class="fas fa-chart-line"></i>
                            <p>
                                Laba Rugi
                            </p>
                        </a>
                    </li>
                    <li class="nav-item @yield('pemasukan_blm')">
                        <a href="{{ route('pemasukan_blm') }}"
                            class="nav-link @if (Request::url() == route('pemasukan_blm')) active @endif">
                            <i class="bi bi-cart-fill custom-icon"></i>
                            <p>
                                Pemasukan &nbsp;
                            </p>
                            <span class="badge-br badge-info" id="permintaan-badge">Blm dicek (<span
                                    id="jumlah-belum-dicek">0</span>)</span>
                        </a>
                    </li>
                    <li class="nav-item @yield('pengeluaran_blm')">
                        <a href="{{ route('pengeluaran_blm') }}"
                            class="nav-link @if (Request::url() == route('pengeluaran_blm')) active @endif">
                            <i class="bi bi-file-earmark-text-fill custom-icon"></i>
                            <p>
                                Pengeluaran
                            </p>
                            <span class="badge-br badge-info" id="permintaan-badge">Blm dicek (<span
                                    id="pengeluaran-belum-dicek">0</span>)</span>
                        </a>
                    </li>

                    <li class="nav-item @yield('pemasukan_sdh')">
                        <a href="{{ route('pemasukan_sdh') }}"
                            class="nav-link @if (Request::url() == route('pemasukan_sdh')) active @endif">
                            <i class="bi bi-cart-fill custom-icon"></i>
                            <p>
                                Pemasukan &nbsp;
                            </p>
                            <span class="badge-br2 badge-info" id="permintaan-badge">Sdh dicek (<span
                                    id="jumlah-sudah-dicek">0</span>)</span>
                        </a>
                    </li>
                    <li class="nav-item @yield('pengeluaran_sdh')">
                        <a href="{{ route('pengeluaran_sdh') }}"
                            class="nav-link @if (Request::url() == route('pengeluaran_sdh')) active @endif">
                            <i class="bi bi-file-earmark-text-fill custom-icon"></i>
                            <p>
                                Pengeluaran
                            </p>
                            <span class="badge-br2 badge-info" id="permintaan-badge">Sdh dicek (<span
                                    id="pengeluaran-sudah-dicek">0</span>)</span>
                        </a>
                    </li>
                @elseif($kasir)
                    <li class="nav-header font-weight-bolder mt-1">Data Laporan</li>
                    <li class="nav-item @yield('pemasukan_blm')">
                        <a href="{{ route('pemasukan_blm') }}"
                            class="nav-link @if (Request::url() == route('pemasukan_blm')) active @endif">
                            <i class="bi bi-cart-fill custom-icon"></i>
                            <p>
                                Pemasukan &nbsp;
                            </p>
                            <span class="badge-br badge-info" id="permintaan-badge">Blm dicek (<span
                                    id="jumlah-belum-dicek">0</span>)</span>
                        </a>
                    </li>
                    <li class="nav-item @yield('pengeluaran_blm')">
                        <a href="{{ route('pengeluaran_blm') }}"
                            class="nav-link @if (Request::url() == route('pengeluaran_blm')) active @endif">
                            <i class="bi bi-file-earmark-text-fill custom-icon"></i>
                            <p>
                                Pengeluaran
                            </p>
                            <span class="badge-br badge-info" id="permintaan-badge">Blm dicek (<span
                                    id="pengeluaran-belum-dicek">0</span>)</span>
                        </a>
                    </li>
                @elseif ($manajer)
                    <li class="nav-header font-weight-bolder mt-1">Data Laporan</li>
                    <li class="nav-item @yield('pemasukan_blm')">
                        <a href="{{ route('pemasukan_blm') }}"
                            class="nav-link @if (Request::url() == route('pemasukan_blm')) active @endif">
                            <i class="bi bi-cart-fill custom-icon"></i>
                            <p>
                                Pemasukan &nbsp;
                            </p>
                            <span class="badge-br badge-info" id="permintaan-badge">Blm dicek (<span
                                    id="jumlah-belum-dicek">0</span>)</span>
                        </a>
                    </li>
                    <li class="nav-item @yield('pengeluaran_blm')">
                        <a href="{{ route('pengeluaran_blm') }}"
                            class="nav-link @if (Request::url() == route('pengeluaran_blm')) active @endif">
                            <i class="bi bi-file-earmark-text-fill custom-icon"></i>
                            <p>
                                Pengeluaran
                            </p>
                            <span class="badge-br badge-info" id="permintaan-badge">Blm dicek (<span
                                    id="pengeluaran-belum-dicek">0</span>)</span>
                        </a>
                    </li>

                    <li class="nav-item @yield('pemasukan_sdh')">
                        <a href="{{ route('pemasukan_sdh') }}"
                            class="nav-link @if (Request::url() == route('pemasukan_sdh')) active @endif">
                            <i class="bi bi-cart-fill custom-icon"></i>
                            <p>
                                Pemasukan &nbsp;
                            </p>
                            <span class="badge-br2 badge-info" id="permintaan-badge">Sdh dicek (<span
                                    id="jumlah-sudah-dicek">0</span>)</span>
                        </a>
                    </li>
                    <li class="nav-item @yield('pengeluaran_sdh')">
                        <a href="{{ route('pengeluaran_sdh') }}"
                            class="nav-link @if (Request::url() == route('pengeluaran_sdh')) active @endif">
                            <i class="bi bi-file-earmark-text-fill custom-icon"></i>
                            <p>
                                Pengeluaran
                            </p>
                            <span class="badge-br2 badge-info" id="permintaan-badge">Sdh dicek (<span
                                    id="pengeluaran-sudah-dicek">0</span>)</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
