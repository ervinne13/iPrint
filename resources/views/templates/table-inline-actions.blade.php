
<script id="template-table-inline-actions" type="text/html">
    <% _.each(actions, function(action) { %>

    <a  href="<%= action.href %>" data-id="<%= action.id %>"
        data-container="body" 
        data-toggle="tooltip" 
        data-placement="top" 
        title="<%= action.name %>">    
        <span class="fa <%= action.icon %>"></span>
    </a>

    <% }); %>
</script>