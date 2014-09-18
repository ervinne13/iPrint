@extends('layouts.lte')

@section('css')

<style>
    #map {
        height: 400px;
    }
</style>

@endsection

@section('js')
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBqJMziSJG_AKsSMo9mgaT7qaKsbytuBoU"></script>

<script src="{{ asset ("/js/form-utilities.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/vendor/jquery/jquery.validate.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/pages/stores/form.js") }}" type="text/javascript"></script>

<script type=text/javascript>
var storeId = '{{$shop->id}}';
var mode = '{{$mode}}';
</script>

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
                <button id="action-submit" type="submit" class="btn btn-primary pull-right">
                    Update
                </button>
            </div>
        </div>
    </div>

</section><!-- /.content -->

@endsection
