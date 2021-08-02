<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Carbon;
use App\Models\Coupon;
use App\Models\Customer;

class MailController extends Controller
{
    public function send_mail()
    {
        $to_name = "IT test";
        $to_email = "itqdcmail@gmail.com"; //send to this email

        $data = array("name" => "noi dung ten", "body" => "noi dung body"); //body of mail.blade.php

        Mail::send('pages.mail.send_mail', $data, function ($message) use ($to_name, $to_email) {
            $message->to($to_email)->subject('test mail nhé'); //send this mail with subject
            $message->from($to_email, $to_name); //send from this mail
        });
    }
    public function send_coupon($coupon_id)
    {
        $customer_vip = Customer::where('customer_vip','<>', 1)->get();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Mã khuyến mãi ngày" . ' ' . $now;        
        $couponM = Coupon::find($coupon_id);
        
        $coupon = array(
			'start_coupon' =>$couponM->coupon_date_start,
			'end_coupon' =>$couponM->coupon_date_end,
			'coupon_time' => $couponM->coupon_time,
			'coupon_condition' => $couponM->coupon_condition,
			'coupon_number' => $couponM->coupon_number,
			'coupon_code' => $couponM->coupon_code
		);
        $data = [];
        foreach ($customer_vip as $vip) {
            $data['email'][] = $vip->customer_email;
        }
        Mail::send('pages.mail.send_coupon', ['coupon'=>$coupon] , function ($message) use ($title_mail, $data) {
            $message->to($data['email'])->subject($title_mail); //send this mail with subject
            $message->from($data['email'], $title_mail); //send from this mail
        });

        return redirect()->back()->with('message', 'Gửi mã khuyến mãi khách thường thành công');
    }

    public function send_coupon_vip($coupon_id)
    {
        $customer_vip = Customer::where('customer_vip', 1)->get();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Mã khuyến mãi ngày" . ' ' . $now;
        $couponM = Coupon::find($coupon_id);
        $coupon = array(
			'start_coupon' =>$couponM->coupon_date_start,
			'end_coupon' =>$couponM->coupon_date_end,
			'coupon_time' => $couponM->coupon_time,
			'coupon_condition' => $couponM->coupon_condition,
			'coupon_number' => $couponM->coupon_number,
			'coupon_code' => $couponM->coupon_code
		);
        $data = [];
        foreach ($customer_vip as $vip) {
            $data['email'][] = $vip->customer_email;
        }
        Mail::send('pages.mail.send_coupon', ['coupon'=>$coupon] , function ($message) use ($title_mail, $data) {
            $message->to($data['email'])->subject($title_mail); //send this mail with subject
            $message->from($data['email'], $title_mail); //send from this mail
        });

        return redirect()->back()->with('message', 'Gửi mã khuyến mãi khách thường thành công');
    }
}
