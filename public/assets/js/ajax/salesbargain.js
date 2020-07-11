$("#bargainNewAddProduct").click(function () {
    var bargain_id, customer_id, discount, bargain_expr, discount_type;

    bargain_id = $("#inputBargainBargainId").val();
    customer_id = $("#inputBargainCustomerId").val();
    discount = $("#inputBargainDiscount").val();
    discount_type = $("#inputBargainDiscountType").val();
    bargain_expr = $("#inputBargainExpr").val();
    bargain_note = $("#inputbargainNote").val();

    console.log(discount_type);
    console.log(discount);
    $.ajax({
        url: '/sales/bargains/temp/store',
        method: "post",
        data: {
            bargain_id: bargain_id,
            customer_id: customer_id,
            discount: discount,
            discount_type: discount_type,
            bargain_expr: bargain_expr,
            bargain_note: bargain_note,
        },
        success: function (response) {
            if (response.message == 'data_inserted' || 'data_not_inserted') {
                window.location = "/sales/bargains/product";
            } else {
                console.log('Error,' + response);
            }
        },
    });
});

// Total Info
function bargainCustomerCalcSubTotal() {
    $.ajax({
        url: '/sales/bargains/detail/calculation/ajax',
        method: "get",
        success: function (response) {
            console.log(response);
            $('#bargainCustomerSubTotalHarga').html(response.subTotalPrice);
        },
    });
}
bargainCustomerCalcSubTotal();

 /** Check setelah typing berhenti beberapa saat **/
 var bargainCustomerTypingTimer;
 $("#inputBargainDiscount").on('keyup', function () {
     clearTimeout(bargainCustomerTypingTimer)
     bargainCustomerTypingTimer = setTimeout(bargainCustomerCalcTotal, 500)
 });
 $("inputBargainDiscount").on('keydown', function () {
     clearTimeout(bargainCustomerTypingTimer);
 })
 function bargainCustomerCalcTotal() {
    var discount = $('#inputBargainDiscount').val(); 
    var discount_type = $('#inputBargainDiscountType').val();
    $.ajax({
        url: '/sales/bargains/detail/calculation/discount/ajax',
        method: "get",
        data: {
            discount : discount,
            discount_type : discount_type
        },
        success: function (response) {
            console.log(response)
            $('#bargainCustomerTotalHarga').html(response.totalPrice);
        },
    });
}
bargainCustomerCalcTotal();

$("#saveBargainCustomer").click(function () {
    var bargain_id, customer_id, discount, type, bargain_expr, bargain_note;

    bargain_id = $("#inputBargainBargainId").val();
    customer_id = $("#inputBargainCustomerId").val();
    discount = $("#inputBargainDiscount").val();
    type = $("#inputBargainDiscountType").val();
    bargain_note = $("#note").val();
    bargain_expr = $("#inputBargainExpr").val();
    bargain_note = $('#inputbargainNote').val();

    $.ajax({
        url: '/sales/bargains/new',
        method: "post",
        data: {
            bargain_id: bargain_id,
            customer_id: customer_id,
            discount: discount,
            type: type,
            bargain_note: bargain_note,
            bargain_expr: bargain_expr,
            bargain_note: bargain_note,
        },
        success: function (response) {
            window.location = "/sales/bargains";
        },
    });
});
