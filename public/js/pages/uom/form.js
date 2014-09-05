
/* global globals, uomId, form_utilities */

(function () {

    $(document).ready(function () {
        initializeEvents();
    });

    function initializeEvents() {
        $('#action-create-new').click(function () {
            saveNew(function () {
                setTimeout(function () {
                    window.location.reload();
                }, globals.reloadRedirectWaitTime);
            });
        });

        $('#action-create-close').click(function () {
            saveNew(function () {
                setTimeout(function () {
                    window.location.href = "/uom";
                }, globals.reloadRedirectWaitTime);
            });
        });

        $('#action-update-close').click(function () {
            update(function () {
                setTimeout(function () {
                    window.location.href = "/uom";
                }, globals.reloadRedirectWaitTime);
            });
        });
    }

    function saveNew(callback) {
        var data = form_utilities.formToJSON($('#form-uom'));
        save(data, 'create', callback);
    }

    function update(callback) {
        var data = form_utilities.formToJSON($('#form-uom'));
        save(data, 'update', callback);
    }

    function save(data, type, callback) {

        var url = "/uom";
        var ajaxType;
        if (type === 'update') {
            url += "/" + uomId;
            ajaxType = "PUT";
        } else {
            ajaxType = "POST";
        }

        $.ajax({
            url: url,
            type: ajaxType,
            data: data,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                swal("Success!", "UOM Saved!", "success");
                callback();
            }
        });

    }

})();
