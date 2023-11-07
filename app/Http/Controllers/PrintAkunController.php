<?php

namespace App\Http\Controllers;

use App\Models\KlasifikasiLaporan;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PrintAkunController extends Controller
{
    public function print_akun($id)
    {
        $dataAkun = KlasifikasiLaporan::select(
            'akun.id_klasifikasi as id_klasifikasi',
            'klasifikasi_laporan.klasifikasi_laporan as klasifikasi',
            'usaha.nama_usaha as usaha',
            'akun.akun as akun',
            'sub_akun_1.sub_akun_1 as sub_akun_1',
            'sub_akun_2.sub_akun_2 AS sub_akun_2',
            'sub_akun_3.sub_akun_3 AS sub_akun_3',
            'klasifikasi_laporan.klasifikasi_laporan as klasifikasi_laporan',
            'usaha.nama_usaha as nama_usaha',
            'bukti_valid.bukti_valid_100rb as bukti_valid_100rb',
            'bukti_valid.bukti_valid_lebih100rb as bukti_valid_lebih100rb',
            DB::raw('
                    CASE
                        WHEN sub_akun_3.id_sub_akun_3 IS NOT NULL THEN sub_akun_3.id_sub_akun_3
                        WHEN sub_akun_2.id_sub_akun_2 IS NOT NULL THEN sub_akun_2.id_sub_akun_2
                        WHEN sub_akun_1.id_sub_akun_1 IS NOT NULL THEN sub_akun_1.id_sub_akun_1
                        WHEN akun.id_akun IS NOT NULL THEN akun.id_akun
                        ELSE NULL
                    END AS id_key
                ')
        )
            ->leftJoin('akun', 'klasifikasi_laporan.id_klasifikasi', '=', 'akun.id_klasifikasi')
            ->leftJoin('usaha', 'akun.id_usaha', '=', 'usaha.id_usaha')
            ->leftJoin('sub_akun_1', 'akun.id_akun', '=', 'sub_akun_1.id_akun')
            ->leftJoin('sub_akun_2', 'sub_akun_1.id_sub_akun_1', '=', 'sub_akun_2.id_sub_akun_1')
            ->leftJoin('sub_akun_3', 'sub_akun_2.id_sub_akun_2', '=', 'sub_akun_3.id_sub_akun_2')
            ->leftJoin('bukti_valid', 'akun.id_akun', '=', 'bukti_valid.id_akun')
            ->orderBy('klasifikasi_laporan', 'asc')
            ->orderBy('nama_usaha', 'asc')
            ->orderBy('akun', 'asc')
            ->orderBy('sub_akun_1', 'asc')
            ->orderBy('sub_akun_2', 'asc')
            ->orderBy('sub_akun_3', 'asc')
            ->get();

        $laporan = KlasifikasiLaporan::where('id_klasifikasi', $id)->first();

        $pdf = Dompdf::loadview('print.print_akun', compact('laporan', 'data'));
        return $pdf->stream($dataAkun->usaha . ' - ' . $dataAkun->kode_laporan . '.pdf');
    }
}
