@extends('layouts.master')

@section('title', 'Profil Mitra')

@section('content')
<div class="block-content">
	<div class="row">
		<div class="col-md-12">
			<div class="block-header bttl">
				<h3>Profil Mitra</h3>
				<a href="/{{Request::segment(1)}}/{{$merchant->id}}/edit" class="btn btn_yellow btn-md pull-right"><i class="fas fa-pencil-alt btn-xs"></i> Edit Profil</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="flex-single">
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<label class="col-xs-6 col-md-4">Nama Mitra <span style="float:right;">:</span></label>
					<p class="col-xs-6 col-md-8">{{ $merchant->profile->name }}</p>
				</div>
				<div class="col-md-12 col-xs-12">
					<label class="col-xs-6 col-md-4">Alamat Email <span style="float:right;">:</span></label>
					<p class="col-xs-6 col-md-8">{{ $merchant->email }}</p>
				</div>
				<div class="col-md-12 col-xs-12">
					<label class="col-xs-6 col-md-4">Nomor Telepon <span style="float:right;">:</span></label>
					<p class="col-xs-6 col-md-8">{{ $merchant->profile->phone }}</p>
				</div>
				<div class="col-md-12 col-xs-12">
					<label class="col-xs-6 col-md-4">Alamat Kantor <span style="float:right;">:</span></label>
					<p class="col-xs-6 col-md-8">@if($merchant->profile->address == null) - @else {{ $merchant->profile->address }} @endif</p>
				</div>
			</div>
		</div>
		<div class="col-md-2 order-first">
			<div class="row">
				@if($merchant->profile->photo != null)
					<div class="col-xs-12 col-md-12">
						<a href="" data-toggle="modal" data-target="#myModal" class="mx-auto thumbnail avatar-photo">
							<img src="{{ asset('storage/profiles/'.$merchant->profile->photo) }}" class="img-responsive" alt="Photo">
						</a>
					</div>
					<div id="myModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background-color:#00000040">
						<div class="modal-dialog modal-sm">
						  	<div class="modal-content">
								<div class="modal-body" style="padding-top:8px">
										<button type="button" class="close" data-dismiss="modal" style="font-size:30px; margin-bottom:5px;"><span aria-hidden="true">&times;</span></button>
									<img src="{{ asset('storage/profiles/'.$merchant->profile->photo) }}" class="img-responsive">
							  	</div>
							</div>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
		<div class="col-md-12">
			<div class="form-group"></div>
		</div>
	</div>
</div>
@endsection