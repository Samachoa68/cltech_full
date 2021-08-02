<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Models\Category;
use App\Models\Brand;
use App\Rules\Captcha;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use App\Models\Slider;
use App\Models\Coupon;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\CategoryPost;
use Validator;  
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();

class CheckoutController extends Controller
{
	
	public function login_checkout(request $request)
	{
		$all_category_post = CategoryPost::orderBy('cate_post_id','ASC')->get();
		$slider = Slider::OrderBy('slider_stt','ASC')->where('slider_status','1')->take(4)->get();
		$meta_desc = "Chuyên bán và lắp đặt máy tính, camera, phụ kiện máy tính thương hiệu";
		$meta_keywords = "máy tính, camera, lắp đặt, phụ kiện máy tính";
		$meta_title = "Home | LamGiaTech";
		$url_canonical = $request->url();

		$cate_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
		Session::put('customer_id',null);
		return view('pages.checkout.login_checkout')->with(compact('all_category_post','slider','meta_desc','meta_keywords','meta_title','url_canonical','cate_product','brand_product'));

	}

	public function confirm_order(request $request)
	{
		$data = $request->all();
		$shipping = new Shipping();
		$shipping->shipping_name = $data['shipping_name'];
		$shipping->shipping_email = $data['shipping_email'];
		$shipping->shipping_phone = $data['shipping_phone'];
		$shipping->shipping_address = $data['shipping_address'];
		$shipping->shipping_notes = $data['shipping_notes'];
		$shipping->shipping_method = $data['shipping_method'];
		$shipping->save();
		$shipping_id = $shipping->shipping_id;

		$checkout_code = substr(md5(microtime()),rand(0,26),5);

		//coupon
		$coupon = Coupon::where('coupon_code',$data['order_coupon'])->first();
		$coupon->coupon_used = $coupon->coupon_used.','.Session::get('customer_id');
		$coupon->coupon_time = $coupon->coupon_time - 1;
		$coupon->save();

    	//get order
		$order = new Order;
		$order->customer_id = Session::get('customer_id');
		$order->shipping_id = $shipping_id;
		$order->order_status = 1;
		$order->order_code = $checkout_code;
		$order->order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');		
		$order->created_at = Carbon::now('Asia/Ho_Chi_Minh');
		$order->save();

		if(Session::get('cart')==true){
			foreach(Session::get('cart') as $key => $cart){
				$order_details = new OrderDetails;
				$order_details->order_code = $checkout_code;
				$order_details->product_id = $cart['product_id'];
				$order_details->product_name = $cart['product_name'];
				$order_details->product_price = $cart['product_price'];
				$order_details->product_sales_quantity = $cart['product_qty'];
				$order_details->product_coupon =  $data['order_coupon'];
				$order_details->product_feeship = $data['order_fee'];
				$order_details->save();
			}
		}
		Session::forget('fee');
		Session::forget('coupon');
		Session::forget('cart');
	}

	public function select_delivery_home(request $request)
	{
		$data = $request->all();
		if($data['action']){
			$output = '';
			if($data['action']=="city"){
				$select_province = Province::where('matp',$data['ma_id'])->OrderBy('maqh','ASC')->get();
				$output.='<option>---Chọn quận huyện---</option>';
				foreach($select_province as $key => $v_province){
					$output.='<option value="'.$v_province->maqh.'">'.$v_province->name_quanhuyen.'</option>';
				}
			}else{
				$select_wards = Wards::where('maqh',$data['ma_id'])->OrderBy('xaid','ASC')->get();
				$output.='<option>---Chọn xã phường---</option>';
				foreach($select_wards as $key => $v_wards){
					$output.='<option value="'.$v_wards->xaid.'">'.$v_wards->name_xaphuong.'</option>';
				}
			}
		}
		echo $output;    	
	}

