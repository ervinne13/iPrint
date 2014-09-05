
/* global _ */

var datatable_utilities = {};

/**
 * Requires #template-table-inline-actions
 * @param {type} actions
 * @returns {undefined}
 */
datatable_utilities.getInlineActionsView = function (actions) {

    var template = _.template($('#template-table-inline-actions').html());

    return template({actions: actions});

};

datatable_utilities.getDefaultEditAction = function (id, baseUrl) {

    var href = window.location.href + "/" + id + "/edit";

    if (baseUrl) {
        href = baseUrl + "/" + id + "/edit";
    }

    return {
        id: id,
        href: href,
        name: "edit",
        displayName: "Edit",
        icon: "fa-pencil"
    };
};


datatable_utilities.getDefaultDeleteAction = function (id) {
    return {
        id: id,
//        href: window.location.href + "/" + id,
        href: "javascript:void(0)",
        name: "delete",
        displayName: "Delete",
        icon: "fa-times"
    };
};
