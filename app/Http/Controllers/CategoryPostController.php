<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\Http\Requests;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\PostM;
use App\Models\Brand;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;


class CategoryPostController extends Controller
{
	public function AuthLogin()
	{
		$admin_id = Auth::id();
		if ($admin_id) {
			return Redirect::to('/dashboard');
		}else{
			return Redirect::to('/admin')->send();
		}
	}

	public function add_cate_post()
	{
		$this->AuthLogin();
		return view('admin.category_post.add_category_post');
	}

	public function save_cate_post(request $request)
	{
		$this->AuthLogin();		
		$cate_post = new CategoryPost();
		$cate_post->cate_post_name = $request->cate_post_name;
		$cate_post->cate_post_slug = $request->cate_post_slug;		
		$cate_post->cate_post_desc = $request->cate_post_desc;
		$cate_post->cate_post_status = $request->cate_post_status;		
		$cate_post->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
		$cate_post->save();

		Session::put('message','Thêm danh mục bài viết thành công');
		return Redirect::to('add-cate-post');
	}

	public function all_cate_post()
	{
		$this->AuthLogin();
		$all_category_post = CategoryPost::orderBy('cate_post_id','DESC')->paginate(5);
		return view('admin.category_post.all_category_post')->with(compact('all_category_post'));
		
	}

	public function active_cate_post($cate_post_id)
	{
		
		CategoryPost::find($cate_post_id)->update(['cate_post_status' => 1]);
		Session::put('message','Hiển thị danh mục bài viết thành công');
		return Redirect::to('all-cate-post');
	}

	public function unactive_cate_post($cate_post_id)
	{
		CategoryPost::find($cate_post_id)->update(['cate_post_status' => 0]);
		Session::put('message','Ẩn danh mục bài viết thành công');
		return Redirect::to('all-cate-post');
	}

	public function edit_cate_post($cate_post_id)
	{
		$this->AuthLogin();
		$edit_cate_post = CategoryPost::find($cate_post_id);
		return view('admin.category_post.edit_category_post')->with(compact('edit_cate_post'));
	}

	public function update_cate_post(request $request, $cate_post_id)
	{
		$this->AuthLogin();

		$cate_post = CategoryPost::find($cate_post_id);

		$cate_post->cate_post_name = $request->cate_post_name;
		$cate_post->cate_post_slug = $request->cate_post_slug;		
		$cate_post->cate_post_desc = $request->cate_post_desc;
		$cate_post->cate_post_status = $request->cate_post_status;		
		$cate_post->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
		$cate_post->save();

		Session::put('message','Cập nhật danh mục bài viết thành công');
		return Redirect::to('all-cate-post');
	}

	public function delete_cate_post($cate_post_id)
	{
		$this->AuthLogin();
		CategoryPost::find($cate_post_id)->delete();
		Session::put('message','Xóa danh mục bài viết thành công');
		return Redirect()->back();
	}

	//home

	public function danhmucbaiviet(request $request,$cate_post_slug)
	{	
		$slider = Slider::OrderBy('slider_stt','ASC')->where('slider_status','1')->take(4)->get();

		$all_category_post = CategoryPost::orderBy('cate_post_id','ASC')->get();

		$cate_product = Category::where('category_status','1')->orderby('category_id','desc')->get();

		$brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();

		$cate_post =CategoryPost::where('cate_post_slug',$cate_post_slug)->take(1)->get();
		foreach($cate_post as $key => $v_cate_post){
			$meta_desc = $v_cate_post->cate_post_desc;
			$meta_keywords = $v_cate_post->cate_post_slug;
			$meta_title = $v_cate_post->cate_post_name;
			$cate_post_id = $v_cate_post->cate_post_id;

			$url_canonical = $request->url();
		}

		$share_image = url('/frontend/images/home/logo.jpg');

		$all_post = PostM::with('categorypost')->where('post_status','1')->where('cate_post_id',$cate_post_id)->orderBy('post_id','ASC')->paginate(5);

		return view('pages.baiviet.show_cate_post')->with(compact('slider','cate_product','brand_product','meta_desc','meta_keywords','meta_title','url_canonical','all_category_post', 'all_post','share_image'));
	}


}
