(function () {

    var $usersTable;

    $(document).ready(function () {

        initializeTable();
        initializeEvents();

    });

    function initializeTable() {

        $usersTable = $('#users-table').DataTable({
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
                {data: 'id'},
//                {data: 'is_active'},
                {data: 'name'},
                {data: 'email'},
                {data: 'role.name'}
            ],
            columnDefs: [
                {bSearchable: false, aTargets: [0]},
                {orderable: false, targets: [0]},
                {
                    targets: 0,
                    render: function (columnData, type, rowData, meta) {
                        var deleteAction = datatable_utilities.getDefaultDeleteAction(columnData);
                        var view = datatable_utilities.getInlineActionsView([deleteAction]);
                        return view;
                    }
                }
            ]
        });

    }

    function initializeEvents() {
        $(document).on('click', '.action-delete', function () {

            var userId = $(this).data('id');

            swal({
                title: "Are you sure?",
                text: "This user will be deleted/deactivated",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
//                closeOnConfirm: true
            }).then(function () {
                var url = "/users/" + userId + "/deactivate";
                $.get(url, function (response) {
                    console.log(response);
                    $usersTable.ajax.reload();
                    swal('Deleted!', 'The store is now deactivated / deleted', 'success');
                });
            }, function () {
                console.log('cancelled');
            });
        });
    }

})();