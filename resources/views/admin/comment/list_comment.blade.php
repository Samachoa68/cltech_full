@extends('admin_layout')
@section('admin_content')

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê bình luận
            </div>
            <div id="notify_comment"></div>
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
                            <th>Duyệt</th>
                            <th>Người bình luận</th>
                            <th>Bình luận</th>
                            <th>Ngày gửi</th>
                            <th>Sản phẩm</th>
                            <th>Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comment as $key => $v_comment)
                            <tr>
                                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                                </td>
                                <td>
                                    @if ($v_comment->comment_status == 1)
                                        <input type="button" data-comment_status="0"
                                            data-comment_id="{{ $v_comment->comment_id }}"
                                            id="{{ $v_comment->comment_product_id }}"
                                            class="btn btn-danger btn-xs comment-duyet-btn" value="Bỏ duyệt">
                                    @else
                                        <input type="button" data-comment_status="1"
                                            data-comment_id="{{ $v_comment->comment_id }}"
                                            id="{{ $v_comment->comment_product_id }}"
                                            class="btn btn-primary btn-xs comment-duyet-btn" value="Duyệt">
                                    @endif
                                </td>
                                <td>{{ $v_comment->comment_name }}</td>
                                <td>{{ $v_comment->comment }}
                                    @if ($v_comment->comment_status == 1)
                                       
                                            <ul class="list_reply">
                                                Reply:
                                                @foreach ($comment as $key => $cmt_reply)
                                                    @if ($cmt_reply->comment_parent_comment == $v_comment->comment_id)
                                                        <li>{{ $cmt_reply->comment }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                       
                                        <br><textarea class="form-control reply_comment_{{ $v_comment->comment_id }}"
                                            rows="2"></textarea>
                                        <br><button class="btn btn-default btn-xs reply-comment-btn"
                                            data-comment_id="{{ $v_comment->comment_id }}"
                                            data-product_id="{{ $v_comment->comment_product_id }}">Trả lời bình
                                            luận</button>
                                    @endif


                                </td>
                                <td>{{ $v_comment->comment_date }}</td>
                                <td><a target="_blank"
                                        href="{{ URL::to('/details-product/' . $v_comment->product->product_slug) }}">{{ $v_comment->product->product_name }}</a>
                                </td>
                                <td>
                                    <a href="{{ URL::to('/edit-comment/' . $v_comment->comment_id) }}"
                                        class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-pencil-square-o text-success text-active"></i>
                                    </a>

                                    <a onclick="return confirm('Are you sure to delete product?')"
                                        href="{{ URL::to('/delete-comment/' . $v_comment->comment_id) }}"
                                        class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-times text-danger text"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
