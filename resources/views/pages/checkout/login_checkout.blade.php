@extends('layout')
@section('content')

<section id="form"><!--form-->
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">
				@if(session()->has('message'))
				<div class="alert alert-success">
					{!! session()->get('message') !!}
				</div>
				@elseif(session()->has('error'))
				<div class="alert alert-danger">
					{!! session()->get('error') !!}
				</div>
				@endif
				<div class="login-form"><!--login form-->
					<h2>Đăng nhập tài khoản</h2>
					<form action="{{URL::to('login-customer')}}" method="POST">
						{{csrf_field()}}

						<input type="text" name="email_account" placeholder="Email" />
						
						<input type="password" name="password_account" placeholder="Password" />
						<span>
							<input type="checkbox" class="checkbox"> 
							Ghi nhớ đăng nhập
						</span>
						<p><a href="{{url('/forget-pw')}}" style="color: red">Quên mật khẩu?</a></p>

						<button type="submit"  class="btn btn-default">Đăng nhập</button>
					</form>
				</div><!--/login form-->
			</div>
			<div class="col-sm-1">
				<h2 class="or">Hoặc</h2>
			</div>
			<div class="col-sm-4">
				<div class="signup-form"><!--sign up form-->
					<h2>Đăng ký</h2>
					<form action="{{URL::to('add-customer')}}" method="POST">
						{{csrf_field()}}

						@foreach($errors->all() as $val_error)
						<ul>
							<li>{{$val_error}}</li>
						</ul>
						@endforeach
						
						<input type="text" name="customer_name" placeholder="Họ và tên"/>
						<input type="email" name="customer_email" placeholder="Email"/>
						<input type="password" name="customer_password" placeholder="Mật khẩu"/>
						<input type="text" name="customer_phone" placeholder="Điện thoại"/>

						<div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
						<br/>
						@if($errors->has('g-recaptcha-response'))
						<span class="invalid-feedback" style="display:block">
							<strong>{{$errors->first('g-recaptcha-response')}}</strong>
						</span>
						@endif


						<button type="submit" class="btn btn-default">Đăng ký</button>
					</form>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section><!--/form-->

@endsection