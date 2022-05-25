@extends('frontend.master')
@section('title', 'Tài khoản')
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
    <div class="container bootstrap snippets bootdey">
        <div class="row">
            <div class="profile-nav col-md-3" style="margin-top: 35px;
                            margin-bottom: 20px;">
                <div class="panel">
                    <div class="user-heading round">

                        @if (Auth::guard('customer')->user()->image)
                            <img id="profileImage"
                                src="{{ url('uploads/user') }}/{{ Auth::guard('customer')->user()->image }}" />
                        @else
                            <img id="profileImage" src="{{ url('frontend') }}/images/user-icon.png" />
                        @endif
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="p-image">
                                <i class="icon-camera upload-button"></i>
                                <input id="imageUpload" type="file" name="files" placeholder="Photo" required="">
                            </div>
                            <input type="hidden" name="id" value="{{ Auth::guard('customer')->user()->id }}">
                            <input type="submit" value="Change">
                        </form>
                        <h1>{{ Auth::guard('customer')->user()->name }}</h1>
                        <p>{{ Auth::guard('customer')->user()->email }}</p>
                    </div>

                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#"> <i class="fa fa-user"></i> Thông tin</a></li>

                    </ul>
                </div>
            </div>
            <div class="profile-info col-md-9" style="margin-top: 35px;
                            margin-bottom: 20px;">
                <div class="panel">

                    <div class="panel-body b" style="padding:0px 15px">
                        <div class="row">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-7 text-secondary ">
                                            <h6> {{ Auth::guard('customer')->user()->email }}
                                            </h6>
                                        </div>
                                        <div class="col-sm-2">
                                            <h6 class="mb-0"></h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <form action="" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Họ Tên</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary">
                                                <h6> <input type="text"
                                                        value="{{ Auth::guard('customer')->user()->name }}" name="name">
                                                </h6>
                                            </div><input type="hidden" name="id"
                                                value="{{ Auth::guard('customer')->user()->id }}">
                                            <div class="col-sm-2">
                                                <h6 class="mb-0"><input type="submit" value="Sửa"></h6>
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                    <form action="" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Số điện thoại</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary mb-0">
                                                <h6> <input type="number"
                                                        value="{{ Auth::guard('customer')->user()->phone }}"
                                                        name="phone"></h6>
                                            </div><input type="hidden" name="id"
                                                value="{{ Auth::guard('customer')->user()->id }}">
                                            <div class="col-sm-2">
                                                <h6 class="mb-0"><input type="submit" value="Sửa"></h6>
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                    <form action="" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Địa chỉ</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary mb-0">
                                                <h6> <input type="text"
                                                        value="{{ Auth::guard('customer')->user()->address }}"
                                                        name="address"></h6>
                                            </div><input type="hidden" name="id"
                                                value="{{ Auth::guard('customer')->user()->id }}">
                                            <div class="col-sm-2">
                                                <h6 class="mb-0"><input type="submit" value="Sửa"></h6>
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                    <form action="" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Mật khẩu</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary mb-0">
                                                <h6> <input type="password"
                                                        value="{{ session()->get('user_password')['password'] }}"
                                                        name="password" id="password-field">
                                                    <span toggle="#password-field" class=" zmdi field-icon zmdi-eye"
                                                        id="toggle-password"></span>
                                                </h6>
                                            </div><input type="hidden" name="id" id="password"
                                                value="{{ Auth::guard('customer')->user()->id }}">
                                            <div class="col-sm-2">
                                                <h6 class="mb-0"><input type="submit" value="Sửa"></h6>
                                            </div>
                                        </div>
                                    </form>
                                    <input type="hidden" name="id" value="{{ Auth::guard('customer')->user()->id }}">
                                    {{-- </form> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
        input {
            border-width: 0px;
            border: none;
            outline: none;
            line-height: normal;
        }

        .p-image {
            position: relative;
            top: -26px;
            right: -41px;
            color: #d83713;
            transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
        }

        .p-image:hover {
            transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
        }

        .upload-button {
            font-size: 1.3em;
        }

        .upload-button:hover {
            transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
            color: #999;
        }

        #imageUpload {
            display: none;
        }

        #profileImage {
            cursor: pointer;
        }

        #profile-container {
            width: 200px;
            height: 200px;
            overflow: hidden;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            -o-border-radius: 50%;
            border-radius: 50%;
        }

        #profile-container img {
            width: 200px;
            height: 200px;
        }


        .card {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
            margin-top: 5px;
            margin-bottom: 30px;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }



        .mb-3,
        .my-3 {
            margin-bottom: 1rem !important;
        }

        .bg-gray-300 {
            background-color: #e2e8f0;
        }

        .h-100 {
            height: 100% !important;
        }

        .shadow-none {
            box-shadow: none !important;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        input[type=submit] {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 5px 24px;
            text-decoration: none;
            /* margin: 4px 2px; */
            cursor: pointer;
            font-size: 10px;
        }
        }

        .profile-nav,
        .profile-info {
            margin-top: 30px;
        }

        .profile-nav .user-heading {
            background: rgba(58, 173, 72, 0.31);
            color: #fff;
            border-radius: 4px 4px 0 0;
            -webkit-border-radius: 4px 4px 0 0;
            padding: 30px;
            text-align: center;
        }

        .profile-nav .user-heading.round img {
            border-radius: 50%;
            -webkit-border-radius: 50%;
            border: 10px solid rgba(255, 255, 255, 0.363);
            display: inline-block;
        }

        .profile-nav .user-heading img {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            -webkit-border-radius: 50%;
        }

        .profile-nav .user-heading h1 {
            font-size: 22px;
            font-weight: 300;
            margin-bottom: 5px;
        }

        .profile-nav .user-heading p {
            font-size: 12px;
        }

        .profile-nav ul {
            margin-top: 1px;
        }

        .profile-nav ul>li {
            border-bottom: 1px solid #ebeae6;
            margin-top: 0;
            line-height: 30px;
        }

        .profile-nav ul>li:last-child {
            border-bottom: none;
        }

        .profile-nav ul>li>a {
            border-radius: 0;
            -webkit-border-radius: 0;
            color: #89817f;
            border-left: 5px solid #fff;
        }

        .profile-nav ul>li>a:hover,
        .profile-nav ul>li>a:focus,
        .profile-nav ul li.active a {
            background: #f8f7f5 !important;
            border-left: 5px solid #4CAF50;
            color: #89817f !important;
        }

        .profile-nav ul>li:last-child>a:last-child {
            border-radius: 0 0 4px 4px;
            -webkit-border-radius: 0 0 4px 4px;
        }

        .profile-nav ul>li>a>i {
            font-size: 16px;
            padding-right: 10px;
            color: #bcb3aa;
        }

        .r-activity {
            margin: 6px 0 0;
            font-size: 12px;
        }


        .p-text-area,
        .p-text-area:focus {
            border: none;
            font-weight: 300;
            box-shadow: none;
            color: #c3c3c3;
            font-size: 16px;
        }

        .profile-info .panel-footer {
            background-color: #f8f7f5;
            border-top: 1px solid #e7ebee;
        }

        .profile-info .panel-footer ul li a {
            color: #7a7a7a;
        }

        .bio-graph-heading {
            background: rgba(58, 173, 72, 0.31);
            color: #fff;
            text-align: center;
            font-style: italic;
            padding: 25px 110px;
            border-radius: 4px 4px 0 0;
            -webkit-border-radius: 4px 4px 0 0;
            font-size: 16px;
            font-weight: 300;
        }

        .bio-graph-info {
            color: #89817e;
        }

        .bio-graph-info h1 {
            font-size: 22px;
            font-weight: 300;
            margin: 0 0 20px;
        }

    </style>
    <link href="{{ url('frontend') }}/css/material-design-iconic-font.min.css" rel="stylesheet" />
@stop
@section('js')
    <script>
        $(".upload-button").click(function(e) {
            $("#imageUpload").click();
        });

        function fasterPreview(uploader) {
            if (uploader.files && uploader.files[0]) {
                $('#profileImage').attr('src',
                    window.URL.createObjectURL(uploader.files[0]));
            }
        }
        $("#imageUpload").change(function() {
            fasterPreview(this);
        });
        $("#toggle-password").click(function() {

            $(this).toggleClass("zmdi-eye-off");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
@stop
