@extends('layouts.lte')

@section('css')
<link href="{{ asset("/vendor/dataTables/datatables.min.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
<script src="{{ asset ("/vendor/dataTables/datatables.min.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/form-utilities.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/datatable-utilities.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/vendor/jquery/jquery.validate.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/js/pages/store-products/form.js") }}" type="text/javascript"></script>

<script type="text/javascript">
var availableUOM = {!! json_encode($availableUOM) !!};
var storeId = '{{$store->id}}';
var productId = 0;
</script>

@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{$store->name}} Product
        <small>Create New</small>
    </h1>    
</section>

<!-- Main content -->
<section class="content">

    @include('pages.store-products.form')

    <div class="row">
        <div class="col-lg-12">
            <div class="box-foot pull-right">                
                <button id="action-create-new" type="button" class="btn btn-success">Create And New</button>
                <button id="action-create-close" type="button" class="btn btn-primary">Create And Close</button>
            </div>
        </div>
    </div>

</section><!-- /.content -->

@endsection

@include('pages.store-products.product-uom-template')
@include('templates.table-inline-actions')