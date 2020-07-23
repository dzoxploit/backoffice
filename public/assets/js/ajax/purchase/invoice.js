//=================================================
/** PO ID on type searching **/
//=================================================
var typingTimer;
$("#inputCreateInvoicePoId").on('keyup', function () {
    clearTimeout(typingTimer)
    typingTimer = setTimeout(function () {
        checkInvoicePoId();
        invoicePurchaseCalcTotal();
    }, 500)
});
$("#inputCreateInvoicePoId").on('keydown', function () {
    clearTimeout(typingTimer);
})
//=================================================
/** check Po id tersedia atau tidak **/
//=================================================
function checkInvoicePoId() {
    var po_id;
    po_id = $('#inputCreateInvoicePoId').val();

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

//=================================================
/** Calculation Total info **/
//=================================================
function invoicePurchaseCalcTotal(ppn = false) {
    if ($('#ppnswitch').prop('checked') == true) {
        ppn = true
    }
    $.ajax({
        url: "/invoices/invoice/calculation/total/ajax",
        method: "get",
        data: {
            po_id: $('#inputCreateInvoicePoId').val(),
            ppn: ppn,
        },
        success: function (response) {
            $("#poTotal").html(response.subTotal);
            $("#invoiceppn").html(response.ppn);
            $("#invoiceTotalPrice").html(response.invoiceTotal);
        },
    });
}

//=================================================
/** PPN Switch **/
//=================================================
$('#ppnswitch').click(function () {
    if ($(this).prop('checked') == true) {
        invoicePurchaseCalcTotal(true);
    } else {
        invoicePurchaseCalcTotal();
    }
})

// // Get Calculated PO Total
// function invoiceGetPoTotal() {
//     var po_id;
//     po_id = $('#inputCreateInvoicePoId').val();
//     $.ajax({
//         url: '/invoices/po/calculation/discount/ajax',
//         method: "get",
//         data: {
//             po_id: po_id
//         },
//         success: function (response) {
//             $('#invoiceTotal').html(response.totalPrice);
//             $('#ppnswitch').attr('checked', false);
//             $('#invoiceTotalPrice').html(response.totalPrice);
//         },
//     });
// }

// // get invoice total
// function getInvoiceTotal(ppn_status = false) {
//     var po_id = $('#inputCreateInvoicePoId').val();
//     $.ajax({
//         url: '/invoices/invoice/calculation/total/ajax',
//         method: "get",
//         data: {
//             ppn: ppn_status,
//             po_id: po_id
//         },
//         success: function (response) {
//             $('#invoiceppn').html(response.ppn);
//             $('#invoiceTotalPrice').html(response.invoiceTotal);
//         },
//     });
// }


//=================================================
/** Invoice Save **/
//=================================================
$('#savePurchaseInvoice').click(function () {
    var po_id = $('#inputCreateInvoicePoId').val(),
        due_date = $('#inputCreateInvoiceDueDate').val(),
        no_invoice = $('#inputCreateInvoiceNum').val(),
        note = $('#inputCreateInvoiceNote').val();
    $.ajax({
        url: '/invoices/new',
        method: "post",
        data: {
            po_id: po_id,
            due_date: due_date,
            no_invoice: no_invoice,
            note: note,
        },

        success: function (response) {
            console.log(response);
            window.location = '/invoices'
        },
    });
})
