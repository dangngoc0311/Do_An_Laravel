@extends('backend.master')
@section('title', 'Sản phẩm')
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
                                                <option value="?sort_by=price_asc">Giá tăng dần</option>
                                                <option value="?sort_by=price_desc">Giá giảm dần</option>
                                                <option value="?filter=isHot_1">Sản phẩm nổi bật</option>
                                                <option value="?filter=status_1">Sản phẩm đang hiện</option>
                                                <option value="?filter=status_0">Sản phẩm đã ẩn</option>

                                                {{-- <option value="{{ Request::url() }}?sort_by=price_desc">Price (High &gt; Low)</option> --}}
                                            </select>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-6">
                                    <form action="" method="GET">
                                        <div class="row">
                                            <div class="form-group col-md-3 p-0">
                                                <select name="nhan_hang" id="product1" class="float-right form-control">
                                                    <option value="">Chọn nhãn hàng</option>
                                                    @foreach ($brand as $brands)
                                                        @isset($_GET['nhan_hang'])

                                                            <option value="{{ $brands->id }}"
                                                                {{ $brands->id == $_GET['nhan_hang'] ? 'selected' : '' }}>
                                                                {{ $brands->name }}

                                                            </option>

                                                        @endisset

                                                        <option value="{{ $brands->id }}">
                                                            {{ $brands->name }} </option>

                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3 p-0">
                                                <select name="danh_muc" id="product" class="float-right form-control">
                                                    <option value="">Chọn danh mục</option>
                                                    @foreach ($category as $cate)
                                                        @isset($_GET['danh_muc'])

                                                            <option value="{{ $cate->id }}"
                                                                {{ $cate->id == $_GET['danh_muc'] ? 'selected' : '' }}>
                                                                {{ $cate->name }}</option>
                                                        @endisset
                                                        <option value="{{ $cate->id }}">
                                                            {{ $cate->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class=" form-group col-md-6 pl-0">
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
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <table id="bootstrap-data-table" class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Tên </th>
                                        <th>Ảnh sản phẩm</th>
                                        <th>Giá/Sale(VND)</th>
                                        <th>Danh mục </th>
                                        <th>Nhà cung cấp</th>
                                        <th>Số lượng(kg) </th>
                                        <th>Đã bán(kg)</th>
                                        <th>Trạng thái</th>
                                        <th>Nổi bật</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $pro)
                                        <tr id="{{ $pro->id }}">
                                            <td>{{ $pro->name }}</td>
                                            <td style="width: 14%;"><img src="{{ url('uploads/product') }}/{{ $pro->image }}"
                                                    alt="" srcset="" class="w-75"></td>
                                            @if ($pro->sale_price > 0)
                                                <td><del>{{ number_format($pro->price, 0, ',', '.') }}</del> /
                                                    {{ number_format($pro->sale_price, 0, ',', '.') }}</td>
                                            @else
                                                <td>{{ number_format($pro->price, 0, ',', '.') }}</td>
                                            @endif

                                            <td>{{ $pro->getCategory->name }}</td>
                                            <td>{{ $pro->getBrand->name }}</td>
                                            <td>{{ $pro->import_quantity }}</td>
                                            @if (isset($pro->getInventoryById($pro->id)->qty))
                                                <td>{{ $pro->getInventoryById($pro->id)->qty }}
                                                </td>
                                            @else
                                                <td>0
                                                </td>
                                            @endif

                                            @if ($pro->status == 0)
                                                <td><a href="{{ route('admin.product.unactive', $pro->slug) }}"><span><i
                                                                class="fa fa-thumbs-o-down text-danger"
                                                                aria-hidden="true"></i></span></a></td>
                                            @else
                                                <td><a href="{{ route('admin.product.active', $pro->slug) }}"><span><i
                                                                class="fa fa-thumbs-o-up text-success"
                                                                aria-hidden="true"></i></span></a>
                                                </td>
                                            @endif
                                            @if ($pro->isHot == 0)
                                                <td><a href="{{ route('admin.product.unhot', $pro->slug) }}"><span><i
                                                                class="fa fa-heart-o" aria-hidden="true"></i></span></a>
                                                </td>
                                            @else
                                                <td><a href="{{ route('admin.product.hot', $pro->slug) }}"><span><i
                                                                class="fa fa-heart text-danger"
                                                                aria-hidden="true"></i></span></a>
                                                </td>
                                            @endif
                                            <td>
                                                <a href="{{ route('san-pham.edit', $pro->slug) }}" class="btn ">
                                                    <span><i class="fa fa-pencil-square-o text-primary"
                                                            aria-hidden="true"></i></span></a>
                                                <a class="deleteRecord"
                                                    href="{{ route('san-pham.destroy', $pro->slug) }}"
                                                    data-id="{{ $pro->id }}" data-slug="{{ $pro->slug }}">
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
                                    <a href="{{ route('san-pham.create') }}" class="btn btn-outline-success">Thêm mới
                                        </a>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    {!! $product->appends(\Request::except('page'))->render() !!}

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
        $(document).ready(function() {
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
        })
    </script>
@stop
