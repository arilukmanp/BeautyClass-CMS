@extends('layouts.app')

@section('title', 'Lupa Password')

@section('content')
    <h3>{{ __('Verify Your Email Address') }}</h3>
    @if (session('resent'))
        <div class="alert alert-success">
            {{ __('A fresh verification link has been sent to your email address.') }}
            <a class="close" data-dismiss="alert" href="" aria-hidden="true">&times;</a>
        </div>
    @endif
        
    {{ __('Before proceeding, please check your email for a verification link.') }}
    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
@endsection


