@extends('layouts.master')

@section('title', 'Voucher')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">
@endsection

@section('content')
    <div class="block-content">
        <div class="row">
            <div class="col-md-12">
                <div class="block-header bttl">
                    <h3>Data Voucher</h3>
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
                                <th>Nama Voucher</th>
                                <th>Mitra</th>
                                <th>Kedaluarsa</th>
                                <th>Cashback</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1
                            @endphp
                            @foreach ($vouchers as $voucher)
                            <tr>
                                <td><?= $i; ?></td>
                                <td>{{ $voucher->name }}</td>
                                    <td>{{ $voucher->user->profile->name }}</td>
                                <td>{{ date('d M Y', strtotime($voucher->expire)) }}</td>
                                <td>{{ $voucher->cashback }}%</td>
                                <td>
                                    <form action="/{{Request::segment(1)}}/{{$voucher->id}}" method="POST">
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