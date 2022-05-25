@extends('frontend.master')

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
                    <li><a
                            href="{{ route('customer.product.category', $product->category_id) }}">{{ $product->getCategory->name }}</a>
                    </li>
                    <li>{{ $product->name }}</li>
                </ul>
                <h1 class="page-tit">{{ $product->name }}</h1>
            </div>
        </div>
    </section>
    <!-- /Bredcrumb -->
    <!-- Content -->
    <div class="content-part detail-page">
        <div class="container">
            <div class="row">
                <section class="single-post-section">
                    <!-- product -->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="sp-wrap">
                            <a href="{{ url('uploads/product') }}/{{ $product->image }}"><img
                                    src="{{ url('uploads/product') }}/{{ $product->image }}" alt=""></a>
                            @foreach ($product->getImageProduct as $img)
                                <a href="{{ url('uploads/imageProduct') }}/{{ $img->image }}"><img
                                        src="{{ url('uploads/imageProduct') }}/{{ $img->image }}" alt=""></a>
                            @endforeach
                        </div>
                    </div>
                    <!-- /product -->
                    <!-- product discription -->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="product-single-meta">
                            <h3 class="product-name">{{ $product->name }}</h3>
                            <div class="ratting">
                                <ul>

                                    <li>
                                        <a href="#"><img
                                                src="{{ url('frontend') }}/{{ $rate >= 1 ? 'images/green-star-2.png' : '/images/dark-star-2.png' }}"
                                                alt="star" class="img-responsive"></a>
                                    </li>
                                    <li>
                                        <a href="#"><img
                                                src="{{ url('frontend') }}/{{ $rate >= 2 ? 'images/green-star-2.png' : '/images/dark-star-2.png' }}"
                                                alt="star" class="img-responsive"></a>
                                    </li>
                                    <li>
                                        <a href="#"><img
                                                src="{{ url('frontend') }}/{{ $rate >= 3 ? 'images/green-star-2.png' : '/images/dark-star-2.png' }}"
                                                alt="star" class="img-responsive"></a>
                                    </li>
                                    <li>
                                        <a href="#"><img
                                                src="{{ url('frontend') }}/{{ $rate >= 4 ? 'images/green-star-2.png' : '/images/dark-star-2.png' }}"
                                                alt="star" class="img-responsive"></a>
                                    </li>
                                    <li>
                                        <a href="#"><img
                                                src="{{ url('frontend') }}/{{ $rate >= 5 ? 'images/green-star-2.png' : '/images/dark-star-2.png' }}"
                                                alt="star" class="img-responsive"></a>
                                    </li>
                                </ul>
                                <span>( {{ $totals }} đánh giá )</span>
                            </div>
                            <div class="price">
                                @if ($product->sale_price > 0)
                                    <div class="new-price">
                                        {{ number_format($product->sale_price, 0, ',', '.') . ' VND' }}
                                    </div>
                                    <div class="old-price"><del>
                                            {{ number_format($product->price, 0, ',', '.') . ' VND' }}
                                        </del></div>
                                @else
                                    <div class="new-price">
                                        {{ number_format($product->price, 0, ',', '.') . ' VND' }}
                                    </div>
                                @endif

                            </div>
                            <div class="availablity">
                                @if (isset($product->getInventoryById($product->id)->qty))
                                    @if ($product->getInventoryById($product->id)->qty >= $product->import_quantity)
                                        Trong kho : <span>Hết hàng</span>

                                    @else
                                        Trong kho : <span>Còn
                                            {{ $product->import_quantity - $product->getInventoryById($product->id)->qty }}
                                            (kg)</span>

                                    @endif
                                @else
                                    Trong kho : <span>Còn {{ $product->import_quantity }} (kg)</span>
                                @endif
                            </div>
                            {{-- <p class="product-information">{!! Str::words($product->description, 45,'...') !!}</p> --}}
                            <div class="cart-process">
                                @if (isset($product->getInventoryById($product->id)->qty))
                                    @if ($product->getInventoryById($product->id)->qty >= $product->import_quantity)
                                        <form action="" method="post">
                                            @csrf

                                            <div class="qty">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number"
                                                        disabled="disabled" data-type="minus" data-field="quantity"> -
                                                    </button>
                                                </span>
                                                <input type="text" name="quantity" class="form-control input-number"
                                                    value="0.5" min="0.5" max="1000" id="quantity">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number"
                                                        data-type="plus" data-field="quantity"> + </button>

                                                </span>
                                            </div>
                                            @if (Auth::guard('customer')->check())
                                                <div class="cart">
                                                    <button type="submit" class="cart-btn btn-addCart" disabled
                                                        data-product="{{ $product->id }}"
                                                        data-user="{{ Auth::guard('customer')->user()->id }}"><i
                                                            class="icon-basket-supermarket"> </i></button>
                                                    @csrf
                                                </div>
                                            @else
                                                <div class="cart">
                                                    <a class="cart-btn" id="detail_id" onclick="return false"
                                                        href="{{ route('customer.login') }}?action=addCart&product_id={{ $product->id }}&quantity=0.5"
                                                        data-url="{{ route('customer.login') }}?action=addCart&product_id={{ $product->id }}"><i
                                                            class="icon-basket-supermarket"></i>Mua ngay</a>
                                                </div>
                                            @endif

                                        </form>
                                        <div class="extra">
                                            <ul class="list-inline">
                                                <li>
                                                    @if (Auth::guard('customer')->check())
                                                        <form action="" method="post">
                                                            <button type="submit" class=" btn-submit" disabled
                                                                data-product="{{ $product->id }}"
                                                                data-user="{{ Auth::guard('customer')->user()->id }}"><i
                                                                    class="icon-favorite-heart-button"></i></button>
                                                            @csrf
                                                        </form>
                                                    @else
                                                        <form action="" method="post">
                                                            <a class=" " onclick="return false"
                                                                href="{{ route('customer.login') }}?action=addFavorite&product_id={{ $product->id }}"><i
                                                                    class="icon-favorite-heart-button"></i></a>
                                                            @csrf
                                                        </form>
                                                    @endif

                                                </li>
                                                <li><a href="#"><i class="icon-line-menu"></i></a></li>
                                            </ul>
                                        </div>
                                    @else
                                        <form action="" method="post">
                                            @csrf

                                            <div class="qty">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number"
                                                        disabled="disabled" data-type="minus" data-field="quantity"> -
                                                    </button>
                                                </span>
                                                <input type="text" name="quantity" class="form-control input-number"
                                                    value="0.5" min="0.5"
                                                    max="{{ $product->import_quantity - $product->getInventoryById($product->id)->qty }}"
                                                    id="quantity">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number"
                                                        data-type="plus" data-field="quantity"> + </button>

                                                </span>
                                            </div>
                                            @if (Auth::guard('customer')->check())
                                                <div class="cart">
                                                    <button type="submit" class="cart-btn btn-addCart"
                                                        data-product="{{ $product->id }}"
                                                        data-user="{{ Auth::guard('customer')->user()->id }}"><i
                                                            class="icon-basket-supermarket"></i></button>
                                                    @csrf
                                                </div>
                                            @else
                                                <div class="cart">
                                                    <a class="cart-btn" id="detail_id"
                                                        href="{{ route('customer.login') }}?action=addCart&product_id={{ $product->id }}&quantity=0.5"
                                                        data-url="{{ route('customer.login') }}?action=addCart&product_id={{ $product->id }}"><i
                                                            class="icon-basket-supermarket"></i>Mua ngay</a>
                                                </div>
                                            @endif

                                        </form>
                                        <div class="extra">
                                            <ul class="list-inline">
                                                <li>
                                                    @if (Auth::guard('customer')->check())
                                                        <form action="" method="post">
                                                            <button type="submit" class=" btn-submit"
                                                                data-product="{{ $product->id }}"
                                                                data-user="{{ Auth::guard('customer')->user()->id }}"><i
                                                                    class="icon-favorite-heart-button"></i></button>
                                                            @csrf
                                                        </form>
                                                    @else
                                                        <form action="" method="post">
                                                            <a class=" "
                                                                href="{{ route('customer.login') }}?action=addFavorite&product_id={{ $product->id }}"><i
                                                                    class="icon-favorite-heart-button"></i></a>
                                                            @csrf
                                                        </form>
                                                    @endif

                                                </li>
                                                <li><a href="#"><i class="icon-line-menu"></i></a></li>
                                            </ul>
                                        </div>
                                    @endif
                                @else
                                    <form action="" method="post">
                                        @csrf

                                        <div class="qty">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default btn-number" disabled="disabled"
                                                    data-type="minus" data-field="quantity"> - </button>
                                            </span>
                                            <input type="text" name="quantity" class="form-control input-number" value="0.5"
                                                min="0.5" max="{{ $product->import_quantity }}" id="quantity">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default btn-number" data-type="plus"
                                                    data-field="quantity"> + </button>

                                            </span>
                                        </div>
                                        @if (Auth::guard('customer')->check())
                                            <div class="cart">
                                                <button type="submit" class="cart-btn btn-addCart"
                                                    data-product="{{ $product->id }}"
                                                    data-user="{{ Auth::guard('customer')->user()->id }}"><i
                                                        class="icon-basket-supermarket"></i></button>
                                                @csrf
                                            </div>
                                        @else
                                            <div class="cart">
                                                <a class="cart-btn" id="detail_id"
                                                    href="{{ route('customer.login') }}?action=addCart&product_id={{ $product->id }}&quantity=0.5"
                                                    data-url="{{ route('customer.login') }}?action=addCart&product_id={{ $product->id }}"><i
                                                        class="icon-basket-supermarket"></i>Mua ngay</a>
                                            </div>
                                        @endif

                                    </form>
                                    <div class="extra">
                                        <ul class="list-inline">
                                            <li>
                                                @if (Auth::guard('customer')->check())
                                                    <form action="" method="post">
                                                        <button type="submit" class=" btn-submit"
                                                            data-product="{{ $product->id }}"
                                                            data-user="{{ Auth::guard('customer')->user()->id }}"><i
                                                                class="icon-favorite-heart-button"></i></button>
                                                        @csrf
                                                    </form>
                                                @else
                                                    <form action="" method="post">
                                                        <a class=" "
                                                            href="{{ route('customer.login') }}?action=addFavorite&product_id={{ $product->id }}"><i
                                                                class="icon-favorite-heart-button"></i></a>
                                                        @csrf
                                                    </form>
                                                @endif

                                            </li>
                                            <li><a href="#"><i class="icon-line-menu"></i></a></li>
                                        </ul>
                                    </div>
                                @endif


                            </div>
                            <div class="tag-box">
                                <div class="tag-row">
                                    <span class="tag-label category">Danh mục</span><span class="dots">:</span>
                                    <div class="tag-label-value category-value">{{ $product->getCategory->name }}</div>
                                </div>
                                <div class="tag-row">
                                    <span class="tag-label">Nhà cung cấp</span><span class="dots">:</span>
                                    <div class="tag-label-value"><a class="tag-btn"
                                            href="#">{{ $product->getBrand->name }}</a>
                                    </div>
                                </div>
                                <div class="tag-row">
                                    <span class="tag-label">Share</span><span class="dots">:</span>
                                    <div class="tag-label-value">
                                        &nbsp;
                                        <ul class="social">
                                            <li><a href="#" target="_blank"><i class="icon-facebook"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="icon-twitter"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="icon-google-plus"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="icon-pinterest"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="icon-youtube"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /product discription -->

                </section>
                <!-- Tabbing -->
                <section class="tab-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="responsive-tabs">
                                    <h2>Mô tả sản phẩm</h2>
                                    <div class="responsive-tabs__panel--active">
                                        <p>{!! $product->description !!}</p>.</p>
                                    </div>
                                    <h2>Đánh giá (5)</h2>
                                    <div>
                                        @foreach ($reviews->getOrder($product->id) as $review)
                                            <div class="card comment-box"
                                                style="box-shadow: rgba(104, 104, 104, 0.2) 0px 2px 7px 0px;">
                                                <div class="row d-flex" style="display: flex;">
                                                    <div class="icon-part ">
                                                        @if ($review->user_image)
                                                            <img src="{{ url('uploads/user') }}/{{ $review->user_image }}"
                                                                alt="user" class="profile-pic img-responsive img-border">
                                                        @else
                                                            <img src="{{ url('frontend') }}/images/user-icon.png"
                                                                alt="user" class="profile-pic img-responsive img-border">
                                                        @endif

                                                    </div>
                                                    <div class="d-flex flex-column" style="padding-left: 20px">
                                                        <h4 class="mt-2 mb-0" style="margin:0px">{{ $review->user_name }}
                                                        </h4>
                                                        <div>
                                                            <p class="text-left" style="text-align:left;margin:0px"><span
                                                                    class="text-muted">{{ $review->rating }}.0</span>
                                                                <span
                                                                    class="fa fa-star {{ $review->rating >= 1 ? 'star-active' : 'star-inactive' }}  ml-3"></span>
                                                                <span
                                                                    class="fa fa-star {{ $review->rating >= 2 ? 'star-active' : 'star-inactive' }}"></span>
                                                                <span
                                                                    class="fa fa-star {{ $review->rating >= 3 ? 'star-active' : 'star-inactive' }}"></span>
                                                                <span
                                                                    class="fa fa-star {{ $review->rating >= 4 ? 'star-active' : 'star-inactive' }}"></span>
                                                                <span
                                                                    class="fa fa-star {{ $review->rating >= 5 ? 'star-active' : 'star-inactive' }} "></span>
                                                            </p>
                                                            <p class="content">{{ $review->message }}.</p>
                                                            <div class="row text-left"
                                                                style="text-align:left; display:flex;padding-left:20px">
                                                                @foreach ($reviews->getImageByReview($review->id)->getImageReview as $value)
                                                                    <img src="{{ url('uploads/review') }}/{{ $value->image }}"
                                                                        alt="" class="pic">
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>



                                            </div>

                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /Tabbing -->
                <!-- Related Products -->
                <section class="related-products">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="tit">
                                    <h2>Sản phẩm liên quan</h2>
                                </div>
                                <div class="owl-carousel owl-theme related-product-slider">
                                    @foreach ($related_products as $new)
                                        @if (isset($new->getInventoryById($new->id)->qty))



                                            @if ($new->getInventoryById($new->id)->qty >= $new->import_quantity)
                                                <div class="item">
                                                    <div class="wrapper">
                                                        <div class="pro-img"> <img
                                                                src="{{ url('uploads/product') }}/{{ $new->image }}"
                                                                alt="new arrival" class="img-responsive" /> </div>
                                                        @if (Auth::guard('customer')->check())
                                                            <div class="contain-wrapper">
                                                                <div class="tit">{{ $new->name }}</div>
                                                                <div class="price">
                                                                    <div class="new-price">
                                                                        {{ $new->sale_price > 0 ? number_format($new->sale_price, 0, ',', '.') . ' VND' : number_format($new->price, 0, ',', '.') . ' VND' }}
                                                                    </div>
                                                                    <div class="old-price">
                                                                        <del>{{ $new->sale_price > 0 ? number_format($new->price, 0, ',', '.') . ' VND' : '' }}</del>
                                                                    </div>
                                                                </div>
                                                                <div class="btn-part">
                                                                    <form action="" method="post">
                                                                        <button class="btn-addCart cart-btn"
                                                                            data-quantity="1" disabled
                                                                            data-user="{{ Auth::guard('customer')->user()->id }}"
                                                                            data-product="{{ $new->id }}">Mua
                                                                            ngay</button><i
                                                                            class="icon-basket-supermarket"></i>
                                                                        @csrf
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="wrapper-box-hover">
                                                                <div class="text">
                                                                    <ul>
                                                                        <li>
                                                                            <form action="" method="post">
                                                                                <button type="submit" class=" btn-submit"
                                                                                    data-product="{{ $new->id }}"
                                                                                    data-user="{{ Auth::guard('customer')->user()->id }}"><i
                                                                                        class="icon-heart"
                                                                                        disabled></i></button>
                                                                                @csrf
                                                                            </form>
                                                                        </li>
                                                                        <li><a
                                                                                href="{{ route('danh-sach-san-pham.show', $new->slug) }}"><i
                                                                                    class="icon-view"></i></a>
                                                                        </li>
                                                                        <li>
                                                                            <form action="" method="post">
                                                                                <button type="submit" class="btn-addCart"
                                                                                    data-product="{{ $new->id }}"
                                                                                    data-user="{{ Auth::guard('customer')->user()->id }}"
                                                                                    data-quantity="1" disabled><i
                                                                                        class="icon-basket-supermarket"></i></button>
                                                                                @csrf
                                                                            </form>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="contain-wrapper">
                                                                <div class="tit">{{ $new->name }}</div>
                                                                <div class="price">
                                                                    <div class="new-price">
                                                                        {{ $new->sale_price > 0 ? number_format($new->sale_price, 0, ',', '.') . ' VND' : number_format($new->price, 0, ',', '.') . ' VND' }}
                                                                    </div>
                                                                    <div class="old-price">
                                                                        <del>{{ $new->sale_price > 0 ? number_format($new->price, 0, ',', '.') . ' VND' : '' }}</del>
                                                                    </div>
                                                                </div>
                                                                <div class="btn-part">
                                                                    <form action="" method="post">
                                                                        <a class="cart-btn"
                                                                            href="{{ route('customer.login') }}?action=addCart&product_id={{ $new->id }}&quantity=1 "
                                                                            onclick="return false "><i
                                                                                class="icon-basket-supermarket"></i>Mua
                                                                            ngay</a>
                                                                        @csrf
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="wrapper-box-hover">
                                                                <div class="text">
                                                                    <ul>
                                                                        <li>
                                                                            <form action="" method="post">
                                                                                <a class=" "
                                                                                    href="{{ route('customer.login') }}?action=addFavorite&product_id={{ $new->id }} onclick="
                                                                                    return false ""><i
                                                                                        class="icon-heart"></i></a>
                                                                                @csrf
                                                                            </form>
                                                                        </li>
                                                                        <li><a
                                                                                href="{{ route('danh-sach-san-pham.show', $new->slug) }}"><i
                                                                                    class="icon-view"></i></a>
                                                                        </li>
                                                                        <li>
                                                                            <form action="" method="post">
                                                                                <a class=""
                                                                                    href="{{ route('customer.login') }}?action=addCart&product_id={{ $new->id }}&quantity=1 "
                                                                                    onclick="return false "><i
                                                                                        class="icon-basket-supermarket"></i></a>
                                                                                @csrf
                                                                            </form>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        <div class="new">Hết</div>

                                                    </div>
                                                </div>
                                            @else
                                                <div class="item">
                                                    <div class="wrapper">
                                                        <div class="pro-img"> <img
                                                                src="{{ url('uploads/product') }}/{{ $new->image }}"
                                                                alt="new arrival" class="img-responsive" /> </div>
                                                        @if (Auth::guard('customer')->check())
                                                            <div class="contain-wrapper">
                                                                <div class="tit">{{ $new->name }}</div>
                                                                <div class="price">
                                                                    <div class="new-price">
                                                                        {{ $new->sale_price > 0 ? number_format($new->sale_price, 0, ',', '.') . ' VND' : number_format($new->price, 0, ',', '.') . ' VND' }}
                                                                    </div>
                                                                    <div class="old-price">
                                                                        <del>{{ $new->sale_price > 0 ? number_format($new->price, 0, ',', '.') . ' VND' : '' }}</del>
                                                                    </div>
                                                                </div>
                                                                <div class="btn-part">
                                                                    <form action="" method="post">
                                                                        <button class="btn-addCart cart-btn"
                                                                            data-quantity="1"
                                                                            data-user="{{ Auth::guard('customer')->user()->id }}"
                                                                            data-product="{{ $new->id }}">Mua
                                                                            ngay</button><i
                                                                            class="icon-basket-supermarket"></i>
                                                                        @csrf
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="wrapper-box-hover">
                                                                <div class="text">
                                                                    <ul>
                                                                        <li>
                                                                            <form action="" method="post">
                                                                                <button type="submit" class=" btn-submit"
                                                                                    data-product="{{ $new->id }}"
                                                                                    data-user="{{ Auth::guard('customer')->user()->id }}"><i
                                                                                        class="icon-heart"></i></button>
                                                                                @csrf
                                                                            </form>
                                                                        </li>
                                                                        <li><a
                                                                                href="{{ route('danh-sach-san-pham.show', $new->slug) }}"><i
                                                                                    class="icon-view"></i></a>
                                                                        </li>
                                                                        <li>
                                                                            <form action="" method="post">
                                                                                <button type="submit" class="btn-addCart"
                                                                                    data-product="{{ $new->id }}"
                                                                                    data-user="{{ Auth::guard('customer')->user()->id }}"
                                                                                    data-quantity="1"><i
                                                                                        class="icon-basket-supermarket"></i></button>
                                                                                @csrf
                                                                            </form>
                                                                        </li>
                                                                    </ul>

                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="contain-wrapper">
                                                                <div class="tit">{{ $new->name }}</div>
                                                                <div class="price">
                                                                    <div class="new-price">
                                                                        {{ $new->sale_price > 0 ? number_format($new->sale_price, 0, ',', '.') . ' VND' : number_format($new->price, 0, ',', '.') . ' VND' }}
                                                                    </div>
                                                                    <div class="old-price">
                                                                        <del>{{ $new->sale_price > 0 ? number_format($new->price, 0, ',', '.') . ' VND' : '' }}</del>
                                                                    </div>
                                                                </div>
                                                                <div class="btn-part">
                                                                    <form action="" method="post">
                                                                        <a class="cart-btn"
                                                                            href="{{ route('customer.login') }}?action=addCart&product_id={{ $new->id }}&quantity=1 "><i
                                                                                class="icon-basket-supermarket"></i>Mua
                                                                            ngay</a>
                                                                        @csrf
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="wrapper-box-hover">
                                                                <div class="text">
                                                                    <ul>
                                                                        <li>
                                                                            <form action="" method="post">
                                                                                <a class=" "
                                                                                    href="{{ route('customer.login') }}?action=addFavorite&product_id={{ $new->id }}"><i
                                                                                        class="icon-heart"></i></a>
                                                                                @csrf
                                                                            </form>
                                                                        </li>
                                                                        <li><a
                                                                                href="{{ route('danh-sach-san-pham.show', $new->slug) }}"><i
                                                                                    class="icon-view"></i></a>
                                                                        </li>
                                                                        <li>
                                                                            <form action="" method="post">
                                                                                <a class=""
                                                                                    href="{{ route('customer.login') }}?action=addCart&product_id={{ $new->id }}&quantity=1 "><i
                                                                                        class="icon-basket-supermarket"></i></a>
                                                                                @csrf
                                                                            </form>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($new->isHot == 1)
                                                            <div class="new">Hot</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <div class="item">
                                                <div class="wrapper">
                                                    <div class="pro-img"> <img
                                                            src="{{ url('uploads/product') }}/{{ $new->image }}"
                                                            alt="new arrival" class="img-responsive" /> </div>
                                                    @if (Auth::guard('customer')->check())
                                                        <div class="contain-wrapper">
                                                            <div class="tit">{{ $new->name }}</div>
                                                            <div class="price">
                                                                <div class="new-price">
                                                                    {{ $new->sale_price > 0 ? number_format($new->sale_price, 0, ',', '.') . ' VND' : number_format($new->price, 0, ',', '.') . ' VND' }}
                                                                </div>
                                                                <div class="old-price">
                                                                    <del>{{ $new->sale_price > 0 ? number_format($new->price, 0, ',', '.') . ' VND' : '' }}</del>
                                                                </div>
                                                            </div>
                                                            <div class="btn-part">
                                                                <form action="" method="post">
                                                                    <button class="btn-addCart cart-btn" data-quantity="1"
                                                                        data-user="{{ Auth::guard('customer')->user()->id }}"
                                                                        data-product="{{ $new->id }}">Mua
                                                                        ngay</button><i class="icon-basket-supermarket"></i>
                                                                    @csrf
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="wrapper-box-hover">
                                                            <div class="text">
                                                                <ul>
                                                                    <li>
                                                                        <form action="" method="post">
                                                                            <button type="submit" class=" btn-submit"
                                                                                data-product="{{ $new->id }}"
                                                                                data-user="{{ Auth::guard('customer')->user()->id }}"><i
                                                                                    class="icon-heart"></i></button>
                                                                            @csrf
                                                                        </form>
                                                                    </li>
                                                                    <li><a
                                                                            href="{{ route('danh-sach-san-pham.show', $new->slug) }}"><i
                                                                                class="icon-view"></i></a>
                                                                    </li>
                                                                    <li>
                                                                        <form action="" method="post">
                                                                            <button type="submit" class="btn-addCart"
                                                                                data-product="{{ $new->id }}"
                                                                                data-user="{{ Auth::guard('customer')->user()->id }}"
                                                                                data-quantity="1"><i
                                                                                    class="icon-basket-supermarket"></i></button>
                                                                            @csrf
                                                                        </form>
                                                                    </li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="contain-wrapper">
                                                            <div class="tit">{{ $new->name }}</div>
                                                            <div class="price">
                                                                <div class="new-price">
                                                                    {{ $new->sale_price > 0 ? number_format($new->sale_price, 0, ',', '.') . ' VND' : number_format($new->price, 0, ',', '.') . ' VND' }}
                                                                </div>
                                                                <div class="old-price">
                                                                    <del>{{ $new->sale_price > 0 ? number_format($new->price, 0, ',', '.') . ' VND' : '' }}</del>
                                                                </div>
                                                            </div>
                                                            <div class="btn-part">
                                                                <form action="" method="post">
                                                                    <a class="cart-btn"
                                                                        href="{{ route('customer.login') }}?action=addCart&product_id={{ $new->id }}&quantity=1 "><i
                                                                            class="icon-basket-supermarket"></i>Mua ngay</a>
                                                                    @csrf
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="wrapper-box-hover">
                                                            <div class="text">
                                                                <ul>
                                                                    <li>
                                                                        <form action="" method="post">
                                                                            <a class=" "
                                                                                href="{{ route('customer.login') }}?action=addFavorite&product_id={{ $new->id }}"><i
                                                                                    class="icon-heart"></i></a>
                                                                            @csrf
                                                                        </form>
                                                                    </li>
                                                                    <li><a
                                                                            href="{{ route('danh-sach-san-pham.show', $new->slug) }}"><i
                                                                                class="icon-view"></i></a>
                                                                    </li>
                                                                    <li>
                                                                        <form action="" method="post">
                                                                            <a class=""
                                                                                href="{{ route('customer.login') }}?action=addCart&product_id={{ $new->id }}&quantity=1 "><i
                                                                                    class="icon-basket-supermarket"></i></a>
                                                                            @csrf
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($new->isHot == 1)
                                                        <div class="new">Hot</div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /Related Products -->
            </div>
        </div>
    </div>
    <!-- /Content -->

