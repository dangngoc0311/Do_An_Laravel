@extends('backend.master')
@section('title', 'Blog')
@section('main')

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <div class="content">
        <div id="main-content" class="blog-page">
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 left-box">
                    <div class="card single_post">
                        <div class="body">

                            <h3><a href="blog-details.html">{{ $blog->title }}</a></h3>
                            <p>{!! $blog->content !!}</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                        </div>
                        <div class="body">
                            <ul class="comment-reply list-unstyled">
                                @foreach ($cmt as $key => $value)
                                    <li class="row clearfix">
                                        <div class="icon-box col-md-2 col-4">
                                            @if ($value->getUser->image)
                                                <img src="{{ url('uploads') }}/{{ $value->getUser->image }}" alt="user"
                                                    class="img-responsive img-fluid img-thumbnail" />
                                            @else
                                                <img src="{{ url('frontend') }}/images/user-icon.png" alt="user"
                                                    class="img-responsive img-fluid img-thumbnail" />
                                            @endif
                                        </div>
                                        <div class="text-box col-md-10 col-8 p-l-0 p-r0">
                                            <h5 class="m-b-0">{{ $value->getUser->name }}</h5>
                                            <p>{{ $value->comment }}</p>
                                            <ul class="list-inline">
                                                <div class="">
                                                    <li><a
                                                            href="javascript:void(0);">{{ $value->created_at->format(' F j, Y ') }}</a>
                                                    </li>
                                                    <li><button
                                                            class="reply_cmt{{ $key }} float-right btn btn-outline-primary ml-1"
                                                            style="font-size: 14px;
                                                                                            padding: 1px 5px;">
                                                            <i class="fa fa-reply"></i>
                                                            Reply</button></li>

                                                </div>

                                            </ul>
                                        </div>
                                        <ul class="children col-md-12 " style="padding-left: 88px;
                                                    padding-top: 20px;">

                                            @foreach ($value->getComments()->get() as $replies)
                                                <li class="row">

                                                <div class="icon-box col-md-2 col-4">
                                                    @if ($replies->user->image)
                                                        <img src="{{ url('uploads/user') }}/{{ $replies->user->image }}"
                                                            alt="user" class="img-responsive img-fluid img-thumbnail" />
                                                    @else
                                                        <img src="{{ url('frontend') }}/images/user-icon.png" alt="user"
                                                            class="img-responsive img-fluid img-thumbnail" />
                                                    @endif
                                                </div>
                                                <div class="text-box col-md-10 col-8 p-l-0 p-r0">
                                                    <h5 class="m-b-0">{{ $replies->user->name }}</h5>
                                                    <p>{{ $replies->comment }}</p>
                                                    <ul class="list-inline">
                                                        <div class="">
                                                            <li><a
                                                                    href="javascript:void(0);">{{ $replies->created_at->format(' F j, Y ') }}</a>
                                                            </li>


                                                        </div>

                                                    </ul>
                                                </div>

                                                </li>


                                            @endforeach


                                        </ul>
                                    </li>
                                    <div class="content{{ $key }} d-none">
                                        <div class="comment-form-wrap " style="padding-left: 35px;;">
                                            <form class="p-2 " method="POST" action="{{ route('reply.add') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="hidden" name="comment_id" value="{{ $value->id }}">
                                                    <input type="hidden" class="form-control" id="email"
                                                        value="{{ Auth::guard('admin')->user()->id }}" name="user_id">
                                                </div>
                                                <div class="form-group">
                                                    <textarea id="message" cols="30" rows="2" class="form-control"
                                                        name="comment"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" value="Post Comment" class="btn px-3 btn-primary">
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                @endforeach


                            </ul>
                            {!! $cmt->appends(\Request::except('page'))->render() !!}

                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-12 right-box">

                    <div class="card">
                        <div class="header">
                            <h2>Categories</h2>
                        </div>
                        <div class="body widget">
                            <ul class="list-unstyled categories-clouds m-b-0">
                                @foreach ($categoryBlog as $cate)
                                    <li><a href="javascript:void(0);">{{ $cate->name }}</a></li>

                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2>New Posts</h2>
                        </div>
                        <div class="body widget popular-post">
                            <div class="row">
                                <div class="col-lg-12">
                                    @foreach ($new_blog as $new)
                                        <div class="box">
                                            <div class="img-part">
                                                <img src="{{ url('uploads/blog') }}/{{ $new->cover_image }}"
                                                    alt="blog post" class="img-fluid" />
                                            </div>
                                            <div class="txt-part">
                                                <a class="blog-tit"
                                                    href="{{ route('danh-sach-bai-viet.show', $new->slug) }}">{{ $new->title }}</a><br>
                                                <a href="{{ route('danh-sach-bai-viet.show', $new->slug) }}"
                                                    class="blog-date"><i class="icon-clock"></i>
                                                    {{ $new->created_at->format(' F j, Y ') }}</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <input id="count" type="hidden" value={{ $counts }}>

@stop


@section('js')
    <script src="{{ url('backend') }}/js/jquery-3.6.0.slim.js"></script>

    <script>
        $(document).ready(function() {
            let count = $('#count').val();
            for (let i = 0; i < count; i++) {
                $('.reply_cmt' + i).click(function(e) {
                    $('.content' + i).removeClass('d-none')
                });
            }
        });
    </script>
