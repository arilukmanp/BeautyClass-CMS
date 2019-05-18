@extends('layouts.master')

@section('title', 'Mitra')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">
@endsection

@section('content')
    <div class="block-content">
        <div class="row">
            <div class="col-md-12">
                <div class="block-header bttl">
                    <h3>Mitra</h3>
                    <a href="/{{Request::segment(1)}}/create" class="btn btn_green btn-md pull-right"><i class="fas fa-plus btn-xs"></i> Tambah Data</a>
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

            <div class="col-md-12">
                <div class="panel">
                    <table class="table table-striped" id="mydata">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1
                            @endphp
                            @foreach ($merchants as $merchant)
                            <tr>
                                <td><?= $i; ?></td>
                                <td><a href="" 
                                    data-toggle="modal"
                                    data-target="#myModal" 
                                    data-name="{{ $merchant->profile->name }}" 
                                    data-email="{{ $merchant->email }}" 
                                    data-phone="{{ $merchant->profile->phone }}" 
                                    data-address="{{ $merchant->profile->address }}" 
                                    data-image="{{ asset('storage/merchants/'.$merchant->profile->photo) }}" 
                                    data-edit="/{{Request::segment(1)}}/{{$merchant->id}}/edit" 
                                    class="a-user">{{ $merchant->profile->name }}</a></td>
                                <td>{{ $merchant->email }}</td>
                                <td>{{ $merchant->profile->phone }}</td>
                                <td>
                                    <form action="/{{Request::segment(1)}}/{{$merchant->id}}" method="POST">
                                        <button type="submit" class="btn btn_red btn-xs" name="submit"" value="delete" data-toggle="tooltip" title="Delete" onClick="return dodelete();"><i class="fas fa-trash"></i> &nbsp; Hapus</button>
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                </td>
                            </tr>
                            @php
                                $i++
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="myModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background-color:#00000040">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Profil Mitra</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12">
                                            <label class="col-xs-6 col-md-4">Nama Mitra <span style="float:right;">:</span></label>
                                            <p class="col-xs-6 col-md-8"><span class="dt-name"></span></p>
                                        </div>
                                        <div class="col-md-12 col-xs-12">
                                            <label class="col-xs-6 col-md-4">Alamat Email <span style="float:right;">:</span></label>
                                            <p class="col-xs-6 col-md-8"><span class="dt-email"></span></p>
                                        </div>
                                        <div class="col-md-12 col-xs-12">
                                            <label class="col-xs-6 col-md-4">No. Telepon <span style="float:right;">:</span></label>
                                            <p class="col-xs-6 col-md-8"><span class="dt-phone"></span></p>
                                        </div>
                                        <div class="col-md-12 col-xs-12">
                                            <label class="col-xs-6 col-md-4">Alamat Kantor <span style="float:right;">:</span></label>
                                            <p class="col-xs-6 col-md-8"><span class="dt-address"></span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row text-center">
                                        <div class="col-xs-12 col-md-12">
                                            <div class="mx-auto thumbnail avatar-photo">
                                            <img src="" class="img-responsive dt-image" alt="Photo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="" class="btn btn-warning dt-edit"><i class="fas fa-pencil-alt btn-xs"></i> Edit Data</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
        var dataName, dataEmail, dataPhone, dataAddress, dataImage, dataEdit;

        $('.a-user').click(function() {
            dataName    = $(this).data('name');
            dataEmail   = $(this).data('email');
            dataPhone   = $(this).data('phone');
            dataAddress = $(this).data('address');
            dataImage   = $(this).data('image');
            dataEdit   = $(this).data('edit');
        });

        $('#myModal').on('show.bs.modal', function (e) {
            $(this).find('.dt-name').text(dataName);
            $(this).find('.dt-email').text(dataEmail);
            $(this).find('.dt-phone').text(dataPhone);
            $(this).find('.dt-address').text(dataAddress);
            $(this).find('.dt-image').prop('src', dataImage);
            $(this).find('.dt-edit').prop('href', dataEdit);
        });
    </script>

    <script src="{{ asset('js/datatables.min.js') }}"></script>
    
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>

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