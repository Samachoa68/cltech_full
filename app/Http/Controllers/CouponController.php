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
		} else {
			return Redirect::to('/admin')->send();
		}
	}

	public function check_coupon(Request $request)
	{
		$today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
		$data = $request->all();
		if (Session::get('customer_id')) {
			$coupon = Coupon::where('coupon_code', $data['coupon'])->where('coupon_status', 1)->where('coupon_date_end', '>=', $today)->where('coupon_used', 'LIKE', '%' . Session::get('customer_id') . '%')->first();
			if ($coupon) {
				return redirect()->back()->with('error', 'Mã giảm giá đã sử dụng,vui lòng nhập mã khác');
			} else {

				$coupon_login = Coupon::where('coupon_code', $data['coupon'])->where('coupon_status', 1)->where('coupon_date_end', '>=', $today)->first();
				if ($coupon_login) {
					$count_coupon = $coupon_login->count();
					if ($count_coupon > 0) {
						$coupon_session = Session::get('coupon');
						if ($coupon_session == true) {
							$is_avaiable = 0;
							if ($is_avaiable == 0) {
								$cou[] = array(
									'coupon_code' => $coupon_login->coupon_code,
									'coupon_condition' => $coupon_login->coupon_condition,
									'coupon_number' => $coupon_login->coupon_number,

								);
								Session::put('coupon', $cou);
							}
						} else {
							$cou[] = array(
								'coupon_code' => $coupon_login->coupon_code,
								'coupon_condition' => $coupon_login->coupon_condition,
								'coupon_number' => $coupon_login->coupon_number,

							);
							Session::put('coupon', $cou);
						}
						Session::save();
						return redirect()->back()->with('message', 'Thêm mã giảm giá thành công');
					}
				} else {
					return redirect()->back()->with('error', 'Mã giảm giá không đúng - hoặc đã hết hạn');
				}
			}
			//neu chua dang nhap
		} else {
			$coupon = Coupon::where('coupon_code', $data['coupon'])->where('coupon_status', 1)->where('coupon_date_end', '>=', $today)->first();
			if ($coupon) {
				$count_coupon = $coupon->count();
				if ($count_coupon > 0) {
					$coupon_session = Session::get('coupon');
					if ($coupon_session == true) {
						$is_avaiable = 0;
						if ($is_avaiable == 0) {
							$cou[] = array(
								'coupon_code' => $coupon->coupon_code,
								'coupon_condition' => $coupon->coupon_condition,
								'coupon_number' => $coupon->coupon_number,

							);
							Session::put('coupon', $cou);
						}
					} else {
						$cou[] = array(
							'coupon_code' => $coupon->coupon_code,
							'coupon_condition' => $coupon->coupon_condition,
							'coupon_number' => $coupon->coupon_number,

						);
						Session::put('coupon', $cou);
					}
					Session::save();
					return redirect()->back()->with('message', 'Thêm mã giảm giá thành công');
				}
			} else {
				return redirect()->back()->with('error', 'Mã giảm giá không đúng - hoặc đã hết hạn');
			}
		}
	}



	public function unset_coupon()
	{
		
		if (Session::get('coupon')) {
			Session::forget('coupon');
			return redirect()->back()->with('message', 'Xóa mã khuyến mãi thành công');
		}
	}

	public function insert_coupon()
	{
		return view('admin.coupon.insert_coupon');
	}

	public function list_coupon()
	{
		$today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y/m/d');

		$coupon = Coupon::OrderBy('coupon_id', 'DESC')->get();

		return view('admin.coupon.list_coupon')->with(compact('coupon', 'today'));
	}

	public function insert_coupon_code(request $request)
	{
		$this->AuthLogin();

		$coupon = new Coupon();
		$coupon->coupon_name = $request->coupon_name;
		$coupon->coupon_code = $request->coupon_code;
		$coupon->coupon_date_start = $request->coupon_date_start;
		$coupon->coupon_date_end = $request->coupon_date_end;
		$coupon->coupon_time = $request->coupon_times;
		$coupon->coupon_condition = $request->coupon_condition;
		$coupon->coupon_number = $request->coupon_number;
		$coupon->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
		$coupon->save();

		Session::put('message', 'Thêm mã giảm giá thành công');
		return Redirect::to('insert-coupon');
	}

	public function delete_coupon($coupon_id)
	{
		$this->AuthLogin();
		Coupon::find($coupon_id)->delete();
		Session::put('message', 'Xóa mã giảm giá thành công');
		return Redirect::to('list-coupon');
	}
}
