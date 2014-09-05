
(function () {

    $(document).ready(function () {
        setupValidation();
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

    function initializeEvents() {
        $('#action-register-user').click(registerUser);
    }


})();


