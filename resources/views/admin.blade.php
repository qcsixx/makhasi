<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add new feed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="{{ asset('css/improvements.css') }}" rel="stylesheet">
</head>

<body>

    <div class="bg-dark py-3">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-auto">
                    <h3 class="text-white">Add new feed</h3>
                </div>
                <div class="col-md text-end">
                    <ul class="nav justify-content-end">
                        <li class="nav-item dropdown">
                            @if(Auth::check())
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                            @endif
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('feed') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="row d-flex justifiy-content-center">
            <div class="col-md-10">
                <div class="card borde-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Add Feed</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('add') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label h5">Nama</label>
                                <input value="{{ old('nama') }}" type="text" class="@error('nama') is-invalid @enderror 
                            form-control form-control-lg" placeholder="Nama" name="nama">
                                @error('nama')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="daerah_id" class="form-label h5">Daerah</label>
                                <select id="daerah_id" class="@error('daerah') is-invalid @enderror 
                            form-control form-control-lg" name="daerah_id">
                                    @foreach($daerah as $id => $nama)
                                        <option value="{{ $id }}" {{ old('daerah_id') == $id ? 'selected' : '' }}>
                                            {{ $nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('daerah')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Deskripsi</label>
                                <textarea placeholder="deskripsi" class="form-control" name="deskripsi" cols="30"
                                    rows="5">{{ old('deskripsi') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Resep</label>
                                <textarea placeholder="Resep" class="@error('resep') is-invalid @enderror form-control"
                                    name="resep" cols="30" rows="5">{{ old('resep') }}</textarea>
                                @error('resep')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Panduan</label>
                                <textarea placeholder="Panduan"
                                    class="@error('panduan') is-invalid @enderror form-control" name="panduan" cols="30"
                                    rows="5">{{ old('panduan') }}</textarea>
                                @error('panduan')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Image</label>
                                <input type="file"
                                    class="@error('image') is-invalid @enderror form-control form-control-lg"
                                    placeholder="input" name="image" accept="image/jpeg,image/png,image/jpg">
                                @error('image')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>