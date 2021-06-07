        
@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm mã giảm giá
            </header>
            <?php
            $message = Session::get('message');
            if($message)
                echo '<span class="text-alert"> ',$message.' </span>';
            Session::put('message', null);
            ?>
            <div class="panel-body">

                <div class="position-center">
                    <form role="form" action="{{URL::to('/insert-coupon-code')}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên mã giảm giá</label>
                            <input type="text" data-validation="length" data-validation-length="min10" class="form-control" name="coupon_name" id="exampleInputEmail1" placeholder="Mã giảm giá">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã giảm giá</label>
                            <input type="text"  class="form-control" name="coupon_code" id="exampleInputEmail1" >
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Số lượng mã</label>
                            <input type="text"  class="form-control" name="coupon_times" id="exampleInputEmail1" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tính năng mã</label>
                            <select name="coupon_condition" class="form-control input-sm m-bot15">
                                <option value="0">---Chọn---</option>
                                <option value="1">Giảm theo phần trăm %</option>
                                <option value="2">Giảm theo tiền</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nhập số % hoặc tiền giảm</label>
                            <textarea style="resize: none" rows="1" name="coupon_number" class="form-control"></textarea> 
                        </div>                                 


                        <button type="submit" class="btn btn-info" name="add_coupon">Thêm mã</button>
                    </form>
                </div>

            </div>
        </section>

    </div>

    @endsection
