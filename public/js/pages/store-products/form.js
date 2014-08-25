/* global _, availableUOM, storeId, productId, datatable_utilities, baseURL, form_utilities */

(function () {

    var productUOMTemplate;
    var $uomTable;

    $(document).ready(function () {

        initializeTemplates();
        initializeTable();
        initializeEvents();

    });

    function initializeTemplates() {

        productUOMTemplate = _.template($('#template-product-uom').html());

    }

    function initializeEvents() {
        $('#action-add-uom').click(function () {
            var html = productUOMTemplate({
                availableUOM: availableUOM,
                uom_code: null,
                price_per_uom: 0
            });

            swal({
                type: 'info',
                html: html,
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: '<i class="fa fa-check"></i> Add UOM'
            }).then(function () {
                var data = form_utilities.formToJSON($('#product-uom-form'));
                console.log(data);
                data.uom = {
                    name: $('#input-uom option:selected').html()
                };

//                $uomTable.row.add(data);
                $uomTable.row.add(data).draw();

                $('#uom-table td:first-child > a').unbind('click');
                $('#uom-table td:first-child > a').click(function (e) {
                    e.preventDefault();
                    alert($(this).data('original-title'));
                });
            });
        });

    }

    function initializeTable() {
        $uomTable = $('#uom-table').DataTable({
            processing: true,
            paging: false,
//            serverSide: true,
            search: {
                caseInsensitive: true
            },
            ajax: {
                url: "/products/" + productId + "/uom/datatable"
            },
            order: [1, "desc"],
            columns: [
                {data: 'uom_code'},
                {data: 'uom.name'},
                {data: 'price_per_uom'}
            ],
            columnDefs: [
                {bSearchable: false, aTargets: [0]},
                {orderable: false, targets: [0]},
                {
                    targets: 0,
                    render: function (columnData, type, rowData, meta) {
                        var editAction = datatable_utilities.getDefaultEditAction(columnData);
                        var deleteAction = datatable_utilities.getDefaultDeleteAction(columnData);
                        var view = datatable_utilities.getInlineActionsView([editAction, deleteAction]);

                        return view;
                    }
                }
            ]
        });
    }

    function saveProductUOM(callback) {

        var url = baseURL + "/products/";
        var data = shop;
        data._token = _token;
        $.ajax({
            url: url,
            type: 'POST',
            data: shop,
            dataType: 'json',
            success: function (response) {
                console.log(response);
            }
        });

    }

})();