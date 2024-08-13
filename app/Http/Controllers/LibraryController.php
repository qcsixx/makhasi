<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function saveToLibrary(Request $request)
    {
        // Logika untuk menyimpan data ke dalam database
        // Misalnya: $request->input('judul') untuk mendapatkan judul yang dikirim dari halaman detail.blade.php

        // Setelah menyimpan, redirect ke halaman library.blade.php atau halaman lain yang sesuai
        return redirect()->route('library.index');
    }
}
