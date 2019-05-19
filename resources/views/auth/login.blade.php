@extends('layouts.app')

@section('title', 'Login')

@section('content')
	<form class="form-horizontal" action="{{ route('login') }}" method="post">
		@csrf
		
		<h3>Login Panel</h3>
		
		@if(session('warning'))
			<div class="alert alert-warning">
				{{ session('warning') }}
				<a class="close" data-dismiss="alert" href="" aria-hidden="true">&times;</a>
			</div>
		@elseif (count($errors) > 0)
			<div class="alert alert-warning">
				Maaf, email atau password salah!
				<a class="close" data-dismiss="alert" href="" aria-hidden="true">&times;</a>
			</div>
		@endif
	
		@if ($errors->has('password'))
			<div class="alert alert-warning">
				{{ $errors->first('password') }}
				<a class="close" data-dismiss="alert" href="" aria-hidden="true">&times;</a>
			</div>
		@endif
	
		<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ __('Email Address') }}" required autocomplete="off" autofocus>

		<input id="login-password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" required autocomplete="off">

		<span class="fa fa-fw fa-eye field-icon toggle-password" onclick="showPassword()"></span>
	
		<div class="ml-2 form-check text-left mb-2">
			<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
			<label class="form-check-label" for="remember"> {{ __('Remember Me') }} </label>
		</div>
	
		<button type="submit" class="btn btn-lg btn-lg2 mb-2">
			{{ __('Login') }}
		</button>
	
		@if (Route::has('password.request'))
			<a class="btn btn-link" href="{{ route('password.request') }}">
				{{ __('Forgot Your Password?') }}
			</a>
		@endif
	</form>
@endsection