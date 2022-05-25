@extends('frontend.master')
@section('title', 'Đăng ký')
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
    <section class="signup">
        <div class="login_box">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Đăng ký</h2>
                    <form method="POST" class="register-form" id="register-form">
                        @csrf
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="name" id="name" placeholder="Họ tên" />
                        </div>
                        @error('name')
                            <div class="text-danger text-left">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Email" />
                        </div>
                        @error('email')
                            <div class="text-danger text-left">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="password"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="password" placeholder="Nhập mật khẩu" />
                        </div> @error('password')
                            <div class="text-danger text-left">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="password2"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="password2" id="password2" placeholder="Nhập lại mật khẩu" />
                        </div> @error('password2')
                            <div class="text-danger text-left">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>Đồng ý với tất cả điền khoản </label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" id="signup" class="form-submit" value="Đăng ký" />
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="{{ url('frontend') }}/images/signup-image.jpg" alt="sing up image"></figure>
                    <a href="{{ route('customer.login') }}" class="signup-image-link">Đã có tài khoản</a>
                </div>
            </div>
        </div>
    </section>

    {{-- <div class="clearfix"></div> --}}
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
