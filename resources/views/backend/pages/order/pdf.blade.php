<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">

                        <div class="invoice p-3 mb-3">

                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                        <strong>Organic Admin</strong><br>
                                        {{ $info->address }}<br>
                                        Phone: {{ $info->phone }}<br>
                                        Email: {{ $info->email }}
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    To
                                    <address>
                                        <strong>{{ $order->user->name }}</strong><br>
                                        {{ $order->address }} - {{ $order->deliveries->getCommune->name }}<br>
                                        - {{ $order->deliveries->getProvince->name }}
                                        - {{ $order->deliveries->getCity->name }}
                                        <br>
                                        Phone: {{ $order->user->phone }}<br>
                                        Email: {{ $order->user->email }}
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <br>
                                    <b>Đơn hàng ID:</b> 4F3S8J<br>
                                    <b>Ngày đặt hàng:</b> {{ $order->created_at->format('m-d-y') }}<br>
                                    <b>Tổng tiền:</b> {{ number_format($order->total, 0, ',', '.') . ' VND' }}
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th>Tên </th>
                                                <th>Ảnh sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Gía</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total_order = 0;
                                            @endphp
                                            @foreach ($order->order_detail as $value)
                                                <tr>
                                                    <td>{{ $value->productInOrderDetail->name }}</td>
                                                    <td><img src="{{ url('uploads') }}/{{ $value->productInOrderDetail->image }}"
                                                            alt="" srcset="" width="100px"></td>
                                                    <td>{{ $value->quantity }}</td>
                                                    <td>{{ number_format($value->price, 0, ',', '.') . ' VND' }}</td>
                                                    <td>{{ number_format($value->price * $value->quantity, 0, ',', '.') . ' VND' }}
                                                    </td>
                                                    @php
                                                        $total_order += $value->price * $value->quantity;
                                                    @endphp
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-6">
                                    <p class="lead">Phương thức thanh toán:</p>
                                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                        {{ $order->payment->name }}.
                                    </p>
                                </div>
                                <!-- /.col -->
                                <div class="col-6">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Tiền:</th>
                                                <td> {{ number_format($total_order, 0, ',', '.') . ' VND' }}
                                                </td>
                                            </tr>
                                            @if ($order->coupon_id)
                                                <tr>
                                                    <th>Tiền giảm giá</th>
                                                    <td>-
                                                        @if ($order->coupon->condition == 0)
                                                            {{ number_format(($total_order * $order->coupon->discount) / 100, 0, ',', '.') . ' VND' }}
                                                        @else
                                                            {{ number_format($order->coupon->discount, 0, ',', '.') . ' VND' }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif

                                            <tr>
                                                <th>Tiền ship:</th>
                                                <td>
                                                    {{ number_format($order->deliveries->price, 0, ',', '.') . ' VND' }}
                                                </td>
                                            </tr>
                                            @if ($order->free_ship_id)
                                                <tr>
                                                    <th>Free ship:</th>
                                                    <td>
                                                        -
                                                        {{ number_format($order->freeship->discount, 0, ',', '.') . ' VND' }}
                                                    </td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <th>Tổng tiền:</th>
                                                <td>{{ number_format($order->total, 0, ',', '.') . ' VND' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->

                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
