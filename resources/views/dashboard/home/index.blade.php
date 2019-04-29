@extends('layouts.master')

@section('title', 'Home')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/morris.css') }}">    
@endsection

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="row">
                    <div class="col-md-12">
                        <div class="widget">
                            <div class="mini-stats">
                                <h4 style="text-align:left;">Welcome, {{ Auth::user()->profile->name }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="widget">
                            <div class="mini-stats">
                                <a href="/participants"><span class="bg_blue"><i class="fas fa-users"></i></span></a>
                                <p>Participants</p>
                                <h3>510</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget">
                            <div class="mini-stats">
                                <a href="/merchants"><span class="bg_yellow"><i class="fas fa-store-alt"></i></span></a>
                                <p>Merchants</p>
                                <h3>27</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget">
                            <div class="mini-stats">
                                <a href="/speakers"><span class="bg_green"><i class="fas fa-microphone"></i></span></a>
                                <p>Speakers</p>
                                <h3>14</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget">
                            <div class="mini-stats">
                                <a href="/vouchers"><span class="bg_pink"><i class="far fa-credit-card"></i></span></a>
                                <p>Vouchers</p>
                                <h3>24</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget">
                            <div class="mini-stats">
                                <a href="/transactions"><span class="bg-success"><i class="fas fa-money-bill-wave"></i></span></a>
                                <p>Total Transactions</p>
                                <h3>62</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget">
                            <div class="mini-stats">
                                <a href="/gallery"><span class="bg-danger"><i class="fas fa-images"></i></span></a>
                                <p>Gallery</p>
                                <h3>118</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget">
                            <div class="mini-stats">
                                <a href="/downloads"><span class="bg_aqua"><i class="fas fa-copy"></i></span></a>
                                <p>Downloads</p>
                                <h3>12</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget">
                            <div class="mini-stats">
                                <a href="/lottery" target="_blank"><span class="bg-warning"><i class="fas fa-receipt"></i></span></a>
                                <p>Coupon</p>
                                <h3>Lottery Area</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="widget">
                            <div class="stats">
                                <div class="widget-title">
                                    <h3 class="text-uppercase"><i class="fa fa-chart-bar"></i> &nbsp; Visitor Statistics</h3>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div id="morris-area-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection