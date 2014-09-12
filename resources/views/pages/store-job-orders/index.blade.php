@extends('layouts.lte')

@include('templates.table-inline-actions')

@section('css')
<link href="{{ asset("/vendor/dataTables/datatables.min.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
<script src="{{ asset ("/vendor/underscore/underscore.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/vendor/dataTables/datatables.min.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/js/datatable-utilities.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/pages/store-orders/index.js") }}" type="text/javascript"></script>

<script type="text/javascript">

var socketUrl = '{{env("APP_SOCKET_URL")}}';
var storeId = '{{ $store->id }}';
var dataFetchType = '{{ $dataFetchType }}';

</script>

@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Job Orders
        <small>{{$store->name}}</small>
    </h1>
</section>

<section class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="job-orders-table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Requested By</th>
                                        <th>Payment Reference Number</th>
                                        <th>Status</th>
                                        <th>Date Ordered</th>
                                        <th>Products</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div><!-- /.col -->                        
                    </div><!-- /.row -->
                </div><!-- ./box-body -->                
            </div><!-- /.box -->            
        </div>
    </div>

</section><!-- /.content -->

@endsection