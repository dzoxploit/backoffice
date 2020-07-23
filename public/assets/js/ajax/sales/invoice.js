//

$('#inputSalesInvoiceBillTo').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var customer_id = this.value;

    $.ajax({
        url: '/sales/invoices/invoice/shipto/ajax',
        method: "post",
        data: {
           customer_id : customer_id
        },
        success: function (response) {
            console.log(response);
            $('#inputSaleInvoiceShipTo').html(response);
            // window.location = '/invoices'
        },
    });
});
//=================================================
/** Invoice Save **/
//=================================================
$('#saveSalesInvoiceCreate').click(function () {
    var invoice_id = $('#inputSalesInvoiceInvoiceId').val()
        po_id = $('#inputSalesInvoiceCreatePoId').val(),
        customer_id = $('#inputSalesInvoiceCreateCustomer').val()
        due_date = $('#inputSalesInvoiceCreateDueDate').val(),
        subject = $('#inputSalesInvoiceCreateSubject').val(),
        note = $('#inputSalesInvoiceCreateNote').val(), 

    $.ajax({
        url: '/sales/invoices/new',
        method: "post",
        data: {
            invoice_id :invoice_id,
            po_id : po_id,
            customer_id  : customer_id,
            due_date : due_date,
            subject : subject, 
            note : note,
        },
        success: function (response) {
            console.log(response);
            // window.location = '/invoices'
        },
    });
})

//=================================================
/** Search PO for create PO id page **/
//=================================================
var poIdTypingTimer;
$("#inputSalesInvoicePoSearch").on("keyup", function () {
    clearTimeout(poIdTypingTimer);
    poIdTypingTimer = setTimeout(function () {
        searchSalesPo();
    }, 500);
});
$("#inputSalesInvoicePoSearch").on("keydown", function () {
    clearTimeout(poIdTypingTimer);
});

//check Po id tersedia atau tidak
function searchSalesPo() {
    var keywords = $("#inputSalesInvoicePoSearch").val();
    $.ajax({
        url: "/sales/invoices/search/po",
        method: "post",
        data: {
            keywords: keywords,
        },
        success: function (response) {
            $("#searchProductTableBody").html(response);
            // $(".chooseProductIdSave").click(function () {
            //     var prod_id = $(this).attr("prod-id");
            //     chooseSaveProductData(prod_id);
            // });
        },
    });
}

