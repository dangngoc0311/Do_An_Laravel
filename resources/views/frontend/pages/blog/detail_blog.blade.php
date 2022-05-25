@extends('frontend.master')
@section('main')
    <section class="sub-banner">
        <h2 class="sr-only">Banner</h2>
        <img src="{{ url('frontend') }}/images/cart-page-banner.jpg" alt="banner" class="banner">
    </section>
    <!-- /Banner -->
    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb">
                <ul class="list-inline">
                    <li><a href="{{ route('customer.home') }}">Home</a></li>
                    <li><a href="{{ route('customer.home') }}">{{ $blog->getCategoryBlog->name }}</a></li>
                    <li>{{ $blog->title }}</li>
                </ul>
                <h1 class="page-tit">{{ $blog->title }}</h1>
            </div>
        </div>
    </section>

    <!-- Content -->
    <div class="content-part blog-page">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12 col-xs-12  pull-right">
                    <aside id="blog_sidebar">
                        <div class="blog_widget search-widget">
                            <div class="widget-content">
                                <form role="search" method="get" id="searchform" class="searchform">
                                    <div>
                                        <input type="text" placeholder="Search here..." value="" name="keyword">
                                        <input type="submit" id="searchsubmit" value="">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="blog_sidebar_widget popular-blog-widget hidden-sm hidden-xs">
                            <div class="widget-title">
                                <h2 class="blog-header text-left">Bài viết gần đây</h2>
                            </div>
                            @foreach ($new_blog as $new)
                                <div class="box">
                                    <div class="img-part">
                                        <img src="{{ url('uploads/blog') }}/{{ $new->cover_image }}" alt="blog post"
                                            class="img-fluid" />
                                    </div>
                                    <div class="txt-part">
                                        <a class="blog-tit"
                                            href="{{ route('danh-sach-bai-viet.show', $new->slug) }}">{{ Str::limit($new->title, 13) }}</a><br>
                                        <a href="{{ route('danh-sach-bai-viet.show', $new->slug) }}" class="blog-date"><i
                                                class="icon-clock"></i>
                                            {{ $new->created_at->format(' F j, Y ') }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="clearfix"></div>
                        <div class="blog_sidebar_widget popular-blog-widget hidden-sm hidden-xs">
                            <div class="widget-title">
                                <h2 class="blog-header text-left">Danh mục</h2>
                            </div>
                            <div class="post-cetegory">
                                <ul>
                                    @foreach ($category_blog as $cate_blog)
                                        <li>
                                            <div class="post-cetegory-header"><a class=""
                                                    href="{{ route('customer.blog.category', $cate_blog->id) }}">{{ $cate_blog->name }}
                                                    ({{ $cate_blog->getBlogs->count() }})</a></div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>


                    </aside>
                </div>
                <!-- Content left -->
                <div class="col-md-9 col-sm-12 col-xs-12 blog-detail">
                    {{-- <div class="blog-img">
                        <img src="{{ url('uploads') }}/{{ $blog->image }}" alt="{{ $blog->title }}"
                            class="img-responsive" />
                    </div> --}}
                    <div class="blog-txt">
                        {{-- <ul>
                            <li><a href="#"><i class="icon-clock"></i> {{ $blog->created_at->format(' F j, Y ') }}</a>
                            </li>
                            <li><a href="#"></a></li>
                        </ul> --}}
                        <h2 class="text-left">{{ $blog->title }}</h2>
                        <p>{!! $blog->content !!}</p>
                        <section class="bottom-section">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="share-section">
                                        <div class="tag-part">
                                            <ul>
                                                <li><a href="#">{{ $blog->getCategoryBlog->name }}</a></li>
                                            </ul>
                                        </div>
                                        <div class="social-part">
                                            <label>Share Link:</label>
                                            <ul class="social">
                                                <li><a href="#"><i class="icon-facebook"></i></a></li>
                                                <li><a href="#"><i class="icon-twitter"></i></a></li>
                                                <li><a href="#"><i class="icon-google-plus"></i></a></li>
                                                <li><a href="#"><i class="icon-pinterest"></i></a></li>
                                                <li><a href="#"><i class="icon-youtube"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="comment-section">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="tit">

                                    </div>
                                    @foreach ($comment as $key => $cmt)

                                        <div class="comment-box" style="box-shadow: rgb(99 99 93 / 6%) 0px 1px 4px 0px;">
                                            <div class="icon-part ">
                                                @if ($cmt->getUser->image)
                                                    <img src="{{ url('uploads/user') }}/{{ $cmt->getUser->image }}"
                                                        alt="user" class="img-responsive img-border" style="width:67px" />
                                                @else
                                                    <img src="{{ url('frontend') }}/images/user-icon.png" alt="user"
                                                        class="img-responsive" style="width:67px" />
                                                @endif
                                            </div>
                                            <div class="comment-part">
                                                <div class="top-part">
                                                    <div class="l-part">
                                                        <div class="date">{{ $cmt->created_at->format(' F j, Y ') }}
                                                        </div>
                                                        <div class="user-name">{{ $cmt->getUser->name }}</div>
                                                    </div>

                                                    <p>{{ $cmt->comment }}.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment-box">

                                            @foreach ($cmt->getComments()->get() as $replies)

                                                <ul class="children col-md-12 d-flex"
                                                    style="
                                                                    padding-top: 20px; box-shadow: rgb(50 50 93 / 5%) 0px 6px 12px -2px, rgb(0 0 0 / 3%) 0px 3px 7px -3px;">

                                                    <div class="icon-part col-md-2">
                                                        @if ($replies->user->image)
                                                            <img src="{{ url('uploads/user') }}/{{ $replies->user->image }}"
                                                                alt="user" class="img-responsive img-border"
                                                                style="width:67px" />
                                                        @else
                                                            <img src="{{ url('frontend') }}/images/user-icon.png"
                                                                alt="user" class="img-responsive" style="width:67px" />
                                                        @endif
                                                    </div>
                                                    <div class="comment-part col-md-10">
                                                        <div class="top-part">
                                                            <div class="l-part">
                                                                <div class="date">
                                                                    {{ $replies->created_at->format(' F j, Y ') }}
                                                                </div>
                                                                <div class="user-name">{{ $replies->user->name }}</div>
                                                            </div>

                                                            <p>{{ $replies->comment }}.</p>
                                                        </div>
                                                    </div>

                                                </ul>
                                            @endforeach

                                        </div>
                                    @endforeach
                                    <div class="pagination-wrapper">
                                        @if ($comment->lastPage() > 1)
                                            <div class="pagination p5">
                                                <ul>
                                                    @for ($i = 1; $i <= $comment->lastPage(); $i++)
                                                        <a class="{{ $i == $comment->currentPage() ? 'is-active' : '' }}"
                                                            href="?page={{ $i }}">
                                                            <li></li>
                                                        </a>
                                                    @endfor
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="form-section">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="tit">
                                        <h3>Bình luận</h3>
                                    </div>
                                    @if (Auth::guard('customer')->user())
                                        <form action="" method="POST">
                                            @csrf
                                            <input type="hidden" name="blog_id" value="{{ $blog->id }}" />
                                            <input type="hidden" class="form-control" id="email"
                                                value="{{ Auth::guard('customer')->user()->id }}" name="user_id">
                                            <div class="form-group col-sm-12 col-xs-12">
                                                <textarea class="form-control" placeholder="Viết bình luận"
                                                    name="comment"></textarea>
                                                <button class="submit_comment submit_cmt submit" type="submit">Bình
                                                    Luận</button>
                                            </div>
                                        </form>
                                    @else
                                        <h5>Vui lòng đăng nhập để bình luận <a class="btn replay-btn btn-outline-success"
                                                href="{{ route('customer.login') }}?page=detail_blog&blog_id={{ $blog->id }}">Đăng
                                                Nhập</a>
                                        </h5>
                                    @endif
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <!-- /Content left -->
            </div>
        </div>
    </div>
    <!-- /Content -->
@stop
@section('css')
    <style>
        .pagination {
            padding: 30px 0;
        }

        .pagination ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        .pagination a {
            display: inline-block;
            padding: 10px 18px;
            color: #222;
        }

        .p5 a {
            width: 30px;
            height: 5px;
            padding: 0;
            margin: auto 5px;
            background-color: rgba(46, 204, 113, 0.4);
        }

        .p5 .is-active {
            background-color: #2ecc71;
        }

        .circular--portrait {
            position: relative;
            width: 200px;
            height: 200px;
            overflow: hidden;
            border-radius: 50%;
        }

        .circular--portrait img {
            width: 100%;
            height: auto;
        }

    </style>

@stop
@section('js')
    <script>
        $(document).ready(function() {
            $('.submit_comment').click(function(e) {
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var url = "{{ route('blog.comment.store') }}";
                var user_id = $("input[name='user_id']").val();
                var blog_id = $("input[name='blog_id']").val();
                var comment = $("textarea[name='comment']").val();
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: _token,
                        blog_id: blog_id,
                        comment: comment,
                        user_id: user_id
                    },

                    success: function(data) {
                        window.location.reload();
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: false,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'success',
                            title: 'Thêm bình luận thành công'
                        })
                    },
                    error: function(data) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: false,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'error',
                            title: 'Không thể thêm bình luận'
                        })
                    }
                })
            })
        });
    </script>
@stop
