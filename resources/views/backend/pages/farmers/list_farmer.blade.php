@extends('backend.master')
@section('title','Nhân viên')
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
                                                <option value="?sort_by=none">Sắp xếp theo</option>
                                                <option value="?sort_by=name_asc">Tên (A - Z)</option>
                                                <option value="?sort_by=name_desc">Tên (Z - A)</option>
                                                <option value="?status=0">Nhân viên đang ẩn</option>
                                                <option value="?status=1">Nhân viên đang hiện</option>
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
                                        <th>Tên nhân viên</th>
                                        <th>Ảnh</th>
                                        <th>Công việc</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th>Địa chỉ</th>
                                        <th>Trạng thái</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($farmers as $value)
                                        <tr id="{{ $value->id }}">
                                            <td> {{ $value->name }}</td>
                                            <td><img src="{{ url('uploads/farmer') }}/{{ $value->image }}" alt="" srcset=""
                                                    style="width:120px"></td>
                                            <td>{{ $value->job }}</td>
                                            <td>{{ $value->phone }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->address }}</td>
                                            @if ($value->status == 0)
                                                <td><a href="{{ route('admin.farmer.unactive', $value->id) }}"><span><i
                                                                class="fa fa-thumbs-o-down text-danger"
                                                                aria-hidden="true"></i></span></a></td>
                                            @else
                                                <td><a href="{{ route('admin.farmer.active', $value->id) }}"><span><i
                                                                class="fa fa-thumbs-o-up text-success"
                                                                aria-hidden="true"></i></span></a>
                                                </td>
                                            @endif
                                            <td>
                                                <a href="{{ route('nhan-vien.edit', $value->id) }}" class="btn ">
                                                    <span><i class="fa fa-pencil-square-o text-primary"
                                                            aria-hidden="true"></i></span></a>
                                                <a href="{{ route('nhan-vien.destroy', $value->id) }}"
                                                    class="deleteRecord" data-id="{{ $value->id }}">
                                                    <span>
                                                        <i class="fa fa-trash-o text-danger" aria-hidden="true"></i>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="col-sm-12 col-xs-12 d-flex">
                                <div class="col-sm-6 col-xs-12">
                                    <a href="{{ route('nhan-vien.create') }}" class="btn btn-outline-success">Thêm mới
                                        </a>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    {!! $farmers->appends(\Request::except('page'))->render() !!}

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
                        }
                    });
                }
            })
        });
    </script>
@stop
