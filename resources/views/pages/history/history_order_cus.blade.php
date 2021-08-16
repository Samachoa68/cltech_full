@extends('layout')
@section('content')

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Lịch sử đơn hàng của bạn</h4>
            </div>
            <div class="table-responsive">

                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert"> ', $message . ' </span>';
                }
                
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
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Tình trạng</th>
                            <th>Ngày đặt hàng</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @foreach ($order as $key => $order_all)
                            @php $i++; @endphp
                            <tr>
                                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                                </td>
                                <td>{{ $i }}</td>
                                <td>{{ $order_all->order_code }}</td>
                                <td>
                                    @if ($order_all->order_status == 1)
                                        Đơn hàng mới
                                    @else
                                        Đã xử lý
                                    @endif

                                </td>
                                <td>{{ $order_all->created_at }}</td>
                                <td>
                                    <a href="{{ URL::to('/view-history-order/' . $order_all->order_code) }}"
                                        class="active styling-edit" ui-toggle-class="">Xem</a>

                                    {{-- <a onclick="return confirm('Are you sure to delete?')" href="{{URL::to('/delete-order/'.$order_all->order_id)}}" class ="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a> --}}

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        {{-- <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small> --}}
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            {!! $order->links() !!}
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>

@endsection
