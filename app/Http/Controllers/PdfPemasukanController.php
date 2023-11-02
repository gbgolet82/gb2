<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Usaha;
use App\Models\Laporan;
use Illuminate\Http\Request;
use App\Models\KlasifikasiLaporan;

class PdfPemasukanController extends Controller
{
    public function index(Request $request)
    {

        // buat ambil rute yang aktif
        $pemasukanBelumActive = true;
        $pemasukanSudahAktif = '';
        // ambil id klasifikasi
        if ($pemasukanBelumActive) {
            $idKlasifikasiPemasukan = KlasifikasiLaporan::where('klasifikasi_laporan', 'Pemasukan')
                ->value('id_klasifikasi');
            session(['idKlasifikasiPemasukan' => $idKlasifikasiPemasukan]);
        }

        // ambil opsi akun
        $akunOptions = Akun::join('usaha', 'usaha.id_usaha', '=', 'akun.id_usaha')
            ->join('klasifikasi_laporan', 'klasifikasi_laporan.id_klasifikasi', '=', 'akun.id_klasifikasi')
            ->where('akun.id_usaha', session('id_usaha'))
            ->where('klasifikasi_laporan', 'Pemasukan')
            ->select('id_akun', 'akun')
            ->orderBy('akun', 'asc')
            ->get();

        $usahaOption = Usaha::select('id_usaha', 'nama_usaha')
            ->where('nama_usaha', '!=', 'SEMUA') // Exclude "SEMUA" option
            ->orderBy('nama_usaha', 'asc')
            ->get();

        // dd($usahaOption);

        $date = date('Ymd');
        $nomorTerakhir = Laporan::max('kode_laporan');
        if ($nomorTerakhir) {
            $nomorBaru = (int)substr($nomorTerakhir, -3) + 1;
        } else {
            $nomorBaru = 1;
        }

        $session = session('nama_usaha');
        // dd($session);

        $kodeLaporan = 'P' . $date . str_pad($nomorBaru, 3, '0', STR_PAD_LEFT);
        // dd($kodeLaporan);
        $idKaryawan = session('id_karyawan');

        $data = Laporan::select(
            'klasifikasi_laporan.klasifikasi_laporan as klasifikasi',
            'usaha.nama_usaha as usaha',
            'akun.akun as akun',
            'sub_akun_1.sub_akun_1 as sub_akun_1',
            'sub_akun_2.sub_akun_2 as sub_akun_2',
            'sub_akun_3.sub_akun_3 as sub_akun_3',
            'laporan.kode_laporan as kode_laporan',
            'laporan.tanggal_laporan as tanggal_laporan',
            'laporan.nominal as nominal',
            'laporan.gambar_bukti as gambar_bukti',
            'laporan.status_cek as status_cek',
            'laporan.id_laporan as id_laporan',
            'laporan.catatan as catatan',
            'laporan.tanggal_cek as tanggal_cek',
            'kasir.nama as nama_kasir',
            'manager.nama as nama_manager',

            // DB::raw('(SELECT karyawan.nama FROM karyawan WHERE karyawan.kasir = "1" AND karyawan.id_usaha = usaha.id_usaha) AS nama_kasir'),
            // DB::raw('(SELECT karyawan.nama FROM karyawan WHERE karyawan.manajer = "1" AND karyawan.id_usaha = usaha.id_usaha LIMIT 1) AS nama_manajer')
        )
            ->join('akun', 'akun.id_akun', '=', 'laporan.id_akun')
            ->join('karyawan as kasir', 'laporan.id_kasir', '=', 'kasir.id_karyawan')
            ->leftjoin('karyawan as manager', 'laporan.id_manager', '=', 'manager.id_karyawan')
            ->join('klasifikasi_laporan', 'akun.id_klasifikasi', '=', 'klasifikasi_laporan.id_klasifikasi')
            ->join('usaha', 'laporan.id_usaha', '=', 'usaha.id_usaha')
            ->leftjoin('sub_akun_1', 'laporan.id_sub_akun_1', '=', 'sub_akun_1.id_sub_akun_1')
            ->leftjoin('sub_akun_2', 'laporan.id_sub_akun_2', '=', 'sub_akun_2.id_sub_akun_2')
            ->leftjoin('sub_akun_3', 'laporan.id_sub_akun_3', '=', 'sub_akun_3.id_sub_akun_3')
            ->where('laporan.status_cek', 'Belum Dicek')
            ->where('klasifikasi_laporan', 'Pemasukan')
            ->orderBy('laporan.tanggal_laporan', 'desc');

        if ($session != 'SEMUA') {
            $data->where('usaha.id_usaha', session('id_usaha'));
        }
        $status_cek = 'Belum Dicek';
        $data = $data->get();
        $active_page = "PEMASUKAN";
        return view('contents.pemasukan', compact('status_cek', 'active_page', 'data', 'akunOptions', 'kodeLaporan', 'pemasukanBelumActive', 'pemasukanSudahAktif', 'usahaOption'));
    }

