<script id="template-product-uom" type="text/html">

    <form id="product-uom-form" class="form-horizontal">
        <div class="form-group">
            <label for="input-uom">Unit</label>        
            <select required name="uom_code" id="input-uom" class="form-control select2">
                <% _.each(availableUOM, function(uom) { %>
                <% var selected = uom_code == uom.code ? "selected" : ""; %>
                <option value="<%=uom.code%>" <%=selected%>><%=uom.name%></option>
                <% }); %>
            </select>
        </div>
        <div class="form-group">
            <label for="input-price_per_uom">Price</label>
            <input type="text" required name="price_per_uom" class="form-control" id="input-price_per_uom" placeholder="Price" value="<%=price_per_uom%>">
        </div>
    </form>

</script>