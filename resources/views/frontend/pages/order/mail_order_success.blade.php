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
    <div class="tab-content">
        <div class="tab-pane active form-horizontal" id="tab_content">
            <div class="document-price-wrapper">


            </div>

            <p style="text-align: justify;">Ngày {{ $data['now'] }}</p>


            <p style="text-align: justify;">Tên khách hàng : {{ Auth::guard('customer')->user()->name }}</p>

            <p style="text-align: justify;">Địa chỉ : {{ $data['address'] }}</p>

            <p style="text-align: justify;"><b>CHỦ ĐỀ : XÁC NHẬN ĐẶT HÀNG </b></p>

            <p style="text-align: justify;">&nbsp;</p>

            <p style="text-align: justify;">Kính gửi : {{ Auth::guard('customer')->user()->name }},</p>

            <p style="text-align: justify;">Công ty chúng tôi gửi đến quý khách hàng lá thư này nhằm xác nhận về việc
                đặt hàng của quý khách hàng vào {{ $data['now'] }}.</p>
            <p style="text-align: justify;">
                Thông tin Các sản phẩm đã đặt:
            </p>
            <div class="row" style="padding-top:10px">
                <div class="col-12 table-responsive">
                    <table class="table table-striped text-center" border="1">
                        <thead>
                            <tr>
                                <th>Tên </th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data['order'] as $value)
                                <tr>

                                    <td> {{ $value['cart']->getProducts->name }} </td>
                                    <td>{{ $value['quantity'] }}</td>
                                    <td> {{ number_format($value['cart']->getProducts->sale_price > 0 ? $value['cart']->getProducts->sale_price : $value['cart']->price, 0, ',', '.') . ' VND' }}
                                    <td> {{ number_format(($value['cart']->getProducts->sale_price > 0 ? $value['cart']->getProducts->sale_price : $value['cart']->price) * $value['cart']->quantity, 0, ',', '.') . ' VND' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <div class="row" style="padding-top:10px">
                <table class="table  text-center ">
                    <tr>
                        <td style="border:1px  dotted #000;">
                            <div class="col-6">
                                @if ($data['payment'] == 2)

                                    <b class="lead">Phương thức thanh toán:</b>
                                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                        Thanh toán online bằng PayPal

                                    </p>
                                    <b class="lead">Tình trạng thanh toán:</b>
                                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                        Đã thanh toán

                                    </p>

                                @else
                                    <b class="lead">Phương thức thanh toán:</b>
                                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                        Thanh toán sau khi nhận hàng

                                    </p>
                                    <b class="lead">Tình trạng thanh toán:</b>
                                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                        Chưa thanh toán

                                    </p>
                                @endif
                            </div>
                        </td>
                        <td style="border:1px  dotted #000;">
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table">

                                        <tr>
                                            <th>Tiền giảm giá</th>
                                            <td>-
                                                {{ number_format($data['coupon'], 0, ',', '.') . ' VND' }}

                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Tiền ship:</th>
                                            <td>
                                                {{ number_format($data['shipping'], 0, ',', '.') . ' VND' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Free ship:</th>
                                            <td>
                                                -
                                                {{ number_format($data['freeship'], 0, ',', '.') . ' VND' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tổng tiền:</th>
                                            <td>{{ number_format($data['cart_total'], 0, ',', '.') . ' VND' }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </td>
                    </tr>

                </table>
                <!-- accepted payments column -->

                <!-- /.col -->

                <!-- /.col -->
            </div>
            <p style="text-align: justify;">Đính kèm theo thư này là Đơn đặt hàng có chứa các điều khoản đã nêu.</p>

            <p style="text-align: justify;">Trong trường hợp không nhận được thông báo nào về việc thay đổi hoặc huỷ bỏ
                đơn hàng trong vòng mười ngày (10) kể từ ngày quý khách hàng nhận được lá thư này, chúng tôi sẽ tiến
                hành giao hàng mà quý khách hàng đã đặt vào ngày đã nêu.</p>

            <p style="text-align: justify;">Trân trọng cảm ơn,</p>

            <p style="text-align: justify;">&nbsp;</p>

            <p style="text-align: justify;">{{ $data['info']->email }}</p>







            <p>&nbsp;</p>

            <p>&nbsp;</p>
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
