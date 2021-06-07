@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->

    @foreach($brand_name_product as $key => $brand_product_home)
    <h2 class="title text-center">{{$brand_product_home->brand_name}}</h2>
    @endforeach

    @foreach($brand_by_id as $key => $pro)
    <a href="{{URL::to('details-product/'.$pro->product_slug)}}">
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{URL::to('upload/product/'.$pro->product_image)}}" alt="" />
                    <h2>{{number_format($pro->product_price).' '.'VND'}}</h2>
                    <p>{{$pro->product_name}}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                </div>
 <!--              <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>{{number_format($pro->product_price).' '.'VND'}}</h2>
                        <p>{{$pro->product_name}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                    </div>
                </div> 
  -->
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
    </div>
</a>
    @endforeach


</div><!--/recommended_items-->

@endsection