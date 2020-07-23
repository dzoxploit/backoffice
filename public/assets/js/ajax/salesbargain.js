//=================================================
/** PO ID on type searching Save **/
//=================================================
var saveTypingTimer;
$("#bargainProductSearchSave").on("keyup", function () {
    clearTimeout(saveTypingTimer);
    saveTypingTimer = setTimeout(function () {
        getSaveProductData();
    }, 500);
});
$("#bargainProductSearchSave").on("keydown", function () {
    clearTimeout(saveTypingTimer);
});

//check Po id tersedia atau tidak
function getSaveProductData() {
    var query = $("#bargainProductSearchSave").val();
    $.ajax({
        url: "/sales/bargains/product/save/ajax",
        method: "post",
        data: {
            query: query,
        },
        success: function (response) {
            $("#searchProductTableBody").html(response);
            $(".chooseProductIdSave").click(function () {
                var prod_id = $(this).attr("prod-id");
                chooseSaveProductData(prod_id);
            });
        },
    });
}

//=================================================
/** Choose Product Save **/
//=================================================

function chooseSaveProductData(prod_id) {
    $.ajax({
        url: "/sales/bargains/temp/detail/" + prod_id,
        method: "post",
        success: function (response) {
            console.log(response);
            location.reload();
        },
    });
}

//=================================================
/** Button Add Product Edit **/
//=================================================

$("#addProductEdit").click(function () {
    var bargain_id = window.location.href.split("/")[5];
    var discount = $("#inputEditBargainDiscount").val();
    var discount_type = $("#inputEditBargainDiscountType").val();
    var bargain_note = $("#inputEditbargainNote").val();
    $.ajax({
        url: "/sales/bargains/temp/edit",
        method: "post",
        data: {
            bargain_id: bargain_id,
            discount: discount,
            discount_type: discount_type,
            bargain_note: bargain_note,
        },
        success: function (response) {
            console.log(response);
        },
    });
});

//=================================================
/** search product on type searching Edit**/
//=================================================
var typingTimerEdit;
$("#bargainProductSearch").on("keyup", function () {
    clearTimeout(typingTimerEdit);
    typingTimerEdit = setTimeout(function () {
        getProductDataEdit();
    }, 200);
});
$("#bargainProductSearch").on("keydown", function () {
    clearTimeout(typingTimerEdit);
});

function getProductDataEdit(query) {
    var query;
    query = $("#bargainProductSearch").val();
    $.ajax({
        url: "/sales/bargains/product/edit/ajax",
        method: "post",
        data: {
            query: query,
        },
        success: function (response) {
            $("#searchProductTableBody").html(response);
            //klik button product id di halaman edit
            $(".chooseProductIdEdit").click(function () {
                var prod_id = $(this).attr("prod-id");
                chooseProductEdit(prod_id);
            });
        },
    });
}
//=================================================
/** Choose Product di halaman edit **/
//=================================================

function chooseProductEdit(prod_id) {
    $.ajax({
        url: "/sales/bargains/temp/detail/" + prod_id + '/edit',
        method: "post",
        success: function (response) {
            console.log(response);
            location.reload();
        },
    });
}

//=================================================
/** Add Product Button new **/
//=================================================
$("#bargainNewAddProduct").click(function () {
    var bargain_id_romawi, bargain_id_year, customer_id, discount, bargain_expr, discount_type;
 
    bargain_id_romawi = $('#inputBargainBargainIdCreateRomawi').val();
    bargain_id_year = $('#inputBargainBargainIdCreateYear').val()
    customer_id = $("#inputBargainCustomerId").val();
    discount = $("#inputBargainDiscountSave").val();
    discount_type = $("#inputBargainTypeDiscountSave").val();
    bargain_expr = $("#inputBargainExpr").val();
    bargain_note = $("#inputbargainNote").val();

    $.ajax({
        url: "/sales/bargains/temp/store",
        method: "post",
        data: {
            bargain_id_romawi: bargain_id_romawi,
            bargain_id_year : bargain_id_year,
            customer_id: customer_id,
            discount: discount,
            discount_type: discount_type,
            bargain_expr: bargain_expr,
            bargain_note: bargain_note,
        },
        success: function (response) {},
    });
});

//=================================================
/** Save Penawaran **/
//=================================================
$("#saveBargainCustomer").click(function () {
    var customer_id, discount, type, bargain_expr, bargain_note, bargain_id_romawi, bargain_id_year;

    bargain_id_romawi = $('#inputBargainBargainIdCreateRomawi').val();
    bargain_id_year = $('#inputBargainBargainIdCreateYear').val()
    customer_id = $("#inputBargainCustomerId").val();
    discount = $("#inputBargainDiscountSave").val();
    type = $("#inputBargainTypeDiscountSave").val();
    bargain_note = $("#note").val();
    bargain_expr = $("#inputBargainExpr").val();
    bargain_note = $("#inputbargainNote").val();

    $.ajax({
        url: "/sales/bargains/new",
        method: "post",
        data: {
            bargain_id_romawi: bargain_id_romawi,
            bargain_id_year : bargain_id_year,
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

//=================================================
/** Save Edit Penawaran **/
//=================================================
$("#saveEditBargainCustomer").click(function () {
    var bargain_id = window.location.href.split("/")[5];
    var discount = $("#inputEditBargainDiscount").val();
    var discount_type = $("#inputEditBargainDiscountType").val();
    var bargain_note = $("#inputEditbargainNote").val();

    $.ajax({
        url: "/sales/bargains/" + bargain_id,
        method: "patch",
        data: {
            bargain_id: bargain_id,
            discount: discount,
            discount_type: discount_type,
            bargain_note: bargain_note,
        },
        success: function (response) {
            if (response.status == 'ok') {
                window.location = '/sales/bargains'
            }
            
        },
    });
});

//=================================================
/** Button Edit Halaman Edit **/
//=================================================
$(".salesBargainDetailEdit").click(function () {

    var product_id = $(this).attr('dm-data');

    console.log(product_id);
    $.ajax({
        url: '/sales/bargains/detail/' + product_id + '/ajax',
        method: "get",
        data : {
            actiontype : 'edit',
        },
        success: function (response) {
            console.log(response);
            $('#editBargainDetailProdId').val(response.detailData.product_id);
            $('#editBargainDetailBargainPrice').val(response.detailData.bargain_price);
            $('#editBargainDetailQty').val(response.detailData.qty);
        },
    });
});

//=================================================
/** Button Edit Halaman Create **/
//=================================================
$(".salesBargainDetailCreate").click(function () {

    var product_id = $(this).attr('dm-data');

    $.ajax({
        url: '/sales/bargains/detail/' + product_id + '/ajax',
        method: "get",
        data : {
            actiontype : 'save',
        },
        success: function (response) {
            console.log(response);
            $('#editBargainDetailProdIdCreate').val(response.detailData.product_id);
            $('#editBargainDetailBargainPriceCreate').val(response.detailData.bargain_price);
            $('#editBargainDetailQtyCreate').val(response.detailData.qty);
            $('#editBargainUnitPrice').val(response.detailData.unit_price);
        },
    });
});

