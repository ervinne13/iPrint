@extends('layouts.lte')

@section('content')

<section class="content-header">
    <h1>
        Welcome
        <small>{{ Auth::user()->name }}</small>
    </h1>    
</section>

<!-- Main content -->
<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">User Page</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
            <h3>You may now login to iPrint Mobile.</h3>
            <br>
            <p>Please download <a href="/apk/iPrint.apk">here</a> if you haven't downloaded the app yet.</p>
        </div>
    </div>

</section><!-- /.content -->

@endsection