@extends('backend.master')
@section('main')
    <div class="content">
        <!-- Animated -->
        <div class="animated fadeIn">
            <!-- Widgets  -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-1">
                                    <i class="pe-7s-cash"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        @if (isset($sale_month))
                                            <div class="stat-text"><span
                                                    class="count">{{ number_format($sale_month->money, 0, ',', '.') . ' VND' }}</span>
                                            </div>
                                        @else
                                            <div class="stat-text"><span class="count">0 VND</span>
                                            </div>
                                        @endif

                                        <div class="stat-heading">Doanh thu tháng</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-2">
                                    <i class="pe-7s-cart"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{ $order->total_order }}</span></div>
                                        <div class="stat-heading">Số đơn hàng</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-3">
                                    <i class="pe-7s-browser"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span
                                                class="count">{{ number_format($total_year, 0, ',', '.') . ' VND' }}</span>
                                        </div>
                                        <div class="stat-heading">Doanh thu năm</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-4">
                                    <i class="pe-7s-users"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{ $user }}</span></div>
                                        <div class="stat-heading">Khách hàng</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Widgets -->
            <!--  Traffic  -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="box-title">Doanh thu </h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card-body">
                                    <!-- <canvas id="TrafficChart"></canvas>   -->
                                    <div class="chart-container" style="position: relative; height:55vh; width:51vw">
                                        <canvas id="salesChart"></canvas>
                                    </div>

                                    {{-- <div id="traffic-chart" class="traffic-chart"></div> --}}
                                </div>
                            </div>
                            @if ($order->total_order > 0)
                                <div class="col-lg-4">
                                    <div class="card-body">
                                        <div class="progress-box progress-1">
                                            <h4 class="por-title">Đơn hàng chưa xử lý</h4>
                                            <div class="por-txt">
                                                {{ $orders->getTotalOrderByStatus(0) ? $orders->getTotalOrderByStatus(0) : 0 }}
                                                Đơn hàng
                                                ({{ ceil(($orders->getTotalOrderByStatus(0) * 100) / $order->total_order) }}%)
                                            </div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-flat-color-1" role="progressbar"
                                                    style="width: {{ ceil(($orders->getTotalOrderByStatus(0) * 100) / $order->total_order) }}%;"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="progress-box progress-2">
                                            <h4 class="por-title">Đơn hàng đã xác nhận</h4>
                                            <div class="por-txt">
                                                {{ $orders->getTotalOrderByStatus(1) ? $orders->getTotalOrderByStatus(1) : 0 }}

                                                Đơn hàng
                                                ({{ ceil(($orders->getTotalOrderByStatus(1) * 100) / $order->total_order) }}%)
                                            </div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-flat-color-2" role="progressbar"
                                                    style="width: {{ ceil(($orders->getTotalOrderByStatus(1) * 100) / $order->total_order) }}%;"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="progress-box progress-2">
                                            <h4 class="por-title">Đơn hàng đang chờ lấy hàng</h4>
                                            <div class="por-txt">
                                                {{ $orders->getTotalOrderByStatus(2) ? $orders->getTotalOrderByStatus(2) : 0 }}

                                                Đơn hàng
                                                ({{ ceil(($orders->getTotalOrderByStatus(2) * 100) / $order->total_order) }}%)
                                            </div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-flat-color-8" role="progressbar"
                                                    style="width: {{ ceil(($orders->getTotalOrderByStatus(2) * 100) / $order->total_order) }}%;"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="progress-box progress-2">
                                            <h4 class="por-title">Đơn hàng đang giao</h4>
                                            <div class="por-txt">
                                                {{ $orders->getTotalOrderByStatus(3) ? $orders->getTotalOrderByStatus(3) : 0 }}
                                                Đơn hàng
                                                ({{ ceil(($orders->getTotalOrderByStatus(3) * 100) / $order->total_order) }}%)
                                            </div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-flat-color-3" role="progressbar"
                                                    style="width: {{ ceil(($orders->getTotalOrderByStatus(3) * 100) / $order->total_order) }}%;"
                                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="progress-box progress-2">
                                            <h4 class="por-title">Đơn hàng đã giao</h4>
                                            <div class="por-txt">
                                                {{ $orders->getTotalOrderByStatus(4) ? $orders->getTotalOrderByStatus(4) : 0 }}
                                                Đơn hàng
                                                ({{ ceil(($orders->getTotalOrderByStatus(4) * 100) / $order->total_order) }}%)
                                            </div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-flat-color-4" role="progressbar"
                                                    style="width: {{ ceil(($orders->getTotalOrderByStatus(4) * 100) / $order->total_order) }}%;"
                                                    aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="progress-box progress-2">
                                            <h4 class="por-title">Đơn hàng đã hủy</h4>
                                            <div class="por-txt">
                                                {{ $orders->getTotalOrderByStatus(5) ? $orders->getTotalOrderByStatus(5) : 0 }}
                                                Đơn hàng
                                                ({{ ceil(($orders->getTotalOrderByStatus(5) * 100) / $order->total_order) }}%)
                                            </div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-flat-color-7" role="progressbar"
                                                    style="width: {{ ceil(($orders->getTotalOrderByStatus(5) * 100) / $order->total_order) }}%;"
                                                    aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div> <!-- /.card-body -->
                                </div>
                            @else
                                <div class="col-lg-4">
                                    <div class="card-body">
                                        <div class="progress-box progress-1">
                                            <h4 class="por-title">Đơn hàng chưa xử lý</h4>
                                            <div class="por-txt">
                                                0 Đơn hàng
                                                (0%)
                                            </div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-flat-color-1" role="progressbar"
                                                    style="width: 0%;" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="progress-box progress-2">
                                            <h4 class="por-title">Đơn hàng đã xác nhận</h4>
                                            <div class="por-txt">
                                                0
                                                Đơn hàng
                                                (0%)
                                            </div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-flat-color-2" role="progressbar"
                                                    style="width: 0%;" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="progress-box progress-2">
                                            <h4 class="por-title">Đơn hàng đang giao</h4>
                                            <div class="por-txt">
                                                0 Đơn hàng
                                                (0%)
                                            </div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-flat-color-3" role="progressbar"
                                                    style="width: 0%;" aria-valuenow="60" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="progress-box progress-2">
                                            <h4 class="por-title">Đơn hàng đã giao</h4>
                                            <div class="por-txt">
                                                0 Đơn hàng
                                                (0%)
                                            </div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-flat-color-4" role="progressbar"
                                                    style="width: 0%;" aria-valuenow="90" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="progress-box progress-2">
                                            <h4 class="por-title">Đơn hàng đã hủy</h4>
                                            <div class="por-txt">
                                                Đơn hàng
                                                (0%)
                                            </div>
                                            <div class="progress mb-2" style="height: 5px;">
                                                <div class="progress-bar bg-flat-color-7" role="progressbar"
                                                    style="width: 0%;" aria-valuenow="90" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div> <!-- /.card-body -->
                                </div>
                            @endif

                        </div> <!-- /.row -->
                        <div class="card-body"></div>
                    </div>
                </div><!-- /# column -->
            </div>
            <!--  /Traffic -->
            <div class="clearfix"></div>
            <!-- Orders -->
            <div class="orders">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title">Orders </h4>
                            </div>
                            <div class="card-body--">
                                <div class="table-stats order-table ov-h">
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th class="serial">#</th>
                                                <th>Tên</th>
                                                <th>Địa chỉ</th>
                                                <th>Phương thức thanh toán</th>
                                                <th>Tiền thanh toán</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($list_order as $key => $value)
                                                <tr>
                                                    <td class="serial">{{ $key+1 }}. </td>

                                                    <td> <span class="name">{{ $value->user->name }}</span> </td>
                                                    <td> <span class="product">{{ $value->address }}</span> </td>
                                                    <td> <span class="product">{{ $value->payment->name }}</span> </td>

                                                    <td>

                                                        <span class="count">
                                                            {{ number_format($value->total, 0, ',', '.') . ' VND' }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($value->status == 0)
                                                            <span class="badge badge-danger">Chưa xử lý</span>
                                                        @elseif ($value->status ==1)
                                                            <span class="badge badge-primary">Đã xác nhận</span>
                                                        @elseif ($value->status ==2)
                                                            <span class="badge badge-warning">Chờ lấy hàng</span>
                                                        @elseif ($value->status ==3)
                                                            <span class="badge badge-info">Đang giao hàng</span>
                                                        @elseif ($value->status ==4)
                                                            <span class="badge badge-success">Đã giao hàng</span>
                                                        @else
                                                            <span class="badge badge-dark">Đã huỷ</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> <!-- /.table-stats -->
                            </div>
                        </div> <!-- /.card -->
                    </div> <!-- /.col-lg-8 -->

                    <div class="col-xl-4">
                        <div class="row">
                            <div class="col-lg-6 col-xl-12">
                                <div class="card br-0">
                                    <div class="card-body">
                                        <div class=" ov-h">
                                            <div class="float-chart">
                                                <canvas id="flotPie1" width="400" height="400"></canvas>
                                            </div>

                                        </div>
                                    </div>
                                </div><!-- /.card -->
                            </div>

                        </div>
                    </div> <!-- /.col-md-4 -->
                </div>
            </div>
            <!-- /.orders -->
            <!-- To Do and Live Chat -->

            <!-- /To Do and Live Chat -->
            <!-- Calender Chart Weather  -->
            <div class="row">
                <div class="col-md-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <!-- <h4 class="box-title">Chandler</h4> -->
                            <div class="calender-cont widget-calender">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div><!-- /.card -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card ov-h">
                        <div class="card-body bg-flat-color-2">
                            <div id="flotBarChart" class="float-chart ml-4 mr-4"></div>
                        </div>
                        <div id="cellPaiChart" class="float-chart"></div>
                    </div><!-- /.card -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card weather-box">
                        <h4 class="weather-title box-title">Weather</h4>
                        <div class="card-body">
                           <!-- weather widget start --><a target="_blank" href="https://hotelmix.vn/weather/hanoi-19487,18408,33809"><img src="https://w.bookcdn.com/weather/picture/2_19487,18408,33809_1_33_cd7bdd_348_ffffff_333333_08488D_1_ffffff_333333_0_6.png?scode=124&domid=1180&anc_id=62574"  alt="booked.net"/></a><!-- weather widget end -->
                        </div>
                    </div><!-- /.card -->
                </div>
            </div>
            <!-- /Calender Chart Weather -->
            <!-- Modal - Calendar - Add New Event -->
            <div class="modal fade none-border" id="event-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><strong>Add New Event</strong></h4>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success save-event waves-effect waves-light">Create
                                event</button>
                            <button type="button" class="btn btn-danger delete-event waves-effect waves-light"
                                data-dismiss="modal">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#event-modal -->
            <!-- Modal - Calendar - Add Category -->
            <div class="modal fade none-border" id="add-category">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><strong>Add a category </strong></h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">Category Name</label>
                                        <input class="form-control form-white" placeholder="Enter name" type="text"
                                            name="category-name" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Choose Category Color</label>
                                        <select class="form-control form-white" data-placeholder="Choose a color..."
                                            name="category-color">
                                            <option value="success">Success</option>
                                            <option value="danger">Danger</option>
                                            <option value="info">Info</option>
                                            <option value="pink">Pink</option>
                                            <option value="primary">Primary</option>
                                            <option value="warning">Warning</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger waves-effect waves-light save-category"
                                data-dismiss="modal">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#add-category -->
        </div>
        <!-- .animated -->
    </div>
    @php
    $list_cate = [];
    $list_cate_value = [];
    foreach ($sale as $value) {
        array_push($list_cate, "'Tháng " . $value['month'] . "'");
        array_push($list_cate_value, $value['money']);
    }
    $list_cate = implode(',', $list_cate);
    $list_cate_value = implode(',', $list_cate_value);
    $list_hot = [];
    $list_hot_value = [];
    foreach ($hot_product as $key => $values) {
        array_push($list_hot, "'" . $values->productInOrderDetail->name . "'");
        array_push($list_hot_value, $values->qty);
    }
    $list_hot = implode(',', $list_hot);
    $list_hot_value = implode(',', $list_hot_value);
    @endphp

@stop
@section('css') <style>
        #weatherWidget .currentDesc {
            color: #ffffff !important;
        }

        .traffic-chart {
            min-height: 335px;
        }

        #flotPie1 {
            height: 150px;
        }

        #flotPie1 td {
            padding: 3px;
        }

        #flotPie1 table {
            top: 20px !important;
            right: -10px !important;
        }

        .chart-container {
            display: table;
            min-width: 270px;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        #flotLine5 {
            height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }

        #cellPaiChart {
            height: 160px;
        }

    </style>
