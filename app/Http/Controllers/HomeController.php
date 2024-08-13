<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        // Periksa apakah pengguna telah terotentikasi
        if (Auth::check()) {
            $user = Auth::user();
            // Periksa apakah pengguna adalah admin
            if ($user->usertype == '0') {
                // Jika pengguna adalah user biasa, arahkan ke halaman home
                return view('home');
            } elseif ($user->usertype == '1') {
                // Jika pengguna adalah admin, arahkan ke halaman admin
                return view('admin');
            }
        } 
        
        // Jika pengguna belum terotentikasi atau tidak memiliki tipe yang sesuai, arahkan ke halaman home
        return view('home');
    }
}
