@extends('layouts.master')

@section('title', 'Add Participant')

@section('content')
<div class="block-content">
	<div class="row">
		<div class="col-md-12">
			<div class="block-header bttl">
				<h3>Add Merchant</h3>
			</div>
		</div>
	</div>
	<div class="row">
		<form class="form-horizontal edt" action="/merchants" method="POST" enctype="multipart/form-data">
			@if($errors->has('email'))
			<div class="col-md-12">
				<div class="alert alert-warning">
					{{ $errors->first('email') }}
					<a class="close" data-dismiss="alert" href="" aria-hidden="true">&times;</a>
				</div>
			</div>
			@endif
			<div class="col-md-9">
				<div class="col-md-6">
					<div class="form-group">
						<label for="name">Merchant's Name</label>
						<input type="text" class="form-control" id="name" name="name" required autocomplete="off">
					</div>
                </div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="email">Email Address</label>
						<input type="email" class="form-control" id="email" name="email" required autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="date_of_birth">Date of Birth</label>
						<input type="date" class="form-control" id="date_of_birth" name="date_of_birth" autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="phone">Phone Number</label>
						<input type="text" class="form-control" id="phone" name="phone" autocomplete="off">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Address</label>
						<textarea class="form-control" rows="3" name="address"></textarea>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-btn">
						<a href="/participants/all" class="btn btn-danger"><i class="fa fa-times"></i> &nbsp; Cancel</a>
						<button type="submit" class="btn btn-info pull-right" value="" name="submit"><i class="fa fa-check"></i> &nbsp; Save</button>
						{{ csrf_field() }}
					</div>
				</div>
			</div>
			<div class="col-md-3">
							<div class="d-flex justify-content-center p-3">
									<div class="card text-center">
										<div class="card-body">
											<h5 class="card-title">Logo</h5>
											<div class="profile-img p-3">
												<img src="https://img.icons8.com/material/4ac144/256/camera.png" id="profile-pic">
											</div>
											<div class="btn btn-dark">
												<input type="file" class="file-upload" id="file-upload" 
												name="profile_picture" accept="image/*">
												Pilih Gambar
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
												<h4 class="modal-title">Crop Gambar</h4>
												<button type="button" class="close" data-dismiss="modal">&times;</button>
											</div>
											<!-- Modal body -->
											<div class="modal-body">
												<div id="resizer"></div>
												<button class="btn btn-block btn-info" id="upload" > 
												Selesai</button>
											</div>
										</div>
									</div>
								</div>
			</div>
		</form>
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

	$("#upload").on("click", function() {
			croppie.result('base64').then(function(base64) {
					$("#myModal").modal("hide"); 
					$("#profile-pic").attr("src","https://loading.io/spinners/spin/lg.ajax-spinner-gif.gif");

					$("#profile-pic").attr("src", base64);

					// var url = "{{ url('/merchants') }}";
					// var formData = new FormData();
					// formData.append("profile_picture", $.base64ImageToBlob(base64));

					// $.ajaxSetup({
					// 		headers: {
					// 			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					// 		}
					// });

					// $.ajax({
					// 		type: 'POST',
					// 		url: url,
					// 		data: formData,
					// 		processData: false,
					// 		contentType: false,
					// 		success: function(data) {
					// 				if (data == "uploaded") {
					// 						$("#profile-pic").attr("src", base64); 
					// 				} else {
					// 						$("#profile-pic").attr("src","https://img.icons8.com/material/4ac144/256/camera.png"); 
					// 						console.log(data['profile_picture']);
					// 				}
					// 		},
					// 		error: function(error) {
					// 				console.log(error);
					// 				$("#profile-pic").attr("src","https://img.icons8.com/material/4ac144/256/camera.png");
					// 		}
					// });
			});
	});

	$('#myModal').on('hidden.bs.modal', function (e) {
			setTimeout(function() { croppie.destroy(); }, 100);
	})

});
</script>

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