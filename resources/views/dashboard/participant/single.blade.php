@extends('layouts.master')

@if(Request::segment(2) == 'confirmation')
    @section('title', 'Detail Konfirmasi')
@endif

@if(Request::segment(1) == 'participant')
	@section('title', 'Profil Peserta')
@endif

@section('content')
<div class="block-content">
	<div class="row">
		<div class="col-md-12">
			<div class="block-header bttl">
				@if(Request::segment(2) == 'confirmation')
					<h3>Detail Konfirmasi</h3>
				@endif
				
				@if(Request::segment(1) == 'participant')
					<h3>Profil Peserta</h3>
					<a href="/{{Request::segment(1)}}/{{$participant->id}}/edit" class="btn btn_yellow btn-md pull-right"><i class="fas fa-pencil-alt btn-xs"></i> Edit Profil</a>
				@endif
			</div>
		</div>
	</div>
	<div class="row">
		
		@if(session('success'))
			<div class="col-md-12">
				<div class="alert alert-success">
					{{ session('success') }}
					<a class="close" data-dismiss="alert" href="" aria-hidden="true">&times;</a>
				</div>
			</div>
		@endif

		@if(Request::segment(2) == 'confirmation')
			<form class="form-horizontal edt" action="/{{Request::path()}}" method="POST">
				<div class="col-md-10">
					<div class="row">
						<div class="col-md-12 col-xs-12">
							<label class="col-xs-6 col-md-4">Nama<span style="float:right;">:</span></label>
							<p class="col-xs-6 col-md-8">{{ $participant->name }}</p>
						</div>
						<div class="col-md-12 col-xs-12">
							<label class="col-xs-6 col-md-4">Alamat Email <span style="float:right;">:</span></label>
							<p class="col-xs-6 col-md-8">{{ $participant->email }}</p>
						</div>
						<div class="col-md-12 col-xs-12">
							<label class="col-xs-6 col-md-4">Nama Akun Bank <span style="float:right;">:</span></label>
							<p class="col-xs-6 col-md-8">{{ $participant->bank_account }}</p>
						</div>
						<div class="col-md-12 col-xs-12">
							<label class="col-xs-6 col-md-4">Bank Tujuan <span style="float:right;">:</span></label>
							<p class="col-xs-6 col-md-8">Bank {{ $participant->to_bank }}</p>
						</div>
						<div class="col-md-12 col-xs-12">
							<label class="col-xs-6 col-md-4">Nominal Transfer <span style="float:right;">:</span></label>
							<p class="col-xs-6 col-md-8">Rp. {{ $participant->amount }},-</p>
						</div>
						<div class="col-md-12 col-xs-12">
							<label class="col-xs-6 col-md-4">Tanggal transfer <span style="float:right;">:</span></label>
							<p class="col-xs-6 col-md-8">{{ date('d M Y', strtotime($participant->date_of_transfer)) }}</p>
						</div>
					</div>
				</div>
				<div class="col-md-2 order-first">
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<a href="" data-toggle="modal" data-target="#myModal" class="mx-auto thumbnail avatar-photo">
								<img src="{{ asset('storage/reg_payments/'.$participant->photo) }}" class="img-responsive" alt="Photo">
							</a>
						</div>
						<div id="myModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background-color:#00000040">
							<div class="modal-dialog">
						  		<div class="modal-content">
									<div class="modal-body" style="padding-top:8px">
										<button type="button" class="close" data-dismiss="modal" style="font-size:30px; margin-bottom:5px;"><span aria-hidden="true">&times;</span></button>
										<img src="{{ asset('storage/reg_payments/'.$participant->photo) }}" class="img-responsive">
							  		</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group"></div>
				</div>
				<div class="col-md-12">
					<div class="form-btn">
						<a href="{{URL::previous()}}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> &nbsp; Kembali</a>
						<button type="submit" class="btn btn_green pull-right" value="edit" name="submit" onClick="return doConfirm();"><i class="fa fa-check"></i> &nbsp; Konfirmasi</button>
						@csrf
						<input type="hidden" name="_method" value="PUT">
					</div>
				</div>
			</form>
		@endif

		@if(Request::segment(1) == 'participant')
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<label class="col-xs-6 col-md-4">Nama Lengkap <span style="float:right;">:</span></label>
						<p class="col-xs-6 col-md-8">{{ $participant->profile->name }}</p>
					</div>
					<div class="col-md-12 col-xs-12">
						<label class="col-xs-6 col-md-4">Alamat Email <span style="float:right;">:</span></label>
						<p class="col-xs-6 col-md-8">{{ $participant->email }}</p>
					</div>
					<div class="col-md-12 col-xs-12">
						<label class="col-xs-6 col-md-4">Nomor Telepon <span style="float:right;">:</span></label>
						<p class="col-xs-6 col-md-8">@if($participant->profile->phone == null) - @else {{ $participant->profile->phone }} @endif</p>
					</div>
					<div class="col-md-12 col-xs-12">
						<label class="col-xs-6 col-md-4">Tempat Lahir <span style="float:right;">:</span></label>
						<p class="col-xs-6 col-md-8">@if($participant->profile->place_of_birth == null) - @else {{ $participant->profile->place_of_birth }} @endif</p>
					</div>
					<div class="col-md-12 col-xs-12">
						<label class="col-xs-6 col-md-4">Usia <span style="float:right;">:</span></label>
						<p class="col-xs-6 col-md-8">@if($participant->profile->date_of_birth == null) - @else {{ Carbon\Carbon::parse($participant->profile->date_of_birth)->age . " tahun" }} @endif</p>
					</div>
					<div class="col-md-12 col-xs-12">
						<label class="col-xs-6 col-md-4">Alamat <span style="float:right;">:</span></label>
						<p class="col-xs-6 col-md-8">@if($participant->profile->address == null) - @else {{ $participant->profile->address }} @endif</p>
					</div>
				</div>
			</div>
			<div class="col-md-2 order-first">
				<div class="row">
					@if($participant->profile->photo != null)
						<div class="col-xs-12 col-md-12">
							<a href="" data-toggle="modal" data-target="#myModal" class="mx-auto thumbnail avatar-photo">
								<img src="{{ asset('storage/profiles/'.$participant->profile->photo) }}" class="img-responsive" alt="Photo">
							</a>
						</div>
						<div id="myModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background-color:#00000040">
							<div class="modal-dialog">
						  		<div class="modal-content">
									<div class="modal-body" style="padding-top:8px">
										<button type="button" class="close" data-dismiss="modal" style="font-size:30px; margin-bottom:5px;"><span aria-hidden="true">&times;</span></button>
										<img src="{{ asset('storage/profiles/'.$participant->profile->photo) }}" class="img-responsive">
							  		</div>
								</div>
							</div>
						</div>
					@endif
				</div>
			</div>
		@endif
	</div>
</div>
@endsection

@section('script')
	<script>
		function doConfirm()
		{
			job = confirm("Apakah Anda Yakin Ingin Menkonfirmasi Pembayaran Peserta ini?");
			if(job != true)
			{
				return false;
			}
		}
	</script>
@endsection