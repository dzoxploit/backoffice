// save button
$("#savePurchaseOrder").click(function () {
    var po_num, supplier, discount, type, note, date;

    date = $("#po-date").val();
    supplier = $("#supplier-option").val();
    discount = $("#purchaseOrderDiscount").val();
    type = $("#purchaseOrderDiscountType").val();
    note = $("#note").val();
    po_num = $("#po-num").val();
    date = $('#po-date').val();

    $.ajax({
        url: '/purchaseorders/new',
        method: "post",
        data: {
            po_id: po_num,
            sup_id: supplier,
            discount: discount,
            type: type,
            date: date,
            note: note,
        },
        success: function (response) {
            window.location = "/purchaseorders";
        },
    });
});

//Search Button
$("#search-product").click(function () {
    var po_num, supplier, discount, type, note, date;

    date = $("#po-date").val();
    supplier = $("#supplier-option").val();
    discount = $("#purchaseOrderDiscount").val();
    type = $("#purchaseOrderDiscountType").val();
    note = $("#note").val();
    po_num = $("#po-num").val();
    date = $('#po-date').val();

    console.log(discount);

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

//Update Button
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

// Total Info
function purchaseOrderCalcSubTotal() {
    $.ajax({
        url: '/purchaseorders/detail/calculation/ajax',
        method: "get",
        success: function (response) {
            $('#purchaseOrderSubTotalHarga').html(response.subTotalPrice);
        },
    });
}
purchaseOrderCalcSubTotal();

 /** Check setelah typing berhenti beberapa saat **/
 var purchaseDiscountTypingTimer;
 $("#purchaseOrderDiscount").on('keyup', function () {
     clearTimeout(purchaseDiscountTypingTimer)
     purchaseDiscountTypingTimer = setTimeout(purchaseOrderCalcTotal, 500)
 });
 $("purchaseOrderDiscount").on('keydown', function () {
     clearTimeout(purchaseDiscountTypingTimer);
 })
 function purchaseOrderCalcTotal() {
    var discount = $('#purchaseOrderDiscount').val(); 
    var discount_type = $('#purchaseOrderDiscountType').val();
    $.ajax({
        url: '/purchaseorders/detail/calculation/discount/ajax',
        method: "get",
        data: {
            discount : discount,
            discount_type : discount_type
        },
        success: function (response) {
            $('#purchaseOrderTotalHarga').html(response.totalPrice);
        },
    });
}
purchaseOrderCalcTotal();