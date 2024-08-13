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
                    <h3 class="text-white"> New Feed</h3>
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
            <a href="{{ route('admin') }}" class="btn btn-dark">Create</a>
            <!-- Tautan ke halaman admin dengan tombol berwarna gelap -->
        </div>
    </div>
        <div class="row d-flex justify-content-center">
        <!-- Baris dengan flexbox yang dijustifikasi ke tengah -->
            @if(Session::has('success'))
            <!-- Blade directive untuk mengecek apakah ada session sukses -->
                <div class="col-md-10">
                <!-- Kolom dengan lebar 10 pada breakpoint medium -->
                    <div class="alert alert-success">
                    <!-- Div dengan kelas alert untuk menampilkan pesan sukses -->
                        {{ Session::get('success') }}
                        <!-- Menampilkan pesan sukses dari session -->
                    </div>
                </div>
            @endif
            <div class="col-md-10">
            <!-- Kolom dengan lebar 10 pada breakpoint medium -->
                <div class="card borde-0 shadow-lg my-4">
                <!-- Kartu dengan border 0, bayangan besar, dan margin vertical 4 -->
                    <div class="card-header bg-dark">
                    <!-- Header kartu dengan background gelap -->
                        <h3 class="text-white">Feed</h3>
                        <!-- Judul dengan teks putih -->
                    </div>
                    <div class='card-body'>
                    <!-- Isi kartu -->
                        <div class="table-responsive">
                        <!-- Div untuk tabel yang responsif -->
                            <table class="table">
                            <!-- Tabel dengan kelas Bootstrap -->
                                <tr>
                                    <th class="col">ID</th>
                                    <th class="col">image</th>
                                    <th class="col">Nama</th>
                                    <th class="col">Daerah</th>
                                    <th class="col">Deskripsi</th>
                                    <th class="col">Resep</th>
                                    <th class="col">Panduan</th>
                                    <th class="col">Created at</th>
                                    <th class="col">Action</th>
                                </tr>
                                <!-- Header tabel dengan judul kolom -->
                                @if ($makanan->isNotEmpty())
                                <!-- Blade directive untuk mengecek apakah koleksi makanan tidak kosong -->
                                @foreach ($makanan as $item)
                                <!-- Looping melalui setiap item dalam koleksi makanan -->
                                    <tr>
                                       <td>{{ $item->id }}</td>
                                       <!-- Menampilkan ID item -->
                                       <td>
                                        @if ($item->image !="")
                                        <!-- Blade directive untuk mengecek apakah item memiliki gambar -->
                                        <img width="50" src="{{ asset('images/' . $item->image) }}" alt="">
                                        <!-- Menampilkan gambar item jika ada -->
                                        @endif
                                       </td>
                                       <td>{{ $item->nama }}</td> 
                                       <!-- Menampilkan nama item -->
                                       <td>{{ $daerah[$item->daerah_id] }}</td> 
                                       <!-- Menampilkan nama daerah item berdasarkan ID daerah -->
                                       <td>{{ $item->deskripsi }}</td> 
                                       <!-- Menampilkan deskripsi item -->
                                       <td>{{ $item->resep }}</td> 
                                       <!-- Menampilkan resep item -->
                                       <td>{{ $item->panduan }}</td>
                                       <!-- Menampilkan panduan item -->
                                       <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M, Y') }}</td> 
                                       <!-- Menampilkan tanggal pembuatan item dalam format tertentu -->
                                       <td>
                                            <a href="{{ route('edit', ['id' => $item->id]) }}" class="btn btn-dark">Edit</a>
                                            <!-- Tautan untuk mengedit item dengan tombol berwarna gelap -->
                                            <form action="{{ route('delete', ['id' => $item->id]) }}" method="POST">
                                            <!-- Form untuk menghapus item -->
                                                @csrf
                                                <!-- Token CSRF untuk keamanan -->
                                                @method('DELETE')
                                                <!-- Metode DELETE untuk form -->
                                                <button onclick="deleteMakanan({{ $item->id }});" type="submit" class="btn btn-danger">Delete</button>
                                                <!-- Tombol untuk menghapus item dengan kelas button berwarna merah -->
                                            </form>
                                        </td>  
                                    </tr>
                                @endforeach
                                <!-- Akhir looping item -->
                            @endif
                            <!-- Akhir pengecekan koleksi makanan -->
                        </table>
                        <!-- Akhir tabel -->
                    </div>
                </div>
            </div>
        </div>
      </div>
   </div>
</div> 
<script>
    function deleteMakanan(id) {
        if (confirm('yakin ingin menghapus feed ini?')) {
            document.getElementById("delete-makanan-form-"+id).submit();
        }
    }
    <!-- Fungsi JavaScript untuk konfirmasi penghapusan item -->
</script>
<script src="js/jquery-3.4.1.min.js"></script>
<!-- Menyertakan file JavaScript jQuery dari direktori lokal -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<!-- Menyertakan file JavaScript Popper.js dari CDN -->
<script src="js/bootstrap.js"></script>
<!-- Menyertakan file JavaScript Bootstrap dari direktori lokal -->
</body>
</html>
<!-- Akhir dari dokumen HTML -->
