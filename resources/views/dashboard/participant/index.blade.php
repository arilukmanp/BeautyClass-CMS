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
                                <th>No. Telepon</th>
                                <th>Mendaftar Pada</th>
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
                                <td><a class="a-user" href="/{{Request::segment(1)}}/{{$user->id}}">{{ $user->profile->name }}</a></td>
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
                                <td>{{ $user->profile->phone }}</td>
                                <td>{{ date('d M Y - H:m', strtotime($user->created_at)) }}</td>
                                <td>
                                    @if(Request::segment(2) == 'confirmation')
                                        <form action="/{{Request::segment(1)}}/{{$user->id}}" method="POST" style="display: inline-block">
                                            <button type="submit" class="btn btn-warning btn-xs" name="submit"" value="delete" data-toggle="tooltip" title="Konfirmasi" onClick="return doConfirm();"><i class="fas fa-money-bill-wave"></i> &nbsp; Konfirmasi Pembayaran</button>
                                            @csrf
                                        </form>
                                    @endif
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
			job = confirm("Data Peserta Akan Dihapus Secara Permanen. Apakah Anda Yakin?");
			if(job != true)
			{
				return false;
			}
        }
        
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