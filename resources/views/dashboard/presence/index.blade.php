@extends('layouts.master')

@if(Request::segment(2) == 'day1')
    @section('title', 'Daftar Kehadiran Hari 1')
@endif
@if(Request::segment(2) == 'day2')
    @section('title', 'Daftar Kehadiran Hari 2')
@endif


@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">
@endsection

@section('content')
    <div class="block-content">
        <div class="row">
            <div class="col-md-12">
                <div class="block-header bttl">
                    @if(Request::segment(2) == 'day1')
                        <h3>Daftar Kehadiran Hari Pertama</h3>
                    @endif

                    @if(Request::segment(2) == 'day2')
                        <h3>Daftar Kehadiran Hari Kedua</h3>
                    @endif
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
                                <th>Absen Pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1
                            @endphp
                            @foreach ($presences as $presence)
                            <tr>
                                <td><?= $i; ?></td>
                                <td><a class="a-user" href="/participants/all/{{$presence->user_id}}">{{ $presence->user->profile->name }}</a></td>
                                <td>{{ $presence->user->email }}</td>
                                <td>{{ $presence->user->profile->phone }}</td>
                                <td>{{ date('H:m', strtotime($presence->created_at)) }}</td>
                            </tr>
                            @php
                                $i++
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@endsection