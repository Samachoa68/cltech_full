        
@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm sản phẩm
            </header>
            <?php
            $message = Session::get('message');
            if($message)
                echo '<span class="text-alert"> ',$message.' </span>';
            Session::put('message', null);
            ?>
            <div class="panel-body">

                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" onkeyup="ChangeToSlug();" data-validation="length" data-validation-length="min10" class="form-control" name="product_name" id="slug" placeholder="Tên sản phẩm" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="product_slug" class="form-control " id="convert_slug" placeholder="Slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">SL sản phẩm</label>
                            <input type="text" data-validation="number" data-validation-error-msg="Làm ơn điền số lượng" name="product_quantity" class="form-control" id="exampleInputEmail1" placeholder="Điền số lượng">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Giá sản phẩm</label>
                            <textarea style="resize: none" rows="1" name="product_price" class="form-control price_format" id="exampleInputPassword1" placeholder="Giá sản phẩm"></textarea> 
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" class="form-control" name="product_image" id="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Document</label>
                            <input type="file" class="form-control" name="product_file" id="">                            
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tags</label>
                            <input type="text" class="form-control" name="product_tags" data-role="tagsinput">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phầm</label>
                            <textarea style="resize: none" rows="8" name="product_desc" class="form-control" id="ckeditor_1" placeholder="Mô tả"></textarea> 
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phầm</label>
                            <textarea style="resize: none" rows="8" name="product_content" class="form-control" id="my-editor" placeholder="Nội dung"></textarea> 
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>

                            <select name="product_cate" class="form-control m-bot15">

                                @foreach($cate_product as $key => $cate)
                                @if ($cate->category_parent == 0)
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @foreach($cate_product as $key => $cate_sub)
                                @if ($cate_sub->category_parent != 0 && $cate_sub->category_parent == $cate->category_id)
                                <option style="color: red" value="{{$cate_sub->category_id}}">-- {{$cate_sub->category_name}}</option>
                                @endif
                                @endforeach
                                @endif
                                

                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Thương hiệu</label>
                            <select name="product_brand" class="form-control   m-bot15">

                                @foreach($brand_product as $key => $brand)
                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="product_status" class="form-control   m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-info" name="add_product">Thêm</button>
                    </form>
                </div>

            </div>
        </section>

    </div>

    @endsection

