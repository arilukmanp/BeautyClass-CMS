@extends('layouts.master')

@section('title', 'Tambah Peserta')

@section('content')
<div class="block-content">
	<div class="row">
		<div class="col-md-12">
			<div class="block-header bttl">
				<h3>Tambah Peserta</h3>
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
						<label for="name">Nama Lengkap</label>
						<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autocomplete="off">
					</div>
                </div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="email">Alamat Email</label>
						<input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="place_of_birth">Tempat Lahir</label>
						<input type="text" class="form-control" id="place_of_birth" name="place_of_birth" value="{{ old('place_of_birth') }}" autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="date_of_birth">Tanggal Lahir</label>
						<input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="phone">Nomor Telepon</label>
						<input type="number" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="foto">Foto</label>
						<div class="input-group image-preview">
							<input type="text" class="form-control image-preview-filename" name="foto" readonly>
							<span class="input-group-btn">
								<div class="btn btn_red btn-photo-picker image-preview-input">
									<span class="image-preview-input-title">Pilih Foto</span>
									<input type="file" accept="image/png, image/jpeg, image/jpg" name="photo">
								</div>
							</span>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group" style="border-bottom: none">
						<label for="address">Alamat</label>
						<textarea class="form-control" id="address" name="address" rows="3">{{ old('address') }}</textarea>
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

@section('script')
	<script type="text/javascript">
		$(document).on('click', '#close-preview', function(){ 
			$('.image-preview').popover('hide');
		});

		$(function() {
			var closebtn = $('<button/>', {
				type:"button",
				text: 'x',
				id: 'close-preview',
				style: 'font-size: initial;',
			});
			closebtn.attr("class","close pull-right");


			$('.image-preview-clear').click(function(){
				$('.image-preview').attr("data-content","").popover('hide');
				$('.image-preview-filename').val("");
				$('.image-preview-clear').hide();
				$('.image-preview-input input:file').val("");
				$(".image-preview-input-title").text("Browse"); 
			}); 

			$(".image-preview-input input:file").change(function (){     
				var img = $('<img/>', {
					id: 'dynamic',
					width:250,
					height:200
				});      
				var file = this.files[0];
				var reader = new FileReader();

				reader.onload = function (e) {
					$(".image-preview-input-title").text("Ganti");
					$(".image-preview-clear").show();
					$(".image-preview-filename").val(file.name);
				}        
				reader.readAsDataURL(file);
			});  
		});
	</script>
@endsection