<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/frontend/custom.css') }}">

    <title>Status Pendaftaran</title>
</head>
<body>
    @if (!session('warning'))
    <script>
        window.location = "/404";
    </script>
    @endif

    @if (session('warning') == '1')
        <div class="container text-center mx-auto mt-5 mb-5">
            <img src="{{ asset('img/reg-status-1.png') }}" style="width: 40%">
            <div class="col-8 mx-auto mt-4">
                <h4>Terimakasih telah melakukan pendaftaran, Silahkan cek email anda untuk melakukan konfirmasi email</h4>
            </div>
        </div>
    @endif

    @if (session('warning') == '2')
        <div class="container text-center mx-auto mt-5 mb-5">
            <img src="{{ asset('img/reg-status-2.png') }}" style="width: 40%">
            <div class="col-8 mx-auto mt-4">
                <h4>Terimakasih telah melakukan konfirmasi email. Silahkan cek kembali email anda untuk melanjutkan pembayaran pendaftaran</h4>
            </div>
        </div>
    @endif

    @if (session('warning') == '3')
        <div class="container text-center mx-auto mt-5 mb-5">
            <img src="{{ asset('img/reg-status-3.png') }}" style="width: 40%">
            <div class="col-8 mx-auto mt-4">
                <h4>Maaf, ada kesalahan saat memverifikasi user dengan email ini</h4>
            </div>
        </div>
    @endif

    @if (session('warning') == '4')
        <div class="container text-center mx-auto mt-5 mb-5">
            <img src="{{ asset('img/reg-status-3.png') }}" style="width: 40%">
            <div class="col-8 mx-auto mt-4">
                <h4>Maaf, ada kesalahan dengan token yang anda verifikasi</h4>
            </div>
        </div>
    @endif

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
