$(document).ready(function (e) {

    $('[id^="adminEditOrder-"]').on('click', function (e) {

        var id = $(this).attr("id");
        id = id.split('-');
        id = id[1];
        var url = window.location.href;


        $.ajax({
            type: "POST",
            url: url + "/editOrder",

            data: JSON.stringify({
                id: id,
            }),
            success: function (result) {
                result = jQuery.parseJSON(result);
                console.log(result);
                result = result[0];
                $('#orderId').val(id);
                $('#email').val(result['email']);
                $('#shippingLine1').val(result['shipAddressLine1']);
                $('#shippingLine2').val(result['shipAddressLine2']);
                $('#shippingCity').val(result['shipCity']);
                $('#shippingState').val(result['shipState']);
                $('#shippingCountry').val(result['shipCountry']);
                $('#shippingPostalCode').val(result['shipPostalCode']);

            },
            error: function (result) {
                alert('error');
            }
        });
    });
});
