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

                    <div id="map"></div>
                </div><!-- /.box-body -->
            </div>
        </div>

        @if ($mode == 'create')
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
        @else
        <div class="col-lg-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Store Other Info / Settings</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<div class="form-group">
                        <label for="input-name">Store Information / Description</label>
						<textarea class="form-control" name="description" id="input-min-order" >{{ $shop->description }}</textarea>                        
                    </div>
                    <div class="form-group">
                        <label for="input-name">Minimum Order</label>
                        <input type="number" class="form-control" name="min_order_limit" id="input-min-order" value="{{ $shop->min_order_limit }}">
                    </div>
                    <div class="form-group">
                        <label for="input-store-image">Store Logo</label>
                        <input type="file" id="input-store-image" name="image">
                        <p class="help-block">Ideal size is 250px x 250px</p>

                        <img src="{{ URL::to('/') . $shop->logo_url }}" width="250px" height="250px" id="store-image">
                        <input type="hidden" name="logo_url">
                    </div>

                </div>
            </div><!-- /.box -->
        </div>
        @endif
    </form>
</div>