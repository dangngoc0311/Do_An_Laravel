@extends('backend.master')
@section('title','Blog')
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
                                                <option value="?sort_by=title_asc">Tên (A - Z)</option>
                                                <option value="?sort_by=title_desc">Tên (Z - A)</option>
                                                @foreach ($categoryBlog as $cate)
                                                    <option value="?filter=category_blogs_id&id={{ $cate->id }}">Danh
                                                        mục {{ $cate->name }}</option>

                                                @endforeach
                                                {{-- <option value="{{ Request::url() }}?sort_by=price_desc">Price (High &gt; Low)</option> --}}
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
                                        <th>Tiêu đề bài viết</th>
                                        <th>Ảnh bìa</th>
                                        <th>Danh mục bài viết</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo bài viết</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blog as $value)
                                        <tr id="{{ $value->id }}">
                                            <td> {!! Str::words($value->title, 4, ' ...') !!}</td>
                                            <td><img src="{{ url('uploads/blog') }}/{{ $value->cover_image }}" alt=""
                                                    srcset="" style="width:120px"></td>
                                            <td>{{ $value->getCategoryBlog->name }}</td>
                                            @if ($value->status == 0)
                                                <td><a href="{{ route('admin.blog.unactive', $value->slug) }}"><span><i
                                                                class="fa fa-thumbs-o-down text-danger"
                                                                aria-hidden="true"></i></span></a></td>
                                            @else
                                                <td><a href="{{ route('admin.blog.active', $value->slug) }}"><span><i
                                                                class="fa fa-thumbs-o-up text-success"
                                                                aria-hidden="true"></i></span></a>
                                                </td>
                                            @endif
                                            <td>{{ $value->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ route('bai-viet.edit', $value->slug) }}" class="btn ">
                                                    <span><i class="fa fa-pencil-square-o text-primary"
                                                            aria-hidden="true"></i></span></a>
                                                <a href="{{ route('bai-viet.show', $value->slug) }}" class="btn ">
                                                    <span><i class="fa fa-pencil-square-o text-primary"
                                                            aria-hidden="true"></i></span></a>
                                                <a href="{{ route('bai-viet.destroy', $value->slug) }}"
                                                    class="deleteRecord" data-id="{{ $value->id }}"
                                                    data-slug="{{ $value->slug }}">
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
                                    <a href="{{ route('bai-viet.create') }}" class="btn btn-outline-success">Thêm mới
                                        </a>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    {!! $blog->appends(\Request::except('page'))->render() !!}

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
