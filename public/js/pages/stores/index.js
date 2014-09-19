
(function () {

    $(document).ready(function () {
        initializeDatatable();
        initializeEvents();
    });

    function initializeDatatable() {
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
                {data: 'id'},
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
                        var deleteAction = datatable_utilities.getDefaultDeleteAction(columnData);
                        var editAction = datatable_utilities.getDefaultEditAction(columnData);
                        var viewAction = datatable_utilities.getDefaultViewAction(columnData);
                        var view = datatable_utilities.getInlineActionsView([viewAction, editAction, deleteAction]);
                        return view;
                    }
                }
            ]
        });
    }

    function initializeEvents() {
        $(document).on('click', '.action-delete', function () {

            var storeId = $(this).data('id');

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this store once deleted!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: true
            }).then(function () {
                var url = "/stores/" + storeId + "/deactivate";
                $.get(url, function (response) {
                    console.log(response);
                    swal('Deleted!', 'The store is now deactivated / deleted', 'success');
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000)
                });
            }, function () {
                console.log('cancelled');
            });
        });
    }

})();
