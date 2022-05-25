    <!-- /Newsletter -->
    <div class="clearfix"></div>
    <!-- Brand logo -->
    <section class="brand">
        <div class="container">
            <h3 class="sr-only">Brand logos</h3>
            <div class="owl-carousel owl-theme brand-slider">
                @foreach ($brand as $value)

                    <div class="item"> <a href="{{ route('customer.brand_info',['slug'=>$value->slug]) }}"><img src="{{ url('uploads/brand') }}/{{ $value->image }}" alt="brand 01"
                                class="img-responsive" /></a> </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- /Brand logo -->
    <div class="clearfix"></div>
    <!-- Services provide -->
    <section class="helpline">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="bgreen">
                        <div class="inline">
                            <div class="box">
                                <div class="icon"> <i class="icon-delivery-truck"></i> </div>
                                <div class="text-part">
                                    <h3>Free Ship</h3>
                                    <p>Toàn Quốc</p>
                                </div>
                            </div>
                            <div class="box">
                                <div class="icon"> <i class="icon-headphones"></i> </div>
                                <div class="text-part">
                                    <h3>24X7</h3>
                                    <p>Hỗ trợ</p>
                                </div>
                            </div>
                            <div class="box">
                                <div class="icon"> <i class="icon-shuffle"></i> </div>
                                <div class="text-part">
                                    <h3>Returns</h3>
                                    <p>and Exchange</p>
                                </div>
                            </div>
                            <div class="box">
                                <div class="icon"> <i class="icon-phone-call"></i> </div>
                                <div class="text-part">
                                    <h3>Hotline</h3>
                                    <p><a href="tel:+{{ $infoShop->phone }}">+{{ $infoShop->phone }}</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Services provide -->
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="top-footer">
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="logo"> <img src="{{ url('frontend') }}/images/footer-logo.png" alt="logo"
                                class="img-responsive" /> </div>
                        <div class="logo-btm">
                            <div class="adress"><i class="icon-placeholder"></i><span>{{ $infoShop->address }}</span>
                            </div>
                            <div class="phone"><i class="icon-icon"></i><a
                                    href="tel:+8888888888">+{{ $infoShop->phone }}</a></div>
                            <div class="mail"><i class="icon-envelope"></i><a
                                    href="mailto:{{ $infoShop->email }}">{{ $infoShop->email }}</a></div>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <div class="col-sm-4 col-xs-12">
                            <div class="widget-title">Information</div>
                            <ul class="widget">
                                <li><a href="#">Site Map</a></li>
                                <li><a href="#">Search Terms</a></li>
                                <li><a href="#">Advanced Search</a></li>
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="contact.html">Contact Us</a></li>
                                <li><a href="#">Suppliers</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="widget-title">Style Advisor</div>
                            <ul class="widget">
                                <li><a href="myaccount.html">Your Account</a></li>
                                <li><a href="#">Information</a></li>
                                <li><a href="#">Addresses</a></li>
                                <li><a href="#">Discount</a></li>
                                <li><a href="#">Orders History</a></li>
                                <li><a href="#">Additional Information</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="widget-title">Quick Links</div>
                            <ul class="widget">
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="faq.html">FAQs</a></li>
                                <li><a href="#">Payment</a></li>
                                <li><a href="#">Shipment</a></li>
                                <li><a href="#">Where is my order?</a></li>
                                <li><a href="#">Return policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12">
                        <div class="widget-title">Instagram</div>
                        <div class="insta-img-box"> <img src="{{ url('frontend') }}/images/instagram-img-1.jpg"
                                alt="photo" class="img-responsive" /> <img
                                src="{{ url('frontend') }}/images/instagram-img-2.jpg" alt="photo"
                                class="img-responsive" /> <img src="{{ url('frontend') }}/images/instagram-img-3.jpg"
                                alt="photo" class="img-responsive" /> <img
                                src="{{ url('frontend') }}/images/instagram-img-4.jpg" alt="photo"
                                class="img-responsive" /> <img src="{{ url('frontend') }}/images/instagram-img-5.jpg"
                                alt="photo" class="img-responsive" /> <img
                                src="{{ url('frontend') }}/images/instagram-img-6.jpg" alt="photo"
                                class="img-responsive" /> </div>
                    </div>
                </div>
                <div class="bottom-footer">
                    <div class="lpart">
                        <p class="copyright">© Oganic Foodstore <span></span></p>
                        <p class="design">Website designed & Developed by <a target="_blank"
                                href="">{{ $infoShop->email }}.</a></p>
                    </div>
                    <div class="center-part">
                        <ul class="social">
                            <li><a href="#"><i class="icon-facebook"></i></a></li>
                            <li><a href="#"><i class="icon-twitter"></i></a></li>
                            <li><a href="#"><i class="icon-google-plus"></i></a></li>
                            <li><a href="#"><i class="icon-pinterest"></i></a></li>
                            <li><a href="#"><i class="icon-youtube"></i></a></li>
                        </ul>
                    </div>
                    <div class="rpart">
                        <ul class="payment">
                            <li>
                                <a href="#"><img src="{{ url('frontend') }}/images/card-1.png" alt="payment card"
                                        class="img-responsive" /></a>
                            </li>
                            <li>
                                <a href="#"><img src="{{ url('frontend') }}/images/card-2.png" alt="payment card"
                                        class="img-responsive" /></a>
                            </li>
                            <li>
                                <a href="#"><img src="{{ url('frontend') }}/images/card-3.png" alt="payment card"
                                        class="img-responsive" /></a>
                            </li>
                            <li>
                                <a href="#"><img src="{{ url('frontend') }}/images/card-4.png" alt="payment card"
                                        class="img-responsive" /></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- /Footer -->
    <!-- Go to Top -->
    <a href="#" class="scrollup"><i class="icon-angle-up"></i></a>
    <!-- /Go to Top -->

    <!-- jquery first -->
    <script src="{{ url('frontend') }}/js/jquery-1.11.3.min.js"></script>

    <!-- bootstrap v3.3.7 -->
    <script src="{{ url('frontend') }}/js/bootstrap.min.js"></script>
    <!-- carousels -->
    <script src="{{ url('frontend') }}/js/responsive-slider.js"></script>
    <script src="{{ url('frontend') }}/js/owl.carousel.min.js"></script>
    <script src="{{ url('frontend') }}/js/jquery.event.move.js"></script>
    <!-- Value Slider -->
    {{-- <script src="{{ url('frontend') }}/js/jquery.animateNumber.min.js"></script> --}}
    <script src="{{ url('frontend') }}/js/bootstrap-slider.min.js"></script>
    <!-- Responsive Tab -->
    <script src="{{ url('frontend') }}/js/responsiveTabs.min.js"></script>
    <!-- Smoothproducts -->
    <script src="{{ url('frontend') }}/js/jquery-ui.min.js"></script>
    <script src="{{ url('frontend') }}/js/smoothproducts.min.js"></script>
    <!-- Sameheight -->
    <script src="{{ url('frontend') }}/js/jquery.matchHeight-min.js"></script>
    <!-- Gallery with tab  -->
    <script src="{{ url('frontend') }}/js/jquery.fancybox.min.js"></script>
    <script src="{{ url('frontend') }}/js/isotope.pkgd.js"></script>
    <!-- Custom Sripts -->
    <script src="{{ url('frontend') }}/js/custom.js"></script>
    <script src="{{ url('backend') }}/js/toastr.min.js"></script>
    <script src="{{ url('frontend') }}/js/sweetalert2@9.js"></script>
    {!! Toastr::message() !!}
    @yield('js')
    </body>

    </html>
