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
                <div class="col-md-3 mb-2">
                    <div class="card-container">
                        <img class="round" src="https://randomuser.me/api/portraits/women/79.jpg" alt="user" />
                        <h3>Ricky Park</h3>
                        <p>User interface designer and <br/> front-end developer</p>
                        <button class="btn btn_pink">Detail</button>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="card-container">
                        <img class="round" src="https://randomuser.me/api/portraits/women/79.jpg" alt="user" />
                        <h3>Ricky Park</h3>
                        <p>User interface designer and <br/> front-end developer</p>
                        <button class="btn btn_pink">Detail</button>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="card-container">
                        <img class="round" src="https://randomuser.me/api/portraits/women/79.jpg" alt="user" />
                        <h3>Ricky Park</h3>
                        <p>User interface designer and <br/> front-end developer</p>
                        <button class="btn btn_pink">Detail</button>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="card-container">
                        <img class="round" src="https://randomuser.me/api/portraits/women/79.jpg" alt="user" />
                        <h3>Ricky Park</h3>
                        <p>User interface designer and <br/> front-end developer</p>
                        <button class="btn btn_pink">Detail</button>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="card-container">
                        <img class="round" src="https://randomuser.me/api/portraits/women/79.jpg" alt="user" />
                        <h3>Ricky Park</h3>
                        <p>User interface designer and <br/> front-end developer</p>
                        <button class="btn btn_pink">Detail</button>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="card-container">
                        <img class="round" src="https://randomuser.me/api/portraits/women/79.jpg" alt="user" />
                        <h3>Ricky Park</h3>
                        <p>User interface designer and <br/> front-end developer</p>
                        <button class="btn btn_pink">Detail</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection