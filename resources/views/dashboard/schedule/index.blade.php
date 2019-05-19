@extends('layouts.master')

@if(Request::segment(2) == 'day1')
    @section('title', 'Jadwal Hari Pertama')
@endif

@if(Request::segment(2) == 'day2')
    @section('title', 'Jadwal Hari Kedua')
@endif

@if(Request::segment(2) == 'category')
    @section('title', 'Kategori Sesi')
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
                        <h3>Jadwal Hari Pertama</h3>
                        <a href="/{{Request::segment(1)}}/{{Request::segment(2)}}/create" class="btn btn_green btn-md pull-right"><i class="fas fa-plus btn-xs"></i> Tambah Data</a>
                    @endif

                    @if(Request::segment(2) == 'day2')
                        <h3>Jadwal Hari Kedua</h3>
                        <a href="/{{Request::segment(1)}}/{{Request::segment(2)}}/create" class="btn btn_green btn-md pull-right"><i class="fas fa-plus btn-xs"></i> Tambah Data</a>
                    @endif

                    @if(Request::segment(2) == 'category')
                        <h3>Kategori Sesi</h3>
                        <a href="/{{Request::segment(1)}}/{{Request::segment(2)}}/create" class="btn btn_green btn-md pull-right"><i class="fas fa-plus btn-xs"></i> Tambah Data</a>
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
            
            @if(Request::segment(2) == 'category')

            @endif
            <div class="col-md-12">
                <div class="panel">
                    <table class="table table-striped" id="mydata">
                        <thead>
                            <tr>
                                <th>#</th>
                                @if(Request::segment(2) == 'category')
                                    <th>Nama Kategori</th>
                                    <th>Dibuat Pada</th>
                                @else
                                    <th>Sesi</th>
                                    <th>Waktu</th>
                                    <th>Pembicara</th>
                                @endif
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1
                            @endphp

                            @if(Request::segment(2) == 'category')
                                @foreach ($categories as $category)
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ date('d M Y', strtotime($category->created_at)) }}</td>
                                        <td>
                                            <form action="/{{Request::segment(1)}}/{{Request::segment(2)}}/{{$category->id}}" method="POST">
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

                            @else

                                @foreach ($schedules as $schedule)
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td>{{ $schedule->name }}</td>
                                    <td>{{ date('H:m', strtotime($schedule->time)) }} WIB</td>
                                    <td>@if($schedule->speaker_id == null) - @else {{ $schedule->speaker->name }} @endif</td>
                                    <td>
                                        <form action="/{{Request::segment(1)}}/{{$schedule->id}}" method="POST">
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

                            @endif
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