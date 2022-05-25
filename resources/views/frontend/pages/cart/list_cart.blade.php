@extends('frontend.master')
@section('main')
    <section class="sub-banner">
        <h2 class="sr-only">Banner</h2>
        <img src="{{ url('frontend') }}/images/cart-page-banner.jpg" alt="banner" class="banner">
    </section>
    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb">
                <ul class="list-inline">
                    <li><a href="{{ route('customer.home') }}">Trang chủ</a></li>
                    <li>Giỏ Hàng</li>
                </ul>
                <h1 class="page-tit">Giỏ Hàng</h1>
            </div>
        </div>
    </section>
    <!-- ============ Sub-Banner-End =============== -->
    <div class="content-part cart-page">
        <div class="container">
            <div class="table-responsive">
                <table class="table table-hover table-responsive text-center">
                    <thead>
                        <tr>
                            <th class="product">
                                <div class="icheck-danger d-inline">
                                    <input type="checkbox" id="checkboxPrimary0">
                                    <label for="checkboxPrimary0">
                                    </label>
                                </div>
                            </th>
                            <th class="product">Ảnh</th>
                            <th class="name">Tên sản phẩm</th>
                            <th class="price">Giá</th>
                            <th class="quantity">Số lượng</th>
                            <th class="total">Thành tiền</th>
                            <th class="cancle">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody id="success">
                        @foreach ($carts as $ct)
                            <tr id="{{ $ct->id }}">
                                <td>
                                    <div class="form-group clearfix">
                                        <div class="icheck-danger d-inline">
                                            <input type="checkbox" id="checkboxPrimary{{ $ct->id }}"
                                                value="{{ $ct->id }}" class="check_one" name="idCart">
                                            <label for="checkboxPrimary{{ $ct->id }}">
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td class="cart-image-wrapper">
                                    <a href="#"><img class="cart-image "
                                            src="{{ url('uploads/product') }}/{{ $ct->getProducts->image }}" alt=""
                                            style="width:100px"></a>
                                </td>
                                <td class="product-tit"><a href="#">{{ $ct->getProducts->name }}</a></td>
                                <td class="price"><span class="money">
                                        {{ number_format($ct->getProducts->sale_price > 0 ? $ct->getProducts->sale_price : $ct->price, 0, ',', '.') . ' VND' }}</span>
                                </td>
                                <td>
                                    <div class="qty">
                                        <a href="{{ route('gio-hang.cart.minus', $ct->id) }}" class="minusCart"
                                            data-id="{{ $ct->id }}"><span class="icon-remove "
                                                style="padding: 0px 7px;"></span></a>
                                        <span class="qty_cart{{ $ct->id }}"
                                            id="qty_cart{{ $ct->id }}">{{ $ct->quantity }}</span>
                                        <a href="{{ route('gio-hang.cart.plus', $ct->id) }}" class="plusCart"
                                            data-id="{{ $ct->id }}"><span class="icon-add"
                                                style="padding: 0px 7px;"></span></a>
                                    </div>
                                </td>
                                <td class="total" id="total{{ $ct->id }}">
                                    {{ number_format(($ct->getProducts->sale_price > 0 ? $ct->getProducts->sale_price : $ct->price) * $ct->quantity, 0, ',', '.') . ' VND' }}
                                </td>
                                <td class="cancle"><a href="{{ route('gio-hang.destroy', $ct->id) }}"
                                        class="deleteRecord " data-id="{{ $ct->id }}"><i
                                            class="icon-cancel-music"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8">
                                <div class="l-part">
                                    <a class="continue-shopping-btn" href="{{ route('danh-sach-san-pham.index') }}">Tiếp
                                        tục xem sản phẩm<i class="icon-right-arrow-1"></i></a>
                                </div>
                                <div class="r-part">
                                    <button type="button" class=" cancle-cart-btn" id="deleteAllSelect"><i
                                            class="icon-cancel-music"></i>Xóa giỏ hàng
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="caupon">
                <form action="" method="post">
                    @csrf
                    <label>Coupon Code</label>
                    <input class="caupon_text" type="text" name="coupon">
                    <button class="caupon-btn" type="submit">Apply Now</button>
                </form>
            </div>
            <div class="row">
                <div class="col-md-5 col-sm-6 col-sm-12 pull-right">
                    <div class="total-box">
                        <div class="tit">Shopping Cart Total</div>
                        <div class="total-box-inner">
                            <div class="sub-total"><span>Tổng tiền phụ </span><span class="price"
                                    id="cart_Total">{{ number_format($cart_total, 0, ',', '.') . ' VND' }}</span></div>
                            <div class="sub-total">
                                @if (session()->get('coupon'))
                                    @if (session()->get('coupon')['condition'] == '0')
                                        <span> Mã :</span><span class="price" id="condition">-
                                            {{ session()->get('coupon')['discount'] }} %</span>
                                    @elseif (session()->get('coupon')['condition'] == '1')
                                        <span> Mã :</span><span class="price " id="condition">-
                                            {{ session()->get('coupon')['discount'] }} VND</span>
                                    @else
                                        <span> Mã :</span><span class="price " id="condition">Không có mã giảm giá</span>
                                    @endif
                                @else
                                    <span> Mã :</span><span class="price " id="condition">Không có mã giảm giá</span>
                                @endif
                            </div>
                            <div class="sub-total">
                                @if (session()->get('shipping'))
                                    <span> Tiền ship :</span><span class="price "
                                        id="shipping">{{ number_format(session()->get('shipping')['price'], 0, ',', '.') . ' VND' }}</span>
                                @else
                                    <span> Tiền ship :</span><span class="price " id="shipping">????</span>
                                @endif
                            </div>
                            <div class="grand-total"><span>Tổng tiền thanh toán </span><span class="price"
                                    id="coupon_price">{{ number_format($cart_total_price, 0, ',', '.') . ' VND' }}</span>
                            </div>
                            <button class="checkout-btn" id="cartAllSelect"><i class="icon-check-mark"></i>Mua hàng
                                ngay</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-sm-6 col-sm-12 pull-left">
                    <form action="">
                        @csrf
                        <div class="tax-box">
                            <div class="tit">Dự đoán phí vận chuyển</div>
                            <div class="tax-box-inner">
                                <p>Nhập địa chỉ của bạn để nhận giá vận chuyển.</p>
                                <label>Thành Phố</label>
                                <select name="tp_id" id="tp_id" class="choose">
                                    <option>----- Chọn thành phố -----</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                <label>Quận Huyện</label>
                                <select name="qh_id" id="qh_id" class=" qh_id choose">
                                    <option>----- Chọn quận huyện -----</option>
                                </select>
                                <label>Xã, Thị Trấn</label>
                                <select name="xa_id" id="xa_id" class=" xa_id ">
                                    <option>----- Chọn xã, thị trấn -----</option>
                                </select>
                                <button class="quote_shiping quote"><i class="icon-file"></i>Nhận phí ship</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop


