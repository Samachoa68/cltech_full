
@extends('layout')
@section('content')

@foreach($details_product as $key => $detail_pro)
<div class="product-details"><!--product-details-->

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb" style="background: none">
			<li class="breadcrumb-item"><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
			<li class="breadcrumb-item"><a href="{{URL::to('/danh-muc-san-pham/'.$cate_slug)}}">{{$product_cate}}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{$detail_pro->product_name}}</li>
		</ol>
	</nav>

	<div class="col-sm-5">
		<ul id="imageGallery">
			@foreach($gallery as $key => $gal)
			<li data-thumb="{{url('upload/gallery/'.$gal->gallery_image)}}" data-src="{{URL('upload/gallery/'.$gal->gallery_image)}}">
				<img width="100%" alt="{{$gal->gallery_name}}" src="{{URL('upload/gallery/'.$gal->gallery_image)}}" />
			</li>
			@endforeach
		</ul>

	</div>

	<div class="col-sm-7">


		
		<div class="product-information"><!--/product-information-->
			<img src="images/product-details/new.jpg" class="newarrival" alt="" />
			<h2>{{$detail_pro->product_name}}</h2>
			<p>Mã ID: {{$detail_pro->product_id}}</p>
			<img src="images/product-details/rating.png" alt="" />

			<form action="{{URL::to('save-cart')}}" method="POST" >
				@csrf

				<input type="hidden" id="viewed_product_id" value="{{$detail_pro->product_id}}" class="cart_product_id_{{$detail_pro->product_id}}">

				<input type="hidden" id="viewed_productname{{ $detail_pro->product_id }}" value="{{$detail_pro->product_name}}" class="cart_product_name_{{$detail_pro->product_id}}">

				<input type="hidden" id="viewed_producturl{{ $detail_pro->product_id }}" value="{{ URL::to('details-product/' . $detail_pro->product_slug) }}" class="cart_product_url_{{$detail_pro->product_id}}">

				<input type="hidden" value="{{$detail_pro->product_quantity}}" class="cart_product_quantity_{{$detail_pro->product_id}}">

				<input type="hidden" id="viewed_productimage{{ $detail_pro->product_id }}" value="{{ URL::to('upload/product/' . $detail_pro->product_image) }}" class="cart_product_image_{{$detail_pro->product_id}}">

				<input type="hidden" id="viewed_productprice{{ $detail_pro->product_id }}" value="{{$detail_pro->product_price}}" class="cart_product_price_{{$detail_pro->product_id}}">
				

				<span>
					<span>{{number_format($detail_pro->product_price).' '.'VND'}}</span>
					<label>Quantity:</label>
					<input name="qty" type="number" min="1" class="cart_product_qty_{{$detail_pro->product_id}}" value="1" />
					<input name="productid_hidden" type="hidden"  value="{{$detail_pro->product_id}}" />				

					<button type="button" class="btn btn-default cart add-to-cart" data-id_product="{{$detail_pro->product_id}}"  name="add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>

				</span>
			</form>

			<p><b>Tình trạng:</b> Còn hàng</p>
			<p><b>Điều kiện:</b> New 100%</p>
			<p><b>Thương hiệu:</b>{{$detail_pro->brand_name}} </p>
			<p><b>Danh mục:</b>{{$detail_pro->category_name}} </p>
			<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>

			<fieldset>
				<legend>Tags</legend>

				<p><i class="fa fa-tag"></i>
					@php 
					$tags = $detail_pro->product_tags;
					$tags = explode(",",$tags);

					@endphp
					@foreach($tags as $tag)
					<a href="{{url('/tag/'.str_slug($tag))}}" class="tags_style">{{$tag}}</a>
					@endforeach
				</p>
			</fieldset>
			
		</div><!--/product-information-->
		
		

	</div>

</div><!--/product-details-->
@endforeach

<div class="category-tab shop-details-tab"><!--category-tab-->
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			<li><a href="#product_desc" data-toggle="tab">Mô tả</a></li>
			<li><a href="#details" data-toggle="tab">Chi tiết sản phẩm</a></li>
			<li><a href="#tag" data-toggle="tab">Tag</a></li>
			<li class="active"><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
		</ul>
	</div>
	<div class="tab-content">
		<div class="tab-pane fade " id="product_desc" >
			
			<p>{!!$detail_pro->product_desc!!}</p>

		</div>
		<div class="tab-pane fade" id="details" >
			
			<p>{!!$detail_pro->product_content!!}</p>

		</div>

		<div class="tab-pane fade" id="tag" >
			<div class="col-sm-3">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							<img src="images/home/gallery1.jpg" alt="" />
							<h2>$56</h2>
							<p>Easy Polo Black Edition</p>
							<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
						</div>
					</div>
				</div>
			</div>
			
		</div>

		<div class="tab-pane fade active in" id="reviews" >
			<div class="col-sm-12 active in">
				<ul>
					<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
					<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
					<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
					
				</ul>

								
					<form>
						@csrf
						<input type="hidden" name="comment_product_id" class="comment-product-id" value="{{$detail_pro->product_id}}">

						<div id="comment_show"></div>		
							
					</form>

					
							
				<p></p>
				<p><b>Write Your Review</b></p>

				<ul class="list-inline rating"  title="Average Rating">
					@for($count=1; $count<=5; $count++)
						@php
							if($count<=$rating_avg){
								$color = 'color:#ffcc00;';
							}
							else {
								$color = 'color:#ccc;';
							}
						
						@endphp
					
					<li title="star_rating" 
					id="{{$detail_pro->product_id}}-{{$count}}" 
					data-index="{{$count}}"  
					data-product_id="{{$detail_pro->product_id}}" 
					data-rating="{{$rating_avg}}" 
					class="rating" 
					style="cursor:pointer; {{$color}} font-size:30px;">&#9733;</li>
					@endfor

				</ul>

				<form>
					@csrf
					<span>
						<input style="margin: 0px" type="text" placeholder="Your Name" class="comment_name" />
					</span>
					<textarea placeholder="Nội dung bình luận" class="comment" name="" ></textarea>
					<div id="notify_comment_send"></div>
					
					<button type="button" class="btn btn-default pull-right send-comment">
						Gửi bình luận
					</button>
					
				</form>
			</div>
		</div>

	</div>
</div><!--/category-tab-->

<div class="recommended_items"><!--recommended_items-->
	<h2 class="title text-center">Sản phẩm liên quan</h2>

	<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">	
				@foreach($related_product as $key => $related_pro)
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="{{URL::to('upload/product/'.$related_pro->product_image)}}" alt=""/>
								<h2>{{number_format($related_pro->product_price).' '.'VND'}}</h2>
								<p>{{$related_pro->product_name}}</p>
								<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
							</div>
						</div>
					</div>
				</div>
				@endforeach
				
			</div>

		</div>
		<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
			<i class="fa fa-angle-left"></i>
		</a>
		<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
			<i class="fa fa-angle-right"></i>
		</a>			
	</div>
</div><!--/recommended_items-->


@endsection