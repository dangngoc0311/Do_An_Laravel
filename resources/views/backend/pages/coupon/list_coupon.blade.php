@extends('backend.master')
@section('title','Mã giảm giá')
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
                                        <form action="">
                                            @csrf
                                            <select name="sort" id="sort" class="form-control"
                                                onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                                <option value="?filter=none">Sắp xếp theo</option>
                                                <option value="?filter=created_at&by=asc">Ngày cũ nhất</option>
                                                <option value="?filter=created_at&by=desc">Ngày mới nhất</option>
                                                <option value="?sort=condition_0">Giảm theo %</option>
                                                <option value="?sort=condition_1">Giảm theo VND</option>
                                                <option value="?status=0">Mã giảm giá đang ẩn</option>
                                                <option value="?status=1">Mã giảm giá đang hiện</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-3">
                                    <form action="" method="GET">
                                        <div class=" form-group">
                                            <div class="input-group">
                                                <div class="input-group-btn">
                                                </div>
                                                <input type="search" id="input1-group2 search" placeholder="Username"
                                                    class="form-control search" name="keyword"><button
                                                    class="btn btn-outline-success">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <table id="bootstrap-data-table" class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Tên mã giảm giá</th>
                                        <th>Mã giảm giá</th>
                                        <th>Điều kiện giản giá</th>
                                        <th>Số tiền giảm</th>
                                        <th>Số lượng </th>
                                        <th>Trạng thái</th>
                                        <th>Ngày bắt đầu</th>
                                        <th>Ngày kết thúc</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupon as $value)
                                        <tr id="{{ $value->id }}">
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->code }}</td>
                                            @if ($value->condition == 0)
                                                <td>Giảm theo phần trăm (%)</td>
                                                <td>Giảm {{ $value->discount }} %</td>
                                            @else
                                                <td>Giảm theo tiền (VND/$)</td>
                                                <td>Giảm
                                                    {{ number_format($value->discount, 0, ',', '.') . ' VND' }}
                                                </td>
                                            @endif
                                            <td>{{ $value->quantity }}</td>
                                            {{-- @if ($value->status == 0)
                                                <td>
                                                    <a href="{{ route('admin.coupon.unactive', $value->slug) }}"><span><i
                                                                class="fa fa-thumbs-o-down text-danger"
                                                                aria-hidden="true"></i></span></a>
                                                </td>
                                            @else
                                                <td>
                                                    <a href="{{ route('admin.coupon.active', $value->slug) }}"><span><i
                                                                class="fa fa-thumbs-o-up text-success"
                                                                aria-hidden="true"></i></span></a>
                                                </td>
                                            @endif --}}
                                            <td>
                                                @if ($value->start >= 0)
                                                    @if ($value->end < 0)
                                                        <span class="badge badge-danger">Hết hạn</span>
                                                    @else
                                                        <span class="badge badge-success">Còn hạn</span>
                                                    @endif

                                                @else
                                                    <span class="badge badge-warning">Chưa đến hạn</span>
                                                @endif
                                            </td>
                                            <td>{{ $value->start_date }}</td>
                                            <td>{{ $value->end_date }}</td>
                                            @php

                                            @endphp
                                            <td>
                                                <a href="{{ route('ma-giam-gia.edit', $value->slug) }}" class="btn ">
                                                    <span><i class="fa fa-pencil-square-o text-primary"
                                                            aria-hidden="true"></i></span></a>
                                                <a class="deleteRecord"
                                                    href="{{ route('ma-giam-gia.destroy', $value->slug) }}"
                                                    data-id="{{ $value->id }}" data-slug="{{ $value->slug }}">
                                                    <span>
                                                        <i class="fa fa-trash-o text-danger" aria-hidden="true"></i>
                                                    </span>
                                                </a>
                                                @if ($value->start >= 0)
                                                    @if ($value->end >= 0)
                                                        <a href="{{ route('admin.coupon.sendmail', $value->id) }}"
                                                            class="btn btn-outline-success">
                                                            <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                                                        </a>
                                                    @endif
                                                @endif



                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="col-sm-12 col-xs-12 d-flex">
                                <div class="col-sm-6 col-xs-12">
                                    <a href="{{ route('ma-giam-gia.create') }}" class="btn btn-outline-success">Thêm mới
                                        </a>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    {!! $coupon->appends(\Request::except('page'))->render() !!}

                                </div>

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