    public function pemasukan(Request $request)
    {
        // buat ambil rute yang aktif
        $pemasukanBelumActive = '';
        $pemasukanSudahAktif = true;
        // dd($isPemasukanActive);

        // ambil opsi akun
        $akunOptions = Akun::join('usaha', 'usaha.id_usaha', '=', 'akun.id_usaha')
            ->join('klasifikasi_laporan', 'klasifikasi_laporan.id_klasifikasi', '=', 'akun.id_klasifikasi')
            ->where('akun.id_usaha', session('id_usaha'))
            ->where('klasifikasi_laporan', 'Pemasukan')
            ->select('id_akun', 'akun')
            ->orderBy('akun', 'asc')
            ->get();

        $usahaOption = Usaha::select('id_usaha', 'nama_usaha')
            ->where('nama_usaha', '!=', 'SEMUA') // Exclude "SEMUA" option
            ->orderBy('nama_usaha', 'asc')
            ->get();

        $session = session('nama_usaha');
        $idKaryawan = session('id_karyawan');

        $data = Laporan::select(
            'klasifikasi_laporan.klasifikasi_laporan as klasifikasi',
            'usaha.nama_usaha as usaha',
            'akun.akun as akun',
            'sub_akun_1.sub_akun_1 as sub_akun_1',
            'sub_akun_2.sub_akun_2 as sub_akun_2',
            'sub_akun_3.sub_akun_3 as sub_akun_3',
            'laporan.kode_laporan as kode_laporan',
            'laporan.tanggal_laporan as tanggal_laporan',
            'laporan.nominal as nominal',
            'laporan.gambar_bukti as gambar_bukti',
            'laporan.status_cek as status_cek',
            'laporan.id_laporan as id_laporan',
            'laporan.catatan as catatan',
            'laporan.tanggal_cek as tanggal_cek',
            'laporan.status_cek as status_cek',
            'kasir.nama as nama_kasir',
            'manager.nama as nama_manager',
        )
            ->join('akun', 'akun.id_akun', '=', 'laporan.id_akun')
            ->join('karyawan as kasir', 'laporan.id_kasir', '=', 'kasir.id_karyawan')
            ->leftjoin('karyawan as manager', 'laporan.id_manager', '=', 'manager.id_karyawan')
            ->join('klasifikasi_laporan', 'laporan.id_klasifikasi', '=', 'klasifikasi_laporan.id_klasifikasi')
            ->join('usaha', 'laporan.id_usaha', '=', 'usaha.id_usaha')
            ->join('sub_akun_1', 'laporan.id_sub_akun_1', '=', 'sub_akun_1.id_sub_akun_1')
            ->leftjoin('sub_akun_2', 'laporan.id_sub_akun_2', '=', 'sub_akun_2.id_sub_akun_2')
            ->leftjoin('sub_akun_3', 'laporan.id_sub_akun_3', '=', 'sub_akun_3.id_sub_akun_3')
            ->where('laporan.status_cek', 'Sudah Dicek')
            ->orderBy('laporan.tanggal_laporan', 'desc');

        if ($session != 'SEMUA') {
            $data->where('usaha.id_usaha', session('id_usaha'));
        }
        $status_cek = 'Sudah Dicek';
        $data = $data->get();
        $active_page = "PEMASUKAN";
        return view('contents.pemasukan', compact('status_cek', 'active_page', 'data', 'pemasukanSudahAktif', 'akunOptions', 'pemasukanBelumActive', 'usahaOption'));
    }
}
