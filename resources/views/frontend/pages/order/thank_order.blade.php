@extends('frontend.master')
@section('title', 'Cảm ơn')
@section('main')
    <section class="sub-banner">
        <h2 class="sr-only">Banner</h2>
        <img class="banner" src="{{ url('frontend') }}/images/cart-page-banner.jpg" alt="Banner">
    </section>
    <!-- /Banner -->
    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb">
                <ul class="list-inline">
                    <li><a href="{{ route('customer.home') }}">Trang chủ</a></li>
                    <li>@yield('title')</li>
                </ul>
                <h1 class="page-tit">@yield('title')</h1>
            </div>
        </div>
    </section>
    <div class="content-part cart-page">
        <div class="container">

            <div id="smiley">
                =))
            </div>

            <div class="jumbotron text-center" style="background: #98da8e17">
                <div id="thankyou">
                    <h2 id="h2thankyou">Thank you!</h2>
                </div>
                <p class="lead"><strong>Check email</strong> để theo dõi đơn hàng của bạn.</p>
                <hr>
                <p>
                    Nếu có thắc mắc ? <a href="{{ route('customer.contact') }}">Liên hệ với chúng tôi</a>
                </p>
                <div style="padding-top: 20px;"><a id="linkback" href="{{ route('danh-sach-san-pham.index') }}">Tiếp tục mua hàng!</a></div>

            </div>
        </div>
    </div>
    <!-- /Delivery Process -->
    <div class="clearfix"></div>
    <!-- Newsletter -->
    <section class="news-letter">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="center">
                        <h3 class="news-tit"><span>Đăng ký</span></h3>
                        <p class="instruction">Đăng ký để nhận <span>tin tức mới</span> và
                            <span>các ưu đãi</span>:
                        </p>
                        <div class="form">
                            <form action="#">
                                <input class="newsletter-input" type="text" placeholder="Nhập địa chỉ email">
                                <button class="newsletter-btn">Đăng ký</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('css')
    <style>
        #smiley {
            height: 190px;
            width: 190px;
            left: 290px;
            position: absolute;
            font-size: 150px;
            animation: wobble 8s infinite;
            -webkit-animation: wobble 8s infinite;

            opacity: 0.3;

        }






        @keyframes wobble {
            0% {
                transform: rotate(97deg);
            }

            50% {
                transform: rotate(83deg);
            }

            100% {
                transform: rotate(97deg);
            }
        }

        @-webkit-keyframes wobble {
            0% {
                transform: rotate(97deg);
            }

            50% {
                transform: rotate(83deg);
            }

            100% {
                transform: rotate(97deg);
            }
        }





        #thankyou {
            background-color: white;
            border-radius: 10px;
            height: 190px;
            font-weight: 500;
            /* width: 300px; */
            border: 6px solid #2fb22096;
            box-shadow: 7px 7px 4px #4999b6;
            margin: 14px auto 50px;
            text-align: center;
            -webkit-animation: flash 5.2s ease 0s infinite;
            animation: flash 5.2s ease 0s infinite;
        }

        #h2thankyou {
            color: #4999b6;
            padding: 32px;
            font-size: 44px;
            font-family: 'Open Sans', 'sans-serif';
            font-weight: 500;
            -webkit-animation: flashtwo 1.2s linear 0s infinite;
            animation: flashtwo 1.2s linear 0s infinite;
        }

        a {
            text-decoration: none;
            color: #4999b6;
        }

        #linkback {
            font-family: 'Open Sans'. 'sans-serif';
            text-decoration: none;
            padding: 12px;
            border: 2px solid white;
            background-color: white;
            border-radius: 4px;
            margin: 50px auto;
            font-weight: 500;
            width: 200px;
        }

        #linkback:hover {
            background-color: #2fb22096;
        }

        a:hover {
            color: white;
        }

        @keyframes flash {
            0% {
                background-color: white;
            }

            49% {
                background-color: white;
            }

            50% {
                background-color: #2fb22096;
            }

            100% {
                background-color: #2fb22096;
            }
        }

        @keyframes flashtwo {
            0% {
                color: #2fb22096;
            }

            49% {
                color: #2fb22096;
            }

            50% {
                color: white;
            }

            100% {
                color: white;
            }
        }

    </style>
@stop
