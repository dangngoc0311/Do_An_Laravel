<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Organic Food ">
    <meta name="author" content="">
    <title>@yield('title') </title>
    <!-- Bootstrap v3.3.7 Style -->
    <link href="{{ url('frontend') }}/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Icons Style -->
    <link href="{{ url('frontend') }}/css/fontello.css" rel="stylesheet" />
    <!-- Carousel Style -->
    <link href="{{ url('frontend') }}/css/responsive-slider.css" rel="stylesheet" />
    <link href="{{ url('frontend') }}/css/owl.carousel.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ url('frontend') }}/css/animate.css"> --}}
    <link href="{{ url('frontend') }}/css/owl.theme.default.min.css" rel="stylesheet">
    <!-- Value Slider Style -->
    <link rel="stylesheet" href="{{ url('frontend') }}/css/jquery-ui.min.css">
    <link href="{{ url('frontend') }}/css/bootstrap-slider.min.css" rel="stylesheet">
    <!-- Smooth Product Style -->
    <link rel="stylesheet" href="{{ url('frontend') }}/css/smoothproducts.css">
    <!-- Responsive Tab Style -->
    <link href="{{ url('frontend') }}/css/responsive-tabs.css" rel="stylesheet">
    <!-- Gallery with tab Style -->
    <link rel="stylesheet" href="{{ url('frontend') }}/css/jquery.fancybox.min.css">
    <!-- Custom Style -->
    <link href="{{ url('frontend') }}/css/style.css" rel="stylesheet" />
    <!-- Custom Responsive Style -->
    <link href="{{ url('frontend') }}/css/query.css" rel="stylesheet" />
    <link href="{{ url('frontend') }}/css/icheck-bootstrap.min.css" rel="stylesheet" />
    <!-- Google Font Style -->

    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900"
        rel="stylesheet">
    <!-- Favicon and touch icons  -->
    <link rel="shortcut icon" href="{{ url('frontend') }}/images/logo.png" type="image/x-icon">
    <link href="{{ url('backend') }}/css/toastr.min.css" rel="stylesheet" />
    @yield('css')

</head>

