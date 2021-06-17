<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentM;

class CommentController extends Controller
{
	public function list_comment()
	{
		$comment = CommentM::with('product')->orderBy('comment_id', 'DESC')->get();
		return view('admin.comment.list_comment')->with(compact('comment'));
	}

	public function approve_comment(Request $request)
	{
		$data = $request->all();
		$comment = CommentM::find($data['comment_id']);
		$comment->comment_status = $data['comment_status'];
		$comment->save();
	}
	public function reply_comment(Request $request)
	{
		$data = $request->all();
		$comment = new CommentM();
		$comment['comment_name'] = 'LGtech';
		$comment['comment'] = $data['comment'];
		$comment['comment_parent_comment'] = $data['comment_id'];
		$comment['comment_status'] = 1;
		$comment['comment_product_id'] = $data['comment_product_id'];
		$comment->save();
	}

	public function load_comment(Request $request)
	{
		$product_id = $request->product_id;
		$comment = CommentM::where('comment_product_id', $product_id)->where('comment_status', 1)->where('comment_parent_comment','=',0)->get();
		$comment_reply = CommentM::where('comment_status', 1)->where('comment_parent_comment','>',0)->get();
		$output = '';
		foreach ($comment as $key => $v_comment) {
			$output .= '<div class="row style-comment">
								<div class="col-md-2">
								<img width="80%" src="' . url('upload/avatar/avatar.png') . '" class="img img-responsive img-thumbnail" alt="">
								</div>
								<div class="col-md-10">
								<p style="color: green;">@' . $v_comment->comment_name . '</p>
								<p style="color:#000;">' . $v_comment->comment_date . '</p>
								<p>' . $v_comment->comment . '</p>
								</div></div> 
								<p></p>';

			foreach ($comment_reply as $key => $cmt_reply) {
				if ($cmt_reply->comment_parent_comment == $v_comment->comment_id) {
					$output .= '<div class="row style-comment" style="margin: 0px 40px; background: white;">
								<div class="col-md-2">
								<img width="100%" src="' . url('upload/avatar/avatarCL.jpg') . '" class="img img-responsive img-thumbnail" alt="">
								</div>
								<div class="col-md-10">
								<p style="color: green;">@' . $cmt_reply->comment_name . '</p>
								<p style="color:#000;">' . $cmt_reply->comment_date . '</p>
								<p>' . $cmt_reply->comment . '</p>							
								</div></div>
								<p></p>';
				}
			}
		}
		echo $output;
	}

	public function insert_comment(Request $request)
	{
		$product_id = $request->product_id;
		$comment = new CommentM();
		$comment['comment_name'] = $request->comment_name;
		$comment['comment'] = $request->comment;
		$comment['comment_status'] = 0;
		$comment['comment_parent_comment'] = 0;
		$comment['comment_product_id'] = $product_id;
		$comment->save();
	}
}
