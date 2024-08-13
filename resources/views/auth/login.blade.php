<!doctype html>
<html lang="en">
<head>
    <title>MaKhasi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/login/style.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /* Gaya dasar untuk tautan */
        .w-50.text-md-right a {
            color: #fff; /* Warna teks default */
            text-decoration: none; /* Menghapus garis bawah */
        }

        /* Gaya untuk efek hover */
        .w-50.text-md-right a:hover {
            color: #ffbe33; /* Warna kuning saat dihover */
        }
    </style>
</head>
<body class="img js-fullheight" style="background-image: url('{{ asset('images/bg1.jpeg') }}');">
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Selamat Datang Makhasi!</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center">Have an account?</h3>
                    <form method="POST" action="{{ route('login') }}" class="signin-form">
                        @csrf
                        <div class="form-group">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Username" />
                        </div>
                        <div class="form-group">
                            <x-label for="password" value="{{ __('Password') }}" />
                            <x-input id="password-field" class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="Password" />
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn submit px-3 btn-custom">Log In</button>
                        </div>
                        <div class="form-group d-md-flex">
                            <div class="w-50">
                                <label class="checkbox-wrap checkbox-primary remember-me-custom">Remember Me
                                    <input type="checkbox" name="remember" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="w-50 text-md-right">
                                <a href="{{ route('register') }}">Dont have an account?</a>
                            </div>
                            
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('js/login/jquery.min.js') }}"></script>
<script src="{{ asset('js/login/popper.js') }}"></script>
<script src="{{ asset('js/login/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/login/main.js') }}"></script>

</body>
</html>
