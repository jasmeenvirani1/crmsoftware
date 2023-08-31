'use strict';
// Class definition
jQuery(document).ready(function () {
    // begin first table
    StockDatatable = $('#stock_datatable').DataTable({
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        ordering: false,
        buttons: [
            'print',
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
        ],
        ajax: {
            url: window.baseUrl + '/admin/catalog/show',
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

            {
                render: function (data, type, full, meta) {
                    var image_url = window.baseUrl;
                    if (typeof full.product_images !== 'undefined' && Array.isArray(full.product_images) && full.product_images.length > 0) {
                        image_url += '/' + full.product_images[0].name;
                    } else {
                        image_url += '/images/logo.jpg';
                    }
                    return '<img src="' + image_url + '" style="height: 50px;width: 50px;">';
                },
            },
            { data: 'product_name' },
            {
                render: function (data, type, full, meta) {
                    var categories_str = "";
                    if (full.categories != null) {

                        if (full.categories.length != 0) {
                            full.categories.forEach(function (data, element) {
                                if (data.get_categories_name != null) {
                                    categories_str += data.get_categories_name.name + ' ,';
                                }
                            });
                            return categories_str.slice(0, -1);
                        }
                        else {
                            return null;
                        }
                    } else {
                        return null;
                    }

                },
            },
            { data: 'product_company' },
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
    var str = "";
    checkedCheckboxes.each(function () {
        // str += "<input type='hidden' name='product_ids[]' value='" + $(this).data('id') + "'>";
        str += 'product_ids[]=' + $(this).data('id') + '&';
    });
    formInputs.append(str);
    // $("#ProductCatalogForm").submit();
    var url = window.baseUrl + '/admin/get-catalog/selected?' + str;
    window.open(url, '_blank');


});

