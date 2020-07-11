$("#purchaseOrderProductSearchProduct").click(function () {
    var customer_id, po_discount, po_discount_type, po_id, po_num, id_penawaran, po_note;

    po_id = $("#inputPurchaseOrderCustomerPoId").val();
    po_num = $("#inputPurchaseOrderCustomerPoNum").val();
    id_penawaran = $("#inputPurchaseOrderCustomerIdPenawaran").val();
    customer_id = $("#inputPurchaseOrderCustomerId").val();
    po_discount = $("#inputPurchaseOrderCustomerPoDiscount").val();
    po_discount_type = $("#inputPurchaseOrderCustomerDiscountType").val();
    po_note = $("#inputPurchaseOrderCustomerNote").val();

    $.ajax({
        url: '/sales/purchaseorders/temp/store',
        method: "post",
        data: {
            po_id: po_id,
            po_num: po_num,
            id_penawaran: id_penawaran,
            customer_id: customer_id,
            po_note: po_note,
            po_discount: po_discount,
            po_discount_type: po_discount_type
        },
        success: function (response) {
            if (response.message == 'data_inserted' || 'data_not_inserted') {
                window.location = "/sales/purchaseorders/product";
            } else {
                console.log('Error,' + response);
            }
        },
    });
});