<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $roles)
{
    $karyawanRoles = session('karyawanRoles');
    $selectedRole = session('selectedRole');
    $allowedRoles = explode('|', $roles);
    // dd($karyawanRoles, $selectedRole, $allowedRoles);

    if ($karyawanRoles) {
        if ($karyawanRoles->count() === 1) {
            // Jika pengguna memiliki satu peran, cocokan dengan allowedRoles
            if ($karyawanRoles->first() && in_array($karyawanRoles->first(), $allowedRoles)) {
                return $next($request);
            }
        } elseif ($karyawanRoles->count() > 1 && $selectedRole) {
            // Jika pengguna memiliki lebih dari satu peran dan selectedRole ada
            // Cocokan selectedRole dengan allowedRoles
            if (in_array($selectedRole, $allowedRoles)) {
                return $next($request);
            }
        }
    }

    // Jika $karyawanRoles null atau tidak ada peran yang cocok, atur pesan alert
    session()->flash('alert', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    return redirect()->back(); // Arahkan ke halaman login
}

    

    
    

    

    



}
