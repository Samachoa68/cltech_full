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
    <h2 class="title text-center">{{$meta_title}}</h2>

    <div class="product-image-wrapper" style="border: none;">
        @foreach($all_post as $key => $v_post)
        <div class="single-products" style="margin:10px 0;padding: 2px">
            <div class="text-center">

                <img style="float:left;width:30%;padding: 5px;height: 150px" src="{{URL::to('upload/post/'.$v_post->post_image)}}" alt="{{$v_post->post_slug}}" />
                
                <h4><a style="color:#000; padding: 5px;" href="{{URL::to('details-post/'.$v_post->post_slug)}}">{{$v_post->post_title}}</a></h4>
              
            </div>
            <div>
                <p>{!!$v_post->post_desc!!}</p>
            </div>

            <div class="text-right">
                <a  href="{{URL::to('details-post/'.$v_post->post_slug)}}" class="btn btn-default btn-sm">Xem bài viết</a>
            </div>
        </div>
        @endforeach

    </div>

</div><!--features_items-->

<div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="20"></div>

<div class="fb-page" data-href="https://www.facebook.com/thelemonade27a" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/thelemonade27a" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/thelemonade27a">The Lemonade Coffee &amp; Milk Tea</a></blockquote></div>

@endsection