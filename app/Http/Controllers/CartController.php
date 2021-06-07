<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();

class CartController extends Controller
{
    public function cart(request $request)
    {
        $meta_desc = "Giỏ hàng ";
        $meta_keywords = "Giỏ hàng";
        $meta_title = "Giỏ hàng";
        $url_canonical = $request->url();

        $cate_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.cart.cart_ajax')->with(compact('meta_desc','meta_keywords','meta_title','url_canonical','cate_product','brand_product'));
    }

    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_quantity' => $data['cart_product_quantity'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }

        Session::save();

    }  

    public function delete_product_cart($session_id){
        $cart = Session::get('cart');

        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');
        }else{
            return redirect()->back()->with('message','Xóa sản phẩm thất bại');
        }
    }

    public function update_qty_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart==true){
            $mesage ='';
            foreach($data['cart_qty'] as $key => $qty){
              $i=0;
                foreach($cart as $session => $val){                   
                    $i++;
                    if($val['session_id']==$key && $qty<$cart[$session]['product_quantity']){

                        $cart[$session]['product_qty'] = $qty;
                        $mesage.='<p style="color:blue">'.$i.') Cập nhật số lượng: '.$cart[$session]['product_name'].' thành công</p>';                   
                    }elseif($val['session_id']==$key && $qty>$cart[$session]['product_quantity'])
                    $mesage.='<p style="color:red">'.$i.') Cập nhật số lượng: '.$cart[$session]['product_name'].' thất bại</p>';  
                }
            }

            Session::put('cart',$cart);
            return redirect()->back()->with('message',$mesage);
        }else{
            return redirect()->back()->with('message','Cập nhật số lượng thất bại');
        }
    }

public function delete_all_product_cart(){
    $cart = Session::get('cart');
    if($cart==true){
            // Session::destroy();
        Session::forget('cart');
        // Session::forget('coupon');
        return redirect()->back()->with('message','Xóa hết giỏ thành công');
    }
}

/*    public function save_cart(request $request)
    {
    	$productid = $request->productid_hidden;
    	$quantity = $request->qty;

    	$product_info = DB::table('tbl_product')->where('product_id',$productid)->get();

        //Cart::destroy();
        foreach($product_info as $key => $pro_info){

            $data['id'] = $pro_info->product_id;
            $data['name'] = $pro_info->product_name;
            $data['qty'] = $quantity;
            $data['price'] = $pro_info->product_price;
            $data['weight'] = '68';
            $data['options']['image'] = $pro_info->product_image;
        }
        Cart::add($data);
        return redirect::to('/show-cart');
    }*/


    public function show_cart(request $request)
    {
        $meta_desc = "Giỏ hàng";
        $meta_keywords = "Giỏ hàng";
        $meta_title = "Giỏ hàng";
        $url_canonical = $request->url();

        $cate_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.cart.show_cart')->with(compact('meta_desc','meta_keywords','meta_title','url_canonical','cate_product','brand_product'));
    }

    /*public function delete_to_cart($rowId)
    {
        Cart::update($rowId,'0');
        return redirect::to('/show-cart');
    }*/

    /*public function update_cart_quantity(request $request)
    {
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;

        Cart::update($rowId, $qty);
        return redirect::to('/show-cart');
    }*/
}
