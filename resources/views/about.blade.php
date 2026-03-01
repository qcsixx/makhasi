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
  <link rel="shortcut icon" href="images/logo2.png" type="">

  <title> MaKhasi - About Us </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
    integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ=="
    crossorigin="anonymous" />
  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

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
    .about_section {
        background-color: #ffffff;
        position: relative;
    }

    /* Dark Floating Card Styles */
    .about-card {
        background-color: #222831;
        color: #ffffff;
        border-radius: 25px;
        padding: 50px;
        margin-top: -50px; /* Slight overlap or just normal margin */
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        position: relative;
        z-index: 10;
        margin-bottom: 50px; /* Spance betwen card and footer */
    }

    .about-card .heading_container h2 {
        color: #ffffff;
    }

    .about_section .detail-box p {
        color: #efefef;
        margin-bottom: 25px;
        line-height: 1.8;
    }

    /* Invert logo to white for dark background */
    .about_section .img-box img {
        width: 100%;
        max-width: 350px;
        display: block;
        margin: 0 auto;
        filter: brightness(0) invert(1);
        transition: transform 0.3s ease;
    }

    .about_section .img-box img:hover {
        transform: scale(1.05) rotate(2deg);
    }

    .feature-box {
        background: rgba(255, 255, 255, 0.05);
        padding: 30px;
        border-radius: 15px;
        text-align: center;
        transition: all 0.3s;
        border: 1px solid rgba(255,255,255,0.1);
        height: 100%;
    }

    .feature-box:hover {
        background: #ffbe33;
        transform: translateY(-10px);
    }

    .feature-box:hover h5, .feature-box:hover p {
        color: #222831;
    }

    .feature-box i {
        font-size: 40px;
        color: #ffbe33;
        margin-bottom: 15px;
    }

    .feature-box:hover i {
        color: #222831;
    }

    .stat-item h3 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #ffbe33;
    }
  </style>
</head>

<body class="sub_page">

  <div class="hero_area">
    <div class="bg-box">
      <img src="images/bg1.jpeg" alt="">
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
              <li class="nav-item active">
                <a class="nav-link" href="/about">About <span class="sr-only">(current)</span></a>
              </li>
              @auth
                <li class="nav-item">
                  <a class="nav-link" href="/library">Library</a>
                </li>
                <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                      {{ __('Profile') }}
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
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

  <!-- about section -->
  <section class="about_section layout_padding">
    <div class="container">
      <div class="about-card">
          <!-- Intro Row -->
          <div class="row align-items-center">
            <div class="col-md-6">
              <div class="img-box mb-4 mb-md-0">
                <img src="images/logo2.png" alt="About MaKhasi">
              </div>
            </div>
            <div class="col-md-6">
              <div class="detail-box">
                <div class="heading_container">
                  <h2>
                    We Are MaKhasi
                  </h2>
                </div>
                <p class="lead" style="font-weight: 500; color: #ffbe33; font-size: 1.2rem; margin-bottom: 25px;">
                    Membawa Cita Rasa Nusantara ke Piring Anda.
                </p>
                <p>
                  MaKhasi bukan sekadar platform kuliner, melainkan jembatan digital yang menghubungkan warisan rasa Indonesia dengan penikmat kuliner modern. Kami berkomitmen menyajikan cerita autentik, resep legendaris, dan panduan kuliner terpercaya.
                </p>
                <p>
                  Setiap hidangan memiliki cerita, dan kami ada di sini untuk menceritakannya kepada dunia. Dari Sabang sampai Merauke, kekayaan bumbu dan tradisi kami kurasi khusus untuk kepuasan Anda.
                </p>
                <div class="btn-box mt-4">
                    <a href="/menu" class="btn btn-warning text-white rounded-pill px-5 py-2 shadow-sm" style="font-weight: bold;">
                        Mulai Jelajah Rasa
                    </a>
                </div>
              </div>
            </div>
          </div>

          <!-- Stats Row -->
          <div class="row mt-5 pt-4 text-center border-top border-secondary">
            <div class="col-md-4 mb-4">
                <div class="stat-item">
                    <h3>500+</h3>
                    <p class="text-white">Resep Nusantara</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stat-item">
                    <h3>50+</h3>
                    <p class="text-white">Daerah Kuliner</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stat-item">
                    <h3>10k+</h3>
                    <p class="text-white">Pengguna Bahagia</p>
                </div>
            </div>
          </div>

          <!-- Features Row -->
          <div class="row mt-5">
            <div class="col-12 text-center mb-5">
                <h3 style="font-family: 'Dancing Script', cursive; color: #ffbe33; font-size: 2.5rem;">Why Choose Us?</h3>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-box">
                    <i class="fa fa-cutlery" aria-hidden="true"></i>
                    <h5>Rasa Autentik</h5>
                    <p class="text-small mb-0">Resep asli yang dijaga keasliannya dari generasi ke generasi.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-box">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <h5>Komunitas Luas</h5>
                    <p class="text-small mb-0">Bergabung dengan ribuan pecinta kuliner Indonesia lainnya.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-box">
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <h5>Terpercaya</h5>
                    <p class="text-small mb-0">Informasi dan panduan yang telah diverifikasi oleh ahli kuliner.</p>
                </div>
            </div>
          </div>
      </div>
    </div>
  </section>
  <!-- end about section -->

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

</body>

</html>
