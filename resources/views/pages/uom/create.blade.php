@extends('layouts.lte')

@section('js')
<script src="{{ asset ("/js/form-utilities.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/vendor/jquery/jquery.validate.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/pages/uom/form.js") }}" type="text/javascript"></script>
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Unit of Measurement
        <small>Create New</small>
    </h1>    
</section>

<!-- Main content -->
<section class="content">

    @include('pages.uom.form')

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
