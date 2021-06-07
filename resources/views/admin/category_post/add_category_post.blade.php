        
@extends('admin_layout')
@section('admin_content')

        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm danh mục bài viết
                        </header>
                            <?php
                            $message = Session::get('message');
                            if($message)
                                echo '<span class="text-alert"> ',$message.' </span>';
                                Session::put('message', null);
                            ?>
                        <div class="panel-body">

                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-cate-post')}}" method="post">
                                    @csrf

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" onkeyup="ChangeToSlug();" class="form-control" name="cate_post_name" id="slug" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" class="form-control" name="cate_post_slug" id="convert_slug" placeholder="Slug">
                                </div>                               

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none" rows="8" name="cate_post_desc" class="form-control" id="ckeditor_desc_brand" placeholder="Mô tả"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="cate_post_status" class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-info" name="save_cate_post">Thêm danh mục bài biết</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection
