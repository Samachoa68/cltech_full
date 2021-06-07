<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Models\Slider;
use App\Models\Category;
use App\Models\CategoryPost;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{

    public function index(request $request)
    {	
        $slider = Slider::OrderBy('slider_stt','ASC')->where('slider_status','1')->take(4)->get();
    	$meta_desc = "Chuyên bán và lắp đặt máy tính, camera, phụ kiện máy tính";
    	$meta_keywords = "Chuyên bán và lắp đặt máy tính, camera, phụ kiện máy tính";
    	$meta_title = "Home | LamGiaTech";
    	$url_canonical = $request->url();

        $all_category_post = CategoryPost::orderBy('cate_post_id','ASC')->get();

        $cate_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $all_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(4)->get();

        return view('pages.home')->with(compact('slider','cate_product','brand_product','all_product','meta_desc','meta_keywords','meta_title','url_canonical', 'all_category_post'));
    }

    public function search(request $request)
    {

        $meta_desc = "Tìm kiếm sản phẩm";
        $meta_keywords = "Tìm kiếm sản phẩm";
        $meta_title = "Tìm kiếm sản phẩm";
        $url_canonical = $request->url();

        $keywords = $request->keywords_submit;

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $result_search = DB::table('tbl_product')->where('product_status','1')
        ->where('tbl_product.product_name','like','%'.$keywords.'%')->get();		

        return view('pages.product.search')->with(compact('meta_desc','meta_keywords','meta_title','url_canonical','cate_product','brand_product','keywords','result_search'));
    }
}
