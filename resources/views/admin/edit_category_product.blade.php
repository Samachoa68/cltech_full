        
@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
            </header>
            <?php
            $message = Session::get('message');
            if($message)
                echo '<span class="text-alert"> ',$message.' </span>';
            Session::put('message', null);
            ?>
            <div class="panel-body">

                <div class="position-center">
                    
                    <form role="form" action="{{URL::to('/update-category-product/'.$edit_category_product->category_id)}}" method="post">
                        
                     @csrf

                     <div class="form-group">
                        <label for="exampleInputEmail1">Tên danh mục</label>
                        <input type="text" id="slug" onkeyup="ChangeToSlug();" value = "{{$edit_category_product-> category_name}}" class="form-control" name="category_product_name" id="exampleInputEmail1" placeholder="Tên danh mục">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Slug</label>
                        <input type="text" value="{{$edit_category_product->slug_category_product}}" name="slug_category_product" class="form-control" id="convert_slug" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả</label>
                        <textarea style="resize: none" rows="8" name="category_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả">{{$edit_category_product -> category_name}}</textarea> 
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Thuộc danh mục</label>
                        <select name="category_parent" class="form-control input-sm m-bot15">
                            <option value="0">-----------Danh mục cha-----------</option>
                            @foreach($category as $key => $val)

                            @if($val->category_parent==0)     
                            <option {{$val->category_id==$edit_category_product->category_id ? 'selected' : '' }} value="{{$val->category_id}}">{{$val->category_name}}</option>
                            @endif

                            @foreach($category as $key => $val2)

                            @if($val2->category_parent==$val->category_id) 

                            <option {{$val2->category_id==$edit_category_product->category_id ? 'selected' : '' }} value="{{$val2->category_id}}">---{{$val2->category_name}}</option>  

                            @endif

                            @endforeach

                            @endforeach
                            
                            
                        </select>
                    </div>

                    <button type="submit" class="btn btn-info" name="update_category_product">Cập nhật danh mục</button>
                </form>

            </div>

        </div>
    </section>

</div>

@endsection
