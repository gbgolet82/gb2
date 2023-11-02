<?php

namespace App\Http\Controllers;

use App\Models\Usaha;
use App\Models\Laporan;
use Illuminate\Http\Request;
use App\Models\KlasifikasiLaporan;

class PdfPengeluaranController extends Controller
{
    public function index(Request $request)
    {
        // buat ambil rute yang aktif
        $pengeluaranBelumActive = true;
        $pengeluaranSudahAktif = '';

        $klasifikasiOptions = KlasifikasiLaporan::where('klasifikasi_laporan', '!=', 'Pemasukan')
            ->select('klasifikasi_laporan', 'id_klasifikasi')
            ->orderBy('klasifikasi_laporan', 'asc')
            ->get();

        $usahaOption = Usaha::select('id_usaha', 'nama_usaha')
            ->where('nama_usaha', '!=', 'SEMUA') // Exclude "SEMUA" option
            ->orderBy('nama_usaha', 'asc')
            ->get();

        $date = date('Ymd');
        // kode OP
        $nomorTerakhir = Laporan::join('klasifikasi_laporan', 'klasifikasi_laporan.id_klasifikasi', '=', 'laporan.id_klasifikasi')
            ->where('klasifikasi_laporan', 'Pengeluaran OP')
            ->max('kode_laporan');

        if ($nomorTerakhir) {
            $nomorBaru = (int)substr($nomorTerakhir, -3) + 1;
        } else {
            $nomorBaru = 1;
        }
        $kodeOP = 'OP' . $date . str_pad($nomorBaru, 3, '0', STR_PAD_LEFT);
        // kode NOP
        $nomorTerakhir = Laporan::join('klasifikasi_laporan', 'klasifikasi_laporan.id_klasifikasi', '=', 'laporan.id_klasifikasi')
            ->where('klasifikasi_laporan', 'Pengeluaran NOP')
            ->max('kode_laporan');

        if ($nomorTerakhir) {
            $nomorBaru = (int)substr($nomorTerakhir, -3) + 1;
        } else {
            $nomorBaru = 1;
        }
        $kodeNOP = 'NOP' . $date . str_pad($nomorBaru, 3, '0', STR_PAD_LEFT);
        // dd($kodeOP);


        $session = session('nama_usaha');
        // dd($session);

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
            'laporan.status_cek as status_cek',
            'kasir.nama as nama_kasir',
            'manager.nama as nama_manager',

        )
            ->join('akun', 'akun.id_akun', '=', 'laporan.id_akun')
            ->join('karyawan as kasir', 'laporan.id_kasir', '=', 'kasir.id_karyawan')
            ->leftjoin('karyawan as manager', 'laporan.id_manager', '=', 'manager.id_karyawan')
            ->join('klasifikasi_laporan', 'laporan.id_klasifikasi', '=', 'klasifikasi_laporan.id_klasifikasi')
            ->join('usaha', 'laporan.id_usaha', '=', 'usaha.id_usaha')
            ->leftjoin('sub_akun_1', 'laporan.id_sub_akun_1', '=', 'sub_akun_1.id_sub_akun_1')
            ->leftjoin('sub_akun_2', 'laporan.id_sub_akun_2', '=', 'sub_akun_2.id_sub_akun_2')
            ->leftjoin('sub_akun_3', 'laporan.id_sub_akun_3', '=', 'sub_akun_3.id_sub_akun_3')
            ->where('laporan.status_cek', 'Belum Dicek')
            ->where('klasifikasi_laporan', '!=', 'Pemasukan')
            ->orderBy('laporan.tanggal_laporan', 'desc');

        if ($session != 'SEMUA') {
            $data->where('usaha.id_usaha', session('id_usaha'));
        }

        $data = $data->get();
        // dd($data);
        $active_page = "PENGELUARAN";
        $status_cek = 'Belum Dicek';
        return view('contents.pengeluaran', compact('status_cek', 'active_page', 'data', 'pengeluaranBelumActive', 'pengeluaranSudahAktif', 'klasifikasiOptions', 'kodeOP', 'kodeNOP', 'usahaOption'));
    }

    public function pengeluaran(Request $request)
    {
 
        // buat ambil rute yang aktif
        // $pengeluaranBelumActive = $request->url() == route('pengeluaran_blm');
        // $pengeluaranSudahAktif = $request->url() == route('pengeluaran_sdh');

        $pengeluaranBelumActive = '';
        $pengeluaranSudahAktif = true;


        $klasifikasiOptions = KlasifikasiLaporan::where('klasifikasi_laporan', '!=', 'Pemasukan')
            ->select('klasifikasi_laporan', 'id_klasifikasi')
            ->orderBy('klasifikasi_laporan', 'asc')
            ->get();

        $usahaOption = Usaha::select('id_usaha', 'nama_usaha')
            ->where('nama_usaha', '!=', 'SEMUA') // Exclude "SEMUA" option
            ->orderBy('nama_usaha', 'asc')
            ->get();


        $session = session('nama_usaha');
        // dd($session);

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
            'laporan.status_cek as status_cek',
            'kasir.nama as nama_kasir',
            'manager.nama as nama_manager',

        )
            ->join('akun', 'akun.id_akun', '=', 'laporan.id_akun')
            ->join('karyawan as kasir', 'laporan.id_kasir', '=', 'kasir.id_karyawan')
            ->leftjoin('karyawan as manager', 'laporan.id_manager', '=', 'manager.id_karyawan')
            ->join('klasifikasi_laporan', 'laporan.id_klasifikasi', '=', 'klasifikasi_laporan.id_klasifikasi')
            ->join('usaha', 'laporan.id_usaha', '=', 'usaha.id_usaha')
            ->leftjoin('sub_akun_1', 'laporan.id_sub_akun_1', '=', 'sub_akun_1.id_sub_akun_1')
            ->leftjoin('sub_akun_2', 'laporan.id_sub_akun_2', '=', 'sub_akun_2.id_sub_akun_2')
            ->leftjoin('sub_akun_3', 'laporan.id_sub_akun_3', '=', 'sub_akun_3.id_sub_akun_3')
            ->where('laporan.status_cek', 'Sudah Dicek')
            ->where('klasifikasi_laporan', '!=', 'Pemasukan')
            ->orderBy('laporan.tanggal_laporan', 'desc');

        if ($session != 'SEMUA') {
            $data->where('usaha.id_usaha', session('id_usaha'));
        }

        $data = $data->get();
        // dd($data);
        $active_page = "PENGELUARAN";
        $status_cek = 'Sudah Dicek';
        return view('contents.pengeluaran', compact('status_cek', 'active_page', 'data', 'pengeluaranBelumActive', 'pengeluaranSudahAktif', 'klasifikasiOptions', 'usahaOption'));
    }
}
