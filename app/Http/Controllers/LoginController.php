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
use App\Models\SocialCustomers;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Socialite;
use Session;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function forget_pw(request $request)
    {
        $slider = Slider::OrderBy('slider_stt', 'ASC')->where('slider_status', '1')->take(4)->get();
        $meta_desc = "Quên mật khẩu";
        $meta_keywords = "Quên mật khẩu";
        $meta_title = "Home | LamGiaTech";
        $url_canonical = $request->url();

        $all_category_post = CategoryPost::orderBy('cate_post_id', 'ASC')->get();

        $cate_product = Category::where('category_status', '1')->orderBy('category_order', 'ASC')->get();

        $cate_pro_tabs = Category::where('category_status', '1')->where('category_parent', '<>', 0)->orderBy('category_order', 'ASC')->get();

        $brand_product = Brand::where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $all_product = Product::where('product_status', '1')->orderby('product_id', 'desc')->limit(4)->get();

        return view('pages.login.forget_pw')->with(compact('slider', 'cate_product', 'brand_product', 'all_product', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'all_category_post', 'cate_pro_tabs'));
    }
    public function recover_pass(Request $request)
    {
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_mail = "[Lamgiatech.com] Xác nhận đặt lại mật khẩu " . ' ' . $now;
        $customer = Customer::where('customer_email', '=', $data['email_account'])->get();
        foreach ($customer as $key => $value) {
            $customer_id = $value->customer_id;
        }

        if ($customer) {
            $count_customer = $customer->count();
            if ($count_customer == 0) {
                return redirect()->back()->with('error', 'Email chưa được đăng ký để khôi phục mật khẩu');
            } else {
                $token_random = Str::random();
                $customer = Customer::find($customer_id);
                $customer->customer_token = $token_random;
                $customer->save();
                //send mail

                $to_email = $data['email_account']; //send to this email
                $link_reset_pass = url('/update-new-pass?email=' . $to_email . '&token=' . $token_random);

                $data = array("name" => $title_mail, "body" => $link_reset_pass, 'email' => $data['email_account']); //body of mail.blade.php

                Mail::send('pages.login.forget_pass_notify', ['data' => $data], function ($message) use ($title_mail, $data) {
                    $message->to($data['email'])->subject($title_mail); //send this mail with subject
                    $message->from($data['email'], $title_mail); //send from this mail
                });
                //--send mail
                return redirect()->back()->with('message', 'Gửi mail thành công, vui lòng vào email để reset password');
            }
        }
    }

    public function reset_new_pass(Request $request)
    {
        $data = $request->all();
        $token_random = Str::random();
        $customer = Customer::where('customer_email', '=', $data['email'])->where('customer_token', '=', $data['token'])->get();
        $count = $customer->count();
        if ($count > 0) {
            foreach ($customer as $key => $cus) {
                $customer_id = $cus->customer_id;
            }
            $reset = Customer::find($customer_id);
            $reset->customer_password = md5($data['password_account']);
            $reset->customer_token = $token_random;
            $reset->save();
            return redirect('login-checkout')->with('message', 'Khôi phục mật khẩu thành công');
        } else {
            return redirect('forget-pw')->with('error', 'Vui lòng nhập lại email vì link đã quá hạn');
        }
    }

    public function login_customer_google()
    {
        config(['services.google.redirect' => env('GOOGLE_CLIENT_URL')]);
        return Socialite::driver('google')->redirect();
    }
    public function callback_customer_google()
    {

        config(['services.google.redirect' => env('GOOGLE_CLIENT_URL')]);

        $users = Socialite::driver('google')->stateless()->user();

        $authUser = $this->findOrCreateCustomer($users, 'google');

        if ($authUser) {
            $account_name = Customer::where('customer_id', $authUser->user)->first();
            Session::put('customer_id', $account_name->customer_id);
            Session::put('customer_picture', $account_name->customer_picture);
            Session::put('customer_name', $account_name->customer_name);
        } elseif ($customer_new) {
            $account_name = Customer::where('customer_id', $authUser->user)->first();
            Session::put('customer_id', $account_name->customer_id);
            Session::put('customer_picture', $account_name->customer_picture);
            Session::put('customer_name', $account_name->customer_name);
        }

        return redirect('/trang-chu')->with('message', 'Đăng nhập bằng tài khoản google <span style="color:red">' . $account_name->customer_email . '</span> thành công');
    }

    public function findOrCreateCustomer($users, $provider)
    {
        $authUser = SocialCustomers::where('provider_user_id', $users->id)->first();
        if ($authUser) {
            return $authUser;
        } else {
            $customer_new = new SocialCustomers([
                'provider_user_id' => $users->id,
                'provider_user_email' => $users->email,
                'provider' => strtoupper($provider)
            ]);

            $customer = Customer::where('customer_email', $users->email)->first();

            if (!$customer) {

                $customer = Customer::create([
                    'customer_name' => $users->name,
                    'customer_picture' => $users->avatar,
                    'customer_email' => $users->email,
                    'customer_password' => '',
                    'customer_phone' => ''
                ]);
            }

            $customer_new->customer()->associate($customer);

            $customer_new->save();
            return $customer_new;
        }
    }

    public function login_facebook_customer()
    {
        config(['services.facebook.redirect' => env('FACEBOOK_CLIENT_REDIRECT')]);
        return Socialite::driver('facebook')->redirect();
    }
    public function callback_facebook_customer()
    {
        config(['services.facebook.redirect' => env('FACEBOOK_CLIENT_REDIRECT')]);
        $provider = Socialite::driver('facebook')->user();

        $account = SocialCustomers::where('provider', 'facebook')->where('provider_user_id', $provider->getId())->first();

        if ($account != NULL) {

            $account_name = Customer::where('customer_id', $account->user)->first();
            Session::put('customer_id', $account_name->customer_id);
            Session::put('customer_name', $account_name->customer_name);

            return redirect('/dang-nhap')->with('message', 'Đăng nhập bằng tài khoản facebook <span style="color:red">' . $account_name->customer_email . '</span> thành công');
        } elseif ($account == NULL) {
            $customer_login = new SocialCustomers([
                'provider_user_id' => $provider->getId(),
                'provider_user_email' => $provider->getEmail(),
                'provider' => 'facebook'
            ]);

            $customer = Customer::where('customer_email', $provider->getEmail())->first();

            if (!$customer) {
                $customer = Customer::create([
                    'customer_name' => $provider->getName(),
                    'customer_email' => $provider->getEmail(),
                    'customer_picture' => '',
                    'customer_password' => '',
                    'customer_phone' => ''
                ]);
            }
            $customer_login->customer()->associate($customer);
            $customer_login->save();

            $account_new = Customer::where('customer_id', $customer_login->user)->first();
            Session::put('customer_id', $account_new->customer_id);
            Session::put('customer_name', $account_new->customer_name);


            return redirect('/login-checkout')->with('message', 'Đăng nhập bằng tài khoản facebook <span style="color:red">' . $account_new->customer_email . '</span> thành công');
        }
    }
}
