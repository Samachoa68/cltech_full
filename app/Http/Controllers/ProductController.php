<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use File;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\CategoryPost;
use App\Models\Brand;
use App\Models\RatingM;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use App\Imports\ProductImport;
use App\Exports\ProductExports;
use Excel;

class ProductController extends Controller
{
	public function add_product()
	{
		$cate_product = Category::orderby('category_id', 'desc')->get();
		$brand_product = Brand::orderby('brand_id', 'desc')->get();

		return view('admin.add_product')->with(compact('cate_product', 'brand_product'));
	}

	public function all_product()
	{

		$all_product = Product::join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
			->join('tbl_brand_product', 'tbl_brand_product.brand_id', '=', 'tbl_product.brand_id')->get();

		return view('admin.all_product')->with(compact('all_product'));
	}

	public function save_product(request $request)
	{

		$data = array();
		$product_price = filter_var($request->product_price,FILTER_SANITIZE_NUMBER_INT);
		$data['product_name'] = $request->product_name;
		$data['product_slug'] = $request->product_slug;
		$data['product_tags'] = $request->product_tags;
		$data['product_quantity'] = $request->product_quantity;
		$data['product_desc'] = $request->product_desc;
		$data['product_content'] = $request->product_content;
		$data['product_price'] = $product_price;
		$data['category_id'] = $request->product_cate;
		$data['brand_id'] = $request->product_brand;
		$data['product_status'] = $request->product_status;
		$data['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh');

		$path = 'upload/product/';
		$path_gallery = 'upload/gallery/';
		$path_document = 'upload/document/';

		$get_image = $request->file('product_image');
		if ($get_image) {
			$get_image_name = $get_image->getClientOriginalName();
			$image_name = current(explode('.', $get_image_name));
			$new_image = $image_name . rand('0', '100') . '.' . $get_image->getClientOriginalExtension();
			$get_image->move($path, $new_image);
			File::copy($path . $new_image, $path_gallery . $new_image);
			$data['product_image'] = $new_image;
		}

		$get_document = $request->file('product_file');
		if ($get_document) {
			$get_document_name = $get_document->getClientOriginalName();
			$document_name = current(explode('.', $get_document_name));
			$new_document = $document_name . rand('0', '100') . '.' . $get_document->getClientOriginalExtension();
			$get_document->move($path_document, $new_document);
			$data['product_file'] = $new_document;
		}


		$pro_id = Product::insertGetId($data);

		$gallery = new Gallery();
		$gallery->gallery_name = $new_image;
		$gallery->gallery_image = $new_image;
		$gallery->product_id = $pro_id;
		$gallery->save();
		Session::put('message', 'Thêm sản phẩm thành công');
		return Redirect::to('add-product');
	}

	public function active_product($product_id)
	{
		Product::where('product_id', $product_id)->update(['product_status' => 1]);
		Session::put('message', 'Hiển thị sản phẩm thành công');
		return Redirect::to('all-product');
	}

	public function unactive_product($product_id)
	{
		Product::where('product_id', $product_id)->update(['product_status' => 0]);
		Session::put('message', 'Ẩn sản phẩm thành công');
		return Redirect::to('all-product');
	}

	public function edit_product($product_id)
	{
		$cate_product = Category::orderby('category_id', 'desc')->get();
		$brand_product = Brand::orderby('brand_id', 'desc')->get();
		$edit_product = Product::where('product_id', $product_id)->get();
		return view('admin.edit_product')->with(compact('cate_product', 'brand_product', 'edit_product'));
	}

