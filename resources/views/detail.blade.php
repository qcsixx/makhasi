<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Detail Feed</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail/classy-nav.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail/custom-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        .single-preparation-step h4 {
            font-size: 1.2rem; /* Ubah ukuran font sesuai kebutuhan */
            margin-right: 10px; /* Sesuaikan jarak antar angka dan teks */
        }

        .single-preparation-step {
            margin-bottom: 10px; /* Kurangi jarak antar langkah */
            align-items: flex-start; /* Pastikan item sejajar di atas */
        }

        .single-preparation-step p {
            margin: 0; /* Hilangkan margin dari paragraf */
        }
    </style>
    <style>
      /* Style untuk bintang yang aktif */
      .ratings .fas.active {
          color: gold; /* Ubah warna bintang yang aktif */
      }
  </style>
</head>

<body>
    <!-- header section starts -->
    <header class="header_section">
        <div class="container">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="index.html" style="display: block; text-align: center; width: 100%;">
                    <span class="brand-text">Detail Makanan</span>
                </a>
            </nav>
        </div>
    </header>
    <!-- end header section -->
    <section class="food_section layout_padding-bottom"></section>
    <!-- Receipe Slider -->
    <div class="container">
      <div class="row">
          <div class="col-12 text-center">
              <img src="{{ asset('images/'. $makanan->image) }}" alt="" class="mx-auto d-block">
          </div>
      </div>
  </div>
  

    <!-- Receipe Content Area -->
    <div class="receipe-content-area">
      <div class="container">
          <div class="row">
              <div class="col-12 col-md-8">
                  <div class="receipe-headline my-5">
                      <span>{{ $makanan->daerah }}</span>
                      <h2>{{ $makanan->nama }}</h2>
                      <div class="receipe-duration">
                          <h6>{{ $makanan->deskripsi }}</h6>
                      </div>
                  </div>
              </div>
              <div class="col-12 col-md-4">
                  <div class="receipe-ratings text-right my-5">
                    <div class="ratings">
                      <i id="star1" class="fa fa-star" aria-hidden="true"></i>
                      <i id="star2" class="fa fa-star" aria-hidden="true"></i>
                      <i id="star3" class="fa fa-star" aria-hidden="true"></i>
                      <i id="star4" class="fa fa-star" aria-hidden="true"></i>
                      <i id="star5" class="fa fa-star" aria-hidden="true"></i>
                  </div>                  
                  </div>
              </div>
          </div>
        </div>
      </div>
  
      <div class="receipe-content-area">
        <div class="container">
            <div class="row">
                <!-- Panduan -->
                <div class="col-lg-6">
                    <div class="ingredients">
                        <h4>Panduan</h4>
                        <!-- Container for checkboxes -->
                        <div id="checkboxContainer"></div>
                    </div>
                </div>
    
                <!-- Resep -->
                <div class="col-lg-6">
                    <h4>Resep</h4>
                    <br> <!-- Penambahan elemen <br> di sini -->
                    @foreach (explode('.', $makanan->resep) as $langkah)
                    <div class="single-preparation-step d-flex">
                        <h4>{{ $loop->iteration }}.</h4>
                        <p>{{ $langkah }}</p>
                    </div>
                    @endforeach
                </div>                
            </div>
            <div class="row">
              <div class="col-12 text-center mt-4">
                  <a href="/menu" class="btn delicious-btn">Back</a>
              </div>
          </div>
      </div>
  </div>
    
  <section class="food_section layout_padding-bottom"></section>
    <!-- footer section -->
    <footer class="footer_section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 footer-col">
                    <div class="footer_contact">
                        <h4>Contact Us</h4>
                        <div class="contact_link_box">
                            <a href="">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span>Malang</span>
                            </a>
                            <a href="">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span>Call +62 81375105533</span>
                            </a>
                            <a href="">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>rifqiprimanda27@gmail.com</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 footer-col">
                    <div class="footer_detail">
                        <a href="" class="footer-logo">MaKhasi</a>
                        <p>Bergabunglah dengan kami di MaKhasi dan jadilah bagian dari perjalanan mengagumkan untuk mengapresiasi dan mendukung keberlanjutan kuliner Indonesia. Mari bersama-sama merasakan kelezatan dan keindahan makanan khas Indonesia di MaKhasi.</p>
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
                    <h4>Office working time</h4>
                    <p>Everyday</p>
                    <p>10.00 Am -10.00 Pm</p>
                </div>
            </div>
            <div class="footer-info">
                <p>&copy; <span id="displayYear"></span> Mei Semester 4
                    <a href="https://html.design/">Universitas Brawijaya</a><br><br>
                    &copy; <span id="displayYear"></span> Distributed By
                    <a href="https://themewagon.com/" target="_blank">Rifqi primanda</a>
                </p>
            </div>
        </div>
    </footer>
    <!-- footer section -->

    <!-- ##### All Javascript Files ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="{{ asset('js/jquery/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/plugins.js') }}"></script>
    <script src="{{ asset('js/active.js') }}"></script>

    <!-- Custom JavaScript to create checkboxes dynamically -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get the instructions string from Laravel variable
            var instructions = @json($makanan->panduan);

            // Split the instructions by dot (.)
            var instructionsArray = instructions.split('.');

            // Get the container for checkboxes
            var checkboxContainer = document.getElementById('checkboxContainer');

            // Create a checkbox for each instruction
            instructionsArray.forEach(function (instruction, index) {
                if (instruction.trim().length > 0) {
                    var checkbox = document.createElement('div');
                    checkbox.classList.add('custom-control', 'custom-checkbox', 'mb-2');

                    var input = document.createElement('input');
                    input.type = 'checkbox';
                    input.classList.add('custom-control-input');
                    input.id = 'checkbox_' + index;
                    checkbox.appendChild(input);

                    var label = document.createElement('label');
                    label.classList.add('custom-control-label');
                    label.setAttribute('for', 'checkbox_' + index);
                    label.textContent = instruction.trim();
                    checkbox.appendChild(label);

                    checkboxContainer.appendChild(checkbox);
                }
            });
        });
    </script>
