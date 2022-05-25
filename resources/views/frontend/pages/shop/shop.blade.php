@extends('frontend.master')
@section('title', 'Danh sách sản phẩm')
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
    <!-- /Breadcrumb -->
    <!-- Content -->
    <div class="content-part listing-page">
        <div class="container">
            <div class="row">
                <!-- Content left -->
                <aside class="col-md-3 col-sm-12 col-xs-12">
                    <div id="sidebar">
                        <div class="widget categories-widget">
                            <div class="widget-tit">
                                <h2>Categories</h2>
                                <div class="button" data-toggle="collapse" data-target="#categories">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </div>
                            </div>
                            <div class="widget-contian" id="categories">
                                <ul class="level-1 open">
                                    @foreach ($category as $cate)
                                        <li>
                                            <a
                                                href="{{ route('customer.product.category', $cate->id) }}">{{ $cate->name }}</a><span
                                                class="icon-right-arrow"></span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="widget price-range-widget">
                            <div class="widget-tit">
                                <h2>By price</h2>
                                <div class="button" data-toggle="collapse" data-target="#price">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </div>
                                <div class="price-range-wrap">
                                    <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                        data-min="8000" data-max="100000">
                                        <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                        <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                        <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    </div>
                                    <div class="range-slider">
                                        <form action="" method="get">
                                            <div class="price-input text-center">
                                                <span style="float: left;">Min :</span> <input type="text" id="minamount"
                                                    name="start"><span>VND</span>
                                            </div>
                                            <div class="price-input text-center">

                                                <span style="float: left"> Max :</span><input type="text" id="maxamount"
                                                    name="end"> VND
                                            </div>
                                            <div class="price-filter mr-3">
                                                <button class="submit px-3 btn btn-outline-success "
                                                    type="submit">Filter</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="widget tag-widgwet">
                            <div class="widget-tit">
                                <h2>Nhãn hàng</h2>
                                <div class="button" data-toggle="collapse" data-target="#tag">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </div>
                            </div>
                            <div class="widget-contian" id="tag">
                                <div class="tag-div">
                                    @foreach ($brand as $bd)
                                        <a class="tag-btn"
                                            href="{{ route('customer.product.brand', $bd->id) }}">{{ $bd->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="hot-collection">
                            <a href="#"><img src="{{ url('frontend') }}/images/hot-collection-img.jpg"
                                    alt="hot collection" class="img-responsive"></a>
                        </div>
                    </div>
                </aside>
                <!-- /Content left -->
                <!-- Content Right-->
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="filter">
                                <div class="r-part">

                                    <div class="grid-short">
                                        <div class="grid-layout"><a class="active" href="#" id="grid"><i
                                                    class="icon-grid-layout"></i></a></div>
                                        <div class="list-grid"><a href="#" id="list-btn"><i class="icon-list-grid"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="l-part">
                                    <div>Showing <span>{{ $product->currentPage() }}–{{ $product->lastPage() }}</span>
                                        of <span>{{ $product->total() }} results</span></div>
                                </div>
                            </div>
                        </div>
                        <div id="products" class="product-list list-group">
                            @foreach ($product as $pro)
                            @if (isset($pro->getInventoryById($pro->id)->qty))



                            @if ($pro->getInventoryById($pro->id)->qty >= $pro->import_quantity)
                                <div class=" col-sm-4 col-xs-12 item">
                                    <div class="wrapper">
                                        <div class="pro-img"> <img src="{{ url('uploads/product') }}/{{ $pro->image }}"
                                                alt="new arrival" class="img-responsive" /> </div>
                                        @if (Auth::guard('customer')->check())
                                            <div class="contain-wrapper">
                                                <div class="tit">{{ $pro->name }}</div>
                                                <div class="price">
                                                    <div class="new-price">
                                                        {{ $pro->sale_price > 0 ? number_format($pro->sale_price, 0, ',', '.') . ' VND' : number_format($pro->price, 0, ',', '.') . ' VND' }}
                                                    </div>
                                                    <div class="old-price">
                                                        <del>{{ $pro->sale_price > 0 ? number_format($pro->price, 0, ',', '.') . ' VND' : '' }}</del>
                                                    </div>
                                                </div>
                                                <div class="btn-part">
                                                    <form action="" method="post">
                                                        <button class="btn-addCart cart-btn" data-quantity="1"
                                                            disabled
                                                            data-user="{{ Auth::guard('customer')->user()->id }}"
                                                            data-product="{{ $pro->id }}">Mua ngay</button><i
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
                                                                    data-product="{{ $pro->id }}"
                                                                    data-user="{{ Auth::guard('customer')->user()->id }}"><i
                                                                        class="icon-heart" disabled></i></button>
                                                                @csrf
                                                            </form>
                                                        </li>
                                                        <li><a
                                                                href="{{ route('danh-sach-san-pham.show', $pro->slug) }}"><i
                                                                    class="icon-view"></i></a>
                                                        </li>
                                                        <li>
                                                            <form action="" method="post">
                                                                <button type="submit" class="btn-addCart"
                                                                    data-product="{{ $pro->id }}"
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
                                                <div class="tit">{{ $pro->name }}</div>
                                                <div class="price">
                                                    <div class="new-price">
                                                        {{ $pro->sale_price > 0 ? number_format($pro->sale_price, 0, ',', '.') . ' VND' : number_format($pro->price, 0, ',', '.') . ' VND' }}
                                                    </div>
                                                    <div class="old-price">
                                                        <del>{{ $pro->sale_price > 0 ? number_format($pro->price, 0, ',', '.') . ' VND' : '' }}</del>
                                                    </div>
                                                </div>
                                                <div class="btn-part">
                                                    <form action="" method="post">
                                                        <a class="cart-btn"
                                                            href="{{ route('customer.login') }}?action=addCart&product_id={{ $pro->id }}&quantity=1 "
                                                            onclick="return false "><i
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
                                                                    href="{{ route('customer.login') }}?action=addFavorite&product_id={{ $pro->id }} onclick="
                                                                    return false ""><i class="icon-heart"></i></a>
                                                                @csrf
                                                            </form>
                                                        </li>
                                                        <li><a
                                                                href="{{ route('danh-sach-san-pham.show', $pro->slug) }}"><i
                                                                    class="icon-view"></i></a>
                                                        </li>
                                                        <li>
                                                            <form action="" method="post">
                                                                <a class=""
                                                                    href="{{ route('customer.login') }}?action=addCart&product_id={{ $pro->id }}&quantity=1 "
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
                                <div class=" col-sm-4 col-xs-12 item">
                                    <div class="wrapper">
                                        <div class="pro-img"> <img src="{{ url('uploads/product') }}/{{ $pro->image }}"
                                                alt="new arrival" class="img-responsive" /> </div>
                                        @if (Auth::guard('customer')->check())
                                            <div class="contain-wrapper">
                                                <div class="tit">{{ $pro->name }}</div>
                                                <div class="price">
                                                    <div class="new-price">
                                                        {{ $pro->sale_price > 0 ? number_format($pro->sale_price, 0, ',', '.') . ' VND' : number_format($pro->price, 0, ',', '.') . ' VND' }}
                                                    </div>
                                                    <div class="old-price">
                                                        <del>{{ $pro->sale_price > 0 ? number_format($pro->price, 0, ',', '.') . ' VND' : '' }}</del>
                                                    </div>
                                                </div>
                                                <div class="btn-part">
                                                    <form action="" method="post">
                                                        <button class="btn-addCart cart-btn" data-quantity="1"
                                                            data-user="{{ Auth::guard('customer')->user()->id }}"
                                                            data-product="{{ $pro->id }}">Mua ngay</button><i
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
                                                                    data-product="{{ $pro->id }}"
                                                                    data-user="{{ Auth::guard('customer')->user()->id }}"><i
                                                                        class="icon-heart"></i></button>
                                                                @csrf
                                                            </form>
                                                        </li>
                                                        <li><a
                                                                href="{{ route('danh-sach-san-pham.show', $pro->slug) }}"><i
                                                                    class="icon-view"></i></a>
                                                        </li>
                                                        <li>
                                                            <form action="" method="post">
                                                                <button type="submit" class="btn-addCart"
                                                                    data-product="{{ $pro->id }}"
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
                                                <div class="tit">{{ $pro->name }}</div>
                                                <div class="price">
                                                    <div class="new-price">
                                                        {{ $pro->sale_price > 0 ? number_format($pro->sale_price, 0, ',', '.') . ' VND' : number_format($pro->price, 0, ',', '.') . ' VND' }}
                                                    </div>
                                                    <div class="old-price">
                                                        <del>{{ $pro->sale_price > 0 ? number_format($pro->price, 0, ',', '.') . ' VND' : '' }}</del>
                                                    </div>
                                                </div>
                                                <div class="btn-part">
                                                    <form action="" method="post">
                                                        <a class="cart-btn"
                                                            href="{{ route('customer.login') }}?action=addCart&product_id={{ $pro->id }}&quantity=1 "><i
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
                                                                    href="{{ route('customer.login') }}?action=addFavorite&product_id={{ $pro->id }}"><i
                                                                        class="icon-heart"></i></a>
                                                                @csrf
                                                            </form>
                                                        </li>
                                                        <li><a
                                                                href="{{ route('danh-sach-san-pham.show', $pro->slug) }}"><i
                                                                    class="icon-view"></i></a>
                                                        </li>
                                                        <li>
                                                            <form action="" method="post">
                                                                <a class=""
                                                                    href="{{ route('customer.login') }}?action=addCart&product_id={{ $pro->id }}&quantity=1 "><i
                                                                        class="icon-basket-supermarket"></i></a>
                                                                @csrf
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($pro->isHot == 1)
                                            <div class="new">Hot</div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="col-sm-4 col-xs-12 item">
                                <div class="wrapper">
                                    <div class="pro-img"> <img src="{{ url('uploads/product') }}/{{ $pro->image }}"
                                            alt="new arrival" class="img-responsive" /> </div>
                                    @if (Auth::guard('customer')->check())
                                        <div class="contain-wrapper">
                                            <div class="tit">{{ $pro->name }}</div>
                                            <div class="price">
                                                <div class="new-price">
                                                    {{ $pro->sale_price > 0 ? number_format($pro->sale_price, 0, ',', '.') . ' VND' : number_format($pro->price, 0, ',', '.') . ' VND' }}
                                                </div>
                                                <div class="old-price">
                                                    <del>{{ $pro->sale_price > 0 ? number_format($pro->price, 0, ',', '.') . ' VND' : '' }}</del>
                                                </div>
                                            </div>
                                            <div class="btn-part">
                                                <form action="" method="post">
                                                    <button class="btn-addCart cart-btn" data-quantity="1"
                                                        data-user="{{ Auth::guard('customer')->user()->id }}"
                                                        data-product="{{ $pro->id }}">Mua ngay</button><i
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
                                                                data-product="{{ $pro->id }}"
                                                                data-user="{{ Auth::guard('customer')->user()->id }}"><i
                                                                    class="icon-heart"></i></button>
                                                            @csrf
                                                        </form>
                                                    </li>
                                                    <li><a
                                                            href="{{ route('danh-sach-san-pham.show', $pro->slug) }}"><i
                                                                class="icon-view"></i></a>
                                                    </li>
                                                    <li>
                                                        <form action="" method="post">
                                                            <button type="submit" class="btn-addCart"
                                                                data-product="{{ $pro->id }}"
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
                                            <div class="tit">{{ $pro->name }}</div>
                                            <div class="price">
                                                <div class="new-price">
                                                    {{ $pro->sale_price > 0 ? number_format($pro->sale_price, 0, ',', '.') . ' VND' : number_format($pro->price, 0, ',', '.') . ' VND' }}
                                                </div>
                                                <div class="old-price">
                                                    <del>{{ $pro->sale_price > 0 ? number_format($pro->price, 0, ',', '.') . ' VND' : '' }}</del>
                                                </div>
                                            </div>
                                            <div class="btn-part">
                                                <form action="" method="post">
                                                    <a class="cart-btn"
                                                        href="{{ route('customer.login') }}?action=addCart&product_id={{ $pro->id }}&quantity=1 "><i
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
                                                                href="{{ route('customer.login') }}?action=addFavorite&product_id={{ $pro->id }}"><i
                                                                    class="icon-heart"></i></a>
                                                            @csrf
                                                        </form>
                                                    </li>
                                                    <li><a
                                                            href="{{ route('danh-sach-san-pham.show', $pro->slug) }}"><i
                                                                class="icon-view"></i></a>
                                                    </li>
                                                    <li>
                                                        <form action="" method="post">
                                                            <a class=""
                                                                href="{{ route('customer.login') }}?action=addCart&product_id={{ $pro->id }}&quantity=1 "><i
                                                                    class="icon-basket-supermarket"></i></a>
                                                            @csrf
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($pro->isHot == 1)
                                        <div class="new">Hot</div>
                                    @endif
                                </div>
                            </div>
                        @endif

                            @endforeach
                            <div class="col-sm-12 col-xs-12">
                                <nav aria-label="Page navigation example">
                                    @if ($product->lastPage() > 1)
                                        <ul class="pagination">
                                            @if ($product->onFirstPage())
                                                <li class="hidden-md"></li>
                                            @else
                                                <li class="page-item indicator left"><a class="page-link"
                                                        href="{{ $product->previousPageUrl() }}" rel="prev"><i
                                                            class="icon-right-arrow"></i></a>
                                                </li>
                                            @endif
                                            @for ($i = 1; $i <= $product->lastPage(); $i++)
                                                <li class="page-item ">
                                                    <a class="page-link  {{ $i == $product->currentPage() ? 'active' : '' }}"
                                                        href="?page={{ $i }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            @if ($product->hasMorePages())
                                                <li class="page-item indicator right"><a class="page-link"
                                                        href="{{ $product->nextPageUrl() }}" rel="next"><i
                                                            class="icon-right-arrow"></i></a>
                                                </li>
                                            @else
                                                <li class="d-none"></li>
                                            @endif
                                        </ul>
                                    @endif
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Content Right-->
            </div>
        </div>
    </div>
    <!-- /Content -->
    @isset($min)
        <input id="min" type="hidden" value={{ $min }}>
        <input id="max" type="hidden" value={{ $max }}>
    @endisset
    @empty($min)
        <input id="min" type="hidden" value='8000'>
        <input id="max" type="hidden" value="100000">
    @endempty
@stop

@section('js')
    <script src="{{ url('frontend') }}/js/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            function dcl(eve) {
                alert("Your Message");
            }
            $('#soldout').click(function(e) {
                if ($(this).hasClass('disabled')) {
                    e.preventDefault();
                    alert('Please confirm . . .');
                } else {
                    alert('go ahead...');
                }
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
                                toast.addEventListener('mouseenter',
                                    Swal.stopTimer)
                                toast.addEventListener('mouseleave',
                                    Swal
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
                                toast.addEventListener('mouseenter',
                                    Swal.stopTimer)
                                toast.addEventListener('mouseleave',
                                    Swal
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
                var quantity = $(this).data('quantity');
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
                                toast.addEventListener('mouseenter',
                                    Swal.stopTimer)
                                toast.addEventListener('mouseleave',
                                    Swal
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
                                toast.addEventListener('mouseenter',
                                    Swal.stopTimer)
                                toast.addEventListener('mouseleave',
                                    Swal
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
    </script>
@stop
