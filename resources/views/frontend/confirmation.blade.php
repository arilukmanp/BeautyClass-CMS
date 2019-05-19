<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>BeautyClass - Konfirmasi Pembayaran</title>
	
	<link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
</head>
<body id="lg2">
	<div class="container" id="conf-payment">
		<div class="row">
			<div class="col-md-4 col-sm-8 col-xs-8 mx-auto text-center zz">
					<form class="form-horizontal" action="/{{Request::path()}}" method="POST" enctype="multipart/form-data">
						@csrf
						<h3>Konfirmasi Pembayaran</h3>
						@if(session('success'))
							<div class="alert alert-success">
								{{ session('success') }}
								<a class="close" data-dismiss="alert" href="" aria-hidden="true">&times;</a>
							</div>
						@endif
				
						<input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" required autocomplete="off" autofocus>
						<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email Pendaftaran" required autocomplete="off">
						<input type="text" class="form-control" name="bank_account" value="{{ old('bank_account') }}" placeholder="Nama Akun Bank" required autocomplete="off">
						<select class="form-control" id="to_bank" name="to_bank" required>
							<option>-- Transfer ke Bank --</option>
							<option value="BCA">BCA a.n. Moura Organizer</option>
							<option value="BRI">BRI a.n. Moura Organizer</option>
							<option value="BNI">BNI a.n. Moura Organizer</option>
							<option value="Mandiri">Mandiri a.n. Moura Organizer</option>
						</select>
						<input type="number" class="form-control" name="amount" value="{{ old('amount') }}" placeholder="Nominal Transfer" required autocomplete="off">
						<input type="date" class="form-control" name="date_of_transfer" value="{{ old('date_of_transfer') }}" required autocomplete="off"><br>
						<div class="col-md-12" style="text-align:left">
							<div class="form-group">
								<label for="photo" ><b>Bukti Pembayaran:</b></label><br>
								<input type="file" accept="image/png, image/jpeg, image/jpg" id="photo" name="photo" required><br><br>
							</div>
						</div>
						
						<button type="submit" class="btn btn-lg btn-lg2 mb-2">Kirim</button>
					</form>
                <hr>
				<p>&copy; {{ date('Y') }} | BeautyClass</p>
			</div>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
	<script src="{{ asset('js/custom.js') }}"></script>
</body>