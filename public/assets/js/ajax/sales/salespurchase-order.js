$("#purchaseOrderProductSearchProduct").click(function () {
    var customer_id, po_discount, po_discount_type, po_id, po_id_romawi, po_id_year, po_num, bargain_id, po_note;

    po_id_romawi = $('#inputSalesPoPoIdCreateRomawi').val()
    po_id_year = $('#inputSalesPoPoIdCreateYear').val()
    po_num = $("#inputSalesPoPoNumCreate").val();
    bargain_id = $("#inputSalesPoBargainIdCreate").val();
    customer_id = $("#inputSalesPoCustomerIdCreate").val();
    po_note = $("#inputSalesPoNoteCreate").val();
    po_discount = $('#salesPurchaseOrderDiscount').val();
    po_discount_type = $('#salesPurchaseOrderDiscountType').val();
    

    $.ajax({
        url: '/sales/purchaseorders/temp/store',
        method: "post",
        data: {
            po_id_romawi,
            po_id_year,
            po_num: po_num,
            bargain_id: bargain_id,
            customer_id: customer_id,
            po_note: po_note,
            po_discount: po_discount,
            po_discount_type: po_discount_type
        },
        success: function (response) {
           
        },
    });
});

//=================================================
/** Hanya Cek Kalo valid **/
//=================================================
function bargainIdJustValidationCheck(){
    bargain_id = $("#inputSalesPoBargainIdCreate").val();

    $.ajax({
        url: '/sales/purchaseorders/justcheck/ajax',
        method: "post",
        data: {
            bargain_id: bargain_id,
        },
        success: function (response) {
            $('#salesPoBargainIdCheck').html(response.message);
        },
    });   
}
bargainIdJustValidationCheck();

//=================================================
/** Update Detail Temporary **/
//=================================================
$(".customerPoDetailEdit").click(function () {

    var product_id = $(this).attr('dm-data');

    $.ajax({
        url: '/sales/purchaseorders/detail/' + product_id + '/ajax',
        method: "get",
        success: function (response) {
            console.log(response);
            $('#salesPoEditProductIdCustomer').val(response.detailData.product_id);
            $('#salesPoEditDetailCustomerUnitPrice').val(response.detailData.unit_price);
            $('#salesPoEditDetailCustomerQty').val(response.detailData.qty);
        },
    });
});

//=================================================
/** Search Bargain ID **/
//=================================================
var salesPoBargainIdType;
$("#inputSalesPoBargainIdCreate").on("keyup", function () {
    clearTimeout(salesPoBargainIdType);
    salesPoBargainIdType = setTimeout(function () {
        searchBargainId();
    }, 500);
});
$("#inputSalesPoBargainIdCreate").on("keydown", function () {
    clearTimeout(salesPoBargainIdType);
});

//check Po id tersedia atau tidak
function searchBargainId() {
    var customer_id, po_discount, po_discount_type, po_num, bargain_id, po_note,po_id_romawi, po_id_year, po_image;

    po_id_romawi = $('#inputSalesPoPoIdCreateRomawi').val()
    po_id_year = $('#inputSalesPoPoIdCreateYear').val()
    po_num = $("#inputSalesPoPoNumCreate").val();
    bargain_id = $("#inputSalesPoBargainIdCreate").val();
    customer_id = $("#inputSalesPoCustomerIdCreate").val();
    po_note = $("#inputSalesPoNoteCreate").val();
    po_discount = $('#salesPurchaseOrderDiscount').val();
    po_discount_type = $('#salesPurchaseOrderDiscountType').val();
    po_attachment = $('#salesPoCustomerImage').val();

    $.ajax({
        url: '/sales/purchaseorders/check/ajax',
        method: "post",
        data: {
            po_id_romawi : po_id_romawi,
            po_id_year : po_id_year,
            po_num: po_num,
            bargain_id: bargain_id,
            customer_id: customer_id,
            po_note: po_note,
            po_discount: po_discount,
            po_discount_type: po_discount_type,
        },
        success: function (response) {
            if (response.msg_status == 'bargain_not_valid_with_run_query') {
                location.reload();
            }else if(response.msg_status == 'bargain_is_valid'){
                $('#salesPoBargainIdCheck').html(response.message);
                location.reload();
            }
        },
    });
}

//=================================================
/** Search product sales po for create **/
//=================================================
var salesPoProductCreate;
$("#inputSalesPoSearchProductCreate").on("keyup", function () {
    clearTimeout(salesPoProductCreate);
    salesPoProductCreate = setTimeout(function () {
        searchSalesPo();
    }, 500);
});
$("#inputSalesPoSearchProductCreate").on("keydown", function () {
    clearTimeout(salesPoProductCreate);
});

//check Po id tersedia atau tidak
function searchSalesPo() {
    var keywords = $("#inputSalesPoSearchProductCreate").val();
    $.ajax({
        url: "/sales/purchaseorders/search/product",
        method: "post",
        data: {
            keywords: keywords,
        },
        success: function (response) {
            $("#salesPoSearchProductResultTableBody").html(response);
            $(".salesPoProductItemChoose").click(function () {
                var prod_id = $(this).attr("prod-id");
                chooseSalesProduct(prod_id);
            });
        },
    });
}

//=================================================
/** Choose Product Save **/
//=================================================
function chooseSalesProduct(prod_id) {
    $.ajax({
        url: "/sales/purchaseorders/temp/detail/" + prod_id,
        method: "post",
        success: function (response) {
            if (response.status == 'ok') {
                location.reload();                
            }
        },
    });
}