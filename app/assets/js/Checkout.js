     // This is your test publishable API key.

     const stripe = Stripe("pk_test_51K444KSDyd8jioSTlcaX9034Z1RFjSEBzMr42g2MR8JD19e2pXBOeXsbxlLY2631cdVRdnMUrG3xfZ6vzrENqbmx000jUbT4yx");
     const baseUrl = 'http://localhost/cart';

     // The items the customer wants to buy

     let elements, id, amount, clientSecretKey;


     initialize();

     checkStatus();


     if (document.getElementsByName('payment-form').length > 0 && document.getElementsByName('productId').length > 0) {
         document.querySelector("#payment-form").addEventListener("submit", handleSubmit);

     }


     // Fetches a payment intent and captures the client secret



     async function initialize() {

         let url = baseUrl + '/CreatePaymentIntent';

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
         //  console.log("ff" + orderStatus);
         let url = baseUrl + '/Checkout/checkoutSuccess';
         const {
             error
         } = await stripe.confirmPayment({

             elements,

             confirmParams: {

                 // Make sure to change this to your payment completion page

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

         //  setOrderStatus(1);

         setLoading(false);

     }



     async function placeOrder() {
         let url = baseUrl + '/checkout/productOrder';
         const {
             orderStatus
         } = await fetch(url, {

             method: "POST",

             headers: {
                 "Content-Type": "application/json"
             },

             body: JSON.stringify({
                 productId: document.getElementById('productId').value,
                 shipName: document.querySelector("#shippingName").value,
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


     //  async function setOrderStatus($statusId) {
     //      const {
     //          orderStatus
     //      } = await fetch("http://localhost/e-cart/orderFailed.php", {

     //          method: "POST",

     //          headers: {
     //              "Content-Type": "application/json"
     //          },

     //          body: JSON.stringify({
     //              orderStatus: statusId
     //          }),

     //      }).then((r) => r.json());
     //  }
     // Fetches the payment intent status after payment submission

     async function checkStatus() {

         const clientSecret = new URLSearchParams(window.location.search).get(

             "payment_intent_client_secret"

         );


         if (!clientSecret) {

             return;

         }


         const {
             paymentIntent
         } = await stripe.retrievePaymentIntent(clientSecret);


         switch (paymentIntent.status) {

             case "succeeded":



                 showMessage("Payment succeeded!");






                 break;

             case "processing":

                 showMessage("Your payment is processing.");

                 break;

             case "requires_payment_method":

                 showMessage("Your payment was not successful, please try again.");

                 break;

             default:

                 showMessage("Something went wrong.");

                 break;

         }

     }


     // ------- UI helpers -------


     function showMessage(messageText) {


         const messageContainer = document.querySelector("#payment-message");


         messageContainer.classList.remove("hidden");

         messageContainer.textContent = messageText;


         setTimeout(function () {

             messageContainer.classList.add("hidden");

             messageText.textContent = "";

         }, 6000);

     }


     // Show a spinner on payment submission

     function setLoading(isLoading) {

         if (isLoading) {

             // Disable the button and show a spinner

             document.querySelector("#submit").disabled = true;

             document.querySelector("#spinner").classList.remove("hidden");

             document.querySelector("#button-text").classList.add("hidden");

         } else {

             document.querySelector("#submit").disabled = false;

             document.querySelector("#spinner").classList.add("hidden");

             document.querySelector("#button-text").classList.remove("hidden");

         }

     }