@stop
@section('css')
    <style>
        .box {
            float: left;
        }

        .box .img-part {
            float: left;
            width: 30%;
        }

        .box .img-part img {
            width: 100%;
        }

        .box .txt-part {
            padding-left: 18px;
            float: left;
            width: 70%;
        }

        .box .txt-part .blog-tit {
            font-weight: 800;
            color: #5a4a3b;
            font-size: 18px;
            line-height: 20px;
            text-transform: inherit;
        }

        .box .blog-date {
            color: #7d7976;
            font-size: 13px;
            font-weight: 500;
            padding: 10px 0 0 0;
            display: inline-block;
            font-style: italic;
        }

        .card {
            background: #fff;
            transition: .5s;
            border: 0;
            margin-bottom: 30px;
            border-radius: .55rem;
            position: relative;
            width: 100%;
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
        }

        .card .body {
            color: #444;
            padding: 20px;
            font-weight: 400;
        }

        .card .header {
            color: #444;
            padding: 20px;
            position: relative;
            box-shadow: none;
        }

        .single_post {
            -webkit-transition: all .4s ease;
            transition: all .4s ease
        }

        .single_post .body {
            padding: 30px
        }

        .single_post .img-post {
            position: relative;
            overflow: hidden;
            max-height: 500px;
            margin-bottom: 30px
        }

        .single_post .img-post>img {
            -webkit-transform: scale(1);
            -ms-transform: scale(1);
            transform: scale(1);
            opacity: 1;
            -webkit-transition: -webkit-transform .4s ease, opacity .4s ease;
            transition: transform .4s ease, opacity .4s ease;
            max-width: 100%;
            filter: none;
            -webkit-filter: grayscale(0);
            -webkit-transform: scale(1.01)
        }

        .single_post .img-post:hover img {
            -webkit-transform: scale(1.02);
            -ms-transform: scale(1.02);
            transform: scale(1.02);
            opacity: .7;
            filter: gray;
            -webkit-filter: grayscale(1);
            -webkit-transition: all .8s ease-in-out
        }

        .single_post .img-post:hover .social_share {
            display: block
        }

        .single_post .footer {
            padding: 0 30px 30px 30px
        }

        .single_post .footer .actions {
            display: inline-block
        }

        .single_post .footer .stats {
            cursor: default;
            list-style: none;
            padding: 0;
            display: inline-block;
            float: right;
            margin: 0;
            line-height: 35px
        }

        .single_post .footer .stats li {
            border-left: solid 1px rgba(160, 160, 160, 0.3);
            display: inline-block;
            font-weight: 400;
            letter-spacing: 0.25em;
            line-height: 1;
            margin: 0 0 0 2em;
            padding: 0 0 0 2em;
            text-transform: uppercase;
            font-size: 13px
        }

        .single_post .footer .stats li a {
            color: #777
        }

        .single_post .footer .stats li:first-child {
            border-left: 0;
            margin-left: 0;
            padding-left: 0
        }

        .single_post h3 {
            font-size: 20px;
            text-transform: uppercase
        }

        .single_post h3 a {
            color: #242424;
            text-decoration: none
        }

        .single_post p {
            font-size: 16px;
            line-height: 26px;
            font-weight: 300;
            margin: 0
        }

        .single_post .blockquote p {
            margin-top: 0 !important
        }

        .single_post .meta {
            list-style: none;
            padding: 0;
            margin: 0
        }

        .single_post .meta li {
            display: inline-block;
            margin-right: 15px
        }

        .single_post .meta li a {
            font-style: italic;
            color: #959595;
            text-decoration: none;
            font-size: 12px
        }

        .single_post .meta li a i {
            margin-right: 6px;
            font-size: 12px
        }

        .single_post2 {
            overflow: hidden
        }

        .single_post2 .content {
            margin-top: 15px;
            margin-bottom: 15px;
            padding-left: 80px;
            position: relative
        }

        .single_post2 .content .actions_sidebar {
            position: absolute;
            top: 0px;
            left: 0px;
            width: 60px
        }

        .single_post2 .content .actions_sidebar a {
            display: inline-block;
            width: 100%;
            height: 60px;
            line-height: 60px;
            margin-right: 0;
            text-align: center;
            border-right: 1px solid #e4eaec
        }

        .single_post2 .content .title {
            font-weight: 100
        }

        .single_post2 .content .text {
            font-size: 15px
        }

        .right-box .categories-clouds li {
            display: inline-block;
            margin-bottom: 5px
        }

        .right-box .categories-clouds li a {
            display: block;
            border: 1px solid;
            padding: 6px 10px;
            border-radius: 3px
        }

        .right-box .instagram-plugin {
            overflow: hidden
        }

        .right-box .instagram-plugin li {
            float: left;
            overflow: hidden;
            border: 1px solid #fff
        }

        .comment-reply li {
            margin-bottom: 22px
        }

        .comment-reply li:last-child {
            margin-bottom: none
        }

        .comment-reply li h5 {
            font-size: 18px
        }

        .comment-reply li p {
            margin-bottom: 0px;
            font-size: 15px;
            color: #777
        }

        .comment-reply .list-inline li {
            display: inline-block;
            margin: 0;
            padding-right: 20px
        }

        .comment-reply .list-inline li a {
            font-size: 13px
        }

        @media (max-width: 640px) {
            .blog-page .left-box .single-comment-box>ul>li {
                padding: 25px 0
            }

            .blog-page .left-box .single-comment-box ul li .icon-box {
                display: inline-block
            }

            .blog-page .left-box .single-comment-box ul li .text-box {
                display: block;
                padding-left: 0;
                margin-top: 10px
            }

            .blog-page .single_post .footer .stats {
                float: none;
                margin-top: 10px
            }

            .blog-page .single_post .body,
            .blog-page .single_post .footer {
                padding: 30px
            }
        }

    </style>
@stop
