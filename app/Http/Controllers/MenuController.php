<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Makanan;
use App\Models\Daerah;

class MenuController extends Controller
{
  

    public function menu()
    {
       //$makanan = Makanan::orderBy('created_at', 'DESC')->get();
       // return view('feed', ['makanan' => $makanan]);
       $makanan = Makanan::all();
        $daerah = Daerah::pluck('nama', 'id'); // Mengambil nama daerah dari tabel daerah

        return view('menu', ['makanan' => $makanan, 'daerah' => $daerah]);
    }

    public function show($id)
    {
    $makanan = Makanan::findOrFail($id);
    return view('detail', compact('makanan'));
    }
    
}
