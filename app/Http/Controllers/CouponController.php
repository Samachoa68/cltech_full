<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;


class CouponController extends Controller
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

	public function check_coupon(Request $request)
	{

		$data = $request->all();        
		$coupon = Coupon::where('coupon_code',$data['coupon'])->first();
		if($coupon){ 
			$count_coupon = $coupon->count();
			if($count_coupon>0){
				$coupon_session = Session::get('coupon');
				if($coupon_session==true){
					$is_avaiable = 0;
					if($is_avaiable==0){
						$cou[] = array(
							'coupon_code' => $coupon->coupon_code,
							'coupon_condition' => $coupon->coupon_condition,
							'coupon_number' => $coupon->coupon_number,
						);
						Session::put('coupon',$cou);
					}
				}else{
					$cou[] = array(
						'coupon_code' => $coupon->coupon_code,
						'coupon_condition' => $coupon->coupon_condition,
						'coupon_number' => $coupon->coupon_number,
					);
					Session::put('coupon',$cou);
				}
				Session::save();
				return redirect()->back()->with('message','Thêm mã giảm giá thành công');
			}

		}else{
			return redirect()->back()->with('error','Mã giảm giá không đúng');
		}
	}

	public function unset_coupon()
	{
		$coupon = Session::get('coupon');
		if($coupon==true){
			Session::forget('coupon');
			return redirect()->back()->with('message','Xóa mã khuyến mãi thành công');
		}
	}

	public function insert_coupon()
	{
		return view('admin.coupon.insert_coupon');
	}

	public function list_coupon()
	{
		$coupon = Coupon::OrderBy('coupon_id','DESC')->get();
		return view('admin.coupon.list_coupon')->with(compact('coupon'));
	}

	public function insert_coupon_code(request $request)
	{
		$this->AuthLogin();

		$coupon = new Coupon();
		$coupon->coupon_name = $request->coupon_name;		
		$coupon->coupon_time = $request->coupon_times;
		$coupon->coupon_condition = $request->coupon_condition;
		$coupon->coupon_number = $request->coupon_number;
		$coupon->coupon_code = $request->coupon_code;
		$coupon->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
		$coupon->save();

		Session::put('message','Thêm mã giảm giá thành công');
		return Redirect::to('insert-coupon');

	}

	public function delete_coupon($coupon_id)
	{
		$this->AuthLogin();
		Coupon::find($coupon_id)->delete();
		Session::put('message','Xóa mã giảm giá thành công');
		return Redirect::to('list-coupon');
	}
}
