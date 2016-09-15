@extends('layouts.lte')

@section('js')
<script src="/bower_components/AdminLTE/plugins/flot/jquery.flot.min.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="/bower_components/AdminLTE/plugins/flot/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="/bower_components/AdminLTE/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="/js/pages/home/graphs.js"></script>
@endsection

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-bar-chart text-aqua"></i> Store Insights        
    </h1>
</section>

<section class="content">

    <div class="row">

        <div class="col-lg-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Sales For The Past 6 Months</h3>
                </div>
                <div class="box-body">
                    <div id="line-chart" style="height: 300px;"></div>                    
                </div>
            </div>
        </div>               

        <div class="col-lg-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">5 Best Selling Products</h3>
                </div>
                <div class="box-body">
                    <div id="donut-chart" style="height: 300px;"></div>
                    <div id="donut-legend"></div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection