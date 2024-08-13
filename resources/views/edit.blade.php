<!doctype html>
<html lang="en">
<!-- Deklarasi tipe dokumen HTML5 dan set bahasa dokumen ke Inggris -->
  <head>
    <meta charset="utf-8">
    <!-- Menentukan set karakter dokumen adalah UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Mengatur viewport agar sesuai dengan lebar perangkat dan skala awal 1 -->
    <title>feed</title>
    <!-- Judul dokumen yang muncul di tab browser -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Menyertakan file CSS Bootstrap dari CDN -->
  </head>
  <body>
  <!-- Awal dari isi dokumen yang akan ditampilkan di browser -->

    <div class="bg-dark py-3">
    <!-- Div dengan background gelap dan padding vertikal 3 -->
        <h3 class="text-white text-center">Edit feed</h3>
        <!-- Judul dengan teks putih yang diratakan ke tengah -->
    </div>
    <div class="container">
    <!-- Div container untuk mengatur layout responsif -->
        <div class="row justify-content-center mt-4">
        <!-- Baris yang dijustifikasi ke tengah dengan margin top 4 -->
            <div class="col-md-10 d-flex justify-content-end">
            <!-- Kolom dengan lebar 10 pada breakpoint medium, dengan flexbox yang diratakan ke kanan -->
                <a href="{{ route('feed') }}" class="btn btn-dark">Back</a>
                <!-- Tautan untuk kembali ke halaman feed dengan tombol berwarna gelap -->
            </div>
        </div>
        <div class="row d-flex justify-content-center">
        <!-- Baris dengan flexbox yang dijustifikasi ke tengah -->
            <div class="col-md-10">
            <!-- Kolom dengan lebar 10 pada breakpoint medium -->
                <div class="card border-0 shadow-lg my-4">
                <!-- Kartu dengan border 0, bayangan besar, dan margin vertikal 4 -->
                    <div class="card-header bg-dark">
                    <!-- Header kartu dengan background gelap -->
                        <h3 class="text-white">Edit Feed</h3>
                        <!-- Judul dengan teks putih -->
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('update',$makanan->id) }}" method="post">
                    <!-- Form dengan enctype multipart/form-data untuk mengirim file, action untuk update makanan -->
                        @method('put')
                        <!-- Menggunakan metode HTTP PUT untuk update data -->
                        @csrf
                        <!-- Token CSRF untuk keamanan -->
                        <div class="card-body">
                        <!-- Isi kartu -->
                            <div class="mb-3">
                            <!-- Margin bottom 3 -->
                                <label for="" class="form-label h5">Nama</label>
                                <!-- Label dengan ukuran font H5 -->
                                <input value="{{ old('nama',$makanan->nama) }}" type="text" class="@error('nama') is-invalid @enderror form-control form-control-lg" placeholder="Nama" name="nama">
                                <!-- Input teks dengan nilai lama atau nilai dari data makanan, dengan validasi error -->
                                @error('nama')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    <!-- Pesan error jika validasi gagal -->
                                @enderror
                            </div>
                            <div class="mb-3">
                            <!-- Margin bottom 3 -->
                                <label for="daerah_id" class="form-label h5">Daerah</label>
                                <!-- Label dengan ukuran font H5 -->
                                <select id="daerah_id" value="{{ old('daerah') }}" type="text" class="@error('daerah') is-invalid @enderror form-control form-control-lg" placeholder="Daerah" name="daerah_id">
                                <!-- Dropdown select dengan nilai lama atau nilai dari data makanan, dengan validasi error -->
                                    <option value="1">Sumatra</option>
                                    <!-- Opsi Sumatra -->
                                    <option value="2">Jawa</option>
                                    <!-- Opsi Jawa -->
                                    <option value="3">Kalimantan</option>
                                    <!-- Opsi Kalimantan -->
                                    <option value="4">Sulawesi</option>
                                    <!-- Opsi Sulawesi -->
                                    <option value="5">Papua</option>
                                    <!-- Opsi Papua -->
                                    @error('daerah')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                        <!-- Pesan error jika validasi gagal -->
                                    @enderror
                                </select>
                            </div>
                            <div class="mb-3">
                            <!-- Margin bottom 3 -->
                                <label for="" class="form-label h5">Deskripsi</label>
                                <!-- Label dengan ukuran font H5 -->
                                <textarea placeholder="deskripsi" class="form-control" name="deskripsi" cols="30" rows="5">{{ $makanan->deskripsi }}</textarea>
                                <!-- Textarea dengan nilai dari data makanan -->
                            </div>
                            <div class="mb-3">
                            <!-- Margin bottom 3 -->
                                <label for="" class="form-label h5">Resep</label>
                                <!-- Label dengan ukuran font H5 -->
                                <textarea placeholder="Resep" class="form-control" name="resep" cols="30" rows="5">{{ $makanan->resep }}</textarea>
                                <!-- Textarea dengan nilai dari data makanan -->
                            </div>
                            <div class="mb-3">
                            <!-- Margin bottom 3 -->
                                <label for="" class="form-label h5">Panduan</label>
                                <!-- Label dengan ukuran font H5 -->
                                <textarea placeholder="Panduan" class="form-control" name="panduan" cols="30" rows="5">{{ $makanan->panduan }}</textarea>
                                <!-- Textarea dengan nilai dari data makanan -->
                            </div>
                            <div class="mb-3">
                            <!-- Margin bottom 3 -->
                                <label for="" class="form-label h5">Image</label>
                                <!-- Label dengan ukuran font H5 -->
                                <input type="file" class="form-control form-control-lg" placeholder="input" name="image">
                                <!-- Input file untuk mengunggah gambar -->
                                @if ($makanan->image !="")
                                <!-- Mengecek apakah data makanan memiliki gambar -->
                                    <img class="w-50 my-3" src="{{ asset('images/' . $makanan->image) }}" alt="">
                                    <!-- Menampilkan gambar yang sudah ada dengan lebar 50% dan margin vertikal 3 -->
                                @endif
                            </div>
                            <div class="d-grid">
                            <!-- Menggunakan grid untuk tombol -->
                                <button class="btn btn-lg btn-primary">Update</button>
                                <!-- Tombol update dengan ukuran besar dan warna primer -->
                            </div>
                        </div>
                    </form>
                    <!-- Akhir form -->
                </div>
            </div>
        </div>
    </div>
  </body>
</html>
<!-- Akhir dari dokumen HTML -->
