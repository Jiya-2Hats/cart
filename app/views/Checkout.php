<?php



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/app/assets/css/style.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/app/assets/css/checkout.css" />
    <script src="https://js.stripe.com/v3/"></script>

</head>

<body class="py-5">

    <div class="container ">
        <?php if (!empty($data['productData'])) {
            $productData = $data['productData']; ?>
            <div class="row py-5 mt-5">
                <div class=" col-sm-3 card productdiv ">
                    <img src="<?= BASE_URL ?>/app/assets/images/default_product1.png" class="mb-3" alt="Product Image" style="width:80%">

                    <div class="px-4">
                        <h4><?= $productData[0]['name'] ?> </h4>
                        <p class="price" id="amount">Rs <?= $productData[0]['amount'] ?> </p>
                        <p><?= $productData[0]['description'] ?> </p>

                    </div>
                    <span class="py-2 px-4"> <a href="<?= BASE_URL ?>/dashboard">Continue Shopping</a></span>
                </div>
                <div class="col-sm-9 ">
                    <form class="col-sm-12 d-flex" id="payment-form" name="payment-form">

                        <div class="col-sm-6 px-4">
                            <div class="col-sm-12 mb-2">
                                <label for="email">Email </label>
                                <input type="email" name="email" id="email" class="inputfield py-2 px-2 Input col-sm-12" required value="<?= (isset($_SESSION['email']) ? $_SESSION['email'] : "") ?>">
                            </div>

                            <div class="col-sm-12 mb-2 ">
                                <label for="billLine1">Billing Address </label>
                                <input type="text" name="billLine1" id="billLine1" placeholder="Address" class="inputfield py-2 px-2 Input col-sm-12" required value="<?= (isset($_SESSION['address_line1']) ? $_SESSION['address_line1'] : "") ?>">
                                <input type="text" name="billLine2" id="billLine2" placeholder="Landmark" class="inputfield py-2 mt-2 px-2 Input col-sm-12" required value="<?= (isset($_SESSION['address_line2']) ? $_SESSION['address_line2'] : "") ?>">

                            </div>

                            <div class="col-sm-12 mb-2">
                                <div class="row">
                                    <div class="col-sm-6 mb-2 pr-1">
                                        <label for="billCity">City </label>
                                        <input type="text" name="billCity" id="billCity" placeholder="City" class="inputfield py-2 px-2 Input col-sm-12" required value="<?= (isset($_SESSION['city']) ? $_SESSION['city'] : "") ?>">
                                        <input type="hidden" name="billCountry" id="billCountry" placeholder="Country">
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <label for="billPostalCode">Postal Code </label>
                                        <input type="text" name="billPostalCode" placeholder="Postal Code" id="billPostalCode" class="inputfield py-2 px-2 Input col-sm-12" required value="<?= (isset($_SESSION['postal_code']) ? $_SESSION['postal_code'] : "") ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">

                                <label for="billState">State </label>
                                <input type="text" name="billState" placeholder="State" id="billState" class="inputfield py-2 px-2 Input col-sm-12" required value="<?= (isset($_SESSION['state']) ? $_SESSION['state'] : "") ?>">

                            </div>
                            <div class="col-sm-12 pt-4">

                                <label for="shippingAddress">Same as Billing Address </label>
                                <input type="checkbox" name="shippingAddress" id="shippingAddress">
                            </div>
                            <div class="col-sm-12 mt-2" id="shippingAddressDiv">
                                <label for="shippingLine1">Shipping Address </label>
                                <div class="col-sm-12 mb-2 ">
                                    <input type="text" name="shippingName" id="shippingName" placeholder="Name of the person" class="inputfield py-2 px-2 Input col-sm-12" required>
                                    <input type="text" name="shippingLine1" id="shippingLine1" placeholder="Address" class="inputfield py-2 mt-2 px-2 Input col-sm-12" required>
                                    <input type="text" name="shippingLine2" id="shippingLine2" placeholder="Landmark" class="inputfield py-2 mt-2 px-2 Input col-sm-12" required>

                                </div>

                                <div class="col-sm-12 mb-2 ">
                                    <div class="row">
                                        <div class="col-sm-6 mb-2 pr-1">
                                            <label for="shippingCity">City </label>
                                            <input type="text" name="shippingCity" id="shippingCity" placeholder="City" class="inputfield py-2 px-2 Input col-sm-12" required>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <label for="shippingPostalCode">Postal Code </label>
                                            <input type="text" name="shippingPostalCode" placeholder="Postal Code" id="shippingPostalCode" class="inputfield py-2 px-2 Input col-sm-12" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-12">

                                    <label for="shippingState">State </label>
                                    <input type="text" name="shippingState" placeholder="" id="shippingState" class="inputfield py-2 px-2 Input col-sm-12" required>

                                </div>
                                <div class="col-sm-12">

                                    <label for="shippingCountry">Country </label>
                                    <input type="text" name="shippingCountry" placeholder="" id="shippingCountry" class="inputfield py-2 px-2 Input col-sm-12" required>

                                </div>
                            </div>


                        </div>
                        <!-- <div class="col-sm-4 mb-2  ">


                        </div> -->
                        <div class="col-sm-6 px-4">
                            <div class="col-sm-12 mb-2">
                                <label for="billName">Name on card </label>
                                <input type="text" name="billName" id="billName" placeholder="" class="inputfield py-2 px-3 Input col-sm-12" required value="<?= (isset($_SESSION['name']) ? $_SESSION['name'] : "") ?>">
                            </div>
                            <input type="hidden" name="productId" id="productId" value="<?= $productData[0]['id'] ?>">
                            <div id="payment-element"></div>
                            <div id="card-element">
                            </div>
                            <button id="submit">

                                <div class="spinner hidden" id="spinner"></div>

                                <span id="button-text">Pay now</span>

                            </button>
                            <div id="payment-message" class="hidden"></div>
                        </div>
                    </form>
                </div>
            </div>
        <?php

        }
        ?>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script src="<?= BASE_URL ?>/app/assets/js/Checkout.js"></script>
    <script src="<?= BASE_URL ?>/app/assets/js/CheckoutFormTemplate.js"></script>
    <!-- <script src="js/testcase.js"></script> -->
</body>

</html>