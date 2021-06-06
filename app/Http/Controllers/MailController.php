<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
	public function send_mail()
	{
		$to_name = "IT test";
        $to_email = "itqdcmail@gmail.com";//send to this email

        $data = array("name"=>"noi dung ten","body"=>"noi dung body"); //body of mail.blade.php

        Mail::send('pages.mail.send_mail',$data,function($message) use ($to_name,$to_email){
                    $message->to($to_email)->subject('test mail nhé');//send this mail with subject
                    $message->from($to_email,$to_name);//send from this mail
                });

            }
        }
