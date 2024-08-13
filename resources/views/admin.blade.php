<!doctype html>
<html lang="en">
<!-- Deklarasi tipe dokumen HTML5 dan set bahasa dokumen ke Inggris -->
<head>
    <meta charset="utf-8">
    <!-- Menentukan set karakter dokumen adalah UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Mengatur viewport agar sesuai dengan lebar perangkat dan skala awal 1 -->
    <title>Add new feed</title>
    <!-- Judul dokumen yang muncul di tab browser -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Menyertakan file CSS Bootstrap dari CDN -->
</head>
<body>
<!-- Awal dari isi dokumen yang akan ditampilkan di browser -->

<div class="bg-dark py-3">
    <!-- Div dengan background gelap dan padding vertical 3 -->
    <div class="container">
        <!-- Div container untuk mengatur layout responsif -->
        <div class="row align-items-center justify-content-center">
            <!-- Baris dengan item yang disejajarkan dan dijustifikasi di tengah -->
            <div class="col-md-auto">
                <!-- Kolom dengan lebar otomatis pada breakpoint medium -->
                <h3 class="text-white">Add new feed</h3>
                <!-- Judul dengan teks putih -->
            </div>
            <div class="col-md text-end">
                <!-- Kolom yang diratakan ke kanan pada breakpoint medium -->
                <ul class="nav justify-content-end">
                    <!-- Daftar navigasi yang diratakan ke kanan -->
                    <li class="nav-item dropdown">
                        <!-- Item navigasi dengan dropdown -->
                        @if(Auth::check())
                        <!-- Blade directive untuk mengecek autentikasi pengguna -->
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                    <!-- Tautan dropdown dengan nama pengguna yang sedang login -->
                    </a>
                        @endif                                               
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <!-- Menu dropdown yang diratakan ke kanan -->
                            <a class="dropdown-item" href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                                <!-- Tautan ke halaman profil pengguna -->
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                                <!-- Tautan untuk logout dengan aksi JavaScript untuk submit form logout -->
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                <!-- Form logout yang disembunyikan -->
                                @csrf
                                <!-- Token CSRF untuk keamanan -->
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>  
  
<div class="container">   
    <!-- Div container untuk mengatur layout responsif -->
    <div class="row justify-content-center mt-4">
        <!-- Baris yang dijustifikasi ke tengah dengan margin top 4 -->
        <div class="col-md-10 d-flex justify-content-end">
            <!-- Kolom dengan lebar 10 pada breakpoint medium, dengan flexbox yang diratakan ke kanan -->
            <a href="{{ route('feed') }}" class="btn btn-dark">Back</a>
            <!-- Tautan ke halaman feed dengan tombol berwarna gelap -->
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <!-- Baris dengan flexbox yang dijustifikasi ke tengah -->
        <div class="col-md-10">
            <!-- Kolom dengan lebar 10 pada breakpoint medium -->
            <div class="card borde-0 shadow-lg my-4">
                <!-- Kartu dengan border 0, bayangan besar, dan margin vertical 4 -->
                <div class="card-header bg-dark">
                    <!-- Header kartu dengan background gelap -->
                    <h3 class="text-white">Add Feed</h3>
                    <!-- Judul dengan teks putih -->
                </div>
                <form enctype="multipart/form-data" action="{{ route('add') }}" method="post">
                    <!-- Form untuk mengunggah data dengan multipart/form-data, mengirim data ke rute 'add' dengan metode POST -->
                    @csrf
                    <!-- Token CSRF untuk keamanan -->
                    <div class="card-body">
                        <!-- Isi kartu -->
                        <div class="mb-3">
                            <!-- Div dengan margin bottom 3 -->
                            <label for="" class="form-label h5">Nama</label>
                            <!-- Label untuk input nama -->
                            <input value="{{ old('nama') }}" type="text" class="@error('nama') is-invalid @enderror form-control form-control-lg" placeholder="Nama" name="nama">
                            <!-- Input teks untuk nama, dengan nilai lama jika ada kesalahan, serta kelas untuk validasi -->
                            @error('nama')
                                <p class="invalid-feedback">{{ $message }}</p>
                                <!-- Pesan kesalahan jika ada validasi yang gagal -->
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="daerah_id" class="form-label h5">Daerah</label>
                            <!-- Label untuk input daerah -->
                            <select id="daerah_id" value="{{ old('daerah') }}" type="text" class="@error('daerah') is-invalid @enderror form-control form-control-lg" placeholder="Daerah" name="daerah_id">
                                <!-- Select untuk memilih daerah dengan opsi nilai lama jika ada kesalahan -->
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
                            </select>
                            @error('daerah')
                                <p class="invalid-feedback">{{ $message }}</p>
                                <!-- Pesan kesalahan jika ada validasi yang gagal -->
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label h5">Deskripsi</label>
                            <!-- Label untuk input deskripsi -->
                            <textarea placeholder="deskripsi" class="form-control" name="deskripsi" cols="30" rows="5">{{ old('deskripsi') }}</textarea>
                            <!-- Textarea untuk deskripsi dengan nilai lama jika ada kesalahan -->
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label h5">Resep</label>
                            <!-- Label untuk input resep -->
                            <textarea placeholder="Resep" class="form-control" name="resep" cols="30" rows="5"></textarea>
                            <!-- Textarea untuk resep -->
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label h5">Panduan</label>
                            <!-- Label untuk input panduan -->
                            <textarea placeholder="Panduan" class="form-control" name="panduan" cols="30" rows="5"></textarea>
                            <!-- Textarea untuk panduan -->
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label h5">Image</label>
                            <!-- Label untuk input gambar -->
                            <input type="file" class="form-control form-control-lg" placeholder="input" name="image">
                            <!-- Input file untuk mengunggah gambar -->
                        </div>
                        <div class="d-grid">
                            <!-- Div untuk mengatur grid -->
                            <button class="btn btn-lg btn-primary">Submit</button>
                            <!-- Tombol submit dengan kelas button besar dan warna primer -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 
<script src="js/jquery-3.4.1.min.js"></script>
<!-- Menyertakan file JavaScript jQuery dari direktori lokal -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<!-- Menyertakan file JavaScript Popper.js dari CDN -->
<script src="js/bootstrap.js"></script>
<!-- Menyertakan file JavaScript Bootstrap dari direktori lokal -->
</body>
</html>
<!-- Akhir dari dokumen HTML -->
```