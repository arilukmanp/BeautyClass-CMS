@extends('layouts.master')

@if(Request::segment(2) == 'day1')
    @section('title', 'Tambah Jadwal Hari Pertama')
@endif

@if(Request::segment(2) == 'day2')
    @section('title', 'Tambah Jadwal Hari Kedua')
@endif

@if(Request::segment(2) == 'category')
    @section('title', 'Tambah Kategori Sesi')
@endif

@section('content')
<div class="block-content">
	<div class="row">
		<div class="col-md-12">
			<div class="block-header bttl">
				@if(Request::segment(2) == 'day1')
					<h3>Tambah Data Jadwal Hari Pertama</h3>
				@endif
				
				@if(Request::segment(2) == 'day2')
					<h3>Tambah Data Jadwal Hari Kedua</h3>
				@endif

				@if(Request::segment(2) == 'category')
					<h3>Tambah Data Kategori Sesi</h3>
				@endif
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			@if(Request::segment(2) == 'category')
				<form class="form-horizontal edt" action="/{{Request::segment(1)}}/{{Request::segment(2)}}" method="POST" enctype="multipart/form-data">
				
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
						<div class="form-group" style="border-bottom: none">
							<label for="name">Nama Kategori</label>
							<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autocomplete="off">
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

			@else

				<form class="form-horizontal edt" action="/{{Request::segment(1)}}/{{Request::segment(2)}}" method="POST" enctype="multipart/form-data">
				
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
							<label for="name">Nama Sesi</label>
							<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autocomplete="off">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="category">Kategori</label>
							<select class="form-control" id="category" name="category" required>
								<option>-- Pilih Kategori --</option>
								@foreach ($categories as $category)
									<option value="{{$category->id}}">{{$category->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="time">Dimulai Pukul</label>
							<input type="time" class="form-control" id="time" name="time" value="{{ old('time') }}" required autocomplete="off">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="speaker">Pembicara</label>
							<select class="form-control" id="speaker" name="speaker">
								<option value="">-- Pilih Pembicara --</option>
								@foreach ($speakers as $speaker)
									<option value="{{$speaker->id}}">{{$speaker->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-12">
                	    <div class="form-group" style="border-bottom: none">
                	        <label>Deskripsi</label>
                	        <textarea class="form-control" rows="3" name="description" required>{{ old('description') }}</textarea>
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
			@endif
		</div>
	</div>
</div>
@endsection