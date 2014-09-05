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
            <div class="row">
                <div class="col-lg-6">
                    <form id="form-register-user" action="/users/{{Auth::user()->id}}/changepassword" method="POST">

                        <div class="form-group has-feedback">
                            <input type="password" name="password_old" required class="form-control" placeholder="Current Password">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                            @if ($errors->has('password_old'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_old') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" name="password" required class="form-control" placeholder="New Password">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group has-feedback">
                            <input type="password" name="password_confirmation" required class="form-control" placeholder="Repeat Password">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                            @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="col-xs-offset-7 col-xs-5">
                            <button  type="submit" class="btn btn-primary btn-block btn-flat">Update Password</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</section><!-- /.content -->

@endsection