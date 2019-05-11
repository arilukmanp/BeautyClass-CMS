@extends('layouts.master')


@section('title', 'Edit Data Mitra')


@section('head')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/croppie.css') }}">
@endsection


@section('content')
<div class="block-content">
	<div class="row">
		<div class="col-md-12">
			<div class="block-header bttl">
				<h3>Edit Data Mitra</h3>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form class="form-horizontal edt" action="/Request::segment(1)/{{ $merchant->id }}" method="POST" enctype="multipart/form-data">
				
				@if($errors->has('email'))
					<div class="col-md-12">
						<div class="alert alert-warning">
							{{ $errors->first('email') }}
							<a class="close" data-dismiss="alert" href="" aria-hidden="true">&times;</a>
						</div>
					</div>
				@endif
				
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="name">Nama Mitra</label>
								<input type="text" class="form-control" id="name" name="name" value="{{ $merchant->profile->name }}" required autocomplete="off">
							</div>
        		</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="email">Alamat Email</label>
								<input type="email" class="form-control" id="email" name="email" value="{{ $merchant->email }}" required autocomplete="off">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="phone">Nomor Telepon</label>
								<input type="tel" class="form-control" id="phone" name="phone" value="{{ $merchant->profile->phone }}" autocomplete="off">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group" style="border-bottom: none">
								<label>Alamat Kantor</label>
								<textarea class="form-control" rows="3" name="address">{{ $merchant->profile->address }}</textarea>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-3">
					<div class="text-center d-flex justify-content-center p-3">
						<label>Logo Mitra</label>
						<div class="card text-center">
							<div class="card-body">
								<div class="profile-img" style="margin-top: 25px; margin-bottom: 25px">
									<img src="{{ asset('storage/profiles/'.$merchant->profile->photo) }}" id="profile-pic">
								</div>
								<div class="btn btn-outline-pink">
									<input type="file" class="file-upload" id="file-upload" 
									name="profile_picture" accept="image/*">
									Pilih Logo
								</div>
							</div>
						</div>
					</div>
						
						<!-- The Modal -->
					<div class="modal" id="myModal" style="background-color:#00000040">
						<div class="modal-dialog">
							<div class="modal-content">
								<!-- Modal Header -->
								<div class="modal-header">
									<h4 class="modal-title">Crop Logo</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<!-- Modal body -->
								<div class="modal-body">
									<div id="resizer"></div>
									<button class="btn btn-block btn-info" id="upload-photo" > 
									Selesai</button>
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
						<a href="{{URL::previous()}}" class="btn btn-danger"><i class="fa fa-times"></i> &nbsp; Batal</a>
						<button type="submit" id="submit" class="btn btn-info pull-right" value="edit" name="submit"><i class="fa fa-check"></i> &nbsp; Simpan</button>
						@csrf
						<input type="hidden" name="_method" value="PUT">
					</div>
        </div>
			</form>
		</div>
	</div>
</div>
@endsection


@section('script')
	<script type="text/javascript">
		$(function() {
			var croppie = null;
			var el = document.getElementById('resizer');

			$.base64ImageToBlob = function(str) {
				// extract content type and base64 payload from original string
				var pos = str.indexOf(';base64,');
				var type = str.substring(5, pos);
				var b64 = str.substr(pos + 8);
		
				// decode base64
				var imageContent = atob(b64);
		
				// create an ArrayBuffer and a view (as unsigned 8-bit)
				var buffer = new ArrayBuffer(imageContent.length);
				var view = new Uint8Array(buffer);
		
				// fill the view, using the decoded base64
				for (var n = 0; n < imageContent.length; n++) {
					view[n] = imageContent.charCodeAt(n);
				}
		
				// convert ArrayBuffer to Blob
				var blob = new Blob([buffer], { type: type });
		
				return blob;
			}

			$.getImage = function(input, croppie) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = function(e) {  
						croppie.bind({
							url: e.target.result,
						});
					}
					reader.readAsDataURL(input.files[0]);
				}
			}

			$("#file-upload").on("change", function(event) {
				$("#myModal").modal();

				croppie = new Croppie(el, {
					viewport: {
						width: 200,
						height: 200,
						type: 'square'
					},
					boundary: {
						width: 250,
						height: 250
					},
					enableOrientation: false
				});
				$.getImage(event.target, croppie); 
			});

			$("#upload-photo").on("click", function() {
				croppie.result('base64').then(function(base64) {
					$("#myModal").modal("hide"); 
					$("#profile-pic").attr("src","https://loading.io/spinners/spin/lg.ajax-spinner-gif.gif");

					// $("#profile-pic").attr("src", base64); 

					// $("#submit").on("click", function() {
					var url = "{{ url('/merchants') }}";
					var formData = new FormData();
					formData.append("profile_picture", $.base64ImageToBlob(base64));

					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});

					$.ajax({
						type: 'POST',
						url: url,
						data: formData,
						processData: false,
						contentType: false,
						success: function(data) {
                    if (data == "uploaded") {
                        $("#profile-pic").attr("src", base64); 
                    } else {
                        $("#profile-pic").attr("src","http://riverroadrepair.com/wp-content/uploads/2019/01/logo-placeholder.jpg"); 
                        console.log(data['profile_picture']);
                    }
                },
                error: function(error) {
                    console.log(error);
                    $("#profile-pic").attr("src","http://riverroadrepair.com/wp-content/uploads/2019/01/logo-placeholder.jpg"); 
                }
					});
					// });
				});
			});

			$('#myModal').on('hidden.bs.modal', function (e) {
				setTimeout(function() { croppie.destroy(); }, 100);
			})
			});
	</script>
@endsection