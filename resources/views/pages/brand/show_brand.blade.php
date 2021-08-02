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
                    <form>
                        @csrf
                        <input type="hidden" value="{{ $pro->product_id }}"
                            class="cart_product_id_{{ $pro->product_id }}">
                        <input type="hidden" id="wishlist_productname{{ $pro->product_id }}"
                            value="{{ $pro->product_name }}" class="cart_product_name_{{ $pro->product_id }}">
                        <input type="hidden" value="{{$pro->product_quantity}}" class="cart_product_quantity_{{$pro->product_id}}">
                        <input type="hidden" value="{{ $pro->product_image }}"
                            class="cart_product_image_{{ $pro->product_id }}">
                        <input type="hidden" id="wishlist_productprice{{ $pro->product_id }}"
                            value="{{ $pro->product_price }}"
                            class="cart_product_price_{{ $pro->product_id }}">
                        <input type="hidden" value="1" class="cart_product_qty_{{ $pro->product_id }}">

                        <a id="wishlist_producturl{{ $pro->product_id }}"
                            href="{{ URL::to('details-product/' . $pro->product_slug) }}">
                            <img id="wishlist_productimage{{ $pro->product_id }}"
                                src="{{ URL::to('upload/product/' . $pro->product_image) }}" alt="" />
                            <h2>{{ number_format($pro->product_price) . ' ' . 'VND' }}</h2>
                            <p>{{ $pro->product_name }}</p>
                        </a>
                        <button type="button" class="btn btn-default add-to-cart"
                            data-id_product="{{ $pro->product_id }}" name="add-to-cart"><i
                                class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>

                        <input type="button" data-toggle="modal" data-target="#xemnhanh" value="Xem nhanh"
                            class="btn btn-default xemnhanh" data-id_product="{{ $pro->product_id }}"
                            name="add-to-cart">
                    </form>
                </div>

            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><i class="fa fa-plus-square"></i>
                        <button class="button_wishlist" id="{{ $pro->product_id }}"
                            onclick="add_wistlist(this.id);"><span>Yêu thích</span></button>
                    </li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
    </div>
</a>
    @endforeach


</div><!--/recommended_items-->

@endsection