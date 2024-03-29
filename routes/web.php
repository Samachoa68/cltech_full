<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Change Language
Route::get('lang/{locale}',function($locale){
	if(! in_array($locale,['en','vi'])){
		abort(404);
	}
	session()->put('locale',$locale);
	return redirect()->back();
});

//Frontend
Route::get('/','HomeController@index');
Route::get('trang-chu', 'HomeController@index');
Route::post('search','HomeController@search');
Route::post('autocomplete-ajax','HomeController@autocomplete_ajax');


//Danh muc san pham trang chu
Route::get('danh-muc-san-pham/{slug_category_product}','CategoryProduct@show_category_home');
Route::get('thuong-hieu-san-pham/{brand_slug}','BrandProduct@show_brand_home');
Route::get('details-product/{product_slug}','ProductController@details_product');

//Send Mail
Route::get('send-mail','MailController@send_mail');
Route::get('send-coupon/{coupon_id}','MailController@send_coupon');
Route::get('send-coupon-vip/{coupon_id}','MailController@send_coupon_vip');
Route::get('/update-new-pass','MailController@update_new_pass');

//Login facebook
Route::get('/login-facebook','AdminController@login_facebook');
Route::get('/admin/callback','AdminController@callback_facebook');

//Login  google
Route::get('/login-google','AdminController@login_google');
Route::get('/google/callback','AdminController@callback_google');

//Login
Route::get('/forget-pw','LoginController@forget_pw');
Route::post('/recover-pass','LoginController@recover_pass');
Route::post('/reset-new-pass','LoginController@reset_new_pass');

//login customer by google
Route::get('/login-customer-google','LoginController@login_customer_google');
Route::get('/customer/google/callback','LoginController@callback_customer_google');

//login customer by Facebook
Route::get('/login-facebook-customer','LoginController@login_facebook_customer');
Route::get('/customer/facebook/callback','LoginController@callback_facebook_customer');


//Backend
Route::get('admin','AdminController@index');
Route::get('dashboard','AdminController@show_dashboard');
Route::get('logout','AdminController@logout');
Route::post('admin-dashboard','AdminController@dashboard');
Route::post('filter-by-date','AdminController@filter_by_date');
Route::post('filter30-days','AdminController@filter30_days');
Route::post('dashboard-filter','AdminController@dashboard_filter');


//Category Product
Route::get('add-category-product','CategoryProduct@add_category_product');
Route::get('edit-category-product/{category_product_id}','CategoryProduct@edit_category_product');
Route::get('delete-category-product/{category_product_id}','CategoryProduct@delete_category_product');
Route::get('all-category-product','CategoryProduct@all_category_product');

Route::get('active-category-product/{category_product_id}','CategoryProduct@active_category_product');
Route::get('unactive-category-product/{category_product_id}','CategoryProduct@unactive_category_product');

Route::post('save-category-product','CategoryProduct@save_category_product');
Route::post('update-category-product/{category_product_id}','CategoryProduct@update_category_product');

Route::post('arrange-category','CategoryProduct@arrange_category');

Route::post('export-csv-cate','CategoryProduct@export_csv_cate');
Route::post('import-csv-cate','CategoryProduct@import_csv_cate');

Route::post('product-tabs','CategoryProduct@product_tabs');


//Brand Product
Route::get('add-brand-product','BrandProduct@add_Brand_product');
Route::get('edit-brand-product/{brand_product_id}','BrandProduct@edit_brand_product');
Route::get('delete-brand-product/{brand_product_id}','BrandProduct@delete_brand_product');
Route::get('all-brand-product','BrandProduct@all_Brand_product');

Route::get('active-brand-product/{brand_product_id}','BrandProduct@active_brand_product');
Route::get('unactive-brand-product/{Brand_product_id}','BrandProduct@unactive_brand_product');

Route::post('save-brand-product','BrandProduct@save_brand_product');
Route::post('update-brand-product/{brand_product_id}','BrandProduct@update_brand_product');

Route::post('export-csv-bra','BrandProduct@export_csv_bra');
Route::post('import-csv-bra','BrandProduct@import_csv_bra');

