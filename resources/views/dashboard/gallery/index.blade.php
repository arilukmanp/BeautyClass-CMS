@extends('layouts.master')

@section('title', 'Merchants')

@section('head')
    <link href="https://transloadit.edgly.net/releases/uppy/v1.0.0/uppy.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="block-content">
        <div class="row">
            <div class="col-md-12">
                <div class="block-header bttl">
                    <h3>Merchants</h3>
                    <a href="/merchants/create" class="btn btn_green btn-md pull-right"><i class="fas fa-plus btn-xs"></i> Create a new one</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <table class="table table-striped" id="mydata">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fullname</th>
                                <th>Status</th>
                                <th>Phone Number</th>
                                <th>Registered at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1
                            @endphp
                            @foreach ($merchants as $user)
                            <tr>
                                <td><?= $i; ?></td>
                                <td><a class="a-user" href="/merchants/{{$user->id}}">{{ $user->profile->name }}</a></td>
                                <td>
                                    @if ($user->status == 0)
                                        {{ 'Unconfirmed' }}
                                    @elseif ($user->status == 1)
                                        {{ 'Unpaid' }}
                                    @else
                                        {{ 'Paid' }}
                                    @endif
                                </td>
                                <td>{{ $user->profile->phone }}</td>
                                <td>{{ date('d M Y - H:m:s', strtotime($user->created_at)) }}</td>
                                <td>
                                    <form action="/merchants/{{$user->id}}" method="POST">
                                        <button type="submit" class="btn btn_red btn-xs" name="submit"" value="delete" data-toggle="tooltip" title="Delete" onClick="return dodelete();"><i class="fas fa-trash"></i> &nbsp; Delete</button>
                                        {{ csrf_field() }}
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
    <script src="https://transloadit.edgly.net/releases/uppy/v1.0.0/uppy.min.js"></script>

    <script>
		function dodelete()
		{
			job = confirm("Participant will delete permanently. Are you sure?");
			if(job != true)
			{
				return false;
			}
		}
    </script>
@endsection