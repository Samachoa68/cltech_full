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
use App\Models\Brand;
use App\Models\Category;
use App\Models\Slider;
use App\Models\CategoryPost;
use Illuminate\Support\Carbon;
use Socialite;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class AdminController extends Controller
{

    public function login_google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback_google()
    {
        $users = Socialite::driver('google')->stateless()->user();
        // return $users->id;
        $authUser = $this->findOrCreateUser($users, 'google');
        if ($authUser) {
            $account_name = Login::where('admin_id', $authUser->user)->first();
            Session::put('admin_name', $account_name->admin_name);
            Session::put('admin_id', $account_name->admin_id);
        } elseif ($customer_new) {
            $account_name = Login::where('admin_id', $authUser->user)->first();
            Session::put('admin_name', $account_name->admin_name);
            Session::put('admin_id', $account_name->admin_id);
        }

        return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
    }
    public function findOrCreateUser($users, $provider)
    {
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if ($authUser) {
            return $authUser;
        } else {
            $customer_new = new Social([
                'provider_user_id' => $users->id,
                'provider' => strtoupper($provider)
            ]);

            $orang = Login::where('admin_email', $users->email)->first();

            if (!$orang) {
                $orang = Login::create([
                    'admin_name' => $users->name,
                    'admin_email' => $users->email,
                    'admin_password' => '',
                    'admin_phone' => '',

                ]);
            }
            $customer_new->login()->associate($orang);
            $customer_new->save();
            return $customer_new;
        }
    }


    public function login_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook()
    {
        $provider = Socialite::driver('facebook')->stateless()->user();
        $account = Social::where('provider', 'facebook')->where('provider_user_id', $provider->getId())->first();
        if ($account!=NULL) {
            //login in vao trang quan tri  
            $account_name = Login::where('admin_id', $account->user)->first();
            Session::put('admin_name', $account_name->admin_name);
            Session::put('admin_id', $account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        } elseif($account!=NULL) {

            $face_social = new Social([
                'provider_user_id' => $provider->getId(),
                'provider_user_email' => $provider->getEmail(),
                'provider' => 'facebook'
            ]);

            $orang = Login::where('admin_email', $provider->getEmail())->first();

            if (!$orang) {
                $orang = Login::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => '',


                ]);
            }
            $face_social->login()->associate($orang);
            $face_social->save();

            $account_name = Login::where('admin_id', $face_social->user)->first();

            Session::put('admin_name', $account_name->admin_name);
            Session::put('admin_id', $account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        }
    }


    public function AuthLogin()
    {
        $admin_id = Auth::id();
        if ($admin_id) {
            return Redirect::to('/dashboard');
        } else {
            return Redirect::to('/admin')->send();
        }
    }

    public function index()
    {
        return view('admin-login');
    }

    public function show_dashboard(Request $request)
    {
        $this->AuthLogin();

        //get ip address
        $user_ip_address = $request->ip();

        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();

        $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();

        $oneyears = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        //total last month
        $visitor_of_lastmonth = VisitorM::whereBetween('date_visitor', [$early_last_month, $end_of_last_month])->get();
        $visitor_last_month_count = $visitor_of_lastmonth->count();

        //total this month
        $visitor_of_thismonth = VisitorM::whereBetween('date_visitor', [$early_this_month, $now])->get();
        $visitor_this_month_count = $visitor_of_thismonth->count();

        //total in one year
        $visitor_of_year = VisitorM::whereBetween('date_visitor', [$oneyears, $now])->get();
        $visitor_year_count = $visitor_of_year->count();

        //total VisitorM
        $visitors = VisitorM::all();
        $visitors_total = $visitors->count();

        //current online
        $VisitorM_current = VisitorM::where('ip_address', $user_ip_address)->get();
        $visitor_count = $VisitorM_current->count();

        if ($visitor_count < 1) {
            $visitor = new VisitorM();
            $visitor->ip_address = $user_ip_address;
            $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }

        //total 
        $app_product = Product::all()->count();
        $app_post = PostM::all()->count();
        $app_order = Order::all()->count();
        $app_video = Video::all()->count();
        $app_customer = Customer::all()->count();

        $product_views = Product::orderBy('product_views', 'DESC')->take(20)->get();
        $post_views = PostM::orderBy('post_views', 'DESC')->take(20)->get();

        return view('admin.dashboard')->with(compact('visitors_total', 'visitor_count', 'visitor_last_month_count', 'visitor_this_month_count', 'visitor_year_count', 'visitors_total', 'app_product', 'app_post', 'app_order', 'app_video', 'app_customer', 'product_views', 'post_views'));
    }

    public function dashboard(Request $request)
    {

        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = Login::where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();

        if ($result) {

            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');
        } else {
            Session::put('message', 'Email hoặc Password sai. Vui lòng nhập lại!');
            return Redirect::to('/admin');
        }
    }

    public function logout()
    {
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }
    public function filter_by_date(Request $request)
    {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = StatisticalM::whereBetween('order_date', [$from_date, $to_date])->orderBy('order_date', 'ASC')->get();

        foreach ($get as $key => $val) {

            $chart_data[] = array(

                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }

        echo $data = json_encode($chart_data);
    }
   

    public function dashboard_filter(Request $request)
    {
        $data = $request->all();



        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dauthangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $cuoithangnay = Carbon::now('Asia/Ho_Chi_Minh')->endOfMonth()->toDateString();

        $sub7days =  Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $sub365days =  Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();



        if ($data['filter_value'] == '7days') {
            $get = StatisticalM::whereBetween('order_date', [$sub7days, $now])->orderBy('order_date', 'ASC')->get();
        } elseif ($data['filter_value'] == 'lastmonth') {
            $get = StatisticalM::whereBetween('order_date', [$dauthangtruoc, $cuoithangtruoc])->orderBy('order_date', 'ASC')->get();
        } elseif ($data['filter_value'] == 'thismonth') {
            $get = StatisticalM::whereBetween('order_date', [$dauthangnay, $cuoithangnay])->orderBy('order_date', 'ASC')->get();
        } elseif ($data['filter_value'] == '365days') {
            $get = StatisticalM::whereBetween('order_date', [$sub365days, $now])->orderBy('order_date', 'ASC')->get();
        } else {
            $get = StatisticalM::whereBetween('order_date', [$sub365days, $now])->orderBy('order_date', 'ASC')->get();
        }

        foreach ($get as $key => $val) {

            $chart_data[] = array(

                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }

        echo $data = json_encode($chart_data);
    }

    public function filter30_days()
    {
        $sub30days =  Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = StatisticalM::whereBetween('order_date', [$sub30days, $now])->orderBy('order_date', 'ASC')->get();
        foreach ($get as $key => $val) {

            $chart_data[] = array(

                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }

        echo $data = json_encode($chart_data);
    }
}