//Product
Route::group(['middleware'=> 'auth.roles'], function(){
	Route::get('add-product','ProductController@add_product');
	Route::get('edit-product/{product_id}','ProductController@edit_product');
	Route::get('delete-product/{product_id}','ProductController@delete_product');
	Route::get('all-product','ProductController@all_product');
});


Route::get('active-product/{brand_product_id}','ProductController@active_product');
Route::get('unactive-product/{brand_product_id}','ProductController@unactive_product');

Route::post('save-product','ProductController@save_product');
Route::post('update-product/{product_id}','ProductController@update_product');

Route::post('export-csv-pro','ProductController@export_csv_pro');
Route::post('import-csv-pro','ProductController@import_csv_pro');

Route::post('product-quickview','ProductController@product_quickview');
Route::post('delete-document','ProductController@delete_document');


//Category Post
Route::get('add-cate-post','CategoryPostController@add_cate_post');
Route::get('all-cate-post','CategoryPostController@all_cate_post');
Route::get('edit-cate-post/{cate_post_id}','CategoryPostController@edit_cate_post');
Route::get('delete-cate-post/{cate_post_id}','CategoryPostController@delete_cate_post');

Route::post('save-cate-post','CategoryPostController@save_cate_post');
Route::post('update-cate-post/{cate_post_id}','CategoryPostController@update_cate_post');

Route::get('active-cate-post/{cate_post_id}','CategoryPostController@active_cate_post');
Route::get('unactive-cate-post/{cate_post_id}','CategoryPostController@unactive_cate_post');

//Post
Route::get('add-post','PostController@add_post');
Route::get('all-post','PostController@all_post');
Route::get('delete-post/{post_id}','PostController@delete_post');
Route::get('edit-post/{post_id}','PostController@edit_post');

Route::post('save-post','PostController@save_post');
Route::post('update-post/{post_id}','PostController@update_post');

//Bai viet
Route::get('danh-muc-bai-viet/{cate_post_slug}','CategoryPostController@danhmucbaiviet');
Route::get('details-post/{post_slug}','PostController@details_post');

//Cart
Route::post('save-cart','CartController@save_cart');
Route::post('update-cart-quantity','CartController@update_cart_quantity');
Route::post('update-qty-cart','CartController@update_qty_cart');
Route::post('add-cart-ajax','CartController@add_cart_ajax');
Route::get('show-cart','CartController@show_cart');
Route::get('cart','CartController@cart');
Route::get('delete-to-cart/{rowId}','CartController@delete_to_cart');
Route::get('delete-product-cart/{session_id}','CartController@delete_product_cart');
Route::get('delete-all-product-cart','CartController@delete_all_product_cart');
Route::get('show-cart-menu','CartController@show_cart_menu');
Route::get('cart-hover-menu','CartController@cart_hover_menu');

//Checkout
Route::post('confirm-order','CheckoutController@confirm_order');
Route::post('calculate-fee','CheckoutController@calculate_fee');
Route::post('select-delivery-home','CheckoutController@select_delivery_home');
Route::post('add-customer','CheckoutController@add_customer');
Route::post('login-customer','CheckoutController@login_customer');
Route::post('save-checkout-customer','CheckoutController@save_checkout_customer');
Route::post('order-place','CheckoutController@order_place');
Route::get('login-checkout','CheckoutController@login_checkout');
Route::get('checkout','CheckoutController@checkout');
Route::get('payment','CheckoutController@payment');
Route::get('del-fee','CheckoutController@del_fee');

//Coupon
Route::post('check-coupon','CouponController@check_coupon');

Route::get('insert-coupon','CouponController@insert_coupon');
Route::get('unset-coupon','CouponController@unset_coupon');
Route::get('list-coupon','CouponController@list_coupon');
Route::get('delete-coupon/{coupon_id}','CouponController@delete_coupon');
Route::post('insert-coupon-code','CouponController@insert_coupon_code');

//Order
Route::get('print-order/{checkuot_order}','OrderController@print_order');
Route::get('manage-order','OrderController@manage_order');
Route::get('view-order/{order_code}','OrderController@view_order');
Route::post('update-order-status','OrderController@update_order_status');
Route::post('update-qty','OrderController@update_qty');
Route::get('history','OrderController@history');
Route::get('view-history-order/{order_code}','OrderController@view_history_order');

