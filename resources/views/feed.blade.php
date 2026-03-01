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
                    <h3 class="text-white"> New Feed</h3>
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
                <a href="{{ route('admin') }}" class="btn btn-dark">Create</a>
            </div>
        </div>
        <div class="row d-flex justifiy-content-center">
            @if(Session::has('success'))
                <div class="col-md-10">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
            @endif
                <div class="col-md-10">
                    <div class="card borde-0 shadow-lg my-4">
                        <div class="card-header bg-dark">
                            <h3 class="text-white">Feed</h3>
                        </div>
                        <div class='card-body'>
                            <div class="table-responsive">
                                <table class="table">
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
                                    @if ($makanan->isNotEmpty())
                                        @foreach ($makanan as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>
                                                    @if ($item->image != "")
                                                        <img width="50" src="{{ asset('images/' . $item->image) }}"
                                                            alt="{{ $item->nama }}">
                                                    @endif
                                                </td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $daerah[$item->daerah_id] }}</td>
                                                <td>{{ $item->deskripsi }}</td>
                                                <td>{{ $item->resep }}</td>
                                                <td>{{ $item->panduan }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M, Y') }}</td>
                                                <td>
                                                    <a href="{{ route('edit', ['id' => $item->id]) }}"
                                                        class="btn btn-dark">Edit</a>
                                                    <form action="{{ route('delete', ['id' => $item->id]) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Yakin ingin menghapus feed ini?')"
                                                            class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </table>
                            </div>

                            <!-- Pagination Links -->
                            <div class="d-flex justify-content-center mt-3">
                                {{ $makanan->links() }}
                            </div>
                        </div>
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