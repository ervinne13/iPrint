@extends('layouts.lte')

@section('css')
<link href="{{ asset("/vendor/dataTables/datatables.min.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
<script src="{{ asset ("/vendor/dataTables/datatables.min.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/pages/stores/index.js") }}" type="text/javascript"></script>
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Stores        
    </h1>    
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-body">
                    <table class="table table-striped table-borderless" id="shops-table">
                        <thead>
                            <tr>
                                <th>
                                    <a href="/stores/create">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Owner Name</th>                            
                                <th>Latitude</th>
                                <th>Longitude</th>
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