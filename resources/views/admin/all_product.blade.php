@extends('admin_layout')
@section('admin_content')

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê sản phẩm
            </div>

            <?php
            $message = Session::get('message');
            if ($message) {
            echo '<span class="text-alert"> ', $message . ' </span>';
            }

            Session::put('message', null);
            ?>

            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Thư viện ảnh</th>
                        <th>Tài liệu</th>
                        <th>Slug</th>
                        <th>Giá</th>
                        <th>Danh mục</th>
                        <th>Thương hiệu</th>
                        <th>Hình ảnh</th>                        
                        <th>Hiển thị</th>
                        <th>Date Update</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_product as $key => $pro)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>{{ $pro->product_name }}</td>
                            <td>{{ $pro->product_quantity }}</td>
                            <td><a href="{{ URL::to('add-gallery/' . $pro->product_id) }}">Thêm ảnh</a></td>
                            
                                @if($pro->product_file)
                                <td><a href="{{ URL::to('upload/document/' . $pro->product_file) }}">Xem file</a></td>
                                @else
                                    <td>Không file</td>
                                @endif
                            
                            <td>{{ $pro->product_slug }}</td>
                            <td>{{ $pro->product_price }}</td>
                            <td>{{ $pro->category_name }}</td>
                            <td>{{ $pro->brand_name }}</td>

                            <td><img src="{{ URL::to('upload/product/' . $pro->product_image) }}" height="100"
                                    width="100"></td>


                            <td><span>
                                    <?php if ($pro->product_status == 0) { ?>
                                    <a href="{{ URL::to('/active-product/' . $pro->product_id) }}"> <span
                                            class="fa-thumbs-styling fa fa-eye-slash"> </span></a>
                                    <?php } elseif ($pro->product_status == 1) { ?>
                                    <a href="{{ URL::to('/unactive-product/' . $pro->product_id) }}"> <span
                                            class="fa-thumbs-styling fa fa-eye"> </span></a>
                                    <?php } ?>
                                </span>
                            </td>
                            <td>{{ $pro->updated_at }}</td>
                            <td>
                                <a href="{{ URL::to('/edit-product/' . $pro->product_id) }}" class="active styling-edit"
                                    ui-toggle-class="">
                                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                                </a>

                                <a onclick="return confirm('Are you sure to delete product?')"
                                    href="{{ URL::to('/delete-product/' . $pro->product_id) }}"
                                    class="active styling-edit" ui-toggle-class="">
                                    <i class="fa fa-times text-danger text"></i>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <form action="{{ url('/import-csv-pro') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".xlsx"><br>
            <input type="submit" value="Import file Excel" name="import_csv" class="btn btn-warning">
        </form>
        <form action="{{ url('/export-csv-pro') }}" method="POST">
            @csrf
            <input type="submit" value="Export file Excel" name="export_csv" class="btn btn-success">
        </form>


    </div>


@endsection
