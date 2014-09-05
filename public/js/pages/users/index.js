(function () {
    $(document).ready(function () {

        initializeTable();

    });

    function initializeTable() {

        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            search: {
                caseInsensitive: true
            },
            ajax: {
                url: "/users/datatable"
            },
            order: [1, "desc"],
            columns: [
                {data: 'id'},
//                {data: 'is_active'},
                {data: 'name'},
                {data: 'email'},
                {data: 'role.name'}
            ],
//            columnDefs: [
//                {
//                    targets: 1,
//                    render: function (columnData, type, rowData, meta) {
//                        return columnData == 1 ? "Active" : "Inactive";
//                    }
//                }
//            ]
        });

    }

})();