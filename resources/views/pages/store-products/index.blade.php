@extends('layouts.lte')

@section('css')
<link href="{{ asset("/vendor/dataTables/datatables.min.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
<script src="{{ asset ("/vendor/underscore/underscore.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/vendor/dataTables/datatables.min.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/js/datatable-utilities.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/pages/store-products/index.js") }}" type="text/javascript"></script>

<script>
var storeId = '{{ $store->id }}';
</script>
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Store Products
        <small>{{ $store->name }}</small>
    </h1>    
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-body">
                    <table class="table table-striped table-borderless" id="products-table">
                        <thead>
                            <tr>
                                <th>
                                    <a href="/stores/{{ $store->id }}/products/create">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </th>
                                <th>Id</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section><!-- /.content -->

@endsection

@include('templates.table-inline-actions')