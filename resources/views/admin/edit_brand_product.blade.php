        
@extends('admin_layout')
@section('admin_content')

        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit thương hiệu sản phẩm
                        </header>
                            <?php
                            $message = Session::get('message');
                            if($message)
                                echo '<span class="text-alert"> ',$message.' </span>';
                                Session::put('message', null);
                            ?>
                        <div class="panel-body">

                            <div class="position-center">
                                
                                <form role="form" action="{{URL::to('/update-brand-product/'.$edit_brand_product->brand_id)}}" method="post">
                                    {{csrf_field()}}

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" value = "{{$edit_brand_product->brand_name}}" class="form-control" name="brand_product_name" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none" rows="8" name="brand_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả">{{$edit_brand_product->brand_name}}</textarea> 
                                </div>

                                <button type="submit" class="btn btn-info" name="update_brand_product">Cập nhật thương hiệu</button>
                            </form>                      

                            </div>

                        </div>
                    </section>

            </div>

@endsection
