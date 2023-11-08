<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\BuktiValid;
use App\Models\KlasifikasiLaporan;
use App\Models\Laporan;
use App\Models\SubAkun1;
use App\Models\SubAkun2;
use App\Models\SubAkun3;
use App\Models\Usaha;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        // dd($request->all());
        // validasi
        $validator = Validator::make(
            $request->all(),
            [
                'klasifikasi' => 'required',
                'usaha' => 'required',
                'akun' => 'required',
                'input_Akun_Baru' => 'required_if:akun,tambah-akun-baru',
                'bukti_valid_100rb' => 'required',
                'bukti_valid_lebih100rb' => 'required',
            ],
            [
                'klasifikasi.required' => 'Klasifikasi harus diisi.',
                'usaha.required' => 'Usaha harus diisi.',
                'akun.required' => 'Akun harus diisi.',
                'input_Akun_Baru.required_if' => 'Akun Baru harus diisi jika memilih "Tambah Akun Baru".',
                'bukti_valid_100rb.required' => 'Bukti Valid (<100rb) harus diisi.',
                'bukti_valid_lebih100rb.required' => 'Bukti Valid (>100rb) harus diisi.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
        $selectedSubAkun1Baru = SubAkun1::where('sub_akun_1', $inputSubAkun1Baru)->first();
        $selectedSubAkun1 = SubAkun1::where('sub_akun_1', $selectedSubAkun1Name)->first();

        $selectedSubAkun2Name = $request->input('sub_akun_2');
        $inputSubAkun2Baru = $request->input('input_Sub_Akun_2_Baru');
        $selectedSubAkun2Baru = SubAkun2::where('sub_akun_2', $inputSubAkun2Baru)->first();
        $selectedSubAkun2 = SubAkun2::where('sub_akun_2', $selectedSubAkun2Name)->first();

        $selectedSubAkun3Name = $request->input('sub_akun_3');
        $inputSubAkun3Baru = $request->input('input_Sub_Akun_3_Baru');
        $selectedSubAkun3Baru = SubAkun3::where('sub_akun_3', $inputSubAkun3Baru)->first();
        $selectedSubAkun3 = SubAkun3::where('sub_akun_3', $selectedSubAkun3Name)->first();

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

        if ($selectedSubAkun1Name === 'input_Sub_Akun_1_Baru') {
            $selectedSubAkun1 = SubAkun1::create([
                'id_sub_akun_1' => Uuid::uuid4(),
                'id_akun' => $selectedAkun->id_akun,
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

        if ($selectedAkunName === 'input_Akun_Baru') {
            $buktiValid = BuktiValid::create([
                'id_bukti_valid' => Uuid::uuid4(),
                'id_akun' => $selectedAkun->id_akun,
                'bukti_valid_100rb' => $buktiValidLt100rb,
                'bukti_valid_lebih100rb' => $buktiValidGt100rb,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // dd($newAkun, $buktiValid, $subAkun1);
        return redirect()->route('akun')->with('success', 'Akun berhasil ditambahkan.');
    }

    public function HapusData($id_key)
    {
        if (SubAkun3::where('id_sub_akun_3', $id_key)->exists()) {
            // Cek apakah Sub Akun 3 terkait dengan data laporan
            if (Laporan::where('id_sub_akun_3', $id_key)->exists()) {
                return redirect()->to('/akun')->with('error', 'Sub Akun 3 terhubung dengan data Laporan.')->with('errorModalId', $id_key);
            } else {
                SubAkun3::where('id_sub_akun_3', $id_key)->delete();
                return redirect()->to('/akun')->with('success', 'Sub Akun 3 berhasil dihapus.');
            }
        } else if (SubAkun2::where('id_sub_akun_2', $id_key)->exists()) {
            // Cek apakah Sub Akun 2 terkait dengan data laporan
            if (Laporan::where('id_sub_akun_2', $id_key)->exists()) {
                return redirect()->to('/akun')->with('error', 'Sub Akun 2 terhubung dengan data Laporan.')->with('errorModalId', $id_key);
            } else {
                SubAkun2::where('id_sub_akun_2', $id_key)->delete();
                return redirect()->to('/akun')->with('success', 'Sub Akun 2 berhasil dihapus.');
            }
        } else if (SubAkun1::where('id_sub_akun_1', $id_key)->exists()) {
            // Cek apakah Sub Akun 1 terkait dengan data laporan
            if (Laporan::where('id_sub_akun_1', $id_key)->exists()) {
                return redirect()->to('/akun')->with('error', 'Sub Akun 1 terhubung dengan data Laporan.')->with('errorModalId', $id_key);
            } else {
                SubAkun1::where('id_sub_akun_1', $id_key)->delete();
                return redirect()->to('/akun')->with('success', 'Sub Akun 1 berhasil dihapus.');
            }
        } else if (Akun::where('id_Akun', $id_key)->exists()) {
            $akun = Akun::find($id_key);

            // Hapus akun dan kaskade penghapusan pada tabel bukti_valid
            $akun->delete();

            return redirect()->to('/akun')->with('success', 'Akun berhasil dihapus.');
        }
    }
}
