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
                    <li><a href="index.html">Home</a></li>
                    <li>Shoping Cart</li>
                </ul>
                <h1 class="page-tit">Shoping Cart</h1>
            </div>
        </div>
    </section>
    <div class="content-part ">
        <div class="container">
            <article class="card">
                <header class="card-header"> My Orders / Tracking </header>
                @foreach ($order->getOrderTracking(Auth::guard('customer')->user()->id) as $value)
                    <div class="card-body">
                        <article class="card">

                            <div class="card-body row">
                                <div class="col-md-3"> <strong>Ngày đặt hàng:</strong>
                                    <br>{{ $value->created_at->format(' F j, Y ') }}
                                </div>
                                <div class="col-md-3"> <strong>Tổng tiền thanh toán:</strong> <br>
                                    {{ number_format($value->total, 0, ',', '.') . ' VND' }}</div>
                                <div class="col-md-3"> <strong>Trạng thái:</strong> <br>
                                    @if ($value->status == 0)
                                        Đang chờ xác nhận
                                    @elseif ($value->status ==1)
                                        Đã xác nhận
                                    @elseif ($value->status ==2)
                                        Chờ lấy hàng
                                    @elseif ($value->status ==3)
                                        Đang giao hàng
                                    @elseif ($value->status ==4)
                                        Đã giao hàng
                                    @else
                                        Đã huỷ
                                    @endif
                                </div>
                                <div class="col-md-3"> <strong>Phương thức thanh toán:</strong> <br>
                                    {{ $value->payment->name }} </div>
                            </div>
                        </article>
                        @if ($value->status != 5)
                            <div class="track">


                                <div class="step {{ $value->status > 0 ? 'active' : '' }}"> <span class="icon"> <i
                                            class="icon-check-mark"></i> </span> <span class="text">Đã xác nhận</span>
                                </div>
                                <div class="step {{ $value->status > 1 ? 'active' : '' }}"> <span class="icon"> <i
                                            class="icon-avatar"></i> </span> <span class="text">Chờ lấy hàng</span>
                                </div>
                                <div class="step {{ $value->status > 2 ? 'active' : '' }}"> <span class="icon"> <i
                                            class="icon-truck"></i> </span> <span class="text">Đang giao hàng</span>
                                </div>
                                <div class="step {{ $value->status > 3 ? 'active' : '' }}"> <span class="icon"><i
                                            class="icon-add"></i> </span> <span class="text">Đã giao hàng</span>
                                </div>
                            </div>
                        @endif
                        @if ($value->status == 0)
                            <div class="row">
                                <a href="{{ route('customer.cancel_order', $value->id) }}"
                                    class="btn btn-warning cancel_order" style="float:left" data-id="{{ $value->id }}"
                                    data-mail="{{ Auth::guard('customer')->user()->email }}"> <i
                                        class="icon-cancel-music"></i> Hủy
                                    đơn hàng</a>
                            </div>
                        @endif

                        <hr>
                        <ul class="row">
                            @foreach ($value->order_detail as $pro)
                                <li class="col-md-4">
                                    <figure class="itemside mb-3">
                                        <div class="aside"><img
                                                src="{{ url('uploads/product') }}/{{ $pro->productInOrderDetail->image }}"
                                                class="img-sm border">
                                        </div>
                                        <figcaption class="info align-self-center">
                                            <p class="title">{{ $pro->productInOrderDetail->name }} <strong>x
                                                </strong>{{ $pro->quantity }}</p> <span
                                                class="text-muted">{{ number_format($pro->price, 0, ',', '.') . ' VND' }}
                                            </span>
                                        </figcaption>
                                    </figure>
                                    @if ($value->status == 4)
                                        @if ($pro->status == 1)
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#exampleModal{{ $pro->id }}">Reviews</button>
                                            <div class="modal fade" id="exampleModal{{ $pro->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
                                                style="display: none;">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form method="post"
                                                            action="{{ route('lich-su-mua-hang.store') }}"
                                                            enctype="multipart/form-data">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    New
                                                                    message</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @csrf
                                                                <input type="hidden" name="order_detail_id"
                                                                    value="{{ $pro->id }}">
                                                                <div class="form-group">
                                                                    <label for="" class="col-form-label"></label>
                                                                    <div class="rating_feedback ">
                                                                        <span class="checked"><input type="radio"
                                                                                name="rating" id="str{{ $pro->id }}5"
                                                                                value="5"><label class="icon_star"
                                                                                for="str{{ $pro->id }}5"></label></span>
                                                                        <span><input type="radio" name="rating"
                                                                                id="str{{ $pro->id }}4"
                                                                                value="4"><label class="icon_star"
                                                                                for="str{{ $pro->id }}4"></label></span>
                                                                        <span><input type="radio" name="rating"
                                                                                id="str{{ $pro->id }}3"
                                                                                value="3"><label class="icon_star"
                                                                                for="str{{ $pro->id }}3"></label></span>
                                                                        <span><input type="radio" name="rating"
                                                                                id="str{{ $pro->id }}2"
                                                                                value="2"><label class="icon_star"
                                                                                for="str{{ $pro->id }}2"></label></span>
                                                                        <span><input type="radio" name="rating"
                                                                                id="str{{ $pro->id }}1"
                                                                                value="1"><label class="icon_star"
                                                                                for="str{{ $pro->id }}1"></label></span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="message-text"
                                                                        class="col-form-label">Message:</label>
                                                                    <textarea class="form-control" id="message-text"
                                                                        name="message"></textarea>
                                                                </div>
                                                                <div class="form-group ">
                                                                    <div class="field file-inputs" align="left">
                                                                        <label for="files"
                                                                            class="col-form-label">Image:</label>
                                                                        <input type="file" id="files" name="files[]"
                                                                            multiple />
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Send
                                                                    message</button>
                                                            </div>
                                                        </form>

                                                    </div>

                                                </div>
                                            </div>
                                        @endif


                                    @endif
                                </li>
                            @endforeach


                        </ul>


                        <hr>

                    </div>
                @endforeach
                <div class="row d-flex">
                    <div class="col-md-6">
                        <a href="#" class="btn btn-warning" data-abc="true"> <i class="icon-chevron-left"></i>
                            Back
                            to orders</a>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="demo">
                            <nav class="pagination-outer" aria-label="Page navigation">
                                <ul class="pagination">
                                    @if ($order->getOrderTracking(Auth::guard('customer')->user()->id)->onFirstPage())
                                        <li class=" d-none" style="display: none"><span>&lt;</span></li>
                                    @else
                                        <li class="page-item"><a
                                                href="{{ $order->getOrderTracking(Auth::guard('customer')->user()->id)->previousPageUrl() }}"
                                                rel="prev" class="page-link" aria-label="Previous">«</a>
                                        </li>
                                    @endif
                                    @for ($i = 1; $i <= $order->getOrderTracking(Auth::guard('customer')->user()->id)->lastPage(); $i++)
                                        <li
                                            class="page-item {{ $i == $order->getOrderTracking(Auth::guard('customer')->user()->id)->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    @if ($order->getOrderTracking(Auth::guard('customer')->user()->id)->hasMorePages())
                                        <li class="page-item"><a class="page-link" aria-label="Next"
                                                href="{{ $order->getOrderTracking(Auth::guard('customer')->user()->id)->nextPageUrl() }}"
                                                rel="next">»</a>
                                        </li>
                                    @else
                                        <li class="d-none" style="display:none"><span>&gt;</span></li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
