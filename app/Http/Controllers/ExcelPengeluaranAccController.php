<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Karyawan;
use App\Models\KlasifikasiLaporan;
use App\Models\Usaha;
use App\Models\SubAkun1;
use App\Models\SubAkun2;
use App\Models\SubAkun3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExcelPengeluaranAccController extends Controller
{
    public function exportData(Request $request)
    {
        // Mendapatkan nilai filter lainnya
        $filterBulan = $request->input('filter_bulan');
        $filterTahun = $request->input('filter_tahun');
        $klasifikasi = $request->input('klasifikasi');
        $usaha = $request->input('usaha');
        $akun = $request->input('akun');
        $subAkun1 = $request->input('sub_akun_1');

        $klasifikasiId = KlasifikasiLaporan::where('klasifikasi_laporan', $usaha)->value('id_klasifikasi');
        $usahaId = Usaha::where('nama_usaha', $usaha)->value('id_usaha');
        $akunId = Akun::where('akun', $akun)->value('id_akun');
        $subAkun1Id = SubAkun1::where('sub_akun_1', $subAkun1)->value('id_sub_akun_1');

        $query = DB::table('laporan')->join('klasifikasi_laporan', 'laporan.id_klasifikasi', '=', 'klasifikasi_laporan.id_klasifikasi')
            ->where('klasifikasi_laporan', '!=', 'Pemasukan')->where('laporan.status_cek', 'Sudah Dicek');

        // Array untuk mencocokkan angka bulan dengan nama bulan
        $namaBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        if ($filterBulan != 'Semua') {
            // Ubah filterBulan dari angka menjadi nama bulan
            $filterBulan = $namaBulan[$filterBulan];

            // Gunakan $filterBulan dalam query
            $query->whereRaw("MONTHNAME(tanggal_laporan) = ?", [$filterBulan]);
        }

        if ($filterTahun != 'Semua') {
            $query->whereYear('tanggal_laporan', $filterTahun);
        }

        if ($klasifikasiId && $usahaId && $akunId) {
            $query->where('id_klasifikasi', $klasifikasiId)
                ->where('id_usaha', $usahaId)
                ->where('id_akun', $akunId);

            if ($subAkun1Id) {
                $query->where('id_sub_akun_1', $subAkun1Id);
            }
        }

        $data = $query->get();
        $jumlahData = count($data);
        $jumlahNominal = $data->sum('nominal');
        // dd($data);

        // Nama file Excel yang akan dihasilkan
        $fileName = sprintf(
            'Laporan Pengeluaran-Sudah dicek-%s-%s-%s .xlsx',
            $usaha,
            $filterBulan,
            $filterTahun
        );

        // Membuat objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set bold font for some cells
        $sheet->getStyle('B1')->getFont()->setBold(true);
        $sheet->getStyle('G1')->getFont()->setBold(true);
        $sheet->getStyle('G3')->getFont()->setBold(true);

        // Menuliskan header kolom
        $sheet->setCellValue('B1', 'Laporan Pemasukan');
        $sheet->setCellValue('B2', 'Status');
        $sheet->setCellValue('C2', ':');
        $sheet->setCellValue('D2', 'Sudah Dicek');
        $sheet->setCellValue('B3', 'Unit Usaha');
        $sheet->setCellValue('C3', ':');
        $sheet->setCellValue('D3', $usaha);
        $sheet->setCellValue('B4', 'Akun');
        $sheet->setCellValue('C4', ':');
        $sheet->setCellValue('D4', $akun);
        $sheet->setCellValue('A6', 'No');
        $sheet->setCellValue('B6', 'Kode Laporan');
        $sheet->setCellValue('C6', 'Tanggal Cek');
        $sheet->setCellValue('D6', 'Tanggal Laporan');
        $sheet->setCellValue('E6', 'Kasir');
        $sheet->setCellValue('G1', 'Total Data');
        $sheet->setCellValue('G2', $jumlahData);
        $sheet->setCellValue('G3', 'Total Nominal');
        $sheet->setCellValue('G4', $jumlahNominal);
        $sheet->setCellValue('F6', 'Klasifikasi');
        $sheet->setCellValue('G6', 'Usaha');
        $sheet->setCellValue('H6', 'Akun');
        $sheet->setCellValue('I6', 'Sub Akun 1');
        $sheet->setCellValue('J6', 'Sub Akun 2');
        $sheet->setCellValue('K6', 'Sub Akun 3');
        $sheet->setCellValue('L6', 'Nominal');

        // Menuliskan data ke Excel
        $row = 7;
        $no = 1;
        // dd($data);

        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $item->kode_laporan);
            $sheet->setCellValue('C' . $row, $item->tanggal_cek);
            $sheet->setCellValue('D' . $row, $item->tanggal_laporan);

            $karyawan = Karyawan::where('id_karyawan', $item->id_kasir)->first();
            $nama_kasir = $karyawan->nama;
            $sheet->setCellValue('E' . $row, $nama_kasir);

            $klasifikasi_laporan = KlasifikasiLaporan::where('id_klasifikasi', $item->id_klasifikasi)->first();
            $klasifikasi = $klasifikasi_laporan->klasifikasi_laporan;
            $sheet->setCellValue('F' . $row, $klasifikasi);

            $usaha = Usaha::where('id_usaha', $item->id_usaha)->first();
            $nama_usaha = $usaha->nama_usaha;
            $sheet->setCellValue('G' . $row, $nama_usaha);

            $akun = Akun::where('id_akun', $item->id_akun)->first();
            $nama_akun = $akun->akun;
            $sheet->setCellValue('H' . $row, $nama_akun);

            $sub_akun_1 = SubAkun1::where('id_sub_akun_1', $item->id_sub_akun_1)->first();
            $nama_sub_akun_1 = $sub_akun_1 ? $sub_akun_1->sub_akun_1 : '-';
            $sheet->setCellValue('I' . $row, $nama_sub_akun_1);

            $sub_akun_2 = SubAkun2::where('id_sub_akun_2', $item->id_sub_akun_2)->first();
            $nama_sub_akun_2 = $sub_akun_2 ? $sub_akun_2->sub_akun_2 : '-';
            $sheet->setCellValue('J' . $row, $nama_sub_akun_2);

            $sub_akun_3 = SubAkun3::where('id_sub_akun_3', $item->id_sub_akun_3)->first();
            $nama_sub_akun_3 = $sub_akun_3 ? $sub_akun_3->sub_akun_3 : '-';
            $sheet->setCellValue('K' . $row, $nama_sub_akun_3);

            $sheet->setCellValue('L' . $row, $item->nominal);

            // Tambahkan baris lain sesuai kebutuhan
            $row++;
        }

        // Membuat objek Writer untuk Excel 2007
        $writer = new Xlsx($spreadsheet);

        // Menggunakan StreamedResponse untuk mengirimkan file langsung ke browser
        return new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename=' . $fileName,
        ]);
    }
}
