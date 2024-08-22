<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="MkRqEzTGuoSx6LqJUm0OAKxSgNUYt26wTT7RMUZY">
    <link rel="manifest" href="manifest.json">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <meta name="theme-color" content="#e87316">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Surfside Media">
    <meta name="msapplication-TileImage" content="{{ asset('assets/images/favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Surfside Media">
    <meta name="keywords" content="Surfside Media">
    <meta name="author" content="Surfside Media">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <title>Black Hourse Store</title>

    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/ion.rangeSlider.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick/slick-theme.css') }}">
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('assets/css/demo4.css') }}">
    <style>
        .h-logo {
            max-width: 185px !important;
        }

        .f-logo {
            max-width: 220px !important;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .content {
            margin-left: 270px; /* Adjust this value to match the sidebar width + some margin */
            padding: 20px;
        }
        @media only screen and (max-width: 600px) {
            .h-logo {
                max-width: 110px !important;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ asset( 'assets/css/custom.css' ) }}">
    @stack('styles')

</head>

<body class="theme-color4 light ltr">
    <style>
        header .profile-dropdown ul li {
            display: block;
            padding: 5px 20px;
            border-bottom: 1px solid #ddd;
            line-height: 35px;
        }

        header .profile-dropdown ul li:last-child {
            border-color: #fff;
        }

        header .profile-dropdown ul {
            padding: 10px 0;
            min-width: 250px;
        }
        .brand-logo img{
            max-height: 80px!important;
        }
        .name-usr {
            background: #e87316;
            padding: 8px 12px;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 24px;
        }

        .name-usr span {
            margin-right: 10px;
        }
        #admin-header{
                margin-left: 270px;
            }
        @media (max-width:600px) {
            .h-logo {
                max-width: 150px !important;
            }

            i.sidebar-bar {
                font-size: 22px;
            }

            .mobile-menu ul li a svg {
                width: 20px;
                height: 20px;
            }

            .mobile-menu ul li a span {
                margin-top: 0px;
                font-size: 12px;
            }

            .name-usr {
                padding: 5px 12px;
            }
            
        }
    </style>
    <header class="header-style-2" id="admin-header">
        <div class="main-header navbar-searchbar">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-menu">
                            <div class="menu-left">
                                <div class="brand-logo">
                                    <a href="{{ route('app.index') }}">
                                        <img src="{{ asset( 'assets/images/logo.png' ) }}" class="h-logo img-fluid blur-up lazyload"
                                            alt="logo">
                                    </a>
                                </div>

                            </div>

                            <div class="menu-right">
                                <ul>
                                    <li>
                                        <div class="search-box theme-bg-color">
                                            <i data-feather="search"></i>
                                        </div>
                                    </li>
                                    <li class="onhover-dropdown wislist-dropdown">
                                        <div class="cart-media">
                                            <a href="{{route('wishlist.list')}}">
                                                <i data-feather="heart"></i>
                                                <span id="wishlist-count" class="label label-theme rounded-pill">
                                                    {{ Cart::instance('wishlist')->content()->count() }}
                                                </span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="onhover-dropdown wislist-dropdown">
                                        <div class="cart-media">
                                            <a href="{{ route( 'cart.index' ) }}">
                                                <i data-feather="shopping-cart"></i>
                                                <span id="cart-count" class="label label-theme rounded-pill">
                                                    {{ Cart::count() }}
                                                </span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="onhover-dropdown">
                                        <div class="cart-media name-usr">
                                           @auth {{ Auth::user()->name }} @endauth <i data-feather="user"></i>
                                        </div>
                                        <div class="onhover-div profile-dropdown">
                                            <ul>
                                                @if( Route::has( 'login' ) )
                                                    @auth
                                                        @if( Auth::user()->utype === 'ADM' )
                                                            <li>
                                                                <a href="{{ route('admin.index') }}" class="d-block">Dashboard</a>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <a href="{{ route('user.index') }}" class="d-block">My Account</a>
                                                            </li>
                                                        @endif
                                                        <li>
                                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frmlogout').submit();">Logout</a>
                                                            <form id="frmlogout" action="{{ route('logout') }}" method="POST" class="d-none">
                                                                @csrf
                                                            </form>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a href="{{ route('login') }}" class="d-block">Login</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('register') }}" class="d-block">Register</a>
                                                        </li>
                                                    @endauth
                                                @endif

                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="mobile-menu d-sm-none">
        <ul>
            <li>
                <a href="demo3.php" class="active">
                    <i data-feather="home"></i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)">
                    <i data-feather="align-justify"></i>
                    <span>Category</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)">
                    <i data-feather="shopping-bag"></i>
                    <span>Cart</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)">
                    <i data-feather="heart"></i>
                    <span>Wishlist</span>
                </a>
            </li>
            <li>
                <a href="user-dashboard.php">
                    <i data-feather="user"></i>
                    <span>Account</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 sidebar navbar-light">
                <h2 class="mb-3"><a href={{route('admin.index')}}>Dashboard</a></h2>
                <ul class="navbar-nav mr-auto flex-column vertical-nav">
                    <li class="nav-item">
                        <h3>PRODUCTS</h3>
                        <ul class="submenu d-flex flex-column">
                            <li><a class="nav-link" href="{{ Auth::user()->utype === 'ADM' ? route('product') : route('vendor.products') }}">All Product</a></li>
                            <li><a class="nav-link" href="{{ Auth::user()->utype === 'ADM' ? route('product.create') : route('vendor.product.create') }}">Add Product</a></li>
                        </ul>
                    </li>
                    @if( Auth::user()->utype === 'ADM' )
                    <hr class="hr" />
                    <li>
                        <h3>USERS</h3>
                        
                        <ul class="submenu d-flex flex-column">
                            <li><a class="nav-link" href="{{route( 'users.list' )}}">Users</a></li>
                            <li><a class="nav-link" href="{{route( 'user.create' )}}">Create user</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="col-md-9 content">
                @yield('content')
            </div>
        </div>
    </div>
    

    <div id="qvmodal"></div>

    <footer class="footer-sm-space mt-5">
        <div class="main-footer">
            <div class="container">

            </div>
        </div>

    </footer>


    <div class="modal fade cart-modal" id="addtocart" tabindex="-1" role="dialog" aria-label="myModalLabel"
        aria-hidden="true">
    </div>
    <div class="tap-to-top">
        <a href="#home">
            <i class="fas fa-chevron-up"></i>
        </a>
    </div>
    <div class="bg-overlay"></div>
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/feather/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/lazysizes.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick/slick.js') }}"></script>
    <script src="{{ asset('assets/js/slick/slick-animation.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick/custom_slick.js') }}"></script>
    <script src="{{ asset('assets/js/price-filter.js') }}"></script>
    <script src="{{ asset('assets/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('assets/js/filter.js') }}"></script>
    <script src="{{ asset('assets/js/newsletter.js') }}"></script>
    <script src="{{ asset('assets/js/cart_modal_resize.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme-setting.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script>
        $(function () {
            $('[data-bs-toggle="tooltip"]').tooltip()
        });
    </script>
    @stack('scripts')
</body>

</html>