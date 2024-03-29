<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Brand;
use App\Models\Product;
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
		} else {
			return Redirect::to('/admin')->send();
		}
	}

	public function add_category_product()
	{
		$this->AuthLogin();
		$category = Category::where('category_parent', 0)->OrderBy('category_id', 'DESC')->get();
		return view('admin.add_category_product')->with(compact('category'));
	}

	public function all_category_product()
	{
		$this->AuthLogin();
		$category = Category::where('category_parent', 0)->OrderBy('category_id', 'DESC')->get();
		$all_category_product = Category::orderBy('category_parent', 'DESC')->orderBy('category_order', 'ASC')->paginate(5);
		return view('admin.all_category_product')->with(compact('all_category_product', 'category'));
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

		Session::put('message', 'Thêm danh mục sản phẩm thành công');
		return Redirect::to('add-category-product');
	}

	public function active_category_product($category_product_id)
	{

		Category::find($category_product_id)->update(['category_status' => 1]);
		Session::put('message', 'Hiển thị danh mục sản phẩm thành công');
		return Redirect::to('all-category-product');
	}

	public function unactive_category_product($category_product_id)
	{
		Category::find($category_product_id)->update(['category_status' => 0]);
		Session::put('message', 'Ẩn danh mục sản phẩm thành công');
		return Redirect::to('all-category-product');
	}

	public function edit_category_product($category_product_id)
	{
		$this->AuthLogin();
		$category = Category::OrderBy('category_id', 'DESC')->get();
		$edit_category_product = Category::find($category_product_id);
		return view('admin.edit_category_product')->with(compact('edit_category_product', 'category'));
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

		Session::put('message', 'Cập nhật danh mục sản phẩm thành công');
		return Redirect::to('all-category-product');
	}

	public function delete_category_product($category_product_id)
	{
		$this->AuthLogin();
		Category::find($category_product_id)->delete();
		Session::put('message', 'Xóa danh mục sản phẩm thành công');
		return Redirect::to('all-category-product');
	}

	//End function admin page

	public function show_category_home(request $request, $slug_category_product)
	{

		$slider = Slider::OrderBy('slider_stt', 'ASC')->where('slider_status', '1')->take(4)->get();

		$all_category_post = CategoryPost::orderBy('cate_post_id', 'ASC')->get();

		$cate_product = Category::where('category_status', '1')->orderby('category_id', 'desc')->get();
		$brand_product = Brand::where('brand_status', '1')->orderby('brand_id', 'desc')->get();

		$category_by_slug = Category::where('slug_category_product', $slug_category_product)->get();

		foreach ($category_by_slug as $key => $val) {
			//seo 
			$meta_desc = $val->category_desc;
			$meta_keywords = $val->meta_keywords;
			$meta_title = $val->category_name;
			$url_canonical = $request->url();
			//--seo
			$category_id = $val->category_id;
		}

		$min_price = Product::min('product_price');
        $max_price = Product::max('product_price');

        $min_price_range = $min_price + 5000000;
        $max_price_range = $max_price + 10000000;

		if (isset($_GET['sort_by'])) {
			$sort_by = $_GET['sort_by'];

			if ($sort_by == 'tang_dan') {
				$category_by_id = Product::with('category')->where('category_id', $category_id)->where('product_status', '1')->orderBy('product_price', 'ASC')->paginate(6)->appends(request()->query());
			} elseif ($sort_by == 'giam_dan') {
				$category_by_id = Product::with('category')->where('category_id', $category_id)->where('product_status', '1')->orderBy('product_price', 'DESC')->paginate(6)->appends(request()->query());
			} elseif ($sort_by == 'kytu_az') {
				$category_by_id = Product::with('category')->where('category_id', $category_id)->where('product_status', '1')->orderBy('product_name', 'ASC')->paginate(6)->appends(request()->query());
			} elseif ($sort_by == 'kytu_za') {
				$category_by_id = Product::with('category')->where('category_id', $category_id)->where('product_status', '1')->orderBy('product_name', 'ASC')->paginate(6)->appends(request()->query());
			}
		}elseif(isset($_GET['start_price']) && $_GET['end_price']){

			$min_price = $_GET['start_price'];
			$max_price = $_GET['end_price'];
		
			$category_by_id = Product::with('category')->where('category_id', $category_id)->whereBetween('product_price',[$min_price,$max_price])->orderBy('product_price','ASC')->paginate(6);
		} else {
			$category_by_id = Product::with('category')->where('category_id', $category_id)->where('product_status', '1')->orderBy('product_id', 'ASC')->paginate(6);
		}

		$cate_name_product = Category::where('category_id', $category_id)->limit(1)->get();


		return view('pages.category.show_category')->with(compact('slider', 'all_category_post', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'cate_product', 'brand_product', 'category_by_id', 'cate_name_product','min_price','max_price','min_price_range','max_price_range'));
	}

	public function export_csv_cate()
	{
		return Excel::download(new ExcelExports, 'category.xlsx');
	}

	public function import_csv_cate(Request $request)
	{
		$path = $request->file('file')->getRealPath();
		Excel::import(new ExcelImports, $path);
		return back();
	}

	public function arrange_category(Request $request)
	{

		$this->AuthLogin();

		$data = $request->all();
		$cate_id = $data["page_id_array"];

		foreach ($cate_id as $key => $value) {
			$category = Category::find($value);
			$category->category_order = $key;
			$category->save();
		}
		echo 'Updated';
	}

	public function product_tabs(Request $request)
	{

		$data = $request->all();

		$output = '';

		$sub_cate = Category::where('category_parent',$data['cate_id'])->get();
		$cate_arr = array();
		foreach($sub_cate as $key => $v_sub_cate){
			$cate_arr[] = $v_sub_cate->category_id;
		}
		array_push($cate_arr,$data['cate_id']);
		// print_r($cate_arr);
		$product = Product::whereIn('category_id', $cate_arr)->orderBy('product_id', 'DESC')->get();

		$product_count = $product->count();

		if ($product_count > 0) {

			$output .= ' <div class="tab-content">
			<div class="tab-pane fade active in" id="tshirt" >
			';
			foreach ($product as $key => $val) {
				$output .= '<div class="col-sm-3">
				<div class="product-image-wrapper">
				<div class="single-products">
				<div class="productinfo text-center">
				<img src="' . url('upload/product/' . $val->product_image) . '" alt="' . $val->product_name . '" />
				<h2>' . number_format($val->product_price, 0, ',', '.') . ' VNĐ</h2>
				<p>' . $val->product_name . '</p>
				<a href="' . url('/details-product/' . $val->product_slug) . '" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Xem chi tiết</a>
				
				</div>
				
				</div>
				</div>
				</div>';
			}

			$output .= '
			</div>
			</div>
			';
		} else {
			$output .= ' <div class="tab-content">
	
		   <div class="tab-pane fade active in" id="tshirt" >
	
		   <div class="col-sm-12s">
		   <p style="color:red;text-align:center;">Hiện chưa có sản phẩm trong danh mục này</p>
		   </div>
	
		   </div>
		   </div>
	
		   ';
		}


		echo $output;
	}
}
