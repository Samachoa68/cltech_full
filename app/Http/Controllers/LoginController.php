<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Login;
use App\Models\Product;
use App\Models\Order;
use App\Models\PostM;
use App\Models\Customer;
use App\Models\Video;
use App\Models\VisitorM;
use App\Models\Social;
use App\Models\StatisticalM;
use Illuminate\Support\Facades\Mail;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Slider;
use App\Models\CategoryPost;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Socialite;
use Session;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function forget_pw(request $request)
    {	
        $slider = Slider::OrderBy('slider_stt','ASC')->where('slider_status','1')->take(4)->get();
    	$meta_desc = "Quên mật khẩu";
    	$meta_keywords = "Quên mật khẩu";
    	$meta_title = "Home | LamGiaTech";
    	$url_canonical = $request->url();

        $all_category_post = CategoryPost::orderBy('cate_post_id','ASC')->get();

        $cate_product = Category::where('category_status','1')->orderBy('category_order','ASC')->get();

        $cate_pro_tabs = Category::where('category_status','1')->where('category_parent','<>',0)->orderBy('category_order','ASC')->get();

        $brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
        $all_product = Product::where('product_status','1')->orderby('product_id','desc')->limit(4)->get();

        return view('pages.login.forget_pw')->with(compact('slider','cate_product','brand_product','all_product','meta_desc','meta_keywords','meta_title','url_canonical', 'all_category_post','cate_pro_tabs'));
    }
    public function recover_pass(Request $request){
    	$data = $request->all();
		$now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
		$title_mail = "[Lamgiatech.com] Xác nhận đặt lại mật khẩu ".' '.$now;
		$customer = Customer::where('customer_email','=',$data['email_account'])->get();
		foreach($customer as $key => $value){
			$customer_id = $value->customer_id;
		}
		
		if($customer){
            $count_customer = $customer->count();
            if($count_customer==0){
                return redirect()->back()->with('error', 'Email chưa được đăng ký để khôi phục mật khẩu');
            }else{
               	$token_random = Str::random();
                $customer = Customer::find($customer_id);
                $customer->customer_token = $token_random;
                $customer->save();
                //send mail
              
                $to_email = $data['email_account'];//send to this email
                $link_reset_pass = url('/update-new-pass?email='.$to_email.'&token='.$token_random);
             
                $data = array("name"=>$title_mail,"body"=>$link_reset_pass,'email'=>$data['email_account']); //body of mail.blade.php
                
                Mail::send('pages.login.forget_pass_notify', ['data'=>$data] , function($message) use ($title_mail,$data){
		            $message->to($data['email'])->subject($title_mail);//send this mail with subject
		            $message->from($data['email'],$title_mail);//send from this mail
	    		});
                //--send mail
                return redirect()->back()->with('message', 'Gửi mail thành công, vui lòng vào email để reset password');
            }
        }
    }

    public function reset_new_pass(Request $request){
    	$data = $request->all();
        $token_random = Str::random();
        $customer = Customer::where('customer_email','=',$data['email'])->where('customer_token','=',$data['token'])->get();
        $count = $customer->count();
        if($count>0){
                foreach($customer as $key => $cus){
                    $customer_id = $cus->customer_id;
                }
                $reset = Customer::find($customer_id);
                $reset->customer_password = md5($data['password_account']);
                $reset->customer_token = $token_random;
                $reset->save();
                return redirect('login-checkout')->with('message', 'Khôi phục mật khẩu thành công');
        }else{
            return redirect('forget-pw')->with('error', 'Vui lòng nhập lại email vì link đã quá hạn');
        }
    }
}
