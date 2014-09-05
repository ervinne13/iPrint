@extends('layouts.lte')

@section('content')

<section class="content-header">
    <h1>
        Change Password
        <small>{{ Auth::user()->name }}</small>
    </h1>    
</section>

<!-- Main content -->
<section class="content">

    <div class="box box-primary">
        <!-- form start -->
        <div class="box-body">
            <h3>Password Changed Successfully!</h3>           
        </div>
    </div>

</section><!-- /.content -->

@endsection