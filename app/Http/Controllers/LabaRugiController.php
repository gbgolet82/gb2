<?php

namespace App\Http\Controllers;

use App\Models\Usaha;
use App\Models\Laporan;
use Illuminate\Http\Request;

class LabaRugiController extends Controller
{
    public function laba_rugi(Request $request)
    {

        $active_page = 'Laba Rugi';
        $usahaOption = Usaha::select('id_usaha', 'nama_usaha')
            ->where('nama_usaha', '!=', 'SEMUA') // Exclude "SEMUA" option
            ->orderBy('nama_usaha', 'asc')
            ->get();

        $tahun_get = Laporan::distinct()
            ->selectRaw('YEAR(tanggal_laporan) as tahun')
            ->orderBy('tahun', 'asc') // Menggunakan orderBy bukan orderby
            ->get();


        $bulan = '';
        $tahun = '';
        $usaha = '';

        $max_pemasukan_harian = '';
        $max_keuntungan_harian = '';
        $min_pemasukan_harian = '';
        $min_keuntungan_harian = '';

        $max_keuntungan_tahunan = "";
        $max_pemasukan_tahunan = "";

        $min_keuntungan_tahunan = "";
        $min_pemasukan_tahunan = "";


        $tgl_max_keuntungan = null;
        $tgl_max_pemasukan = null;
        $tgl_min_keuntungan = null;
        $tgl_min_pemasukan = null;

        if (($bulan == null && $tahun == null) || ($bulan && $tahun == null)) {
            $nominal_tahun_pemasukan = [];
            $nominal_tahun_pengeluaran = [];
            $nominal_tahun_keuntungan = [];


            foreach ($tahun_get as $tahuns) {
                // echo $tahuns->tahun . "<br>";
                $nominal_pemasukan_tahunan = Laporan::join('klasifikasi_laporan', 'laporan.id_klasifikasi', '=', 'klasifikasi_laporan.id_klasifikasi')
                    ->where('laporan.status_cek', 'Sudah Dicek')
                    ->where('klasifikasi_laporan', 'Pemasukan')
                    ->when($usaha, function ($query) use ($usaha) {
                        return $query->where('id_usaha', $usaha);
                    })
                    ->whereYear('tanggal_laporan', $tahuns->tahun)
                    ->sum('nominal');

                $nominal_pengeluaran_tahunan = Laporan::join('klasifikasi_laporan', 'laporan.id_klasifikasi', '=', 'klasifikasi_laporan.id_klasifikasi')
                    ->where('laporan.status_cek', 'Sudah Dicek')
                    ->where('klasifikasi_laporan', '!=', 'Pemasukan')
                    ->when($usaha, function ($query) use ($usaha) {
                        return $query->where('id_usaha', $usaha);
                    })
                    ->whereYear('tanggal_laporan', $tahuns->tahun)
                    ->sum('nominal');

                // Menghitung keuntungan dengan mengurangkan pemasukan dan pengeluaran
                $keuntungan_tahunan = $nominal_pemasukan_tahunan - $nominal_pengeluaran_tahunan;

                $nominal_tahun_pemasukan[] = $nominal_pemasukan_tahunan;
                $nominal_tahun_pengeluaran[] = $nominal_pengeluaran_tahunan;
                $nominal_tahun_keuntungan[] = $keuntungan_tahunan;


                $max_keuntungan_tahunan = max($nominal_tahun_keuntungan);
                $max_pemasukan_tahunan = max($nominal_tahun_pemasukan);

                $min_keuntungan_tahunan = min($nominal_tahun_keuntungan);
                $min_pemasukan_tahunan = min($nominal_tahun_pemasukan);

                // Mencari indeks elemen dengan nilai maksimum keuntungan dan maksimum pemasukan
                $index_max_keuntungan = array_search($max_keuntungan_tahunan, $nominal_tahun_keuntungan);
                $index_max_pemasukan = array_search($max_pemasukan_tahunan, $nominal_tahun_pemasukan);

                // Mendapatkan tahun yang sesuai dengan indeks
                $tahun_max_keuntungan = $tahun_get[$index_max_keuntungan]->tahun;
                $tahun_max_pemasukan = $tahun_get[$index_max_pemasukan]->tahun;

                // Lakukan hal yang sama untuk nilai minimum jika diperlukan
                $index_min_keuntungan = array_search($min_keuntungan_tahunan, $nominal_tahun_keuntungan);
                $index_min_pemasukan = array_search($min_pemasukan_tahunan, $nominal_tahun_pemasukan);

                $tahun_min_keuntungan = $tahun_get[$index_min_keuntungan]->tahun;
                $tahun_min_pemasukan = $tahun_get[$index_min_pemasukan]->tahun;
            }
        }

        // Menghitung keuntungan dengan mengurangkan pemasukan dan pengeluaran

        return view('contents.laba_rugi', compact(
            'active_page',
            'usahaOption',
            'tahun',
            'tahun_get',
            'bulan',
            'usaha',
            'nominal_tahun_pemasukan',
            'nominal_tahun_pengeluaran',
            'nominal_tahun_keuntungan',
            'max_pemasukan_harian',
            'max_keuntungan_harian',
            'min_pemasukan_harian',
            'min_keuntungan_harian',
            'max_keuntungan_tahunan',
            'max_pemasukan_tahunan',
            'min_keuntungan_tahunan',
            'min_pemasukan_tahunan',
            'tahun_max_keuntungan',
            'tahun_max_pemasukan',
            'tahun_min_keuntungan',
            'tahun_min_pemasukan',
            'tgl_max_keuntungan',
            'tgl_max_pemasukan',
            'tgl_min_keuntungan',
            'tgl_min_pemasukan',

        ));
    }

