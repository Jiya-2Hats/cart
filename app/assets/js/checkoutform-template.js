$(document).ready(function (e) {
    // $('#Field-countryInput').on('change', function (e) {
    //     alert('gg');
    //     alert($(this).find('option:selected').text());
    // });

    // need to solve this issue created for testing purpose
    $('#billCountry').val("India");

});


if (document.getElementsByName('shippingAddress').length > 0) {

    document.querySelector('#shippingAddress').addEventListener('change', toggleShippingAddress);
}

function toggleShippingAddress() {
    if (document.querySelector('#shippingAddress').checked) {

        document.querySelector("#shipping_name").value = document.querySelector("#billName").value;
        document.querySelector("#shippingLine1").value = document.querySelector("#billLine1").value;
        document.querySelector("#shippingLine2").value = document.querySelector("#billLine2").value;
        document.querySelector("#shippingCity").value = document.querySelector("#billCity").value;
        document.querySelector("#shippingPostalCode").value = document.querySelector("#billPostalCode").value;
        document.querySelector("#shippingState").value = document.querySelector("#billState").value;
        document.querySelector("#shippingCountry").value = document.querySelector("#billCountry").value;
        document.querySelector("#shippingAddressDiv").classList.add("hidden");


    } else {
        document.querySelector("#shippingLine1").value = "";
        document.querySelector("#shippingLine2").value = "";
        document.querySelector("#shippingCity").value = "";
        document.querySelector("#shippingPostalCode").value = "";
        document.querySelector("#shippingState").value = "";
        document.querySelector("#shippingCountry").value = "";
        document.querySelector("#shippingAddressDiv").classList.remove("hidden");
    }
}
