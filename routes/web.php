<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataUsahaController;
use App\Http\Controllers\DataKaryawanController;
use App\Http\Controllers\ExcelAkunController;
use App\Http\Controllers\ExcelPemasukanAccController;
use App\Http\Controllers\ExcelPemasukanBelumAccController;
use App\Http\Controllers\ExcelPengeluaranAccController;
use App\Http\Controllers\ExcelPengeluaranBelumAccController;
use App\Http\Controllers\LaporanPemasukanController;
use App\Http\Controllers\KlasifikasiLaporanController;
use App\Http\Controllers\LabaRugiController;
use App\Http\Controllers\LaporanPengeluaranController;
use App\Models\KlasifikasiLaporan;
use App\Http\Controllers\PdfPemasukanController;
use App\Http\Controllers\PdfPengeluaranController;
use App\Http\Controllers\PrintLaporanPemasukan;
use App\Http\Controllers\PrintLaporanPengeluaran;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('contents.dashboard');
// });

// Route::get('/klasifikasi_akun', function () {
//     return view('contents.klasifikasi')->name('klasifikasi_akun');
// });

Route::get('/login2/{userId}', [LoginController::class, 'login2'])->name('login2');
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::get('/select-role/{role}', [DataKaryawanController::class, 'selectRole'])->name('selectRole');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::group(['middleware' => 'role:manajer|kasir|owner'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/pemasukan', [LaporanPemasukanController::class, 'index'])->name('pemasukan_blm');
    Route::get('/pemasukan/acc', [LaporanPemasukanController::class, 'pemasukan'])->name('pemasukan_sdh');
    Route::get('/pengeluaran', [LaporanPengeluaranController::class, 'index'])->name('pengeluaran_blm');
    Route::get('/pengeluaran/acc', [LaporanPengeluaranController::class, 'pengeluaran'])->name('pengeluaran_sdh');
    Route::post('/tambah-pemasukan', [LaporanPemasukanController::class, 'simpanPemasukan'])->name('tambah.pemasukan');
    Route::post('/acc-pemasukan/{id_laporan}', [LaporanPemasukanController::class, 'accPemasukan'])->name('acc.pemasukan');
    Route::post('/acc-pengeluaran/{id_laporan}', [LaporanPengeluaranController::class, 'accPengeluaran'])->name('acc.pengeluaran');
    Route::get('/get-sub-akun-1-options/{akun}', [LaporanPemasukanController::class, 'getSubAkun1Options']);
    Route::get('/get-akunn-select/{id_usaha}', [LaporanPemasukanController::class, 'ambilAkunn']);
    Route::get('/get-sub-akun-1-select/{id_akun}', [LaporanPemasukanController::class, 'ambilSubAkun1']);
    Route::get('/get-sub-akun-2-select/{id_sub_akun_1}', [LaporanPemasukanController::class, 'ambilSubAkun2']);
    Route::get('/get-sub-akun-3-select/{id_sub_akun_2}', [LaporanPemasukanController::class, 'ambilSubAkun3']);
    Route::get('/get-akun-options/{klasifikasi_laporan}', [LaporanPengeluaranController::class, 'getAkunPengeluaran']);
    Route::get('/get-akun-filter/{nama_usaha}', [LaporanPemasukanController::class, 'getAkun']);
    Route::get('/get-sub1-filter/{akun}', [LaporanPemasukanController::class, 'getSub1']);
    Route::get('/get-akun-pengeluaran/{klasifikasi_laporan}', [LaporanPengeluaranController::class, 'getPengeluaranAkun']);
    Route::get('/ambil-akun-pengeluaran/{id_klasifikasi}', [LaporanPengeluaranController::class, 'getPengeluaranAkunn']);
    Route::get('/get-sub-akun-1-options/{id_akun}', [LaporanPengeluaranController::class, 'getSubAkun1Pengeluaran']);
    Route::get('/get-sub1-pengeluaran/{akun}', [LaporanPengeluaranController::class, 'getSubAkun1Filter']);
    Route::get('/pemasukan-belum-cek', [LaporanPemasukanController::class, 'getJumlahBelumDicek'])->name('get-jumlah-belum-dicek');
    Route::get('/pemasukan-sudah-cek', [LaporanPemasukanController::class, 'getJumlahSudahDicek'])->name('get-jumlah-sudah-dicek');
    Route::get('/pengeluaran-belum-cek', [LaporanPengeluaranController::class, 'getJumlahBelumDicek'])->name('pengeluaran-belum-cek');
    Route::get('/pengeluaran-sudah-cek', [LaporanPengeluaranController::class, 'getJumlahSudahDicek'])->name('pengeluaran-sudah-cek');
    Route::post('/tambah-pengeluaran', [LaporanPengeluaranController::class, 'simpanPengeluaran'])->name('tambah.pengeluaran');
    Route::get('/get-akun-opsi/{id_klasifikasi}', [LaporanPengeluaranController::class, 'ambilAkun']);
    Route::get('/get-sub-akun-1-opsi/{id_akun}', [LaporanPengeluaranController::class, 'ambilSubAkun1']);
    Route::get('/get-sub-akun-2-opsi/{id_sub_akun_1}', [LaporanPengeluaranController::class, 'ambilSubAkun2']);
    Route::get('/get-sub-akun-3-opsi/{id_sub_akun_2}', [LaporanPengeluaranController::class, 'ambilSubAkun3']);
    Route::get('/get-last-report-number/{selectedKlasifikasi}', 'LaporanPengeluaranController@getLastReportNumber');
    Route::get('/getPemasukan/{dateAwal}/{dateAkhir}/{namaUsaha}', [LaporanPemasukanController::class, 'getPemasukanByUsaha']);
    Route::get('/getPemasukan/{dateAwal}/{dateAkhir}/{namaUsaha}/{namaAkun}', [LaporanPemasukanController::class, 'getPemasukanByAkun']);
    Route::post('/getPemasukanByUsaha', 'LaporanPemasukanController@getPemasukanByUsaha1');
    Route::get('/getPemasukanByUsaha', 'LaporanPemasukanController@getPemasukanByUsaha');

    Route::get('/print_laporan_pemasukan/{id}', [PrintLaporanPemasukan::class, 'print_laporan_pemasukan'])->name('print_laporan_pemasukan');
    Route::get('/print_laporan_pemasukan_a4/{id}', [PrintLaporanPemasukan::class, 'print_laporan_pemasukan_a4'])->name('print_laporan_pemasukan_a4');

    Route::get('/print_laporan_pengeluaran/{id}', [PrintLaporanPengeluaran::class, 'print_laporan_pengeluaran'])->name('print_laporan_pengeluaran');
    Route::get('/print_laporan_pengeluaran_a4/{id}', [PrintLaporanPengeluaran::class, 'print_laporan_pengeluaran_a4'])->name('print_laporan_pengeluaran_a4');

    Route::post('/cetak-laporan', [LaporanPemasukanController::class, 'cetakLaporan'])->name('cetak.laporan');
    Route::post('/cetak-laporan-pengeluaran', [LaporanPengeluaranController::class, 'cetakLaporan'])->name('cetak.laporan.pengeluaran');

    Route::get('/print_laporan_pengeluaran/{id}', [PrintLaporanPengeluaran::class, 'print_laporan_pengeluaran'])->name('print_laporan_pengeluaran');
    Route::get('/print_laporan_pengeluaran_a4/{id}', [PrintLaporanPengeluaran::class, 'print_laporan_pengeluaran_a4'])->name('print_laporan_pengeluaran_a4');

    Route::post('/cetak-laporan', [LaporanPemasukanController::class, 'cetakLaporan'])->name('cetak.laporan');
    Route::get('/data-detail-karyawan/{id_karyawan}', [DataKaryawanController::class, 'detail'])->name('detail.karyawan');
    Route::post('/edit-karyawan/{id_karyawan}', [DataKaryawanController::class, 'update'])->name('update.karyawan');
    Route::post('/upload-karyawan/{id_karyawan}', [DataKaryawanController::class, 'uploadFoto'])->name('upload.foto');
    Route::post('/update-password/{id_karyawan}', [DataKaryawanController::class, 'proses_ubah_password'])->name('update.password');

    Route::get('/export-excel-pemasukan-acc', [ExcelPemasukanAccController::class, 'exportData'])->name('export.excel-pemasukan-acc');
    Route::get('/export-excel-pemasukan-belum-acc', [ExcelPemasukanBelumAccController::class, 'exportData'])->name('export.excel-pemasukan-belum-acc');
    Route::get('/export-excel-pengeluaran-acc', [ExcelPengeluaranAccController::class, 'exportData'])->name('export.excel-pengeluaran-acc');
    Route::get('/export-excel-pengeluaran-belum-acc', [ExcelPengeluaranBelumAccController::class, 'exportData'])->name('export.excel-pengeluaran-belum-acc');
});

