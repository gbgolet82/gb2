<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Usaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        $active_page = "LOGIN";
        return view('auth.login',compact('active_page'));
    }

    public function login2($userId) {
        

        $user = Karyawan::find($userId);
        // dd($user);
    
        if (!$user) {
            return redirect()->route('login'); 
        }
    
        // Retrieve the user's roles here.
        $roles = ['kasir', 'manajer', 'owner'];
        $karyawanRoles = collect($roles)->filter(function ($role) use ($user) {
            return $user->$role == 1;
        });

        
    
        return view('auth.login2', ['karyawanRoles' => $karyawanRoles]);
    }
    

    public function login(Request $request)
    {
        // dd('baba');
        $phone = $request->input('nohp');
        $password = $request->input('password');

        $karyawan = Karyawan::where('nohp', $phone)->first();
        // dd($karyawan);

        if (!$karyawan || !Hash::check($password, $karyawan->password)) {
            return redirect()->back()->withErrors(['error' => 'Invalid phone number or password']);
        }

        // Check the user's roles.
        $roles = ['kasir', 'manajer', 'owner'];
        $karyawanRoles = collect($roles)->filter(function ($role) use ($karyawan) {
            return $karyawan->$role == 1;
        });
        session(['karyawanRoles' => $karyawanRoles]);
        session()->save(); // Simpan data sesi
        // dd($karyawanRoles);

        session(['nama' => $karyawan->nama, 'nohp' => $karyawan->nohp, 'id_usaha' => $karyawan->id_usaha, 'id_karyawan' => $karyawan->id_karyawan]);
        session()->save();

        // Ambil id_usaha dari sesi
        $idUsaha = session('id_usaha');
        session(['id_usaha' => $idUsaha]);
        session()->save();
        // dd($idUsaha);

        $namaUsaha = Usaha::where('id_usaha', $idUsaha)->value('nama_usaha');

        // Simpan nama usaha dalam session
        session(['nama_usaha' => $namaUsaha]);

       

        if ($karyawanRoles->count() == 1) {
            $role = $karyawanRoles->first();
            return redirect()->route('dashboard');
            // return redirect()->route($role . '.dashboard');
        }

        $userId = $karyawan->id_karyawan;
        // dd($userId);

        return redirect()->route('login2', ['userId' => $userId]);


    }

    
    public function logout(Request $request)
{
    session()->forget('selectedRole'); // Remove the 'selectedRole' session
    $karyawanRoles = session('karyawanRoles', collect());
    
    // Ambil id_karyawan dari sesi yang sedang berlangsung
    $id_karyawan = session('id_karyawan');
    
    if ($karyawanRoles->count() == 1) {
        return redirect()->route('login');
    } elseif ($karyawanRoles->count() > 1) {
        return redirect()->route('login2', ['userId' => $id_karyawan]);
    } else {
        return redirect()->route('login');
    }
}
}
