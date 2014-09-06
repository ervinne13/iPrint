
(function () {

    var moduleUrl = "/stores/" + storeId + "/orders/";
    var noHttpBaseURL = utilities.trimPort(utilities.trimHttp(baseURL));
    var WSConnection = null;

    $(document).ready(function () {

        initializeWS();
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
            remarks: $('[name=remarks]').val()
        };

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
                    remarks: data.remarks
                };

                WSConnection.send(JSON.stringify(notification));
                callback();
            }
        });
    }

})();