//Delivery
Route::get('delivery','DeliveryController@delivery');
Route::post('select-delivery','DeliveryController@select_delivery');
Route::post('insert-delivery','DeliveryController@insert_delivery');
Route::post('select-feeship','DeliveryController@select_feeship');
Route::post('update-delivery','DeliveryController@update_delivery');

//Slider
Route::get('list-slider','SliderController@list_slider');
Route::get('add-slider','SliderController@add_slider');
Route::post('insert-slider','SliderController@insert_slider');
Route::get('active-slider/{slider_id}','SliderController@active_slider');
Route::get('unactive-slider/{slider_id}','SliderController@unactive_slider');
Route::get('delete-slider/{slider_id}','SliderController@delete_slider');

//Authentication Roles
Route::get('register-auth','AuthController@register_auth');
Route::post('register','AuthController@register');
Route::get('login-auth','AuthController@login_auth');
Route::post('login','AuthController@login');
Route::get('logout-auth','AuthController@logout_auth');

//User
Route::get('users','UserController@index')->middleware('auth.roles');
Route::get('delete-user-roles/{admin_id}','UserController@delete_user_roles')->middleware('auth.roles');
Route::get('add-users','UserController@add_users')->middleware('auth.roles');
Route::post('assign-roles','UserController@assign_roles');
Route::post('store-users','UserController@store_users')->middleware('auth.roles');

Route::get('impersonate/{admin_id}','UserController@impersonate');
Route::get('impersonate-destroy','UserController@impersonate_destroy');

//Gallery
Route::get('add-gallery/{product_id}','GalleryController@add_gallery');
Route::post('select-gallery','GalleryController@select_gallery');
Route::post('insert-gallery/{pro_id}','GalleryController@insert_gallery');
Route::post('update-gallery-name','GalleryController@update_gallery_name');
Route::post('delete-gallery','GalleryController@delete_gallery');
Route::post('update-gallery','GalleryController@update_gallery');

//Video
Route::get('video','VideoController@video');
Route::get('show-video','VideoController@show_video');
Route::post('select-video','VideoController@select_video');
Route::post('insert-video','VideoController@insert_video');
Route::post('update-video','VideoController@update_video');
Route::post('delete-video','VideoController@delete_video');
Route::post('update-video-image','VideoController@update_video_image');
Route::post('watch-video','VideoController@watch_video');


//Tags
Route::get('tag/{pro_tag}','ProductController@tag');

//Comment
Route::get('list-comment','CommentController@list_comment');
Route::post('load-comment','CommentController@load_comment');
Route::post('insert-comment','CommentController@insert_comment');
Route::post('approve-comment','CommentController@approve_comment');
Route::post('reply-comment','CommentController@reply_comment');

//Rating
Route::post('insert-rating','ProductController@insert_rating');

//Contact
Route::get('contact','ContactController@contact');
Route::get('add-contact','ContactController@add_contact');
Route::get('list-icon','ContactController@list_icon');
Route::get('list-partner','ContactController@list_partner');
Route::get('delete-partner','ContactController@delete_partner');
Route::get('delete-icon','ContactController@delete_icon');
Route::post('save-contact','ContactController@save_contact');
Route::post('update-contact','ContactController@update_contact');
Route::post('add-icon','ContactController@add_icon');
Route::post('add-partner','ContactController@add_partner');

//Ckeditor
Route::post('uploads-ckeditor','CkeditorController@ckeditor_image');
Route::get('file-browser','CkeditorController@file_browser');

//Drive document
Route::get('create-document','DocumentController@create_document');
Route::get('upload-file','DocumentController@upload_file');
Route::get('upload-image','DocumentController@upload_image');
Route::get('upload-video','DocumentController@upload_video');

Route::get('download_document/{path}/{name}','DocumentController@download_document');
Route::get('delete_document/{path}','DocumentController@delete_document');

//Drive folder
Route::get('list_document','DocumentController@list_document');
Route::get('rename-folder','DocumentController@rename_folder');
Route::get('delete-folder','DocumentController@delete_folder');
Route::get('create_folder','DocumentController@create_folder');

Route::get('read-data','DocumentController@read_data');

Route::group(['prefix' => 'laravel-filemanager', 'middleware'], function () {
	\UniSharp\LaravelFilemanager\Lfm::routes();
});