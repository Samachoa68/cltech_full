<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\Models\Slider;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\PostM;
use App\Models\Brand;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
	public function AuthLogin()
	{
		$admin_id = Auth::id();
		if ($admin_id) {
			return Redirect::to('/dashboard');
		} else {
			return Redirect::to('/admin')->send();
		}
	}

	public function add_post()
	{
		$this->AuthLogin();
		$cate_post = CategoryPost::orderby('cate_post_id', 'desc')->get();
		$posts = PostM::orderby('post_id', 'desc')->get();
		return view('admin.posts.add_post')->with(compact('cate_post', 'posts'));
	}

	public function save_post(request $request)
	{

		$data = $request->all();
		$post = new PostM();

		$post->post_title = $data['post_title'];
		$post->post_slug = $data['post_slug'];
		$post->post_desc = $data['post_desc'];
		$post->post_content = $data['post_content'];
		$post->post_meta_desc = $data['post_meta_desc'];
		$post->post_meta_keywords = $data['post_meta_keywords'];
		$post->cate_post_id = $data['cate_post_id'];
		$post->post_status = $data['post_status'];
		$post->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

		$get_image = $request->file('post_image');
		if ($get_image) {
			$get_image_name = $get_image->getClientOriginalName();
			$image_name = current(explode('.', $get_image_name));
			$new_image = $image_name . rand('0', '100') . '.' . $get_image->getClientOriginalExtension();
			$get_image->move('upload/post', $new_image);
			$post->post_image = $new_image;

			$post->save();
			Session::put('message', 'Thêm bài viết thành công');
			return Redirect()->back();
		} else {
			Session::put('message', 'Vui lòng thêm hình ảnh bài viết');
			return Redirect()->back();
		}
	}

	public function all_post()
	{
		$this->AuthLogin();

		$all_post = PostM::with('categorypost')->orderby('cate_post_id', 'DESC')->get();

		return view('admin.posts.all_post')->with(compact('all_post'));
	}

	public function delete_post($post_id)
	{
		$this->AuthLogin();
		$post = PostM::find($post_id);
		$post_image = $post->post_image;

		if ($post_image) {
			$path = 'public/uploads/post/' . $post_image;
			unlink($path);
		}
		$post->delete();

		Session::put('message', 'Xóa bài viết thành công');
		return redirect()->back();
	}

	public function edit_post($post_id)
	{
		$this->AuthLogin();
		$cate_post = CategoryPost::orderBy('cate_post_id')->get();
		$post = PostM::find($post_id);
		return view('admin.posts.edit_post')->with(compact('cate_post', 'post'));
	}

	public function update_post(request $request, $post_id)
	{

		$data = $request->all();
		$post = PostM::find($post_id);

		$post->post_title = $data['post_title'];
		$post->post_slug = $data['post_slug'];
		$post->post_desc = $data['post_desc'];
		$post->post_content = $data['post_content'];
		$post->post_meta_desc = $data['post_meta_desc'];
		$post->post_meta_keywords = $data['post_meta_keywords'];
		$post->cate_post_id = $data['cate_post_id'];
		$post->post_status = $data['post_status'];
		$post->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

		$get_image = $request->file('post_image');

		if ($get_image) {

			// Delete image old
			$post_image_old = $post->post_image;
			$path = 'public/uploads/post/' . $post_image_old;
			unlink($path);

			$get_image_name = $get_image->getClientOriginalName();
			$image_name = current(explode('.', $get_image_name));
			$new_image = $image_name . rand('0', '100') . '.' . $get_image->getClientOriginalExtension();
			$get_image->move('upload/post', $new_image);
			$post->post_image = $new_image;
		}

		$post->save();
		Session::put('message', 'Sửa bài viết thành công');
		return Redirect()->back();
	}

	public function details_post(request $request, $post_slug)
	{
		$slider = Slider::OrderBy('slider_stt', 'ASC')->where('slider_status', '1')->take(4)->get();

		$all_category_post = CategoryPost::orderBy('cate_post_id', 'ASC')->get();

		$cate_product = Category::where('category_status', '1')->orderby('category_id', 'desc')->get();

		$brand_product = Brand::where('brand_status', '1')->orderby('brand_id', 'desc')->get();

		$post = PostM::where('post_slug', $post_slug)->take(1)->get();
		foreach ($post as $key => $v_post) {
			$meta_desc = $v_post->post_desc;
			$meta_keywords = $v_post->post_slug;
			$meta_title = $v_post->post_title;
			$post_id = $v_post->post_id;
			$url_canonical = $request->url();
			$cate_post_id = $v_post->cate_post_id;
		}

		$postv = PostM::find($post_id);
		$postv->post_views = $postv->post_views + 1;
		$postv->save();


		$all_post = PostM::where('post_status', '1')->where('post_id', $post_id)->orderBy('post_id', 'ASC')->paginate(5);

		$related_post = PostM::where('post_status', '1')->where('cate_post_id', $cate_post_id)->whereNotIn('post_id', [$post_id])->orderBy('post_id', 'ASC')->get();

		return view('pages.baiviet.details_post')->with(compact('slider', 'cate_product', 'brand_product', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'all_category_post', 'all_post', 'related_post'));
	}
}
