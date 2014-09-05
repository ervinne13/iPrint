@extends('layouts.lte')

@include('templates.table-inline-actions')

@section('css')
<link href="{{ asset("/vendor/dataTables/datatables.min.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
<script src="{{ asset ("/vendor/underscore/underscore.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/vendor/dataTables/datatables.min.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/js/datatable-utilities.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/pages/users/index.js") }}" type="text/javascript"></script>

@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Users
    </h1>    
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-body">
                    <table class="table table-striped table-borderless" id="users-table">
                        <thead>
                            <tr>                                
                                <th>Id</th>
                                <!--<th>Status</th>-->
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
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