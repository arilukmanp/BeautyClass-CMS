@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
	<form class="form-horizontal" action="{{ route('password.email') }}" method="post">
		@csrf
		
		<h3>Login Panel</h3>
        
		@if(session('status'))
			<div class="alert alert-warning">
				{{ session('status') }}
				<a class="close" data-dismiss="alert" href="" aria-hidden="true">&times;</a>
			</div>
		@endif
	
		@if ($errors->has('email'))
			<div class="alert alert-warning">
				{{ $errors->first('email') }}
				<a class="close" data-dismiss="alert" href="" aria-hidden="true">&times;</a>
			</div>
        @endif
	
		<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ __('Email Address') }}" required autocomplete="off" autofocus>

		<button type="submit" class="btn btn-lg btn-lg2 mb-2">
            {{ __('Send Password Reset Link') }}
		</button>
	</form>
@endsection