@extends('frontend.master')
@section('title', 'Đăng nhập')
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
                    <li><a href="index.html">Home</a></li>
                    <li>@yield('title')</li>
                </ul>
                <h1 class="page-tit">@yield('title')</h1>
            </div>
        </div>
    </section>

    <section class="sign-in">
        <div class="login_box">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="{{ url('frontend') }}/images/signin-image.jpg" alt="sing up image"></figure>
                    <a href="{{ route('customer.register') }}" class="signup-image-link">Đăng ký tài khoản mới</a>
                </div>
                <div class="signin-form">
                    <h2 class="form-title">Đăng nhập</h2>
                    <form method="POST" class="register-form" id="login-form">
                        @csrf
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="email" id="email" placeholder=" Email" />
                        </div>
                        @error('email')
                            <div class="text-danger text-left">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="password"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="password" placeholder="Mật khẩu" />
                        </div>
                        @error('password')
                            <div class="text-danger text-left">{{ $message }}</div>
                        @enderror
                        <div class="form-row form-group">
                            <div class="form-group col-md-6" style="float:left">
                                <input type="checkbox" name="" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Ghi nhớ</label>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('customer.view_forgot') }}" class="signup-image-link">Quên mật khẩu ?</a>
                            </div>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" id="signin" class="form-submit" value="Đăng nhập" />
                        </div>
                    </form>
                    <div class="social-login">
                        <span class="social-label">Hoặc đăng nhập</span>
                        <ul class="socials">
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
    <link href="{{ url('frontend') }}/css/login.css" rel="stylesheet" />
    <link href="{{ url('frontend') }}/css/material-design-iconic-font.min.css" rel="stylesheet" />

@stop
