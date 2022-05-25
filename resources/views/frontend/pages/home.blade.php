   @extends('frontend.master')
   @section('title', 'Organic Food')
   @section('main')

       <!-- Banner Carousel -->
       <div class="responsive-slider" data-spy="responsive-slider" data-autoplay="true">
           <div class="slides" data-group="slides">
               <ul>
                   @foreach ($banner as $slide)
                       <li>
                           <div class="slide-body" data-group="slide">
                               <img src="{{ url('uploads/banner') }}/{{ $slide->image }}" alt="banner">
                               <div class="carouseal-caption">
                                   <div class="caption header " data-animate="slideAppearRightToLeft" data-delay="500"
                                       data-length="300">
                                       @php
                                           $arr = explode(' ', trim($slide->slogan));
                                           $count = count($arr);
                                           $arrs = [];
                                           for ($i = 1; $i < $count; $i++) {
                                               array_push($arrs, $arr[$i]);
                                           }
                                           $arrs = implode(' ', $arrs);
                                       @endphp
                                       <h3><span>{{ explode(' ', trim($slide->slogan))[0] }}</span> {{ $arrs }}
                                       </h3>
                                       <div class="caption sub" data-animate="slideAppearLeftToRight" data-delay="800"
                                           data-length="300">An toàn hơn! Dinh dưỡng hơn! </div>
                                   </div>
                               </div>
                           </div>
                       </li>
                   @endforeach
               </ul>
           </div>
       </div>
       <!-- /Banner Carousel -->
       <div class="clearfix"></div>
       <!-- Fresh Collection -->
       <section class="fress-entry-section">
           <div class="pos-absolute">
               <div class="container">
                   <div class="row">
                       <div class="col-sm-4 col-xs-12">
                           <img src="{{ url('frontend') }}/images/fresh-fruits-img.jpg" alt="fresh fruit"
                               class="img-responsive" />
                           <div class="tit-btn-wrapper">
                               <h2 class="tit">quả<span>sạch</span></h2>
                               <a class="btn">Xem Ngay</a>
                           </div>
                       </div>
                       <div class="col-sm-4 col-xs-12">
                           <img src="{{ url('frontend') }}/images/fresh-vegetables-img.jpg" alt="fresh vegitables"
                               class="img-responsive" />
                           <div class="tit-btn-wrapper">
                               <h2 class="tit">Rau<span>sạch</span></h2>
                               <a class="btn">Xem Ngay</a>
                           </div>
                       </div>
                       <div class="col-sm-4 col-xs-12">
                           <img src="{{ url('frontend') }}/images/organic-foods-img.jpg" alt="organic foods"
                               class="img-responsive" />
                           <div class="tit-btn-wrapper">
                               <h2 class="tit"> Sản phẩm<span> Hữu cơ</span></h2>
                               <a class="btn">Xem Ngay</a>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           <div class="clearfix"></div>
       </section>
       <!-- /Fresh Collection -->
       <div class="clearfix"></div>
       <!-- New Arrival -->
       <section class="new-arrivals-section section-padding">
           <div class="container">
               <div class="row">
                   <div class="col-sm-12 col-xs-12 " data-animate="slideAppearUpToDown">
                       <div class="section-tit">
                           <div class="inner">
                               <h2><span>Sản phẩm</span> mới</h2>
                           </div>
                       </div>
                   </div>
                   <div class="col-sm-12 col-xs-12">
                       <div class="owl-carousel owl-theme new-arrivals-slider">
                           @foreach ($new_arrival as $new)
                               @if (isset($new->getInventoryById($new->id)->qty))



                                   @if ($new->getInventoryById($new->id)->qty >= $new->import_quantity)
                                       <div class="item">
                                           <div class="wrapper">
                                               <div class="pro-img"> <img src="{{ url('uploads/product') }}/{{ $new->image }}"
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
                                                                   disabled
                                                                   data-user="{{ Auth::guard('customer')->user()->id }}"
                                                                   data-product="{{ $new->id }}">Mua ngay</button><i
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
                                                                               class="icon-heart" disabled></i></button>
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
                                                                           href="{{ route('customer.login') }}?action=addFavorite&product_id={{ $new->id }} onclick="
                                                                           return false ""><i class="icon-heart"></i></a>
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
                                               <div class="pro-img"> <img src="{{ url('uploads/product') }}/{{ $new->image }}"
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
                                                                   data-product="{{ $new->id }}">Mua ngay</button><i
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
                               @else
                                   <div class="item">
                                       <div class="wrapper">
                                           <div class="pro-img"> <img src="{{ url('uploads/product') }}/{{ $new->image }}"
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
                                                               data-product="{{ $new->id }}">Mua ngay</button><i
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
       <!-- /New Arrival -->
       <div class="clearfix"></div>
       <!-- Deal of the day -->
       <section class="deal-section">
           <div class="container">
               <div class="row">
                   <div class="col-sm-12 col-xs-12">
                       <div class="section-tit">
                           <div class="inner">
                               <h2>sản phẩm <span>nổi bật</span></h2>
                           </div>
                       </div>
                       <div class="filter-part">
                           <div class="col-lg-4 col-md-5 col-sm-8 col-xs-12 center-part hidden-lg">
                               <div class="slider-bg">
                                   <img src="{{ url('frontend') }}/images/slider-bg-1.png" alt="slider-back"
                                       class="img-responsive bg">
                                   <div class="pos-abs">
                                       <div class="owl-carousel owl-theme deal-slider owl-loaded owl-drag">
                                           <div class="owl-stage-outer">
                                               <div class="owl-stage" style="transition: all 0s ease 0s;">
                                                   @foreach ($hot_pro as $hot)
                                                       @if (isset($hot->getInventoryById($hot->id)->qty))
                                                           @if ($hot->getInventoryById($hot->id)->qty >= $hot->import_quantity)
                                                               <div class="owl-item">
                                                                   <div class="item">
                                                                       <div class="pro-img"> <img
                                                                               src="{{ url('uploads/product') }}/{{ $hot->image }}"
                                                                               alt="{{ $hot->name }}"
                                                                               class="img-responsive">
                                                                       </div>
                                                                       <div class="contain-wrapper">
                                                                           <div class="tit">{{ $hot->name }}
                                                                           </div>
                                                                           <div class="price">
                                                                               <div class="new-price">
                                                                                   {{ $hot->sale_price > 0 ? number_format($hot->sale_price, 0, ',', '.') . ' VND' : number_format($hot->price, 0, ',', '.') . ' VND' }}
                                                                               </div>
                                                                               <div class="old-price">
                                                                                   <del>{{ $hot->sale_price > 0 ? number_format($hot->price, 0, ',', '.') . ' VND' : '' }}</del>
                                                                               </div>
                                                                           </div>
                                                                           <div class="btn-part">
                                                                               @if (Auth::guard('customer')->check())
                                                                                   <form action="" method="post">
                                                                                       <button class="btn-addCart cart-btn"
                                                                                           data-quantity="1"
                                                                                           data-user="{{ Auth::guard('customer')->user()->id }}"
                                                                                           disabled
                                                                                           data-product="{{ $hot->id }}">Buy
                                                                                           Now</button><i
                                                                                           class="icon-basket-supermarket"></i>
                                                                                       @csrf
                                                                                   </form>
                                                                               @else
                                                                                   <form action="" method="post">
                                                                                       <a class="cart-btn"
                                                                                           onclick="return false "
                                                                                           href="{{ route('customer.login') }}?action=addCart&product_id={{ $hot->id }}&quantity=1 "><i
                                                                                               class="icon-basket-supermarket"></i>Buy
                                                                                           now</a>
                                                                                       @csrf
                                                                                   </form>
                                                                               @endif
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                           @else
                                                               <div class="owl-item">
                                                                   <div class="item">
                                                                       <div class="pro-img"> <img
                                                                               src="{{ url('uploads/product') }}/{{ $hot->image }}"
                                                                               alt="{{ $hot->name }}"
                                                                               class="img-responsive">
                                                                       </div>
                                                                       <div class="contain-wrapper">
                                                                           <div class="tit">{{ $hot->name }}
                                                                           </div>
                                                                           <div class="price">
                                                                               <div class="new-price">
                                                                                   {{ $hot->sale_price > 0 ? number_format($hot->sale_price, 0, ',', '.') . ' VND' : number_format($hot->price, 0, ',', '.') . ' VND' }}
                                                                               </div>
                                                                               <div class="old-price">
                                                                                   <del>{{ $hot->sale_price > 0 ? number_format($hot->price, 0, ',', '.') . ' VND' : '' }}</del>
                                                                               </div>
                                                                           </div>
                                                                           <div class="btn-part">
                                                                               @if (Auth::guard('customer')->check())
                                                                                   <form action="" method="post">
                                                                                       <button class="btn-addCart cart-btn"
                                                                                           data-quantity="1"
                                                                                           data-user="{{ Auth::guard('customer')->user()->id }}"
                                                                                           data-product="{{ $hot->id }}">Buy
                                                                                           Now</button><i
                                                                                           class="icon-basket-supermarket"></i>
                                                                                       @csrf
                                                                                   </form>
                                                                               @else
                                                                                   <form action="" method="post">
                                                                                       <a class="cart-btn"
                                                                                           href="{{ route('customer.login') }}?action=addCart&product_id={{ $hot->id }}&quantity=1 "><i
                                                                                               class="icon-basket-supermarket"></i>Buy
                                                                                           now</a>
                                                                                       @csrf
                                                                                   </form>
                                                                               @endif
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                           @endif
                                                       @else
                                                           <div class="owl-item">
                                                               <div class="item">
                                                                   <div class="pro-img"> <img
                                                                           src="{{ url('uploads/product') }}/{{ $hot->image }}"
                                                                           alt="{{ $hot->name }}"
                                                                           class="img-responsive">
                                                                   </div>
                                                                   <div class="contain-wrapper">
                                                                       <div class="tit">{{ $hot->name }}
                                                                       </div>
                                                                       <div class="price">
                                                                           <div class="new-price">
                                                                               {{ $hot->sale_price > 0 ? number_format($hot->sale_price, 0, ',', '.') . ' VND' : number_format($hot->price, 0, ',', '.') . ' VND' }}
                                                                           </div>
                                                                           <div class="old-price">
                                                                               <del>{{ $hot->sale_price > 0 ? number_format($hot->price, 0, ',', '.') . ' VND' : '' }}</del>
                                                                           </div>
                                                                       </div>
                                                                       <div class="btn-part">
                                                                           @if (Auth::guard('customer')->check())
                                                                               <form action="" method="post">
                                                                                   <button class="btn-addCart cart-btn"
                                                                                       data-quantity="1"
                                                                                       data-user="{{ Auth::guard('customer')->user()->id }}"
                                                                                       data-product="{{ $hot->id }}">Buy
                                                                                       Now</button><i
                                                                                       class="icon-basket-supermarket"></i>
                                                                                   @csrf
                                                                               </form>
                                                                           @else
                                                                               <form action="" method="post">
                                                                                   <a class="cart-btn"
                                                                                       href="{{ route('customer.login') }}?action=addCart&product_id={{ $hot->id }}&quantity=1 "><i
                                                                                           class="icon-basket-supermarket"></i>Buy
                                                                                       now</a>
                                                                                   @csrf
                                                                               </form>
                                                                           @endif
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                       @endif


                                                   @endforeach
                                               </div>
                                           </div>
                                           <div class="owl-nav">
                                               <div class="owl-prev"><i class="icon-right-arrow"></i></div>
                                               <div class="owl-next"><i class="icon-right-arrow"></i></div>
                                           </div>
                                           <div class="owl-dots disabled"></div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="col-sm-12 col-xs-12">
                               <div id="myBtnContainer">
                                   <button class="btn active" onclick="filterSelection('all')">Xem tất cả</button> /
                                   @foreach ($categories as $cate)
                                       <button class="btn" onclick="filterSelection('{{ $cate->name }}')">
                                           {{ $cate->name }}</button> /
                                   @endforeach
                               </div>
                           </div>
                           <div class="col-lg-4 col-md-6 col-sm-6  col-xs-12 pull-left">
                               @foreach ($categories as $cate)
                                   @foreach ($hot_product->getHotProducts($cate->id) as $key => $value)
                                       @if (($key + 1) % 2 != 0)
                                           <div
                                               class="filterDiv {{ $value->category_id == $cate->id ? $cate->name : '' }}  show">
                                               <div class="img-part"> <img
                                                       src="{{ url('uploads/product') }}/{{ $value->image }}"
                                                       alt="{{ $value->name }}" class="img-responsive"> </div>
                                               <div class="text-part">
                                                   <div class="box-tit">{{ $value->name }}</div>
                                                   <div class="ratting">
                                                       <ul>
                                                           <li>
                                                               <a href="#"><img
                                                                       src="{{ url('frontend') }}/images/green-star-2.png"
                                                                       alt="star" class="img-responsive"></a>
                                                           </li>
                                                           <li>
                                                               <a href="#"><img
                                                                       src="{{ url('frontend') }}/images/green-star-2.png"
                                                                       alt="star" class="img-responsive"></a>
                                                           </li>
                                                           <li>
                                                               <a href="#"><img
                                                                       src="{{ url('frontend') }}/images/green-star-2.png"
                                                                       alt="star" class="img-responsive"></a>
                                                           </li>
                                                           <li>
                                                               <a href="#"><img
                                                                       src="{{ url('frontend') }}/images/dark-star-2.png"
                                                                       alt="star" class="img-responsive"></a>
                                                           </li>
                                                           <li>
                                                               <a href="#"><img
                                                                       src="{{ url('frontend') }}/images/dark-star-2.png"
                                                                       alt="star" class="img-responsive"></a>
                                                           </li>
                                                       </ul>
                                                   </div>
                                                   <div class="price">
                                                       <div class="new-price">
                                                           {{ $value->sale_price > 0 ? number_format($value->sale_price, 0, ',', '.') . ' VND' : number_format($value->price, 0, ',', '.') . ' VND' }}
                                                       </div>
                                                       <div class="old-price">
                                                           <del>{{ $value->sale_price > 0 ? number_format($value->price, 0, ',', '.') . ' VND' : '' }}</del>
                                                       </div>
                                                   </div>
                                                   <div class="btn-part">
                                                       @if (Auth::guard('customer')->check())
                                                           <form action="" method="post">
                                                               <button class="btn-addCart cart-btn" data-quantity="1"
                                                                   data-user="{{ Auth::guard('customer')->user()->id }}"
                                                                   data-product="{{ $value->id }}">Mua ngay</button><i
                                                                   class="icon-basket-supermarket"></i>
                                                               @csrf
                                                           </form>
                                                       @else
                                                           <form action="" method="post">
                                                               <a class="cart-btn"
                                                                   href="{{ route('customer.login') }}?action=addCart&product_id={{ $value->id }}&quantity=1 "><i
                                                                       class="icon-basket-supermarket"></i>Mua ngay</a>
                                                               @csrf
                                                           </form>
                                                       @endif

                                                   </div>
                                               </div>
                                           </div>
                                       @endif
                                   @endforeach
                               @endforeach
                           </div>
                           <div class="col-lg-4 col-md-5 col-sm-8 col-xs-12 center-part hidden-xs hidden-sm hidden-md">
                               <div class="slider-bg">
                                   <img src="{{ url('frontend') }}/images/slider-bg-1.png" alt="slider-back"
                                       class="img-responsive bg">
                                   <div class="pos-abs">
                                       <div class="owl-carousel owl-theme deal-slider">
                                           @foreach ($hot_pro as $hot)
                                               @if (isset($hot->getInventoryById($hot->id)->qty))
                                                   @if ($hot->getInventoryById($hot->id)->qty >= $hot->import_quantity)
                                                       <div class="item">
                                                           <div class="pro-img"> <img
                                                                   src="{{ url('uploads/product') }}/{{ $hot->image }}"
                                                                   alt="{{ $hot->name }}" class="img-responsive" />
                                                           </div>
                                                           <div class="contain-wrapper">
                                                               <div class="tit">{{ $hot->name }}</div>
                                                               <div class="price">
                                                                   <div class="new-price">
                                                                       {{ $hot->sale_price > 0 ? number_format($hot->sale_price, 0, ',', '.') . ' VND' : number_format($hot->price, 0, ',', '.') . ' VND' }}
                                                                   </div>
                                                                   <div class="old-price">
                                                                       <del>{{ $hot->sale_price > 0 ? number_format($hot->price, 0, ',', '.') . ' VND' : '' }}</del>
                                                                   </div>
                                                               </div>
                                                               <div class="btn-part">
                                                                   @if (Auth::guard('customer')->check())
                                                                       <form action="" method="post">
                                                                           <button class="btn-addCart cart-btn" disabled
                                                                               data-quantity="1"
                                                                               data-user="{{ Auth::guard('customer')->user()->id }}"
                                                                               data-product="{{ $hot->id }}">Mua
                                                                               ngay</button><i
                                                                               class="icon-basket-supermarket"></i>
                                                                           @csrf
                                                                       </form>
                                                                   @else
                                                                       <form action="" method="post">
                                                                           <a class="cart-btn"
                                                                               href="{{ route('customer.login') }}?action=a&product_id={{ $hot->id }}&quantity=1 "
                                                                               onclick="return false "><i
                                                                                   class="icon-basket-supermarket"></i>Mua
                                                                               ngay</a>
                                                                           @csrf
                                                                       </form>
                                                                   @endif

                                                               </div>
                                                           </div>
                                                       </div>
                                                   @else
                                                       <div class="item">
                                                           <div class="pro-img"> <img
                                                                   src="{{ url('uploads/product') }}/{{ $hot->image }}"
                                                                   alt="{{ $hot->name }}" class="img-responsive" />
                                                           </div>
                                                           <div class="contain-wrapper">
                                                               <div class="tit">{{ $hot->name }}</div>
                                                               <div class="price">
                                                                   <div class="new-price">
                                                                       {{ $hot->sale_price > 0 ? number_format($hot->sale_price, 0, ',', '.') . ' VND' : number_format($hot->price, 0, ',', '.') . ' VND' }}
                                                                   </div>
                                                                   <div class="old-price">
                                                                       <del>{{ $hot->sale_price > 0 ? number_format($hot->price, 0, ',', '.') . ' VND' : '' }}</del>
                                                                   </div>
                                                               </div>
                                                               <div class="btn-part">
                                                                   @if (Auth::guard('customer')->check())
                                                                       <form action="" method="post">
                                                                           <button class="btn-addCart cart-btn"
                                                                               data-quantity="1"
                                                                               data-user="{{ Auth::guard('customer')->user()->id }}"
                                                                               data-product="{{ $hot->id }}">Mua
                                                                               ngay</button><i
                                                                               class="icon-basket-supermarket"></i>
                                                                           @csrf
                                                                       </form>
                                                                   @else
                                                                       <form action="" method="post">
                                                                           <a class="cart-btn"
                                                                               href="{{ route('customer.login') }}?action=a&product_id={{ $hot->id }}&quantity=1 "><i
                                                                                   class="icon-basket-supermarket"></i>Mua
                                                                               ngay</a>
                                                                           @csrf
                                                                       </form>
                                                                   @endif

                                                               </div>
                                                           </div>
                                                       </div>
                                                   @endif
                                               @else
                                                   <div class="item">
                                                       <div class="pro-img"> <img
                                                               src="{{ url('uploads/product') }}/{{ $hot->image }}"
                                                               alt="{{ $hot->name }}" class="img-responsive" /> </div>
                                                       <div class="contain-wrapper">
                                                           <div class="tit">{{ $hot->name }}</div>
                                                           <div class="price">
                                                               <div class="new-price">
                                                                   {{ $hot->sale_price > 0 ? number_format($hot->sale_price, 0, ',', '.') . ' VND' : number_format($hot->price, 0, ',', '.') . ' VND' }}
                                                               </div>
                                                               <div class="old-price">
                                                                   <del>{{ $hot->sale_price > 0 ? number_format($hot->price, 0, ',', '.') . ' VND' : '' }}</del>
                                                               </div>
                                                           </div>
                                                           <div class="btn-part">
                                                               @if (Auth::guard('customer')->check())
                                                                   <form action="" method="post">
                                                                       <button class="btn-addCart cart-btn"
                                                                           data-quantity="1"
                                                                           data-user="{{ Auth::guard('customer')->user()->id }}"
                                                                           data-product="{{ $hot->id }}">Mua
                                                                           ngay</button><i
                                                                           class="icon-basket-supermarket"></i>
                                                                       @csrf
                                                                   </form>
                                                               @else
                                                                   <form action="" method="post">
                                                                       <a class="cart-btn"
                                                                           href="{{ route('customer.login') }}?action=a&product_id={{ $hot->id }}&quantity=1 "><i
                                                                               class="icon-basket-supermarket"></i>Mua
                                                                           ngay</a>
                                                                       @csrf
                                                                   </form>
                                                               @endif

                                                           </div>
                                                       </div>
                                                   </div>
                                               @endif


                                           @endforeach
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 pull-right">
                               @foreach ($categories as $cate)
                                   @foreach ($hot_product->getHotProducts($cate->id) as $key => $value)
                                       @if (($key + 1) % 2 == 0)
                                           <div
                                               class="filterDiv {{ $value->category_id == $cate->id ? $cate->name : '' }}  show">
                                               <div class="img-part"> <img
                                                       src="{{ url('uploads/product') }}/{{ $value->image }}"
                                                       alt="{{ $value->name }}" class="img-responsive"> </div>
                                               <div class="text-part">
                                                   <div class="box-tit">{{ $value->name }}</div>
                                                   <div class="ratting">
                                                       <ul>
                                                           <li>
                                                               <a href="#"><img
                                                                       src="{{ url('frontend') }}/images/green-star-2.png"
                                                                       alt="star" class="img-responsive"></a>
                                                           </li>
                                                           <li>
                                                               <a href="#"><img
                                                                       src="{{ url('frontend') }}/images/green-star-2.png"
                                                                       alt="star" class="img-responsive"></a>
                                                           </li>
                                                           <li>
                                                               <a href="#"><img
                                                                       src="{{ url('frontend') }}/images/green-star-2.png"
                                                                       alt="star" class="img-responsive"></a>
                                                           </li>
                                                           <li>
                                                               <a href="#"><img
                                                                       src="{{ url('frontend') }}/images/dark-star-2.png"
                                                                       alt="star" class="img-responsive"></a>
                                                           </li>
                                                           <li>
                                                               <a href="#"><img
                                                                       src="{{ url('frontend') }}/images/dark-star-2.png"
                                                                       alt="star" class="img-responsive"></a>
                                                           </li>
                                                       </ul>
                                                   </div>
                                                   <div class="price">
                                                       <div class="new-price">
                                                           {{ $value->sale_price > 0 ? number_format($value->sale_price, 0, ',', '.') . ' VND' : number_format($value->price, 0, ',', '.') . ' VND' }}
                                                       </div>
                                                       <div class="old-price">
                                                           <del>{{ $value->sale_price > 0 ? number_format($value->price, 0, ',', '.') . ' VND' : '' }}</del>
                                                       </div>
                                                   </div>
                                                   <div class="btn-part">
                                                       @if (Auth::guard('customer')->check())
                                                           <form action="" method="post">
                                                               <button class="btn-addCart cart-btn" data-quantity="1"
                                                                   data-user="{{ Auth::guard('customer')->user()->id }}"
                                                                   data-product="{{ $value->id }}">Mua ngay</button><i
                                                                   class="icon-basket-supermarket"></i>
                                                               @csrf
                                                           </form>
                                                       @else
                                                           <form action="" method="post">
                                                               <a class="cart-btn"
                                                                   href="{{ route('customer.login') }}?action=addC&product_id={{ $value->id }}&quantity=1 "><i
                                                                       class="icon-basket-supermarket"></i>Mua ngay</a>
                                                               @csrf
                                                           </form>
                                                       @endif

                                                   </div>
                                               </div>
                                           </div>
                                       @endif
                                   @endforeach
                               @endforeach
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </section>
       <!-- /Deal of the day -->
       <div class="clearfix"></div>
       <!-- Best Deal -->
       <section class="fress-section">
           <div class="container">
               <div class="row">
                   <div class="col-sm-8 lpart">
                       <div class="bg equal-height ">
                           <h2 class="section-name">hoq quả <span>tươi</span></h2>
                           <a href="{{ route('danh-sach-san-pham.index') }}" class="shop-btn">xem ngay</a>
                       </div>
                   </div>
                   <div class="col-sm-4  rpart">
                       <div class="bg equal-height">
                           <h3 class="free-shipping">Miễn phí vận chuyển</h3>
                           <a href="#" class="shop-btn-1">MUA ngay</a>
                       </div>
                   </div>
               </div>
           </div>
       </section>
       <!-- /Best Deal -->
       <div class="clearfix"></div>
       <!-- Organic News -->
       <section class="organic-news">
           <div class="container">
               <div class="row">
                   <div class="col-sm-12 col-xs-12">
                       <div class="section-tit">
                           <div class="inner">
                               <h2><span>Organic</span> bài viết</h2>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           <div class="container-fluid">
               <div class="row no-gutter">
                   @foreach ($new_blog as $blog)

                       <div class="col-sm-3 col-xs-12">
                           <div class="wrapper">
                               <img src="{{ url('uploads/blog') }}/{{ $blog->cover_image }}"
                                   alt="{{ Str::limit($blog->title, 30) }}" class="img-responsive" />
                               <div class="overlay"> </div>
                               <div class="text">
                                   <div class="date"> {{ $blog->created_at->format(' F j, Y ') }}</div>
                                   <div class="title"><a
                                           href="{{ route('danh-sach-bai-viet.show', $blog->slug) }}">{{ Str::limit($blog->title, 30) }}
                                       </a></div>
                               </div>
                           </div>
                       </div>
                   @endforeach

               </div>
           </div>
       </section>
       <!-- /Organic News -->
       <div class="clearfix"></div>
       <!-- Delivery Process -->
       <section class="delivery-process">
           <div class="container">
               <div class="row">
                   <div class="col-sm-12 col-xs-12 ">
                       <div class="section-tit">
                           <div class="inner">
                               <h2>Quá trình<span> vận chuyển</span></h2>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="row">
                   <div class="col-md-3 col-sm-3 col-xs-12 first">
                       <div class="icon-part"> <img src="{{ url('frontend') }}/images/step-1.png" alt="step-1"
                               class="img-responsive center-block" /> <i class="icon-carrot"></i> </div>
                       <div class="process-name">
                           <div class="step">bước 01</div>
                           <p>Chọn 1 hoặc nhiều sản phẩm</p>
                       </div>
                   </div>
                   <div class="col-md-3 col-sm-3 col-xs-12 second">
                       <div class="icon-part"> <img src="{{ url('frontend') }}/images/step-2.png" alt="step-2"
                               class="img-responsive center-block" /> <i class="icon-warehouse"></i> </div>
                       <div class="process-name">
                           <div class="step">bước 02</div>
                           <p>Determine our Farm</p>
                       </div>
                   </div>
                   <div class="col-md-3 col-sm-3 col-xs-12 third">
                       <div class="icon-part"> <img src="{{ url('frontend') }}/images/step-3.png" alt="step-3"
                               class="img-responsive center-block" /> <i class="icon-placeholder-filled-point"></i> </div>
                       <div class="process-name">
                           <div class="step">bước 03</div>
                           <p>Xác nhận địa chỉ</p>
                       </div>
                   </div>
                   <div class="col-md-3 col-sm-3 col-xs-12 fourth">
                       <div class="icon-part"> <img src="{{ url('frontend') }}/images/step-4.png" alt="step-4"
                               class="img-responsive center-block" /> <i class="icon-package"></i> </div>
                       <div class="process-name">
                           <div class="step">bước 04</div>
                           <p>Vận chuyển nhanh</p>
                       </div>
                   </div>
               </div>
           </div>
       </section>
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
   @section('js')
       <script src="{{ url('frontend') }}/js/sweetalert.min.js"></script>
       <script>
           $(document).ready(function() {
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
       </script>
   @stop
