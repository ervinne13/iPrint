
(function () {

    $(document).ready(function () {
        $('#shops-table').DataTable({
            processing: true,
            serverSide: true,
            search: {
                caseInsensitive: true
            },
            ajax: {
                url: "/stores/datatable"
            },
            order: [1, "desc"],
            columns: [
                {data: 'actions'},
                {data: 'id'},
                {data: 'name'},
                {data: 'owner.name'},
                {data: 'location_lat'},
                {data: 'location_long'}
            ],
            columnDefs: [
                {bSearchable: false, aTargets: [0]},
                {orderable: false, targets: [0]},
                {
                    targets: 0,
                    render: function (columnData, type, rowData, meta) {
                        console.log(columnData);
//                        return sgdatatable.generateAccessInlineView(rowData.SI_DocNo, columnData);
                        return "";
                    }
                }
            ]
        });
    });

})();
