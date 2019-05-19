@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <form class="form-horizontal" action="{{ route('password.update') }}" method="post">
        @csrf
        
        <input type="hidden" name="token" value="{{ $token }}">
		
		@if(session('warning'))
			<div class="alert alert-warning">
				{{ session('warning') }}
				<a class="close" data-dismiss="alert" href="" aria-hidden="true">&times;</a>
			</div>
        @endif
        
        @if ($errors->has('email'))
			<div class="alert alert-warning">
				{{ $errors->first('email') }}
				<a class="close" data-dismiss="alert" href="" aria-hidden="true">&times;</a>
			</div>
		@endif
	
		@if ($errors->has('password'))
			<div class="alert alert-warning">
				{{ $errors->first('password') }}
				<a class="close" data-dismiss="alert" href="" aria-hidden="true">&times;</a>
			</div>
		@endif

        <input type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" placeholder="{{ __('Email Address') }}" required autocomplete="off" autofocus>

        <input id="login-password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" required autocomplete="off">
        
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required autocomplete="off">
	
		<button type="submit" class="btn btn-lg btn-lg2 mb-2">
                {{ __('Reset Password') }}
		</button>
	</form>
@endsection