Route::group(['middleware' => 'role:owner'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/laba_rugi', [LabaRugiController::class, 'laba_rugi'])->name('laba_rugi');

    Route::get('/akun', [KlasifikasiLaporanController::class, 'index'])->name('akun');
    Route::get('/tambah-klasifikasi-akun', [KlasifikasiLaporanController::class, 'index'])->name('tambah.klasifikasi-akun');
    Route::post('/tambah-akun', [KlasifikasiLaporanController::class, 'simpanAkun'])->name('tambah.akun');
    Route::delete('/hapus-akun/{id_key}', [KlasifikasiLaporanController::class, 'HapusData'])->name('hapus.akun');
    Route::get('/data-usaha', [DataUsahaController::class, 'index'])->name('usaha');
    Route::post('/tambah-usaha', [DataUsahaController::class, 'simpanData'])->name('tambah.usaha');
    Route::post('/edit-usaha/{id}', [DataUsahaController::class, 'editData'])->name('edit.usaha');
    Route::delete('/hapus-usaha/{id}', [DataUsahaController::class, 'HapusData'])->name('hapus.usaha');
    Route::get('/data-karyawan', [DataKaryawanController::class, 'index'])->name('karyawan');
    Route::post('/tambah-karyawan', [DataKaryawanController::class, 'simpanData'])->name('tambah.karyawan');
    Route::delete('/hapus-karyawan/{id_karyawan}', [DataKaryawanController::class, 'delete'])->name('hapus.karyawan');
});


Route::get('/filter_laba_rugi', [LabaRugiController::class, 'filter_laba_rugi'])->name('filter_laba_rugi');
