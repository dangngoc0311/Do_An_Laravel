@extends('backend.master')
@section('title','Review sản phẩm')
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


                                                <option value="?star=1">Đánh giá 1 sao</option>
                                                <option value="?star=2">Đánh giá 2 sao</option>
                                                <option value="?star=3">Đánh giá 3 sao</option>
                                                <option value="?star=4">Đánh giá 4 sao</option>
                                                <option value="?star=5">Đánh giá 5 sao</option>

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
                                        <th>Tên người dùng</th>
                                        <th>Rating</th>
                                        <th>Nội dung</th>
                                        <th>Ảnh (Nếu có)</th>
                                        <th>Sản phẩm</th>
                                        <th>Trạng thái </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($review as $value)
                                        <tr>
                                            <td>{{ $value->user_name }}</td>
                                            <td>
                                                <span
                                                    class="fa fa-star {{ $value->rating >= 1 ? 'star-active' : 'star-inactive' }}  ml-3"></span>
                                                <span
                                                    class="fa fa-star {{ $value->rating >= 2 ? 'star-active' : 'star-inactive' }}"></span>
                                                <span
                                                    class="fa fa-star {{ $value->rating >= 3 ? 'star-active' : 'star-inactive' }}"></span>
                                                <span
                                                    class="fa fa-star {{ $value->rating >= 4 ? 'star-active' : 'star-inactive' }}"></span>
                                                <span
                                                    class="fa fa-star {{ $value->rating >= 5 ? 'star-active' : 'star-inactive' }} "></span>
                                            </td>
                                            <td>{{ $value->message }}</td>
                                            <td>
                                                @foreach ($reviews->getImageByReview($value->id)->getImageReview as $values)
                                                    <img src="{{ url('uploads') }}/{{ $values->image }}" alt=""
                                                        class="pic" style="width:30px">
                                                @endforeach
                                            </td>

                                            <td>{{ $value->product_name }}</td>

                                            @if ($value->status == 0)
                                                <td><a href="{{ route('admin.review.unactive', $value->id) }}"><span><i
                                                                class="fa fa-thumbs-o-down text-danger"
                                                                aria-hidden="true"></i></span></a></td>
                                            @else
                                                <td><a href="{{ route('admin.review.active', $value->id) }}"><span><i
                                                                class="fa fa-thumbs-o-up text-success"
                                                                aria-hidden="true"></i></span></a>
                                                </td>
                                            @endif


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="col-sm-12 col-xs-12">
                                {!! $review->appends(\Request::except('page'))->render() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@stop
@section('css')
    <style>
        .star-active {
            color: #f5aa11;
        }

    </style>
@stop
