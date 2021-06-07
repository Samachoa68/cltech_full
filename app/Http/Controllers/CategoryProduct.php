<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use App\Http\Requests;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Brand;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

use App\Imports\ExcelImports;
use App\Exports\ExcelExports;
use Excel;

class CategoryProduct extends Controller
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

	public function add_category_product()
	{
		$this->AuthLogin();
		$category = Category::where('category_parent',0)->OrderBy('category_id','DESC')->get();
		return view('admin.add_category_product')->with(compact('category'));
	}

	public function all_category_product()
	{
		$this->AuthLogin();
		$category = Category::where('category_parent',0)->OrderBy('category_id','DESC')->get();
		$all_category_product = Category::orderBy('category_parent','DESC')->paginate(5);
		return view('admin.all_category_product')->with(compact('all_category_product','category'));
		
	}

	public function save_category_product(request $request)
	{
		$this->AuthLogin();
		
		$category = new Category();
		$category->category_name = $request->category_product_name;
		$category->meta_keywords = $request->category_product_desc;
		$category->category_parent = $request->category_parent;
		$category->slug_category_product = $request->category_slug;		
		$category->category_desc = $request->category_product_desc;
		$category->category_status = $request->category_product_status;
		
		$category->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
		$category->save();

		Session::put('message','Thêm danh mục sản phẩm thành công');
		return Redirect::to('add-category-product');
	}

	public function active_category_product($category_product_id)
	{
		
		Category::find($category_product_id)->update(['category_status' => 1]);
		Session::put('message','Hiển thị danh mục sản phẩm thành công');
		return Redirect::to('all-category-product');
	}

	public function unactive_category_product($category_product_id)
	{
		Category::find($category_product_id)->update(['category_status' => 0]);
		Session::put('message','Ẩn danh mục sản phẩm thành công');
		return Redirect::to('all-category-product');
	}

	public function edit_category_product($category_product_id)
	{
		$this->AuthLogin();
		$category = Category::OrderBy('category_id','DESC')->get();
		$edit_category_product = Category::find($category_product_id);
		return view('admin.edit_category_product')->with(compact('edit_category_product','category'));
	}

	public function update_category_product(request $request, $category_product_id)
	{
		$this->AuthLogin();

		$category = Category::find($brand_product_id);

		$category->category_name = $request->category_product_name;		
		$category->category_desc = $request->category_product_desc;
		$category->category_status = $request->category_product_status;
		$category->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
		$category->save();

		Session::put('message','Cập nhật danh mục sản phẩm thành công');
		return Redirect::to('all-category-product');
	}

	public function delete_category_product($category_product_id)
	{
		$this->AuthLogin();
		Category::find($category_product_id)->delete();
		Session::put('message','Xóa danh mục sản phẩm thành công');
		return Redirect::to('all-category-product');
	}

	//End function admin page

	public function show_category_home(request $request, $slug_category_product)
	{
		
		$slider = Slider::OrderBy('slider_stt','ASC')->where('slider_status','1')->take(4)->get();

		$all_category_post = CategoryPost::orderBy('cate_post_id','ASC')->get();

		$cate_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
		
		$category_by_slug = Category::where('slug_category_product',$slug_category_product)->get();

		foreach($category_by_slug as $key => $val){
                //seo 
			$meta_desc = $val->category_desc; 
			$meta_keywords = $val->meta_keywords;
			$meta_title = $val->category_name;
			$url_canonical = $request->url();
                //--seo
			$category_id = $val->category_id;
		}

		
		$category_by_id = DB::table('tbl_product')
		->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_product.category_id',$category_id)->where('tbl_product.product_status','1')->get();
		$cate_name_product = DB::table('tbl_category_product')->where('category_id',$category_id)->limit(1)->get();
		
		return view('pages.category.show_category')->with(compact('slider','all_category_post','meta_desc','meta_keywords','meta_title','url_canonical','cate_product','brand_product','category_by_id','cate_name_product'));
	}

	public function export_csv_cate(){
		return Excel::download(new ExcelExports , 'category.xlsx');
	}

	public function import_csv_cate(Request $request){
		$path = $request->file('file')->getRealPath();
		Excel::import(new ExcelImports, $path);
		return back();
	}

}
