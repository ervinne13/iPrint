@extends('layouts.lte')

@section('js')
<script src="{{ asset ("/vendor/underscore/underscore.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/pages/test/dynamic-field.js") }}" type="text/javascript"></script>
@endsection

@section('content')

<section class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Store Info</h3>
                </div>

                <div class="box-body ">
                    <a href="javascript:void(0)" id="action-add-field">Add Field</a>

                    <div id="dynamic-field-container">

                    </div>
                </div>
            </div>    
        </div>    
    </div>    

</section>

<script type="text/html" id="template-dynamic-field">

    <select class="form-control">        
        <% _.each(options, function(option) { %>
        <option value="<%=option%>"><%=option%></option>
        <% }); %>
    </select>

</script>

@endsection