	public function update_product(request $request, $product_id)
	{

		$data = array();
		$product_price = filter_var($request->product_price,FILTER_SANITIZE_NUMBER_INT);
		$data['product_name'] = $request->product_name;
		$data['product_slug'] = $request->product_slug;
		$data['product_tags'] = $request->product_tags;
		$data['product_quantity'] = $request->product_quantity;
		$data['product_desc'] = $request->product_desc;
		$data['product_content'] = $request->product_content;
		$data['product_price'] = $product_price;
		$data['category_id'] = $request->product_cate;
		$data['brand_id'] = $request->product_brand;
		$data['product_status'] = $request->product_status;
		$data['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh');
		$get_image = $request->file('product_image');

		$path = 'upload/product/';
		$path_gallery = 'upload/gallery/';
		$path_document = 'upload/document/';

		$get_document = $request->file('product_file');
		if ($get_document) {
			$pro = Product::find($product_id);
			if($pro->product_file){
				unlink($path_document . $pro->product_file);
			}		

			$get_document_name = $get_document->getClientOriginalName();
			$document_name = current(explode('.', $get_document_name));
			$new_document = $document_name . rand('0', '100') . '.' . $get_document->getClientOriginalExtension();
			$get_document->move($path_document, $new_document);
			$data['product_file'] = $new_document;
		}

		if ($get_image) {
			$pro = Product::find($product_id);
			unlink($path . $pro->product_image);

			/*$gallery_old = Gallery::where('product_id',$product_id)->where('gallery_image',$pro->product_image)->first();
			unlink($path_gallery.$gallery_old->gallery_image);*/

			$get_image_name = $get_image->getClientOriginalName();
			$image_name = current(explode('.', $get_image_name));
			$new_image = $image_name . rand('0', '100') . '.' . $get_image->getClientOriginalExtension();
			$get_image->move($path, $new_image);
			File::copy($path . $new_image, $path_gallery . $new_image);
			$data['product_image'] = $new_image;

			$gallery = new Gallery();
			$gallery->gallery_name = $new_image;
			$gallery->gallery_image = $new_image;
			$gallery->product_id = $product_id;
			$gallery->save();
		}

		Product::find($product_id)->update($data);
		Session::put('message', 'Cập nhật sản phẩm thành công');
		return Redirect::to('all-product');
	}

	public function delete_document(Request $request)
	{	
		$product_id = $request->product_id;	
		$path_document = 'upload/document/';
		$pro = Product::find($product_id);
		unlink($path_document . $pro->product_file);
		$pro->product_file = null;
		$pro->save();
	}

	public function delete_product($product_id)
	{
		Product::where('product_id', $product_id)->delete();
		Session::put('message', 'Xóa sản phẩm thành công');
		return Redirect::to('all-product');
	}

	//End Admin page
	public function details_product(request $request, $product_slug)
	{

		$slider = Slider::OrderBy('slider_stt', 'ASC')->where('slider_status', '1')->take(4)->get();

		$all_category_post = CategoryPost::orderBy('cate_post_id', 'ASC')->get();

		$cate_product = Category::where('category_status', '1')->orderby('category_id', 'desc')->get();
		$brand_product = Brand::where('brand_status', '1')->orderby('brand_id', 'desc')->get();

		$details_product = Product::where('product_slug', $product_slug)
			->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
			->join('tbl_brand_product', 'tbl_brand_product.brand_id', '=', 'tbl_product.brand_id')->get();

		foreach ($details_product as $key => $value) {
			$category_id = $value->category_id;
			$product_id = $value->product_id;
			$product_cate = $value->category_name;
			$cate_slug = $value->slug_category_product;
			//seo
			$meta_desc = $value->product_desc;
			$meta_keywords = $value->product_slug;
			$meta_title = $value->product_name;
			$url_canonical = $request->url();
			//--seo
		}

		//Gallery
		$gallery = Gallery::where('product_id', $product_id)->get();

		$rating = RatingM::where('product_id', $product_id)->avg('rating');
		$rating_avg = round($rating);

		$related_product = Product::join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
			->join('tbl_brand_product', 'tbl_brand_product.brand_id', '=', 'tbl_product.brand_id')->where('tbl_category_product.category_id', $category_id)->wherenotin('tbl_product.product_slug', [$product_slug])->orderby(DB::raw('RAND()'))->paginate(3);

			$productv = Product::find($product_id);
			$productv->product_views = $productv->product_views + 1;
			$productv->save();


		return view('pages.product.show_details')->with(compact('slider', 'all_category_post', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'cate_product', 'brand_product', 'details_product', 'related_product', 'gallery', 'product_cate', 'cate_slug','rating_avg'));
	}

