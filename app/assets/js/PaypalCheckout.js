const stripe = Stripe("pk_test_51K444KSDyd8jioSTlcaX9034Z1RFjSEBzMr42g2MR8JD19e2pXBOeXsbxlLY2631cdVRdnMUrG3xfZ6vzrENqbmx000jUbT4yx");



let elements, id, amount, clientSecretKey;


initialize();

if (document.getElementsByName('payment-form').length > 0 && document.getElementsByName('productId').length > 0) {
    document.querySelector("#payment-form").addEventListener("submit", handleSubmit);
}

async function initialize() {
    let url = baseUrl + '/Checkout/initialise';
    const {
        clientSecret
    } = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            id: document.getElementById('productId').value,
        }),
    }).then((r) => r.json());

    elements = stripe.elements({
        clientSecret
    });
    clientSecretKey = clientSecret;
    const paymentElement = elements.create("payment");
    paymentElement.mount("#payment-element");
}


async function handleSubmit(e) {

    e.preventDefault();

    setLoading(true);

    placeOrder();

    let url = baseUrl + '/checkout/successPaymentURL';
    const {
        error
    } = await stripe.confirmPayment({

        elements,

        confirmParams: {
            return_url: url,
            payment_method_data: {
                billing_details: {
                    name: document.getElementById('billName').value,
                    email: document.getElementById('email').value,
                    address: {
                        city: document.getElementById('billCity').value,
                        country: "IN",
                        line1: document.getElementById('billLine1').value,
                        line2: document.getElementById('billLine2').value,
                        postal_code: document.getElementById('billPostalCode').value,
                        state: document.getElementById('billState').value,
                    },
                },

            },
            shipping: {
                name: document.querySelector("#shippingName").value,
                phone: document.querySelector("#shipPhone").value,
                address: {
                    line1: document.querySelector("#shippingLine1").value,
                    line2: document.querySelector("#shippingLine2").value,
                    city: document.querySelector("#shippingCity").value,
                    postal_code: parseInt(document.querySelector("#shippingPostalCode")),
                    state: document.querySelector("#shippingState").value,
                    country: document.querySelector("#shippingCountry").value,
                },
            },

        },

    });

    if (error.type === "card_error" || error.type === "validation_error") {
        showMessage(error.message);
    } else {
        showMessage("An unexpected error occured.");
    }
    setLoading(false);
}



async function placeOrder() {
    let url = baseUrl + '/ProductOrder/placeOrder';
    const {
        orderStatus
    } = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            productId: document.getElementById('productId').value,
            email: document.querySelector("#email").value,
            shipName: document.querySelector("#shippingName").value,
            shipPhone: document.querySelector("#shipPhone").value,
            shipLine1: document.querySelector("#shippingLine1").value,
            shipLine2: document.querySelector("#shippingLine2").value,
            shipCity: document.querySelector("#shippingCity").value,
            shipState: document.querySelector("#shippingState").value,
            shipPostalCode: document.querySelector("#shippingPostalCode").value,
            shipCountry: document.querySelector("#shippingCountry").value,
            billName: document.querySelector("#billName").value,
            billLine1: document.getElementById('billLine1').value,
            billLine2: document.getElementById('billLine2').value,
            billCity: document.getElementById('billCity').value,
            billPostalCode: document.getElementById('billPostalCode').value,
            billState: document.getElementById('billState').value,
            billCountry: document.getElementById('billCountry').value,
            clientSecretKey: clientSecretKey
        }),

    }).then((r) => r.json());
}



function showMessage(messageText) {
    const messageContainer = document.querySelector("#payment-message");
    messageContainer.classList.remove("hidden");
    messageContainer.textContent = messageText;
    setTimeout(function () {
        messageContainer.classList.add("hidden");
        messageText.textContent = "";
    }, 6000);

}

function setLoading(isLoading) {
    if (isLoading) {
        document.querySelector("#submit").disabled = true;
        document.querySelector("#spinner").classList.remove("hidden");
        document.querySelector("#button-text").classList.add("hidden");

    } else {
        document.querySelector("#submit").disabled = false;
        document.querySelector("#spinner").classList.add("hidden");
        document.querySelector("#button-text").classList.remove("hidden");
    }
}
