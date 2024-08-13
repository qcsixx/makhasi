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

  <style>
    .nav-item.active a {
    color: #ffbe33 !important; /* Warna teks hijau */
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

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ml-auto ">
              <li class="nav-item">
                <a class="nav-link" href="/home">Home </a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="/menu">Menu <span class="sr-only">(current)</span> </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/about">About</a>
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
  </div>
  <!-- food section -->
  <section class="food_section layout_padding-bottom">
  </section>
    <!-- Content of the food section goes here -->
  <section class="food_section layout_padding-bottom">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Daerah
        </h2>
      </div>

      <ul class="filters_menu">
        <li data-filter=".Sumatra">Sumatra</li>
        <li data-filter=".Jawa">Jawa</li>
        <li data-filter=".Kalimantan">Kalimantan</li>
        <li data-filter=".Sulawesi">Sulawesi</li>
        <li data-filter=".Papua">Papua</li>
      </ul>

      <div class="filters-content">
        <div class="row grid">
          @foreach ($makanan as $item)
            @if ($item->daerah_id == 1)
              <div class="col-sm-6 col-lg-4 all Sumatra">
                <a href="{{ route('detail', ['id' => $item->id]) }}">
                <div class="box">
                  <div>
                    <div class="img-box">
                      <img src="{{ asset('images/'. $item->image) }}" alt="">
                    </div>
                    <div class="detail-box">
                      <h5>{{ $item->nama }}</h5>
                      <p>{{ $item->deskripsi }}</p>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @endforeach

          @foreach ($makanan as $item)
            @if ($item->daerah_id == 2)
              <div class="col-sm-6 col-lg-4 all Jawa">
                <a href="{{ route('detail', ['id' => $item->id]) }}">
                <div class="box">
                  <div>
                    <div class="img-box">
                      <img src="{{ asset('images/'. $item->image) }}" alt="">
                    </div>
                    <div class="detail-box">
                      <h5>{{ $item->nama }}</h5>
                      <p>{{ $item->deskripsi }}</p>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @endforeach
          @foreach ($makanan as $item)
          @if ($item->daerah_id == 3)
            <div class="col-sm-6 col-lg-4 all Kalimantan">
              <a href="{{ route('detail', ['id' => $item->id]) }}">
              <div class="box">
                <div>
                  <div class="img-box">
                    <img src="{{ asset('images/'. $item->image) }}" alt="">
                  </div>
                  <div class="detail-box">
                    <h5>{{ $item->nama }}</h5>
                    <p>{{ $item->deskripsi }}</p>
                  </div>
                </div>
              </div>
            </div>
          @endif
        @endforeach
        @foreach ($makanan as $item)
        @if ($item->daerah_id == 4)
          <div class="col-sm-6 col-lg-4 all Sulawesi">
            <a href="{{ route('detail', ['id' => $item->id]) }}">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="{{ asset('images/'. $item->image) }}" alt="">
                </div>
                <div class="detail-box">
                  <h5>{{ $item->nama }}</h5>
                  <p>{{ $item->deskripsi }}</p>
                </div>
              </div>
            </div>
          </div>
        @endif
      @endforeach
      @foreach ($makanan as $item)
      @if ($item->daerah_id == 5)
        <div class="col-sm-6 col-lg-4 all Papua">
          <a href="{{ route('detail', ['id' => $item->id]) }}">
          <div class="box">
            <div>
              <div class="img-box">
                <img src="{{ asset('images/'. $item->image) }}" alt="">
              </div>
              <div class="detail-box">
                <h5>{{ $item->nama }}</h5>
                <p>{{ $item->deskripsi }}</p>
              </div>
            </div>
          </div>
        </div>
      @endif
    @endforeach
        </div>
      </div>
    </div>
  </section>

  <!-- end food section -->

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
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const filterItems = document.querySelectorAll('.filters_menu li');
      const navItems = document.querySelectorAll('.nav-item');
  
      filterItems.forEach(item => {
        item.addEventListener('click', function () {
          // Hapus kelas 'active' dari semua item
          filterItems.forEach(i => i.classList.remove('active'));
  
          // Tambahkan kelas 'active' ke item yang diklik
          this.classList.add('active');
        });
      });
    });
  </script>

</body>

</html>