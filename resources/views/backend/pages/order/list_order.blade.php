@extends('backend.master')
@section('title','Đơn hàng')
@section('main')
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Data Table</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="sort" id="sort" class="form-control"
                                            onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                            <option value="?sort_by=none">Sắp xếp theo</option>

                                            <option value="?sort_by=total_asc">Giá tăng dần</option>
                                            <option value="?sort_by=total_desc">Giá giảm dần</option>
                                            <option value="?status=0">Đơn hàng chưa xử lý</option>
                                            <option value="?status=1">Đơn hàng đã xác nhận</option>
                                            <option value="?status=2">Đơn hàng đang chờ lấy hàng</option>
                                            <option value="?status=3">Đơn hàng đang giao</option>
                                            <option value="?status=4">Đơn hàng đã giao</option>
                                            <option value="?status=5">Đơn hàng đã hủy</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-3">

                                </div>
                            </div>
                            <table id="bootstrap-data-table" class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order as $value)
                                        <tr id="{{ $value->id }}">
                                            <td>{{ $value->user->name }}</td>
                                            <td>{{ $value->address }}</td>
                                            <td>{{ $value->user->phone }}</td>
                                            <td> {{ number_format($value->total, 0, ',', '.') . ' VND' }}</td>
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
                                            <td>
                                                <a href="{{ route('don-hang.show', $value->id) }}" class="btn ">
                                                    <span><i class="fa fa-pencil-square-o text-primary"
                                                            aria-hidden="true"></i></span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="col-sm-12 col-xs-12">
                                {!! $order->appends(\Request::except('page'))->render() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@stop
@section('js')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script>
        $('.deleteRecord').click(function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            var slug = $(this).data("slug");
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
                            "slug": slug,
                            "_token": token,
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            $("#" + id + "").remove();
                        }
                    });
                }
            })
        });
    </script>
@stop
