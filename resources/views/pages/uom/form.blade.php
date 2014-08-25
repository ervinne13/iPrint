<div class="row">
    <form id="form-store">
        {{ csrf_field() }}
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="box-header with-border">
                            <h3 class="box-title">Store Info</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <div id="panel-store" class="box-body">                    
                            <div class="form-group">
                                <label for="input-code">Code</label>
                                <input type="text" required name="code" class="form-control" id="input-code" placeholder="Something Unique Ex. PIECE" value="{{ $uom->code }}">
                            </div>
                            <div class="form-group">
                                <label for="input-name">Name</label>
                                <input type="text" required name="name" class="form-control" id="input-name" placeholder="UOM Name" value="{{ $uom->name }}">
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-body -->
            </div>
        </div>
    </form>
</div>