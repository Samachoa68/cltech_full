@extends('admin_layout')
@section('admin_content')

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Chỉnh sửa sản phẩm
                </header>
                <?php
                $message = Session::get('message');
                if ($message) {
                echo '<span class="text-alert"> ', $message . ' </span>';
                }
                Session::put('message', null);
                ?>
                <div class="panel-body">

                    <div class="position-center">

                        @foreach ($edit_product as $key => $pro)

                            <form role="form" action="{{ URL::to('/update-product/' . $pro->product_id) }}" method="post"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="product_name" id="exampleInputEmail1"
                                        value="{{ $pro->product_name }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">SL sản phẩm</label>
                                    <input type="text" data-validation="number"
                                        data-validation-error-msg="Làm ơn điền số lượng" name="product_quantity"
                                        class="form-control" id="exampleInputEmail1" value="{{ $pro->product_quantity }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="product_slug" class="form-control " id="convert_slug"
                                        value="{{ $pro->product_slug }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" class="form-control" name="product_image" id="">
                                    <img src="{{ URL::to('upload/product/' . $pro->product_image) }}" width="100"
                                        height="100">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Document</label>
                                    <input type="file" class="form-control" name="product_file" id="">
                                    <p><a
                                            href="{{ URL::to('upload/document/' . $pro->product_file) }}">{{ $pro->product_file }}</a>
                                        @if ($pro->product_file)
                                            <button type="button" data-document_id="{{ $pro->product_id }}"
                                                class="btn btn-sm btn-danger btn-delete-document"><i
                                                    class="fa fa-times"></i></button>

                                        @endif

                                    </p>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phầm</label>
                                    <textarea style="resize: none" rows="8" name="product_desc" class="form-control"
                                        id="ckeditor_1">{{ $pro->product_desc }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phầm</label>
                                    <textarea style="resize: none" rows="8" name="product_content" class="form-control"
                                        id="ckeditor_2">{{ $pro->product_content }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Giá sản phẩm</label>
                                    <textarea style="resize: none" rows="1" name="product_price"
                                        class="form-control price_format"
                                        id="exampleInputPassword1">{{ $pro->product_price }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục sản phẩm</label>

                                    <select name="product_cate" class="form-control  m-bot15">

                                        @foreach ($cate_product as $key => $cate)
                                            @if ($cate->category_id == $pro->category_id)

                                                <option selected value="{{ $cate->category_id }}">
                                                    {{ $cate->category_name }}</option>
                                            @else
                                                <option value="{{ $cate->category_id }}">
                                                    {{ $cate->category_name }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thương hiệu</label>
                                    <select name="product_brand" class="form-control  m-bot15">

                                        @foreach ($brand_product as $key => $brand)
                                            @if ($brand->brand_id == $pro->brand_id)
                                                <option selected value="{{ $brand->brand_id }}">
                                                    {{ $brand->brand_name }}</option>
                                            @else
                                                <option value="{{ $brand->brand_id }}">
                                                    {{ $brand->brand_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tags</label>
                                    <input type="text" class="form-control" name="product_tags" data-role="tagsinput"
                                        value="{{ $pro->product_tags }}">
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="product_status" class="form-control  m-bot15">

                                        @if ($pro->product_status == 0)
                                            <option value="0">Ẩn</option>
                                            <option value="1">Hiển thị</option>
                                        @else
                                            <option value="1">Hiển thị</option>
                                            <option value="0">Ẩn</option>
                                        @endif

                                    </select>
                                </div>

                                <button type="submit" class="btn btn-info" name="save_product">Cập nhật</button>
                            </form>

                        @endforeach
                    </div>

                </div>
            </section>

        </div>

    @endsection
