        
@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin đăng nhập
    </div>

    <div class="table-responsive">

      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Email</th>  
            <th>Mã đơn hàng</th>            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>


          <tr>            
            <td>{{$customer->customer_name}}</td>
            <td>{{$customer->customer_phone}}</td>
            <td>{{$customer->customer_email}}</td>
            <td>{{$order_code}}</td>           
            <td></td>
          </tr>


        </tbody>
      </table>
    </div>

  </div>
</div>

<br>

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin vận chuyển
    </div>

    <div class="table-responsive">

      <table class="table table-striped b-t b-light">
        <thead>

          <tr>
            <th>Tên người nhận</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Ghi chú</th>
            <th>Phương thức thanh toán</th>               
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>

          <tr>            
            <td>{{$shipping->shipping_name}}</td>
            <td>{{$shipping->shipping_phone}}</td>
            <td>{{$shipping->shipping_email}}</td>
            <td>{{$shipping->shipping_address}}</td> 
            <td>{{$shipping->shipping_notes}}</td>
            <td>@if ($shipping->shipping_method== 0) Chuyển khoản @else Tiền mặt @endif</td>          
            <td></td>
          </tr>

        </tbody>
      </table>
    </div>

  </div>
</div>

<br>

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê chi tiết đơn hàng
    </div>

    <div class="table-responsive">

      <table class="table table-striped b-t b-light">
        <thead>

          <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng kho còn</th>
            <th>Mã giảm giá</th>
            <th>Số lượng</th>
            <th>Giá</th>  
            <th>Tổng tiền</th>          
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php $i = 0; $total= 0; @endphp
          @foreach($order_details as $key => $v_order_pro)
          @php 
          $i++; 
          $subtotal = $v_order_pro->product_price*$v_order_pro->product_sales_quantity;
          $total += $subtotal;
          @endphp
          <tr class="order_color_{{$v_order_pro->product_id}}">
            <td>{{$i}}</td>            
            <td>{{$v_order_pro->product_name}}</td>
            <td>{{$v_order_pro->product->product_quantity}}</td>
            <td>@if($v_order_pro->product_coupon != 'no') {{$v_order_pro->product_coupon}} @else Không mã @endif</td>
            <td>
              <input type="number" min="1" {{$order_status==2 ? 'disabled' : ''}} class="order_qty_{{$v_order_pro->product_id}}" name="product_sales_quantity" value="{{$v_order_pro->product_sales_quantity}}">



              <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$v_order_pro->product_id}}" value="{{$v_order_pro->product->product_quantity}}">

              <input type="hidden" name="order_product_id" class="order_product_id" value="{{$v_order_pro->product_id}}">

              <input type="hidden" name="order_code" class="order_code" value="{{$v_order_pro->order_code}}">

              @if($order_status!=2)
              <button class="btn btn-default update_quantity_order" data-product_id="{{$v_order_pro->product_id}}" name="update_quantity_order">Cập nhật</button>
              @endif

            </td>
            <td>{{number_format($v_order_pro->product_price,0,',','.')}}đ</td>          
            <td>{{number_format($subtotal,0,',','.')}}đ</td>
          </tr>
          @endforeach
          <tr>
            <td colspan="3">

              @if($coupon_condition==1)            

              @php
              $total_coupon = ($total*$coupon_number)/100;
              @endphp
              <li>Phí vận chuyển: <span>{{number_format($product_feeship,0,',','.')}}đ</span></li>
              <li>Mã giảm:  <span>{{$coupon_number}} % = {{number_format($total_coupon,0,',','.')}}đ</span></li>
              
              <li>Tổng thanh toán:  <span>{{number_format($total-$total_coupon+$product_feeship,0,',','.')}}đ</span></li>

              @elseif($coupon_condition==2)
              @php

              $total_coupon = $coupon_number;
              @endphp
              <li>Phí vận chuyển: <span>{{number_format($product_feeship,0,',','.')}}đ</span></li>
              <li>Mã giảm: <span>{{number_format($total_coupon,0,',','.')}} k</span></li>
              
              <li>Tổng thanh toán: <span>{{number_format($total-$total_coupon+$product_feeship,0,',','.')}}đ</span></li>
              @endif

            </td>

          </tr>

          <tr>           
            <td colspan="2" >
              @foreach($order as $key => $v_order)

              @if($v_order->order_status==1)
              <form >
                @csrf
                <select class="form-control order_details ">
                  <option id="{{$v_order->order_id}}" selected value="1">Chưa xử lý</option>
                  <option id="{{$v_order->order_id}}" value="2">Đã xử lý - Đã giao hàng</option>       
                </select>
              </form>
              @else($v_order->order_status==2)
              <form >
                @csrf
                <select  class="form-control order_details ">
                  <option id="{{$v_order->order_id}}"  value="1">Chưa xử lý</option>
                  <option id="{{$v_order->order_id}}" selected value="2">Đã xử lý - Đã giao hàng</option>   
                </select>
              </form>            
              @endif                      
              @endforeach
            </td>
          </tr>

        </tbody>
      </table>


      <a target="_blank" href="{{URL('/print-order/'.$order_code)}}" >In đơn hàng</a>
    </div>

  </div>
</div>

@endsection