@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->

    
    <h2 class="title text-center">Kết quả tìm kiếm của " {{$keywords}} " </h2>
   

    @foreach($result_search as $key => $search_result)
    <a href="{{URL::to('details-product/'.$search_result->product_id)}}">
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{URL::to('upload/product/'.$search_result->product_image)}}" alt="" />
                    <h2>{{number_format($search_result->product_price).' '.'VND'}}</h2>
                    <p>{{$search_result->product_name}}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                </div>
 <!--              <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>{{number_format($search_result->product_price).' '.'VND'}}</h2>
                        <p>{{$search_result->product_name}}</p>
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