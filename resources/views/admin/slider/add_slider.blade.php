        
@extends('admin_layout')
@section('admin_content')

        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm slider
                        </header>
                            <?php
                            $message = Session::get('message');
                            if($message)
                                echo '<span class="text-alert"> ',$message.' </span>';
                                Session::put('message', null);
                            ?>
                        <div class="panel-body">

                            <div class="position-center">
                                <form role="form" action="{{URL::to('/insert-slider')}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên slider</label>
                                    <input type="text" class="form-control" name="slider_name" id="exampleInputEmail1" placeholder="Slider">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">STT</label>
                                    <input type="text" class="form-control" name="slider_name" id="exampleInputEmail1" placeholder="Slider">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh slider</label>
                                    <input type="file" class="form-control" name="slider_image" id="exampleInputEmail1" placeholder="Hình ảnh">

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none" rows="8" name="slider_desc" class="form-control" placeholder="Mô tả"></textarea>
                                    <!-- <textarea style="resize: none" rows="8" name="slider_desc" class="form-control" id="ckeditor_desc_brand" placeholder="Mô tả"></textarea> --> 
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="slider_status" class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-info" name="add_slider">Thêm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection
