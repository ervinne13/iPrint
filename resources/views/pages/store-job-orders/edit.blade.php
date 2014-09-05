@extends('layouts.lte')

@section('css')
<link href="{{ asset("/vendor/dataTables/datatables.min.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
<script src="{{ asset ("/vendor/dataTables/datatables.min.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/form-utilities.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/datatable-utilities.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/vendor/jquery/jquery.validate.js") }}" type="text/javascript"></script>

<script type="text/javascript">

var storeId = '{{$store->id}}';
var jobOrderId = '{{$jobOrder->id}}';
var orderByUserId = '{{$jobOrder->requested_by_user_id}}';

</script>

<script src="{{ asset ("/js/pages/store-orders/form.js") }}" type="text/javascript"></script>

@endsection

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{$store->name}} Job Order
        <small>Requested By: {{ $jobOrder->requestedBy->name }}</small>
    </h1>    
</section>

<!-- Main content -->
<section class="content">

    @include('pages.store-job-orders.form')

    <div class="row">
        <div class="col-lg-12">
            <div class="box-foot pull-right">
                <button id="action-update-close" type="button" class="btn btn-primary">Update And Close</button>
            </div>
        </div>
    </div>

</section><!-- /.content -->

@endsection