@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
    <form class="form-horizontal" action="{{ route('register') }}" method="post">
        @csrf
        <h3>Registration Form</h3>
        @if(session('warning'))
			<div class="alert alert-warning">
                {{ session('warning') }}
				<a class="close" data-dismiss="alert" href="" aria-hidden="true">&times;</a>
			</div>
        @endif
        
        @if ($errors->has('name'))
			<div class="alert alert-warning">
				{{ $errors->first('name') }}
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

        <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="{{ __('Fullname') }}" required autocomplete="off" autofocus>

		<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ __('Email Address') }}" required autocomplete="off">

		<input id="login-password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" required autocomplete="off">
                    
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required autocomplete="off">
                    
        <button type="submit" class="btn btn-lg btn-lg2 mb-2">
            {{ __('Register') }}
        </button>
	</form>
@endsection