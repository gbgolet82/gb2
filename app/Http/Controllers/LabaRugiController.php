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
            ->get();
            // dd($tahun);

        // $tanggalAwal = date('Y-m-d', strtotime(str_replace('/', '-', '-30 days')));
        // $tanggalAkhir = date('Y-m-d', strtotime(str_replace('/', '-', 'now')));
        // $bulanAwal = date('m', strtotime('-30 days'));
        // $bulanAkhir = date('m', strtotime('now'));
        // dd($bulanAwal . '|||' . $bulanAkhir);


        $bulan = '';
        $tahun = '';
        $usaha = '';

        if ($bulan == null && $tahun == null || $bulan && $tahun == null) {

            $nominal_pemasukan_tahunan = Laporan::join('klasifikasi_laporan', 'laporan.id_klasifikasi', '=', 'klasifikasi_laporan.id_klasifikasi')
                ->where('laporan.status_cek', 'Sudah Dicek')
                ->where('klasifikasi_laporan', 'Pemasukan')
                // ->whereYear('tanggal_laporan', $tahun)
                ->when($usaha, function ($query) use ($usaha) {
                    return $query->where('id_usaha', $usaha);
                })
                ->sum('nominal');

            $nominal_pengeluaran_tahunan = Laporan::join('klasifikasi_laporan', 'laporan.id_klasifikasi', '=', 'klasifikasi_laporan.id_klasifikasi')
                ->where('laporan.status_cek', 'Sudah Dicek')
                ->where('klasifikasi_laporan', '!=', 'Pemasukan')
                // ->whereYear('tanggal_laporan', $tahun)
                ->when($usaha, function ($query) use ($usaha) {
                    return $query->where('id_usaha', $usaha);
                })
                ->sum('nominal');

            // dd($nominal_pemasukan_tahunan);

            // Menghitung keuntungan dengan mengurangkan pemasukan dan pengeluaran
            $keuntungan_tahunan = $nominal_pemasukan_tahunan - $nominal_pengeluaran_tahunan;

            $nominal_tahun_pemasukan = $nominal_pemasukan_tahunan;
            $nominal_tahun_pengeluaran = $nominal_pengeluaran_tahunan;
            $nominal_tahun_keuntungan = $keuntungan_tahunan;

            $nominal_pemasukan_harian_max = '';
            $nominal_keuntungan_harian_max = '';
            $nominal_pemasukan_harian_min = '';
            $nominal_keuntungan_harian_min = '';
        }


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
            'nominal_pemasukan_harian_max',
            'nominal_keuntungan_harian_max',
            'nominal_pemasukan_harian_min',
            'nominal_keuntungan_harian_min',
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

        // Memisahkan tanggal menggunakan fungsi explode
        // $tanggalArray = explode(' - ', $tanggal);

        // Mengubah format tanggal menjadi "2023-11-05" untuk tanggal awal dan akhir
        // $tanggalAwal = date('Y-m-d', strtotime(str_replace('/', '-', $tanggalArray[0])));
        // $tanggalAkhir = date('Y-m-d', strtotime(str_replace('/', '-', $tanggalArray[1])));
        // $bulanAwal = date('m', strtotime($tanggalAwal));
        // $bulanAkhir = date('m', strtotime($tanggalAkhir));


        // dd($bulanAwal . '||' . $bulanAkhir);

        // dd($tanggalAwal . '|||'. $tanggalAkhir . '|||'. $request->usaha);




        $active_page = 'Laba Rugi';
        $usahaOption = Usaha::select('id_usaha', 'nama_usaha')
            ->where('nama_usaha', '!=', 'SEMUA') // Exclude "SEMUA" option
            ->orderBy('nama_usaha', 'asc')
            ->get();

        $tahun_get = Laporan::distinct()
            ->selectRaw('YEAR(tanggal_laporan) as tahun')
            ->get();



        $nominal_harian_pemasukan = [];
        $nominal_harian_pengeluaran = [];
        $nominal_harian_keuntungan = [];
        $nominal_pemasukan_harian_max = '';
        $nominal_keuntungan_harian_max = '';
        $nominal_pemasukan_harian_min = '';
        $nominal_keuntungan_harian_min = '';


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

                // dd($nominal_pemasukan_harian_max);
                // Menghitung keuntungan dengan mengurangkan pemasukan dan pengeluaran
                $keuntungan_harian = $nominal_pemasukan_harian - $nominal_pengeluaran_harian;

                $nominal_harian_pemasukan[] = $nominal_pemasukan_harian;
                $nominal_harian_pengeluaran[] = $nominal_pengeluaran_harian;
                $nominal_harian_keuntungan[] = $keuntungan_harian;

                $nominal_keuntungan_harian_max = max($nominal_harian_keuntungan);
                $nominal_keuntungan_harian_min = min($nominal_harian_keuntungan);
                $nominal_pemasukan_harian_max = max($nominal_harian_pemasukan);
                $nominal_pemasukan_harian_min = min($nominal_harian_pemasukan);
            }
        }


        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $usaha = $request->usaha;

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

        if (($tahun == null && $tahun == null) || ($tahun == null && $tahun != null)) {

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
            'nominal_pemasukan_harian_max',
            'nominal_keuntungan_harian_max',
            'nominal_pemasukan_harian_min',
            'nominal_keuntungan_harian_min',

        ));
    }
}
