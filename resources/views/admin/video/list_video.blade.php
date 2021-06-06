        
@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách video
    </div>

    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>


    <div class="position-center">
      <form>
        @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">Tên video</label>
          <input type="text" onkeyup="ChangeToSlug();" class="form-control video_title" name="video_title" id="slug" placeholder="Tên danh mục">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Video Slug</label>
          <input type="text" class="form-control video_slug" name="video_slug" id="convert_slug" placeholder="Slug">
        </div>  
        <div class="form-group">
          <label for="exampleInputEmail1">Video Link</label>
          <input type="text" class="form-control video_link" name="video_link" id="convert_slug" placeholder="Slug">
        </div>                            

        <div class="form-group">
          <label for="exampleInputPassword1">Mô tả</label>
          <textarea style="resize: none" rows="3" name="video_desc" class="form-control video_desc" id="ckeditor" placeholder="Mô tả"></textarea>
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Hình ảnh video</label>
          <input type="file" class="form-control" id="file_img_video" name="file" accept="image/*">
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Hiển thị</label>
          <select name="video_status" class="form-control input-sm m-bot15 video_status">
            <option value="0">Ẩn</option>
            <option value="1">Hiển thị</option>
          </select>
        </div>

        <button type="button" class="btn btn-info " id="btn-add-video" name="add_video">Thêm video</button>
      </form>
    </div>
    <div id="notify"></div>

    <div class="table-responsive">

      <?php
      $message = Session::get('message');
      if($message)
        echo '<span class="text-alert"> ',$message.' </span>';


      Session::put('message', null);
      ?>


      <div id="video_load">
      </div>

      <!-- Modal -->
      <div class="modal fade" id="demo_video" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Video</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">               
              </button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

    </div>
    <footer class="panel-footer">
      <div class="row">

        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>

@endsection