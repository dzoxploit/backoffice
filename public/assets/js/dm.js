
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    $("#search-product").click(function () {
        var po_num, supplier, discount, type, note, date;

        date = $("#po-date").val();
        supplier = $("#supplier-option").val();
        discount = $("#discount").val();
        type = $("#discount-type").val();
        note = $("#note").val();
        po_num = $("#po-num").val();
        date = $('#po-date').val();

        $.ajax({
            url: '/purchaseorders/temp/store',
            method: "post",
            data: {
                po_num: po_num,
                supplier: supplier,
                discount: discount,
                type: type,
                date: date,
                note: note,
            },
            success: function (response) {
                window.location = "/purchaseorders/product";
            },
        });
    });

    $(".poDetailUpdate").click(function () {

        var product_id = $(this).attr('dm-data');

        $.ajax({
            url: '/purchaseorders/detail/' + product_id + '/ajax',
            method: "get",
            success: function (response) {
                console.log(response);
                $('#poEditProductId').val(response.tempDetailPo.product_id);
                $('#editDetailDiscount').val(response.tempDetailPo.discount);
                $('#editDetailQty').val(response.tempDetailPo.qty);
            },
        });
    });

    /**
     * Delivery Ordes
     * 
     */
    $("#deliveryDoAddProduct").click(function () {
        var do_id, do_num, po_id, do_date, do_sender, do_receiver, do_deliveryman, do_note;

        do_id = $("#inputDeliveryDoId").val();
        do_num = $("#inputDeliveryDoNum").val();
        po_id = $("#inputDeliveryPoId").val();
        do_sender = $("#inputDeliveryDoSender").val();
        do_receiver = $("#inputDeliveryDoReceiver").val();
        do_deliveryman = $('#inputDeliveryDoDeliveryman').val();
        do_date = $("#inputDeliveryDoDate").val();
        do_note = $("#inputDeliveryDoNote").val();


        $.ajax({
            url: '/deliveryorders/temp/save',
            method: "post",
            data: {
                do_id: do_id,
                do_num: do_num,
                po_id: po_id,
                do_sender: do_sender,
                do_receiver: do_receiver,
                do_deliveryman: do_deliveryman,
                do_date: do_date,
                do_note: do_note
            },
            success: function (response) {
                if (response.message == 'data_inserted' || 'data_not_inserted') {
                    window.location = "/deliveryorders/product";
                } else {
                    console.log('Error,' + response);
                }

            },
        });
    });

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

    
    /** Check setelah typing berhenti beberapa saat Delivery Orders**/
    var deliveryTypingTimer;
	
    $("#inputDeliveryPoId").on('keyup', function () {
        clearTimeout(deliveryTypingTimer)
        deliveryTypingTimer = setTimeout(checkDeliveryPoId, 500)
    });

    $("inputDeliveryPoId").on('keydown', function () {
        clearTimeout(deliveryTypingTimer);
    })

    function checkDeliveryPoId() {
        var po_id;
        po_id = $('#inputDeliveryPoId').val();

        $.ajax({
            url: '/deliveryorders/check/ajax',
            method: "GET",
            data: {
                po_id: po_id
            },
            success: function (response) {
                $('#deliveryPoIdCheck').html(response.message);
            },
        });
    }

});
