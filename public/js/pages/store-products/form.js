/* global _, availableUOM, storeId, productId, datatable_utilities, baseURL, form_utilities, globals */

(function () {

    var productUOMTemplate;
    var $uomTable;

    var fileUploadPending = false;

    $(document).ready(function () {

        initializeTemplates();
        initializeTable();
        initializeEvents();

    });

    function initializeTemplates() {

        productUOMTemplate = _.template($('#template-product-uom').html());

    }

    function initializeEvents() {
        $("#input-product-image").change(function () {
            previewFileImage(this, $('#product-image'));
            uploadFile(this);
        });

        $('#action-add-uom').click(function () {
            addUOM();
        });

        $('#uom-table').on('click', '.action-edit', function (e) {
            e.preventDefault();
            editUOM($(this));
        });

        $('#uom-table').on('click', '.action-delete', function (e) {
            e.preventDefault();
            deleteUOM($(this));
        });

        $('#action-create-new').click(function () {
            saveProduct(function () {
                setTimeout(function () {
                    window.location.reload();
                }, globals.reloadRedirectWaitTime);
            });
        });

        $('#action-create-close').click(function () {
            saveProduct(function () {
                setTimeout(function () {
                    window.location.href = "/stores/" + storeId + "/products";
                }, globals.reloadRedirectWaitTime);
            });
        });

        $('#action-update-close').click(function () {
            updateProduct(function () {
                setTimeout(function () {
                    window.location.href = "/stores/" + storeId + "/products";
                }, globals.reloadRedirectWaitTime);
            });
        });

    }

    function initializeTable() {
        $uomTable = $('#uom-table').DataTable({
            processing: true,
            paging: false,
//            serverSide: mode == "edit", //  will fetch data from server on edit mode
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

    function previewFileImage(input, $img) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $img.attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function uploadFile(input) {
        if (input.files && input.files[0]) {
            var formData = new FormData();
            formData.append('file', input.files[0]);

            $.ajax({
                url: '/file/upload',
                type: 'POST',
                processData: false, // important
                contentType: false, // important                
                data: formData,
                success: function (response) {
                    console.log(response);
                    $('[name=image_url]').val("/uploads/" + response);
                    fileUploadPending = false;
                }
            });

            fileUploadPending = true;

        }
    }

    function editUOM($editButton) {

        addUOM(function () {
            deleteUOM($editButton, true);   //  true = noConfirm
        });

    }

    function deleteUOM($deleteButton, noConfirm) {

        if (noConfirm) {
            $uomTable.row($deleteButton.parents('tr')).remove().draw();
        } else {
            swal({
                type: 'warning',
                title: "Are you sure?",
                text: "Deleting a unit of measurement can cause issues when opening old job orders that used this unit of measurement!.",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: '<i class="fa fa-close"></i> Delete UOM'
            }).then(function () {
                $uomTable.row($deleteButton.parents('tr')).remove().draw();

            });
        }
    }

    function addUOM(callback) {
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

            $uomTable.row.add(data).draw();

            if (callback) {
                callback();
            }
        });
    }

    function saveProduct(callback) {

        if (fileUploadPending) {
            swal({
                title: "Upload Pending",
                text: "Upload is still ongoing! Please wait",
                type: "warning"
            });
            return;
        }

        var url = "/stores/" + storeId + "/products";
        var uom = $uomTable.rows().data();
        var data = form_utilities.formToJSON($('#form-store-product'));
        data.product_uom = uom.length > 0 ? cleanupDataTableData(uom) : [];
        console.log(data.product_uom);
        console.log(data);

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                swal("Success!", "Product Saved!", "success");
                callback();
            }
        });

    }

    function updateProduct(callback) {

        if (fileUploadPending) {
            swal({
                title: "Upload Pending",
                text: "Upload is still ongoing! Please wait",
                type: "warning"
            });
            return;
        }

        var url = "/stores/" + storeId + "/products/" + productId;
        var uom = $uomTable.rows().data();
        var data = form_utilities.formToJSON($('#form-store-product'));
        data.product_uom = uom.length > 0 ? cleanupDataTableData(uom) : [];
        console.log(data.product_uom);
        console.log(data);

        $.ajax({
            url: url,
            type: 'PUT',
            data: data,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                swal("Success!", "Product Saved!", "success");
                callback();
            }
        });

    }

    function cleanupDataTableData(rawData) {
        var data = [];

        for (var i in rawData) {
            if (!isNaN(i)) {
                data.push(rawData[i]);
            }
        }

        return data;
    }

})();