<?php

namespace App\Http\Controllers;

use App\Models\Usaha;
use App\Models\Laporan;
use Illuminate\Http\Request;

class LabaRugiController extends Controller
{
    public function laba_rugi(Request $request)
    {
        // dd($request->all());
        $active_page = 'Laba Rugi';
        $usahaOption = Usaha::select('id_usaha', 'nama_usaha')
            ->where('nama_usaha', '!=', 'SEMUA') // Exclude "SEMUA" option
            ->orderBy('nama_usaha', 'asc')
            ->get();

        $tahun_get = Laporan::distinct()
            ->selectRaw('YEAR(tanggal_laporan) as tahun')
            ->get();
            // dd($tahun_get);

        // $tanggalAwal = date('Y-m-d', strtotime(str_replace('/', '-', '-30 days')));
        // $tanggalAkhir = date('Y-m-d', strtotime(str_replace('/', '-', 'now')));
        // $bulanAwal = date('m', strtotime('-30 days'));
        // $bulanAkhir = date('m', strtotime('now'));
        // dd($bulanAwal . '|||' . $bulanAkhir);
        $pemasukan = '';
        $pengeluaran = '';
        $keuntungan = '';

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $usaha = $request->usaha;
        // dd($bulan);
        


        return view('contents.laba_rugi', compact('active_page', 'usahaOption',  'pemasukan', 'pengeluaran', 'keuntungan', 'tahun','tahun_get', 'bulan', 'usaha'));
    }

    public function filter_laba_rugi(Request $request)
    {

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


        $pemasukan = '';
        $pengeluaran = '';
        $keuntungan = '';


        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $usaha = $request->usaha;
        // dd($bulan);
        // dd($tahun);

        return view('contents.laba_rugi', compact('active_page', 'usahaOption', 'pemasukan', 'pengeluaran', 'keuntungan', 'tahun','tahun_get', 'bulan', 'usaha'));
    }
}
