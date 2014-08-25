@extends('layouts.lte')

@section('css')
<link href="{{ asset("/vendor/dataTables/datatables.min.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
<script src="{{ asset ("/vendor/dataTables/datatables.min.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/js/datatable-utilities.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/pages/uom/index.js") }}" type="text/javascript"></script>
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Units Of Measurement
    </h1>    
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-body">
                    <table class="table table-striped table-borderless" id="uom-table">
                        <thead>
                            <tr>
                                <th>
                                    <a href="/uom/create">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </th>
                                <th>Code</th>
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