	public function import_csv_pro(Request $request)
	{
		$path = $request->file('file')->getRealPath();
		Excel::import(new ProductImport, $path);
		return back();
	}

	public function export_csv_pro()
	{
		return Excel::download(new ProductExports, 'Product.xlsx');
	}

	public function tag(request $request, $product_tag)
	{

		$slider = Slider::OrderBy('slider_stt', 'ASC')->where('slider_status', '1')->take(4)->get();

		$all_category_post = CategoryPost::orderBy('cate_post_id', 'ASC')->get();

		$cate_product = Category::where('category_status', '1')->orderby('category_id', 'desc')->get();
		$brand_product = Brand::where('brand_status', '1')->orderby('brand_id', 'desc')->get();


		//               //seo
		$meta_desc = 'Tags tìm kiếm:' . $product_tag;
		$meta_keywords = 'Tags tìm kiếm:' . $product_tag;
		$meta_title = 'Tags tìm kiếm:' . $product_tag;
		$url_canonical = $request->url();
		//               //--seo


		$tags = str_replace('-', ' ', $product_tag);

		$pro_tag = Product::where('product_status', 1)->where('product_name', 'LIKE', '%' . $tags . '%')->orWhere('product_slug', 'LIKE', '%' . $tags . '%')->orWhere('product_tags', 'LIKE', '%' . $tags . '%')->get();


		return view('pages.tag.tag')->with(compact('slider', 'all_category_post', 'cate_product', 'brand_product', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'pro_tag', 'tags'));
	}

	public function product_quickview(Request $request)
	{
		$product_id = $request->pro_id;
		$product = Product::find($product_id);

		$gallery = Gallery::where('product_id', $product_id)->get();
		$output['product_gallery'] = '';
		foreach ($gallery as $key => $gal) {
			$output['product_gallery'] .= '<img src="{{URL::to(upload/product/' . $gal->gallery_image . ')}}" alt="" />';
		}

		$output['product_name'] = $product->product_name;
		$output['product_id'] = $product->product_id;
		$output['product_desc'] = $product->product_desc;
		$output['product_content'] = $product->product_content;
		$output['product_price'] = number_format($product->product_price, 0, ',', '.') . 'VNĐ';
		$output['product_image'] = '<p><img width="100%" src="upload/product/' . $product->product_image . '"></p>';

		$output['product_button'] = '<input type="button" value="Mua ngay" class="btn btn-primary btn-sm add-to-cart-quickview" id="buy_quickview" data-id_product="' . $product->product_id . '"  name="add-to-cart">';

		$output['product_quickview_value'] = '
		<input type="hidden" value="' . $product->product_id . '" class="cart_product_id_' . $product->product_id . '">
		<input type="hidden" value="' . $product->product_name . '" class="cart_product_name_' . $product->product_id . '">
		<input type="hidden" value="' . $product->product_quantity . '" class="cart_product_quantity_' . $product->product_id . '">
		<input type="hidden" value="' . $product->product_image . '" class="cart_product_image_' . $product->product_id . '">
		<input type="hidden" value="' . $product->product_price . '" class="cart_product_price_' . $product->product_id . '">
		<input type="hidden" value="1" class="cart_product_qty_' . $product->product_id . '">';

		echo json_encode($output);
	}

	public function insert_rating(Request $request)
	{
		$data = $request->all();
		$rating = new RatingM();
		$rating->product_id = $data['product_id'];
		$rating->rating = $data['index'];
		$rating->save();
		echo 'done';
	}
}
