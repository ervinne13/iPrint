
(function () {

    var moduleUrl = "/stores/" + storeId + "/orders/";
    var noHttpBaseURL = utilities.trimPort(utilities.trimHttp(baseURL));
    var WSConnection = null;

    $(document).ready(function () {

        initializeWS();
        initializeUI();
        initializeEvents();

    });

    function initializeWS() {

        WSConnection = new WebSocket('ws://' + noHttpBaseURL + ':' + globals.socketPort);
        WSConnection.onopen = function (e) {
            //  for checking
            console.log("Connection established!");
            console.log(e);

        };

    }

    function initializeUI() {

        var $estimatedTimePicker = $('#estimated-time-timepicker').timepicker({
            showInputs: false
        });

        $estimatedTimePicker.on('hide.timepicker', function (e) {
            var value = $estimatedTimePicker.val();
            $('[name=estimated_time_of_completion]').val(value);
        });

        var estimatedTime = $('[name=estimated_time_of_completion]').val();
        if (estimatedTime) {
            $('#estimated-time-timepicker').val(estimatedTime);
        } else {
            $('#estimated-time-timepicker').val('');
        }

    }

    function initializeEvents() {

        $('#action-update-close').click(function () {

            update(function () {

                swal("Success!", "Job Order Updated!", "success");

                setTimeout(function () {
                    location.href = moduleUrl;
                }, 2000);
            });

        });

    }

    function update(callback) {

        var url = moduleUrl + jobOrderId;
        var data = {
            status: $('[name=status]').val(),
            estimated_time_of_completion: $('[name=estimated_time_of_completion]').val(),
            remarks: $('[name=remarks]').val()
        };

        console.log(data);

        $.ajax({
            url: url,
            type: 'PUT',
            data: data,
            dataType: 'json',
            success: function (response) {
                console.log(response);

                var notification = {
                    type: "NOTIFICATION_JOB_ORDER_UPDATED",
                    storeId: storeId,
                    jobOrderId: jobOrderId,
                    orderByUserId: orderByUserId,
                    status: data.status,
                    remarks: data.remarks,
                    estimated_time_of_completion: data.estimated_time_of_completion,
                };

                WSConnection.send(JSON.stringify(notification));
                callback();
            }
        });
    }

})();
