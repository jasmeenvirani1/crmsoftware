'use strict';
// Class definition
jQuery(document).ready(function () {
    // begin first table
    RolesDatatable = $('#roles_datatable').DataTable({
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        buttons: [
            'print',
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
        ],
        ajax: {
            url: window.baseUrl + '/admin/role/show',
            type: 'POST',
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: 'application/json',
            data: {},
        },
        columns: [
            {
                data: 'created_at',
                render: function (data, type, full, meta) {
                    return moment(full.created_at).format('DD-MM-YYYY');
                }
            },
            { data: 'name' },
            {
                data: null,
                render: function (data, type, full, meta) {
                    return '<a href="' + baseUrl + '/admin/role/' + full.id + '/edit" class="btn btn-sm btn-clean btn-icon btn-icon-md " title="Edit details">\
                            <i class="la la-edit"></i>\
                            <a href="javascript:void(0);" id="' + full.id + '" class="btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord" title="Delete">\
                            <i class="la la-trash"></i>\
                        </a>\
                       ';
                }
            },
        ]
    });
    $('#export_print').on('click', function (e) {
        e.preventDefault();
        RolesDatatable.button(0).trigger();
    });

    $('#export_copy').on('click', function (e) {
        e.preventDefault();
        RolesDatatable.button(1).trigger();
    });

    $('#export_excel').on('click', function (e) {
        e.preventDefault();
        RolesDatatable.button(2).trigger();
    });

    $('#export_csv').on('click', function (e) {
        e.preventDefault();
        RolesDatatable.button(3).trigger();
    });

    $('#export_pdf').on('click', function (e) {
        e.preventDefault();
        RolesDatatable.button(4).trigger();
    });

});
$(document).on("click", ".deleteRecord", function () {
    $("#deleteModal").modal('show');
    $("#record_id").val(this.id);
});
$(document).on("click", ".submit_delete", function () {
    var id = $("#record_id").val();
    $.ajax({
        url: baseUrl + '/admin/role/' + id,
        type: "DELETE",
        data: { "id": id },
        dataType: 'json',
        success: function (data) {
            if (data == 'Error') {
                toastr.error("Oops, There is some thing went wrong.Please try after some time.");
            } else {
                toastr.success('Record Deleted Successfully.');
                $('#roles_datatable').DataTable().ajax.reload();
            }
        }, error: function (data) {
            toastr.error("Invalid Request");
        }
    });

    $("#deleteModal").modal('hide');
});

