
/* global datatable_utilities */

(function () {

    $(document).ready(function () {

        $('#uom-table').DataTable({
            processing: true,
            serverSide: true,
            search: {
                caseInsensitive: true
            },
            ajax: {
                url: "/uom/datatable"
            },
            order: [1, "desc"],
            columns: [
                {data: 'code'},
                {data: 'code'},
                {data: 'name'}
            ],
            columnDefs: [
                {bSearchable: false, aTargets: [0]},
                {orderable: false, targets: [0]},
                {
                    targets: 0,
                    render: function (columnData, type, rowData, meta) {

                        var editAction = datatable_utilities.getDefaultEditAction(columnData);
                        var view = datatable_utilities.getInlineActionsView([editAction]);

                        return view;
                    }
                }
            ]
        });

    });

})();