@section('js')
    <script src="{{ url('frontend') }}/js/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $(function(e) {
                $("#checkboxPrimary0").click(function() {
                    $('input:checkbox').not(this).prop('checked', this.checked);
                });
                $('#cartAllSelect').click(function(e) {
                    e.preventDefault();
                    var all_ids = [];
                    $('input:checkbox[name=idCart]:checked').each(function() {
                        all_ids.push($(this).val());
                    });
                    $.ajax({
                        url: "{{ route('gio-hang.getProInCart') }}",
                        type: 'GET',
                        data: {
                            ids: all_ids
                        },
                        success: function(response) {
                            window.location = '{{ route('dat-hang.index') }}'
                            console.log(response);
                        }
                    });
                });
            });
            $('.deleteRecord').click(function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("content");
                var url = $(this).attr('href');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                "id": id,
                                "_token": token,
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                $("#" + id + "").remove();
                            },
                            error: function(response) {
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
                                    title: 'Không thể xóa sản phẩm khỏi giỏ hàng'
                                })
                            }
                        });
                        $.ajax({
                            type: "GET",
                            url: "{{ route('getTotalPrice') }}",
                            data: {},
                            success: function(data) {
                                console.log(data);
                                $("#cart_Total").html(data);
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
                                $("#item-cart").html(data + ' sản phẩm trong giỏ');
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
                    }
                })
            });
            $('.minusCart').click(function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        "id": id,
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
                            title: 'Số lượng sản phẩm đã được cập nhập'
                        })
                        $('#qty_cart' + id).text(data);
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
                            title: 'Không thể cập nhật số lượng sản phẩm'
                        })
                    }
                });
                $.ajax({
                    type: "GET",
                    url: "{{ route('getTotalPrice') }}",
                    data: {},
                    success: function(data) {
                        console.log(data);
                        $("#cartTotal").html(data);
                        $("#cart_Total").html(data);
                    },
                    error: function(res) {
                        console.log(res);
                    }
                })
                $.ajax({
                    type: "GET",
                    url: "{{ route('getPrice', 'id') }}",
                    data: {
                        "id": id
                    },
                    success: function(data) {
                        console.log(data);
                        $("#total" + id).html(data);
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
                        $("#countCart").html(data );
                        $("#item-cart").html(data+ ' sản phẩm trong giỏ');
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
            });
            $('.plusCart').click(function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        "id": id,
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
                            title: 'Số lượng sản phẩm đã được cập nhập'
                        })
                        $('#qty_cart' + id).text(data);
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
                            title: 'Không thể cập nhật số lượng sản phẩm'
                        })
                    }
                });
                $.ajax({
                    type: "GET",
                    url: "{{ route('getTotalPrice') }}",
                    data: {},
                    success: function(data) {
                        console.log(data);
                        $("#cart_Total").html(data);
                        $("#cartTotal").html(data);
                    },
                    error: function(res) {
                        console.log(res);
                    }
                })
                $.ajax({
                    type: "GET",
                    url: "{{ route('getPrice', 'id') }}",
                    data: {
                        "id": id
                    },
                    success: function(data) {
                        console.log(data);
                        $("#total" + id).html(data);
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
                        $("#item-cart").html(data + ' sản phẩm trong giỏ');
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
            });
            $('.caupon-btn').click(function(e) {
                e.preventDefault();
                var url = "{{ route('customer.check_coupon') }}";
                var coupon = $("input[name='coupon']").val();
                var _token = $("input[name='_token']").val();
                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: "json",
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
                    url: "{{ route('getTotalPrice') }}",
                    data: {},
                    success: function(data) {
                        console.log(data);
                        $("#cart_Total").html(data);
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
                        $("#item-cart").html(data + ' sản phẩm trong giỏ');
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
            })
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
            $('.quote_shiping').click(function(e) {
                e.preventDefault();
                var _token = $("input[name='_token']").val();
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
                    url: "{{ route('getTotalPrice') }}",
                    data: {},
                    success: function(data) {
                        console.log(data);
                        $("#cart_Total").html(data);
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
                        $("#item-cart").html(data + ' sản phẩm trong giỏ');
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
            })
        });
    </script>
@stop


@section('css')
@stop
