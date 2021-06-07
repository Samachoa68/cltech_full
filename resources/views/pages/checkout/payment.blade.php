@extends('layout')
@section('content')

<section id="cart_items">
	<div class="container-fluid">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Thanh toán giỏ hàng</li>
			</ol>
		</div><!--/breadcrums-->



		

		
		<div class="review-payment">
			<h2>Xem lại giỏ hàng</h2>
		</div>

		<div class="table-responsive cart_info">
			<?php
			$cartcontent = Cart::content();

			?>
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td class="image">Hình ảnh</td>
						<td class="description">Mô tả</td>
						<td class="price">Giá</td>
						<td class="quantity">Số lượng</td>
						<td class="total">Tổng tiền</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					@foreach($cartcontent as $v_cartcontent)
					<tr>
						<td class="cart_product">
							<a href=""><img src="{{URL::to('upload/product/'.$v_cartcontent->options->image)}}" alt="" width="50"></a>
						</td>
						<td class="cart_description">
							<h4><a href="">{{$v_cartcontent->name}}</a></h4>
							<p>ID: {{$v_cartcontent->id}}</p>
						</td>
						<td class="cart_price">
							<p>{{number_format($v_cartcontent->price).' '.'VND'}}</p>
						</td>
						<td class="cart_quantity">
							<div class="cart_quantity_button">
								<!-- <a class="cart_quantity_up" href=""> + </a> -->

								<form action="{{URL::to('/update-cart-quantity')}}" method="POST" >
									{{csrf_field()}}
									<input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_cartcontent->qty}}" autocomplete="off" size="2">
									<input class="form-control" type="hidden" name="rowId_cart" value="{{$v_cartcontent->rowId}}">
									<input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm"></button>
								</form>

								<!-- <a class="cart_quantity_down" href=""> - </a> -->
							</div>
						</td>
						<td class="cart_total">
							<p class="cart_total_price">
								<?php
								$tong = $v_cartcontent->price * $v_cartcontent->qty;
								echo number_format($tong).' '.'VND';
								?>

							</p>
						</td>
						<td class="cart_delete">
							<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_cartcontent->rowId)}}"><i class="fa fa-times"></i></a>
						</td>
					</tr>
					@endforeach


				</tbody>
			</table>
		</div>

		<h4 style="margin: 40px 0 ; font-size: 20px">Chọn hình thức thanh toán</h4>

		<form action="{{URL::to('/order-place')}}" method="POST">
		{{csrf_field()}}
		<div class="payment-options">
			<span>
				<label><input name="payment_option" value="1" type="checkbox"> Ship COD</label>
			</span>
			<span>
				<label><input name="payment_option" value="2" type="checkbox"> Chuyển khoản ngân hàng</label>
			</span>
			<span>
				<label><input name="payment_option" value="3" type="checkbox"> Thanh toán thẻ ghi nợ</label>
			</span>
			<input  type="submit" style="margin-top: 0" name="send_order_place" class="btn btn-primary btn-sm" value="Đặt hàng">
		</div>
		</form>
	</div>
</section> <!--/#cart_items-->
@endsection