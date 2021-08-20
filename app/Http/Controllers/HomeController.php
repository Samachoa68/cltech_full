<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\IconM;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{

    public function index(request $request)
    {	$icons = IconM::OrderBy('icon_id','ASC')->get();
        $slider = Slider::OrderBy('slider_stt','ASC')->where('slider_status','1')->take(4)->get();
    	$meta_desc = "Chuyên bán và lắp đặt máy tính, camera, phụ kiện máy tính";
    	$meta_keywords = "Chuyên bán và lắp đặt máy tính, camera, phụ kiện máy tính";
    	$meta_title = "Home | LamGiaTech";
    	$url_canonical = $request->url();

        $all_category_post = CategoryPost::orderBy('cate_post_id','ASC')->get();

        $cate_product = Category::where('category_status','1')->orderBy('category_order','ASC')->get();

        $cate_pro_tabs = Category::where('category_status','1')->where('category_parent','=',0)->orderBy('category_order','ASC')->get();

        $brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
        $all_product = Product::where('product_status','1')->orderby('product_id','desc')->limit(4)->get();

        return view('pages.home')->with(compact('slider','cate_product','brand_product','all_product','meta_desc','meta_keywords','meta_title','url_canonical', 'all_category_post','cate_pro_tabs','icons'));
    }

    public function search(request $request)
    {

        $slider = Slider::OrderBy('slider_stt','ASC')->where('slider_status','1')->take(4)->get();

        $all_category_post = CategoryPost::orderBy('cate_post_id','ASC')->get();

        $meta_desc = "Tìm kiếm sản phẩm";
        $meta_keywords = "Tìm kiếm sản phẩm";
        $meta_title = "Tìm kiếm sản phẩm";
        $url_canonical = $request->url();

        $keywords = $request->keywords_submit;

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $result_search = DB::table('tbl_product')->where('product_status','1')
        ->where('tbl_product.product_name','like','%'.$keywords.'%')->get();		

        return view('pages.product.search')->with(compact('slider','all_category_post','meta_desc','meta_keywords','meta_title','url_canonical','cate_product','brand_product','keywords','result_search'));
    }

        public function autocomplete_ajax(request $request)
    {

        $data = $request->all();

        if($data['query']){
            $product = Product::where('product_status','1')->where('product_name','LIKE','%'.$data['query'].'%')->get();
        }

            $output = '
            <ul class="dropdown-menu" style="display:block; position:relative">';

            foreach($product as $key => $val){
               $output .= '
               <li class="li_search_ajax"><a href="#">'.$val->product_name.'</a></li>';
            }

            $output .= '</ul>';
            echo $output;
    }
}
