<!doctype html>

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ela Admin</title>
    <meta name="description" content="Ela Admin">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="{{ url('backend') }}/css/normalize.min.css">
    <link rel="stylesheet" href="{{ url('backend') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('backend') }}/css/font-awesome.min.css">
    <link href="{{ url('backend') }}/css/toastr.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ url('backend') }}/css/themify-icons.css">
    <link rel="stylesheet" href="{{ url('backend') }}/css/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="{{ url('backend') }}/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{ url('backend') }}/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="{{ url('backend') }}/css/style.css">
    <link href="{{ url('backend') }}/css/chartist.min.css" rel="stylesheet">
    <link href="{{ url('backend') }}/css/jqvmap.min.css" rel="stylesheet">

    <link href="{{ url('backend') }}/css/weather-icons.css" rel="stylesheet" />
    <link href="{{ url('backend') }}/css/fullcalendar.min.css" rel="stylesheet" />
    @include('sweetalert::alert')
    <script src="{{ url('backend') }}/js/sweetalert2@9.js"></script>
    <script type="text/javascript" src="{{ url('ckeditor') }}/ckeditor.js"></script>
    <script src="http://cdn.ckeditor.com/4.11.1/full/ckeditor.js"></script>
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
    <style>
        a span .fa {
            font-size: 20px;
        }

    </style>
    @yield('css')

</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="{{ route('admin.home') }}"><i class="menu-icon fa fa-laptop"></i>Trang chủ </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Quản lý danh mục</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('danh-muc.index') }}">Danh sách
                                    danh mục</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('danh-muc.create') }}">Thêm danh
                                    mục</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Quản lý nhà cung cấp</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('nha-cung-cap.index') }}">Danh sách nhà
                                    cung cấp</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('nha-cung-cap.create') }}">Thêm nhà cung
                                    cấp</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Quản lý sản phẩm</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('san-pham.index') }}">Danh sách
                                    sản phẩm</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('san-pham.create') }}">Thêm sản
                                    phẩm</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Quản lý blog</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('danh-muc-bai-viet.index') }}">Danh sách danh mục blog</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('danh-muc-bai-viet.create') }}">Thêm danh mục blog</a>
                            </li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('bai-viet.index') }}">Danh sách bài viết</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('bai-viet.create') }}">Thêm bài viết</a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-picture-o" aria-hidden="true"></i>Quản lý
                            banner</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('banner.index') }}">Danh
                                    sách banner</a>
                            </li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('banner.create') }}">Thêm
                                    mới banner</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-user" aria-hidden="true"></i>Quản lý người
                            dùng</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('user.index') }}">Danh sách
                                    người dùng</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-credit-card" aria-hidden="true"></i>Quản lý
                            mã giảm giá</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('ma-giam-gia.index') }}">Danh
                                    sách mã giảm giá</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('ma-giam-gia.create') }}">Thêm
                                    mới mã giảm giá</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-info" aria-hidden="true"></i>Quản lý thông
                            tin shop</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('thong-tin-shop.index') }}">Danh sách thông tin shop</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('thong-tin-shop.create') }}">Thêm mới thông tin shop</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-users" aria-hidden="true"></i>Quản lý nhân
                            viên</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('nhan-vien.index') }}">Danh
                                    sách nhân viên</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('nhan-vien.create') }}">Thêm
                                    mới nhân viên</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-retweet" aria-hidden="true"></i>Phản hồi
                            contact</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('phan-hoi-contact.index') }}">Danh
                                    sách contact</a></li>
                            {{-- <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('nhan-vien.create') }}">Thêm mới nhân viên</a></li> --}}
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-truck" aria-hidden="true"></i>Quản lý tiền
                            ship</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('ma-ship.index') }}">Danh
                                    sách mã tiền ship</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('ma-ship.create') }}">Thêm mới mã ship</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('ma-free-ship.index') }}">Danh
                                    sách mã freeship</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('ma-free-ship.create') }}">Thêm
                                    mới mã freeship</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-camera-retro" aria-hidden="true"></i>Quản
                            lý gallery</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('danh-muc-bo-suu-tap.index') }}">Danh sách
                                    danh mục gallery</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('danh-muc-bo-suu-tap.create') }}">Thêm danh
                                    mục gallery</a></li>

                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('bo-suu-tap.index') }}">Danh sách
                                    gallery</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('bo-suu-tap.create') }}">Thêm
                                    gallery</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-money" aria-hidden="true"></i>Phương thức
                            thanh
                            toán</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('phuong-thuc-thanh-toan.index') }}">Danh
                                    sách phương thức thanh toán</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('phuong-thuc-thanh-toan.create') }}">Thêm
                                    mới phương thức thanh toán</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-shopping-cart" aria-hidden="true"></i>Quản
                            lý đơn hàng</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('don-hang.index') }}">Danh
                                    sách đơn hàng</a></li>

                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-shopping-cart" aria-hidden="true"></i>Quản
                            lý feedback sp</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('admin.feedback') }}">Danh
                                    sách feedback sp</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Forms</a></li>
                                    <li class="active">@yield('title')</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
