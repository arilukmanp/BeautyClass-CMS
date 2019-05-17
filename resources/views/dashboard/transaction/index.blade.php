@extends('layouts.master')

@if(Request::segment(2) == 'all')
    @section('title', 'Semua Transaksi')
@endif

@if(Request::segment(2) == 'cashback')
    @section('title', 'Cashback')
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
                        <h3>Semua Data Transaksi</h3>
                    @endif

                    @if(Request::segment(2) == 'cashback')
                        <h3>Data Cashback</h3>
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
                                <th>Nama Peserta</th>
                                <th>No. Nota</th>
                                @if(Request::segment(2) == 'all')
                                    <th>Total</th>
                                    <th>Waktu Transaksi</th>
                                @endif
                                @if(Request::segment(2) == 'cashback')
                                    <th>Nominal Cashback</th>
                                    <th>Waktu Mendapatkan</th>
                                @endif
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1
                            @endphp
                            @if(Request::segment(2) == 'all')
                                @foreach ($transactions as $transaction)
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td>{{ $transaction->merchant->name }}</td>
                                    <td>{{ $transaction->no_nota }}</td>
                                    <td>{{ $transaction->total }}</td>
                                    <td>{{ date('d M Y - H:m', strtotime($transaction->created_at)) }}</td>
                                    <td>
                                        <form action="/{{Request::segment(1)}}/{{$transaction->id}}" method="POST" style="display: inline-block">
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
                            @endif

                            @if(Request::segment(2) == 'cashback') 
                                @foreach ($cashbacks as $cashback)
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td>{{ $cashback->profile->name }}</td>
                                    <td>{{ $cashback->transaction->no_nota }}</td>
                                    <td>{{ $cashback->cashback }}</td>
                                    <td>{{ date('d M Y - H:m', strtotime($cashback->created_at)) }}</td>
                                    <td>
                                        <form action="/{{Request::segment(1)}}/{{$cashback->id}}" method="POST" style="display: inline-block">
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
			job = confirm("Data Peserta Akan Dihapus Secara Permanen. Apakah Anda Yakin?");
			if(job != true)
			{
				return false;
			}
        }
    </script>
@endsection