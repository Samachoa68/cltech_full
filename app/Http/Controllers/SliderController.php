<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class SliderController extends Controller
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

    public function list_slider()
	{
		$this->AuthLogin();
		$all_slider = Slider::orderBy('slider_id','DESC')->get();
		return view('admin.slider.list_slider')->with(compact('all_slider'));
		
	}
	public function add_slider()
	{
		return view('admin.slider.add_slider');
	}

	public function insert_slider(request $request)
	{
		$this->AuthLogin();

		$slider = new Slider();
		$slider->slider_stt = $request->slider_stt;
		$slider->slider_name = $request->slider_name;		
		$slider->slider_desc = $request->slider_desc;
		$slider->slider_status = $request->slider_status;
		$slider->updated_at = Carbon::now('Asia/Ho_Chi_Minh');				

		$get_image = $request->file('slider_image');
		if($get_image){
			$get_image_name = $get_image->getClientOriginalName();
			$image_name = current(explode('.', $get_image_name));
			$new_image = $image_name.rand('0','100').'.'.$get_image->getClientOriginalExtension();
			$get_image->move('upload/slider', $new_image);
		
		$slider->slider_image = $new_image;		
		$slider->save();
		Session::put('message','Thêm slider thành công');
		return Redirect::to('list-slider');
		}else{
			Session::put('message','Vui lòng thêm hình ảnh slide');
		return Redirect::to('add-slider');
		}

	}

		public function active_slider($slider_id)
	{
		Slider::where('slider_id',$slider_id)->update(['slider_status' => 1]);
		Session::put('message','Hiển thị slide thành công');
		return Redirect::to('list-slider');
	}

	public function unactive_slider($slider_id)
	{
		Slider::where('slider_id',$slider_id)->update(['slider_status' => 0]);
		Session::put('message','Ẩn slide thành công');
		return Redirect::to('list-slider');
	}

		public function delete_slider($slider_id)
	{
		$this->AuthLogin();
		Slider::find($slider_id)->delete();
		Session::put('message','Xóa slide thành công');
		return Redirect::to('list-slider');
	}
}
