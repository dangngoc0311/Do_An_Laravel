@extends('frontend.master')
@section('title', 'Tài khoản')
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
    <div class="content-part blog-page">
        <div class="container">
            <div class="row">
                <div class="main-body">


                    <!-- /Breadcrumb -->

                    <div class="row gutters-sm">
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img src="{{ url('uploads/brand') }}/{{ $brands->image }}" alt="Admin"
                                            class="rounded-circle" width="150" style="margin: auto;">
                                        <div class="mt-3">
                                            <h4>{{ $brands->name }}</h4>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Tên</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $brands->name }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $brands->email }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Phone</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $brands->phone }}
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Address</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $brands->address }}
                                        </div>
                                    </div>
                                    <hr>

                                </div>
                            </div>

                            <div class="row gutters-sm">
                                <div class="col-sm-6 mb-3">

                                </div>
                                <div class="col-sm-6 mb-3">

                                </div>
                            </div>



                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
    <style>
        .main-body {
            padding: 15px;
        }

        .card {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .gutters-sm {
            margin-right: -8px;
            margin-left: -8px;
        }

        .gutters-sm>.col,
        .gutters-sm>[class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
        }

        .mb-3,
        .my-3 {
            margin-bottom: 1rem !important;
        }

        .bg-gray-300 {
            background-color: #e2e8f0;
        }

        .h-100 {
            height: 100% !important;
        }

        .shadow-none {
            box-shadow: none !important;
        }

    </style>
@stop
