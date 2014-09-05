@extends('layouts.lte')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Welcome
        <small>{{ Auth::user()->name }}</small>
    </h1>    
</section>

<!-- Main content -->
<section class="content">

    <!-- Your Page Content Here -->        

</section><!-- /.content -->

@endsection