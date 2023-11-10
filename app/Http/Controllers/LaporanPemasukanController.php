<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\KlasifikasiLaporan;
use App\Models\Laporan;
use App\Models\SubAkun1;
use App\Models\Usaha;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\ServiceProvider;
use PDF;


class LaporanPemasukanController extends Controller
{
    public function cetakLaporan(Request $request)
    {
        $selectedRole = session('selectedRole');
        $karyawanRoles = session('karyawanRoles');
        // Ambil nilai $pemasukanBelumActive dari sesi
        $pemasukanBelumActive = session('pemasukanBelumActive');
        
        // dd($filterDaterange);
        $filterBulan = '';
        $filterTahun = '';
        $filterDate = '';
        
        if (
            ($karyawanRoles->count() == 1 && !$karyawanRoles->contains('kasir')) ||
                (isset($selectedRole) && $selectedRole != 'kasir')) {
                    $filterBulan = $request->input('filter_bulan');
                    $filterTahun = $request->input('filter_tahun');
                    // dd($filterBulan);
        } else {
            $filterDaterange = \Carbon\Carbon::now()->format('Y-m-d');
            $filterDate = \Carbon\Carbon::createFromFormat('Y-m-d', $filterDaterange)->format('d F Y');
        }

        $selectedUsaha = $request->input('usaha');
        $selectedAkun = $request->input('akun');
        $selectedSubAkun = $request->input('sub_akun_1');
        // dd($selectedUsaha);
        
        $usaha = Usaha::where('nama_usaha', $selectedUsaha)->value('id_usaha');
        $akun = Akun::where('akun', $selectedAkun)->where('id_usaha', $usaha)
        ->value('id_akun');
        $sub = DB::table('sub_akun_1')->where('id_akun', $akun)->where('sub_akun_1', $selectedSubAkun)->value('id_sub_akun_1');
        // dd($sub);
    
    // Adjust the 'join' condition and 'where' clause as per your table schema and requirements

        $query = Laporan::select(
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
        )
        ->join('akun', 'akun.id_akun', '=', 'laporan.id_akun')
        ->join('karyawan as kasir', 'laporan.id_kasir', '=', 'kasir.id_karyawan')
        ->leftjoin('karyawan as manager', 'laporan.id_manager', '=', 'manager.id_karyawan')
        ->join('klasifikasi_laporan', 'akun.id_klasifikasi', '=', 'klasifikasi_laporan.id_klasifikasi')
        ->join('usaha', 'laporan.id_usaha', '=', 'usaha.id_usaha')
        ->leftjoin('sub_akun_1', 'laporan.id_sub_akun_1', '=', 'sub_akun_1.id_sub_akun_1')
        ->leftjoin('sub_akun_2', 'laporan.id_sub_akun_2', '=', 'sub_akun_2.id_sub_akun_2')
        ->leftjoin('sub_akun_3', 'laporan.id_sub_akun_3', '=', 'sub_akun_3.id_sub_akun_3')
        ->where('klasifikasi_laporan', 'Pemasukan')
        ->orderBy('laporan.tanggal_laporan', 'desc');

        if ($pemasukanBelumActive == true) {
            $query->where('laporan.status_cek', 'Belum Dicek');
        } else {
            $query->where('laporan.status_cek', 'Sudah Dicek');
        }
        

        if (
            ($karyawanRoles->count() == 1 && !$karyawanRoles->contains('kasir')) ||
                (isset($selectedRole) && $selectedRole != 'kasir')) {
            if ($filterBulan != 'Semua') {
                $query->whereMonth('laporan.tanggal_laporan', $filterBulan);
            }

            if ($filterTahun != 'Semua') {
                $query->whereYear('laporan.tanggal_laporan', $filterTahun);
            }
        } else {
            $query->whereDate('laporan.tanggal_laporan', $filterDaterange);
        }

        if ($selectedUsaha != 'Semua') {
            $query->where('laporan.id_usaha', $usaha);
        }

        if ($selectedAkun != 'Semua') {
            $query->where('laporan.id_akun', $akun);
        }

        if ($selectedSubAkun != 'Semua') {
            $query->where('laporan.id_sub_akun_1', $sub);
        }
        
        $data = $query->get();
        // dd($data);
        $count = count($data);
        $jumlah = $data->sum('nominal');
        // dd($jumlah);

        $periode = '';
        if (
            ($karyawanRoles->count() == 1 && !$karyawanRoles->contains('kasir')) ||
                (isset($selectedRole) && $selectedRole != 'kasir')) {
            if ($filterBulan != 'Semua' && $filterTahun != 'Semua') {
                $namaBulan = \Carbon\Carbon::createFromFormat('m', $filterBulan)->format('F');
                $periode = $namaBulan . ' ' . $filterTahun; // Gunakan titik (.) untuk menggabungkan string
            } elseif ($filterBulan == 'Semua') {
                $periode = $filterTahun;
            } elseif ($filterTahun == 'Semua') {
                $namaBulan = \Carbon\Carbon::createFromFormat('m', $filterBulan)->format('F');
                $periode = $namaBulan;
            } else {
                $periode = 'Semua';
            }
        } else {
            $periode = $filterDate;
        }

        $pdf = PDF::loadView('print.print_pdf', compact('data', 'selectedSubAkun', 'selectedAkun', 'selectedUsaha', 'filterBulan', 'filterTahun', 'pemasukanBelumActive', 'count', 'jumlah', 'filterDate', 'periode'));
        $pdf->setPaper('A4', 'landscape');
        if ($pemasukanBelumActive == true) {
        return $pdf->stream('Print Pemasukan'. '-' .'Belum Dicek'. '-'. $selectedUsaha . '-'. $periode .'.pdf');
        } else {
            return $pdf->stream('Print Pemasukan'. '-' .'Sudah Dicek'. '-'. $selectedUsaha . '-'. $periode .'.pdf');
        }
        // Generate the PDF
        // return $pdf->download('Print Pemasukan.pdf');
    }

