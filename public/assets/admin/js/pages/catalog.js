'use strict';
// Class definition
jQuery(document).ready(function () {
    // begin first table
    StockDatatable = $('#stock_datatable').DataTable({
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
            url: window.baseUrl + '/admin/stock/show',
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
                render: function (data, type, full, meta) {
                    return '<input type="checkbox" class="form-control form-control-sm catalog-checkbox" placeholder="" aria-controls="stock_datatable" data-id="' + full.id + '" >';
                },
            },
            { data: 'product_name' },
            { data: 'product_company' },
            {
                data: null,
                render: function (data, type, full, meta) {
                    return '<a href="' + baseUrl + '/admin/stock/' + full.id + '/edit" class="btn btn-sm btn-clean btn-icon btn-icon-md " title="Edit details">\
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
jQuery(document).on("change", ".catalog-checkbox", function () {
    var selectedCount = $('input[type="checkbox"]:checked').length;
    var _btn = false;
    if (selectedCount == 0) {
        _btn = true;
    }
    $('#GetCatalogBtn').prop('disabled', _btn);
});
jQuery(document).on("click", "#GetCatalogBtn", function () {

    var formInputs = $("#productIdInputs");
    formInputs.html("");
    var checkedCheckboxes = $('input[type="checkbox"]:checked');
    checkedCheckboxes.each(function () {
        // selectedIDs.push($(this).data('id'));
        var str = "<input type='hidden' name='product_ids[]' value='" + $(this).data('id') + "'>";
        formInputs.append(str);
    });

});

