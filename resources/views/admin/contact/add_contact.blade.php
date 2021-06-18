        
@extends('admin_layout')
@section('admin_content')

        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thông tin liên hệ
                        </header>
                            <?php
                            $message = Session::get('message');
                            if($message)
                                echo '<span class="text-alert"> ',$message.' </span>';
                                Session::put('message', null);
                            ?>
                        <div class="panel-body">

                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-contact')}}" method="post" enctype="multipart/form-data">
                                    @csrf                                                       

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thông tin liên hệ</label>
                                    <textarea style="resize: none" rows="8" name="info_contact" required class="form-control" id="ckeditor_1" placeholder="Mô tả">{{$contact->info_contact}}</textarea> 
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Fanpage</label>
                                    <textarea style="resize: none" rows="8" required name="info_fanpage" class="form-control" placeholder="Mô tả">{{$contact->info_fanpage}}</textarea> 
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Bản đồ</label>
                                    <textarea style="resize: none" rows="8" required name="info_map" class="form-control"  placeholder="Mô tả">{{$contact->info_map}}</textarea> 
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh liên hệ</label>
                                    <input type="file" class="form-control" name="info_logo" id="">
                                    <img src="{{url::to('upload/contact/'.$contact->info_logo)}}" alt="Hình ảnh liên hệ">
                                </div>

                                <button type="submit" class="btn btn-info" name="add_contact">Cập nhật</button>
                            </form>
                          
                            </div>

                        </div>
                    </section>

            </div>

@endsection
