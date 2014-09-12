
(function () {

    var dynamicFieldTemplate;

    $(document).ready(function () {

        dynamicFieldTemplate = _.template($('#template-dynamic-field').html());

        initializeEvents();

    });

    function initializeEvents() {
        $('#action-add-field').click(addField);
    }

    function addField() {
        $('#dynamic-field-container').append(dynamicFieldTemplate({
            options: [
                "option 01",
                "option 02",
                "option 03",
                "option 04",
                "option 05",
                "option 06",
                "option 07",
            ]
        }));

    }

})();
