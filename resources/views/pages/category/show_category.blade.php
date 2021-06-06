@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->

    <div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button" data-action="like" data-size="small" data-share="true"></div>

    @foreach($cate_name_product as $key => $cate_product_home)
    <h2 class="title text-center">{{$cate_product_home->category_name}}</h2>
    @endforeach

    @foreach($category_by_id as $key => $pro)    
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <a href="{{URL::to('details-product/'.$pro->product_slug)}}">
                    <img src="{{URL::to('upload/product/'.$pro->product_image)}}" alt="" />
                    <h2>{{number_format($pro->product_price).' '.'VND'}}</h2>
                    <p>{{$pro->product_name}}</p>
                    </a>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                </div>


<!--                 <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>{{number_format($pro->product_price).' '.'VND'}}</h2>
                        <p>{{$pro->product_name}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                    </div>
                </div> -->


            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    @endforeach


</div><!--/recommended_items-->

<div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="20"></div>

<div class="fb-page" data-href="https://www.facebook.com/thelemonade27a" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/thelemonade27a" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/thelemonade27a">The Lemonade Coffee &amp; Milk Tea</a></blockquote></div>

@endsection