<script>
  // Fungsi untuk menangani klik pada bintang-bintang
  function handleStarClick(starId) {
      // Dapatkan elemen bintang berdasarkan id
      var starElement = document.getElementById(starId);

      // Dapatkan nomor urut bintang
      var starNumber = parseInt(starId.replace('star', ''));

      // Periksa apakah bintang sedang dipilih
      var isChecked = starElement.classList.contains('checked');

      // Atur kelas 'checked' pada elemen bintang berdasarkan status sebelumnya
      if (isChecked) {
          // Jika bintang sudah dipilih, hapus kelas 'checked'
          starElement.classList.remove('checked');

          // Hapus kelas 'checked' dari bintang-bintang sebelumnya
          for (var i = 1; i < starNumber; i++) {
              var prevStarId = 'star' + i;
              document.getElementById(prevStarId).classList.remove('checked');
          }
      } else {
          // Jika bintang belum dipilih, tambahkan kelas 'checked'
          starElement.classList.add('checked');

          // Tambahkan kelas 'checked' pada bintang-bintang sebelumnya
          for (var i = 1; i < starNumber; i++) {
              var prevStarId = 'star' + i;
              document.getElementById(prevStarId).classList.add('checked');
          }
      }
  }

  // Tambahkan event listener untuk setiap bintang
  document.getElementById('star1').addEventListener('click', function() {
      handleStarClick('star1');
  });
  document.getElementById('star2').addEventListener('click', function() {
      handleStarClick('star2');
  });
  document.getElementById('star3').addEventListener('click', function() {
      handleStarClick('star3');
  });
  document.getElementById('star4').addEventListener('click', function() {
      handleStarClick('star4');
  });
  document.getElementById('star5').addEventListener('click', function() {
      handleStarClick('star5');
  });
</script>

</body>

</html>