    public function index(Request $request)
    {

        $tahun_get = Laporan::distinct()
            ->selectRaw('YEAR(tanggal_laporan) as tahun')
            ->get();

        $filterDaterange = \Carbon\Carbon::now()->format('Y-m-d');
        $selectedRole = session('selectedRole');
        $karyawanRoles = session('karyawanRoles');
        // buat ambil rute yang aktif
        $pemasukanBelumActive = $request->url() == route('pemasukan_blm');
        // Simpan nilai $pemasukanBelumActive dalam sesi
        session(['pemasukanBelumActive' => $pemasukanBelumActive]);
   
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

        if (($karyawanRoles->count() == 1 && $karyawanRoles->contains('kasir')) || $selectedRole == 'kasir') {
            $data->whereDate('laporan.tanggal_laporan', $filterDaterange);
        }

        if ((($karyawanRoles->count() == 1 && $karyawanRoles->contains('kasir')) || $selectedRole == 'kasir') &&
        $session != 'SEMUA') {
            $data->where('usaha.id_usaha', session('id_usaha'));
        }
        
        $data = $data->get();
        $active_page = "PEMASUKAN";
        return view('contents.pemasukan', compact('tahun_get', 'active_page', 'data', 'akunOptions', 'kodeLaporan', 'pemasukanBelumActive', 'usahaOption'));
    }

    public function pemasukan(Request $request)
    {
        $tahun_get = Laporan::distinct()
            ->selectRaw('YEAR(tanggal_laporan) as tahun')
            ->get();

        $idKaryawan = session('id_karyawan');

        $pemasukanBelumActive = $request->url() == route('pemasukan_blm');
        // Simpan nilai $pemasukanBelumActive dalam sesi
        session(['pemasukanBelumActive' => $pemasukanBelumActive]);
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

        $selectedRole = session('selectedRole');
        $karyawanRoles = session('karyawanRoles');
        $session = session('nama_usaha');

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
        ->where('laporan.status_cek', 'Sudah Dicek')
        ->where('klasifikasi_laporan', 'Pemasukan')
        ->orderBy('laporan.tanggal_laporan', 'desc');

        if ((($karyawanRoles->count() == 1 && $karyawanRoles->contains('kasir')) || $selectedRole == 'kasir') &&
        $session != 'SEMUA') {
            $data->where('usaha.id_usaha', session('id_usaha'));
        }
        
        $data = $data->get();
        $active_page = "PEMASUKAN";
        return view('contents.pemasukan', compact('tahun_get', 'active_page', 'data', 'akunOptions', 'pemasukanBelumActive', 'usahaOption'));
    }


