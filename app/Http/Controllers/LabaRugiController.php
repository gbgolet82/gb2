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
        $pemasukan = '';
        $pengeluaran = '';
        $keuntungan = '';

        $bulan = '';
        $tahun = '';
        $usaha = '';


        return view('contents.laba_rugi', compact('active_page', 'usahaOption',  'pemasukan', 'pengeluaran', 'keuntungan', 'tahun', 'tahun_get', 'bulan', 'usaha'));
    }

    public function filter_laba_rugi(Request $request)
    {

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $usaha = $request->usaha;

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



        $pengeluaran = '';
        $keuntungan = '';
        $pemasukan = '';


        $nominal_harian_pemasukan = [];
        $nominal_harian_pengeluaran = [];
        $nominal_harian_keuntungan = [];

        for ($tgl = 1; $tgl <= 31; $tgl++) {
            $nominal_pemasukan = Laporan::join('klasifikasi_laporan', 'laporan.id_klasifikasi', '=', 'klasifikasi_laporan.id_klasifikasi')
                ->where('laporan.status_cek', 'Sudah Dicek')
                ->where('klasifikasi_laporan', 'Pemasukan')
                ->whereMonth('tanggal_laporan', $bulan)
                ->whereYear('tanggal_laporan', $tahun)
                ->whereDay('tanggal_laporan', str_pad($tgl, 2, '0', STR_PAD_LEFT))
                ->sum('nominal');

            $nominal_pengeluaran = Laporan::join('klasifikasi_laporan', 'laporan.id_klasifikasi', '=', 'klasifikasi_laporan.id_klasifikasi')
                ->where('laporan.status_cek', 'Sudah Dicek')
                ->where('klasifikasi_laporan','!=', 'Pemasukan')
                ->whereMonth('tanggal_laporan', $bulan)
                ->whereYear('tanggal_laporan', $tahun)
                ->whereDay('tanggal_laporan', str_pad($tgl, 2, '0', STR_PAD_LEFT))
                ->sum('nominal');

            // Menghitung keuntungan dengan mengurangkan pemasukan dan pengeluaran
            $keuntungan = $nominal_pemasukan - $nominal_pengeluaran;

            $nominal_harian_pemasukan[] = $nominal_pemasukan;
            $nominal_harian_pengeluaran[] = $nominal_pengeluaran;
            $nominal_harian_keuntungan[] = $keuntungan;
        }


        // dd($nominal_harian[2]);


        return view('contents.laba_rugi', compact(
            'active_page',
            'usahaOption',
            'pemasukan',
            'pengeluaran',
            'keuntungan',
            'tahun',
            'tahun_get',
            'bulan',
            'usaha',
            'nominal_harian_pemasukan',
            'nominal_harian_pengeluaran',
            'nominal_harian_keuntungan'

        ));
    }
}
