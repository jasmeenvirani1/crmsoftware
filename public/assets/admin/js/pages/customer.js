'use strict';

jQuery(document).ready(function () {
    // begin first table
    VendorDatatable = $('#customer_datatable').DataTable({
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
            url: window.baseUrl + '/admin/company/show',
            type: 'POST',
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: 'application/json',
            data: {},
        },
        columns: [
            { data: 'name', orderable: false },
            { data: 'phonenumber', orderable: false },
            { data: 'email', orderable: false },
            {
                data: null,
                orderable: true,
                render: function (data, type, full, meta) {
                    if (full.default == '0' || full.default == null) {
                        return '<a href="javascript:void(0);" class="default-company select-company" data-id="' + full.id + '" title="Default Company">\
                        Select Primary\
                                ';
                    } else {
                        return '<a href="javascript:void(0);"  class="selected-company" data-id="' + full.id + '" title="Default Company">\
                                Selected\
                                ';
                    }
                }
            },
            {
                data: null,
                orderable: false,
                render: function (data, type, full, meta) {
                    return '<a href="' + baseUrl + '/admin/company/' + full.id + '/edit" class="btn btn-sm btn-clean btn-icon btn-icon-md " title="Edit details">\
                            <i class="la la-edit"></i>\
                            <a href="javascript:void(0);" id="' + full.id + '" class="btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord" title="Delete">\
                            <i class="la la-trash"></i>\
                        </a>\
                       ';
                }
            },
        ]
    });


});





$(document).on("click", ".deleteRecord", function () {
    $("#deleteModal").modal('show');
    $("#record_id").val(this.id);
});
$(document).on("click", ".submit_delete", function () {
    var id = $("#record_id").val();
    $.ajax({
        url: baseUrl + '/admin/company/' + id,
        type: "DELETE",
        data: { "id": id },
        dataType: 'json',
        success: function (data) {
            if (data == 'Error') {
                toastr.error("Oops, There is some thing went wrong.Please try after some time.");
            } else {
                toastr.success('Record Deleted Successfully.');
                $('#customer_datatable').DataTable().ajax.reload();
            }
        }, error: function (data) {
            toastr.error("Invalid Request");
        }
    });

    $("#deleteModal").modal('hide');
});
$(document).on("click", ".default-company", function () {
    var id = $(this).data('id');
    $.ajax({
        url: baseUrl + '/admin/company/default',
        type: "POST",
        data: { "id": id },
        dataType: 'json',
        success: function (data) {
            if (data == 'Error') {
                toastr.error("Oops, There is some thing went wrong.Please try after some time.");
            } else {
                toastr.success(data.msg);
                $('#customer_datatable').DataTable().ajax.reload();
            }
        }, error: function (data) {
            toastr.error("Invalid Request");
        }
    });

    $("#deleteModal").modal('hide');
});
