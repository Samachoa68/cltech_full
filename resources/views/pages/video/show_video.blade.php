
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
    <h2 class="title text-center">Video</h2>

    @foreach($all_video as $key => $video)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">

                    <form>
                        @csrf
                        <div class="single-products single-products-video">
                            <div class="productinfo text-center">
                                <form>
                                    @csrf
                                    <a href="">

                                        <img src="{{asset('upload/videos/'.$video->video_image)}}" alt="{{$video->video_title}}" />
                                        <h2>{{$video->video_title}}</h2>
                                        <p>{{$video->video_desc}}</p>

                                    </a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary watch_video" data-toggle="modal" data-target="#modal_video" id="{{$video->video_id}}">
                                      Xem video
                                  </button>

                              </form>

                          </div>

                      </div>
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
<div class="modal fade" id="modal_video" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="video_title"></h5>        
      </button>
  </div>
  <div class="modal-body">
    <div id="video_link"></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary" id="close_modal" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

@endsection