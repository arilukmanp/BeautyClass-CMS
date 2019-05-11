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
                                <h4 style="text-align:left;">Selamat datang, {{ Auth::user()->profile->name }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="widget">
                            <div class="mini-stats">
                                <a href="/participants"><span class="bg_blue"><i class="fas fa-users"></i></span></a>
                                <p>Peserta</p>
                                <h3>{{ $participants }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget">
                            <div class="mini-stats">
                                <a href="/merchants"><span class="bg_yellow"><i class="fas fa-store-alt"></i></span></a>
                                <p>Merchants</p>
                                <h3>{{ $merchants }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget">
                            <div class="mini-stats">
                                <a href="/speakers"><span class="bg_green"><i class="fas fa-microphone"></i></span></a>
                                <p>Pembicara</p>
                                <h3>{{ $speakers }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget">
                            <div class="mini-stats">
                                <a href="/vouchers"><span class="bg_pink"><i class="far fa-credit-card"></i></span></a>
                                <p>Voucher</p>
                                <h3>{{ $vouchers }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget">
                            <div class="mini-stats">
                                <a href="/transactions"><span class="bg-success"><i class="fas fa-money-bill-wave"></i></span></a>
                                <p>Total Transaksi</p>
                                <h3>{{ $transactions }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget">
                            <div class="mini-stats">
                                <a href="/gallery"><span class="bg-danger"><i class="fas fa-images"></i></span></a>
                                <p>Galeri</p>
                                <h3>{{ $gallery }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget">
                            <div class="mini-stats">
                                <a href="/downloads"><span class="bg_aqua"><i class="fas fa-copy"></i></span></a>
                                <p>Download</p>
                                <h3>{{ $downloads }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget">
                            <div class="mini-stats">
                                <a href="/lottery" target="_blank"><span class="bg-warning"><i class="fas fa-receipt"></i></span></a>
                                <p>Kupon</p>
                                <h3>Area Undian</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="widget">
                            <div class="stats">
                                <div class="widget-title">
                                    <h3 class="text-uppercase"><i class="fa fa-chart-bar"></i> &nbsp; Statistik Pengunjung</h3>
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

@section('script')
    <script src="{{ asset('js/raphael-min.js') }}"></script>
    <script src="{{ asset('js/morris.js') }}"></script>

    <script>
        var data = @php echo $hits @endphp;
        
		$(function() {
			Morris.Area({
				element: 'morris-area-chart',
				data: data,
				xkey: 'date',
				ykeys: ['counter'],
				labels: ['Pengunjung'],
                dateFormat:
                    function(date) {
                        d = new Date(date);
                        var bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    
                        return ("0" + (d.getDate())).slice(-2) + ' ' + bulan[d.getMonth()] + ' ' + d.getFullYear(); 
                    },
				hideHover: 'auto',
				lineColors: ['#18BC9C'],
				fillOpacity: 0.2,
				gridIntegers: true,
				ymin: 0,
				ymax: 500,
				axes: 'y'
			});

			$('#morris-area-chart').resize(function () { bar.redraw(); });
		});
    </script>
@endsection