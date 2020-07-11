/** Check setelah typing berhenti beberapa saat **/
var typingTimer;

$("#invoiceCreatePoId").on('keyup', function () {
    clearTimeout(typingTimer)
    typingTimer = setTimeout(function () {
        checkInvoicePoId();
        getInvoicePriceInfo();
    }, 500)
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

function getInvoicePriceInfo() {
    var po_id;
    po_id = $('#invoiceCreatePoId').val();
    $.ajax({
        url: '/invoices/po/calculation/discount/ajax',
        method: "get",
        data: {
            po_id: po_id
        },
        success: function (response) {
            console.log(response);
            $('#invoiceTotal').html(response.totalPrice);
        },
    });
}

$('.ppnswitch').click(function () {
    var po_id = $('#invoiceCreatePoId').val();
    if ($(this).prop("checked") == true) {
        $.ajax({
            url: '/invoices/po/calculation/ppn/ajax',
            method: "get",
            data: {
                ppn: true,
                po_id: po_id
            },
            success: function (response) {
                console.log(response);
                $('#invoiceppn').html(response.ppn);
            },
        });
        $.ajax({
            url: '/invoices/po/calculation/ppn/ajax',
            method: "get",
            data: {
                ppn: true,
                po_id: po_id
            },
            success: function (response) {
                console.log(response);
                $('#invoiceppn').html(response.ppn);
            },
        });
    }else{
        $('#invoiceppn').html('Rp. 0,00');
    }
})

