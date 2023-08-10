'use strict';

jQuery(document).ready(function () {
    var StockDatatable;

    function initializeDataTable(params = {}) {
        if (StockDatatable) {
            StockDatatable.destroy();
        }
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
                data: params,
            },
            columns: [
                { data: 'product_name' },
                { data: 'product_company' },
                {
                    data: 'inward_qty',
                    render: function (data, type, full, meta) {
                        if (full.balanced != null) {
                            return full.balanced.balanced_qty;
                        } else {
                            return 'N/A';
                        }
                    }
                },
                {
                    data: null,
                    render: function (data, type, full, meta) {
                        var image_url = window.baseUrl;
                        if (typeof full.product_images !== 'undefined' && Array.isArray(full.product_images) && full.product_images.length > 0) {
                            image_url += '/' + full.product_images[0].name;
                        } else {
                            image_url += '/images/logo.jpg';
                        }
                        return '<img src="' + image_url + '" style="height: 50px;width: 50px;">';
                    }
                },
                // ... other column definitions ...
            ],
        });
    }

    initializeDataTable();

    $(document).on("change", "#category_id", function (e) {
        var selectedValue = $(this).val();
        var params = { category_id: selectedValue };
        initializeDataTable(params);
    });

    $(document).on("click", ".deleteRecord", function () {
        $("#deleteModal").modal('show');
        $("#record_id").val(this.id);
    });

    $(document).on("click", ".submit_delete", function () {
        var id = $("#record_id").val();
        $.ajax({
            url: baseUrl + '/admin/stock/' + id,
            type: "DELETE",
            data: { "id": id },
            dataType: 'json',
            success: function (data) {
                if (data === 'Error') {
                    toastr.error("Oops, There is something went wrong. Please try again later.");
                } else {
                    toastr.success('Record Deleted Successfully.');
                    StockDatatable.ajax.reload();
                }
            },
            error: function (data) {
                toastr.error("Invalid Request");
            }
        });

        $("#deleteModal").modal('hide');
    });
});
