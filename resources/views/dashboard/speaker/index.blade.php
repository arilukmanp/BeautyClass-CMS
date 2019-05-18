@extends('layouts.master')

@section('title', 'Pembicara')

@section('content')
    <div class="block-content">
        <div class="row">
            <div class="col-md-12">
                <div class="block-header bttl">
                    <h3>Pembicara</h3>
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

            <div class="col-md-12 mx-auto">
                @foreach ($speakers as $speaker)
                    <div class="col-md-3 mb-2">
                        <div class="card-container">
                            <img class="round" src="{{ asset('storage/speakers/'.$speaker->photo) }}" alt="user" />
                            <h3>{{ $speaker->name }}</h3>
                            <p>{{ $speaker->title }}</p>
                            <a href="" data-toggle="modal" data-target="#myModal"
                            data-name="{{ $speaker->name }}"
                            data-title="{{ $speaker->title }}" 
                            data-email="{{ $speaker->email }}" 
                            data-phone="{{ $speaker->phone }}"
                            data-image="{{ asset('storage/speakers/'.$speaker->photo) }}" 
                            data-edit="/{{Request::segment(1)}}/{{$speaker->id}}/edit" 
                            data-description="{{ $speaker->description }}" 
                            class="btn btn_pink">Detail</a>
                        </div>
                    </div>
                @endforeach

                <div id="myModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background-color:#00000040">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Profil Pembicara</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
							<div class="modal-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <label class="col-xs-6 col-md-4">Nama Pembicara <span style="float:right;">:</span></label>
                                                <p class="col-xs-6 col-md-8"><span class="dt-name"></span></p>
                                            </div>
                                            <div class="col-md-12 col-xs-12">
                                                <label class="col-xs-6 col-md-4">Gelar <span style="float:right;">:</span></label>
                                                <p class="col-xs-6 col-md-8"><span class="dt-title"></span></p>
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
                                                <label class="col-xs-6 col-md-4">Deskripsi <span style="float:right;">:</span></label>
                                                <p class="col-xs-6 col-md-8"><span class="dt-description"></span></p>
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
    </div>
@endsection

@section('script')
    <script>
        var dataName, dataTitle, dataEmail, dataPhone, dataDescription, dataImage, dataEdit;
    
    $('.card-container a').click(function() {
        dataName        = $(this).data('name');
        dataTitle       = $(this).data('title');
        dataEmail       = $(this).data('email');
        dataPhone       = $(this).data('phone');
        dataDescription = $(this).data('description');
        dataImage       = $(this).data('image');
        dataEdit        = $(this).data('edit');
    });
    
    $('#myModal').on('show.bs.modal', function (e) {
        $(this).find('.dt-name').text(dataName);
        $(this).find('.dt-title').text(dataTitle);
        $(this).find('.dt-email').text(dataEmail);
        $(this).find('.dt-phone').text(dataPhone);
        $(this).find('.dt-description').text(dataDescription);
        $(this).find('.dt-image').prop('src', dataImage);
        $(this).find('.dt-edit').prop('href', dataEdit);
    });
    </script>
@endsection