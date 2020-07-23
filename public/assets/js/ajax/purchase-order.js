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

//=================================================
/** Backup form ke temp table dlu **/
//=================================================
$("#search-product").click(function () {
    var po_id_romawi, po_id_year, discount, discount_type, note, po_date, payment_term, contact_person, request, delivery_date, delivery_point, ppn, po_maker, po_approver;

    po_id_romawi = $('#inputPurchasePoIdCreateRomawi').val();
    po_id_year = $('#inputPurchasePoIdCreateYear').val();
    po_date = $("#po-date").val();
    supplier = $("#purchaseNewSupplier").val();
    discount = $("#purchaseOrderDiscount").val();
    discount_type = $("#purchaseOrderDiscountType").val();
    note = $("#note").val();
    po_date = $('#po-date').val();
    payment_term = $('#purchaseNewPaymentTerm').val(),
    contact_person = $('#purchaseNewContactPerson').val(),
    request = $('#purchaseNewRequest').val(),
    delivery_date = $('#purchaseNewDeliveryDate').val(),
    delivery_point = $('#purchaseNewDeliveryPoint').val();
    po_maker = $('#purchase_po_yang_membuat').val(),
    po_approver = $('#purchase_po_yang_menyetujui').val();
    
    if ($('#purchaseCreatePPN').prop('checked')) {
        ppn = true;
    }else{
        ppn = false;
    }

    $.ajax({
        url: '/purchaseorders/temp/store',
        method: "post",
        data: {
            po_id_romawi: po_id_romawi,
            po_id_year: po_id_year,
            po_date: po_date,
            supplier: supplier,
            discount: discount,
            type: discount_type,
            note: note,
            payment_term : payment_term,
            contact_person : contact_person,
            request : request,
            delivery_date : delivery_date,
            delivery_point : delivery_point,
            ppn : ppn,
            po_maker : po_maker,
            po_approver : po_approver
        },
        success: function (response) {},
    });
});

//=================================================
/** Search product po untuk bikin po **/
//=================================================
var poProductCreate;
$("#inputPoSearchProductCreate").on("keyup", function () {
    clearTimeout(poProductCreate);
    poProductCreate = setTimeout(function () {
        searchPo();
    }, 500);
});
$("#inputPoSearchProductCreate").on("keydown", function () {
    clearTimeout(poProductCreate);
});

//check Po id tersedia atau tidak
function searchPo() {
    $('#po-search-loading-bar').removeClass('d-none');
    var keywords = $("#inputPoSearchProductCreate").val();
    $.ajax({
        url: "/purchaseorders/search/product",
        method: "post",
        data: {
            keywords: keywords,
        },
        success: function (response) {
            $("#poSearchProductResultTableBody").html(response);
            $(".poProductItemChoose").click(function () {
                var prod_id = $(this).attr("prod-id");
                chooseProduct(prod_id);
            });
        },complete : function(){
            $('#po-search-loading-bar').addClass('d-none');
        }
    });
}

//=================================================
/** Choose Product Save **/
//=================================================
function chooseProduct(prod_id) {
    $.ajax({
        url: "/purchaseorders/temp/detail/" + prod_id,
        method: "post",
        success: function (response) {
            if (response.status == 'ok') {
                location.reload();                
            }
        },
    });
}

//=================================================
/** Update Product **/
//=================================================
$(".poDetailUpdate").click(function () {
    var product_id = $(this).attr('dm-data');
    $.ajax({
        url: '/purchaseorders/detail/' + product_id + '/ajax',
        method: "get",
        success: function (response) {
            $('#editDetailProductId').val(response.tempDetailPo.product_id);
            $('#editDetailUnit').val(response.tempDetailPo.unit);
            $('#editDetailUnitPrice').val(response.tempDetailPo.unit_price)
            $('#editDetailDiscount').val(response.tempDetailPo.discount);
            $('#editDetailQty').val(response.tempDetailPo.qty);
        },
    });
});

//=================================================
/** Kalkulasi ketika kolom discount di ketik **/
//=================================================
var purchaseDiscountTypingTimer;
$("#purchaseOrderDiscount").on('keyup', function () {
    clearTimeout(purchaseDiscountTypingTimer)
    purchaseDiscountTypingTimer = setTimeout(purchasePoCalcTotal, 200)
});
$("purchaseOrderDiscount").on('keydown', function () {
    clearTimeout(purchaseDiscountTypingTimer);
})


//=================================================
/** Kalkulasi ketika discount type berubah **/
//=================================================
$("#purchaseOrderDiscountType").on("change", function () {
    purchasePoCalcTotal();
    if (!$(this).val()) {
        $('#purchaseOrderDiscount').val('')
    }
});

//=================================================
/** Kalkulasi total info **/
//=================================================
function purchasePoCalcTotal(ppn = false, discount, discount_type) {
    var discount = $('#purchaseOrderDiscount').val();
    var discount_type = $('#purchaseOrderDiscountType').val();
    if ($('#purchaseCreatePPN').prop('checked') == true) {
        ppn = true
    }
    $.ajax({
        url: "/purchaseorders/po/calculation/total/ajax",
        method: "get",
        data: {
            ppn: ppn,
            discount: discount,
            discount_type: discount_type
        },
        success: function (response) {
            $("#purchaseOrderSubTotalHarga").html(response.subTotalPrice);
            $("#purchaseOrderPpn").html(response.ppn);
            $("#purchaseOrderTotalHarga").html(response.poTotalPrice);
        },
    });
}

purchasePoCalcTotal();

//=================================================
/** PPN Switch **/
//=================================================
$('#purchaseCreatePPN').click(function () {
    if ($(this).prop('checked') == true) {
        purchasePoCalcTotal(true);
    } else {
        purchasePoCalcTotal();
    }
})
