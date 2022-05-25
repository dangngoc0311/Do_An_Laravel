@extends('frontend.master')
@section('title', 'Liên hệ')
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
    <!-- Content -->
    <div class="content-part contact-page">
        <section class="address-part">
            <div class="container">
                <div class="row">
                    <div class="logo-part">
                        <img src="{{ url('frontend') }}/images/contact-page-logo.png" alt="logo"
                            class="img-responsive center-block" />
                    </div>
                    <div class="inner-part">
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="box address-box">
                                <div class="icon-part">
                                    <img src="{{ url('frontend') }}/images/location-icon.png" alt="location"
                                        class="img-responsive center-block" />
                                </div>
                                <div class="tit">
                                    <h3>Địa chỉ</h3>
                                    <p>{{ $infoShop->address }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="box phone-box">
                                <div class="icon-part">
                                    <img src="{{ url('frontend') }}/images/phone-icon.png" alt="phone"
                                        class="img-responsive center-block" />
                                </div>
                                <div class="tit">
                                    <h3>Số điện thoại</h3>
                                    <p><a href="tel:+11233123223">{{ $infoShop->phone }}</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="box email-box">
                                <div class="icon-part">
                                    <img src="{{ url('frontend') }}/images/message-icon.png" alt="message"
                                        class="img-responsive center-block" />
                                </div>
                                <div class="tit">
                                    <h3>email</h3>
                                    <p><a href="mailto:{{ $infoShop->email }}">{{ $infoShop->email }}</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="map-form">
            <div class="row no-gutter">
                <div class="col-sm-6 col-xs-12 form-part equal-height">
                    <div class="inner-part">
                        <div class="tit">
                            <h3><span>Liên hệ</span> với Organic</h3>
                        </div>
                        <form action="{{ route('customer.contact.store') }}" method="post">
                            @csrf
                            <div class="form-group col-sm-12 col-xs-12">
                                <input type="text" class="form-control" placeholder="Tên" name="name" />
                            </div>
                            @error('name')
                                <div class="text-white">{{ $message }}</div>
                            @enderror
                            <div class="form-group col-sm-12 col-xs-12">
                                <input type="text" class="form-control" placeholder="Email" name="email" />
                            </div>
                            @error('email')
                                <div class="text-white">{{ $message }}</div>
                            @enderror
                            <div class="form-group col-sm-12 col-xs-12">
                                <input type="text" class="form-control" placeholder="Số điện thoại" name="phone" />
                            </div>
                            @error('phone')
                                <div class="text-white">{{ $message }}</div>
                            @enderror
                            <div class="form-group col-sm-12 col-xs-12">
                                <input type="text" class="form-control" placeholder="Tiêu đề" name="subject" />
                            </div>
                            @error('subject')
                                <div class="text-white">{{ $message }}</div>
                            @enderror
                            <div class="form-group col-sm-12 col-xs-12">
                                <textarea class="form-control" placeholder="Nội dung" name="message"></textarea>
                            </div>
                            @error('message')
                                <div class="text-white">{{ $message }}</div>
                            @enderror
                            <div class="form-group col-sm-12 col-xs-12">
                                <button class="submit">Gửi</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12 map-section equal-height googlemap">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3671.8012130442257!2d72.55756651502764!3d23.03106998494874!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e84f53fffffff%3A0xa5680aa626bd4d43!2sNCode+Technologies%2C+Inc.!5e0!3m2!1sen!2sin!4v1537872305605"
                        width="600" height="450" allowfullscreen></iframe>
                </div>
            </div>
        </section>
    </div>
    <!-- /Content -->
@stop
