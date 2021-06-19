        
@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê danh mục sản phẩm
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
    <div class="table-responsive">

      <?php
      $message = Session::get('message');
      if($message)
        echo '<span class="text-alert"> ',$message.' </span>';


      Session::put('message', null);
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên danh mục</th>
            <th>Thuộc danh mục</th>
            <th>Hiển thị</th>
            <th>Date Update</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody id="category_order">
          @foreach($all_category_product as $key => $cate_pro)
          <tr id="{{$cate_pro->category_id}}">
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$cate_pro->category_name}}</td>
            <td>
              @if($cate_pro->category_parent == 0)
              <span style="color:green">Cha</span>
              @else

              @foreach($category as $key => $v_category)
              @if($cate_pro->category_parent == $v_category->category_id)
              <span style="color:gray">{{$v_category->category_name}}</span>
              @endif
              @endforeach

              @endif
            </td>
            <td><span >
              <?php
              if ($cate_pro->category_status ==0) {
                ?>
                <a href="{{URL::to('/active-category-product/'.$cate_pro->category_id)}}"> <span class="fa-thumbs-styling fa fa-eye-slash"> </span></a>
                <?php

              }elseif ($cate_pro->category_status ==1) {
                ?>
                <a href="{{URL::to('/unactive-category-product/'.$cate_pro->category_id)}}"> <span class="fa-thumbs-styling fa fa-eye"> </span></a>
                <?php  
              }
              ?>

            </span>


          </td>
          <td>{{$cate_pro->updated_at}}</td>
          <td>
            <a href="{{URL::to('/edit-category-product/'.$cate_pro->category_id)}}" class ="active styling-edit" ui-toggle-class="">
              <i class="fa fa-pencil-square-o text-success text-active"></i>
            </a>

            <a onclick="return confirm('Are you sure to delete?')" href="{{URL::to('/delete-category-product/'.$cate_pro->category_id)}}" class ="active styling-edit" ui-toggle-class="">
              <i class="fa fa-times text-danger text"></i>
            </a>

          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <form action="{{url('/import-csv-cate')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="file" name="file" accept=".xlsx"><br>
      <input type="submit" value="Import file Excel" name="import_csv" class="btn btn-warning">
    </form>
    <form action="{{url('/export-csv-cate')}}" method="POST">
      @csrf
      <input type="submit" value="Export file Excel" name="export_csv" class="btn btn-success">
    </form>

  </div>
  <footer class="panel-footer">
    <div class="row">

      <div class="col-sm-5 text-center">
        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
      </div>
      <div class="col-sm-7 text-right text-center-xs">                
        <ul class="pagination pagination-sm m-t-none m-b-none">
          {!!$all_category_product->links()!!}
        </ul>
      </div>
    </div>
  </footer>
</div>
</div>

@endsection