@stop

@section('js')
    <script src="{{ url('frontend') }}/js/sweetalert.min.js"></script>


    <script>
        $(document).ready(function() {

            // Check Radio-box
            $(".rating_feedback input:radio").attr("checked", false);

            $(".rating_feedback input").click(function() {
                $(".rating_feedback span").removeClass("checked");
                $(this).parent().addClass("checked");
            });

            $(".rating_feedback input:radio").change(function() {
                var userRating = this.value;
            });



            $(".btn-submit").click(function(e) {
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var product_id = $(this).data('product');
                var user_id = $(this).data('user');

                var url = "{{ route('san-pham-yeu-thich.store') }}";
                // alert(url);
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: _token,
                        product_id: product_id,
                        user_id: user_id
                    },
                    success: function(data) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: false,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'success',
                            title: 'Sản phẩm đã được thêm vào danh sách yêu thích'
                        })
                    },
                    error: function(data) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: false,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'error',
                            title: 'Sản phẩm đã có trong danh sách yêu thích'
                        })
                    }
                });
                $.ajax({
                    type: "GET",
                    url: "{{ route('getTotalWishlist') }}",
                    data: {},
                    success: function(data) {
                        console.log(data);
                        $("#wishlistTotal").html(data);
                    },
                    error: function(res) {
                        console.log(res);
                    }
                })
            });
            $(".btn-addCart").click(function(e) {
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var product_id = $(this).data('product');
                var user_id = $(this).data('user');
                var quantity = $('#quantity').val();
                // alert(quantity)
                var url = "{{ route('gio-hang.store') }}";
                // alert(quantity)
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: _token,
                        product_id: product_id,
                        quantity: quantity,
                        user_id: user_id
                    },
                    success: function(data) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: false,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'success',
                            title: 'Sản phẩm đã được thêm vào giỏ hàng'
                        })
                    },
                    error: function(data) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: false,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'error',
                            title: 'Không thể thêm sản phẩm vào giỏ hàng'
                        })
                    }
                })
                $.ajax({
                    type: "GET",
                    url: "{{ route('getTotalPrice') }}",
                    data: {},
                    success: function(data) {
                        console.log(data);
                        $("#cartTotal").html(data);
                    },
                    error: function(res) {
                        console.log(res);
                    }
                })
                $.ajax({
                    type: "GET",
                    url: "{{ route('getCountCart') }}",
                    data: {},
                    success: function(data) {
                        $("#countCart").html(data);
                        $("#item-cart").html(data + ' items in your cart');
                    },
                    error: function(res) {
                        console.log(res);
                    }
                })
                $.ajax({
                    type: "GET",
                    url: "{{ route('getCart') }}",
                    data: {},
                    success: function(data) {
                        $("#minicart").html(data);
                    },
                    error: function(res) {
                        console.log(res);
                    }
                })

            });

        });
        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#files").on("change", function(e) {
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target.result +
                                "\" title=\"" + file.name + "\"/>" +
                                "<br/><span class=\"removes\"><i class=\"icon-cancel-music text-primary\"></i></span>" +
                                "</span>").insertAfter("#files");
                            $(".removes").click(function() {
                                $(this).parent(".pip").remove();
                            });
                        });
                        fileReader.readAsDataURL(f);
                    }
                    console.log(files);
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });
    </script>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        a {
            text-decoration: none !important;
            color: inherit
        }

        a:hover {
            color: #455A64
        }

        .card {
            border-radius: 5px;
            background-color: #fff;
            padding-left: 60px;
            padding-right: 60px;
            margin-top: 30px;
            padding-top: 30px;
            padding-bottom: 30px
        }

        .rating-box {
            width: 130px;
            height: 130px;
            margin-right: auto;
            margin-left: auto;
            background-color: #FBC02D;
            color: #fff
        }

        .rating-label {
            font-weight: bold
        }

        .rating-bar {
            width: 300px;
            padding: 8px;
            border-radius: 5px
        }

        .bar-container {
            width: 100%;
            background-color: #f1f1f1;
            text-align: center;
            color: white;
            border-radius: 20px;
            cursor: pointer;
            margin-bottom: 5px
        }

        .bar-5 {
            width: 70%;
            height: 13px;
            background-color: #FBC02D;
            border-radius: 20px
        }

        .bar-4 {
            width: 30%;
            height: 13px;
            background-color: #FBC02D;
            border-radius: 20px
        }

        .bar-3 {
            width: 20%;
            height: 13px;
            background-color: #FBC02D;
            border-radius: 20px
        }

        .bar-2 {
            width: 10%;
            height: 13px;
            background-color: #FBC02D;
            border-radius: 20px
        }

        .bar-1 {
            width: 0%;
            height: 13px;
            background-color: #FBC02D;
            border-radius: 20px
        }

        td {
            padding-bottom: 10px
        }

        .star-active {
            color: #FBC02D;
            margin-top: 10px;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .star-active:hover {
            color: #F9A825;
            cursor: pointer
        }

        .responsive-tabs p {
            margin: 0;
        }

        .star-inactive {
            color: #CFD8DC;
            margin-top: 10px;
            margin-bottom: 10px;
            font-size: 16px;

        }

        .responsive-tabs .fa {
            font-size: 15px;
        }


        .blue-text {
            color: #0091EA
        }

        .content {
            font-size: 18px
        }

        .icon-part {
            width: 90px;
            border-right: 1px solid #d7d3d0;
            padding-bottom: 30px
        }

        .profile-pic {
            width: 68px;
            height: 68px;
            border-radius: 100%;
            margin-right: 30px;

        }

        .pic {
            max-width: 54px;
            margin-right: 10px
        }

        .vote {
            cursor: pointer
        }

        .rating_feedback {
            float: right;
            width: 270px;
        }

        .rating_feedback span {
            float: right;
            position: relative;
        }

        .rating_feedback span input {
            position: absolute;
            top: 0px;
            left: 0px;
            opacity: 0;
        }

        .rating_feedback span label::before {
            display: inline-block;
            content: "\2605";
            text-align: center;
            font-size: 30px;
            margin-right: 2px;
            line-height: 30px;
        }

        .rating_feedback span:hover~span label,
        .rating_feedback span:hover label,
        .rating_feedback span.checked label,
        .rating_feedback span.checked~span label {
            color: #F90;
            content: "\2606";
        }

        input[type="file"] {
            display: block;
        }

        input#files {
            display: inline-block;
            width: 100%;
            padding: 100px 0 0 0;
            height: 100px;
            overflow: hidden;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            background: url('https://cdn1.iconfinder.com/data/icons/hawcons/32/698394-icon-130-cloud-upload-512.png') center center no-repeat #e4e4e4;
            border-radius: 20px;
            background-size: 60px 60px;
        }

        .imageThumb {
            width: 100px;
            border: 1px solid;
            padding: 1px;
            cursor: pointer;
            /* position: absolute; */
        }

        .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
            position: relative;
        }

        .removes {
            opacity: 0;
            position: absolute;
            top: -10px;
            right: -10px;
            border-radius: 10em;
            padding: 2px 6px 3px;
            text-decoration: none;
            font: 700 21px/20px sans-serif;
            background: #555;
            border: 3px solid #fff;
            color: #FFF;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5), inset 0 2px 4px rgba(0, 0, 0, 0.3);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
            -webkit-transition: background 0.5s;
            transition: background 0.5s;
        }

        .pip:hover .removes {
            background: #E54E4E;
            padding: 3px 7px 5px;
            top: -11px;
            right: -11px;
            opacity: 1;
        }

        .removes:active {
            background: #E54E4E;
            top: -10px;
            right: -11px;
        }



        .heading {
            font-size: 25px;
            margin-right: 25px;
        }

        .fa {
            font-size: 25px;
        }

        .checked {
            color: orange;
        }

        /* Three column layout */
        .side {
            float: left;
            width: 15%;
            margin-top: 10px;
        }

        .middle {
            margin-top: 10px;
            float: left;
            width: 70%;
        }

        /* Place text to the right */
        .right {
            text-align: right;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* The bar container */
        .bar-container {
            width: 100%;
            background-color: #f1f1f1;
            text-align: center;
            color: white;
        }

        /* Individual bars */
        .bar-5 {
            width: 60%;
            height: 18px;
            background-color: #04AA6D;
        }

        .bar-4 {
            width: 30%;
            height: 18px;
            background-color: #2196F3;
        }

        .bar-3 {
            width: 10%;
            height: 18px;
            background-color: #00bcd4;
        }

        .bar-2 {
            width: 4%;
            height: 18px;
            background-color: #ff9800;
        }

        .bar-1 {
            width: 15%;
            height: 18px;
            background-color: #f44336;
        }

        /* Responsive layout - make the columns stack on top of each other instead of next to each other */
        @media (max-width: 400px) {

            .side,
            .middle {
                width: 100%;
            }

            .right {
                display: none;
            }
        }

    </style>
@stop
