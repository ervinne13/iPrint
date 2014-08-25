<div class="row">
    <form id="form-store-product">
        {{ csrf_field() }}
        <div class="col-lg-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Product Info</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div id="panel-store" class="box-body">
                    <div class="form-group">
                        <label for="input-name">Name</label>
                        <input type="text" required name="name" class="form-control" id="input-name" placeholder="Store Name" value="{{ $product->name }}">
                    </div>
                </div><!-- /.box-body -->
            </div>
        </div>

        <div class="col-lg-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Units Of Measurement / Prices</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div id="panel-owner" class="box-body">                    
                    <table class="table table-striped table-borderless" id="uom-table">
                        <thead>
                            <tr>
                                <th>
                                    <a id="action-add-uom" href="javascript:void(0)">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </th>
                                <th>UOM</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div><!-- /.box-body -->
            </div>
        </div>
    </form>
</div>