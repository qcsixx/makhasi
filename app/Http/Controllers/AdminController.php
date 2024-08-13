<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Makanan;
use App\Models\Daerah;

class AdminController extends Controller
{
    public function feed()
    {
       //$makanan = Makanan::orderBy('created_at', 'DESC')->get();
       // return view('feed', ['makanan' => $makanan]);
       $makanan = Makanan::all();
        $daerah = Daerah::pluck('nama', 'id'); // Mengambil nama daerah dari tabel daerah

        return view('feed', ['makanan' => $makanan, 'daerah' => $daerah]);
    }
    

    public function admin()
    {
        return view('admin');
    }

    public function add(Request $request)
{
    // Memastikan bahwa gambar telah dipilih
    if (!$request->hasFile('image')) {
        return redirect()->back()->with('error', 'Pilih gambar terlebih dahulu.');
    }

    // Simpan gambar ke direktori penyimpanan
    $imageName = time() . '.' . $request->image->extension();
    $request->image->move(public_path('images'), $imageName);

    // Simpan data ke dalam database
    $makanan = new Makanan();
    $makanan->nama = $request->nama;
    $makanan->daerah_id = $request->daerah_id; // Menggunakan daerah_id
    $makanan->deskripsi = $request->deskripsi;
    $makanan->resep = $request->resep;
    $makanan->panduan = $request->panduan;
    $makanan->image = $imageName;
    $makanan->save();

    // Redirect kembali ke halaman admin dengan pesan sukses
    return redirect()->route('feed')->with('success', 'New feed berhasil disimpan!');
}

    

    public function edit($id)
    {
        $makanan = Makanan::find($id);
        return view('edit', ['makanan' => $makanan]);
    }

    public function update($id, Request $request)
    {
        $makanan = Makanan::find($id);
            // Memastikan bahwa gambar telah dipilih
            if (!$request->hasFile('image')) {
                return redirect()->back()->with('error', 'Pilih gambar terlebih dahulu.');
            }

        // Simpan gambar ke direktori penyimpanan
        $imageName = time() . '.' . $request->image->extension();
        $imageName = $request->image->getClientOriginalName();
        $request->image->move(public_path('images'), $imageName);
    
        // Hapus gambar lama dari direktori penyimpanan
        File::delete(public_path('images/' . $makanan->image));

        // Update data ke dalam database
        $makanan->nama = $request->nama;
        $makanan->daerah_id = $request->daerah_id;
        $makanan->deskripsi = $request->deskripsi;
        $makanan->resep = $request->resep;
        $makanan->panduan = $request->panduan;
        $makanan->image = $imageName;
        $makanan->save();
    
        // Redirect kembali ke halaman admin dengan pesan sukses
        return redirect()->route('feed')->with('success', 'Update berhasil disimpan!');
    }

    public function delete($id)
    {
        // Mengambil instance tunggal dari model Makanan berdasarkan ID
        $makanan = Makanan::find($id);
        
        // Periksa apakah instance Makanan ditemukan
        if ($makanan) {
            // Hapus gambar lama dari direktori penyimpanan
            File::delete(public_path('images/' . $makanan->image));
            
            // Hapus data dari database
            $makanan->delete();
    
            return redirect()->route('feed')->with('success', 'Feed berhasil didelete!');
        } else {
            // Handle jika instance Makanan tidak ditemukan
            return redirect()->route('feed')->with('error', 'Makanan tidak ditemukan.');
        }
    }
}
