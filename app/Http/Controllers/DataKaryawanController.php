<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DataKaryawanController extends Controller
{
    public function selectRole(Request $request, $role)
{
    // dd('baba');
    // Simpan peran yang dipilih dalam sesi
    session(['selectedRole' => $role]);
    session()->save();
    // dd($role);

    if ($role == 'owner') {
        return redirect()->route('dashboard'); // Arahkan ke halaman dashboard
    } else {
        return redirect()->route('pemasukan_blm'); // Arahkan ke halaman pemasukan
    }
}


    public function index()
    {
        $session = session('nama_usaha');
        $unit_usaha = DB::table('usaha')->orderBy('created_at', 'desc')->get();
        $karyawan = Karyawan::select('karyawan.*', 'usaha.nama_usaha')
        ->join('usaha', 'karyawan.id_usaha', '=', 'usaha.id_usaha')
        ->orderBy('karyawan.created_at', 'desc');

        if ($session != 'SEMUA') {
            $karyawan->where('usaha.id_usaha', session('id_usaha'));
        }
        
        $karyawan = $karyawan->get();

        $active_page = "DATA KARYAWAN";
        return view('contents.karyawan',compact('active_page', 'unit_usaha', 'karyawan'));
    }

    public function detail($id_karyawan){
        $unit_usaha = DB::table('usaha')->orderBy('created_at', 'desc')->get();
        $karyawan = Karyawan::select('karyawan.*', 'usaha.nama_usaha')
        ->join('usaha', 'karyawan.id_usaha', '=', 'usaha.id_usaha')
        ->where('karyawan.id_karyawan', $id_karyawan)
        ->first();
        // dd($karyawan);

        $active_page = "DETAIL KARYAWAN";
        return view('contents.detailkaryawan',compact('active_page', 'karyawan', 'unit_usaha'));
    }

    public function simpanData(Request $request)
    {
        // dd('ababab');
        // Validasi data
        $request->validate(
            [
                'nama' => 'required',
                'nohp' => 'required',
                'email' => 'required',
                'id_usaha' => 'required',
                'alamat' => 'required',
                'password' => 'required',
            ],
            [
                'nama.required' => 'Masukan nama',
                'nohp.required' => 'Masukan nomor hp',
                'email.required' => 'Masukan email',
                'id_usaha.required' => 'Pilih unit usaha',
                'alamat.required' => 'Masukan alamat',
                'password.required' => 'Masukan password',
            ]
        );

        // Mendapatkan nilai checkbox Role
        $role_manajer = $request->has('manajer') ? 1 : 0;
        $role_kasir = $request->has('kasir') ? 1 : 0;
        $role_owner = $request->has('owner') ? 1 : 0;

        // Simpan data ke dalam tabel
        $result = Karyawan::create([
            'id_karyawan' => Str::uuid(),
            'id_usaha' => $request->input('id_usaha'),
            'kode' => 'P-001',
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'password' => Hash::make($request->input('password')),
            'nohp' => $request->input('nohp'),
            'email' => $request->input('email'),
            'kasir' => $role_kasir,
            'manajer' => $role_manajer,
            'owner' => $role_owner,
            'status' => 'Aktif',
        ]);
        // dd($result);

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->to('/data-karyawan')->with('success', 'Data Karyawan berhasil disimpan.');
    }

    public function update(Request $request, $id_karyawan)
{
    // Validasi data
    // dd('baba');
    $request->validate([
        'nama' => 'required',
        'nohp' => 'required',
        'email' => 'required',
        'id_usaha' => 'required',
        'alamat' => 'required',
    ]);

    // Ambil data karyawan yang akan diupdate
    $karyawan = Karyawan::select('karyawan.*', 'usaha.nama_usaha')
        ->join('usaha', 'karyawan.id_usaha', '=', 'usaha.id_usaha')
        ->where('karyawan.id_karyawan', $id_karyawan)
        ->first();

    // Update data karyawan
    $karyawan->nama = $request->input('nama');
    $karyawan->nohp = $request->input('nohp');
    $karyawan->email = $request->input('email');
    $karyawan->id_usaha = $request->input('id_usaha');
    $karyawan->alamat = $request->input('alamat');

    // Update role (manajer, kasir, owner)
    $karyawan->manajer = $request->has('manajer') ? 1 : 0;
    $karyawan->kasir = $request->has('kasir') ? 1 : 0;
    $karyawan->owner = $request->has('owner') ? 1 : 0;

    // Simpan perubahan
    $karyawan->save();

    // Perbarui sesi pengguna dengan data yang diperbarui
    session([
        'nama' => $karyawan->nama,
        'nohp' => $karyawan->nohp,
        'email' => $karyawan->email,
        'alamat' => $karyawan->alamat,
        'id_usaha' => $karyawan->id_usaha,
        'id_karyawan' => $karyawan->id_karyawan,
    ]);

    // Redirect ke halaman yang sesuai
    return redirect()->to('/data-detail-karyawan/' . $karyawan->id_karyawan)->with('success', 'Data Karyawan berhasil diperbarui.');
}


    public function uploadFoto(Request $request, $id_karyawan)
    {
        // dd('baba');
        // Validasi request, pastikan hanya menerima file gambar
        $request->validate([
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan kebutuhan Anda
        ]);

        // Simpan file foto yang diunggah ke direktori yang sesuai
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('gambar/profil'), $fileName);

            DB::table('karyawan')
                ->where('id_karyawan', $id_karyawan)
                ->update(['foto' => $fileName]);

            // dd($fileName);

            return redirect()->back()->with('success', 'Foto profil berhasil diunggah.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah foto profil.');
    }

    public function proses_ubah_password(Request $request, $id_karyawan)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|same:password',
            ], [
            'password.required' => 'Password baru harus diisi.',
            'password_confirmation.required' => 'Konfirmasi password harus diisi.',
            'password.min' => 'Password baru minimal harus terdiri dari 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password_confirmation.same' => 'Konfirmasi password tidak cocok dengan password baru.',
            ]);

            $user = DB::table('karyawan')
            ->where('id_karyawan', $id_karyawan)
            ->update([
                'password' => Hash::make($request->password),
            ]);
        // $user = Karyawan::where('id_pengguna', Auth::user()->id_pengguna)->update([
        //     'password' => bcrypt($request->password),
        // ]);
        // dd($user);
        // Redirect or display success message
        return redirect()->back()->with('success', 'Password berhasil diubah.');
    }
}
