<div class="row">
    <form id="form-job-order">
        {{ csrf_field() }}
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Product Info</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div id="panel-store" class="box-body">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="input-name">Ordered By</label>
                            <input type="text" required disabled class="form-control" value="{{ $jobOrder->requestedBy->name }}">
                        </div>
                        <div class="form-group">
                            <label for="input-name">Payment Reference No.</label>
                            <input type="text" required disabled class="form-control" value="{{ $jobOrder->payment_ref_no }}">
                        </div>
                        <div class="form-group">
                            <label for="input-name">Order Date / Time</label>
                            <input type="text" required disabled class="form-control" value="{{ $jobOrder->created_at->format("m/d/Y H:i a") }}">
                        </div>
                        <div class="form-group">
                            <label for="input-name">Total Items Ordered</label>
                            <input type="text" required disabled class="form-control" value="{{ $jobOrder->total_item_qty }}">
                        </div>
                        <div class="form-group">
                            <label for="input-name">Total Sales</label>
                            <input type="text" required disabled class="form-control" value="{{ $jobOrder->total_cost }}">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="input-name">Attachment</label>
                            <a href="{{ $jobOrder->attachment_url }}" target="_blank">{{ $jobOrder->attachment_url }}</a>                            
                        </div> 
                        <div class="form-group">
                            <label for="input-name">Payment Supporting Attachment</label>
                            <a href="{{ $jobOrder->payment_supporting_attachment_url }}" target="_blank">{{ $jobOrder->payment_supporting_attachment_url }}</a>
                        </div>

                        <div class="form-group">
                            <label for="input-name">Status</label>
                            <select name="status" class="form-control">
                                @foreach($statusList AS $status)
                                <?php $selected = $status == $jobOrder->status ? "selected" : "" ?>
                                <option value="{{$status}}" {{$selected}}>{{$status}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="input-name">Remarks</label>
                            <textarea class="form-control" name="remarks">{{$jobOrder->remarks}}</textarea>
                        </div>
                    </div>
                </div><!-- /.box-body -->
            </div>
        </div>

        <div class="col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Ordered Products</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">                    
                    <table class="table table-striped table-borderless" id="uom-table">
                        <thead>
                            <tr>                                
                                <th>Product</th>
                                <th>UOM</th>
                                <th>Qty</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobOrder->productJunctions AS $productJunction)
                            <tr>
                                <td>{{$productJunction->product->name}}</td>
                                <td>{{$productJunction->uom->name}}</td>
                                <td>{{$productJunction->qty}}</td>
                                <td>{{$productJunction->sub_total}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div>
        </div>
    </form>
</div>