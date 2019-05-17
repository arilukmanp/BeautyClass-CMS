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
            <div class="col-md-12 mx-auto">
                @foreach ($speakers as $speaker)
                    <div class="col-md-3 mb-2">
                        <div class="card-container">
                            <img class="round" src="{{ asset('storage/speakers/'.$speaker->photo) }}" alt="user" />
                            <h3>{{ $speaker->name }}</h3>
                            <p>{{ $speaker->description }}</p>
                            <a href="" data-toggle="modal" data-target="#myModal" data-id="{{ $speaker->name }}" data-description="{{ $speaker->description }}" class="btn btn_pink">Detail</a>
                        </div>
                    </div>
                @endforeach

                <div id="myModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background-color:#00000040">
					<div class="modal-dialog">
						<div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    {{-- <button type="button" class="close" data-dismiss="modal" style="font-size:30px; margin-bottom:5px;"><span aria-hidden="true">&times;</span></button> --}}
                                    {{-- <h3>Modal header</h3> --}}
                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                            </div>
							<div class="modal-body" style="padding-top:8px">
                                <p>Your room number is: <span class="id"></span>.</p>
                                <p>Your room desc is: <span class="description"></span>.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
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
        var myId, myDescription;

        $('.card-container a').click(function() {
            myId = $(this).attr('data-id');
            myDescription = $(this).attr('data-description');
        });

        $('#myModal').on('show.bs.modal', function (e) {
            $(this).find('.id').text(myId);
            $(this).find('.description').text(myDescription);
        });
    </script>
@endsection