<!doctype html>
<html lang="en">
<head>
    <title>MaKhasi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/login/style.css') }}">
    <link rel="shortcut icon" href="images/logo2.png" type="">
</head>
<body class="bg-img js-fullheight register-body" style="background-image: url('{{ asset('images/bg1.jpeg') }}');">
<section class="">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5" style="margin-top: 50px;">
                <h2 class="heading-section">Register</h2>
            </div>            
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center">Create an account</h3>
                    <form method="POST" action="{{ route('register') }}" class="signin-form">
                        @csrf
                        <div class="form-group">
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Name" />
                        </div>
                        <div class="form-group">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email" />
                        </div>
                        <div class="form-group position-relative">
                            <x-label for="password" value="{{ __('Password') }}" />
                            <x-input id="password-field" class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="Password" />
                        </div>
                        <div class="form-group">
                            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                            <x-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />
                        </div>
                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="form-group mt-4">
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required />
                                    <div class="ms-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                        @endif
                        <div class="form-group">
                            <button type="submit" class="form-control btn submit px-3 btn-custom">Register</button>
                        </div>
                        <div class="form-group d-md-flex">
                            <div class="w-50 text-md-start">
                                <a class="underline text-sm text-custom" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    var togglePassword = document.querySelector('.toggle-password');
    var passwordField = document.querySelector('#password-field');

    togglePassword.addEventListener('click', function () {
        // Toggle the type attribute
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        // Toggle the icon
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
});

</script>

</body>
</html>
