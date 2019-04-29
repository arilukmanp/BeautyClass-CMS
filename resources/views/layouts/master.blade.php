<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="theme-color" content="#ED015A">
	<title>BeautyClass - @yield('title')</title>
	<link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

	@yield('head')
</head>
<body class="fixed-left widescreen">
	<div id="wrapper">
		<div class="topbar">
			<div class="topbar-left">
				<div class="text-center">
					<a href="/home" class="logo"><span>BeautyClass</span></a>
				</div>
			</div>
			<div class="navbar navbar-default" role="navigation">
				<div class="container">
					<div class="row-menu">
						<div class="pull-left hidden-xs hidden-sm">
							<button class="button-menu-mobile open-left"><i class="fas fa-bars fa-fw"></i></button>
							<span class="clearfix"></span>
						</div>
						<div class="pull-left visible-xs visible-sm">
							<a href="/home" class="button-menu-mobile">
								<i class="fas fa-home"></i>
							</a>
							<span class="clearfix"></span>
						</div>
						<ul class="nav navbar-nav navbar-right pull-right">
							<li class="dropdown mbl-view" style="float:left;">
								<a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="false">
									@if ($avatar != null)
										<img src="{{ asset('storage/profiles/'.$avatar) }}" width="30" height="30" class="img-circle"/>
									@else
										<img src="{{ asset('img/default-ava.png') }}" width="30" height="30" class="img-circle"/>
									@endif
								</a>
								<ul class="dropdown-menu">
									<li><a href="/" target="_blank"><i class="fas fa-desktop"></i><span>&nbsp;&nbsp; Front Page</span></a></li>
                                    <li class="divider visible-lg"></li>
									<li><a href="/account"><i class="fas fa-user-cog"></i><span>&nbsp;&nbsp; Account</span></a></li>
									<li><a href="/settings"><i class="fas fa-cog"></i><span>&nbsp;&nbsp; Settings</span></a></li>
									<li class="divider visible-lg"></li>
									<li>
										<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-ban"></i><span>&nbsp;&nbsp; Logout</span></a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											@csrf
										</form>
									</li>
								</ul>
							</li>
							<li class="menu-btn"><a href="javascript:void(0)"><i class="fa fa-bars"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="left side-menu">
			<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto;">
				<div class="sidebar-inner slimscrollleft" style="overflow: hidden; width: auto;">
					<div id="sidebar-menu">
						<ul id="main-menu"">
							<li>
								<a class="has_sub @if(Request::segment(1) == 'home') subdrop @endif" href="/home">
									<i class="fas fa-home fa-fw"></i>
									<span>Home</span>
								</a>
                            </li>
							@can('isEO')
                            <li class="has_sub">
                                <a href="">
                                    <i class="fas fa-users fa-fw"></i>
                                    <span>Participants</span>
                                </a>
                                <ul class="list-unstyled">
                                    <a class="@if(Request::segment(1) == 'participants') active @endif" @if(Request::segment(1) == 'participants' && Request::segment(2) == 'all') style="color:#ED1262" @endif href="/participants/all">All Participants</a>
									<a @if(Request::segment(1) == 'participants' && Request::segment(2) == 'unregistered') style="color:#ED1262" @endif href="/participants/unregistered">Unregistered</a>
									<a @if(Request::segment(1) == 'participants' && Request::segment(2) == 'registered') style="color:#ED1262" @endif href="/participants/registered">Registered</a>
                                </ul>
							</li>
							<li>
								<a class="has_sub @if(Request::segment(1) == 'merchants') subdrop @endif" href="/merchants">
									<i class="fas fa-store-alt fa-fw"></i>
									<span>Merchants</span>
								</a>
							</li>
							<li>
								<a class="has_sub @if(Request::segment(1) == 'speakers') subdrop @endif" href="/speakers">
									<i class="fas fa-microphone fa-fw"></i>
									<span>Speakers</span>
								</a>
							</li>
							<li class="has_sub">
                                <a href="">
                                    <i class="fas fa-calendar-alt fa-fw"></i>
                                    <span>Schedule</span>
                                </a>
                                <ul class="list-unstyled">
                                    <a class="@if(Request::segment(1) == 'schedule') active @endif" @if(Request::segment(1) == 'schedule' && Request::segment(2) == 'day1') style="color:#ED1262" @endif href="/schedule/day1">Day 1</a>
                                    <a @if(Request::segment(1) == 'schedule' && Request::segment(2) == 'day2') style="color:#ED1262" @endif href="/schedule/day2">Day 2</a>
                                </ul>
							</li>
							<li class="has_sub">
                                <a href="">
                                    <i class="far fa-calendar-check fa-fw"></i>
                                    <span>Attendance</span>
                                </a>
                                <ul class="list-unstyled">
                                    <a class="@if(Request::segment(1) == 'attendance') active @endif" @if(Request::segment(1) == 'attendance' && Request::segment(2) == 'day1') style="color:#ED1262" @endif href="/attendance/day1">Day 1</a>
                                    <a @if(Request::segment(1) == 'attendance' && Request::segment(2) == 'day2') style="color:#ED1262" @endif href="/attendance/day2">Day 2</a>
                                </ul>
							</li>
							<li>
								<a class="has_sub @if(Request::segment(1) == 'vouchers') subdrop @endif" href="/vouchers">
									<i class="far fa-credit-card fa-fw"></i>
									<span>Vouchers</span>
								</a>
							</li>
							<li class="has_sub">
								<a href="">
									<i class="fas fa-money-bill-wave fa-fw"></i>
									<span>Transactions</span>
								</a>
								<ul class="list-unstyled">
									<a class="@if(Request::segment(1) == 'transactions') active @endif" @if(Request::segment(1) == 'transactions' && Request::segment(2) == 'all') style="color:#ED1262" @endif href="/transactions/all">All Transactions</a>
									<a @if(Request::segment(1) == 'transactions' && Request::segment(2) == 'cashback') style="color:#ED1262" @endif href="/transactions/cashback">Cashback</a>
								</ul>
							</li>
							<li>
								<a class="has_sub @if(Request::segment(1) == 'coupons') subdrop @endif" href="/coupons">
									<i class="fas fa-receipt fa-fw"></i>
									<span>Coupons</span>
								</a>
							</li>
							@endcan
                            <li>
								<a class="has_sub @if(Request::segment(1) == 'albums') subdrop @endif" href="/gallery">
                                    <i class="fas fa-images fa-fw"></i>
                                    <span>Gallery</span>
                                </a>
                            </li>
                            <li>
                                <a class="has_sub @if(Request::segment(1) == 'downloads') subdrop @endif" href="/downloads">
                                    <i class="fas fa-copy fa-fw"></i>
                                    <span>Downloads</span>
                                </a>
                            </li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="content-page">
			<nav class="dark-sidebar">
				<div id="sidebar-menu" style="padding-top: 15px;">
					<ul id="main-menu"">
						<li>
							<a class="has_sub" href="/home">
								<i class="fas fa-home fa-fw"></i>
								<span>Home</span>
							</a>
						</li>
						@can('isEO')
						<li class="has_sub">
							<a href="">
								<i class="fas fa-users fa-fw"></i>
								<span>Participants</span>
							</a>
							<ul class="list-unstyled">
								<a href="/participants/all">All Participants</a>
								<a href="/participants/unregistered">Unregistered</a>
								<a href="/participants/registered">Registered</a>
							</ul>
						</li>
						<li>
							<a class="has_sub" href="/merchants">
								<i class="fas fa-store-alt fa-fw"></i>
								<span>Merchants</span>
							</a>
						</li>
						<li>
							<a class="has_sub" href="/speakers">
								<i class="fas fa-microphone fa-fw"></i>
								<span>Speakers</span>
							</a>
						</li>
						<li class="has_sub">
							<a href="">
								<i class="fas fa-calendar-alt fa-fw"></i>
								<span>Schedule</span>
							</a>
							<ul class="list-unstyled">
								<a href="/schedule/day1">Day 1</a>
								<a href="/schedule/day2">Day 2</a>
							</ul>
						</li>
						<li class="has_sub">
							<a href="">
								<i class="far fa-calendar-check fa-fw"></i>
								<span>Attendance</span>
							</a>
							<ul class="list-unstyled">
								<a href="/attendance/day1">Day 1</a>
								<a href="/attendance/day2">Day 2</a>
							</ul>
						</li>
						<li>
							<a class="has_sub" href="/vouchers">
								<i class="far fa-credit-card fa-fw"></i>
								<span>Vouchers</span>
							</a>
						</li>
						<li class="has_sub">
							<a href="">
								<i class="fas fa-money-bill-wave fa-fw"></i>
								<span>Transactions</span>
							</a>
							<ul class="list-unstyled">
								<a href="/transactions/all">All Transactions</a>
								<a href="/transactions/cashback">Cashback</a>
							</ul>
						</li>
						<li>
							<a class="has_sub" href="/coupons">
								<i class="fas fa-receipt fa-fw"></i>
								<span>Coupons</span>
							</a>
						</li>
						@endcan
						<li>
							<a class="has_sub" href="/gallery">
								<i class="fas fa-images fa-fw"></i>
								<span>Gallery</span>
							</a>
						</li>
						<li>
							<a class="has_sub" href="/downloads">
								<i class="fas fa-copy fa-fw"></i>
								<span>Downloads</span>
							</a>
						</li>
						<li>
							<a class="has_sub" href="/" target="_blank">
								<i class="fas fa-desktop fa-fw"></i>
								<span>Front Page</span>
							</a>
						</li>
						<li>
							<a class="has_sub" href="/account">
								<i class="fas fa-user-cog fa-fw"></i>
								<span>Account</span>
							</a>
						</li>
						<li>
							<a class="has_sub" href="/settings">
								<i class="fas fa-cog fa-fw"></i>
								<span>Settings</span>
							</a>
						</li>
						<li>
							<a class="has_sub" href="{{ route('logout') }}">
								<i class="fas fa-ban fa-fw"></i>
								<span>Logout</span>
							</a>
						</li>
					</ul>
				</div>
			</nav>
			<div class="content">
				<div class="container">

                    @yield('content')

                </div>
			</div>
		</div>
	</div>

<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="{{ asset('js/croppie.js') }}"></script>
	{{-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> --}}
	{{-- <script src="{{ asset('js/bootstrap-filestyle.min.js') }}"></script> --}}
	<script src="{{ asset('js/dashboard-core.js') }}"></script>
	{{-- <script src="{{ asset('js/jquery.slimscroll.js') }}"></script> --}}
	<script src="{{ asset('js/custom.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script> --}}

	@yield('script')

</body>
</html>