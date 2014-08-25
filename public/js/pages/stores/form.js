
/* global form_utilities, baseURL */

(function () {

    $(document).ready(function () {
        setupValidation();
        $('#action-submit').click(submitForm);

    });

    function setupValidation() {
        $('#form-store').validate({
            rules: {
                password1: "required",
                password2: {
                    equalTo: "[name=password1]"
                }
            }
        });
    }

    function submitForm() {

        var shop = form_utilities.formToJSON($('#panel-store'));
        shop.owner = form_utilities.formToJSON($('#panel-owner'));

        console.log(shop);

        if ($('#form-store').valid()) {
            var url = baseURL + "/stores";
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


    }

})();