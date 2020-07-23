$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// var $loading = $('#loading').hide();
// $(document).ajaxStart(function () {
//     $loading.show();
//   }).ajaxStop(function () {
//     $loading.delay().fadeOut("");
//   });

$(document).ready(function () {
        

    $(".delivery-detail-edit").click(function () {

        var prod_id;

        prod_id = $(this).attr('dm-data')

        $.ajax({
            url: '/deliveryorders/detail/ajax',
            method: "GET",
            data: {
                prod_id: prod_id
            },
            success: function (response) {
                $('#deliveryEditProductId').val(response.detailData.product_id);
                $('#deliveryEditQty').val(response.detailData.qty);
                $('#deliveryEditNote').val(response.detailData.note);
            },
        });
    });

    // $(".salesBargainDetailEdit").click(function () {

    //     var prod_id;

    //     prod_id = $(this).attr('dm-data')

    //     $.ajax({
    //         url: '/sales/bargains/detail/' + prod_id + '/ajax',
    //         method: "GET",
    //         success: function (response) {
    //             $('#editBargainDetailProdId').val(response.detailData.product_id);
    //             $('#editBargainDetailQty').val(response.detailData.qty);
    //             $('#editBargainDetailBargainPrice').val(response.detailData.bargain_price);
    //             $('#editBargainUnitPrice').val(response.detailData.unit_price);
    //         },
    //     });
    // });

    $(".customerPoDetailEdit").click(function () {

        var prod_id;

        prod_id = $(this).attr('dm-data')

        $.ajax({
            url: '/sales/purchaseorders/detail/' + prod_id + '/ajax',
            method: "GET",
            success: function (response) {
                $('#poEditProductIdCustomer').val(response.detailData.product_id);
                $('#editDetailCustomerQty').val(response.detailData.qty);
                $('#editDetailCustomerDiscount').val(response.detailData.discount);
            },
        });
    });

    /** Check setelah typing berhenti beberapa saat **/
    var typingTimer;

    $("#invoiceCreatePoId").on('keyup', function () {
        clearTimeout(typingTimer)
        typingTimer = setTimeout(checkInvoicePoId, 500)
    });

    $("invoiceCreatePoId").on('keydown', function () {
        clearTimeout(typingTimer);
    })

    function checkInvoicePoId() {
        var po_id;
        po_id = $('#invoiceCreatePoId').val();

        $.ajax({
            url: '/invoices/check/ajax',
            method: "GET",
            data: {
                po_id: po_id
            },
            success: function (response) {
                $('#invoicePoIdCheck').html(response.message);
            },
        });
    }
});
