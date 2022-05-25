@extends('backend.master')
@section('title','Đơn hàng')
@section('main')
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
                                    <b>Tổng tiền:</b> {{ number_format($order->total, 0, ',', '.') . ' VND' }}<br>
                                    <b>Trạng thái:</b>
                                    @if ($order->status == 0)
                                        <span class="badge badge-danger">Chưa xử lý</span>
                                    @elseif ($order->status ==1)
                                        <span class="badge badge-primary">Đã xác nhận</span>
                                    @elseif ($order->status ==2)
                                        <span class="badge badge-warning">Chờ lấy hàng</span>
                                    @elseif ($order->status ==3)
                                        <span class="badge badge-info">Đang giao hàng</span>
                                    @elseif ($order->status ==4)
                                        <span class="badge badge-success">Đã giao hàng</span>
                                    @else
                                        <span class="badge badge-dark">Đã huỷ</span>
                                    @endif
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
                                    <b class="lead">Phương thức thanh toán:</b>
                                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                        {{ $order->payment->name }}.
                                    </p>
                                    <b class="lead">Tình trạng thanh toán:</b>

                                    <p class="text-muted" style="margin-top: 10px;">
                                        @if ($order->status_payment == 0)
                                            Chưa thanh toán
                                        @elseif ($order->status_payment == 1)
                                            Đã thanh toán
                                        @else
                                            Đã hoàn trả thanh toán
                                        @endif

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
                            <div class="row no-print">
                                <div class="col-12">
                                    <a href="{{ route('pdff', $order->id) }}" class="btn btn-primary "
                                        style="margin-right: 5px;">
                                        <i class="fa fa-download"></i> Generate PDF
                                    </a>
                                    <form action="{{ route('don-hang.update', $order->id) }}" method="POST"
                                        class="form-inline float-md-right mr-3" role="form">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="email_send" value="{{ $order->user->email }}">
                                        <div class="form-group">
                                            @if ($order->status == 0)
                                                <select name="status" id="input" class="form-control" required="required">
                                                    <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>
                                                        Chưa xử lý</option>
                                                    <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Đã xác
                                                        nhận
                                                    </option>
                                                    <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Chờ lấy
                                                        hàng</option>
                                                    <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Đang
                                                        giao hàng
                                                    </option>
                                                    <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Đã giao
                                                        hàng</option>
                                                    <option value="5" {{ $order->status == 5 ? 'selected' : '' }}>
                                                        Đã hủy
                                                    </option>
                                                </select>
                                            @elseif ($order->status == 1)
                                                <select name="status" id="input" class="form-control" required="required">
                                                    <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Đã xác
                                                        nhận
                                                    </option>
                                                    <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Chờ lấy
                                                        hàng</option>
                                                    <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Đang
                                                        giao hàng
                                                    </option>
                                                    <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Đã giao
                                                        hàng</option>
                                                    <option value="5" {{ $order->status == 5 ? 'selected' : '' }}>
                                                        Đã hủy
                                                    </option>
                                                </select>
                                            @elseif ($order->status == 2)
                                                <select name="status" id="input" class="form-control" required="required">

                                                    <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Chờ lấy
                                                        hàng</option>
                                                    <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Đang
                                                        giao hàng
                                                    </option>
                                                    <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Đã giao
                                                        hàng</option>
                                                    <option value="5" {{ $order->status == 5 ? 'selected' : '' }}>
                                                        Đã hủy
                                                    </option>
                                                </select>
                                            @elseif ($order->status == 3)
                                                <select name="status" id="input" class="form-control" required="required">
                                                    <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Đang
                                                        giao hàng
                                                    </option>
                                                    <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Đã giao
                                                        hàng</option>
                                                    <option value="5" {{ $order->status == 5 ? 'selected' : '' }}>
                                                        Đã hủy
                                                    </option>
                                                </select>
                                            @elseif ($order->status == 4)
                                                <select name="status" id="input" class="form-control" required="required">
                                                    <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Đã giao
                                                        hàng</option>

                                                </select>
                                            @elseif ($order->status == 5)
                                                <select name="status" id="input" class="form-control" required="required">
                                                    <option value="5" {{ $order->status == 5 ? 'selected' : '' }}>
                                                        Đã hủy
                                                    </option>
                                                </select>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-success my-1 my-sm-0">Submit</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
    <!-- /.content -->

@stop
