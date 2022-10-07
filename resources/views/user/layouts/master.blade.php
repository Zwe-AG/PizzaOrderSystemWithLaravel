<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="https://cdn-icons-png.flaticon.com/128/706/706934.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Jquery -->
    <link href="https://code.jquery.com/jquery-3.6.1.min.js" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('user/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet">

    <!-- Customized Stylesheet -->
    <link href="{{ asset('user/css/customstyle.css') }}" rel="stylesheet">

    <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">

</head>

<body>

        <div class="alert alert-dismissible fade show" role="alert" style="margin-bottom:-10px">
            <strong><marquee behavior="alternate">အားလုံးပဲမင်္ဂလာပါ My Shop Pizza မှ ကြိုဆိုပါတယ်။သင့်အတွက် ကောင်းမွန်သော ဝန်ဆောင်မှု ပေးနေပါသည်။</marquee></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>


    <!-- Start Scroll   -->
    {{-- <div class="progressIntro">
        <div class="progressContainer">
            <div class="progressbar" id="progressbar"></div>
        </div>
    </div> --}}
    <!-- End Scroll  -->

    <!-- Start Header Intro  -->
    <section class="headerintros visiblelgs">
        <div class="container infos">
            <table>
                <tr>
                    <td class="text-center"><i class="fas fa-clock"></i></td>
                </tr>
                <tr>
                    <td>Mon - Sat 8:00 - 18:00 <br>
                        Sunday Closed
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td class="text-center"><i class="fas fa-envelope"></i></td>
                </tr>
                <tr>
                    <td>
                        <a href="mailto:zwehtetag2019@gmail.com" class="text-dark text-decoration-none">pizza@myshop.com</a>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td class="text-center"><i class="fa-solid fa-truck-fast"></i></td>
                </tr>
                <tr>
                    <td>Van Facility available <br> for order and delivery</td>
                </tr>
            </table>

        </div>
    </section>
    <!-- End Header Intro  -->

    <!-- Start stick note  -->
    <div class="sticknotes">
        <a href="{{ route('user#home') }}" class="homes"> <i class="fa-solid fa-house"></i> Home</a>
        <a href="{{ route('user#profilepage') }}" class="carts"><i class="fa-solid fa-user me-1"></i>Profile</a>
        <a href="" class="logouts">
            <form action="{{  route('logout') }}" method="post" style="display:flex">
                @csrf
                <i class="fa-solid fa-right-from-bracket pt-2"></i>
                <button type="submit" style="background:transparent; border:none;display:inline;color:white">Logout</button>
            </form>
        </a>
    </div>
    <!-- End stick note  -->

    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30 header-2">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block py-4">
                <a href="" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">My</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
                </a>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto pt-4">
                            <a href="{{ route('user#home') }}" class="nav-item nav-link h4 py-3">Home</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <div class="dropdown d-inline">
                                <button class="btn btn-secondary dropdown-toggle rounded-1  ms-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i> {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                  <li class="my-2"><a class="dropdown-item" href="{{ route('user#profilepage') }}"><i class="fa-solid fa-user me-1"></i>Account</a></li>
                                  <li class="mb-2"><a class="dropdown-item" href="{{ route('user#changepassword') }}"><i class="fa-solid fa-key"></i>Change Password</a></li>
                                  <li>
                                    <span class="dropdown-item">
                                        <form action="{{  route('logout') }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger rounded"><i class="fa-solid fa-right-from-bracket mr-2" style="font-size: 15px"></i>Logout</button>
                                        </form>
                                    </span>
                                </li>
                                </ul>
                              </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    {{-- <div class="col-lg-5 mb-30">
        <div id="product-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner bg-light">
                <div class="carousel-item active">
                    <img class="w-100 h-100" src="img/product-1.jpg" alt="Image">
                </div>
                <div class="carousel-item">
                    <img class="w-100 h-100" src="img/product-2.jpg" alt="Image">
                </div>
                <div class="carousel-item">
                    <img class="w-100 h-100" src="img/product-3.jpg" alt="Image">
                </div>
                <div class="carousel-item">
                    <img class="w-100 h-100" src="img/product-4.jpg" alt="Image">
                </div>
            </div>
            <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                <i class="fa fa-2x fa-angle-left text-dark"></i>
            </a>
            <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                <i class="fa fa-2x fa-angle-right text-dark"></i>
            </a>
        </div>
    </div> --}}

    @yield('content')

    @yield('message')


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed dolor. Rebum tempor no vero est magna amet no</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                        <p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-text text-secondary my-3">
                    &copy; <a class="text-primary" href="#" id="getYear"></a> All Rights Reserved. Designed
                    by
                    <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Start Login Box  -->
    <button id="openform" class="open-btn"><img src="{{ asset('user/images/message.png') }}" alt=""></button>
    <div id="form-popup" class="form-popup">
        <form action="{{ route('user#contact') }}" method="POST" class="form-container">
            @csrf
            <h3 class="text-center my-3">Contact Me</h3>
            <div class="form-group mb-2">
                <label class="text-dark" style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">User Name</label>
                <input type="text" name="userName" class="form-control" value="{{ old('userName',Auth::user()->name ) }}">
            </div>
            <div class="form-group mb-2">
                <label class="text-dark" style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">User Email</label>
                <input type="email" name="userEmail" class="form-control" value="{{ old('userEmail',Auth::user()->email ) }}">
            </div>
            <label class="text-dark" style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">Message</label>
            <div class="form-group mb-2">
                <textarea name="userMessage" rows="5" class="form-control" required></textarea>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-info btn-sm rounded-1 mb-2 text-decoration-none fs-5" style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">Send Message</button>
                <button type="button" id="closeform" class="btn btn-danger btn-sm rounded-1 mb-2 fs-5" style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">Close</button>
            </div>
        </form>
    </div>
    <!-- End Login Box  -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('user/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('user/mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('user/js/main.js') }}"></script>
</body>
<!-- Custom JavaScript  -->
<script src="{{ asset('user/js/customscript.js') }}" type="text/javascript"></script>

@yield('scriptSource')

</html>