@stop
@section('js')
    <script src="{{ url('backend') }}/js/chart.js"></script>

    <script>
        jQuery(document).ready(function($) {
            "use strict";

            var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
            var salesChartData = {
                labels: [@php echo $list_cate; @endphp],
                datasets: [{
                    label: "Doanh thu (VND)",
                    data: [@php echo $list_cate_value; @endphp],
                    barPercentage: 0.7,
                    categoryPercentage: 0.8,
                    barThickness: 46,
                    maxBarThickness: 40,
                    minBarLength: 2,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }],
            };
            var salesChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false,
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                        },
                    }, ],
                    yAxes: [{
                        gridLines: {
                            display: true,
                        },
                    }, ],
                },

            };

            var salesChart = new Chart(salesChartCanvas, {
                type: "bar",
                data: salesChartData,
                options: salesChartOptions,
            });

            var ctx = document.getElementById("flotPie1");
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: [@php echo $list_hot @endphp],
                    datasets: [{
                        data: [
                            @php echo $list_hot_value; @endphp
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 11, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 11, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    cutoutPercentage: 40,
                    responsive: true,
                    title: {
                        display: true,
                        position: "top",
                        text: "Doughnut Chart",
                        fontSize: 18,
                        fontColor: "#111"
                    },
                    legend: {
                        display: true,
                        position: "bottom",
                        labels: {
                            fontColor: "#333",
                            fontSize: 16
                        }
                    },


                }
            });


            var cellPaiChart = [{
                    label: "Direct Sell",
                    data: [
                        [1, 65]
                    ],
                    color: '#5b83de'
                },
                {
                    label: "Channel Sell",
                    data: [
                        [1, 35]
                    ],
                    color: '#00bfa5'
                }
            ];
            $.plot("#flotBarChart", [{
                data: [
                    [0, 18],
                    [2, 8],
                    [4, 5],
                    [6, 13],
                    [8, 5],
                    [10, 7],
                    [12, 4],
                    [14, 6],
                    [16, 15],
                    [18, 9],
                    [20, 17],
                    [22, 7],
                    [24, 4],
                    [26, 9],
                    [28, 11]
                ],
                bars: {
                    show: true,
                    lineWidth: 0,
                    fillColor: '#ffffff8a'
                }
            }], {
                grid: {
                    show: false
                }
            });

            var cellPaiChart = [{
                    label: "Direct Sell",
                    data: [
                        [1, 65]
                    ],
                    color: '#5b83de'
                },
                {
                    label: "Channel Sell",
                    data: [
                        [1, 35]
                    ],
                    color: '#00bfa5'
                }
            ];
            $.plot('#cellPaiChart', cellPaiChart, {
                series: {
                    pie: {
                        show: true,
                        stroke: {
                            width: 0
                        }
                    }
                },
                legend: {
                    show: false
                },
                grid: {
                    hoverable: true,
                    clickable: true
                }

            });
            // Bar Chart #flotBarChart End
        });
    </script>


@stop
