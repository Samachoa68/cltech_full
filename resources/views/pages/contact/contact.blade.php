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
                        @foreach ($slider as $key => $v_slider)
                            @php $i++; @endphp
                            <div class="item {{ $i == 1 ? 'active' : '' }}">
                                <div class="col-sm-6">
                                    <h1><span>LAMGIA</span>-TECH</h1>
                                    <h2>Free E-Commerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>

                                <div class="col-sm-6">
                                    <img src="{{ URL::to('upload/slider/' . $v_slider->slider_image) }}"
                                        class="img img-responsive" alt="{{ $v_slider->slide_desc }}" />
                                    <img src="frontend/images/home/pricing.png" class="pricing" alt="" />
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
    <div class="features_items">
        <!--features_items-->
        <h2 class="title text-center">Liên hệ</h2>
        <div class="row">
            <div class="col-sm-12">
                {!!$contact->info_contact!!}
                {!!$contact->info_fanpage!!}
            </div>                       

            <div class="col-sm-12">
                <h4>Bản đồ</h4>
                {!!$contact->info_map!!}
            </div>
        </div>
    </div>
    <!--features_items-->
@endsection
