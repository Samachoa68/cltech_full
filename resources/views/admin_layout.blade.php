<!DOCTYPE html>

<head>
    <title>DASHBOARD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
    Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

    <base href="{{ asset('backend') }}/">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap5.min.css">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/style-responsive.css" rel="stylesheet" />
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="css/font.css" type="text/css" />
    <link href="css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="css/morris.css" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="css/monthly.css">
    <!-- //calendar -->
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="css/bootstrap-tagsinput.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

    <!-- //font-awesome icons -->
    <script src="js/jquery2.0.3.min.js"></script>
    <script src="js/raphael-min.js"></script>
    <script src="js/morris.js"></script>

    <script src="js/bootstrap-tagsinput.min.js"></script>


</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="index.html" class="logo">
                    ADMIN
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-success">8</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <li>
                                <p class="">You have 8 pending tasks</p>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info clearfix">
                                        <div class="desc pull-left">
                                            <h5>Target Sell</h5>
                                            <p>25% , Deadline 12 June’13</p>
                                        </div>
                                        <span class="notification-pie-chart pull-right" data-percent="45">
                                            <span class="percent"></span>
                                        </span>
                                    </div>
                                </a>
                            </li>




                            <li class="external">
                                <a href="#">See All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-important">4</span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <li>
                                <p class="red">You have 4 Mails</p>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="images/3.png"></span>
                                    <span class="subject">
                                        <span class="from">Jonathan Smith</span>
                                        <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hello, this is an example msg.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="images/1.png"></span>
                                    <span class="subject">
                                        <span class="from">Jane Doe</span>
                                        <span class="time">2 min ago</span>
                                    </span>
                                    <span class="message">
                                        Nice admin template
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="images/3.png"></span>
                                    <span class="subject">
                                        <span class="from">Tasi sam</span>
                                        <span class="time">2 days ago</span>
                                    </span>
                                    <span class="message">
                                        This is an example msg.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="images/1.png"></span>
                                    <span class="subject">
                                        <span class="from">Mr. Perfect</span>
                                        <span class="time">2 hour ago</span>
                                    </span>
                                    <span class="message">
                                        Hi there, its a test
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">See all messages</a>
                            </li>
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
                    <!-- notification dropdown start-->
                    <li id="header_notification_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <i class="fa fa-bell-o"></i>
                            <span class="badge bg-warning">3</span>
                        </a>
                        <ul class="dropdown-menu extended notification">
                            <li>
                                <p>Notifications</p>
                            </li>
                            <li>
                                <div class="alert alert-info clearfix">
                                    <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                    <div class="noti-info">
                                        <a href="#"> Server #1 overloaded.</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="alert alert-danger clearfix">
                                    <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                    <div class="noti-info">
                                        <a href="#"> Server #2 overloaded.</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="alert alert-success clearfix">
                                    <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                    <div class="noti-info">
                                        <a href="#"> Server #3 overloaded.</a>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </li>
                    <!-- notification dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="images/2.png">
                            <span class="username">

                                <?php
                                $name = Auth::user()->admin_name;
                                if ($name) {
                                    echo $name;
                                } else {
                                }
                                ?>

                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="{{ URL::to('/logout-auth') }}"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="{{ URL::to('/dashboard') }}">
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Google Drive</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/read-data') }}">List Data</a></li>

                            </ul>
                        </li>


                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Đơn hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/manage-order') }}">Quản lý đơn hàng</a></li>

                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Slider</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-slider') }}">Thêm slider</a></li>
                                <li><a href="{{ URL::to('/list-slider') }}">List slider</a></li>
                            </ul>
                        </li>


                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh mục Sản Phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-category-product') }}">Thêm danh mục sản phẩm</a></li>
                                <li><a href="{{ URL::to('/all-category-product') }}">Liệt kê danh mục sản phẩm</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Thương hiệu</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-brand-product') }}">Thêm hiệu sản phẩm</a></li>
                                <li><a href="{{ URL::to('/all-brand-product') }}">Liệt kê thương hiệu sản phẩm</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Sản Phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-product') }}">Thêm sản phẩm</a></li>
                                <li><a href="{{ URL::to('/all-product') }}">Liệt kê sản phẩm</a></li>

                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh mục bài viết</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-cate-post') }}">Thêm danh mục bài viết</a></li>
                                <li><a href="{{ URL::to('/all-cate-post') }}">Liệt kê danh mục bài viết</a></li>

                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Bài viết</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-post') }}">Thêm bài viết</a></li>
                                <li><a href="{{ URL::to('/all-post') }}">Liệt kê bài viết</a></li>

                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Comment</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/list-comment') }}">Danh sách bình luận</a></li>

                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Mã giảm giá</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/insert-coupon') }}">Thêm mã giảm giá</a></li>
                                <li><a href="{{ URL::to('/list-coupon') }}">Liệt kê mã giảm giá</a></li>

                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Vận chuyển</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/delivery') }}">Quản lý vận chuyển</a></li>

                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Video</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/video') }}">List video</a></li>

                            </ul>
                        </li>



                        @hasrole(['admin','author'])
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>User</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-users') }}">Thêm User</a></li>
                                <li><a href="{{ URL::to('/users') }}">Danh sách User</a></li>

                            </ul>
                        </li>
                        @endhasrole

                        @impersonate
                        <li class="sub-menu">
                            <a href="{{ URL::to('/impersonate-destroy') }}">
                                <i class="fa fa-book"></i>
                                <span>Stop chuyển quyền</span>
                            </a>
                        </li>
                        @endimpersonate

                        <li class="sub-menu">
                            <a href="{{ URL::to('/add-contact') }}">
                                <i class="fa fa-book"></i>
                                <span>Liên hệ</span>
                            </a>

                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-th"></i>
                                <span>Data Tables</span>
                            </a>
                            <ul class="sub">
                                <li><a href="basic_table.html">Basic Table</a></li>
                                <li><a href="responsive_table.html">Responsive Table</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-tasks"></i>
                                <span>Form Components</span>
                            </a>
                            <ul class="sub">
                                <li><a href="form_component.html">Form Elements</a></li>
                                <li><a href="form_validation.html">Form Validation</a></li>
                                <li><a href="dropzone.html">Dropzone</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-envelope"></i>
                                <span>Mail </span>
                            </a>
                            <ul class="sub">
                                <li><a href="mail.html">Inbox</a></li>
                                <li><a href="mail_compose.html">Compose Mail</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class=" fa fa-bar-chart-o"></i>
                                <span>Charts</span>
                            </a>
                            <ul class="sub">
                                <li><a href="chartjs.html">Chart js</a></li>
                                <li><a href="flot_chart.html">Flot Charts</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class=" fa fa-bar-chart-o"></i>
                                <span>Maps</span>
                            </a>
                            <ul class="sub">
                                <li><a href="google_map.html">Google Map</a></li>
                                <li><a href="vector_map.html">Vector Map</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-glass"></i>
                                <span>Extra</span>
                            </a>
                            <ul class="sub">
                                <li><a href="gallery.html">Gallery</a></li>
                                <li><a href="404.html">404 Error</a></li>
                                <li><a href="registration.html">Registration</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="login.html">
                                <i class="fa fa-user"></i>
                                <span>Login Page</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                @yield('admin_content')

            </section>
            <!-- footer -->
            <div class="footer">
                <div class="wthree-copyright">
                    <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
                </div>
            </div>
            <!-- / footer -->
        </section>
        <!--main content end-->
    </section>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/scripts.js"></script>
    {{-- <script src="js/jquery.js"></script>
    <script src="js/jquery.min.js"></script> --}}
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/jquery.form-validator.min.js"></script>

    <script src="js/simple.money.format.js"></script>

    <script src="{{ asset('backend/js/slug.js') }}"></script>
    <script src="js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $.validate({});
    </script>

    <script src="ckeditor/ckeditor.js"></script>

    <script src="js/jquery-ui.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <script>
        var options = {
          filebrowserImageBrowseUrl: '/cltech_full/public/laravel-filemanager?type=Images',
          filebrowserImageUploadUrl: '/cltech_full/public/laravel-filemanager/upload?type=Images&_token=',
          filebrowserBrowseUrl: '/cltech_full/public/laravel-filemanager?type=Files',
          filebrowserUploadUrl: '/cltech_full/public/laravel-filemanager/upload?type=Files&_token='
        };
        </script>

    <script>
    CKEDITOR.replace('my-editor', options);
    </script>

    <script>
        CKEDITOR.replace('ckeditor_1', {
            filebrowserImageUploadUrl: "{{ url('uploads-ckeditor?_token=' . csrf_token()) }}",
            filebrowserBrowseUrl: "{{ url('file-browser?_token=' . csrf_token()) }}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace('ckeditor_2');
        CKEDITOR.replace('ckeditor_3');
        CKEDITOR.replace('ckeditor_4');
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <script>
        $('.price_format').simpleMoneyFormat();
    </script>

    <script>
        $(function() {
            $("#coupon_start").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "yy/mm/dd",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
                duration: "slow"
            });
            $("#coupon_end").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "yy/mm/dd",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
                duration: "slow"
            });
        });
    </script>

    <script>
        load_gallery();

        function load_gallery() {
            var pro_id = $('.pro_id').val();
            var _token = $('input[name="_token"]').val();
            // alert(pro_id);

            $.ajax({
                url: "{{ url('/select-gallery') }}",
                method: "POST",
                data: {
                    pro_id: pro_id,
                    _token: _token
                },
                success: function(data) {
                    $('#gallery_load').html(data);
                }
            });
        }
        $('#file').change(function() {
            var error = '';
            var files = $('#file')[0].files;

            if (files.length > 5) {
                error += '<p>Chọn tối đa 5 ảnh</p>';
            } else if (files.length == '') {
                error += '<p>Bạn không được bỏ trống ảnh</p>';
            } else if (files.size > 2000000) {
                error += '<p>File ảnh không được lớn hơn 2MB</p>';
            }

            if (error == '') {

            } else {
                $('#file').val('');
                $('#error_gallery').html('<span class="text-danger">' + error + '</span>');
                return false;
            }

        });

        $(document).on('blur', '.edit_gal_name', function() {
            var gal_id = $(this).data('gal_id');
            var gal_text = $(this).text();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{ url('/update-gallery-name') }}",
                method: "POST",
                data: {
                    gal_id: gal_id,
                    gal_text: gal_text,
                    _token: _token
                },
                success: function(data) {
                    load_gallery();
                    $('#error_gallery').html(
                        '<span class="text-danger">Cập nhật tên hình ảnh thành công</span>'
                    );
                }

            });
        });

        $(document).on('click', '.delete-gallery', function() {
            var gal_id = $(this).data('gal_id');

            var _token = $('input[name="_token"]').val();
            if (confirm('Bạn muốn xóa hình ảnh này không?')) {
                $.ajax({
                    url: "{{ url('/delete-gallery') }}",
                    method: "POST",
                    data: {
                        gal_id: gal_id,
                        _token: _token
                    },
                    success: function(data) {
                        load_gallery();
                        $('#error_gallery').html(
                            '<span class="text-danger">Xóa hình ảnh thành công</span>');
                    }
                });
            }
        });

        $(document).on('change', '.file_image', function() {

            var gal_id = $(this).data('gal_id');
            var image = document.getElementById("file-" + gal_id).files[0];

            var form_data = new FormData();

            form_data.append("file", document.getElementById("file-" + gal_id).files[0]);
            form_data.append("gal_id", gal_id);

            $.ajax({
                url: "{{ url('/update-gallery') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form_data,

                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    load_gallery();
                    $('#error_gallery').html(
                        '<span class="text-danger">Cập nhật hình ảnh thành công</span>');
                }
            });

        });
    </script>

    <script>
        list_partner();

        function delete_partner(id) {
            var id = id;
            $.ajax({
                url: "{{ url('/delete-partner') }}",
                method: "GET",
                data: {
                    id: id
                },
                success: function(data) {
                    list_partner();
                }
            });
        }

        function list_partner() {
            $.ajax({
                url: "{{ url('/list-partner') }}",
                method: "GET",
                success: function(data) {
                    $('#list_partner').html(data);
                }
            });
        }
        $('.add-partner').click(function() {
            var name = $('#partner_name').val();
            var link = $('#partner_link').val();
            var image = $('#partner_image')[0].files[0];
            var form_data = new FormData();

            form_data.append("name", name);
            form_data.append("link", link);
            form_data.append("file", image);

            $.ajax({
                url: "{{ url('/add-partner') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    alert('Thêm đối tác thành công');
                    list_partner();
                }
            });

        });
    </script>

    <script>
        list_icon();

        function delete_icon(id) {
            var id = id;
            $.ajax({
                url: "{{ url('/delete-icon') }}",
                method: "GET",
                data: {
                    id: id
                },
                success: function(data) {
                    list_icon();
                }
            });
        }

        function list_icon() {
            $.ajax({
                url: "{{ url('/list-icon') }}",
                method: "GET",
                success: function(data) {
                    $('#list_icon').html(data);
                }
            });
        }
        $('.add-icon').click(function() {
            var name = $('#icon_name').val();
            var link = $('#icon_link').val();
            var image = $('#icon_image')[0].files[0];
            var form_data = new FormData();

            form_data.append("name", name);
            form_data.append("link", link);
            form_data.append("file", image);

            $.ajax({
                url: "{{ url('/add-icon') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    alert('Thêm icon mạng xã hội thành công');
                    list_icon();
                }
            });

        });
    </script>

    <script>
        $('.btn-delete-document').click(function() {
            var product_id = $(this).data('document_id');
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{ url('/delete-document') }}",
                method: "POST",
                data: {
                    _token: _token,
                    product_id
                },
                success: function(data) {
                    alert("Xóa file document thành công");
                    location.reload();
                }
            });
        });
    </script>

    <script>
        $(function() {
            $("#datepicker").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "yy-mm-dd",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
                duration: "slow"
            });
            $("#datepicker2").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "yy-mm-dd",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
                duration: "slow"
            });
        });
    </script>


    <script>
        var colorDanger = "#FF1744";
        Morris.Donut({
            element: 'donut',
            resize: true,
            colors: [
                '#a8328e',
                '#61a1ce',
                '#ce8f61',
                '#f5b942',
                '#4842f5'
            ],
            //labelColor:"#cccccc", // text color
            //backgroundColor: '#333333', // border color
            data: [{
                    label: "San pham",
                    value: <?php echo $app_product; ?>
                },
                {
                    label: "Bai viet",
                    value: <?php echo $app_post; ?>
                },
                {
                    label: "Don hang",
                    value: <?php echo $app_order; ?>
                },
                {
                    label: "Video",
                    value: <?php echo $app_video; ?>
                },
                {
                    label: "Khach hang",
                    value: <?php echo $app_customer; ?>
                }
            ]
        });
    </script>

    <script>
        $(document).ready(function() {

            filter30_days();

            var chart = new Morris.Bar({

                element: 'chart',
                //option chart
                lineColors: ['#819C79', '#fc8710', '#FF6541', '#A4ADD3', '#766B56'],
                parseTime: false,
                hideHover: 'auto',
                xkey: 'period',
                ykeys: ['order', 'sales', 'profit', 'quantity'],
                labels: ['đơn hàng', 'doanh số', 'lợi nhuận', 'số lượng']

            });

            function filter30_days() {
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ url('/filter30-days') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        _token: _token
                    },

                    success: function(data) {
                        chart.setData(data);
                    }
                });
            }

            $('#btn-filter-dashboard').click(function() {
                var _token = $('input[name="_token"]').val();

                var from_date = $('#datepicker').val();
                var to_date = $('#datepicker2').val();

                $.ajax({
                    url: "{{ url('/filter-by-date') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        from_date: from_date,
                        to_date: to_date,
                        _token: _token
                    },

                    success: function(data) {
                        chart.setData(data);
                    }
                });
            });

            $('.dashboard-filter').change(function() {
                var _token = $('input[name="_token"]').val();

                var filter_value = $(this).val();
                $.ajax({
                    url: "{{ url('/dashboard-filter') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        filter_value: filter_value,
                        _token: _token
                    },

                    success: function(data) {
                        chart.setData(data);
                    }
                });
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $('#category_order').sortable({
                placeholder: 'ui-state-highlight',
                update: function(event, ui) {
                    var page_id_array = new Array();
                    var _token = $('input[name="_token"]').val();

                    $('#category_order tr').each(function() {
                        page_id_array.push($(this).attr("id"));
                    });

                    $.ajax({
                        url: "{{ url('/arrange-category') }}",
                        method: "POST",
                        data: {
                            page_id_array: page_id_array,
                            _token: _token
                        },
                        success: function(data) {
                            alert(data);
                        }
                    });

                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            load_video();

            function load_video() {
                $.ajax({
                    url: "{{ url('/select-video') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#video_load').html(data);
                    }
                });
            }


            $(document).on('blur', '.video_edit', function() {
                var video_type = $(this).data('video_type');
                var video_id = $(this).data('video_id');
                //alert(video_type);
                if (video_type == 'video_title') {
                    var video_edit = $('#' + video_type + '_' + video_id).text();
                    var video_check = video_type;
                } else if (video_type == 'video_desc') {
                    var video_edit = $('#' + video_type + '_' + video_id).text();
                    var video_check = video_type;
                } else if (video_type == 'video_link') {
                    var video_edit = $('#' + video_type + '_' + video_id).text();
                    var video_check = video_type;
                } else {
                    var video_edit = $('#' + video_type + '_' + video_id).text();
                    var video_check = video_type;
                }

                $.ajax({
                    url: "{{ url('/update-video') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        video_check: video_check,
                        video_edit: video_edit,
                        video_id: video_id
                    },
                    success: function(data) {
                        load_video();
                        $('#notify').html(
                            '<span class="text text-success">Cập nhật video thành công</span>'
                        );
                    }
                });

            });

            $(document).on('click', '#btn-add-video', function() {
                var video_title = $('.video_title').val();
                var video_slug = $('.video_slug').val();
                var video_link = $('.video_link').val();
                var video_desc = $('.video_desc').val();
                var video_status = $('.video_status').val();
                alert(video_title);
                var form_data = new FormData();

                form_data.append("file", document.getElementById("file_img_video").files[0]);
                form_data.append("video_title", video_title);
                form_data.append("video_slug", video_slug);
                form_data.append("video_desc", video_desc);
                form_data.append("video_status", video_status);
                form_data.append("video_link", video_link);

                $.ajax({
                    url: "{{ url('/insert-video') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        load_video();
                        $('#notify').html(
                            '<span class="text-danger">Thêm video thành công</span>');
                    }
                });

            });

            $(document).on('change', '.file_img_video', function() {

                var vid_id = $(this).data('vid_id');
                var image = document.getElementById("file-video-" + vid_id).files[0];

                var form_data = new FormData();

                form_data.append("file", document.getElementById("file-video-" + vid_id).files[0]);
                form_data.append("vid_id", vid_id);

                $.ajax({
                    url: "{{ url('/update-video-image') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: form_data,

                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        load_video();
                        $('#notify').html(
                            '<span class="text-danger">Cập nhật hình ảnh video thành công</span>'
                        );
                    }
                });

            });


            $(document).on('click', '.delete-video', function() {
                var video_id = $(this).data('video_id');
                if (confirm('Bạn muốn xóa video này không?')) {
                    $.ajax({
                        url: "{{ url('/delete-video') }}",
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            video_id: video_id
                        },
                        success: function(data) {
                            load_video();
                            $('#notify').html(
                                '<span class="text-danger">Xóa video thành công</span>');
                        }
                    });
                }
            });



        })
    </script>


    //Slug
    <script type="text/javascript">
        function ChangeToSlug() {
            var slug;

            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
    </script>

    <script>
        $('.comment-duyet-btn').click(function() {
            var comment_status = $(this).data('comment_status');
            var comment_id = $(this).data('comment_id');
            if (comment_status == 0) {
                var tb = 'Bỏ duyệt bình luận thành công';
            } else {
                var tb = 'Duyệt bình luận thành công';
            }
            $.ajax({
                url: "{{ url('/approve-comment') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    comment_status: comment_status,
                    comment_id: comment_id
                },
                success: function(data) {
                    location.reload();
                    $('#notify_comment').html('<span class="text-success">' + tb + '</span>');
                }
            });

        });

        $('.reply-comment-btn').click(function() {
            var comment_id = $(this).data('comment_id');
            var comment = $('.reply_comment_' + comment_id).val();
            var comment_product_id = $(this).data('product_id');

            $.ajax({
                url: "{{ url('/reply-comment') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    comment_id: comment_id,
                    comment: comment,
                    comment_product_id: comment_product_id
                },
                success: function(data) {
                    $('.reply_comment_' + comment_id).val('');
                    $('#notify_comment').html(
                        '<span class="text-success">Trả lời bình luận thành công</span>');
                }
            });

        });
    </script>

    <script type="text/javascript">
        $('.update_quantity_order').click(function() {
            var order_product_id = $(this).data('product_id');
            var order_qty = $('.order_qty_' + order_product_id).val();
            var order_code = $('.order_code').val();
            var _token = $('input[name="_token"]').val();
            // alert(order_product_id);
            // alert(order_qty);
            // alert(order_code);
            $.ajax({
                url: '{{ url('/update-qty') }}',
                method: 'POST',
                data: {
                    _token: _token,
                    order_qty: order_qty,
                    order_code: order_code,
                    order_product_id: order_product_id
                },
                success: function(data) {
                    alert('Cập nhật số lượng của đơn hàng thành công');
                    location.reload();
                }
            });


        });
    </script>

    <script type="text/javascript">
        $('.order_details').change(function() {
            var order_status = $(this).val();
            var order_id = $(this).children(":selected").attr("id");
            var _token = $('input[name="_token"]').val();

            //Lay số lượng
            quantity = [];
            $("input[name='product_sales_quantity']").each(function() {
                quantity.push($(this).val());
            });

            // Lay product_id
            order_product_id = [];
            $("input[name='order_product_id']").each(function() {
                order_product_id.push($(this).val());
            });
            j = 0;
            for (i = 0; i < order_product_id.length; i++) {
                var order_qty = $('.order_qty_' + order_product_id[i]).val();
                var product_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();
                if (parseInt(order_qty) > parseInt(product_qty_storage)) {
                    j = j + 1;
                    if (j == 1) {
                        alert('Số lượng đặt hàng vượt quá số lượng trong kho');
                    }
                    $('.order_color_' + order_product_id[i]).css('background', '#FF0000');
                }

            }
            if (j == 0) {
                $.ajax({
                    url: '{{ url('/update-order-status') }}',
                    method: 'POST',
                    data: {
                        _token: _token,
                        order_status: order_status,
                        order_id: order_id,
                        quantity: quantity,
                        order_product_id: order_product_id
                    },
                    success: function(data) {
                        alert('Xử lý và giao hàng thành công ');
                        location.reload();
                    }
                });
            }



        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            fetch_delivery();

            function fetch_delivery() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/select-feeship') }}',
                    method: 'POST',
                    data: {
                        _token: _token
                    },
                    success: function(data) {
                        $('#load_delivery').html(data);
                    }
                });
            }

            $(document).on('blur', '.fee_feeship_edit', function() {
                var feeship_id = $(this).data('feeship_id');
                var fee_value = $(this).text();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/update-delivery') }}',
                    method: 'POST',
                    data: {
                        feeship_id: feeship_id,
                        fee_value: fee_value,
                        _token: _token
                    },
                    success: function(data) {
                        fetch_delivery();
                    }
                });
            });

            $('.add_delivery').click(function() {

                var city = $('.city').val();
                var province = $('.province').val();
                var wards = $('.wards').val();
                var fee_ship = $('.fee_ship').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{ url('/insert-delivery') }}',
                    method: 'POST',
                    data: {
                        city: city,
                        province: province,
                        _token: _token,
                        wards: wards,
                        fee_ship: fee_ship
                    },
                    success: function(data) {
                        fetch_delivery();
                    }
                });

            });

            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                // alert(action);
                //  alert(matp);
                //   alert(_token);

                if (action == 'city') {
                    result = 'province';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: '{{ url('/select-delivery') }}',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });
        })
    </script>

    //[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="js/jquery.scrollTo.js"></script>
    //morris JavaScript -->
    <script>
        $(document).ready(function() {
            //BOX BUTTON SHOW AND CLOSE
            jQuery('.small-graph-box').hover(function() {
                jQuery(this).find('.box-button').fadeIn('fast');
            }, function() {
                jQuery(this).find('.box-button').fadeOut('fast');
            });
            jQuery('.small-graph-box .box-close').click(function() {
                jQuery(this).closest('.small-graph-box').fadeOut(200);
                return false;
            });

            //CHARTS
            function gd(year, day, month) {
                return new Date(year, month - 1, day).getTime();
            }

            graphArea2 = Morris.Area({
                element: 'hero-area',
                padding: 10,
                behaveLikeLine: true,
                gridEnabled: false,
                gridLineColor: '#dddddd',
                axes: true,
                resize: true,
                smooth: true,
                pointSize: 0,
                lineWidth: 0,
                fillOpacity: 0.85,
                data: [{
                        period: '2015 Q1',
                        iphone: 2668,
                        ipad: null,
                        itouch: 2649
                    },
                    {
                        period: '2015 Q2',
                        iphone: 15780,
                        ipad: 13799,
                        itouch: 12051
                    },
                    {
                        period: '2015 Q3',
                        iphone: 12920,
                        ipad: 10975,
                        itouch: 9910
                    },
                    {
                        period: '2015 Q4',
                        iphone: 8770,
                        ipad: 6600,
                        itouch: 6695
                    },
                    {
                        period: '2016 Q1',
                        iphone: 10820,
                        ipad: 10924,
                        itouch: 12300
                    },
                    {
                        period: '2016 Q2',
                        iphone: 9680,
                        ipad: 9010,
                        itouch: 7891
                    },
                    {
                        period: '2016 Q3',
                        iphone: 4830,
                        ipad: 3805,
                        itouch: 1598
                    },
                    {
                        period: '2016 Q4',
                        iphone: 15083,
                        ipad: 8977,
                        itouch: 5185
                    },
                    {
                        period: '2017 Q1',
                        iphone: 10697,
                        ipad: 4470,
                        itouch: 2038
                    },

                ],
                lineColors: ['#eb6f6f', '#926383', '#eb6f6f'],
                xkey: 'period',
                redraw: true,
                ykeys: ['iphone', 'ipad', 'itouch'],
                labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });


        });
    </script>


    // calendar
    <script type="text/javascript" src="js/monthly.js"></script>
    <script type="text/javascript">
        $(window).load(function() {

            $('#mycalendar').monthly({
                mode: 'event',

            });

            $('#mycalendar2').monthly({
                mode: 'picker',
                target: '#mytarget',
                setWidth: '250px',
                startHidden: true,
                showTrigger: '#mytarget',
                stylePast: true,
                disablePast: true
            });

            switch (window.location.protocol) {
                case 'http:':
                case 'https:':
                    // running on a server, should be good.
                    break;
                case 'file:':
                    alert('Just a heads-up, events will not work when run locally.');
            }

        });
    </script>
    //calendar
</body>

</html>
