@extends('frontend.master')
@section('title', 'Đơn hàng')
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
    <div class="content-part checkout-page">
        <div class="container">
            <div class="checkout-step-two text-left">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <h2 class="checkout-head">01 / Hóa đơn &amp; Địa chỉ nhận hàng</h2>
                        <div class="row">
                            <div class="checkout-two-form text-left">
                                <form method="post">
                                    @csrf
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="name" class="form-control" placeholder="Your name"
                                            value="{{ Auth::guard('customer')->user()->name }}">
                                    </div>
                                    @if (session()->get('shipping'))
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="selectdiv">
                                                <select name="tp_id" id="tp_id" class="choose form-control">
                                                    <option>----- Chọn thành phố -----</option>
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}"
                                                            {{ $city->id == session()->get('shipping')['tp_id'] ? ' selected' : '' }}>
                                                            {{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="selectdiv">
                                                <select name="qh_id" id="qh_id" class=" qh_id choose form-control">
                                                    <option>----- Chọn quận huyện -----</option>
                                                    @foreach ($quanhuyen as $value)
                                                        <option
                                                            {{ session()->get('shipping')['qh_id'] == $value->id ? 'selected' : '' }}
                                                            value="{{ $value->id }}">
                                                            {{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <select name="xa_id" id="xa_id" class=" xa_id form-control">
                                                <option>----- Chọn xã, thị trấn -----</option>
                                                @foreach ($xa as $value)
                                                    <option
                                                        {{ session()->get('shipping')['xa_id'] == $value->id ? 'selected' : '' }}
                                                        value="{{ $value->id }}">
                                                        {{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @else
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="selectdiv">
                                                <select name="tp_id" id="tp_id" class="choose form-control">
                                                    <option>----- Chọn thành phố -----</option>
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}">{{ $city->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="selectdiv">
                                                <select name="qh_id" id="qh_id" class=" qh_id choose form-control">
                                                    <option>----- Chọn quận huyện -----</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <select name="xa_id" id="xa_id" class=" xa_id form-control">
                                                <option>----- Chọn xã, thị trấn -----</option>
                                            </select>
                                        </div>
                                    @endif
                                    <input type="hidden" value="{{ Auth::guard('customer')->user()->id }}"
                                        name="user_id">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="phone" class="form-control" placeholder="phone"
                                            value="{{ Auth::guard('customer')->user()->phone }}">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="email" class="form-control" placeholder="email"
                                            value="{{ Auth::guard('customer')->user()->email }}">
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="address" class="form-control" placeholder="address"
                                            value="{{ Auth::guard('customer')->user()->address }}">
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label>
                                            <input name="save_info" type="checkbox" checked>
                                            <span> Lưu thông tin</span></label>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <button class=" btn btn-success getDetailOrder" type="submit">Áp dụng</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if (session()->get('shipping'))
                            <div class="caupons">
                                <form action="" method="post">
                                    @csrf
                                    <label>FreeShip Code</label>
                                    <input class="caupon_text" type="text" name="freeship">
                                    <button class=" free-shipping btn btn-success" type="submit"
                                        style="padding: 14px 15px;">Áp dụng</button>
                                </form>
                            </div>
                        @endif

                        @if (!session()->get('coupon'))
                            <div class="caupons">
                                <form action="" method="post">
                                    @csrf
                                    <input type="hidden" name="address" class="form-control" placeholder="address"
                                        value="{{ explode(',', Auth::guard('customer')->user()->address)[0] }}">
                                    <input type="hidden" value="{{ Auth::guard('customer')->user()->id }}"
                                        name="user_id">
                                    <label>Mã giảm giá</label>
                                    <input class="caupon_text" type="text" name="coupon">
                                    <button class="caupon-btn" type="submit">Áp dụng</button>
                                </form>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <h2 class="checkout-head">Your Order</h2>
                        <div class="checkout-order-table text-left">
                            <table class="table-responsive">
                                <thead>
                                    <tr class="th-head">
                                        <th scope="col" width="68%">PRODUCT</th>
                                        <th scope="col" width="42%">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order as $value)
                                        <tr>
                                            <td> {{ $value['cart']->getProducts->name }} x
                                                {{ $value['quantity'] }}</td>
                                            <td> {{ number_format(($value['cart']->getProducts->sale_price > 0 ? $value['cart']->getProducts->sale_price : $value['cart']->price) * $value['cart']->quantity, 0, ',', '.') . ' VND' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <td>Tiền dự kiến</td>
                                        <td>{{ number_format($total_order, 0, ',', '.') . ' VND' }}
                                        </td>
                                    </tr>
                                    @if (session()->get('coupon'))
                                        @if (session()->get('coupon')['condition'] == '0')
                                            <tr class="cart-shoppings">
                                                <td>Tiền giảm giá</td>
                                                <td id="condition">
                                                    -
                                                    {{ number_format(($total_order * session()->get('coupon')['discount']) / 100, 0, ',', '.') . ' VND' }}
                                                </td>
                                            </tr>
                                        @else
                                            <tr class="cart-shoppings">
                                                <td>Tiền giảm giá</td>
                                                <td id="condition">
                                                    -
                                                    {{ number_format(session()->get('coupon')['discount'], 0, ',', '.') . ' VND' }}
                                                </td>
                                            </tr>
                                        @endif
                                    @else
                                        <tr class="cart-shoppings">
                                            <td>Tiền giảm giá</td>
                                            <td id="condition">Chưa có mã giảm giá </td>
                                        </tr>
                                    @endif
                                    @if (session()->get('shipping'))
                                        <tr class="cart-shopping">
                                            <td>Phí vận chuyển</td>
                                            <td id='shipping'>
                                                +
                                                {{ number_format(session()->get('shipping')['price'], 0, ',', '.') . ' VND' }}
                                            </td>
                                        </tr>
                                    @else
                                        <tr class="cart-shopping">
                                            <td>Phí vận chuyển</td>
                                            <td id='shipping'>???</td>
                                        </tr>
                                    @endif
                                    @if (session()->get('freeship'))
                                        <tr class="cart-shopping">
                                            <td>FREESHIP</td>

                                            <td id='freeship'>-
                                                {{ number_format(session()->get('freeship')['discount'], 0, ',', '.') . ' VND' }}
                                            </td>
                                        </tr>
                                    @else
                                        <tr class="cart-shopping d-none">
                                            <td>FREESHIP</td>
                                            <td id='freeship'>???</td>
                                        </tr>
                                    @endif
                                    <tr class="cart-total">
                                        <td>Tổng thanh toán</td>
                                        <td id="order_Total">
                                            {{ number_format($cart_total_in_order, 0, ',', '.') . ' VND' }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="checkout-step-three text-left">
                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h2 class="checkout-head">02 / Phương thức thanh toán</h2>
                        <form method="post">
                            @csrf
                            <div class="center row">
                                <div class="checkout-three-form text-left">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="hidden" name="user_id"
                                                value="{{ Auth::guard('customer')->user()->id }}" id="order_user_id">
                                            <input type="hidden" name="address" class="form-control" placeholder="address"
                                                id="order_address"
                                                value="{{ Auth::guard('customer')->user()->address }}">
                                            <textarea type="text" name="note" class="form-control" placeholder="Order notes"
                                                rows="5"></textarea>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div>
                                                @foreach ($payment as $pt)
                                                    <label>
                                                        <input type="radio" name="payment"
                                                            value="{{ $pt->id }}">{{ $pt->name }}
                                                    </label>
                                                @endforeach
                                                <div class="1 box">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <button type="submit" class="btn btn-primary order_now"> Mua
                                                            hàng</button>
                                                    </div>
                                                </div>
                                                <div class="2 box">

                                                    @php
                                                        if (Auth::guard('customer')->check()) {
                                                            $cart_to = 0;
                                                            $order = session()->get('order') ? session()->get('order') : [];
                                                            foreach ($order as $item) {
                                                                $cart_to += ($item['cart']->getProducts->sale_price > 0 ? $item['cart']->getProducts->sale_price : $item->getProducts->price) * $item['quantity'];
                                                            }
                                                            $cart_tot = $cart_to;
                                                            if (session()->get('shipping')) {
                                                                if (session()->get('freeship')) {
                                                                    if (session()->get('shipping')['price'] - session()->get('freeship')['discount'] > 0) {
                                                                        $shiping = session()->get('shipping')['price'] - session()->get('freeship')['discount'];
                                                                    } else {
                                                                        $shiping = 0;
                                                                    }
                                                                } else {
                                                                    $shiping = session()->get('shipping')['price'];
                                                                }
                                                            } else {
                                                                $shiping = 0;
                                                            }
                                                            if (session()->get('coupon')) {
                                                                if (session()->get('coupon')['condition'] == 0) {
                                                                    $coupon = $cart_tot * ((100 - session()->get('coupon')['discount']) / 100);
                                                                } else {
                                                                    $coupon = session()->get('coupon')['discount'];
                                                                }
                                                            } else {
                                                                $coupon = 0;
                                                            }

                                                            $cart_total_in_order_usd = round(($cart_tot - $coupon + $shiping) / 23000, 2);
                                                        } else {
                                                            $cart_total_in_order_usd = 0;
                                                        }
                                                        // dd($cart_total_in_order)
                                                    @endphp
                                                    <input type="hidden" id="usds"
                                                        value="{{ $cart_total_in_order_usd }}">
                                                    <input type="hidden" id="xa_usd" value="{{ $xa_name }}">
                                                    <input type="hidden" id="qh_usd" value="{{ $qh_name }}">
                                                    <input type="hidden" id="tp_usd" value="{{ $tp_name }}">
                                                    <input type="hidden" id="name_usd"
                                                        value="{{ Auth::guard('customer')->user()->name }}">
                                                    <input type="hidden" id="phone_usd"
                                                        value="{{ Auth::guard('customer')->user()->phone }}">
                                                    <div class="col-md-12">


                                                        <div id="paypal-button"></div>
                                                        <script src="https://www.paypalobjects.com/api/checkout.js"></script>
                                                        <script>
                                                            var money_usd = document.getElementById("usds").value;
                                                            var address_usd = document.getElementById("order_address").value;
                                                            var xa_usd = document.getElementById("xa_usd").value;
                                                            var qh_usd = document.getElementById("qh_usd").value;
                                                            var tp_usd = document.getElementById("tp_usd").value;
                                                            var phone_usd = document.getElementById("phone_usd").value;
                                                            var name_usd = document.getElementById("name_usd").value;


                                                            paypal.Button.render({
                                                                // Configure environment
                                                                env: 'sandbox',
                                                                client: {
                                                                    sandbox: 'demo_sandbox_client_id',
                                                                    production: 'demo_production_client_id'
                                                                },
                                                                locale: 'en_US',
                                                                style: {
                                                                    size: 'large',
                                                                    color: 'gold',
                                                                    shape: 'pill',
                                                                },

                                                                commit: true,

                                                                // Set up a payment
                                                                payment: function(data, actions) {
                                                                    return actions.payment.create({
                                                                        transactions: [{
                                                                            amount: {
                                                                                total: `${money_usd}`,
                                                                                currency: 'USD',

                                                                            },
                                                                            custom: '90048630024435',
                                                                            payment_options: {
                                                                                allowed_payment_method: 'INSTANT_FUNDING_SOURCE'
                                                                            },
                                                                            soft_descriptor: 'ECHI5786786',
                                                                            item_list: {
                                                                                shipping_address: {
                                                                                    recipient_name: `${name_usd}`,
                                                                                    line1: `${address_usd}`,
                                                                                    line2: `${xa_usd}`,
                                                                                    city: `${qh_usd}`,
                                                                                    country_code: 'US',
                                                                                    postal_code: '95131',
                                                                                    phone: `${phone_usd}`,
                                                                                    state: 'CA'
                                                                                }
                                                                            }
                                                                        }],
                                                                        note_to_payer: 'Contact us for any questions on your order.'
                                                                    });
                                                                },
                                                                // Execute the payment


                                                                onAuthorize: function(data, actions) {
                                                                    total = $('#order_Total').html();
                                                                    user_id = $('#order_user_id').val();
                                                                    address = $('#order_address').val();
                                                                    note = $("textarea[name='note']").val();
                                                                    mail_send = $("input[name='email']").val();
                                                                    payment = 2;
                                                                    $.ajax({
                                                                        url: "{{ route('customer.getOrder') }}",
                                                                        type: "POST",
                                                                        data: {
                                                                            _token: "{{ csrf_token() }}",
                                                                            payment: payment,
                                                                            user_id: user_id,
                                                                            address: address,
                                                                            note: note,
                                                                            'mail_send': mail_send
                                                                        },
                                                                        success: function(data) {
                                                                            window.location = '{{ route('success_order') }}'

                                                                            Swal.fire({
                                                                                position: 'top-end',
                                                                                icon: 'success',
                                                                                title: 'Đặt hàng thành công',
                                                                                showConfirmButton: false,
                                                                                timer: 1500
                                                                            });
                                                                        },
                                                                        error: function(data) {
                                                                            const Toast = Swal.mixin({
                                                                                toast: true,
                                                                                position: 'top-end',
                                                                                showConfirmButton: false,
                                                                                timer: 3000,
                                                                                timerProgressBar: false,
                                                                                didOpen: (toast) => {
                                                                                    toast.addEventListener('mouseenter', Swal
                                                                                        .stopTimer)
                                                                                    toast.addEventListener('mouseleave', Swal
                                                                                        .resumeTimer)
                                                                                }
                                                                            })
                                                                            Toast.fire({
                                                                                icon: 'error',
                                                                                title: 'Kiểm tra lại đơn hàng'
                                                                            })
                                                                            console.log(data);
                                                                        }
                                                                    })

                                                                },
                                                                onCancel: function(data, actions) {
                                                                    actions.redirect();
                                                                }
                                                            }, '#paypal-button');
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Content -->
@stop
@section('css')
    <style>
        .box {
            padding: 20px;
            display: none;
            margin-top: 20px;
        }

    </style>
@stop
@section('js')

    <script>
        $(document).ready(function() {
            $('input[type="radio"]').click(function() {
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".box").not(targetBox).hide();
                $(targetBox).show();
            });
        });

        $('.choose').on('change', function(e) {
            e.preventDefault();
            var action = $(this).attr("id");
            var ma_id = $(this).val();
            var _token = $("input[name='_token']").val();
            var result = '';
            if (action == 'tp_id') {
                result = '#qh_id';
            } else if (action == 'qh_id') {
                result = '#xa_id';
            }
            $.ajax({
                url: "{{ route('customer.select_shipping') }}",
                type: 'POST',
                data: {
                    action: action,
                    ma_id: ma_id,
                    _token: _token
                },
                success: function(data) {
                    console.log(result);
                    $(result).html(data);
                }
            })
        });
        $('.free-shipping').click(function(e) {
            e.preventDefault();
            var url = "{{ route('customer.check_freeship') }}";
            var freeship = $("input[name='freeship']").val();
            var _token = $("input[name='_token']").val();
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _token: _token,
                    'freeship': freeship,
                },
                success: function(data) {
                    $("#freeship").html(data);
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: false,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal
                                .stopTimer)
                            toast.addEventListener('mouseleave', Swal
                                .resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Thêm mã freeship thành công'
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
                        title: 'Không thể thêm mã freeship'
                    })
                }
            });
            $.ajax({
                type: "GET",
                url: "{{ route('customer.order.getTotalPrice') }}",
                data: {},
                success: function(data) {
                    console.log(data);
                    $("#order_Total").html(data);
                },
                error: function(res) {
                    console.log(res);
                }
            })
        });
        $('.caupon-btn').click(function(e) {
            e.preventDefault();
            var url = "{{ route('customer.check_coupon') }}";
            var coupon = $("input[name='coupon']").val();
            var _token = $("input[name='_token']").val();
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _token: _token,
                    'coupon': coupon,
                },
                success: function(data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: false,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal
                                .stopTimer)
                            toast.addEventListener('mouseleave', Swal
                                .resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Thêm mã giảm giá thành công'
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
                        title: 'Không thể thêm mã giảm giá'
                    })
                }
            })



            $.ajax({
                type: "GET",
                url: "{{ route('customer.get_coupon') }}",
                data: {},
                success: function(data) {
                    console.log(data);
                    $("#coupon_price").html(data);
                },
                error: function(res) {
                    console.log(res);
                }
            })
            $.ajax({
                type: "GET",
                url: "{{ route('customer.get_condition_coupon') }}",
                data: {},
                success: function(data) {
                    console.log(data);
                    $("#condition").html(data);
                },
                error: function(res) {
                    console.log(res);
                }
            })
            $.ajax({
                type: "GET",
                url: "{{ route('customer.order.getTotalPrice') }}",
                data: {},
                success: function(data) {
                    console.log(data);
                    $("#order_Total").html(data);
                },
                error: function(res) {
                    console.log(res);
                }
            })
        })
        $('.getDetailOrder').click(function(e) {
            e.preventDefault();
            var _token = $("input[name='_token']").val();
            var user_id = $("input[name='user_id']").val();
            var address = $("input[name='address']").val();
            var save_info = $("input[name='save_info']").val();
            var tp_id = $('#tp_id').val();
            var qh_id = $('#qh_id').val();
            var xa_id = $('#xa_id').val();
            $.ajax({
                url: "{{ route('gio-hang.getShipping') }}",
                type: 'POST',
                data: {
                    _token: _token,
                    tp_id: tp_id,
                    qh_id: qh_id,
                    xa_id: xa_id
                },
                success: function(data) {
                    $('#shipping').html(data);
                }
            });
            $.ajax({
                type: "GET",
                url: "{{ route('customer.order.getTotalPrice') }}",
                data: {},
                success: function(data) {
                    console.log(data);
                    $("#order_Total").html(data);
                },
                error: function(res) {
                    console.log(res);
                }
            })
            $.ajax({
                url: "{{ route('gio-hang.getShippingDetail') }}",
                type: 'POST',
                data: {
                    _token: _token,
                    tp_id: tp_id,
                    qh_id: qh_id,
                    xa_id: xa_id,
                    user_id: user_id,
                    address: address,
                    save_info: save_info
                },
                success: function(data) {
                    console.log(data);
                }
            })
        });
        $('.order_now').click(function(e) {
            e.preventDefault();
            var payment = $('input[name="payment"]:checked').val();
            var _token = $("input[name='_token']").val();
            var user_id = $("input[name='user_id']").val();
            var address = $("input[name='address']").val();
            var note = $("textarea[name='note']").val();
            var mail_send = $("input[name='email']").val();

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "Đơn hàng sẽ được xác nhận!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Mua hàng!',
                cancelButtonText: 'Hủy!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('customer.getOrder') }}",
                        type: "POST",
                        data: {
                            _token: _token,
                            payment: payment,
                            user_id: user_id,
                            address: address,
                            note: note,
                            mail_send: mail_send
                        },
                        success: function(data) {
                            window.location = '{{ route('success_order') }}'

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Đặt hàng thành công',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                        error: function(data) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: false,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })
                            Toast.fire({
                                icon: 'error',
                                title: 'Kiểm tra lại đơn hàng'
                            })
                        }
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Hủy',
                        'error'
                    )
                }
            })
        });
    </script>
@stop
{{-- sb-5pzkx7007613@personal.example.com
1y$v%c]W --}}
