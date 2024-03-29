@extends('layout')
@section('attribute')
    @include('pages.include.attribute')
@endsection
@section('content')
    <div class="features_items">
        <!--features_items-->

        <div class="fb-like" data-href="{{ $url_canonical }}" data-width="" data-layout="button" data-action="like"
            data-size="small" data-share="true"></div>



        @foreach ($cate_name_product as $key => $cate_product_home)
            <h2 class="title text-center">{{ $cate_product_home->category_name }}</h2>
        @endforeach

        <div class="row">
            <div class="col-md-4">
                <label for="amount">Sắp xếp theo</label>
                <form>
                    @csrf
                    <select name="sort" id="sort" class="form-control">
                        <option value="{{ Request::URL() }}?sort_by=none">---Lọc---</option>
                        <option value="{{ Request::URL() }}?sort_by=tang_dan">Giá tăng dần</option>
                        <option value="{{ Request::URL() }}?sort_by=giam_dan">Giá giảm dần</option>
                        <option value="{{ Request::URL() }}?sort_by=kytu_az">Theo ký tự từ A-Z</option>
                        <option value="{{ Request::URL() }}?sort_by=kytu_za">Theo ký tự từ Z-A</option>
                    </select>
                </form>

            </div>
            <div class="col-md-6">           
                
                
                
                <form>
                    <p>
                       <label for="amount">Lọc giá:</label>
                       <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                        <input type="text" id="amount1" readonly style="border:0; color:#f6931f; font-weight:bold;">
                      
                        
                        <input type="hidden" name="start_price" id="start_price">
                        <input type="hidden" name="end_price" id="end_price">
                    </p>
                    <div id="slider-range"></div>
                    <input type="submit" name="filter-price" value="Lọc giá" class="btn btn-default btn-sm">
                </form>

            </div>

        </div>

        @foreach ($category_by_id as $key => $pro)
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

        @endforeach


    </div>
    <!--/recommended_items-->
    <ul class="pagination pagination-sm m-t-none m-b-none">
        {!! $category_by_id->links() !!}
    </ul>

    {{-- <div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="20"></div>

<div class="fb-page" data-href="https://www.facebook.com/thelemonade27a" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/thelemonade27a" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/thelemonade27a">The Lemonade Coffee &amp; Milk Tea</a></blockquote></div> --}}

@endsection
