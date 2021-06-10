
@extends('layout')

@section('slider')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#slider-carousel" data-slide-to="1"></li>
                    <li data-target="#slider-carousel" data-slide-to="2"></li>
                </ol>

                <div class="carousel-inner">
                    @php $i=0; @endphp
                    @foreach($slider as $key => $v_slider)
                    @php $i++; @endphp
                    <div class="item {{$i==1 ? 'active':''}}">
                        <div class="col-sm-6">
                            <h1><span>LAMGIA</span>-TECH</h1>
                            <h2>Free E-Commerce Template</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                            <button type="button" class="btn btn-default get">Get it now</button>
                        </div>

                        <div class="col-sm-6">
                            <img src="{{URL::to('upload/slider/'.$v_slider->slider_image)}}" class="img img-responsive" alt="{{$v_slider->slide_desc}}" />
                            <img src="frontend/images/home/pricing.png"  class="pricing" alt="" />
                        </div>
                    </div>
                    @endforeach

                </div>

                <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>

        </div>
    </div>
</div>
@endsection

@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Sản Phẩm mới nhất</h2>

    @foreach($all_product as $key => $pro)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">

                    <form>
                        @csrf
                        <input type="hidden" value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}">
                        <input type="hidden" value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}">
                        <input type="hidden" value="{{$pro->product_image}}" class="cart_product_image_{{$pro->product_id}}">
                        <input type="hidden" value="{{$pro->product_price}}" class="cart_product_price_{{$pro->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$pro->product_id}}">

                        <a href="{{URL::to('details-product/'.$pro->product_slug)}}">
                            <img src="{{URL::to('upload/product/'.$pro->product_image)}}" alt="" />
                            <h2>{{number_format($pro->product_price).' '.'VND'}}</h2>
                            <p>{{$pro->product_name}}</p>
                        </a>                   
                        <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$pro->product_id}}"  name="add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>

                        <input type="button" data-toggle="modal" data-target="#xemnhanh"  value="Xem nhanh" class="btn btn-default add-to-cart xemnhanh" data-id_product="{{$pro->product_id}}" name="quickview">
                    </form>

                </div>

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


</div><!--features_items-->

<!-- Modal -->
<div class="modal fade" id="xemnhanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <span id="product_quickview_title"></span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <style type="text/css">
            span#product_quickview_content img {
                width: 100%;
            }

            @media screen and (min-width: 768px) {
                .modal-dialog {
                  width: 700px; /* New width for default modal */
              }
              .modal-sm {
                  width: 350px; /* New width for small modal */
              }
          }

          @media screen and (min-width: 992px) {
            .modal-lg {
              width: 1200px; /* New width for large modal */
          }
      }
  </style>
  <div class="row">
    <div class="col-md-5">
        <span id="product_quickview_image"></span>
        <span id="product_quickview_gallery"></span>
    </div>
    <form>
        @csrf
        <div id="product_quickview_value"></div>
        <div class="col-md-7">
            <h2><span id="product_quickview_title"></span></h2>
            <p>Mã ID: <span id="product_quickview_id"></span></p>
            <p style="font-size: 20px; color: brown;font-weight: bold;">Giá sản phẩm : <span id="product_quickview_price"></span></p>

            <label>Số lượng:</label>

            <input name="qty" type="number" min="1" class="cart_product_qty_"  value="1" />

        </span>
        <h4 style="font-size: 20px; color: brown;font-weight: bold;">Mô tả sản phẩm</h4>
        <hr>
        <p><span id="product_quickview_desc"></span></p>
        <p><span id="product_quickview_content"></span></p>

        <div id="product_quickview_button"></div>
        <div id="beforesend_quickview"></div>
    </div>
</form>
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary">Save changes</button>
</div>
</div>
</div>
</div>


<div class="category-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tshirt" data-toggle="tab">T-Shirt</a></li>
            <li><a href="#blazers" data-toggle="tab">Blazers</a></li>
            <li><a href="#sunglass" data-toggle="tab">Sunglass</a></li>
            <li><a href="#kids" data-toggle="tab">Kids</a></li>
            <li><a href="#poloshirt" data-toggle="tab">Polo shirt</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="tshirt" >
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery1.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>

                    </div>
                </div>
            </div>        
        </div>

        <div class="tab-pane fade" id="blazers" >
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery4.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>

                    </div>
                </div>
            </div>            
        </div>

        <div class="tab-pane fade" id="sunglass" >
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery3.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>

                    </div>
                </div>
            </div>        

        </div>

        <div class="tab-pane fade" id="kids" >
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery1.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="poloshirt" >
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery2.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>

                    </div>
                </div>
            </div>      
        </div>
    </div>
</div><!--/category-tab-->

<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">   
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="images/home/recommend1.jpg" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>

                        </div>
                    </div>
                </div>          
            </div>
            <div class="item">  
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="images/home/recommend1.jpg" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>

                        </div>
                    </div>
                </div>

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