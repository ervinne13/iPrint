
/* global storeId, datatable_utilities, baseURL, utilities, globals */

(function () {

    var noHttpBaseURL = utilities.trimHttp(baseURL);
    var WSConnection = null;
    var $joTable;

    $(document).ready(function () {
        initializeTable();
        initializeWS();
    });

    function initializeWS() {

        WSConnection = new WebSocket('ws://' + noHttpBaseURL + ':' + globals.socketPort);
        WSConnection.onopen = function (e) {
            //  for checking
            console.log("Connection established!");
            console.log(e);
        };

        WSConnection.onmessage = function (e) {
            if (e.data && e.data == "NOTIFICATION_NEW_JOB_ORDER") {
                $joTable.ajax.reload();
            }
        };

    }

    function initializeTable() {

        var url;

        if (dataFetchType == 'activeOnly') {
            url = "/stores/" + storeId + "/orders/datatable/active";
        } else {
            url = "/stores/" + storeId + "/orders/datatable";
        }

        $joTable = $('#job-orders-table').DataTable({
            processing: true,
            serverSide: true,
            search: {
                caseInsensitive: true
            },
            ajax: {
                url: url
            },
            order: [4, "desc"],
            columns: [
                {data: 'id'},
                {data: 'requested_by.name'},
                {data: 'payment_ref_no'},
                {data: 'status'},
                {data: 'created_at'},
                {data: 'total_item_qty'},
                {data: 'total_cost'}
            ],
            columnDefs: [
                {bSearchable: false, aTargets: [0, 1]},
                {orderable: false, targets: [0, 1]},
                {
                    targets: 0,
                    render: function (columnData, type, rowData, meta) {

                        var baseUrl = "/stores/" + storeId + "/orders";

                        var editAction = datatable_utilities.getDefaultEditAction(columnData, baseUrl);
                        var view = datatable_utilities.getInlineActionsView([editAction]);

                        return view;
                    }
                },
                {
                    targets: 3,
                    render: function (columnData, type, rowData, meta) {
                        return "<b>" + columnData + "</b>";
                    }
                }
            ]
        });
    }

})();
