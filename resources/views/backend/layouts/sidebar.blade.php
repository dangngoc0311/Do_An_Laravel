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
                        <a href="{{ route('admin.home') }}"><i class="menu-icon fa fa-laptop"></i>Trang ch??? </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Qu???n l?? danh m???c</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('danh-muc.index') }}">Danh s??ch
                                    danh m???c</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('danh-muc.create') }}">Th??m danh
                                    m???c</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Qu???n l?? nh?? cung c???p</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('nha-cung-cap.index') }}">Danh s??ch nh??
                                    cung c???p</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('nha-cung-cap.create') }}">Th??m nh?? cung
                                    c???p</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Qu???n l?? s???n ph???m</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('san-pham.index') }}">Danh s??ch
                                    s???n ph???m</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('san-pham.create') }}">Th??m s???n
                                    ph???m</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Qu???n l?? blog</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('danh-muc-bai-viet.index') }}">Danh s??ch danh m???c blog</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('danh-muc-bai-viet.create') }}">Th??m danh m???c blog</a>
                            </li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('bai-viet.index') }}">Danh s??ch b??i vi???t</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('bai-viet.create') }}">Th??m b??i vi???t</a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-picture-o" aria-hidden="true"></i>Qu???n l??
                            banner</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('banner.index') }}">Danh
                                    s??ch banner</a>
                            </li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('banner.create') }}">Th??m
                                    m???i banner</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-user" aria-hidden="true"></i>Qu???n l?? ng?????i
                            d??ng</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('user.index') }}">Danh s??ch
                                    ng?????i d??ng</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-credit-card" aria-hidden="true"></i>Qu???n l??
                            m?? gi???m gi??</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('ma-giam-gia.index') }}">Danh
                                    s??ch m?? gi???m gi??</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('ma-giam-gia.create') }}">Th??m
                                    m???i m?? gi???m gi??</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-info" aria-hidden="true"></i>Qu???n l?? th??ng
                            tin shop</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('thong-tin-shop.index') }}">Danh s??ch th??ng tin shop</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('thong-tin-shop.create') }}">Th??m m???i th??ng tin shop</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-users" aria-hidden="true"></i>Qu???n l?? nh??n
                            vi??n</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('nhan-vien.index') }}">Danh
                                    s??ch nh??n vi??n</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('nhan-vien.create') }}">Th??m
                                    m???i nh??n vi??n</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-retweet" aria-hidden="true"></i>Ph???n h???i
                            contact</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('phan-hoi-contact.index') }}">Danh
                                    s??ch contact</a></li>
                            {{-- <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('nhan-vien.create') }}">Th??m m???i nh??n vi??n</a></li> --}}
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-truck" aria-hidden="true"></i>Qu???n l?? ti???n
                            ship</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('ma-ship.index') }}">Danh
                                    s??ch m?? ti???n ship</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('ma-ship.create') }}">Th??m m???i m?? ship</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('ma-free-ship.index') }}">Danh
                                    s??ch m?? freeship</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('ma-free-ship.create') }}">Th??m
                                    m???i m?? freeship</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-camera-retro" aria-hidden="true"></i>Qu???n
                            l?? gallery</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('danh-muc-bo-suu-tap.index') }}">Danh s??ch
                                    danh m???c gallery</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('danh-muc-bo-suu-tap.create') }}">Th??m danh
                                    m???c gallery</a></li>

                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('bo-suu-tap.index') }}">Danh s??ch
                                    gallery</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('bo-suu-tap.create') }}">Th??m
                                    gallery</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-money" aria-hidden="true"></i>Ph????ng th???c
                            thanh
                            to??n</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('phuong-thuc-thanh-toan.index') }}">Danh
                                    s??ch ph????ng th???c thanh to??n</a></li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('phuong-thuc-thanh-toan.create') }}">Th??m
                                    m???i ph????ng th???c thanh to??n</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-shopping-cart" aria-hidden="true"></i>Qu???n
                            l?? ????n h??ng</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('don-hang.index') }}">Danh
                                    s??ch ????n h??ng</a></li>

                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-shopping-cart" aria-hidden="true"></i>Qu???n
                            l?? feedback sp</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a
                                    href="{{ route('admin.feedback') }}">Danh
                                    s??ch feedback sp</a></li>
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