    public function simpanPemasukan(Request $request) {
        $selectedRole = session('selectedRole');
        $karyawanRoles = session('karyawanRoles');
        $session = session('nama_usaha');

        // Validation rules
        $rules = [
            'id_akun' => 'required',
            'gambar_bukti' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the file types and size as needed
            
        ];

        // Custom error messages
        $customMessages = [
            'id_akun.required' => 'Akun harus diisi.',
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

            if ((($karyawanRoles->count() == 1 && $karyawanRoles->contains('kasir')) || $selectedRole == 'kasir') &&
            $session != 'SEMUA') {
                $pemasukan->id_usaha = session('id_usaha');
            } else {
                $pemasukan->id_usaha = $request->input('id_usaha');
            }
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
            $pemasukan->nominal = str_replace(".", "", $request->input('nominal'));
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

    public function ambilAkunn($id_usaha)
    {
        // Cari ID akun berdasarkan nama akun
        $id_usaha = Akun::where('id_usaha', $id_usaha)->value('id_usaha');
        $id_klasifikasi = KlasifikasiLaporan::where('klasifikasi_laporan', 'Pemasukan')->value('id_klasifikasi');

        // Ambil data sub_akun_1 berdasarkan id_usaha yang sesuai
        $ambilAkunn = DB::table('akun')->where('id_usaha', $id_usaha)->where('id_klasifikasi', $id_klasifikasi)->pluck('akun', 'id_akun');

        return response()->json($ambilAkunn);
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
        $selectedRole = session('selectedRole');
        $karyawanRoles = session('karyawanRoles');
        $session = session('nama_usaha');
        $filterDaterange = \Carbon\Carbon::now()->format('Y-m-d');
        $query = Laporan::join('klasifikasi_laporan', 'klasifikasi_laporan.id_klasifikasi', '=', 'laporan.id_klasifikasi')
        ->where('klasifikasi_laporan', 'Pemasukan')
        ->where('status_cek', 'Belum dicek');

        if (($karyawanRoles->count() == 1 && $karyawanRoles->contains('kasir')) || $selectedRole == 'kasir') {
            $query->whereDate('laporan.tanggal_laporan', $filterDaterange);
        }

        if ((($karyawanRoles->count() == 1 && $karyawanRoles->contains('kasir')) || $selectedRole == 'kasir') &&
        $session != 'SEMUA') {
            $query->where('laporan.id_usaha', session('id_usaha'));
        }

        $jumlahBelumDicek = $query->count();

        return response()->json(['jumlah' => $jumlahBelumDicek]);
    }


    public function getJumlahSudahDicek()
    {
        $selectedRole = session('selectedRole');
        $karyawanRoles = session('karyawanRoles');
        $session = session('nama_usaha');
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');
        $query = Laporan::join('klasifikasi_laporan', 'klasifikasi_laporan.id_klasifikasi', '=', 'laporan.id_klasifikasi')
        ->where('klasifikasi_laporan', 'Pemasukan')
        ->whereMonth('tanggal_laporan', $currentMonth)
        ->whereYear('tanggal_laporan', $currentYear)
        ->where('status_cek', 'Sudah dicek');

        if ((($karyawanRoles->count() == 1 && $karyawanRoles->contains('kasir')) || $selectedRole == 'kasir') &&
        $session != 'SEMUA') {
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
            $tanggalLaporan = Carbon::parse($request->input('tanggal_cek'));
            $laporan->tanggal_cek = $tanggalLaporan;
            $laporan->save();
            
            return redirect()->route('pemasukan_blm')->with('success', 'Data Laporan Berhasil Dicek'); // Gantilah dengan route yang sesuai
        } else {
            return redirect()->back()->with('error', 'Laporan tidak ditemukan');
        }
    } 

    public function getPemasukanByUsaha($dateAwal, $dateAkhir, $namaUsaha)
    {
        // $dateAwal=03-10-2023;
        $id_usaha = null;
        if ($dateAwal != 0) {
            $dateAwal = \Carbon\Carbon::createFromFormat('d-m-Y', $dateAwal)->format('Y-m-d');
            $dateAkhir = \Carbon\Carbon::createFromFormat('d-m-Y', $dateAkhir)->format('Y-m-d');

            if ($namaUsaha !== 'Semua') {
                $usahaNama = $namaUsaha;
                $id_usaha = Usaha::where('nama_usaha', $usahaNama)->value('id_usaha');
            }
            
            // $bulanAwal = \Carbon\Carbon::createFromFormat('Y-m-d', $dateAwal)->month;
            // $bulanAkhir = \Carbon\Carbon::createFromFormat('Y-m-d', $dateAkhir)->month;
        }
        
        // dd($bulanAwal);
        // dd($bulanAkhir);

            $query = Laporan::selectRaw('usaha.nama_usaha, DAY(tanggal_laporan) as day, MONTH(tanggal_laporan) as bulan, SUM(nominal) as total_nominal')
                ->join('usaha', 'usaha.id_usaha', '=', 'laporan.id_usaha')
                ->join('klasifikasi_laporan', 'klasifikasi_laporan.id_klasifikasi', '=', 'laporan.id_klasifikasi')
                ->where('klasifikasi_laporan.klasifikasi_laporan', '=', 'Pemasukan')
                ->where('laporan.status_cek', '=', 'Belum Dicek');
                if ($id_usaha !== null) {
                    $query->where('laporan.id_usaha', '=', $id_usaha);
                }

                $query->when($dateAkhir != 0, function ($query) use ($dateAwal, $dateAkhir) {
                    $query->whereDate('tanggal_laporan', '>=', $dateAwal)
                        ->whereDate('tanggal_laporan', '<=', $dateAkhir);
                });
            
                $query->groupBy('usaha.nama_usaha', 'day', 'bulan');
                $data = $query->get();
        

        return response()->json($data);
    }

    public function getPemasukanByAkun($dateAwal, $dateAkhir, $namaUsaha, $namaAkun)
{
    // inisialisasi variable id_usaha dan id_akun
    $id_usaha = null;
    $id_akun = null;

    if ($dateAwal != 0) {
        $dateAwal = \Carbon\Carbon::createFromFormat('d-m-Y', $dateAwal)->format('Y-m-d');
        $dateAkhir = \Carbon\Carbon::createFromFormat('d-m-Y', $dateAkhir)->format('Y-m-d');

        // $bulanAwal = \Carbon\Carbon::createFromFormat('Y-m-d', $dateAwal)->month;
        // $bulanAkhir = \Carbon\Carbon::createFromFormat('Y-m-d', $dateAkhir)->month;

        // jika bukan "semua", cari id_usaha
        if ($namaUsaha !== 'semua') {
            $usahaNama = $namaUsaha;
            $id_usaha = Usaha::where('nama_usaha', $usahaNama)->value('id_usaha');
        }

        // jika bukan "semua", cari id_akun
        if ($namaAkun !== 'semua') {
            $akunNama = $namaAkun;
            $id_akun = Akun::where('akun', $akunNama)->value('id_akun');
        }
    }

    $query = Laporan::
        selectRaw('usaha.nama_usaha, DAY(tanggal_laporan) as day, MONTH(tanggal_laporan) as bulan, SUM(nominal) as total_nominal, akun.akun')
        ->join('usaha', 'usaha.id_usaha', '=', 'laporan.id_usaha')
        ->join('akun', 'akun.id_akun', '=', 'laporan.id_akun')
        ->join('klasifikasi_laporan', 'klasifikasi_laporan.id_klasifikasi', '=', 'laporan.id_klasifikasi')
        ->where('klasifikasi_laporan.klasifikasi_laporan', '=', 'Pemasukan')
        ->where('laporan.status_cek', '=', 'Belum Dicek');

    // jika bukan "Semua", tambahkan where laporan.id_usaha
    if ($id_usaha !== null) {
        $query->where('laporan.id_usaha', '=', $id_usaha);
    }

    // jika bukan "Semua", tambahkan where laporan.id_akun
    if ($id_akun !== null) {
        $query->where('laporan.id_akun', '=', $id_akun);
    }

    $query->when($dateAkhir != 0, function ($query) use ($dateAwal, $dateAkhir) {
        $query->whereDate('tanggal_laporan', '>=', $dateAwal)
            ->whereDate('tanggal_laporan', '<=', $dateAkhir);
    });

    $query->groupBy('usaha.nama_usaha', 'day', 'bulan', 'akun.akun');
    $data = $query->get();

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
