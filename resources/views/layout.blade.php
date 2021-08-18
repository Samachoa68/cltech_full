<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--  SEO -->

    <title>{{ $meta_title }}</title>
    <meta name="description" content="{{ $meta_desc }}" />
    <meta name="keywords" content="{{ $meta_keywords }}" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <link rel="canonical" href="{{ $url_canonical }}">
    <meta name="author" content="" />
    <link rel="icon" href="frontend/images/home/logoweb.jpg" type="image/x-icon" />

    <!-- SEO -->

    <meta property="og:site_name" content="/" />
    <meta property="og:description" content="{{ $meta_desc }}" />
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:url" content="{{ $url_canonical }}" />
    <meta property="og:type" content="website" />


    <!------------Share fb------------------>

    <meta property="og:url" content="{{ $url_canonical }}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_desc }}" />
    <meta property="og:image" content="{{ $share_image }}" />

    <!--//-------Seo--------->

    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/sweetalert.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/css/vlite.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/css/lightslider.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettify.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/lightgallery.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/jquery-ui.min.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
<![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>
<!--/head-->

<body>
    <header id="header">
        <!--header-->
        <div class="header_top">
            <!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +84 939 598 268</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> lamgiatechnology@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header_top-->


        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="index.html"><img src="frontend/images/home/logoweb.jpg" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                    data-toggle="dropdown">
                                    USA
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canada</a></li>
                                    <li><a href="#">UK</a></li>
                                </ul>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                    data-toggle="dropdown">
                                    DOLLAR
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canadian Dollar</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="{{ URL::to('login-checkout') }}"><i class="fa fa-user"></i> Tài
                                        khoản</a>
                                </li>
                                <li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>

                                <?php
                                $customer_id = Session::get('customer_id');
                                $shipping_id = Session::get('shipping_id');

                                if ($customer_id != null && $shipping_id != null) { ?>
                                <li><a href="{{ URL::to('/payment') }}"><i class="fa fa-crosshairs"></i> Thanh
                                        toán</a>
                                </li>

                                <?php } elseif ($customer_id != null && $shipping_id == null) { ?>
                                <li><a href="{{ URL::to('/checkout') }}"><i class="fa fa-lock"></i> Thanh toán</a>
                                </li>

                                <?php } else { ?>
                                <li><a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-lock"></i> Thanh
                                        toán</a></li>
                                <?php }
                                ?>


                                <li><a href="{{ URL::to('cart') }}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a>
                                </li>

                                <?php
                                $customer_id = Session::get('customer_id');
                                
                                if ($customer_id != null) { ?>

                                <li><a href="{{ URL::to('history') }}"><i class="fa fa-history"></i>History</a>
                                </li>

                                <li><img width="15%" src="{{ Session::get('customer_picture') }}">
                                    {{ Session::get('customer_name') }}
                                    <a href="{{ URL::to('login-checkout') }}"><i class="fa fa-lock"></i> Đăng
                                        xuất</a>
                                </li>

                                <?php } else { ?>
                                <li><a href="{{ URL::to('login-checkout') }}"><i class="fa fa-lock"></i> Đăng
                                        nhập</a>
                                </li>
                                <?php }
                                ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom">
            <!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ URL::to('/trang-chu') }}" class="active">Trang Chủ</a></li>
                                <li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach ($cate_product as $key => $v_cate_pro)
                                            @if ($v_cate_pro->category_parent == 0)
                                                <li><a
                                                        href="{{ URL::to('/danh-muc-san-pham/' . $v_cate_pro->slug_category_product) }}">{{ $v_cate_pro->category_name }}</a>
                                                    @foreach ($cate_product as $key => $sub_cate_pro)
                                                        @if ($sub_cate_pro->category_parent == $v_cate_pro->category_id)
                                                            <ul>
                                                                <li><a
                                                                        href="{{ URL::to('/danh-muc-san-pham/' . $sub_cate_pro->slug_category_product) }}">{{ $sub_cate_pro->category_name }}</a>
                                                                </li>
                                                            </ul>
                                                        @endif
                                                    @endforeach
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach ($all_category_post as $key => $v_cate_post)
                                            <li><a
                                                    href="{{ URL::to('/danh-muc-bai-viet/' . $v_cate_post->cate_post_slug) }}">{{ $v_cate_post->cate_post_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="404.html">Giỏ hàng</a></li>
                                <li><a href="{{ URL::to('/show-video') }}">Video</a></li>
                                <li><a href="{{ URL::to('/contact') }}">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <form action="{{ URL::to('/search') }}" autocomplete="off" method="POST">
                            @csrf

                            <div class="search_product">
                                <input type="text" style="width: 100%" name="keywords_submit" id="keywords"
                                    placeholder="Tìm kiếm sản phẩm">
                                <div id="search_ajax"></div>
                                <input type="submit" style="margin-top: 0" name="search_items"
                                    class="btn btn-primary btn-sm" value="Search">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->


    <section id="slider">
        <!--slider-->
        @yield('slider')
    </section>
    <!--/slider-->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh mục sản phẩm</h2>
                        <div class="panel-group category-products" id="accordian">
                            <!--category-productsr-->

                            @foreach ($cate_product as $key => $cate_pro)


                                <div class="panel panel-default">
                                    @if ($cate_pro->category_parent == 0)
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordian"
                                                    href="#{{ $cate_pro->slug_category_product }}">
                                                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                                    <a
                                                        href="{{ URL::to('danh-muc-san-pham/' . $cate_pro->slug_category_product) }}">{{ $cate_pro->category_name }}</a>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="{{ $cate_pro->slug_category_product }}"
                                            class="panel-collapse collapse">
                                            <div class="panel-body">

                                                @foreach ($cate_product as $key => $v_category)
                                                    <ul>
                                                        @if ($v_category->category_parent == $cate_pro->category_id)

                                                            <li><a
                                                                    href="{{ URL::to('danh-muc-san-pham/' . $v_category->slug_category_product) }}">{{ $v_category->category_name }}</a>
                                                            </li>

                                                        @endif
                                                    </ul>
                                                @endforeach


                                            </div>
                                        </div>
                                    @endif
                                </div>


                            @endforeach

                        </div>
                        <!--/category-products-->

                        <div class="brands_products">
                            <!--brands_products-->
                            <h2>Thương hiệu</h2>
                            <div class="brands-name">

                                <ul class="nav nav-pills nav-stacked">
                                    @foreach ($brand_product as $key => $brand_pro)
                                        <li><a
                                                href="{{ URL::to('thuong-hieu-san-pham/' . $brand_pro->brand_slug) }}">
                                                <span class="pull-right">(50)</span>{{ $brand_pro->brand_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                        <!--/brands_products-->

                        <div class="price-range">
                            <!--price-range-->
                            <h2>Price Range</h2>
                            <div class="well text-center">
                                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600"
                                    data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br />
                                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div>
                        <!--/price-range-->

                        <div class="brands_products">
                            <h2>Sản phẩm đã xem</h2>
                            <div class="brands-name ">
                                <div id="row_viewed" class="row">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="brands_products">
                            <h2>Sản phẩm yêu thích</h2>
                            <div class="brands-name ">
                                <div id="row_wishlist" class="row">
                                </div>
                            </div>
                        </div>

                        <div class="shipping text-center">
                            <!--shipping-->
                            <img src="images/home/shipping.jpg" alt="" />
                        </div>
                        <!--/shipping-->

                    </div>
                </div>

                <div class="col-sm-9 padding-right">

                    @yield('content')


                </div>
            </div>
        </div>
    </section>

    <footer id="footer">
        <!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>e</span>-shopper</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="images/home/iframe1.png" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="images/home/map.png" alt="" />
                            <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Quock Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">T-Shirt</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Womens</a></li>
                                <li><a href="#">Gift Cards</a></li>
                                <li><a href="#">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privecy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>
                                <li><a href="#">Billing System</a></li>
                                <li><a href="#">Ticket System</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Company Information</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Affillate Program</a></li>
                                <li><a href="#">Copyright</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2021 LamGia. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank" href="">Samachoa</a></span></p>
                </div>
            </div>
        </div>

    </footer>
    <!--/Footer-->



    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{ asset('frontend/js/sweetalert.min.js') }}"></script>

    <script src="{{ asset('frontend/js/vlite.js') }}"></script>
    <script src="{{ asset('frontend/js/youtube.js') }}"></script>

    <script src="{{ asset('frontend/js/lightslider.js') }}"></script>
    <script src="{{ asset('frontend/js/lightgallery-all.min.js') }}"></script>
    <script src="{{ asset('frontend/js/prettify.js') }}"></script>

    <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/js/simple.money.format.js') }}"></script>


    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        var usd = document.getElementById("vnd_to_usd").value;
        paypal.Button.render({
            // Configure environment
            env: 'sandbox',
            client: {
                sandbox: 'AZQIDGONDPckdpt6vvTf6DeU8WhOnGo13yP14wGUl9UrJC4JmJYyw5rg0eisjnvRHsmEjf19FqQHznPR',
                production: 'demo_production_client_id'
            },
            // Customize button (optional)
            locale: 'en_US',
            style: {
                size: 'small',
                color: 'gold',
                shape: 'pill',
            },

            // Enable Pay Now checkout flow (optional)
            commit: true,

            // Set up a payment
            payment: function(data, actions) {
                return actions.payment.create({
                    transactions: [{
                        amount: {
                            total: `${usd}`,
                            currency: 'USD'
                        }
                    }]
                });
            },
            // Execute the payment
            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function() {
                    // Show a confirmation message to the buyer
                    window.alert('Cảm ơn, Bạn đã thanh toán đơn hàng thành công!');
                });
            }
        }, '#paypal-button');
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery: true,
                item: 1,
                loop: true,
                thumbItem: 3,
                slideMargin: 0,
                enableDrag: false,
                currentPagerPosition: 'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }
            });
        });
    </script>

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0"
        nonce="KE5XKvUX"></script>


    <script>
        $(document).ready(function() {
            $("#slider-range").slider({
                range: true,

                min: 0,
                max: {{ $max_price_range }},

                steps: 10000,
                values: [{{ $min_price_range }}, {{ $max_price }}],

                slide: function(event, ui) {
                    $("#amount").val(ui.values[0]).simpleMoneyFormat() + "VND";
                    $("#amount1").val(ui.values[1]).simpleMoneyFormat() + "VND";
                    $("#start_price").val(ui.values[0]);
                    $("#end_price").val(ui.values[1]);
                }
            });
            $("#amount").val($("#slider-range").slider("values", 0)).simpleMoneyFormat() + "VND";
            $("#amount1").val($("#slider-range").slider("values", 1)).simpleMoneyFormat();
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#sort').on('change', function() {
                var url = $(this).val();
                if (url) {
                    window.location = url;
                } else {
                    return false;
                }
            });
        });
    </script>

    <script>
        function delete_compare(id) {
            if (localStorage.getItem('compare') != null) {
                var data = JSON.parse(localStorage.getItem('compare'));
                var index = data.findIndex(item => item.id === id);
                data.splice(index, 1);
                localStorage.setItem('compare', JSON.stringify(data));
                //Remove element by id
                document.getElementById('row_compare' + id).remove();
            }
        }
        compare();

        function compare() {
            if (localStorage.getItem('compare') != null) {
                var data = JSON.parse(localStorage.getItem('compare'));                

                for (i = 0; i < data.length; i++) {
                    var name = data[i].name;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url = data[i].url;
                    var id = data[i].id;

                    $('#row_compare').find('tbody').append(`
                    <tr id="row_compare` + id + `">                 
                    <td>` + name + `</td>
                    <td>` + price + `</td>
                    <td><img width="200px" src="` + image + `" alt=""></td>
                    <td><a href="` + url + `">Xem</a></td>
                    <td><a style="cursor: pointer" onclick="delete_compare(` + id + `)">Xóa</a></td>
                  </tr>
                `);
                }
            }
        }

        function add_compare(product_id) {
            document.getElementById('compare_text').innerText = ("Chỉ so sánh 3 sản phẩm");
            var id = product_id;
            var name = document.getElementById('wishlist_productname' + id).value;
            var price = document.getElementById('wishlist_productprice' + id).value;
            var image = document.getElementById('wishlist_productimage' + id).src;
            var url = document.getElementById('wishlist_producturl' + id).href;

            var newItem = {
                'url': url,
                'id': id,
                'name': name,
                'price': price,
                'image': image
            }

            if (localStorage.getItem('compare') == null) {
                localStorage.setItem('compare', '[]');
            }

            var old_data = JSON.parse(localStorage.getItem('compare'));

            var matches = $.grep(old_data, function(obj) {
                return obj.id == id;
            })

            if (matches.length) {
            } else {

                if (old_data.length <= 3) {
                    old_data.push(newItem);

                    $('#row_compare').find('tbody').append(`
                    <tr id="row_compare` + id + `">                 
                    <td>` + newItem.name + `</td>
                    <td>` + newItem.price + `</td>
                    <td><img width="200px" src="` + newItem.image + `" alt=""></td>
                    <td><a href="` + url + `">Xem</a></td>
                    <td><a style="cursor: pointer" onclick="delete_compare(` + id + `)">Xóa</a></td>
                  </tr>
                `);

                }

            }

            localStorage.setItem('compare', JSON.stringify(old_data));
            $('#compare').modal();
        }
    </script>

    <script type="text/javascript">
        function viewed() {
            if (localStorage.getItem('viewed') != null) {
                var data = JSON.parse(localStorage.getItem('viewed'));
                data.reverse();
                document.getElementById('row_viewed').style.overflow = 'scroll';
                document.getElementById('row_viewed').style.height = '500px';

                for (i = 0; i < data.length; i++) {
                    var name = data[i].name;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url = data[i].url;

                    $('#row_viewed').append(
                        '<div class="row" style="margin:10px 0"><div class="col-md-4"><img width="100%" src="' +
                        image + '"></div><div class="col-md-8 info_wishlist"><p>' + name +
                        '</p><p style="color:#FE980F">' + price + '</p><a href="' + url + '">Đặt hàng</a></div>');
                }

            }

        }

        viewed();

        product_viewed();

        function product_viewed(clicked_id) {
            var id_product = $('#viewed_product_id').val();
            if (id_product != undefined) {
                var id = id_product;
                var name = document.getElementById('viewed_productname' + id).value;
                var price = document.getElementById('viewed_productprice' + id).value;
                var image = document.getElementById('viewed_productimage' + id).value;
                var url = document.getElementById('viewed_producturl' + id).value;

                var newItem = {
                    'url': url,
                    'id': id,
                    'name': name,
                    'price': price,
                    'image': image
                }

                if (localStorage.getItem('viewed') == null) {
                    localStorage.setItem('viewed', '[]');
                }

                var old_data = JSON.parse(localStorage.getItem('viewed'));

                var matches = $.grep(old_data, function(obj) {
                    return obj.id == id;
                })

                if (matches.length) {


                } else {

                    old_data.push(newItem);

                    $('#row_viewed').append(
                        '<div class="row" style="margin:10px 0"><div class="col-md-4"><img width="100%" src="' + newItem
                        .image + '"></div><div class="col-md-8 info_wishlist"><p>' + newItem.name +
                        '</p><p style="color:#FE980F">' + newItem.price + '</p><a href="' + newItem.url +
                        '">Xem ngay</a></div>');

                }

                localStorage.setItem('viewed', JSON.stringify(old_data));

            }

        }
    </script>
    <script type="text/javascript">
        function view() {
            if (localStorage.getItem('data') != null) {

                var data = JSON.parse(localStorage.getItem('data'));

                data.reverse();

                document.getElementById('row_wishlist').style.overflow = 'scroll';
                document.getElementById('row_wishlist').style.height = '500px';

                for (i = 0; i < data.length; i++) {

                    var name = data[i].name;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url = data[i].url;

                    $('#row_wishlist').append(
                        '<div class="row" style="margin:10px 0"><div class="col-md-4"><img width="100%" src="' +
                        image + '"></div><div class="col-md-8 info_wishlist"><p>' + name +
                        '</p><p style="color:#FE980F">' + price + '</p><a href="' + url + '">Đặt hàng</a></div>');
                }

            }

        }

        view();


        function add_wistlist(clicked_id) {

            var id = clicked_id;
            var name = document.getElementById('wishlist_productname' + id).value;
            var price = document.getElementById('wishlist_productprice' + id).value;
            var image = document.getElementById('wishlist_productimage' + id).src;
            var url = document.getElementById('wishlist_producturl' + id).href;

            var newItem = {
                'url': url,
                'id': id,
                'name': name,
                'price': price,
                'image': image
            }

            if (localStorage.getItem('data') == null) {
                localStorage.setItem('data', '[]');
            }

            var old_data = JSON.parse(localStorage.getItem('data'));

            var matches = $.grep(old_data, function(obj) {
                return obj.id == id;
            })

            if (matches.length) {
                alert('Sản phẩm bạn đã yêu thích,nên không thể thêm');

            } else {

                old_data.push(newItem);

                $('#row_wishlist').append(
                    '<div class="row" style="margin:10px 0"><div class="col-md-4"><img width="100%" src="' + newItem
                    .image + '"></div><div class="col-md-8 info_wishlist"><p>' + newItem.name +
                    '</p><p style="color:#FE980F">' + newItem.price + '</p><a href="' + newItem.url +
                    '">Đặt hàng</a></div>');

            }

            localStorage.setItem('data', JSON.stringify(old_data));


        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            var cate_id = $('.tabs_pro').data('id');
            var _token = $('input[name="_token"]').val();
            //alert(cate_id);
            $.ajax({
                url: '{{ url('/product-tabs') }}',
                method: "POST",
                data: {
                    cate_id: cate_id,
                    _token: _token
                },
                success: function(data) {
                    $('#tabs_product').html(data);
                }

            });

            $('.tabs_pro').click(function() {

                var cate_id = $(this).data('id');
                // alert(cate_id);
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/product-tabs') }}',
                    method: "POST",
                    data: {
                        cate_id: cate_id,
                        _token: _token
                    },

                    success: function(data) {
                        $('#tabs_product').html(data);
                    }

                });

            });

        });
    </script>

    <script type="text/javascript">
        $('.xemnhanh').click(function() {
            var pro_id = $(this).data('id_product');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/product-quickview') }}",
                method: "POST",
                dataType: "JSON",
                data: {
                    pro_id: pro_id,
                    _token: _token
                },
                success: function(data) {
                    $('#product_quickview_title').html(data.product_name);
                    $('#product_quickview_id').html(data.product_id);
                    $('#product_quickview_price').html(data.product_price);
                    $('#product_quickview_image').html(data.product_image);
                    $('#product_quickview_gallery').html(data.product_gallery);
                    $('#product_quickview_desc').html(data.product_desc);
                    $('#product_quickview_content').html(data.product_content);
                    $('#product_quickview_value').html(data.product_quickview_value);
                    $('#product_quickview_button').html(data.product_button);
                }
            });

        });
    </script>

    <script>
        function remove_background(product_id) {
            for (var count = 1; count <= 5; count++) {
                $('#' + product_id + '-' + count).css('color', '#ccc');
            }
        }
        //hover chuột đánh giá sao
        $(document).on('mouseenter', '.rating', function() {
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
            // alert(index);
            // alert(product_id);
            remove_background(product_id);
            for (var count = 1; count <= index; count++) {
                $('#' + product_id + '-' + count).css('color', '#ffcc00');
            }
        });

        //nhả chuột ko đánh giá
        $(document).on('mouseleave', '.rating', function() {
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
            var rating = $(this).data("rating");
            remove_background(product_id);
            //alert(rating);
            for (var count = 1; count <= rating; count++) {
                $('#' + product_id + '-' + count).css('color', '#ffcc00');
            }
        });

        //click đánh giá sao
        $(document).on('click', '.rating', function() {
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('insert-rating') }}",
                method: "POST",
                data: {
                    index: index,
                    product_id: product_id,
                    _token: _token
                },
                success: function(data) {
                    if (data == 'done') {
                        alert("Bạn đã đánh giá " + index + " trên 5");
                    } else {
                        alert("Lỗi đánh giá");
                    }
                }
            });

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            comment_load();

            function comment_load() {
                var product_id = $('.comment-product-id').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{ url('/load-comment') }}',
                    method: 'POST',
                    data: {
                        product_id: product_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#comment_show').html(data);
                    }
                });
            };
            $('.send-comment').click(function() {
                var comment_name = $('.comment_name').val();
                var comment = $('.comment').val();
                var product_id = $('.comment-product-id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/insert-comment') }}',
                    method: 'POST',
                    data: {
                        product_id: product_id,
                        _token: _token,
                        comment: comment,
                        comment_name: comment_name
                    },
                    success: function(data) {
                        comment_load();
                        $('#notify_comment_send').html(
                            '<span class="text text-success"> Bình luận đang chờ duyệt</span>'
                        );
                        $('.comment_name').val('');
                        $('.comment').val('');
                        $('#notify_comment_send').fadeOut(9000);
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $('#keywords').keyup(function() {
            var query = $(this).val();
            if (query != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/autocomplete-ajax') }}',
                    method: 'POST',
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function(data) {
                        $('#search_ajax').fadeIn();
                        $('#search_ajax').html(data);
                    }
                });
            } else {
                $('#search_ajax').fadeOut();
            }
        });

        $(document).on('click', '.li_search_ajax', function() {
            $('#keywords').val($(this).text());
            $('#search_ajax').fadeOut();
        });
    </script>

    <script type="text/javascript">
        $(document).on('click', '.watch_video', function() {

            var video_id = $(this).attr('id');
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{ url('/watch-video') }}",
                method: "POST",
                dataType: "JSON",
                data: {
                    video_id: video_id,
                    _token: _token
                },
                success: function(data) {

                    $('#video_title').html(data.video_title);
                    $('#video_link').html(data.video_link);
                    var playerYT = new vlitejs({
                        selector: '#my_yt_video',
                        options: {
                            // auto play
                            autoplay: false,

                            // enable controls
                            controls: true,

                            // enables play/pause buttons
                            playPause: true,

                            // shows progress bar
                            progressBar: true,

                            // shows time
                            time: true,

                            // shows volume control
                            volume: true,

                            // shows fullscreen button
                            fullscreen: true,

                            // path to poster image
                            poster: null,

                            // shows play button
                            bigPlay: true,

                            // hide the control bar if the user is inactive
                            autoHide: false,

                            // keeps native controls for touch devices
                            nativeControlsForTouch: false
                        },
                        onReady: (player) => {
                            // callback function here
                        }
                    });

                }
            });

        });

        $("#modal_video").on('hidden.bs.modal', function(e) {
            $("#my_yt_video").attr("src", $("#my_yt_video").attr("src"));
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            $('.send_order').click(function() {

                swal({
                        title: "Bạn có chắc muốn đặt hàng?",
                        text: "Bạn sẽ không thể hủy đơn sau khi đã đặt",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Cảm ơn, đặt hàng",
                        cancelButtonText: "Không, chưa mua",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            var shipping_name = $('.shipping_name').val();
                            var shipping_email = $('.shipping_email').val();
                            var shipping_phone = $('.shipping_phone').val();
                            var shipping_address = $('.shipping_address').val();
                            var shipping_notes = $('.shipping_notes').val();
                            var shipping_method = $('.payment_select').val();
                            var order_fee = $('.order_fee').val();
                            var order_coupon = $('.order_coupon').val();
                            var total_final = $('.total_final').val();
                            var _token = $('input[name="_token"]').val();

                            $.ajax({
                                url: '{{ url('/confirm-order') }}',
                                method: 'POST',
                                data: {
                                    shipping_name: shipping_name,
                                    shipping_email: shipping_email,
                                    shipping_phone: shipping_phone,
                                    shipping_address: shipping_address,
                                    shipping_notes: shipping_notes,
                                    _token: _token,
                                    order_fee: order_fee,
                                    order_coupon: order_coupon,
                                    total_final: total_final,
                                    shipping_method: shipping_method
                                },
                                success: function() {
                                    swal("Đơn hàng", "Đặt hàng thành công", "success");
                                }
                            });

                        } else {
                            swal("Đóng", "Bạn chưa đặt hàng", "error");
                        }
                    });


            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.add-to-cart').click(function() {
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();

                if (parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
                    alert('Số lượng đặt hàng vượt quá số lượng kho (Còn ' + cart_product_quantity +
                        ')');
                } else {

                    $.ajax({
                        url: '{{ url('/add-cart-ajax') }}',
                        method: 'POST',
                        data: {
                            cart_product_id: cart_product_id,
                            cart_product_name: cart_product_name,
                            cart_product_image: cart_product_image,
                            cart_product_price: cart_product_price,
                            cart_product_qty: cart_product_qty,
                            _token: _token,
                            cart_product_quantity: cart_product_quantity
                        },
                        success: function(data) {
                            swal({
                                    title: "Đã thêm sản phẩm vào giỏ hàng",
                                    text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                    showCancelButton: true,
                                    cancelButtonText: "Xem tiếp",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Đi đến giỏ hàng",
                                    closeOnConfirm: false
                                },
                                function() {
                                    window.location.href = "{{ url('/cart') }}";
                                });

                        }
                    });
                }
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.add-to-cart-quickview', function() {
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();

                if (parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
                    alert('Số lượng đặt hàng vượt quá số lượng kho (Còn ' + cart_product_quantity +
                        ')');
                } else {

                    $.ajax({
                        url: '{{ url('/add-cart-ajax') }}',
                        method: 'POST',
                        data: {
                            cart_product_id: cart_product_id,
                            cart_product_name: cart_product_name,
                            cart_product_image: cart_product_image,
                            cart_product_price: cart_product_price,
                            cart_product_qty: cart_product_qty,
                            _token: _token,
                            cart_product_quantity: cart_product_quantity
                        },
                        beforeSend: function() {
                            $("#beforesend_quickview").html(
                                "<p class='text text-success'>Đang thêm sản phẩm vào giỏ hàng</p>"
                            );
                        },
                        success: function(data) {
                            $("#beforesend_quickview").html(
                                "<p class='text text-success'>Sản phẩm đã thêm vào giỏ hàng</p>"
                            );
                        }
                    });
                }
            });
        });

        $(document).on('click', '.redirect-cart', function() {
            window.location.href = "{{ url('/cart') }}";
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';

                if (action == 'city') {
                    result = 'province';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: '{{ url('/select-delivery-home') }}',
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
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.calculate_delivery').click(function() {

                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if (matp == '' && maqh == '' && xaid == '') {
                    alert('Làm ơn chọn để tính phí vận chuyển')
                } else {

                    $.ajax({
                        url: '{{ url('/calculate-fee') }}',
                        method: 'POST',
                        data: {
                            matp: matp,
                            maqh: maqh,
                            _token: _token,
                            xaid: xaid
                        },
                        success: function() {
                            location.reload();
                        }
                    });

                }
            });
        });
    </script>


</body>

</html>
