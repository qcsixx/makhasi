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
    <!-- <link rel="stylesheet" href="{{ asset('css/detail/classy-nav.min.css') }}"> Removed to prevent conflict -->
    <link rel="stylesheet" href="{{ asset('css/detail/custom-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail/nice-select.min.css') }}">

    <!-- Bootstrap Core (Use same as Menu page) -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />

    <!-- Font Awesome -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />

    <!-- Custom Style (Main) -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />

    <style>
        .single-preparation-step h4 {
            font-size: 1.2rem;
            /* Ubah ukuran font sesuai kebutuhan */
            margin-right: 10px;
            /* Sesuaikan jarak antar angka dan teks */
        }

        .single-preparation-step {
            margin-bottom: 10px;
            /* Kurangi jarak antar langkah */
            align-items: flex-start;
            /* Pastikan item sejajar di atas */
        }

        .single-preparation-step p {
            margin: 0;
            /* Hilangkan margin dari paragraf */
        }
    </style>
    <style>
        /* Style untuk bintang yang aktif */
        .ratings .fas.active {
            color: gold;
            /* Ubah warna bintang yang aktif */
        }

        /* Style untuk ikon favorit */
        .favorite-icon {
            color: red;
            margin-left: 10px;
            cursor: pointer;
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
              <li class="nav-item active">
                <a class="nav-link" href="/menu">Menu <span class="sr-only">(current)</span> </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/about">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/library">Library</a>
              </li>
              @auth
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

    <div class="clearfix"></div>

    <section class="food_section layout_padding-bottom"></section>
    <!-- Receipe Slider -->
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <img src="{{ asset('images/' . $makanan->image) }}" alt="{{ $makanan->nama }} - Makanan khas Indonesia"
                    class="mx-auto d-block" loading="lazy">
            </div>
        </div>
    </div>

    <!-- Receipe Post Area -->
    <div class="receipe-post-area section-padding-80">

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="container">
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px; background-color: #d4edda; border-color: #c3e6cb; color: #155724;">
                    <strong>Berhasil!</strong> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 10px; background-color: #f8d7da; border-color: #f5c6cb; color: #721c24;">
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

    </div>

    <!-- Receipe Content Area -->
    <div class="receipe-content-area">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="receipe-headline my-5">
                        <span>{{ $makanan->daerah->nama ?? 'Indonesia' }}</span>
                        <h2>{{ $makanan->nama }}
                            @auth
                                @if($inLibrary)
                                    <form action="{{ route('library.remove', $makanan->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="favorite-icon" style="background: none; border: none; cursor: pointer;"
                                                title="Hapus dari Library">
                                            <i class="fa fa-heart" style="color: #dc3545;"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('library.add') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="makanan_id" value="{{ $makanan->id }}">
                                        <button type="submit" class="favorite-icon" style="background: none; border: none; cursor: pointer;"
                                                title="Tambah ke Library">
                                            <i class="fa fa-heart-o" style="color: #666;"></i>
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </h2>
                        <div class="receipe-duration">
                            <h6>{!! nl2br(e(strip_tags($makanan->deskripsi))) !!}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="receipe-ratings text-right my-5">
                        <!-- Average Rating Display -->
                        <div class="average-rating mb-3">
                            <h5 style="color: #ffbe33; margin-bottom: 5px;">
                                {{ number_format($makanan->ratings()->avg('rating') ?? 0, 1) }} / 5.0
                            </h5>
                            <small style="color: #666;">
                                ({{ $makanan->ratings()->count() }} {{ $makanan->ratings()->count() == 1 ? 'review' : 'reviews' }})
                            </small>
                        </div>

                        <!-- Star Display -->
                        <div class="ratings">
                            @php
                                $avgRating = $makanan->ratings()->avg('rating') ?? 0;
                                $fullStars = floor($avgRating);
                                $halfStar = ($avgRating - $fullStars) >= 0.5;
                            @endphp

                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $fullStars)
                                    <i class="fa fa-star" style="color: #ffbe33;" aria-hidden="true"></i>
                                @elseif($i == $fullStars + 1 && $halfStar)
                                    <i class="fa fa-star-half-o" style="color: #ffbe33;" aria-hidden="true"></i>
                                @else
                                    <i class="fa fa-star-o" style="color: #ccc;" aria-hidden="true"></i>
                                @endif
                            @endfor
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
                    @php
                        $cleanResep = strip_tags($makanan->resep);
                        $steps = preg_split('/[.\n]+/', $cleanResep);
                    @endphp
                    @foreach ($steps as $langkah)
                        @if(trim($langkah))
                            <div class="single-preparation-step d-flex">
                                <h4>{{ $loop->iteration }}.</h4>
                                <p>{{ trim($langkah) }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Rating & Review Section -->
            <div class="row mt-5">
                <div class="col-12">
                    <h4 class="mb-4">Rating & Reviews</h4>

                    @auth
                        <!-- Rating Form -->
                        <div class="card mb-4" style="border: 1px solid #e0e0e0; border-radius: 10px;">
                            <div class="card-body">
                                <h5 class="card-title">Rate this Food</h5>
                                <form action="{{ route('ratings.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="makanan_id" value="{{ $makanan->id }}">
                                    <input type="hidden" name="rating" id="rating-value" value="0">

                                    <!-- Star Rating Input -->
                                    <div class="mb-3">
                                        <label class="form-label">Your Rating:</label>
                                        <div class="star-rating-input">
                                            <i class="fa fa-star star-input" data-rating="1"></i>
                                            <i class="fa fa-star star-input" data-rating="2"></i>
                                            <i class="fa fa-star star-input" data-rating="3"></i>
                                            <i class="fa fa-star star-input" data-rating="4"></i>
                                            <i class="fa fa-star star-input" data-rating="5"></i>
                                        </div>
                                        <small class="text-muted">Click on stars to rate</small>
                                    </div>

                                    <!-- Review Text -->
                                    <div class="mb-3">
                                        <label for="review" class="form-label">Your Review (Optional):</label>
                                        <textarea name="review" id="review" class="form-control" rows="3"
                                                  placeholder="Share your thoughts about this food..."></textarea>
                                    </div>

                                    <button type="submit" class="btn" style="background-color: #ffbe33; color: white; border: none; padding: 10px 30px; border-radius: 25px;">
                                        Submit Rating
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="alert" style="background-color: #fff3cd; border: 1px solid #ffbe33; border-radius: 10px; padding: 15px;">
                            <p class="mb-0">
                                <a href="{{ route('login') }}" style="color: #ffbe33; font-weight: bold;">Login</a> to rate and review this food
                            </p>
                        </div>
                    @endauth

                    <!-- Display Reviews -->
                    @if($makanan->ratings()->count() > 0)
                        <div class="reviews-list mt-4">
                            <h5 class="mb-3">User Reviews</h5>
                            @foreach($makanan->ratings()->with('user')->latest()->get() as $rating)
                                <div class="review-item mb-3 p-3" style="background-color: #f8f9fa; border-radius: 10px;">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <strong>{{ $rating->user->name }}</strong>
                                            <div class="rating-stars mt-1">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $rating->rating)
                                                        <i class="fa fa-star" style="color: #ffbe33; font-size: 14px;"></i>
                                                    @else
                                                        <i class="fa fa-star-o" style="color: #ccc; font-size: 14px;"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                        <small class="text-muted">{{ $rating->created_at->diffForHumans() }}</small>
                                    </div>
                                    @if($rating->review)
                                        <p class="mt-2 mb-0">{{ $rating->review }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center mt-4">
                    <a href="/menu" class="btn btn-warning text-white py-2 px-5 rounded-pill font-weight-bold shadow-sm" style="background-color: #ffbe33; border: none; font-size: 16px;">
                        &larr; Back to Menu
                    </a>
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
                        <p>Bergabunglah dengan kami di MaKhasi dan jadilah bagian dari perjalanan mengagumkan untuk
                            mengapresiasi dan mendukung keberlanjutan kuliner Indonesia. Mari bersama-sama merasakan
                            kelezatan dan keindahan makanan khas Indonesia di MaKhasi.</p>
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
                    <a href="https://themewagon.com/" target="_blank">MaKhasi</a>
                </p>
            </div>
        </div>
    </footer>
    <!-- jQery -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
    <!-- nice select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <!-- custom js -->
    <script src="{{ asset('js/custom.js') }}"></script>

    <!-- Recipe Specific Scripts (Star Rating & Checkbox) -->
    <script>
        // Checkbox Strikethrough Functionality
        document.addEventListener('DOMContentLoaded', function () {
            // Get the instructions string from Laravel variable
            var instructions = @json($makanan->panduan);

            // Strip HTML tags and split by dot or newline
            var tempDiv = document.createElement('div');
            tempDiv.innerHTML = instructions;
            var cleanText = tempDiv.textContent || tempDiv.innerText || '';

            // Split by period or newline
            var instructionsArray = cleanText.split(/[.\n]+/);

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
        // Star Rating Input Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const starInputs = document.querySelectorAll('.star-input');
            const ratingValueInput = document.getElementById('rating-value');

            starInputs.forEach(star => {
                // Hover effect
                star.addEventListener('mouseenter', function() {
                    const rating = this.getAttribute('data-rating');
                    highlightStars(rating);
                });

                // Click to select
                star.addEventListener('click', function() {
                    const rating = this.getAttribute('data-rating');
                    ratingValueInput.value = rating;
                    highlightStars(rating, true);
                });
            });

            // Reset on mouse leave from star container
            const starContainer = document.querySelector('.star-rating-input');
            if (starContainer) {
                starContainer.addEventListener('mouseleave', function() {
                    const currentRating = ratingValueInput.value;
                    if (currentRating > 0) {
                        highlightStars(currentRating, true);
                    } else {
                        resetStars();
                    }
                });
            }

            function highlightStars(rating, permanent = false) {
                starInputs.forEach((star, index) => {
                    if (index < rating) {
                        star.style.color = '#ffbe33';
                        star.classList.remove('fa-star-o');
                        star.classList.add('fa-star');
                    } else {
                        star.style.color = '#ccc';
                        star.classList.remove('fa-star');
                        star.classList.add('fa-star-o');
                    }
                });
            }

            function resetStars() {
                starInputs.forEach(star => {
                    star.style.color = '#ccc';
                    star.classList.remove('fa-star');
                    star.classList.add('fa-star-o');
                });
            }
        });
    </script>

    <style>
        .star-rating-input {
            font-size: 24px;
            cursor: pointer;
        }

        .star-input {
            color: #ccc;
            transition: color 0.2s ease;
            cursor: pointer;
            margin-right: 5px;
        }

        .star-input:hover {
            color: #ffbe33;
        }

        .review-item {
            transition: transform 0.2s ease;
        }

        .review-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
    </style>

</body>

</html>
