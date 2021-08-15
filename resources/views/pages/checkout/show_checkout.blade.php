@extends('layout')
@section('content')

    <section id="cart_items">
        <div class="container-fluid">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div>
            <!--/breadcrums-->

            <div class="table-responsive cart_info">
                <form action="{{ url('/update-qty-cart') }}" method="POST">
                    {{ csrf_field() }}

                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">Hình ảnh</td>
                                <td class="description">Tên sản phẩm</td>
                                <td class="price">Giá sản phẩm</td>
                                <td class="quantity">Số lượng</td>
                                <td class="total">Thành tiền</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>

                            @if (Session::get('cart') == true)

                                @php
                                    $total = 0;
                                @endphp

                                @foreach (Session::get('cart') as $key => $v_cart)
                                    @php
                                        $subtotal = $v_cart['product_price'] * $v_cart['product_qty'];
                                        $total += $subtotal;
                                    @endphp

                                    <tr>
                                        <td class="cart_product">
                                            <img src="{{ URL::to('upload/product/' . $v_cart['product_image']) }}" alt=""
                                                width="60" alt="{{ $v_cart['product_name'] }}" />
                                        </td>
                                        <td class="cart_product_name">
                                            <h4><a href=""></a></h4>
                                            <p>{{ $v_cart['product_name'] }}</p>
                                        </td>
                                        <td class="cart_price">
                                            <p>{{ number_format($v_cart['product_price'], 0, ',', '.') }}đ</p>
                                        </td>
                                        <td class="cart_quantity">
                                            <div class="cart_quantity_button">

                                                <input class="cart_quantity" type="mumber" min="1"
                                                    name="cart_qty[{{ $v_cart['session_id'] }}]" autocomplete="off"
                                                    size="2" value="{{ $v_cart['product_qty'] }}">
                                            </div>
                                        </td>
                                        <td class="cart_total">
                                            <p class="cart_total_price">{{ number_format($subtotal, 0, ',', '.') }}đ</p>
                                        </td>
                                        <td class="cart_delete">
                                            <a class="cart_quantity_delete"
                                                href="{{ url('/delete-product-cart/' . $v_cart['session_id']) }}"><i
                                                    class="fa fa-times"></i></a>
                                        </td>
                                    </tr>

                                @endforeach

                            @else
                                <tr>
                                    <td colspan="5">
                                        <center>
                                            @php
                                                echo 'Làm ơn thêm sản phẩm vào giỏ hàng';
                                            @endphp
                                        </center>
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                    <input class="btn btn-default check_out" type="submit" value="Cập nhật số lượng" name="update_qty"
                        class="btn btn-default btn-sm"></button>

                    <a class="btn btn-default check_out" href="{{ URL::to('/delete-all-product-cart') }}">Xóa hết giỏ
                        hàng</a>

                </form>
            </div>

            <div class="register-req">
                <p>Vui lòng đăng ký hoặc đăng nhập để thanh toán đơn hàng và xem lại lịch sử mua hàng </p>
            </div>
            <!--/register-req-->



            <form>
                <!--Delivery-->
                @csrf
                <div class="form-group">
                    <label for="exampleInputPassword1">Chọn tỉnh thành phố</label>
                    <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                        <option value="">---Chọn---</option>
                        @foreach ($city as $key => $v_city)
                            <option value="{{ $v_city->matp }}">{{ $v_city->name_thanhpho }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Chọn quận huyện</label>
                    <select name="province" id="province" class="form-control input-sm m-bot15 choose province">
                        <option value="">---Chọn quận huyện---</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Chọn xã phường</label>
                    <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                        <option value="">---Chọn xã phường---</option>
                    </select>
                </div>

                <button type="button" class="btn btn-info calculate_delivery" name="calculate_fee">Tính phí vận
                    chuyển</button>

                <a class="cart_quantity_delete" href="{{ url('/del-fee') }}"><i class="fa fa-times">Chọn lại vận
                        chuyển</i></a>

            </form>
            <!--Delivery-->

            <!--Cart-->

			<br>
            <section id="do_action">
                <div class="container-fluid">

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="field-input-wrapper">

                            @if (Session::get('cart') == true)

                                <form action="{{ URL('/check-coupon') }}" method="POST">
                                    @csrf                                   

                                        <label class="field-label" for="discount.code">Mã giảm giá: </label>
                                        @if (Session::get('coupon'))
                                            @foreach (Session::get('coupon') as $key => $cou)
                                                <input placeholder="{{ $cou['coupon_code'] }}" type="text" name="coupon"
                                                    value="">
                                            @endforeach
                                            <a class="btn btn-default check_out"
                                                href="{{ URL::to('/unset-coupon') }}">Xóa mã</a>
                                        @else
                                            <input placeholder="Nhập mã" size="20" type="text" name="coupon" value="">
                                            <button type="submit" class="field-input-btn btn btn-default"
                                                name="check_coupon">
                                                <span class="btn-content">Sử dụng</span>
                                                <i class="btn-spinner icon icon-button-spinner"></i>
                                            </button>

                                        @endif                                   

                                </form>
                            </div>

                                {{-- <div class="total_area">
                                    @if (Session::get('coupon'))
                                        @foreach (Session::get('coupon') as $key => $cou)
                                            <ul>
                                                <li>Tổng tiền<span>{{ number_format($total, 0, ',', '.') }}đ</span></li>
                                                <li>Thuế <span>0</span></li>
                                                <li>Phí vận chuyển
                                                    <span>{{ number_format(Session::get('fee'), 0, ',', '.') }}đ</span>
                                                </li>

                                                @if ($cou['coupon_condition'] == 1)

                                                    @php
                                                        $total_coupon = ($total * $cou['coupon_number']) / 100;
                                                    @endphp

                                                    <li>Mã giảm <span>{{ $cou['coupon_number'] }} %</span></li>
                                                    <li>Thành tiền
                                                        <span>{{ number_format($total - $total_coupon - Session::get('fee'), 0, ',', '.') }}đ</span>
                                                    </li>

                                                @elseif($cou['coupon_condition']==2)
                                                    @php
                                                        
                                                        $total_coupon = $total - $cou['coupon_number'];
                                                    @endphp
                                                    <li>Mã giảm
                                                        <span>{{ number_format($cou['coupon_number'], 0, ',', '.') }}
                                                            k</span>
                                                    </li>
                                                    <li>Thành tiền
                                                        <span>{{ number_format($total_coupon - Session::get('fee'), 0, ',', '.') }}đ</span>
                                                    </li>
                                                @endif

                                            </ul>
                                        @endforeach
                                    @else

                                        <ul>
                                            <li>Tổng tiền<span>{{ number_format($total, 0, ',', '.') }}đ</span></li>
                                            <li>Mã giảm <span></span></li>
                                            <li>Thuế <span>0</span></li>
                                            <li>Phí vận chuyển
                                                <span>{{ number_format(Session::get('fee'), 0, ',', '.') }}đ</span>
                                            </li>
                                            <li>Thành tiền
                                                <span>{{ number_format($total - Session::get('fee'), 0, ',', '.') }}đ</span>
                                            </li>
                                        </ul>

                                    @endif
                                    <!-- <a class="btn btn-default update" href="">Update</a> -->

                                    @if (Session::get('customer_id') != null)
                                        <a class="btn btn-default check_out" href="{{ URL::to('/checkout') }}">Đặt
                                            hàng</a>

                                    @else
                                        <a class="btn btn-default check_out" href="{{ URL::to('/login-checkout') }}">Đặt
                                            hàng</a>
                                    @endif

                                </div> --}}
                            @endif

                        </div>
                    </div>
                </div>
            </section>
            <div class="shopper-informations">
                <div class="row">

                    <div class="col-sm-12 clearfix">
                        <div class="bill-to">
                            <p>Điền thông tin nhận hàng</p>
                            <div class="form-one">
                                <form method="POST">
                                    @csrf
                                    <input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên">
                                    <input type="text" name="shipping_email" class="shipping_email" placeholder="Email">
                                    <input type="text" name="shipping_phone" class="shipping_phone"
                                        placeholder="Số điện thoại">
                                    <input type="text" name="shipping_address" class="shipping_address"
                                        placeholder="Địa chỉ">
                                    <div class="order-message">
                                        <p>Ghi chú đơn hàng</p>
                                        <textarea name="shipping_notes" class="shipping_notes"
                                            placeholder="Ghi chú đơn hàng của bạn" rows="2"></textarea>
                                    </div>

                                    @if (Session::get('fee'))
                                        <input type="hidden" name="order_fee" class="order_fee"
                                            value="{{ Session::get('fee') }}">
                                    @else
                                        <input type="hidden" name="order_fee" class="order_fee" value="10000">
                                    @endif

                                    @if (Session::get('coupon'))
                                        @foreach (Session::get('coupon') as $key => $v_coupon)
                                            <input type="hidden" name="order_coupon" class="order_coupon"
                                                value="{{ $v_coupon['coupon_code'] }}">
                                        @endforeach
                                    @else
                                        <input type="hidden" name="order_coupon" class="order_coupon" value="no">
                                    @endif
                                    <div class="review-payment">
                                        <h2>Review & Payment</h2>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Chọn phương thức thanh toán</label>
                                        <select name="payment_select" class="form-control input-sm m-bot15 payment_select">
                                            <option value="0">Qua chuyển khoản</option>
                                            <option value="1">Tiền mặt</option>
                                        </select>
                                    </div>

                                    <div class="total_area">
                                        @if (Session::get('coupon'))
                                            @foreach (Session::get('coupon') as $key => $cou)
                                                <ul>
                                                    <li>Tổng tiền<span>{{ number_format($total, 0, ',', '.') }}đ</span>
                                                    </li>
                                                    <li>Thuế <span>0</span></li>
                                                    <li>Phí vận chuyển
                                                        <span>{{ number_format(Session::get('fee'), 0, ',', '.') }}đ</span>
                                                    </li>

                                                    @if ($cou['coupon_condition'] == 1)

                                                        @php
                                                            $total_coupon = ($total * $cou['coupon_number']) / 100;
                                                        @endphp

                                                        <li>Mã giảm <span>{{ $cou['coupon_number'] }} %</span></li>
                                                        <li>Thành tiền
                                                            <span>{{ number_format($total - $total_coupon - Session::get('fee'), 0, ',', '.') }}đ</span>
                                                        </li>

                                                    @elseif($cou['coupon_condition']==2)
                                                        @php
                                                            
                                                            $total_coupon = $total - $cou['coupon_number'];
                                                        @endphp
                                                        <li>Mã giảm giá ({{$cou['coupon_code']}})
                                                            <span>{{ number_format($cou['coupon_number'], 0, ',', '.') }}
                                                                đ</span>
                                                        </li>
                                                        <li>Thành tiền
                                                            <span>{{ number_format($total_coupon - Session::get('fee'), 0, ',', '.') }}đ</span>
                                                        </li>
                                                    @endif

                                                </ul>
                                            @endforeach
                                        @else

                                            <ul>
                                                <li>Tổng tiền<span>{{ number_format($total, 0, ',', '.') }}đ</span></li>
                                                <li>Mã giảm <span></span></li>
                                                <li>Thuế <span>0</span></li>
                                                <li>Phí vận chuyển
                                                    <span>{{ number_format(Session::get('fee'), 0, ',', '.') }}đ</span>
                                                </li>
                                                @php
                                                    $total_final = ($total - Session::get('fee'));
                                                @endphp
                                                <input type="hidden" name="total_final" class="total_final"
                                                value="{{ $total_final }}">

                                                <li>Thành tiền
                                                    <span>{{ number_format($total - Session::get('fee'), 0, ',', '.') }}đ</span>
                                                </li>
                                            </ul>

                                        @endif
                                        <!-- <a class="btn btn-default update" href="">Update</a> -->

                                    </div>

                                    <input type="button" value="Hoàn tất đơn hàng" name="send_order"
                                        class="btn btn-primary btn-sm send_order"></button>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>
    <!--/#cart_items-->
@endsection
