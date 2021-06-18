<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactM;
use App\Models\Slider;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryPost;

class ContactController extends Controller
{
    public function contact(Request $request)
    {
        $slider = Slider::OrderBy('slider_stt','ASC')->where('slider_status','1')->take(4)->get();
    	$meta_desc = "Liên hệ";
    	$meta_keywords = "Liên hệ";
    	$meta_title = "Liên hệ LamGiaTech";
    	$url_canonical = $request->url();

        $all_category_post = CategoryPost::orderBy('cate_post_id','ASC')->get();

        $cate_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
        $all_product = Product::where('product_status','1')->orderby('product_id','desc')->limit(4)->get();

        $contact = ContactM::find(1);

        return view('pages.contact.contact')->with(compact('slider','cate_product','brand_product','all_product','meta_desc','meta_keywords','meta_title','url_canonical', 'all_category_post','contact'));
    }

    public function add_contact()
    {
        $contact = ContactM::find(1);
        return view('admin.contact.add_contact')->with(compact('contact'));
    }

    public function save_contact(Request $request)
    {
        $data = $request->all();
        $contact = new ContactM();
        $contact->info_contact = $data['info_contact'];
        $contact->info_fanpage = $data['info_fanpage'];
        $contact->info_map = $data['info_map'];

        $path = 'upload/contact/';
        $get_image = $request->file('info_logo');
		if ($get_image) {
			$get_image_name = $get_image->getClientOriginalName();
			$image_name = current(explode('.', $get_image_name));
			$new_image = $image_name . rand('0', '100') . '.' . $get_image->getClientOriginalExtension();
			$get_image->move($path, $new_image);
			$contact->info_logo = $new_image;
		}
        $contact->save();
        return redirect()->back()->with('message','Thêm thông tin liên hệ thành công');
    }

    public function update_contact(Request $request)
    {
        $data = $request->all();
        $contact = ContactM::find(1);
        $contact->info_contact = $data['info_contact'];
        $contact->info_fanpage = $data['info_fanpage'];
        $contact->info_map = $data['info_map'];

        $path = 'upload/contact/';
        $get_image = $request->file('info_logo');
		if ($get_image) {
            unlink($path.$contact->info_logo);
			$get_image_name = $get_image->getClientOriginalName();
			$image_name = current(explode('.', $get_image_name));
			$new_image = $image_name . rand('0', '100') . '.' . $get_image->getClientOriginalExtension();
			$get_image->move($path, $new_image);
			$contact->info_logo = $new_image;
		}
        $contact->save();
        return redirect()->back()->with('message','Cập nhật thông tin liên hệ thành công');
    }
}
