        
@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm bài viết
            </header>
            <?php
            $message = Session::get('message');
            if($message)
                echo '<span class="text-alert"> ',$message.' </span>';
            Session::put('message', null);
            ?>
            <div class="panel-body">

                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-post')}}" method="post" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên bài viết</label>
                            <input type="text" onkeyup="ChangeToSlug();" data-validation="length" data-validation-length="min10" class="form-control" name="post_title" id="slug" placeholder="Tên sản phẩm" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="post_slug" class="form-control " id="convert_slug" placeholder="Slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tóm tắt bài viết</label>
                            <textarea style="resize: none" rows="8" name="post_desc" class="form-control" id="ckeditor_1" placeholder="Mô tả"></textarea> 
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung bài viết</label>
                            <textarea style="resize: none" rows="8" name="post_content" class="form-control" id="ckeditor_2" placeholder="Nội dung"></textarea> 
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> Meta từ khóa</label>
                            <textarea type="text" rows="3" name="post_meta_keywords" class="form-control " id="" placeholder="Slug"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Meta nội dung</label>
                            <textarea type="text" rows="3" name="post_meta_desc" class="form-control " id="" placeholder="Slug"></textarea>
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" class="form-control" name="post_image" id="">
                        </div>                                              

                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục bài viết</label>

                            <select name="cate_post_id" class="form-control input-sm m-bot15">
                                @foreach($cate_post as $key => $v_cate_post)
                                <option value="{{$v_cate_post->cate_post_id}}">{{$v_cate_post->cate_post_name}}</option>

                                @endforeach

                            </select>
                        </div>                     


                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="post_status" class="form-control input-sm m-bot15">
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

