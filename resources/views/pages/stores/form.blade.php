<div class="row">
    <form id="form-store">
        {{ csrf_field() }}
        <div class="col-lg-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Store Info</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div id="panel-store" class="box-body">
                    <div class="form-group">
                        <label for="input-store-name">Name</label>
                        <input type="text" required name="name" class="form-control" id="input-store-name" placeholder="Store Name" value="{{ $shop->name }}">
                    </div>
                    <div class="form-group">
                        <label for="input-store-lat">Location - Latitude</label>
                        <input type="text" required name="location_lat" class="form-control" id="input-store-lat" placeholder="Ex. 14.5614376" value="{{ $shop->location_lat }}">
                    </div>
                    <div class="form-group">
                        <label for="input-store-long">Location - Longitude</label>
                        <input type="text" required name="location_long" class="form-control" id="input-store-long" placeholder="Ex. 121.0176065" value="{{ $shop->location_long }}">
                    </div>
                </div><!-- /.box-body -->
            </div>
        </div>

        <div class="col-lg-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Store Owner / Manager</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div id="panel-owner" class="box-body">
                    <div class="form-group">
                        <label for="input-email">Email Address</label>
                        <input type="email" required name="email" class="form-control" id="input-email" placeholder="Enter email" value="{{ $shop->owner->email }}">
                    </div>
                    <div class="form-group">
                        <label for="input-name">Display Name</label>
                        <input type="text" required name="name" class="form-control" id="input-name" placeholder="Enter name" value="{{ $shop->owner->name }}">
                    </div>
                    <div class="form-group">
                        <label for="input-password-1">Password</label>
                        <input type="password" required name="password1" class="form-control" id="input-password-1" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="input-password-2">Repeat Password</label>
                        <input type="password" required name="password2" class="form-control" id="input-password-2" placeholder="Repeat Password">
                    </div>

                </div><!-- /.box-body -->
            </div>
        </div>
    </form>
</div>