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

  <title> MaKhasi - Library </title>

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
    .nav-item.active a {
      color: #ffbe33 !important;
    }

    .btn-box a {
      display: inline-block;
      padding: 10px 20px;
      background-color: #ffbe33 !important;
      color: white !important;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .btn-box a:hover {
      background-color: #ffa500 !important;
    }

    .remove-btn {
      background-color: #dc3545;
      color: white;
      border: none;
      padding: 5px 15px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .remove-btn:hover {
      background-color: #c82333;
    }

    .empty-library {
      text-align: center;
      padding: 50px 20px;
    }

    .empty-library i {
      font-size: 80px;
      color: #ddd;
      margin-bottom: 20px;
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
              <li class="nav-item">
                <a class="nav-link" href="/about">About</a>
              </li>
              @auth
                <li class="nav-item active">
                  <a class="nav-link" href="/library">Library <span class="sr-only">(current)</span></a>
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
          Makanan Favorit Anda
        </h2>
      </div>

      @if($makanan->isEmpty())
        <div class="empty-library">
          <i class="fa fa-heart-o"></i>
          <h3>Library Anda Masih Kosong</h3>
          <p>Belum ada makanan favorit yang disimpan.</p>
          <div class="btn-box">
            <a href="{{ route('menu') }}">Jelajahi Menu</a>
          </div>
        </div>
      @else
        <div class="filters-content">
          <div class="row grid">
            @foreach ($makanan as $item)
              <div class="col-sm-6 col-lg-4 all">
                <div class="box" style="position: relative;">
                  <div>
                    <div class="img-box">
                      <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->nama }}">
                    </div>
                    <div class="detail-box">
                      <h5>
                        {{ $item->nama }}
                      </h5>
                      <p>
                        {{ Str::limit(strip_tags($item->deskripsi), 80) }}
                      </p>
                      <div class="options">
                        <h6>
                           {{ $item->daerah->nama ?? 'Indonesia' }}
                        </h6>
                        <!-- Delete Trigger Button -->
                        <button type="button" class="btn btn-sm btn-danger rounded-pill px-3"
                                data-toggle="modal"
                                data-target="#deleteLibraryModal"
                                data-url="{{ route('library.remove', $item->id) }}"
                                style="position: relative; z-index: 10;">
                            <i class="fa fa-trash"></i> Hapus
                        </button>
                      </div>
                      <!-- Main Card Link -->
                      <a href="{{ route('detail', ['id' => $item->id]) }}" class="stretched-link"></a>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif
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
              Bergabunglah dengan kami di MaKhasi dan jadilah bagian dari perjalanan mengagumkan untuk mengapresiasi dan
              mendukung keberlanjutan kuliner Indonesia. Mari bersama-sama merasakan kelezatan dan keindahan makanan
              khas Indonesia di MaKhasi.
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
      <div class="modal-content" style="background-color: #222831; color: white; border: 1px solid rgba(255,255,255,0.1);">
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
          <button type="button" class="btn btn-warning font-weight-bold" style="background-color: #ffbe33; color: #222831; border: none;" onclick="document.getElementById('logout-form').submit();">Yes, Logout</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Library Confirmation Modal -->
  <div class="modal fade" id="deleteLibraryModal" tabindex="-1" role="dialog" aria-labelledby="deleteLibraryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="background-color: #222831; color: white; border: 1px solid rgba(255,255,255,0.1);">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title" id="deleteLibraryModalLabel" style="color: #ffbe33;">Remove from Library</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin ingin menghapus makanan ini dari daftar favorit Anda?
        </div>
        <div class="modal-footer border-top-0">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <form id="deleteLibraryForm" action="" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger font-weight-bold">Yes, Remove</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
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
    $(document).ready(function() {
        // Delete Library Modal Logic
        $('#deleteLibraryModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var url = button.data('url');
            var modal = $(this);
            modal.find('#deleteLibraryForm').attr('action', url);
        });
    });
  </script>

</body>

</html>