    public function filter_laba_rugi(Request $request)
    {

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $usaha = $request->usaha;
        // dd($bulan);


        // Mengambil tanggal dari input request
        $tanggal = $request->filter_daterange;


        $active_page = 'Laba Rugi';
        $usahaOption = Usaha::select('id_usaha', 'nama_usaha')
            ->where('nama_usaha', '!=', 'SEMUA') // Exclude "SEMUA" option
            ->orderBy('nama_usaha', 'asc')
            ->get();

        $tahun_get = Laporan::distinct()
            ->selectRaw('YEAR(tanggal_laporan) as tahun')
            ->orderBy('tahun', 'asc') // Menggunakan orderBy bukan orderby
            ->get();



        $nominal_harian_pemasukan = [];
        $nominal_harian_pengeluaran = [];
        $nominal_harian_keuntungan = [];
        $max_pemasukan_harian = '';
        $max_keuntungan_harian = '';
        $min_pemasukan_harian = '';
        $min_keuntungan_harian = '';
        $tgl_max_keuntungan = null;
        $tgl_max_pemasukan = null;
        $tgl_min_keuntungan = null;
        $tgl_min_pemasukan = null;

        if ($bulan && $tahun) {
            for ($tgl = 1; $tgl <= 31; $tgl++) {
                $nominal_pemasukan_harian = Laporan::join('klasifikasi_laporan', 'laporan.id_klasifikasi', '=', 'klasifikasi_laporan.id_klasifikasi')
                    ->where('laporan.status_cek', 'Sudah Dicek')
                    ->where('klasifikasi_laporan', 'Pemasukan')
                    ->whereMonth('tanggal_laporan', $bulan)
                    ->whereYear('tanggal_laporan', $tahun)
                    ->whereDay('tanggal_laporan', str_pad($tgl, 2, '0', STR_PAD_LEFT))
                    ->when($usaha, function ($query) use ($usaha) {
                        return $query->where('id_usaha', $usaha);
                    })
                    ->sum('nominal');

                $nominal_pengeluaran_harian = Laporan::join('klasifikasi_laporan', 'laporan.id_klasifikasi', '=', 'klasifikasi_laporan.id_klasifikasi')
                    ->where('laporan.status_cek', 'Sudah Dicek')
                    ->where('klasifikasi_laporan', '!=', 'Pemasukan')
                    ->whereMonth('tanggal_laporan', $bulan)
                    ->whereYear('tanggal_laporan', $tahun)
                    ->whereDay('tanggal_laporan', str_pad($tgl, 2, '0', STR_PAD_LEFT))
                    ->when($usaha, function ($query) use ($usaha) {
                        return $query->where('id_usaha', $usaha);
                    })
                    ->sum('nominal');

                // dd($max_pemasukan_harian);
                // Menghitung keuntungan dengan mengurangkan pemasukan dan pengeluaran
                $keuntungan_harian = $nominal_pemasukan_harian - $nominal_pengeluaran_harian;

                $nominal_harian_pemasukan[] = $nominal_pemasukan_harian;
                $nominal_harian_pengeluaran[] = $nominal_pengeluaran_harian;
                $nominal_harian_keuntungan[] = $keuntungan_harian;

                $max_keuntungan_harian = max($nominal_harian_keuntungan);
                $min_keuntungan_harian = min($nominal_harian_keuntungan);
                $max_pemasukan_harian = max($nominal_harian_pemasukan);
                $min_pemasukan_harian = min($nominal_harian_pemasukan);

                if ($keuntungan_harian >= $max_keuntungan_harian) {
                    $max_keuntungan_harian = $keuntungan_harian;
                    $tgl_max_keuntungan = $tgl;
                }

                if ($keuntungan_harian <= $min_keuntungan_harian) {
                    $min_keuntungan_harian = $keuntungan_harian;
                    $tgl_min_keuntungan = $tgl;
                }

                if ($nominal_pemasukan_harian >= $max_pemasukan_harian) {
                    $max_pemasukan_harian = $nominal_pemasukan_harian;
                    $tgl_max_pemasukan = $tgl;
                }

                if ($nominal_pemasukan_harian <= $min_pemasukan_harian) {
                    $min_pemasukan_harian = $nominal_pemasukan_harian;
                    $tgl_min_pemasukan = $tgl;
                }

               
            }
            // dd($tgl_max_keuntungan);
        }


        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $usaha = $request->usaha;

        $nominal_bulan_pemasukan = [];
        $nominal_bulan_pengeluaran = [];
        $nominal_bulan_keuntungan = [];
        if ($bulan == null && $tahun) {

            for ($bulans = 1; $bulans <= 12; $bulans++) {
                $nominal_pemasukan_bulanan = Laporan::join('klasifikasi_laporan', 'laporan.id_klasifikasi', '=', 'klasifikasi_laporan.id_klasifikasi')
                    ->where('laporan.status_cek', 'Sudah Dicek')
                    ->where('klasifikasi_laporan', 'Pemasukan')
                    ->whereMonth('tanggal_laporan', str_pad($bulans, 2, '0', STR_PAD_LEFT))
                    ->whereYear('tanggal_laporan', $tahun)
                    ->when($usaha, function ($query) use ($usaha) {
                        return $query->where('id_usaha', $usaha);
                    })
                    ->sum('nominal');

                $nominal_pengeluaran_bulanan = Laporan::join('klasifikasi_laporan', 'laporan.id_klasifikasi', '=', 'klasifikasi_laporan.id_klasifikasi')
                    ->where('laporan.status_cek', 'Sudah Dicek')
                    ->where('klasifikasi_laporan', '!=', 'Pemasukan')
                    ->whereMonth('tanggal_laporan', str_pad($bulans, 2, '0', STR_PAD_LEFT))
                    ->whereYear('tanggal_laporan', $tahun)
                    ->when($usaha, function ($query) use ($usaha) {
                        return $query->where('id_usaha', $usaha);
                    })
                    ->sum('nominal');

                // Menghitung keuntungan dengan mengurangkan pemasukan dan pengeluaran
                $keuntungan_bulanan = $nominal_pemasukan_bulanan - $nominal_pengeluaran_bulanan;

                $nominal_bulan_pemasukan[] = $nominal_pemasukan_bulanan;
                $nominal_bulan_pengeluaran[] = $nominal_pengeluaran_bulanan;
                $nominal_bulan_keuntungan[] = $keuntungan_bulanan;
            }
        }


        $nominal_tahun_pemasukan = [];
        $nominal_tahun_pengeluaran = [];
        $nominal_tahun_keuntungan = [];

        $max_keuntungan_tahunan = "";
        $max_pemasukan_tahunan = "";

        $min_keuntungan_tahunan = "";
        $min_pemasukan_tahunan = "";

        $tahun_max_keuntungan = "";
        $tahun_max_pemasukan = "";
        $tahun_min_keuntungan = "";
        $tahun_min_pemasukan = "";


        if ($bulan == null && $tahun == null || $bulan && $tahun == null) {

            foreach ($tahun_get as $tahuns) {
                $nominal_pemasukan_tahunan = Laporan::join('klasifikasi_laporan', 'laporan.id_klasifikasi', '=', 'klasifikasi_laporan.id_klasifikasi')
                    ->where('laporan.status_cek', 'Sudah Dicek')
                    ->where('klasifikasi_laporan', 'Pemasukan')
                    ->when($usaha, function ($query) use ($usaha) {
                        return $query->where('id_usaha', $usaha);
                    })
                    ->whereYear('tanggal_laporan', $tahuns->tahun)
                    ->sum('nominal');

                $nominal_pengeluaran_tahunan = Laporan::join('klasifikasi_laporan', 'laporan.id_klasifikasi', '=', 'klasifikasi_laporan.id_klasifikasi')
                    ->where('laporan.status_cek', 'Sudah Dicek')
                    ->where('klasifikasi_laporan', '!=', 'Pemasukan')
                    ->when($usaha, function ($query) use ($usaha) {
                        return $query->where('id_usaha', $usaha);
                    })
                    ->whereYear('tanggal_laporan', $tahuns->tahun)
                    ->sum('nominal');

                // Menghitung keuntungan dengan mengurangkan pemasukan dan pengeluaran
                $keuntungan_tahunan = $nominal_pemasukan_tahunan - $nominal_pengeluaran_tahunan;

                $nominal_tahun_pemasukan[] = $nominal_pemasukan_tahunan;
                $nominal_tahun_pengeluaran[] = $nominal_pengeluaran_tahunan;
                $nominal_tahun_keuntungan[] = $keuntungan_tahunan;

                $max_keuntungan_tahunan = max($nominal_tahun_keuntungan);
                $max_pemasukan_tahunan = max($nominal_tahun_pemasukan);

                $min_keuntungan_tahunan = min($nominal_tahun_keuntungan);
                $min_pemasukan_tahunan = min($nominal_tahun_pemasukan);

                // Mencari indeks elemen dengan nilai maksimum keuntungan dan maksimum pemasukan
                $index_max_keuntungan = array_search($max_keuntungan_tahunan, $nominal_tahun_keuntungan);
                $index_max_pemasukan = array_search($max_pemasukan_tahunan, $nominal_tahun_pemasukan);

                // Mendapatkan tahun yang sesuai dengan indeks
                $tahun_max_keuntungan = $tahun_get[$index_max_keuntungan]->tahun;
                $tahun_max_pemasukan = $tahun_get[$index_max_pemasukan]->tahun;

                // Lakukan hal yang sama untuk nilai minimum jika diperlukan
                $index_min_keuntungan = array_search($min_keuntungan_tahunan, $nominal_tahun_keuntungan);
                $index_min_pemasukan = array_search($min_pemasukan_tahunan, $nominal_tahun_pemasukan);

                $tahun_min_keuntungan = $tahun_get[$index_min_keuntungan]->tahun;
                $tahun_min_pemasukan = $tahun_get[$index_min_pemasukan]->tahun;
            }

            // dd($nominal_tahun_keuntungan);
        }
        // dd($keuntungan_tahunan );

        // dd($nominal_pemasukan_tahunan);




        return view('contents.laba_rugi', compact(
            'active_page',
            'usahaOption',
            'tahun',
            'tahun_get',
            'bulan',
            'usaha',
            'nominal_harian_pemasukan',
            'nominal_harian_pengeluaran',
            'nominal_harian_keuntungan',
            'nominal_bulan_pemasukan',
            'nominal_bulan_pengeluaran',
            'nominal_bulan_keuntungan',
            'nominal_tahun_pemasukan',
            'nominal_tahun_pengeluaran',
            'nominal_tahun_keuntungan',
            'max_pemasukan_harian',
            'max_keuntungan_harian',
            'min_pemasukan_harian',
            'min_keuntungan_harian',
            'max_keuntungan_tahunan',
            'max_pemasukan_tahunan',
            'min_keuntungan_tahunan',
            'min_pemasukan_tahunan',
            'tahun_max_keuntungan',
            'tahun_max_pemasukan',
            'tahun_min_keuntungan',
            'tahun_min_pemasukan',
            'tgl_max_keuntungan',
            'tgl_max_pemasukan',
            'tgl_min_keuntungan',
            'tgl_min_pemasukan',

        ));
    }
}
