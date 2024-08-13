<!DOCTYPE html>
<html>

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

  <title> MaKhasi </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" />

  <style>

    /* Aturan gaya untuk membuat teks menjadi kuning */
    .slider_section .detail-box h1 {
      color: white;
    }
    .filters_menu li {
    cursor: pointer;
    padding: 10px;
    border-radius: 5px;
    transition: background-color 0.3s;
  }

  .filters_menu .active {
  background-color: #ffbe33 !important; /* Warna latar belakang */
  transition: background-color 0.3s ease; /* Efek transisi saat perubahan warna */
}

.filters_menu .active:hover {
  background-color: #ffa500 !important; /* Warna latar belakang saat dihover */
}
  .btn-box a {
    display: inline-block;
    padding: 10px 20px;
    background-color: #ffbe33 !important; /* Warna hijau */
    color: white !important; /* Warna teks putih */
    text-decoration: none;
    border-radius: 5px; /* Membuat sudut tombol melengkung */
    transition: background-color 0.3s; /* Transisi halus saat perubahan warna latar belakang */
  }

  .btn-box a:hover {
    background-color: #ffa500 !important; /* Warna hijau yang lebih gelap saat tombol di-hover */
  }

  </style>
</head>

<body>

  <div class="hero_area">
    <div class="bg-box">
      <img src="images/bg1.jpeg" alt="">
    </div>
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.html">
            <span class="brand-text">
              MaKhasi
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                  <a href="/home" class="nav-link">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                  <a href="/menu" class="nav-link">Menu</a>
              </li>
              <li class="nav-item">
                  <a href="/about" class="nav-link">About</a>
              </li>
              @auth <!-- Tampilkan item ini hanya jika pengguna telah login -->
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          {{ Auth::user()->name }}
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('profile.show') }}">
                              {{ __('Profile') }}
                          </a>
                          <a class="dropdown-item" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                          </form>
                      </div>
                  </li>
              @else <!-- Tampilkan item ini hanya jika pengguna belum login -->
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
    <!-- slider section -->
    <section class="slider_section ">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h1>
                      "Taste the Tradition, <br>
                      Feel the Flavor!"
                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h1>
                      "Taste the Essence, Embrace the Heritage"
                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h1>
                      "Savor the Culture, Indulge in Authenticity"
                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <ol class="carousel-indicators">
            <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
            <li data-target="#customCarousel1" data-slide-to="1"></li>
            <li data-target="#customCarousel1" data-slide-to="2"></li>
          </ol>
        </div>
      </div>

    </section>
    <!-- end slider section -->
  </div>



  <!-- end offer section -->

  <!-- food section -->
  <section class="food_section layout_padding-bottom">
  </section>

    <!-- Content of the food section goes here -->
  <section class="food_section layout_padding-bottom">
    <div class="container" data-aos="fade-up" data-aos-duration="1000">
      <div class="heading_container heading_center">
        <h2>
          Makanan
        </h2>
      </div>
      <div class="filters-content">
        <div class="row grid">
          <div class="col-sm-6 col-lg-4 all Jawa">
            <div class="box" data-aos="fade-up" data-aos-duration="1000">
              <div>
                <div class="img-box">
                  <img src="images/Rawon.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Rawon
                  </h5>
                  <p>
                    Rawon adalah hidangan khas Jawa Timur, Indonesia. Hidangan ini terbuat dari daging sapi yang dimasak dengan bumbu khas, seperti kluwek yang memberikan warna hitam khas dan rasa yang unik.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all Sumatra">
            <div class="box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
              <div>
                <div class="img-box">
                  <img src="images/Rendang.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Rendang
                  </h5>
                  <p>
                    Rendang merupakan kuliner dari Sumatera Barat yang masuk dalam World’s 50 Most Delicious Food versi CNN pada tahun 2011 lalu.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all Jawa">
            <div class="box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
              <div>
                <div class="img-box">
                  <img src="images/Gudeg.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Gudeg
                  </h5>
                  <p>
                    Gudeg adalah hidangan khas Yogyakarta dan Jawa Tengah, Indonesia. Hidangan ini merupakan bagian penting dari budaya kuliner Jawa dan sering dihidangkan sebagai hidangan sarapan atau makan malam.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all Kalimantan">
            <div class="box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
              <div>
                <div class="img-box">
                  <img src="images/soto-banjar.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Soto Banjar
                  </h5>
                  <p>
                    Soto Banjar adalah hidangan soto khas dari Banjarmasin, Kalimantan Selatan. Hidangan ini memiliki akar dalam budaya Banjar yang kaya akan rempah-rempah dan pengaruh kuliner Melayu.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all Kalimantan">
            <div class="box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
              <div>
                <div class="img-box">
                  <img src="images/Patin-bakar.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Patin Bakar
                  </h5>
                  <p>
                    Patin Bakar adalah hidangan khas Kalimantan yang terdiri dari ikan patin yang dibakar dengan bumbu rempah khas daerah tersebut. Hidangan ini populer karena cita rasanya yang khas dan tekstur daging ikan yang lembut.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all Jawa">
            <div class="box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
              <div>
                <div class="img-box">
                  <img src="images/nasi-liwet.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Nasi Liwet
                  </h5>
                  <p>
                    Nasi Liwet adalah hidangan nasi khas dari Jawa Barat, Indonesia. Hidangan ini memiliki akar dari budaya Sunda yang kaya akan tradisi kuliner. Hidangan ini telah menjadi salah satu ikon kuliner Jawa Barat yang populer di seluruh Indonesia.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all Sumatra">
            <div class="box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
              <div>
                <div class="img-box">
                  <img src="images/bubur-pedes.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Bubur Pedas
                  </h5>
                  <p>
                    Bubur pedas merupakan salah satu menu wajib saat buka puasa bagi masyarakat Medan bahkan di Medan ketika menjelang buka puasa beberapa pengurus masjid sudah menyediakan makanan satu ini.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all Sumatra">
            <div class="box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
              <div>
                <div class="img-box">
                  <img src="images/Sate-Padang.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Sate Padang
                  </h5>
                  <p>
                    Sate Padang berasal dari daerah Padang, Sumatra Barat, Indonesia. Hidangan ini memiliki akar dari budaya Minangkabau yang kaya akan rempah-rempah dan kebiasaan makan bersama.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all Sulawesi">
            <div class="box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
              <div>
                <div class="img-box">
                  <img src="images/coto.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Coto Makassar
                  </h5>
                  <p>
                    Coto Makassar adalah hidangan khas Sulawesi Selatan, terutama Kota Makassar. Hidangan ini merupakan bagian integral dari budaya kuliner Makassar dan sering disajikan dalam berbagai acara penting.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all Sulawesi">
            <div class="box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
              <div>
                <div class="img-box">
                  <img src="images/konro.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Konro
                  </h5>
                  <p>
                    Konro adalah hidangan khas dari daerah Makassar, Sulawesi Selatan. Hidangan ini merupakan salah satu kuliner ikonik dari Makassar dan sering dianggap sebagai makanan yang menggugah selera.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all Sulawesi">
            <div class="box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
              <div>
                <div class="img-box">
                  <img src="images/pisang-epe.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Pisang Epe
                  </h5>
                  <p>
                    Pisang Epe adalah makanan khas dari Sulawesi, terutama daerah Makassar. Pisang Epe merupakan hidangan populer dan sering dijual di pasar tradisional, kaki lima, dan acara-acara khusus di daerah Sulawesi.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all Kalimantan">
            <div class="box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
              <div>
                <div class="img-box">
                  <img src="images/Ketupat-Kandangan.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Ketupat Kandangan
                  </h5>
                  <p>
                    Ketupat Kandangan adalah hidangan khas Kalimantan Selatan, terutama di daerah Kandangan. Hidangan ini memiliki nilai budaya yang tinggi di masyarakat Kalimantan Selatan dan sering disajikan dalam berbagai acara tradisional.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all Papua">
            <div class="box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay=500">
              <div>
                <div class="img-box">
                  <img src="images/papeda.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Papeda
                  </h5>
                  <p>
                    Papeda adalah makanan khas dari Papua yang terbuat dari sagu yang dilarutkan dalam air dan dimasak hingga membentuk tekstur yang kental. Hidangan ini merupakan makanan pokok bagi suku-suku di Papua.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all Papua">
            <div class="box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
              <div>
                <div class="img-box">
                  <img src="images/kuah-ikan.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Papeda Kuah Ikan Tongkol
                  </h5>
                  <p>
                    Hidangan ini merupakan bagian penting dari kuliner tradisional Papua yang kaya akan cita rasa dan memiliki peranan dalam budaya masyarakat Papua. Papeda Kuah Ikan Tongkol adalah varian papeda yang disajikan dengan kuah ikan tongkol yang kaya rempah dan rasa.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all Papua">
            <div class="box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
              <div>
                <div class="img-box">
                  <img src="images/biapong.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Biapong
                  </h5>
                  <p>
                    Biapong adalah roti kukus atau bakar yang merupakan salah satu makanan khas dari Papua. Biasanya, biapong disajikan sebagai camilan atau hidangan pendamping dalam berbagai acara di Papua.
                  </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end food section -->

  <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container  ">

      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="images/logo2.png" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                We Are MaKhasi
              </h2>
            </div>
            <p>
              Selamat datang di MaKhasi, destinasi digital yang mempersembahkan kekayaan kuliner Indonesia dalam genggaman Anda. MaKhasi adalah sebuah platform yang didedikasikan untuk memperkenalkan dan mempromosikan makanan khas Indonesia kepada masyarakat lokal maupun internasional.
            </p>
            <div class="btn-box">
            <a href="/about">
              Read More
            </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <section class="client_section layout_padding-bottom">
  </section>
  <!-- client section -->

  <section class="client_section layout_padding-bottom">
    <div class="container">
      <div class="heading_container heading_center psudo_white_primary mb_45">
        <h2>
          User Berbicara Fakta
        </h2>
      </div>
      <div class="carousel-wrap row ">
        <div class="owl-carousel client_owl-carousel">
          <div class="item">
            <div class="box">
              <div class="detail-box">
                <p>
                  website yang sangat berguna bagi indonesia
                </p>
                <h6>
                  Kepin
                </h6>
                <p>
                  wijayanto
                </p>
              </div>
              <div class="img-box">
                <img src="images/kepin.jpeg" alt="" class="box-img">
              </div>
            </div>
          </div>
          <div class="item">
            <div class="box">
              <div class="detail-box">
                <p>
                  Indonesia merdeka karna ripki
                </p>
                <h6>
                  Kitan
                </h6>
                <p>
                  Puncoro
                </p>
                </div>
                <div class="img-box">
                  <img src="images/kitan.jpeg" alt="" class="box-img">
                </div>
              </div>
            </div>
          <div class="item">
            <div class="box">
              <div class="detail-box">
                <p>
                  mending buka ini dari pada tele
                </p>
                <h6>
                  hakim
                </h6>
                <p>
                  sdmrendah
                </p>
                </div>
                <div class="img-box">
                  <img src="images/hakim.jpeg" alt="" class="box-img">
                </div>
              </div>
            </div>
          <div class="item">
            <div class="box">
              <div class="detail-box">
                <p>
                  masyaallah indonesia makin maju
                </p>
                <h6>
                  nopal
                </h6>
                <p>
                  ustad
                </p>
                </div>
                <div class="img-box">
                  <img src="images/nopal.jpeg" alt="" class="box-img">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>

  <!-- end client section -->

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
              Bergabunglah dengan kami di MaKhasi dan jadilah bagian dari perjalanan mengagumkan untuk mengapresiasi dan mendukung keberlanjutan kuliner Indonesia. Mari bersama-sama merasakan kelezatan dan keindahan makanan khas Indonesia di MaKhasi.
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
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- isotope js -->
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

</body>

</html>