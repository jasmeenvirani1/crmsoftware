'use strict';
// Class definition
jQuery(document).ready(function () {
        // begin first table
       CustomerDatatable = $('#purchase_datatable').DataTable({
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
                url: window.baseUrl + '/admin/purchase/show',
                type: 'POST',
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: 'application/json',
                data: {},
            },
            columns: [
                {data: 'po_no'},      
                {data: 'organization_name'},
                {data: 'ship_to'},
                {
                    data: "priority",
                    render:  function(row) {
                        let isActiveClass= (row=="Cancle")?"label-light-primary":(row=="Hold")?"label-light-danger":"label-light-success";  
                        return '<span class="label label-lg font-weight-bold ' + isActiveClass + ' label-inline">' + row + '</span>';
                    },
                },
               {
                    render: function (data, type, full, meta) {
                       return '\
                       <a href="' + baseUrl + '/admin/purchase/invoice/' + full.id + '" class="btn btn-brand btn-icon-sm" title="Generate Invoice">\
                           Invoice\
                       </a>\
                   ';
                   },
               },
                {
                    data: null,
                    render: function (data, type, full, meta) {
                        return '<a href="' + baseUrl + '/admin/purchase/' + full.id + '/edit" class="btn btn-sm btn-clean btn-icon btn-icon-md " title="Edit details">\
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
            CustomerDatatable.button(0).trigger();
        });

        $('#export_copy').on('click', function (e) {
            e.preventDefault();
            CustomerDatatable.button(1).trigger();
        });

        $('#export_excel').on('click', function (e) {
            e.preventDefault();
            CustomerDatatable.button(2).trigger();
        });

        $('#export_csv').on('click', function (e) {
            e.preventDefault();
            CustomerDatatable.button(3).trigger();
        });

        $('#export_pdf').on('click', function (e) {
            e.preventDefault();
            CustomerDatatable.button(4).trigger();
        });



});
$(document).on("click", ".deleteRecord", function () {
    $("#deleteModal").modal('show');
    $("#record_id").val(this.id);
});
$(document).on("click", ".submit_delete", function () {
    var id = $("#record_id").val();
    $.ajax({
        url: baseUrl + '/admin/purchase/' + id,
        type: "DELETE",
        data: {"id": id},
        dataType: 'json',
        success: function (data) {
            if (data == 'Error') {
                toastr.error("Oops, There is some thing went wrong.Please try after some time.");
            } else {
                toastr.success('Record Deleted Successfully.');
                 $('#purchase_datatable').DataTable().ajax.reload();
            }
        }, error: function (data) {
            toastr.error("Invalid Request");
        }
    });

    $("#deleteModal").modal('hide');
});