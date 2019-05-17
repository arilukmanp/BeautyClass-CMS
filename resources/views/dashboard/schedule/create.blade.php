@extends('layouts.master')

@section('title', 'Tambah Jadwal')

@section('content')
<div class="block-content">
	<div class="row">
		<div class="col-md-12">
			<div class="block-header bttl">
				<h3>Tambah Data Jadwal</h3>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form class="form-horizontal edt" action="/{{Request::segment(1)}}" method="POST" enctype="multipart/form-data">
				
				@if(count($errors) > 0)
					@foreach ($errors->all() as $error)
						<div class="col-md-12">
							<div class="alert alert-warning">
								{{ $error }}
								<a class="close" data-dismiss="alert" href="" aria-hidden="true">&times;</a>
							</div>
						</div>
					@endforeach
				@endif
				
				<div class="col-md-6">
					<div class="form-group">
						<label for="name">Nama Agenda</label>
						<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="category">Kategori</label>
						<input type="text" class="form-control" id="category" name="category" value="{{ old('category') }}" required autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
						<div class="form-group">
							<label for="time">Waktu</label>
							<input type="text" class="form-control" id="time" name="time" value="{{ old('time') }}" required autocomplete="off">
						</div>
					</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="speaker">Pembicara</label>
						<select class="form-control" id="speaker" name="speaker">
							<option>-- Pilih Pembicara --</option>
							@foreach ($speakers as $speaker)
								<option value="{{$speaker->id}}">{{$speaker->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-12">
                    <div class="form-group" style="border-bottom: none">
                        <label>Deskripsi</label>
                        <textarea class="form-control" rows="3" name="description">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group"></div>
                </div>
				<div class="col-md-12">
					<div class="form-btn">
						<a href="{{URL::previous()}}" class="btn btn-danger"><i class="fa fa-times"></i> &nbsp; Batal</a>
						<button type="submit" class="btn btn-info pull-right" value="upload" name="submit"><i class="fa fa-check"></i> &nbsp; Simpan</button>
						@csrf
					</div>
                </div>
			</form>
		</div>
	</div>
</div>
@endsection