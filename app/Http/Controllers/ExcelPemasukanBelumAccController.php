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

class ExcelPemasukanBelumAccController extends Controller
{
    public function exportData(Request $request)
    {
        // dd('baba');
        // Mendapatkan nilai filter lainnya
        $filterBulan = $request->input('filter_bulan');
        $filterTahun = $request->input('filter_tahun');
        // dd($filterTahun);
        $usaha = $request->input('usaha');
        $akun = $request->input('akun');
        $subAkun1 = $request->input('sub_akun_1');

        $usahaId = Usaha::where('nama_usaha', $usaha)->value('id_usaha');
        // dd($usahaId);
        $akunId = Akun::where('akun', $akun)->value('id_akun');
        $subAkun1Id = SubAkun1::where('sub_akun_1', $subAkun1)->value('id_sub_akun_1');


        $query = DB::table('laporan')
            ->join('klasifikasi_laporan', 'laporan.id_klasifikasi', '=', 'klasifikasi_laporan.id_klasifikasi')
            ->where('klasifikasi_laporan', 'Pemasukan')
            ->where('laporan.status_cek', 'Belum Dicek');

        if ($filterBulan != 'Semua') {
            $query->whereMonth('tanggal_laporan', $filterBulan);
        }

        if ($filterTahun != 'Semua') {
            $query->whereYear('tanggal_laporan', $filterTahun);
        }

        if ($usahaId && $akunId) {
            $query->where('id_usaha', $usahaId)
                ->where('id_akun', $akunId);

            if ($subAkun1Id) {
                $query->where('id_sub_akun_1', $subAkun1Id);
            }
        }

        $data = $query->get();
        // dd($data);

        // Nama file Excel yang akan dihasilkan
        $fileName = sprintf(
            'Laporan Pemasukan-belum dicek-%s-%s-%s .xlsx',
            $usaha,
            $filterBulan,
            $filterTahun
        );

        // Membuat objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Menuliskan header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Laporan');
        $sheet->setCellValue('C1', 'Tanggal Cek');
        $sheet->setCellValue('D1', 'Tanggal Laporan');
        $sheet->setCellValue('E1', 'Kasir');
        $sheet->setCellValue('F1', 'Klasifikasi');
        $sheet->setCellValue('G1', 'Usaha');
        $sheet->setCellValue('H1', 'Akun');
        $sheet->setCellValue('I1', 'Sub Akun 1');
        $sheet->setCellValue('J1', 'Sub Akun 2');
        $sheet->setCellValue('K1', 'Sub Akun 3');
        $sheet->setCellValue('L1', 'Nominal');

        // Menuliskan data ke Excel
        $row = 2;
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
