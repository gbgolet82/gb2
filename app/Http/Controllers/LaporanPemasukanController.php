<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\KlasifikasiLaporan;
use App\Models\Laporan;
use App\Models\Usaha;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class LaporanPemasukanController extends Controller
{
    public function index(Request $request)
    {
        // buat ambil rute yang aktif
        $pemasukanBelumActive = $request->url() == route('pemasukan_blm');
        $pemasukanSudahAktif = $request->url() == route('pemasukan_sdh');   
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
            'kasir.nama as nama_kasir', 'manager.nama as nama_manager',
            
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
        
        $data = $data->get();
        $status_cek = 'Belum Dicek';
        $active_page = "PEMASUKAN";
        return view('contents.pemasukan', compact('status_cek','active_page', 'data', 'akunOptions', 'kodeLaporan', 'idKlasifikasiPemasukan', 'pemasukanBelumActive', 'pemasukanSudahAktif', 'usahaOption'));
    }

    public function pemasukan(Request $request)
    {
        // buat ambil rute yang aktif
        $pemasukanSudahAktif = $request->url() == route('pemasukan_sdh');    
        $pemasukanBelumActive = $request->url() == route('pemasukan_blm');  
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
            'kasir.nama as nama_kasir', 'manager.nama as nama_manager',
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
        
        $data = $data->get();
        $status_cek = 'Sudah Dicek';
        $active_page = "PEMASUKAN";
        return view('contents.pemasukan', compact('status_cek','active_page', 'data', 'pemasukanSudahAktif', 'akunOptions', 'pemasukanBelumActive', 'usahaOption'));
    }


    public function simpanPemasukan(Request $request) {
        // dd('abab');
        // Validation rules
        $rules = [
            'id_akun' => 'required',
            'nominal' => 'required|numeric',
            'gambar_bukti' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the file types and size as needed
            
        ];

        // Custom error messages
        $customMessages = [
            'id_akun.required' => 'Akun harus diisi.',
            'nominal.required' => 'Nominal harus diisi.',
            'nominal.numeric' => 'Nominal harus berupa angka.',
            'gambar_bukti.required' => 'Gambar Bukti harus diisi.',
            'gambar_bukti.image' => 'Gambar Bukti harus berupa gambar.',
            'gambar_bukti.mimes' => 'Gambar Bukti harus berupa JPEG, PNG, JPG, atau GIF.',
            'gambar_bukti.max' => 'Gambar tidak boleh melebihi 2MB.',
        ];

        // Validate the request
        $validatedData = $request->validate($rules, $customMessages);

        // $idKlasifikasiPemasukan = null; // Default value
        // Handle file upload and storage
        if ($request->hasFile('gambar_bukti')) {
            $file = $request->file('gambar_bukti');
            $tujuan_upload = 'nota';
            $filename = $file->getClientOriginalName();
            // upload file
            $file->move($tujuan_upload, $filename);
            // Save the data to the database
            $uuid = Str::uuid()->toString();
            $idKlasifikasiPemasukan = session('idKlasifikasiPemasukan');

            $pemasukan = new Laporan();
            $pemasukan->id_laporan = $uuid;
            $pemasukan->kode_laporan = $request->input('kode_laporan');
            $tanggalLaporan = Carbon::parse($request->input('tanggal_laporan'));
            $pemasukan->tanggal_laporan = $tanggalLaporan; 
            // sementara  (mengambil id karyawan yg login)
            $pemasukan->id_kasir = session('id_karyawan');
            // sementara (belum tau cara ambil id klasifikasi)
            $pemasukan->id_klasifikasi = $idKlasifikasiPemasukan;
            $pemasukan->id_usaha = session('id_usaha');
            $pemasukan->id_akun = $validatedData['id_akun'];
            $idSubAkun1 = $request->input('id_sub_akun_1'); // nilainya bisa berupa null jika dropdown tidak dipilih
                if ($idSubAkun1 === 'Pilih Sub Akun 1' || $idSubAkun1 === '?') {
                    $idSubAkun1 = null;
                }
            $idSubAkun2 = $request->input('id_sub_akun_2');
                if ($idSubAkun2 === 'Pilih Sub Akun 2' || $idSubAkun2 === '?') {
                    $idSubAkun2 = null;
                }

            $idSubAkun3 = $request->input('id_sub_akun_3');
                if ($idSubAkun3 === 'Pilih Sub Akun 3' || $idSubAkun3 === '?') {
                    $idSubAkun3 = null;
                }

            $pemasukan->id_sub_akun_1 = $idSubAkun1;
            $pemasukan->id_sub_akun_2 = $idSubAkun2;
            $pemasukan->id_sub_akun_3 = $idSubAkun3;
            $pemasukan->nominal = $validatedData['nominal'] = str_replace(".", "", $validatedData['nominal']);
            $pemasukan->gambar_bukti = $filename;
            $pemasukan->status_cek = 'Belum Dicek';

            $pemasukan->save();
            // dd($pemasukan);

            // Redirect or return a response
            return redirect()->route('pemasukan_blm')->with('success', 'Data Pemasukan berhasil ditambah.'); // Replace with your success route
        }
    }

    public function getSubAkun1Options($akun)
    {
        // Cari ID akun berdasarkan nama akun
        $id_akun = Akun::where('akun', $akun)->value('id_akun');

        // Ambil data sub_akun_1 berdasarkan id_akun yang sesuai
        $subAkun1Options = DB::table('sub_akun_1')->where('id_akun', $id_akun)->pluck('sub_akun_1', 'sub_akun_1');

        return response()->json($subAkun1Options);
    }

    public function getAkun($nama_usaha)
    {
        // Cari ID akun berdasarkan nama akun
        $id_usaha = Usaha::where('nama_usaha', $nama_usaha)->value('id_usaha');
        $id_klasifikasi = KlasifikasiLaporan::where('klasifikasi_laporan', 'Pemasukan')->value('id_klasifikasi');

        // Ambil data sub_akun_1 berdasarkan id_akun yang sesuai
        $namaAkun = DB::table('akun')->where('id_usaha', $id_usaha)->where('id_klasifikasi', $id_klasifikasi)->pluck('akun', 'akun');

        return response()->json($namaAkun);
    }

    public function getSub1($akun)
    {
        // Cari ID akun berdasarkan nama akun
        $akun = Akun::where('akun', $akun)->value('id_akun');

        // Ambil data sub_akun_1 berdasarkan id_akun yang sesuai
        $namaSub = DB::table('sub_akun_1')->where('id_akun', $akun)->pluck('sub_akun_1', 'sub_akun_1');

        return response()->json($namaSub);
    }

    public function ambilSubAkun1($id_akun)
    {
        // Cari ID akun berdasarkan nama akun
        $id_akun = Akun::where('id_akun', $id_akun)->value('id_akun');

        // Ambil data sub_akun_1 berdasarkan id_akun yang sesuai
        $ambilSubAkun1 = DB::table('sub_akun_1')->where('id_akun', $id_akun)->pluck('sub_akun_1', 'id_sub_akun_1');

        return response()->json($ambilSubAkun1);
    }

    public function ambilSubAkun2($id_sub_akun_1)
    {
        $subAkun2Options = DB::table('sub_akun_2')
        ->where('id_sub_akun_1', $id_sub_akun_1)
        ->pluck('sub_akun_2', 'id_sub_akun_2')
        ->toArray();
    
        return response()->json($subAkun2Options);
    }
    
    public function ambilSubAkun3($id_sub_akun_2)
    {
        $subAkun3Options = DB::table('sub_akun_3')
        ->where('id_sub_akun_2', $id_sub_akun_2)
        ->pluck('sub_akun_3', 'id_sub_akun_3')
        ->toArray();

        return response()->json($subAkun3Options);
    }

    public function getJumlahBelumDicek()
    {
        $session = session('nama_usaha');
        $query = Laporan::join('klasifikasi_laporan', 'klasifikasi_laporan.id_klasifikasi', '=', 'laporan.id_klasifikasi')
        ->where('klasifikasi_laporan', 'Pemasukan')
        ->where('status_cek', 'Belum dicek');

        if ($session != 'SEMUA') {
            $query->where('laporan.id_usaha', session('id_usaha'));
        }

        $jumlahBelumDicek = $query->count();

        return response()->json(['jumlah' => $jumlahBelumDicek]);
    }


    public function getJumlahSudahDicek()
    {
        $session = session('nama_usaha');
        $query = Laporan::join('klasifikasi_laporan', 'klasifikasi_laporan.id_klasifikasi', '=', 'laporan.id_klasifikasi')
        ->where('klasifikasi_laporan', 'Pemasukan')
        ->where('status_cek', 'Sudah dicek');

        if ($session != 'SEMUA') {
            $query->where('laporan.id_usaha', session('id_usaha'));
        }

        $jumlahSudahDicek = $query->count();

        return response()->json(['jumlah' => $jumlahSudahDicek]);
    }

    public function accPemasukan(Request $request, $id_laporan)
    {
        // Ambil data catatan dan ID karyawan dari request
        $catatan = $request->input('catatan');
        $id_karyawan = session('id_karyawan'); // Menggunakan id karyawan dari sesi, sesuaikan dengan aturan autentikasi Anda

        // Update tabel laporan
        $laporan = Laporan::find($id_laporan);
        if ($laporan) {
            $laporan->catatan = $catatan;
            $laporan->status_cek = 'Sudah Dicek';
            $laporan->id_manager = $id_karyawan;
            $laporan->tanggal_cek = Carbon::now();
            $laporan->save();
            
            return redirect()->route('pemasukan_blm')->with('success', 'Data Laporan Berhasil Dicek'); // Gantilah dengan route yang sesuai
        } else {
            return redirect()->back()->with('error', 'Laporan tidak ditemukan');
        }
    } 

    public function getPemasukanByUsaha($dateAwal, $dateAkhir)
    {
        // $dateAwal=03-10-2023;
        if ($dateAwal!=0) {
            $dateAwal = \Carbon\Carbon::createFromFormat('d-m-Y', $dateAwal)->format('Y-m-d');
            $dateAkhir = \Carbon\Carbon::createFromFormat('d-m-Y', $dateAkhir)->format('Y-m-d');
        }
        // dd($dateAwal);
        // dd($dateAkhir);

        // Sesuaikan query dengan struktur basis data dan relasinya
        $data = Laporan::
        selectRaw('usaha.nama_usaha, MONTH(tanggal_laporan) as bulan, SUM(nominal) as total_nominal')
            ->join('usaha', 'usaha.id_usaha', '=', 'laporan.id_usaha')
            ->join('klasifikasi_laporan', 'klasifikasi_laporan.id_klasifikasi', '=', 'laporan.id_klasifikasi')
            ->where('klasifikasi_laporan.klasifikasi_laporan', '=', 'Pemasukan')
            ->where('laporan.status_cek', '=', 'Belum Dicek')
            ->when($dateAkhir!=0, function($query) use ($dateAwal,$dateAkhir){
                $query->whereDate('tanggal_laporan', '>=', $dateAwal)
                 ->whereDate('tanggal_laporan', '<=', $dateAkhir);

            })
            // ->whereBetween('tanggal_laporan', [$dateAwal, $dateAkhir])
            ->groupBy('usaha.nama_usaha', 'bulan')
            ->get();
        // dd($data);

        return response()->json($data);
    }



    public function getPemasukanByUsaha1(Request $request)
{
    // $startDate = '2023-10-01';
    // $endDate = '2023-10-31';
    dd($request->all());

    $startDate = $request->input('startDate');
    $endDate = $request->input('endDate');

    $data = Laporan::selectRaw('usaha.nama_usaha, MONTH(tanggal_laporan) as bulan, SUM(nominal) as total_nominal')
        ->join('usaha', 'usaha.id_usaha', '=', 'laporan.id_usaha')
        ->join('klasifikasi_laporan', 'klasifikasi_laporan.id_klasifikasi', '=', 'laporan.id_klasifikasi')
        ->where('klasifikasi_laporan.klasifikasi_laporan', '=', 'Pemasukan')
        ->whereBetween('tanggal_laporan', [$startDate, $endDate]) // Filter berdasarkan rentang tanggal
        ->groupBy('usaha.nama_usaha', 'bulan')
        ->get();

    return response()->json($data);
}

    



}
