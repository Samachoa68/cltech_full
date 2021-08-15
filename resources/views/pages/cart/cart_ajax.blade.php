
@extends('layout')
@section('content')

<!-- <div class="product-details"> --><!--product-cart-->
	

	<section id="cart_items">
		<div class="container-fluid">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
					<li><a href="{{URL::to('/')}}">Trang chủ</a></li>
					<li class="active">Giỏ hàng</li>
				</ol>
			</div>

			@if(session()->has('message'))
			<div class="alert alert-success">
				{!!session()->get('message')!!}
			</div>
			@elseif(session()->has('error'))
			<div class="alert alert-danger">
				{!!session()->get('error')!!}
			</div>
			@endif


			<div class="table-responsive cart_info">
				<form action="{{url('/update-qty-cart')}}" method="POST" >
					{{csrf_field()}}				

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

							@if(Session::get('cart')==true)					

							@php
							$total = 0;
							@endphp

							@foreach( Session::get('cart') as $key => $v_cart)
							@php
							$subtotal = $v_cart['product_price'] * $v_cart['product_qty'];
							$total += $subtotal;
							@endphp

							<tr>
								<td class="cart_product">
									<img src="{{URL::to('upload/product/'.$v_cart['product_image'])}}" alt="" width="60" alt="{{$v_cart['product_name']}}" />
								</td>
								<td class="cart_product_name">
									<h4><a href=""></a></h4>
									<p>{{$v_cart['product_name']}}</p>
								</td>
								<td class="cart_price">
									<p>{{number_format($v_cart['product_price'],0,',','.')}}đ</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">					

										<input class="cart_quantity" type="mumber" min="1" name="cart_qty[{{$v_cart['session_id']}}]" size="3" value="{{$v_cart['product_qty']}}">	
								
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">{{number_format($subtotal,0,',','.')}}đ</p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" href="{{url('/delete-product-cart/'.$v_cart['session_id'])}}"><i class="fa fa-times"></i></a>
								</td>
							</tr>

							@endforeach

							@else 
							<tr>
								<td colspan="5"><center>
									@php 
									echo 'Làm ơn thêm sản phẩm vào giỏ hàng';
									@endphp
								</center></td>
							</tr>
							@endif



						</tbody>
					</table>
					<input class="btn btn-default check_out" type="submit" value="Cập nhật số lượng" name="update_qty" class="btn btn-default btn-sm"></button>

					<a class="btn btn-default check_out" href="{{URL::to('/delete-all-product-cart')}}">Xóa hết giỏ hàng</a> 

				</form>
			</div>
			
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container-fluid">
			
			<div class="row">

				<div class="col-sm-6">

					@if(Session::get('cart')==true)

					<form action="{{URL('/check-coupon')}}" method="POST" >
						@csrf

						<div class="field-input-wrapper">
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
						</div><br>

					</form>
					
					<div class="total_area">
						@if(Session::get('coupon'))
						@foreach(Session::get('coupon') as $key => $cou)
						<ul>
							<li>Tổng tiền<span>{{number_format($total,0,',','.')}}đ</span></li>
							<li>Thuế <span>0</span></li>
							<li>Phí vận chuyển <span>Free</span></li>

							@if($cou['coupon_condition']==1)						

							@php
							$total_coupon = ($total*$cou['coupon_number'])/100;
							@endphp

							<li>Mã giảm <span>{{$cou['coupon_number']}} %</span></li>
							<li>Thành tiền <span>{{number_format($total-$total_coupon,0,',','.')}}đ</span></li>

							@elseif($cou['coupon_condition']==2)
							@php 

							$total_coupon = $total - $cou['coupon_number'];
							@endphp
							<li>Mã giảm <span>{{number_format($cou['coupon_number'],0,',','.')}} k</span></li>
							<li>Thành tiền <span>{{number_format($total-$total_coupon,0,',','.')}}đ</span></li>
							@endif

						</ul>
						@endforeach
						@else

						<ul>
							<li>Tổng tiền<span>{{number_format($total,0,',','.')}}đ</span></li>
							<li>Mã giảm <span></span></li>
							<li>Thuế <span>0</span></li>
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Thành tiền <span>{{number_format($total,0,',','.')}}đ</span></li>
						</ul>

						@endif
						<!-- <a class="btn btn-default update" href="">Update</a> -->

						<?php
						$customer_id = Session::get('customer_id');
						if ($customer_id != Null) { ?>
							<a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Đặt hàng</a>

						<?php }else{ ?>
							<a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Đặt hàng</a>
						<?php      }       ?>

					</div>

					@endif
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
	<!-- </div> --><!--/product-cart-->

	@endsection