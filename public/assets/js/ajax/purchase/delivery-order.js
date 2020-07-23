//=================================================
/** add Product **/
//=================================================
$("#deliveryDoAddProduct").click(function () {
    var do_year, do_romawi, do_num, do_date, do_sender, do_receiver, do_deliveryman, do_note;

    do_romawi =  $('#inputDoCreateRomawi').val();
    do_year = $('#inputDoCreateYear').val();
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
            do_romawi: do_romawi,
            do_year: do_year,
            do_num: do_num,
            po_id: po_id,
            do_sender: do_sender,
            do_receiver: do_receiver,
            do_deliveryman: do_deliveryman,
            do_date: do_date,
            do_note: do_note
        },
        success: function (response) {
            console.log(response)
            if (response.message == 'data_inserted' || 'data_not_inserted') {
                window.location = "/deliveryorders/product";
            } else {
                console.log('Error,' + response);
            }

        },
    });
});

//=================================================
/** Search Po Id **/
//=================================================
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