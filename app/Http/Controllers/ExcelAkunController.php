<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\BuktiValid;
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

class ExcelAkunController extends Controller
{
    public function exportData(Request $request)
    {
        // Mendapatkan nilai filter lainnya
        $filterKlasifikasi = $request->input('klasifikasi');
        $filterUsaha = $request->input('usaha');
        $filterAkun = $request->input('akun');

        // Mendapatkan ID klasifikasi, usaha, dan akun berdasarkan nilai filter
        $klasifikasiId = KlasifikasiLaporan::where('klasifikasi_laporan', $filterKlasifikasi)->value('id_klasifikasi');
        $UsahaId = Usaha::where('nama_usaha', $filterUsaha)->value('id_usaha');
        $akunId = Akun::where('akun', $filterAkun)->value('id_akun');

        // Membuat query
        $query = DB::table('akun')
            ->select(
                '*',
                'sub_akun_1.sub_akun_1 as sub_akun_1',
                'sub_akun_2.sub_akun_2 AS sub_akun_2',
                'sub_akun_3.sub_akun_3 AS sub_akun_3',
                'akun.akun as akun',
                'usaha.nama_usaha as nama_usaha',
                'klasifikasi_laporan.klasifikasi_laporan as klasifikasi_laporan',
                'bukti_valid.bukti_valid_100rb as bukti_valid_100rb',
                'bukti_valid.bukti_valid_lebih100rb as bukti_valid_lebih100rb',
            )
            ->leftJoin('usaha', 'akun.id_usaha', '=', 'usaha.id_usaha')
            ->leftjoin('klasifikasi_laporan', 'akun.id_klasifikasi', '=', 'klasifikasi_laporan.id_klasifikasi')
            ->leftJoin('sub_akun_1', 'akun.id_akun', '=', 'sub_akun_1.id_akun')
            ->leftJoin('sub_akun_2', 'sub_akun_1.id_sub_akun_1', '=', 'sub_akun_2.id_sub_akun_1')
            ->leftJoin('sub_akun_3', 'sub_akun_2.id_sub_akun_2', '=', 'sub_akun_3.id_sub_akun_2')
            ->leftJoin('bukti_valid', 'akun.id_akun', '=', 'bukti_valid.id_akun')
            ->orderBy('klasifikasi_laporan', 'asc')
            ->orderBy('nama_usaha', 'asc')
            ->orderBy('akun', 'asc')
            ->orderBy('sub_akun_1', 'asc')
            ->orderBy('sub_akun_2', 'asc')
            ->orderBy('sub_akun_3', 'asc');

        // Menerapkan filter klasifikasi
        $query->where('id_klasifikasi', $klasifikasiId);

        // Menerapkan filter usaha
        $query->where('id_usaha', $UsahaId);

        // Menerapkan filter akun
        $query->where('id_akun', $akunId);

        // Jika filter bernilai null
        if ($filterKlasifikasi === null && $filterUsaha === null && $filterAkun === null) {
            // Mengambil nilai `klasifikasiId`, `UsahaId`, dan `akunId` dari $query
            $klasifikasiId = $query->value('id_klasifikasi');
            $UsahaId = $query->value('nama_usaha');
            $akunId = $query->value('akun');

            // Jika data bernilai null, gunakan nilai default
            if ($klasifikasiId === null) {
                $klasifikasiId = '';
            }

            // Jika data bernilai null, gunakan nilai default
            if ($query->value('id_bukti_valid') === null) {
                $buktiValid = null;
            } else {
                $buktiValid = BuktiValid::where('id_akun', $akunId)->first();
            }
        } else {
            // Jika filter tidak bernilai null
            // Mengambil nilai `klasifikasiId`, `UsahaId`, dan `akunId` dari filter
            $klasifikasiId = $klasifikasiId ?? $request->input('klasifikasi');
            $UsahaId = $UsahaId ?? $request->input('usaha');
            $akunId = $akunId ?? $request->input('akun');

            // Jika data bernilai null, gunakan nilai default
            if ($query->value('id_bukti_valid') === null) {
                $buktiValid = null;
            } else {
                $buktiValid = BuktiValid::where('id_akun', $akunId)->first();
            }
        }

        // $data = $query->get();
        // dd($akunId);

        // Nama file Excel yang akan dihasilkan
        $fileName = sprintf(
            'Akun & Sub Akun.xlsx'
        );

        // Membuat objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Menuliskan header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Klasifikasi');
        $sheet->setCellValue('C1', 'Usaha');
        $sheet->setCellValue('D1', 'Akun');
        $sheet->setCellValue('E1', 'Sub Akun 1');
        $sheet->setCellValue('F1', 'Sub Akun 2');
        $sheet->setCellValue('G1', 'Sub Akun 3');
        $sheet->setCellValue('H1', 'Bukti Valid 100rb');
        $sheet->setCellValue('I1', 'Bukti Valid Lebih 100rb');

        // Menuliskan data ke Excel
        $row = 2;
        $no = 1;
        // dd($data);

        foreach ($query as $item) {
            $sheet->setCellValue('A' . $row, $no++);

            // $klasifikasi = KlasifikasiLaporan::where('klasifikasi_laporan', $filterKlasifikasi)->first();
            // $klasifikasiId = $klasifikasi->klasifikasi_laporan;
            // $sheet->setCellValue('B' . $row, $klasifikasiId);

            // $usaha = Usaha::where('nama_usaha', $filterUsaha)->first();
            // $UsahaId = $usaha->nama_usaha;
            // $sheet->setCellValue('C' . $row, $UsahaId);

            // $akun = Akun::where('akun', $filterAkun)->first();
            // $akunId = $akun->akun;
            // $sheet->setCellValue('D' . $row, $akunId);

            $sheet->setCellValue('B' . $row, $klasifikasiId);
            $sheet->setCellValue('C' . $row, $UsahaId);
            $sheet->setCellValue('D' . $row, $akunId);

            $id_akun = Akun::where('akun', $filterAkun)->value('id_akun');
            $sub_akun_1 = SubAkun1::where('id_akun', $id_akun)->first();
            $id_sub_akun_1 = $sub_akun_1 ? $sub_akun_1->sub_akun_1 : '-';
            $sheet->setCellValue('E' . $row, $id_sub_akun_1);

            $sub_akun_2 = SubAkun2::where('id_sub_akun_1', $id_sub_akun_1)->first();
            $id_sub_akun_2 = $sub_akun_2 ? $sub_akun_2->sub_akun_2 : '-';
            $sheet->setCellValue('F' . $row, $id_sub_akun_2);

            $sub_akun_3 = SubAkun3::where('id_sub_akun_2', $id_sub_akun_2)->first();
            $id_sub_akun_3 = $sub_akun_3 ? $sub_akun_3->sub_akun_3 : '-';
            $sheet->setCellValue('G' . $row, $id_sub_akun_3);

            // $sub_akun_1 = SubAkun1::where('id_sub_akun_1', $item->id_sub_akun_1)->first();
            // $nama_sub_akun_1 = $sub_akun_1 ? $sub_akun_1->sub_akun_1 : '-';
            // $sheet->setCellValue('E' . $row, $nama_sub_akun_1);

            // $sub_akun_2 = SubAkun2::where('id_sub_akun_2', $item->id_sub_akun_2)->first();
            // $nama_sub_akun_2 = $sub_akun_2 ? $sub_akun_2->sub_akun_2 : '-';
            // $sheet->setCellValue('F' . $row, $nama_sub_akun_2);

            // $sub_akun_3 = SubAkun3::where('id_sub_akun_3', $item->id_sub_akun_3)->first();
            // $nama_sub_akun_3 = $sub_akun_3 ? $sub_akun_3->sub_akun_3 : '-';
            // $sheet->setCellValue('G' . $row, $nama_sub_akun_3);

            // $buktiValid = BuktiValid::where('id_bukti_valid', $item->id_bukti_valid)->first();
            // $id_akun = Akun::where('akun', $filterAkun)->value('id_akun');
            // $buktiValid = BuktiValid::where('id_akun', $id_akun)->first();

            // $bukti_valid_100rb = $buktiValid->bukti_valid_100rb;
            // $bukti_valid_lebih100rb = $buktiValid->bukti_valid_lebih100rb;
            // // Menuliskan data `bukti_valid_100rb` pada baris ke-1
            // $sheet->setCellValue('H' . $row, $bukti_valid_100rb);
            // $sheet->setCellValue('I' . $row, $bukti_valid_lebih100rb);

            if ($buktiValid) {
                $sheet->setCellValue('H' . $row, $buktiValid->bukti_valid_100rb);
                $sheet->setCellValue('I' . $row, $buktiValid->bukti_valid_lebih_100rb);
            } else {
                $sheet->setCellValue('H' . $row, '-');
                $sheet->setCellValue('I' . $row, '-');
            }

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
