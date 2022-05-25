@extends('frontend.master')
@section('title', 'Bộ sưu tập')
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
    <div class="content-part account-page">
        <div class="container">
            <div id="gallery">
                <div class="row">
                    <div id="filters" class="text-center col-md-12 col-sm-12 col-xs-12">
                        <button class="filter-btn is-checked" data-filter="*">Xem tất cả</button>
                        @foreach ($cate_gallery as $cate)
                            <button class="filter-btn" data-filter=".{{ $cate->id }}">{{ $cate->name }}</button>
                        @endforeach
                    </div>
                    <div class="grid">
                        @foreach ($cate_gallery as $cate)
                            @foreach ($gallery->getGalleryByCategory($cate->id) as $value)

                                <div class="element-item {{ $value->category_gallery_id == $cate->id ? $cate->id : '' }} " data-category="{{ $value->category_gallery_id == $cate->id ? $cate->id : '' }}">
                                    <a href="{{ url('uploads/gallery') }}/{{ $value->image }}" data-fancybox="gallery" class="">
                                        <img draggable="false" class="center-block img-responsive"
                                            src="{{ url('uploads/gallery') }}/{{ $value->image }}" />
                                    </a>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Content -->
@stop
