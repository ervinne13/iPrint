@extends('layouts.lte')

@section('js')

<script src="{{ asset("/bower_components/AdminLTE/plugins/chartjs/Chart.js") }}"></script>
<script src="{{ asset ("/js/pages/administration/index.js") }}" type="text/javascript"></script>

@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Welcome
        <small>{{ Auth::user()->name }}</small>
    </h1>    
</section>

<!-- Main content -->
<section class="content">

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Store Performance</h3>
        </div>
        <div class="box-body">
            <div class="chart">
                <canvas id="barChart" style="height:400px"></canvas>
            </div>
        </div><!-- /.box-body -->
    </div>
</section><!-- /.content -->

@endsection