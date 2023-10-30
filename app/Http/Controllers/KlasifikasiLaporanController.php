<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\BuktiValid;
use App\Models\KlasifikasiLaporan;
use App\Models\SubAkun1;
use App\Models\SubAkun2;
use App\Models\SubAkun3;
use App\Models\Usaha;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KlasifikasiLaporanController extends Controller
{
    public function index(Request $request)
    {

        // $gatau = 'lololo';
        //get data tabel klasifikasi
        $dataKlasifikasi = KlasifikasiLaporan::select('id_klasifikasi', 'klasifikasi_laporan', 'created_at', 'updated_at')->orderBy('klasifikasi_laporan', 'asc')->get();

        //get data tabel usaha
        $dataUsaha = Usaha::select('id_usaha', 'nama_usaha', 'alamat_usaha', 'jenis_usaha', 'produk_usaha')->orderBy('nama_usaha', 'asc')
            ->get();

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

        // dd($dataSubAkun2);

        $modelHead = "Tambah Data Klasifikasi & Akun";
        $active_page = "AKUN";
        return view('contents.akun', compact('active_page', 'modelHead', 'dataKlasifikasi', 'dataUsaha', 'dataAkun'));
    }

    public function simpanAkun(Request $request)
    {
        dd($request->all());
        $selectedKlasifikasiName = $request->input('klasifikasi');
        $selectedKlasifikasi = KlasifikasiLaporan::where('klasifikasi_laporan', $selectedKlasifikasiName)->first();

        $selectedUsahaName = $request->input('usaha');
        $selectedUsaha = Usaha::where('nama_usaha', $selectedUsahaName)->first();

        $selectedAkunName = $request->input('akun');
        $inputAkunBaru = $request->input('input_Akun_Baru');
        $selectedAkunBaru = Akun::where('akun', $inputAkunBaru)->first();
        $selectedAkun = Akun::where('akun', $selectedAkunName)->first();

        $selectedSubAkun1Name = $request->input('sub_akun_1');
        $inputSubAkun1Baru = $request->input('input_Sub_Akun_1_Baru');

        $selectedSubAkun2Name = $request->input('sub_akun_2');
        $inputSubAkun2Baru = $request->input('input_Sub_Akun_2_Baru');

        $selectedSubAkun3Name = $request->input('sub_akun_3');
        $inputSubAkun3Baru = $request->input('input_Sub_Akun_3_Baru');

        $buktiValidLt100rb = $request->input('bukti_valid_100rb');
        $buktiValidGt100rb = $request->input('bukti_valid_lebih100rb');

        if ($selectedAkunName === 'input_Akun_Baru') {
            $selectedAkun = Akun::create([
                'id_akun' => Uuid::uuid4(),
                'id_klasifikasi' => $selectedKlasifikasi->id_klasifikasi,
                'id_usaha' => $selectedUsaha->id_usaha,
                'akun' => $inputAkunBaru,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        if ($selectedSubAkun1Name === 'input_Sub_Akun_1_Baru' && !empty($inputSubAkun1Baru)) {
            $selectedSubAkun1 = SubAkun1::create([
                'id_sub_akun_1' => Uuid::uuid4(),
                'id_akun' => $selectedAkun->id_akun ?? $selectedAkunBaru,
                'sub_akun_1' => $inputSubAkun1Baru,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        if ($selectedSubAkun2Name === 'input_Sub_Akun_2_Baru') {
            $selectedSubAkun2 = SubAkun2::create([
                'id_sub_akun_2' => Uuid::uuid4(),
                'id_sub_akun_1' => $selectedSubAkun1->id_sub_akun_1,
                'sub_akun_2' => $inputSubAkun2Baru,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        if ($selectedSubAkun3Name === 'input_Sub_Akun_3_Baru') {
            $selectedSubAkun3 = SubAkun3::create([
                'id_sub_akun_3' => Uuid::uuid4(),
                'id_akun' => $selectedAkun->id_akun,
                'id_sub_akun_2' => $selectedSubAkun2->id_sub_akun_2,
                'sub_akun_3' => $inputSubAkun3Baru,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $buktiValid = BuktiValid::create([
            'id_bukti_valid' => Uuid::uuid4(),
            'id_akun' => $selectedAkun->id_akun,
            'bukti_valid_100rb' => $buktiValidLt100rb,
            'bukti_valid_lebih100rb' => $buktiValidGt100rb,
            'created_at' => now(),
            'updated_at' => now(),
        ]);





        // // Check if a new account is added
        // if ($selectedAkun === 'input_Akun_Baru') {
        //     $newAkun = Akun::create([
        //         'id_akun' => Uuid::uuid4(),
        //         'id_klasifikasi' => $selectedKlasifikasi->id_klasifikasi,
        //         'id_usaha' => $selectedUsaha->id_usaha,
        //         'akun' => $inputAkunBaru,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);

        //     // Create a BuktiValid record with the new account's id
        //     $buktiValid = BuktiValid::create([
        //         'id_bukti_valid' => Uuid::uuid4(),
        //         'id_akun' => $newAkun->id_akun, // Use the new account's id
        //         'bukti_valid_100rb' => $buktiValidLt100rb,
        //         'bukti_valid_lebih100rb' => $buktiValidGt100rb,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // } else {
        //     $klasifikasiAkun = Akun::create([
        //         'id_akun' => Uuid::uuid4(),
        //         'id_klasifikasi' => $selectedKlasifikasi->id_klasifikasi,
        //         'id_usaha' => $selectedUsaha->id_usaha,
        //         'akun' => $selectedAkun,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);

        //     // Create a BuktiValid record with the existing account's id
        //     $buktiValid = BuktiValid::create([
        //         'id_bukti_valid' => Uuid::uuid4(),
        //         'id_akun' => $klasifikasiAkun->id_akun, // Use the existing account's id
        //         'bukti_valid_100rb' => $buktiValidLt100rb,
        //         'bukti_valid_lebih100rb' => $buktiValidGt100rb,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }


        // dd($newAkun, $buktiValid, $subAkun1);
        return redirect()->route('akun')->with('success', 'Klasifikasi dan Akun berhasil ditambah.');
    }



    // // Check if a new account is added
    // if ($selectedAkun === 'input_Akun_Baru') {
    //     // Create SubAkun1 record if $selectedSubAkun1 is not null
    //     // Check if a new SubAkun1 is added
    //     if ($selectedSubAkun1 === 'input_Sub_Akun_1_Baru') {
    //         $subAkun1new = SubAkun1::create([
    //             'id_sub_akun_1' => Uuid::uuid4(),
    //             'id_akun' => $newAkun->id_akun,
    //             'sub_akun_1' => $inputSubAkun1Baru,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     } else {
    //         if (!is_null($selectedSubAkun1)) {
    //             $subAkun1 = SubAkun1::create([
    //                 'id_sub_akun_1' => Uuid::uuid4(),
    //                 'id_akun' => $newAkun->id_akun,
    //                 'sub_akun_1' => $selectedSubAkun1,
    //                 'created_at' => now(),
    //                 'updated_at' => now(),
    //             ]);
    //         }
    //     }
    // } else {
    //     // Create a SubAkun1 record with the existing account's id
    //     // Create SubAkun1 record if $selectedSubAkun1 is not null
    //     if ($selectedSubAkun1 === 'input_Sub_Akun_1_Baru') {
    //         $subAkun1new = SubAkun1::create([
    //             'id_sub_akun_1' => Uuid::uuid4(),
    //             'id_akun' => $klasifikasiAkun->id_akun,
    //             'sub_akun_1' => $inputSubAkun1Baru,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     } else {
    //         if (!is_null($selectedSubAkun1)) {
    //             $subAkun1 = SubAkun1::create([
    //                 'id_sub_akun_1' => Uuid::uuid4(),
    //                 'id_akun' => $klasifikasiAkun->id_akun,
    //                 'sub_akun_1' => $selectedSubAkun1,
    //                 'created_at' => now(),
    //                 'updated_at' => now(),
    //             ]);
    //         }
    //     }
    // }

    // cek jika menginputkan sub akun 2 dengan akun baru
    // if ($selectedSubAkun1 === 'input_Sub_Akun_1_Baru') {
    //     // Create SubAkun2 record if $selectedSubAkun2 is not null
    //     if ($selectedSubAkun2 === 'input_Sub_Akun_2_Baru') {
    //         $subAkun2new = SubAkun2::create([
    //             'id_sub_akun_2' => Uuid::uuid4(),
    //             'id_sub_akun_1' => $inputSubAkun1Baru, // Pastikan Anda memeriksa apakah $subAkun1 ada
    //             'sub_akun_2' => $inputSubAkun2Baru,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     } else {
    //         if (!is_null($selectedSubAkun2)) {
    //             $subAkun2 = SubAkun2::create([
    //                 'id_sub_akun_2' => Uuid::uuid4(),
    //                 'id_sub_akun_1' => $inputSubAkun1Baru, // Pastikan Anda memeriksa apakah $subAkun1 ada
    //                 'sub_akun_2' => $selectedSubAkun2,
    //                 'created_at' => now(),
    //                 'updated_at' => now(),
    //             ]);
    //         }
    //     }
    // } else {
    //     // Create SubAkun2 record if $selectedSubAkun2 is not null
    //     if ($selectedSubAkun2 === 'input_Sub_Akun_2_Baru') {
    //         $subAkun2 = SubAkun2::create([
    //             'id_sub_akun_2' => Uuid::uuid4(),
    //             'id_sub_akun_1' => $subAkun1->id_sub_akun_1, // Pastikan Anda memeriksa apakah $subAkun1 ada
    //             'sub_akun_2' => $inputSubAkun2Baru,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     } else {
    //         if (!is_null($selectedSubAkun2)) {
    //             $subAkun2 = SubAkun2::create([
    //                 'id_sub_akun_2' => Uuid::uuid4(),
    //                 'id_sub_akun_1' => $subAkun1->id_sub_akun_1, // Pastikan Anda memeriksa apakah $subAkun1 ada
    //                 'sub_akun_2' => $selectedSubAkun2,
    //                 'created_at' => now(),
    //                 'updated_at' => now(),
    //             ]);
    //         }
    //     }
    // }

    // if ($selectedSubAkun2 === 'input_Sub_Akun_2_Baru') {
    //     // Create SubAkun3 record if $selectedSubAkun3 is not null
    //     if ($selectedSubAkun3 === 'input_Sub_Akun_3_Baru') {
    //         $subAkun3new = SubAkun3::create([
    //             'id_sub_akun_3' => Uuid::uuid4(),
    //             'id_akun' => $klasifikasiAkun->id_akun,
    //             'id_sub_akun_2' => $inputSubAkun1Baru, // Pastikan Anda memeriksa apakah $subAkun2 ada
    //             'sub_akun_3' => $inputSubAkun3Baru,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     } else {
    //         if (!is_null($selectedSubAkun3)) {
    //             $subAkun3 = SubAkun3::create([
    //                 'id_sub_akun_3' => Uuid::uuid4(),
    //                 'id_akun' => $klasifikasiAkun->id_akun,
    //                 'id_sub_akun_2' => $inputSubAkun1Baru, // Pastikan Anda memeriksa apakah $subAkun2 ada
    //                 'sub_akun_3' => $selectedSubAkun3,
    //                 'created_at' => now(),
    //                 'updated_at' => now(),
    //             ]);
    //         }
    //     }
    // } else {
    //     // Create SubAkun3 record if $selectedSubAkun3 is not null
    //     if ($selectedSubAkun3 === 'input_Sub_Akun_3_Baru') {
    //         $subAkun3new = SubAkun3::create([
    //             'id_sub_akun_3' => Uuid::uuid4(),
    //             'id_akun' => $klasifikasiAkun->id_akun,
    //             'id_sub_akun_2' => $subAkun2->id_sub_akun_2, // Pastikan Anda memeriksa apakah $subAkun2 ada
    //             'sub_akun_3' => $inputSubAkun3Baru,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     } else {
    //         if (!is_null($selectedSubAkun3)) {
    //             $subAkun3 = SubAkun3::create([
    //                 'id_sub_akun_3' => Uuid::uuid4(),
    //                 'id_akun' => $klasifikasiAkun->id_akun,
    //                 'id_sub_akun_2' => $subAkun2->id_sub_akun_2, // Pastikan Anda memeriksa apakah $subAkun2 ada
    //                 'sub_akun_3' => $selectedSubAkun3,
    //                 'created_at' => now(),
    //                 'updated_at' => now(),
    //             ]);
    //         }
    //     }
    // }

}
