<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ExcelPemasukanBelumDicekController extends Controller
{
    public function export_excel_laporan_pemasukan_a4($id)
    {
        // Ambil data yang diperlukan seperti yang Anda lakukan sebelumnya
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
        )
            ->join('akun', 'akun.id_akun', '=', 'laporan.id_akun')
            ->join('karyawan as kasir', 'laporan.id_kasir', '=', 'kasir.id_karyawan')
            ->leftjoin('karyawan as manager', 'laporan.id_manager', '=', 'manager.id_karyawan')
            ->join('klasifikasi_laporan', 'akun.id_klasifikasi', '=', 'klasifikasi_laporan.id_klasifikasi')
            ->join('usaha', 'laporan.id_usaha', '=', 'usaha.id_usaha')
            ->leftjoin('sub_akun_1', 'laporan.id_sub_akun_1', '=', 'sub_akun_1.id_sub_akun_1')
            ->leftjoin('sub_akun_2', 'laporan.id_sub_akun_2', '=', 'sub_akun_2.id_sub_akun_2')
            ->leftjoin('sub_akun_3', 'laporan.id_sub_akun_3', '=', 'sub_akun_3.id_sub_akun_3')
            ->where('laporan.id_laporan', $id)
            ->first();

        // Buat objek Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Buat lembar kerja baru
        $worksheet = $spreadsheet->getActiveSheet();

        // Isi data ke dalam lembar kerja
        // Contoh: Isi data ke dalam sel-sel lembar kerja
        $worksheet->setCellValue('A1', 'Klasifikasi');
        $worksheet->setCellValue('B1', $data->klasifikasi);
        $worksheet->setCellValue('A2', 'Akun');
        $worksheet->setCellValue('B2', $data->akun);

        // Atur format sel, misalnya, membuat teks tengah di sel
        $worksheet->getStyle('A1:B2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Atur header untuk pengunduhan
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="laporan_pemasukan.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