@stop
@section('js')
    <script>
        $('.cancel_order').click(function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            var mail = $(this).data("mail");
            var token = $("meta[name='csrf-token']").attr("content");
            var url = $(this).attr('href');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Bạn chắc chắn hủy đơn hàng này chứ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hủy đơn hàng!',
                cancelButtonText: 'Bỏ!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            "id": id,
                            "_token": token,
                            "email_send": mail
                        },
                        success: function(result) {
                            swalWithBootstrapButtons.fire(
                                'Đã hủy!',
                                'Đơn hàng của bạn đã hủy',
                                'success'
                            );
                            // window.location = '{{ route('dat-hang.index') }}'
                            window.location.reload();
                        },
                        error: function(result) {
                            swalWithBootstrapButtons.fire(
                                'Bỏ',
                                'Đơn hàng của bạn chưa hủy',
                                'error'
                            )
                        }
                    })

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Bỏ',
                        'Đơn hàng của bạn chưa hủy',
                        'error'
                    )
                }
            })
        });
    </script>
@stop
@section('css')
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"> --}}
    <style>
        .file-inputs label {
            display: block;
            position: relative;
            width: 180px;
            height: 40px;
            border-radius: 25px;
            background: linear-gradient(40deg, #ff6ec4, #7873f5);
            box-shadow: 0 4px 7px rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: transform .2s ease-out;
        }

        .icon-cancel-music:before,
        .icon-cancel-music {
            margin: 0;
            width: 20px;
            height: 20px;
            line-height: 20px;
            font-size: 8px;
            color: #fff;
        }

        .pagination-outer {
            text-align: right;
        }

        .pagination {
            font-family: 'Oxygen', sans-serif;
            display: inline-flex;
            position: relative;
            margin: 0;
            text-align: center;
        }

        .pagination li a.page-link {
            color: #e44251;
            background-color: transparent;
            font-size: 17px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            line-height: 30px;
            height: 35px;
            width: 35px;
            margin: 0 4px 0 0;
            border: 1px solid #e44251;
            border-radius: 0;
            position: relative;
            z-index: 1;
            transition: all 0.4s ease 0s;
        }

        .pagination li.active a.page-link,
        .pagination li a.page-link:hover,
        .pagination li.active a.page-link:hover {
            color: #fff;
            background-color: #e44251;
            border-color: #e44251;
        }

        .pagination li a.page-link:before,
        .pagination li a.page-link:after {
            content: '';
            background-color: #e44251;
            height: 100%;
            width: 100%;
            border-radius: 50%;
            transform: scale(0) rotateX(360deg);
            position: absolute;
            left: 0;
            top: 0;
            z-index: -1;
            transition: all 0.3s;
        }

        .pagination li a.page-link:after {
            background-color: transparent;
            border-radius: 0;
            transform: scale(0.7);
            transition-delay: 0.1s;
        }

        .pagination li a.page-link:hover:before {
            border-radius: 0;
            transform: scale(1) rotateX(0);
        }

        .pagination li a.page-link:hover:after {
            background-color: #e44251;
            opacity: 0;
            transform: scale(1.5);
        }

        @media only screen and (max-width: 480px) {
            .pagination {
                display: block;
                border-radius: 20px;
            }

            .pagination li {
                margin: 5px 2px;
                display: inline-block;
            }

            .pagination li a.page-link {
                margin: 0;
            }
        }

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 0.10rem;
            font-size: 15px;
            padding: 2px 15px;
        }

        .card-header:first-child {
            border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .track {
            position: relative;
            background-color: #ddd;
            height: 7px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 60px;
            margin-top: 50px
        }

        .track .step {
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            width: 25%;
            margin-top: -18px;
            text-align: center;
            position: relative
        }

        .track .step.active:before {
            background: #FF5722
        }

        .track .step::before {
            height: 7px;
            position: absolute;
            content: "";
            width: 100%;
            left: 0;
            top: 18px
        }

        .track .step.active .icon {
            background: #ee5435;
            color: #fff
        }

        .track .icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            position: relative;
            border-radius: 100%;
            background: #ddd
        }

        .track .step.active .text {
            font-weight: 400;
            color: #000;
            font-size: 15px;
        }

        .track .text {
            display: block;
            margin-top: 48px;
            font-size: 15px;
            color: #000;
        }

        .itemside {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 100%
        }

        .itemside .aside {
            position: relative;
            -ms-flex-negative: 0;
            flex-shrink: 0
        }

        .img-sm {
            width: 80px;
            height: 80px;
            padding: 5px;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        ul.row,
        ul.row-sm {
            list-style: none;
            padding: 0
        }

        .itemside .info {
            padding-left: 15px;
            padding-right: 7px
        }

        .itemside .title {
            display: block;
            margin-bottom: 5px;
            color: #212529
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem
        }

        .btn-warning {
            font-size: 14px;
            color: #ffffff;
            background-color: #ee5435;
            border-color: #ee5435;
            border-radius: 1px;
            padding: 4px 29px;
            float: inherit;
        }

        .btn-warning:hover {
            color: #ffffff;
            background-color: #ff2b00;
            border-color: #ff2b00;
            border-radius: 1px
        }

        .card-body .col-md-3 {
            padding: 20px;
        }

    </style>

@stop
