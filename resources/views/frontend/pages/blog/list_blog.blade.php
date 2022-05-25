@extends('frontend.master')
@section('title', 'Danh sách bài viết')
@section('main')
    <section class="sub-banner">
        <h2 class="sr-only">Banner</h2>
        <img class="banner" src="{{ url('frontend') }}/images/cart-page-banner.jpg" alt="Banner">
    </section>
    <!-- /Banner -->
    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb">
                <ul class="list-inline">
                    <li><a href="{{ route('customer.home') }}">Trang chủ</a></li>
                    <li>@yield('title')</li>
                </ul>
                <h1 class="page-tit">@yield('title')</h1>
            </div>
        </div>
    </section>
    <!-- /Breadcrumb -->
    <!-- Content -->
    <div class="content-part blog-page">
        <div class="container">
            <div class="row">
                <!-- Content Right-->
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
                        <div class="clearfix"></div>


                    </aside>
                </div>
                <!-- /Content Right-->
                <!-- Content Left-->
                <div class="col-md-9 col-sm-12 col-xs-12 blog">
                    <div class="row">
                        @foreach ($blog as $bl)
                            <div class="col-md-4 col-sm-6 col-xs-12 blog-list-detail" style="height: 527px;">
                                <div class="blog-list">
                                    <figure><img class="img-responsive"
                                            src="{{ url('uploads/blog') }}/{{ $bl->cover_image }}" alt=""></figure>
                                    <div class="blog-info">
                                        <ul>
                                            <li><a href="#"><i class="icon-clock"></i>
                                                    {{ $bl->created_at->format(' F j, Y ') }}</a></li>
                                            <li><a href="#"><i class="icon-interface"></i>0 Bình luận</a></li>
                                        </ul>
                                        <h2 class="text-left text-uppercase"><a
                                                href="{{ route('danh-sach-bai-viet.show', $bl->slug) }}">{{ Str::limit($bl->title, 13) }}</a>
                                        </h2>
                                        <a href="{{ route('danh-sach-bai-viet.show', $bl->slug) }}"
                                            class="rd-mr text-uppercase">xem thêm</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="blog-nav">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                <div class="pagination text-center">
                                    @if ($blog->lastPage() > 1)
                                        @if ($blog->onFirstPage())
                                            <a class="d-none"></a>
                                        @else
                                            <a class="left" href="{{ $blog->previousPageUrl() }}"><i
                                                    class="icon-right-arrow"></i>prev</a>
                                        @endif
                                        @for ($i = 1; $i <= $blog->lastPage(); $i++) <a
                                                class="{{ $i == $blog->currentPage() ? 'active' : '' }}"
                                                href="?page={{ $i }}">{{ $i }}</a>
                                        @endfor
                                        @if ($blog->hasMorePages())
                                            <a class="right" href="{{ $blog->nextPageUrl() }}">next<i
                                                    class="icon-right-arrow"></i></a>
                                        @else
                                            <a class="d-none"></a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Content Left-->
            </div>
        </div>
    </div>
@stop
