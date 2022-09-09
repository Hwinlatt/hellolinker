<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Hello Linker</title>
    <link rel="icon" href="{{ asset('user/img/linklogo-circle.png') }}">
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/3b62b87f85.js" crossorigin="anonymous"></script>
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=myanmar3' />
    <!-- Dark MDB theme -->
    <link rel="stylesheet" href="{{ asset('user/css/mdb.dark.min.css') }}" />
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('owncorousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('owncorousel/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/custom.css') }}" />
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    @yield('styles')

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark position-sticky top-0 mainNav" style="z-index: 10">
        <!-- Container wrapper -->
        <div class="navbar-toggler">
            <a class="navbar-brand mt-2 mt-lg-0" href="{{ route('user#home') }}">
                <img src="{{ asset('user/img/linklogo.jpg') }}" height="40" class="rounded rounded-circle"
                    alt="MDB Logo" />
                <strong>Movies</strong>
            </a>
        </div>
        <div class="container-fluid">
            <!-- Toggle button -->

            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar brand -->
                <a class="navbar-brand mt-2 mt-lg-0 hideMobileView" href="{{ route('user#home') }}">
                    <img src="{{ asset('user/img/linklogo.jpg') }}" height="40"
                        class="rounded shadow  rounded-circle" alt="Liner Logo" loading="lazy" />
                    <strong>Movies</strong>
                </a>
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item ">
                        <a class="nav-link nav-home" href="{{ url('/') }}"><span language="eng">Home</span><span
                                language="mm">ပင်မစာမျက်နှာ</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link nav-movies" href="{{ route('user#movies') }}"><span
                                language="eng">Movies</span><span language="mm">ရုပ်ရှင်များ</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link nav-other" href="#"><span language="eng">Others</span><span
                                language="mm">အခြား</span></a>
                    </li>
                    @if (!empty(Auth::user()))
                        @if (Auth::user()->role == 'admin')
                            <li>
                                <a class="nav-link nav-other"
                                    href="{{ route('admin#movie_list') }}"><span>Admin-Dashboard</span></a>
                            </li>
                        @endif
                    @endif
                </ul>
                <!-- Search Bar -->
                <div class="nav-item ml-3">
                    <form action="" class="searchForm" method="get">
                        <div class="input-group me-2">
                            <div class="form-outline">
                                <input type="search" id="searchL" name="searchKey" class="form-control"
                                    value="{{ request('searchKey') }}" />
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Language -->
                <div class="nav-item me-3 me-lg-0 dropdown" style="width: fit-content">
                    <a class="dropdown-toggle btn btn-link text-light m-2 d-flex align-items-center hidden-arrow"
                        href="#" id="languages" role="button" data-mdb-toggle="dropdown" aria-expanded="false"><i
                            class="fa-solid fa-globe me-1"></i>
                        <span class="selLanguage"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="laguage" id="languages">
                        <li>
                            <a class="dropdown-item" language="eng"></i>English</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" language="mm" href="#" id="mm"
                                data-lang="cn">မြန်မာ</a>
                        </li>
                    </ul>
                </div>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <div class="d-flex align-items-center">

                @if (Auth::user())
                    <div class="dropdown">
                        <a class="text-reset me-3 dropdown-toggle hidden-arrow" href="#"
                            id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="badge rounded-pill badge-notification bg-danger">1</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="#">Some news</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Another news</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Avatar -->
                    <div class="dropdown">
                        <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#"
                            id="userMore" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            @if (Auth::user()->profile_photo_path)
                                <img src="{{ asset('storage/profile_photos/' . Auth::user()->profile_photo_path) }}"
                                    class="rounded-circle" width="25" height="25" alt="User Photo"
                                    loading="lazy" />
                            @else
                                <img src="{{ asset('storage/user_default.webp') }}" class="rounded-circle"
                                    height="25" alt="User Photo" loading="lazy" />
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMore">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.show') }}"><i
                                        class="fa-solid fa-circle-user me-2"></i>
                                    {{ Auth::user()->name }}</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="fa-solid fa-gear me-2"></i><span
                                        language="eng">Settings</span><span language="mm">ပြင်ဆင်မှူများ</span></a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault();document.querySelector('.logout-form').submit()"><i
                                        class="fa-solid fa-arrow-right-from-bracket me-2"></i> <span
                                        language="eng">Logout</span><span language="mm">အကောင့်မှထွက်ရန်</span></a>
                                <form action="{{ route('logout') }}" method="POST" class="d-none logout-form">@csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="d-flex align-items-center">
                        <a href="{{ route('login') }}" class="btn btn-link px-3 me-2">
                            <span language='eng'>login</span>
                            <span language='mm'>အကောင့်၀င်ရန်</span>
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary me-3">
                            <span language='eng'>Sign up for free</span>
                            <span language='mm'>အကောင့်ဖွင့်ရန်</span>
                        </a>
                    </div>
                @endif

                <!-- Notifications -->
            </div>
            <!-- Right elements -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
    @yield('content')
    <!-- Footer Start -->
    <footer class="text-center text-lg-start bg-dark text-muted">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
                <span>Get connected with us on social networks:</span>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-github"></i>
                </a>
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fa-solid fa-link"></i> Hello Linker
                        </h6>
                        <p>
                            <span language="eng">Hello Linker is trying to become one of the best entertainment
                                channal.</span>
                            <span language="mm">Hello Linker သည် အကောင်းဆုံးဖျော်ဖြေရေးချန်နယ်တစ်ခုဖြစ်လာရန်
                                ကြိုးစားနေပါသည်။</span>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Products
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Movie Linker</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Music Linker</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">News Linker</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset"></a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Useful links
                        </h6>
                        <p>
                            <a href="#!" class="text-reset"></a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset"></a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset"></a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset"></a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <p><i class="fa-brands fa-facebook me-3"></i> <a href="">Hello Linker</a></p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            hellolinker1@gmail.com
                        </p>
                        {{-- <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                        <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p> --}}
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2021 Copyright:
            <a class="text-reset fw-bold" href="https://mdbootstrap.com/"></a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer End -->


    <!-- MDB -->
    <script type="text/javascript" src="{{ asset('user/js/mdb.min.js') }}"></script>
    <!-- Custom scripts -->
    <script src="{{ asset('user/js/jquery.js') }}"></script>
    <!-- Owlcorousel -->
    <script src="{{ asset('owncorousel/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('owncorousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('user/js/custom.js') }}"></script>
    <script>
        if ('{{ session('success') }}') {
            Swal.fire(
                'Success',
                '@php echo session("success") @endphp',
                'success'
            )
        } else if ('{{ session('error') }}') {
            Swal.fire(
                'Fail',
                '@php echo session("error") @endphp',
                'error')
        }
    </script>
    @stack('scripts')
</body>

</html>
