@extends('layouts.lte')

@section('js')
<script src="{{ asset("/bower_components/AdminLTE/plugins/chartjs/Chart.min.js") }}"></script>
<script src="{{ asset ("/js/pages/stores/store.js") }}" type="text/javascript"></script>

<script type="text/javascript">

var storeId = '{{ $store->id }}';

</script>

@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Store Insights
        <small>{{$store->name}}</small>
    </h1>    
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-lg-7">
            <div id="report-box" class="box box-primary">                
                <div class="box-header with-border">
                    <h3 class="box-title">Monthly Recap Report</h3>
                    <div class="box-tools pull-right">                        
                        <div class="btn-group">
                            <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center">
                                <strong>Sales: Jan 1, {{ date("Y") }} - {{ date("M d Y") }}</strong>
                            </p>
                            <div class="chart">
                                <!-- Sales Chart Canvas -->
                                <canvas id="salesChart" style="height: 180px;"></canvas>
                            </div><!-- /.chart-responsive -->
                        </div><!-- /.col -->                        
                    </div><!-- /.row -->
                </div><!-- ./box-body -->
                <div class="box-footer">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="description-block border-right">                                
                                <h5 id="current-year-sales-label" class="description-header text-green"></h5>
                                <span class="description-text">{{ date("Y") }} Sales</span>
                            </div><!-- /.description-block -->
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <div class="description-block border-right">                                
                                <h5 id="current-month-sales-label" class="description-header text-blue"></h5>
                                <span class="description-text">{{ date("F") }} Sales</span>
                            </div><!-- /.description-block -->
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <div class="description-block border-right">
                                <h5 id="past-month-sales-label" class="description-header text-yellow"></h5>
                                <span class="description-text">{{ date('F', strtotime('-1 month')) }} Sales</span>
                            </div><!-- /.description-block -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.box-footer -->
            </div><!-- /.box -->            
        </div>

        <div class="col-lg-5">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Latest Orders</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Payment Ref. No</th>
                                    <th>Item Qty</th>
                                    <th>Total Sales</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobOrders AS $jobOrder)
                                <tr>
                                    <td>{{$jobOrder->payment_ref_no}}</td>
                                    <td>{{$jobOrder->total_item_qty}}</td>
                                    <td>{{$jobOrder->total_cost}}</td>
                                    <td>
                                        @if (in_array($jobOrder->status, ["Open", "Awaiting Confirmation"]))
                                        <span class="label label-default">{{$jobOrder->status}}</span>
                                        @elseif (in_array($jobOrder->status, ["Out of Stock", "Rejected"]))
                                        <span class="label label-danger">{{$jobOrder->status}}</span>
                                        @elseif (in_array($jobOrder->status, ["Pending", "Ongoing"]))
                                        <span class="label label-info">{{$jobOrder->status}}</span>
                                        @elseif (in_array($jobOrder->status, ["Ready for Pickup", "Fullfilled"]))
                                        <span class="label label-success">{{$jobOrder->status}}</span>
                                        @else
                                        {{$jobOrder->status}}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="/stores/2/orders/active" class="btn btn-sm btn-info btn-flat pull-left">View Active Orders</a>
                    <a href="/stores/2/orders" class="btn btn-sm btn-default btn-flat pull-right">View Order History</a>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div>

    <div class="row">
        <div class="col-lg-5">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Store Settings</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="input-name">Minimum Order</label>
                        <input type="number" class="form-control" id="input-min-order" value="{{ $store->min_order_limit }}">
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <button id="action-save-settings" class="btn btn-success">Save</button>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div>

</section><!-- /.content -->

@endsection