@extends('layouts.master')

@section('title', 'Add Participant')

@section('content')
<div class="block-content">
	<div class="row">
		<div class="col-md-12">
			<div class="block-header bttl">
				<h3>Add Participant</h3>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form class="form-horizontal edt" action="/participants" method="POST" enctype="multipart/form-data">
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
						<label for="name">Fullname</label>
						<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autocomplete="off">
					</div>
                </div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="email">Email Address</label>
						<input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="place_of_birth">Place of Birth</label>
						<input type="text" class="form-control" id="place_of_birth" name="place_of_birth" value="{{ old('place_of_birth') }}" autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="date_of_birth">Date of Birth</label>
						<input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="phone">Phone Number</label>
						<input type="number" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="photo">Photo</label>
						<div class="input-group">
							<input type="text" class="form-control" name="photo_old" readonly>
							<label class="input-group-btn">
								<span class="btn btn-danger">
									<span class="image-preview-input-title">Select Photo</span>
									<input type="file" accept="image/png, image/jpeg, image/jpg" id="photo" name="photo" style="display: none;">
								</span>
							</label>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Address</label>
						<textarea id="summernote_form" name="address">{{ old('address') }}</textarea>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-btn">
						<a href="/participants/all" class="btn btn-danger"><i class="fa fa-times"></i> &nbsp; Batal</a>
						<button type="submit" class="btn btn-info pull-right" value="upload" name="submit"><i class="fa fa-check"></i> &nbsp; Save</button>
						{{ csrf_field() }}
					</div>
                </div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('script')

	<script src="{{ asset('js/datatables.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.js"></script>

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

    <script>
		$('#summernote_form').summernote({
			tabsize: 2,
			height: 150,
			toolbar: [
			['style', ['bold', 'italic', 'underline', 'clear']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['link', ['linkDialogShow', 'unlink']],
		
			],
			disableDragAndDrop: true,
			callbacks: {
				onPaste: function (e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					document.execCommand('insertText', false, bufferText);
				}
			}
		});
		</script>
		
		<script>  
			$(document).ready(function(){
			
			 $image_crop = $('#image_demo').croppie({
					enableExif: true,
					viewport: {
						width:200,
						height:200,
						type:'square' //circle
					},
					boundary:{
						width:300,
						height:300
					}
				});
			
				$('#upload_image').on('change', function(){
					var reader = new FileReader();
					reader.onload = function (event) {
						$image_crop.croppie('bind', {
							url: event.target.result
						});
					}
					reader.readAsDataURL(this.files[0]);
					$('#uploadimageModal').modal('show');
				});
			
				$('.crop_image').click(function(event){
					$image_crop.croppie('result', {
						type: 'canvas',
						size: 'viewport'
					}).then(function(response){
						$.ajax({
							url:"/participants/tesphoto",
							type: "POST",
							data:{"image": response},
							success:function(data)
							{
								$('#uploadimageModal').modal('hide');
								$('#uploaded_image').html(data);
							}
						});
					})
				});
			
			});  
			</script>

			<script>
			$(".gambar").attr("src", "https://user.gadjian.com/static/images/personnel_boy.png");
						var $uploadCrop,
						tempFilename,
						rawImg,
						imageId;
						function readFile(input) {
				 			if (input.files && input.files[0]) {
				              var reader = new FileReader();
					            reader.onload = function (e) {
									$('.upload-demo').addClass('ready');
									$('#cropImagePop').modal('show');
						            rawImg = e.target.result;
					            }
					            reader.readAsDataURL(input.files[0]);
					        }
					        else {
						        swal("Sorry - you're browser doesn't support the FileReader API");
						    }
						}

						$uploadCrop = $('#upload-demo').croppie({
							viewport: {
								width: 150,
								height: 200,
							},
							enforceBoundary: false,
							enableExif: true
						});
						$('#cropImagePop').on('shown.bs.modal', function(){
							// alert('Shown pop');
							$uploadCrop.croppie('bind', {
				        		url: rawImg
				        	}).then(function(){
				        		console.log('jQuery bind complete');
				        	});
						});

						$('.item-img').on('change', function () { imageId = $(this).data('id'); tempFilename = $(this).val();
																										 $('#cancelCropBtn').data('id', imageId); readFile(this); });
						$('#cropImageBtn').on('click', function (ev) {
							$uploadCrop.croppie('result', {
								type: 'base64',
								format: 'jpeg',
								size: {width: 150, height: 200}
							}).then(function (resp) {
								$('#item-img-output').attr('src', resp);
								$('#cropImagePop').modal('hide');
							});
						});
			</script>
@endsection