	public function calculate_fee(request $request)
	{
		$data = $request->all();
		if($data['matp']){
			$feeship = Feeship::where('fee_matp',$data['matp'])->where('fee_maqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();
			$count_feeship = $feeship->count();
			if($count_feeship>0){
				foreach($feeship as $key => $fee){
					Session::put('fee',$fee->fee_feeship);
					Session::save();
				}
			}else{
				Session::put('fee',10000);
				Session::save();
			}

		}
	}

	public function del_fee(request $request)
	{
		Session::forget('fee');
		return redirect()->back();
	}


	public function add_customer(request $request)
	{

		$data = $request->validate([
			'customer_name' => 'required',
			'customer_email' => 'required',
			'customer_password' => 'required',
			'customer_phone' => 'required',
        //    'g-recaptcha-response' => new Captcha(), 		//dòng kiểm tra Captcha
       ]);

		$data['customer_name'] = $request->customer_name;
		$data['customer_email'] = $request->customer_email;
		$data['customer_password'] = md5($request->customer_password);
		$data['customer_phone'] = $request->customer_phone;

		$customer_id = DB::table('tbl_customers')->insertGetId($data);

		Session::put('customer_id',$customer_id);
		Session::put('customer_name',$request->customer_name);

		return Redirect::to('/checkout');
	}

	public function checkout(request $request)
	{
		$all_category_post = CategoryPost::orderBy('cate_post_id','ASC')->get();
		$meta_desc = "Chuyên bán và lắp đặt máy tính, camera, phụ kiện máy tính thương hiệu";
		$meta_keywords = "máy tính, camera, lắp đặt, phụ kiện máy tính";
		$meta_title = "Home | LamGiaTech";
		$url_canonical = $request->url();

		$city = City::orderby('matp','ASC')->get();
		$cate_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
		return view('pages.checkout.show_checkout')->with(compact('all_category_post','meta_desc','meta_keywords','meta_title','url_canonical','cate_product','brand_product','city'));
	}

	public function save_checkout_customer(request $request)
	{
		$data['shipping_name'] = $request->shipping_name;
		$data['shipping_email'] = $request->shipping_email;
		$data['shipping_address'] = $request->shipping_address;
		$data['shipping_phone'] = $request->shipping_phone;
		$data['shipping_notes'] = $request->shipping_notes;

		if ($data['shipping_name'] != Null && $data['shipping_address'] != Null && $data['shipping_phone'] != Null ) {
			$shipping_id = DB::table('tbl_shipping')->insertGetId($data);

			Session::put('shipping_id', $shipping_id);		

			return Redirect::to('/payment');
		}else{

			return Redirect::to('/checkout');
		}		
	}

	public function payment()
	{
		$cate_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
		return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product);
	}

	public function order_place(request $request)
	{
		//Insert payment_method
		$data = array();
		$data['payment_method'] = $request->payment_option;
		$data['payment_status'] = 'Đang chờ xử lý';
		$payment_id = DB::table('tbl_payment')->insertGetId($data);

		//Insert order
		$order_data = array();
		$order_data['customer_id'] = Session::get('customer_id');
		$order_data['shipping_id'] = Session::get('shipping_id');
		$order_data['payment_id'] = $payment_id;
		$order_data['order_total'] = Cart::total();
		$order_data['order_status'] = 'Đang chờ xử lý';
		$order_id = DB::table('tbl_order')->insertGetId($order_data);

		//Insert order_details
		$cartcontent = Cart::content();
		foreach($cartcontent as $v_cartcontent){

			$order_d_data['order_id'] = $order_id;
			$order_d_data['product_id'] = $v_cartcontent->id;
			$order_d_data['product_sales_quantity'] = $v_cartcontent->qty;
			DB::table('tbl_order_details')->insert($order_d_data);
		}
		if ($data['payment_method'] == 1) {
			Cart::destroy();
			$cate_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
			$brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
			return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product);

		}elseif ($data['payment_method'] == 2) {
			echo "Chuyển khoản ngân hàng";
		}else{
			echo "Thanh toán thẻ ghi nợ";
		}
	}

	public function login_customer(request $request)
	{

/*		    $data = $request->validate([
            'email_account' => 'required|email',
            'password_account' => 'required',
           'g-recaptcha-response' => new Captcha(), 		//dòng kiểm tra Captcha
       ]);*/


       $email = $request->email_account;
       $password = md5($request->password_account);


       $result = DB::table('tbl_customers')->where('customer_email',$email)->where('customer_password',$password)->first();

       if ($result) {
       	Session::put('customer_id',$result->customer_id);
       	return Redirect::to('/checkout');
       }else{
       	return Redirect::to('login-checkout');
       }

   }

}