<body>
    <!-- Loader -->
    {{-- <div id="loading">
        <div class="loader">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div> --}}
    <!-- /Loader -->
    <!-- Header -->
    <header>
        <div class="top-header">
            <div class="lpart">
                <div class="social">
                    <ul class="social-widget">
                        <li><a href="#" target="_blank"><i class="icon-facebook"></i></a></li>
                        <li><a href="#" target="_blank"><i class="icon-twitter"></i></a></li>
                        <li><a href="#" target="_blank"><i class="icon-google-plus"></i></a></li>
                        <li><a href="#" target="_blank"><i class="icon-pinterest"></i></a></li>
                        <li><a href="#" target="_blank"><i class="icon-youtube"></i></a></li>
                    </ul>
                </div>
                <div class="tel-and-email">
                    <p class="tel">SĐT : <a href="tel:+91123456789">(+) {{ $infoShop->phone }} </a></p>
                    <p class="mail">Email : <a href="mailto:inquiry@organicfoodstroe.com">{{ $infoShop->email }}</a>
                    </p>
                </div>
            </div>
            <div class="rpart">
                <div class="country">
                    <div id="country" class="select"><img src="{{ url('frontend') }}/images/franch-flag-icon.jpg"
                            alt="flag" />French</div>
                    <div id="country-drop" class="dropdown">
                        <ul>
                            <li><img src="{{ url('frontend') }}/images/franch-flag-icon.jpg" alt="flag" />French</li>
                            <li><img src="{{ url('frontend') }}/images/india-flag-icon.jpg" alt="flag" />India</li>
                        </ul>
                    </div>
                </div>
                <div class="currency">
                    <div class="btn dropdown-toggle" data-toggle="dropdown" data-rel="currency"><i
                            class="icon-dollar-symbol"></i>VND <i class="icon-angle-down"></i></div>
                    <ul class="dropdown-menu">
                        <li><a href="#">VND</a></li>
                        <li><a href="#">ind</a></li>
                        <li><a href="#">usd</a></li>
                    </ul>
                </div>
                <div class="account">
                    @if (Auth::guard('customer')->check())
                        <div class="btn dropdown-toggle" data-toggle="dropdown"><i
                                class="icon-avatar"></i>{{ Auth::guard('customer')->user()->name }}
                            <i class="icon-angle-down"></i>
                        </div>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('customer.profile') }}">Tài khoản</a></li>
                            <li><a href="{{ route('san-pham-yeu-thich.index') }}">Sản phẩm yêu thích</a></li>
                            <li><a href="{{ route('lich-su-mua-hang.index') }}">Lịch sử mua hàng</a></li>
                            <li><a href="{{ route('customer.register') }}">Đăng ký</a></li>
                            <li><a href="{{ route('customer.login') }}">Đăng nhập</a></li>
                            <li><a href="{{ route('customer.logout') }}">Đăng xuất</a></li>
                        </ul>
                    @else
                        <div class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-avatar"></i>Tài khoản
                            <i class="icon-angle-down"></i>
                        </div>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('customer.register') }}">Đăng ký</a></li>
                            <li><a href="{{ route('customer.login') }}">Đăng nhập</a></li>
                        </ul>
                    @endif

                </div>
            </div>
        </div>
        <div class="bottom-header">
            <div class="container">
                <div class="vishlist">
                    <div class="vishlist-inner">
                        <a href="{{ route('san-pham-yeu-thich.index') }}"><i class="icon-heart"></i></a>
                        <div class="vishlist-counter" id="wishlistTotal">{{ $wishlist_count }}</div>
                    </div>
                </div>
                <nav class="navbar">
                    <div class="nav-header">
                        <button type="button" class="navbar-toggle"> <span class="icon-bar"></span> <span
                                class="icon-bar"></span> <span class="icon-bar"></span> </button>
                        <div class="logo">
                            <a href="{{ route('customer.home') }}"><img
                                    src="{{ url('uploads/config') }}/{{ $infoShop->logo }}" alt="logo" /></a>
                        </div>
                    </div>
                    <div class="collapse" id="organic-food-navigation">
                        <div class="remove"><i class="icon-cancel-music"></i></div>
                        <div class="menu-logo">
                            <a href="{{ route('customer.home') }}"><img
                                    src="{{ url('uploads') }}/{{ $infoShop->logo }}" alt="logo" /></a>
                        </div>
                        <ul class="nav navbar-nav">
                            <li class="{{ Request::url() === route('customer.home') ? 'active' : '' }}"><a
                                    href="{{ route('customer.home') }}">Trang chủ</a></li>
                            <li class="{{ Request::url() === route('customer.about') ? 'active' : '' }}"><a
                                    href="{{ route('customer.about') }}">About</a></li>
                            <li
                                class="megamenu-li {{ Request::url() === route('danh-sach-san-pham.index') ? 'active' : '' }}">
                                <a href="{{ route('danh-sach-san-pham.index') }}">Sản phẩm</a><span
                                    class="icon-angle-down"></span>
                                <div class="megamenu">
                                    <div class="menu-part">
                                        @foreach ($category as $cate)
                                            <div class="col">
                                                <div class="menu-tit">{{ $cate->name }}</div>
                                                <ul>
                                                    @foreach ($cate->getProduct as $value)
                                                        <li><a
                                                                href="{{ route('danh-sach-san-pham.show', $value->slug) }}">{{ $value->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="img-part"> <img src="{{ url('frontend') }}/images/megamenu-img.jpg"
                                            alt="megamenu-add" /> </div>
                                </div>
                            </li>


                            <li class=" {{ Request::url() === route('customer.gallery') ? 'active' : '' }}"><a
                                    href="{{ route('customer.gallery') }}">Bộ sưu tập</a></li>
                            <li class="{{ Request::url() === route('danh-sach-bai-viet.index') ? 'active' : '' }} ">
                                <a href="{{ route('danh-sach-bai-viet.index') }}">Bài viết</a></li>
                            <li class="{{ Request::url() === route('customer.contact') ? 'active' : '' }}"><a
                                    href="{{ route('customer.contact') }}">Liên hệ</a></li>
                        </ul>
                    </div>
                </nav>
                <div class="search-and-cart">
                    <div class="search">
                        <div class="search-inner"><a href="#"><i class="icon-magnifying-glass"></i></a></div>
                    </div>
                    <div class="cart">
                        <div class="cart-inner">
                            <a href="#"><i class="icon-shopping-bag"></i></a>
                            <div id="countCart" class="cart-counter">{{ $count }}</div>
                        </div>
                        <div class="cart-popup" id="style-4">
                            <p class="item-in-cart" id="item-cart">{{ $count }} sản phẩm trong giỏ</p>
                            <div class="item-list" id="minicart">
                                @foreach ($cart as $ct)
                                    <div class="box">
                                        <div class="img-part"> <img
                                                src="{{ url('uploads') }}/{{ $ct->getProducts->image }}"
                                                alt="product" class="img-responsive" style='width:80px'> </div>
                                        <div class="text-part">
                                            <p><a class="product-name"> {{ $ct->getProducts->name }}</a></p>
                                        </div>
                                        <div class="text-part">
                                            <p>
                                            <div class="quantity-and-price">
                                                {{ $ct->quantity }} x
                                                {{ number_format($ct->getProducts->sale_price > 0 ? $ct->getProducts->sale_price : $ct->getProducts->price, 0, ',', '.') . ' VND' }}
                                            </div>
                                            </p>
                                        </div>
                                        <a href="#" class="clear-btn"><i class="icon-cancel-music"></i></a>
                                    </div>
                                @endforeach
                            </div>
                            <div class="cart-total"> <span id="cartTotal">Tổng tiền:
                                    {{ number_format($cart_total, 0, ',', '.') . ' VND' }}</span> </div>
                            <div class="cart-btm">
                                <div class="btn-group"> <a href="{{ route('gio-hang.index') }}"
                                        class="btn cart-view">view cart</a> <a href="{{ route('dat-hang.index') }}"
                                        class="btn checkout">checkout</a> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="searchbox">
                    <div class="inner">
                        <div class="container-1">
                            <div class="pos-rel">
                                <form action="{{ route('customer.search_product') }}" method="POST">
                                    @csrf
                                    <input class="input-serch" type="text" name="keywords"
                                        placeholder="Search our store" />
                                    <div class="cross"><button type="submit" style="border: none;
                                        outline:none; background:none"><i class="icon-magnifying-glass"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- /Header -->
    <div class="clearfix"></div>
    @section('js')
        <script>

        </script>
    @stop
