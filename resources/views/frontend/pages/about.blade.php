@extends('frontend.master')
@section('title', 'Giới thiệu')
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
    <div class="content-part about-page">
        <section class="who-we-are">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 img-part">
                        <figure><img src="{{ url('frontend') }}/images/about-img.jpg" alt="organic"
                                class="img-responsive"></figure>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 txt-part">
                        <div class="sec-tit">
                            <h2><span>Organic Store</span> là</h2>
                        </div>
                        <h3>Organic Store là cửa hàng Thực phẩm hữu cơ nhập khẩu từ Mỹ, EU, Úc...đầu tiên tại Hà Nội.</h3>
                        <p>"From Farm to Table" là kim chỉ nam trong suốt quá trình kinh doanh của chúng tôi. Đến với chúng
                            tôi các bạn sẽ cảm nhận được sự đa dạng với hàng nghìn sản phẩm, thay đổi tư duy tiêu dùng cho
                            một cuộc sống hiện đại và đẳng cấp xứng đáng với những gì bạn chi trả. Các sản phẩm thực phẩm
                            hữu cơ, hóa mỹ phẩm hữu cơ được nhà Organic Store lựa chọn kĩ càng để giới thiệu đến với mọi
                            người. Hãy để Organic Store đồng hành cùng bạn trong việc lựa chọn bữa ăn hàng ngày cho gia đình
                            bạn nhé!</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="farming-industry-section">
            <div class="container">
                <div class="row">
                    <div class="pull-left col-md-8 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12 pull-right">
                                <div class="free-section">
                                    <div class="free-inner">
                                        <h2 class="years">Hơn <span>25</span> năm</h2>
                                        <div class="slogan"> trang trại<br />nông nghiệp</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 pull-left">
                                <div class="box first">
                                    <div class="sr">01</div>
                                    <div class="txt-part">
                                        <div class="tit">Mô hình hiện đại</div>
                                        <p>Không hóa chất nhân tạo (thuốc trừ sâu, chất bảo quản, hormone kích thích tăng
                                            trưởng,…).</p>
                                    </div>
                                </div>
                                <div class="box second">
                                    <div class="sr">02</div>
                                    <div class="txt-part">
                                        <div class="tit">Nguồn nước sạch</div>
                                        <p>Mô hình toàn diện khi được thiết kế tối ưu hóa năng suất hệ sinh thái nông nghiệp
                                            bảo vệ nguồn nước.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pull-right">
                        <div class="box third">
                            <div class="sr">03</div>
                            <div class="txt-part">
                                <div class="tit">Ánh sáng mặt trời</div>
                                <p>Tận dụng tối đa ánh sáng mặt trời, tiết kiệm nhiên liệu.</p>
                            </div>
                        </div>
                        <div class="box fourth">
                            <div class="sr">04</div>
                            <div class="txt-part">
                                <div class="tit">Sản phẩm hoàn hảo</div>
                                <p>Thực phẩm hữu cơ bổ dưỡng hơn. Sữa, thịt hữu cơ chứa acid béo có lợi cao hơn.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="choose-us-section ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-sm-8 col-xs-12">
                        <div class="tit">
                            <h2><span>Tại sao</span> chọn Organic</h2>
                        </div>
                        <p>Organic Store muốn đem lại cảm giác gần gũi của tự nhiên, đồng thời cũng mong muốn
                            gửi gắm tinh thần ấm áp và chu đáo của chúng tôi đến bạn. Hình vẽ mầm cây cách điệu giống như
                            đôi bàn tay, thể hiện sự đoàn kết hợp lực của những con người có chung một nhịp đập trái tim,
                            chung một tiếng lòng, chung một nỗi trăn trở cho nền nông nghiệp Việt Nam nói riêng và thế giới
                            nói chung. Là đôi bàn tay của những người nông dân lương thiện, của những bác nông dân trang
                            trại V-Organic cần mẫn, của các nhà cung cấp chân chính, của những con người trong đại gia đình
                            V-Organic chúng tôi.</p>
                        <div class="flow">
                            <div class="expertese">
                                <label>Expertese</label>
                                <div class="slider slider-horizontal" id="Expertese">
                                    <div class="slider-track">
                                        <div class="slider-track-low" style="left: 0px; width: 0%;"></div>
                                        <div class="slider-selection" style="left: 0%; width: 50%;"></div>
                                        <div class="slider-track-high" style="right: 0px; width: 50%;"></div>
                                    </div>
                                    <div class="tooltip tooltip-main top" role="presentation" style="left: 50%;">
                                        <div class="tooltip-arrow"></div>
                                        <div class="tooltip-inner">Current value: 10</div>
                                    </div>
                                    <div class="tooltip tooltip-min top" role="presentation" style="display: none;">
                                        <div class="tooltip-arrow"></div>
                                        <div class="tooltip-inner"></div>
                                    </div>
                                    <div class="tooltip tooltip-max top" role="presentation" style="display: none;">
                                        <div class="tooltip-arrow"></div>
                                        <div class="tooltip-inner"></div>
                                    </div>
                                    <div class="slider-handle min-slider-handle round" role="slider" aria-valuemin="0"
                                        aria-valuemax="20" aria-valuenow="10" aria-valuetext="Current value: 10"
                                        tabindex="0" style="left: 50%;"></div>
                                    <div class="slider-handle max-slider-handle round hide" role="slider" aria-valuemin="0"
                                        aria-valuemax="20" aria-valuenow="0" aria-valuetext="Current value: 0" tabindex="0"
                                        style="left: 0%;"></div>
                                </div><input id="Expertese" data-slider-id="Expertese" type="text" data-slider-min="0"
                                    data-slider-max="20" data-slider-step="1" data-slider-value="18" data-value="10"
                                    value="10" style="display: none;">
                            </div>
                            <div class="quality">
                                <label>quality</label>
                                <div class="slider slider-horizontal" id="Quality">
                                    <div class="slider-track">
                                        <div class="slider-track-low" style="left: 0px; width: 0%;"></div>
                                        <div class="slider-selection" style="left: 0%; width: 70%;"></div>
                                        <div class="slider-track-high" style="right: 0px; width: 30%;"></div>
                                    </div>
                                    <div class="tooltip tooltip-main top" role="presentation" style="left: 70%;">
                                        <div class="tooltip-arrow"></div>
                                        <div class="tooltip-inner">Current value: 14</div>
                                    </div>
                                    <div class="tooltip tooltip-min top" role="presentation" style="display: none;">
                                        <div class="tooltip-arrow"></div>
                                        <div class="tooltip-inner"></div>
                                    </div>
                                    <div class="tooltip tooltip-max top" role="presentation" style="display: none;">
                                        <div class="tooltip-arrow"></div>
                                        <div class="tooltip-inner"></div>
                                    </div>
                                    <div class="slider-handle min-slider-handle round" role="slider" aria-valuemin="0"
                                        aria-valuemax="20" aria-valuenow="14" aria-valuetext="Current value: 14"
                                        tabindex="0" style="left: 70%;"></div>
                                    <div class="slider-handle max-slider-handle round hide" role="slider" aria-valuemin="0"
                                        aria-valuemax="20" aria-valuenow="0" aria-valuetext="Current value: 0" tabindex="0"
                                        style="left: 0%;"></div>
                                </div><input id="Quality" data-slider-id="Quality" type="text" data-slider-min="0"
                                    data-slider-max="20" data-slider-step="1" data-slider-value="14" data-value="14"
                                    value="14" style="display: none;">
                            </div>
                            <div class="responsible">
                                <label>responsible</label>
                                <div class="slider slider-horizontal" id="Responsible">
                                    <div class="slider-track">
                                        <div class="slider-track-low" style="left: 0px; width: 0%;"></div>
                                        <div class="slider-selection" style="left: 0%; width: 60%;"></div>
                                        <div class="slider-track-high" style="right: 0px; width: 40%;"></div>
                                    </div>
                                    <div class="tooltip tooltip-main top" role="presentation" style="left: 60%;">
                                        <div class="tooltip-arrow"></div>
                                        <div class="tooltip-inner">Current value: 12</div>
                                    </div>
                                    <div class="tooltip tooltip-min top" role="presentation" style="display: none;">
                                        <div class="tooltip-arrow"></div>
                                        <div class="tooltip-inner"></div>
                                    </div>
                                    <div class="tooltip tooltip-max top" role="presentation" style="display: none;">
                                        <div class="tooltip-arrow"></div>
                                        <div class="tooltip-inner"></div>
                                    </div>
                                    <div class="slider-handle min-slider-handle round" role="slider" aria-valuemin="0"
                                        aria-valuemax="20" aria-valuenow="12" aria-valuetext="Current value: 12"
                                        tabindex="0" style="left: 60%;"></div>
                                    <div class="slider-handle max-slider-handle round hide" role="slider" aria-valuemin="0"
                                        aria-valuemax="20" aria-valuenow="0" aria-valuetext="Current value: 0" tabindex="0"
                                        style="left: 0%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /Content -->
    <!-- Our Farmer -->
    @if ($farmer->count() > 2)
        <section class="our-farmers-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="section-tit">
                            <div class="inner">
                                <h2>our Farmers</h2>
                            </div>
                        </div>
                        <div class="owl-carousel owl-theme our-farmer">

                            @foreach ($farmer as $value)
                                <div class="item">
                                    <div class="wrapper">
                                        <div class="pro-img">
                                            <img src="{{ url('uploads/farmer') }}/{{ $value->image }}" alt="Farmer"
                                                class="img-responsive center-block" />
                                        </div>
                                        <div class="contain-wrapper">
                                            <div class="tit">{{ $value->name }}</div>
                                            <div class="post">{{ $value->job }}</div>
                                            <ul class="social">
                                                <li><a href="#"><i class="icon-facebook"></i></a></li>
                                                <li><a href="#"><i class="icon-twitter"></i></a></li>
                                                <li><a href="#"><i class="icon-camera"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach




                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- /Our Farmer -->
@stop
