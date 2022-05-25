@extends('backend.master')
@section('title','Bộ sưu tập')
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

                                </div>
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-3">

                                </div>
                            </div>
                            <table id="bootstrap-data-table" class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Ảnh </th>
                                        <th>Danh mục bài viết</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo bài viết</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gallery as $value)
                                        <tr id="{{ $value->id }}">
                                            <td><img src="{{ url('uploads/gallery') }}/{{ $value->image }}" alt=""
                                                    srcset="" style="width:120px"></td>
                                            <td>{{ $value->getCategoryGallery->name }}</td>
                                            @if ($value->status == 0)
                                                <td><a href="{{ route('admin.gallery.unactive', $value->id) }}"><span><i
                                                                class="fa fa-thumbs-o-down text-danger"
                                                                aria-hidden="true"></i></span></a></td>
                                            @else
                                                <td><a href="{{ route('admin.gallery.active', $value->id) }}"><span><i
                                                                class="fa fa-thumbs-o-up text-success"
                                                                aria-hidden="true"></i></span></a>
                                                </td>
                                            @endif
                                            <td>{{ $value->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ route('bo-suu-tap.edit', $value->id) }}" class="btn ">
                                                    <span><i class="fa fa-pencil-square-o text-primary"
                                                            aria-hidden="true"></i></span></a>
                                                <a href="{{ route('bo-suu-tap.destroy', $value->id) }}"
                                                    class="deleteRecord" data-id="{{ $value->id }}"
                                                    >
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
                                    <a href="{{ route('bo-suu-tap.create') }}" class="btn btn-outline-success">Thêm mới
                                        </a>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    {!! $gallery->appends(\Request::except('page'))->render() !!}

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
