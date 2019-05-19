@extends('layouts.master')

@if(Request::segment(2) == 'all')
    @section('title', 'Semua Peserta')
@endif

@if(Request::segment(2) == 'unregistered')
    @section('title', 'Peserta Belum Membayar')
@endif

@if(Request::segment(2) == 'confirmation')
    @section('title', 'Konfirmasi Pembayaran')
@endif

@if(Request::segment(2) == 'registered')
    @section('title', 'Peserta Telah Terdaftar')
@endif

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">
@endsection

@section('content')
    <div class="block-content">
        <div class="row">
            <div class="col-md-12">
                <div class="block-header bttl">
                    @if(Request::segment(2) == 'all')
                        <h3>Semua Peserta</h3>
                        <a href="/{{Request::segment(1)}}/create" class="btn btn_green btn-md pull-right"><i class="fas fa-plus btn-xs"></i> Tambah Data</a>
                    @endif

                    @if(Request::segment(2) == 'unregistered')
                        <h3>Peserta Yang Belum Membayar</h3>
                    @endif

                    @if(Request::segment(2) == 'confirmation')
                        <h3>Konfirmasi Pembayaran Peserta</h3>
                    @endif

                    @if(Request::segment(2) == 'registered')
                        <h3>Peserta Yang Telah Terdaftar</h3>
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

            @if(session('warning'))
                <div class="col-md-12">
                    <div class="alert alert-warning">
                        {{ session('warning') }}
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
                                @if(Request::segment(2) == 'all') 
                                    <th>Status</th>
                                @endif
                                @if(Request::segment(2) != 'confirmation') 
                                    <th>No. Telepon</th>
                                    <th>Mendaftar Pada</th>
                                @endif
                                @if(Request::segment(2) == 'confirmation') 
                                    <th>Email</th>
                                    <th>Tanggal Transfer</th>
                                @endif
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1
                            @endphp
                            @foreach ($participants as $user)
                            <tr>
                                <td><?= $i; ?></td>
                                @if(Request::segment(2) != 'confirmation')
                                    <td><a class="a-user" href="/{{Request::segment(1)}}/{{$user->id}}">{{ $user->profile->name }}</a></td>
                                @endif
                                
                                @if(Request::segment(2) == 'confirmation')
                                    <td><a class="a-user" href="/{{Request::path()}}/{{$user->id}}">{{ $user->name }}</a></td>
                                @endif
                                
                                @if(Request::segment(2) == 'all') 
                                    <td>
                                        @if ($user->status == 0)
                                            {{ 'Belum Konfirmasi Email' }}
                                        @elseif ($user->status == 1)
                                            {{ 'Belum Membayar' }}
                                        @else
                                            {{ 'Lunas' }}
                                        @endif
                                    </td>
                                @endif

                                @if(Request::segment(2) != 'confirmation')
                                    <td>@if($user->profile->phone == null) - @else {{ $user->profile->phone }} @endif</td>
                                    <td>{{ date('d M Y - H:m', strtotime($user->created_at)) }}</td>
                                @endif

                                @if(Request::segment(2) == 'confirmation')
                                    <td>{{ $user->email }}</td>
                                    <td>{{ date('d M Y', strtotime($user->date_of_transfer)) }}</td>
                                @endif
                                
                                <td>
                                    <form action="/{{Request::segment(1)}}/{{$user->id}}" method="POST" style="display: inline-block">
                                        <button type="submit" class="btn btn_red btn-xs" name="submit"" value="delete" data-toggle="tooltip" title="Hapus" onClick="return dodelete();"><i class="fas fa-trash"></i> &nbsp; Hapus</button>
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

    <script>
		function dodelete()
		{
			job = confirm("Data Akan Dihapus Secara Permanen. Apakah Anda Yakin?");
			if(job != true)
			{
				return false;
			}
        }
    </script>
@endsection