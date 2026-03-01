<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="{{ asset('images/logo2.png') }}" type="">

  <title> MaKhasi - User Profile </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
    integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ=="
    crossorigin="anonymous" />
  <!-- font awesome style -->
  <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />

  <style>
    .navbar {
      background: transparent;
    }

    .sub_page .hero_area {
      padding-bottom: 0;
    }

    .nav-item.active a {
      color: #ffbe33 !important;
    }

    /* Background Page is White/Default */
    .profile_section {
        background-color: #ffffff;
        position: relative;
        padding: 50px 0;
    }

    /* Dark Floating Card Styles */
    .profile-card {
        background-color: #222831;
        color: #ffffff;
        border-radius: 25px;
        padding: 40px;
        margin-top: 50px; /* Positive margin to ensure no overlap */
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        position: relative;
        z-index: 10;
        margin-bottom: 50px;
    }

    .profile-card h3 {
        color: #ffbe33;
        font-family: 'Dancing Script', cursive;
        font-size: 2rem;
        margin-bottom: 20px;
    }

    .profile-card h5 {
        color: #ffffff;
        margin-bottom: 15px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        padding-bottom: 10px;
    }

    .profile-card label {
        color: #efefef;
        font-weight: 500;
    }

    /* Bootstrap Form Overrides */
    .form-control {
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #ffffff;
        border-radius: 10px;
        height: 45px;
    }

    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.1);
        border-color: #ffbe33;
        color: #ffffff;
        box-shadow: 0 0 0 0.2rem rgba(255, 190, 51, 0.25);
    }

    /* Input Group for Eye Icon */
    .input-group .form-control {
        border-right: none;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .input-group-append .btn {
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-left: none;
        color: #aa9c84;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        height: 45px;
    }

    .input-group-append .btn:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: #ffbe33;
    }

    .btn-gold {
        background-color: #ffbe33;
        color: #222831;
        font-weight: bold;
        border-radius: 25px;
        padding: 10px 30px;
        text-transform: uppercase;
        border: none;
        transition: all 0.3s;
    }

    .btn-gold:hover {
        background-color: #e69c00;
        color: #ffffff;
    }

    /* Fixed Dropdown Hover State - High Specificity for Active Menu */
    .nav-item.active .dropdown-menu .dropdown-item:hover,
    .nav-item.active .dropdown-menu .dropdown-item:focus,
    .dropdown-item:hover,
    .dropdown-item:focus {
        background-color: #ffbe33 !important;
        color: #222831 !important;
    }

    /* Navbar Adjustment */
    .header_section {
        z-index: 9999;
    }

    .alert-success {
        background-color: rgba(40, 167, 69, 0.2);
        border-color: #28a745;
        color: #98dfb6;
    }

    /* Modal Styles */
    .modal-content {
        background-color: #222831;
        color: white;
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 15px;
    }

    .modal-header {
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .modal-footer {
        border-top: 1px solid rgba(255,255,255,0.1);
    }

    .close {
        color: #fff;
        text-shadow: none;
        opacity: 0.8;
    }

    .close:hover {
        color: #ffbe33;
        opacity: 1;
    }
  </style>
</head>

<body class="sub_page">

  <div class="hero_area">
    <div class="bg-box">
      <img src="{{ asset('images/bg1.jpeg') }}" alt="">
    </div>
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="/home">
            <span>
              MaKhasi
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ml-auto ">
              <li class="nav-item">
                <a class="nav-link" href="/home">Home </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/menu">Menu </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/about">About</a>
              </li>
              @auth
                <li class="nav-item">
                  <a class="nav-link" href="/library">Library</a>
                </li>
                <li class="nav-item dropdown active">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="sr-only">(current)</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                      {{ __('Profile') }}
                    </a>
                    <!-- Logout Trigger Modal -->
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                      {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                  </div>
                </li>
              @else
                <li class="nav-item">
                  <a href="{{ route('login') }}" class="nav-link">Log in</a>
                </li>
                @if (Route::has('register'))
                  <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                  </li>
                @endif
              @endauth
            </ul>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>

  <!-- profile section -->
  <section class="profile_section layout_padding">
    <div class="container">
      <div class="profile-card">
        <div class="text-center mb-5">
            <h3>Profile Settings</h3>
            <p>Manage your account information securely.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- Success Message -->
                @if (session('status') == 'profile-information-updated')
                    <div class="alert alert-success mb-4" role="alert">
                        Profile information updated successfully!
                    </div>
                @endif

                @if (session('status') == 'password-updated')
                    <div class="alert alert-success mb-4" role="alert">
                        Password updated successfully!
                    </div>
                @endif

                <!-- Profile Information Form -->
                <div class="mb-5">
                    <h5>Profile Information</h5>
                    <form action="{{ route('user-profile-information.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', Auth::user()->name) }}" required>
                            @error('name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email', Auth::user()->email) }}" required>
                            @error('email')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-gold">Save Changes</button>
                        </div>
                    </form>
                </div>

                <!-- Update Password Form -->
                <div class="mb-4 pt-4 border-top border-secondary">
                    <h5>Update Password</h5>
                    <p class="text-small text-muted mb-4">Ensure your account is using a long, random password to stay secure.</p>

                    <form action="{{ route('user-password.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <div class="input-group">
                                <input type="password" name="current_password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" id="current_password" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="current_password">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            @error('current_password', 'updatePassword')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" id="password" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            @error('password', 'updatePassword')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password_confirmation">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-gold">Update Password</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end profile section -->

  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 footer-col">
          <div class="footer_contact">
            <h4>
              Contact Us
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Malang
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Call +62 81375105533
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  rifqiprimanda27@gmail.com
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <div class="footer_detail">
            <a href="" class="footer-logo">
              MaKhasi
            </a>
            <p>
              Bergabunglah dengan kami di MaKhasi dan jadilah bagian dari perjalanan mengagumkan untuk mengapresiasi dan
              mendukung keberlanjutan kuliner Indonesia.
            </p>
            <div class="footer_social">
              <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-pinterest" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <h4>
            Office working time
          </h4>
          <p>
            Everyday
          </p>
          <p>
            10.00 Am -10.00 Pm
          </p>
        </div>
      </div>
      <div class="footer-info">
        <p>
          &copy; <span id="displayYear"></span> Mei Semester 4
          <a href="https://html.design/">Universitas Brawijaya</a><br><br>
          &copy; <span id="displayYear"></span> Distributed By
          <a href="https://themewagon.com/" target="_blank">Rifqi primanda</a>
        </p>
      </div>
    </div>
  </footer>
  <!-- footer section -->

  <!-- Logout Confirmation Modal -->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title" id="logoutModalLabel" style="color: #ffbe33;">Confirm Logout</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to log out from MaKhasi?
        </div>
        <div class="modal-footer border-top-0">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-gold" onclick="document.getElementById('logout-form').submit();">Yes, Logout</button>
        </div>
      </div>
    </div>
  </div>

  <!-- jQery -->
  <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
  <!-- bootstrap js -->
  <script src="{{ asset('js/bootstrap.js') }}"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- isotope js -->
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  <!-- custom js -->
  <script src="{{ asset('js/custom.js') }}"></script>

  <script>
    $(document).ready(function() {
        // Password Toggle Logic
        $('.toggle-password').click(function() {
            var inputId = $(this).data('target');
            var input = $('#' + inputId);
            var icon = $(this).find('i');

            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
  </script>

</body>

</html>
