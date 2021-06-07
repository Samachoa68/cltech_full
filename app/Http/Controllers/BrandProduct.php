<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Slider;
use App\Models\Product;
use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

use App\Imports\BrandImports;
use App\Exports\BrandExports;
use Excel;

class BrandProduct extends Controller
{

	public function AuthLogin()
	{
		$admin_id = Session::get('admin_id');
		if ($admin_id) {
			return Redirect::to('/dashboard');
		}else{
			return Redirect::to('/admin')->send();
		}
	}

	public function add_brand_product()
	{
		return view('admin.add_brand_product');
	}

	public function all_brand_product()
	{
		$this->AuthLogin();
		// $all_brand_product = DB::table('tbl_brand_product')->get();
		$all_brand_product = Brand::orderBy('brand_id','DESC')->get();
		return view('admin.all_brand_product')->with(compact('all_brand_product'));
		
	}

	public function save_brand_product(request $request)
	{
		$this->AuthLogin();

		$brand = new Brand();
		$brand->brand_name = $request->brand_product_name;		
		$brand->brand_desc = $request->brand_product_desc;
		$brand->brand_status = $request->brand_product_status;
		$brand->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
		$brand->save();

		Session::put('message','Thêm thương hiệu sản phẩm thành công');
		return Redirect::to('add-brand-product');
	}

	public function active_brand_product($brand_product_id)
	{
		$this->AuthLogin();
		Brand::find($brand_product_id)->update(['brand_status' => 1]);
		Session::put('message','Hiển thị thương hiệu sản phẩm thành công');
		return Redirect::to('all-brand-product');
	}

	public function unactive_brand_product($brand_product_id)
	{
		$this->AuthLogin();
		Brand::find($brand_product_id)->update(['brand_status' => 0]);
		Session::put('message','Ẩn thương hiệu sản phẩm thành công');
		return Redirect::to('all-brand-product');
	}

	public function edit_brand_product($brand_product_id)
	{
		$this->AuthLogin();
		// $edit_brand_product = DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->get();
		
		$edit_brand_product = Brand::find($brand_product_id);
		return view('admin.edit_brand_product')->with(compact('edit_brand_product'));
	}

	public function update_brand_product(request $request, $brand_product_id)
	{
		$this->AuthLogin();
		$brand = Brand::find($brand_product_id);

		$brand->brand_name = $request->brand_product_name;		
		$brand->brand_desc = $request->brand_product_desc;
		$brand->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
		$brand->save();

		// DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update($data);
		Session::put('message','Cập nhật thương hiệu sản phẩm thành công');
		return Redirect::to('all-brand-product');
	}

	public function delete_brand_product($brand_product_id)
	{
		$this->AuthLogin();
		Brand::find($brand_product_id)->delete();
		Session::put('message','Xóa thương hiệu sản phẩm thành công');
		return Redirect::to('all-brand-product');
	}

	//End function admin page

	public function show_brand_home(request $request, $brand_slug)
	{
		
		$slider = Slider::OrderBy('slider_stt','ASC')->where('slider_status','1')->take(4)->get();

		$all_category_post = CategoryPost::orderBy('cate_post_id','ASC')->get();

		$meta_desc = "Chuyên bán và lắp đặt máy tính, camera, phụ kiện máy tính thương hiệu";
		$meta_keywords = "máy tính, camera, lắp đặt, phụ kiện máy tính";
		$meta_title = "Home | LamGiaTech";
		$url_canonical = $request->url();

		$cate_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
		
		$brand_by_slug = Brand::where('brand_slug',$brand_slug)->first();
		$brand_id = $brand_by_slug->brand_id;

		$brand_by_id = DB::table('tbl_product')
		->join('tbl_brand_product','tbl_product.brand_id','=','tbl_brand_product.brand_id')->where('tbl_product.brand_id',$brand_id)->where('tbl_product.product_status','1')->get();

		$brand_name_product = DB::table('tbl_brand_product')->where('brand_id',$brand_id)->limit(1)->get();

		foreach($brand_name_product as $key => $val){
            //seo 
            $meta_desc = $val->brand_desc; 
            $meta_keywords = $val->brand_desc;
            $meta_title = $val->brand_name;
            $url_canonical = $request->url();
            //--seo
        }

		return view('pages.brand.show_brand')->with(compact('slider','all_category_post','meta_desc','meta_keywords','meta_title','url_canonical','cate_product','brand_product','brand_by_id','brand_name_product'));
	}

		public function import_csv_bra(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new BrandImports, $path);
        return back();
    }

    	public function export_csv_bra(){
        return Excel::download(new BrandExports , 'Brand.xlsx');
    }
}
