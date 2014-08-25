@extends('layouts.lte')

@section('js')
<script src="{{ asset ("/js/form-utilities.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/vendor/jquery/jquery.validate.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/pages/stores/form.js") }}" type="text/javascript"></script>
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Store
        <small>Create New</small>
    </h1>    
</section>

<!-- Main content -->
<section class="content">

    @include('pages.stores.form')

    <div class="row">
        <div class="col-lg-12">
            <div class="box-foot">
                <button id="action-submit" type="submit" class="btn btn-primary pull-right">Create New Store and Owner</button>
            </div>
        </div>
    </div>

</section><!-- /.content -->

@endsection
