<script src="https://js.stripe.com/v3/"></script>
<div class="container ">
    <?php if (!empty($data['productData'])) {
        $productData = $data['productData']; ?>
        <div class="row py-5 mt-5 px-5">
            <div class="col-sm-12 px-5">
                <div class="row">
                    <form class="col-sm-12" id="payment-form" name="payment-form">
                        <div class="row">

                            <div class="col-sm-4 px-4">
                                <div class="col-sm-12 card p-2 mb-2 py-3 text-center ">
                                    <div class="row px-5">
                                        <div class="col-sm-12"> <img src="<?= BASE_URL ?>/app/assets/images/default_product1.png" alt="Product Image" style="width:80%">
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="px-4 pt-3 ">
                                                <h4><?= $productData[0]['name'] ?> </h4>
                                                <p class="price" id="amount">Rs <?= $productData[0]['amount'] ?> </p>
                                                <span class="py-2 "> <a href="<?= BASE_URL ?>/dashboard">Continue Shopping</a></span>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 mb-2 ">
                                    <label for="billLine1">Address Line 1 </label>
                                    <input type="text" name="billLine1" id="billLine1" placeholder="Address" class="inputfield py-2 px-2 Input col-sm-12" required value="<?= (isset($_SESSION['address_line1']) ? $_SESSION['address_line1'] : "") ?>">
                                </div>

                                <div class="col-sm-12 mb-2 ">
                                    <label for="billLine2">Address Line 2 </label>
                                    <input type="text" name="billLine2" id="billLine2" placeholder="Landmark" class="inputfield py-2  px-2 Input col-sm-12" required value="<?= (isset($_SESSION['address_line2']) ? $_SESSION['address_line2'] : "") ?>">
                                </div>

                                <div class="col-sm-12 mb-2">
                                    <div class="row">
                                        <div class="col-sm-6  pr-1">
                                            <label for="billCity">City </label>
                                            <input type="text" name="billCity" id="billCity" placeholder="City" class="inputfield py-2 px-2 Input col-sm-12" required value="<?= (isset($_SESSION['city']) ? $_SESSION['city'] : "") ?>">
                                            <input type="hidden" name="billCountry" id="billCountry" placeholder="Country">
                                        </div>
                                        <div class="col-sm-6 ">
                                            <label for="billPostalCode">Postal Code </label>
                                            <input type="text" name="billPostalCode" placeholder="Postal Code" id="billPostalCode" class="inputfield py-2 px-2 Input col-sm-12" required value="<?= (isset($_SESSION['postal_code']) ? $_SESSION['postal_code'] : "") ?>">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-4 px-4">
                                <p>Shipping </p>
                                <div class="col-sm-12  mb-2 pb-1">

                                    <label for="shippingAddress">Shipping Address same as Billing Address </label>
                                    <input type="checkbox" name="shippingAddress" id="shippingAddress" class="">
                                </div>
                                <div class="col-sm-12 mt-2" id="">
                                    <label for="shipPhone">Phone Number </label>
                                    <div class="col-sm-12 mb-2 ">
                                        <input type="text" name="shipPhone" id="shipPhone" placeholder="Contact Number" class="inputfield py-2 px-2 Input col-sm-12" required value="<?= (isset($_SESSION['phone']) ? $_SESSION['phone'] : "") ?>">
                                    </div>
                                </div>

                                <div class="col-sm-12 mt-2" id="shippingAddressDiv">

                                    <div class="col-sm-12 mt-2" id="">
                                        <label for="shippingName">Name of the person </label>
                                        <div class="col-sm-12 mb-2 ">
                                            <input type="text" name="shippingName" id="shippingName" placeholder="Name of the person" class="inputfield py-2 px-2 Input col-sm-12" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 mt-2" id="shippingAddressDiv">
                                        <label for="shippingLine1"> Address Line 1</label>
                                        <div class="col-sm-12 mb-2 ">
                                            <input type="text" name="shippingLine1" id="shippingLine1" placeholder="Address" class="inputfield py-2  px-2 Input col-sm-12" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 mb-2 " id="shippingAddressDiv">
                                        <label for="shippingLine2"> Address Line 2 </label>
                                        <div class="col-sm-12  ">
                                            <input type="text" name="shippingLine2" id="shippingLine2" placeholder="Landmark" class="inputfield py-2  px-2 Input col-sm-12" required>
                                        </div>
                                    </div>


                                    <div class="col-sm-12 mb-2 ">
                                        <div class="row">
                                            <div class="col-sm-6 pr-1">
                                                <label for="shippingCity">City </label>
                                                <input type="text" name="shippingCity" id="shippingCity" placeholder="City" class="inputfield py-2 px-2 Input col-sm-12" required>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <label for="shippingPostalCode">Postal Code </label>
                                                <input type="text" name="shippingPostalCode" placeholder="Postal Code" id="shippingPostalCode" class="inputfield py-2 px-2 Input col-sm-12" required>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- <div class="col-sm-12 mb-2">

                                        <label for="shippingState">State </label>
                                        <input type="text" name="shippingState" placeholder="" id="shippingState" class="inputfield py-2 px-2 Input col-sm-12" required>

                                    </div> -->
                                    <div class="col-sm-12 ">
                                        <label for="shippingCountry">Country </label>
                                        <input type="text" name="shippingCountry" placeholder="" id="shippingCountry" class="inputfield py-2 px-2 Input col-sm-12" required>
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-4 px-4">
                                <div class="col-sm-12 mb-2">
                                    <label for="email">Email </label>
                                    <input type="email" name="email" id="email" class="inputfield py-2 px-2 Input col-sm-12" required value="<?= (isset($_SESSION['email']) ? $_SESSION['email'] : "") ?>">
                                </div>
                                <div class="col-sm-12 my-2">
                                    <label for="billName">Name on card </label>
                                    <input type="text" name="billName" id="billName" placeholder="" class="inputfield py-2 px-3 Input col-sm-12" required value="<?= (isset($_SESSION['name']) ? $_SESSION['name'] : "") ?>">
                                </div>

                                <input type="hidden" inputmode="numeric" name="productId" id="productId" value="<?= $productData[0]['id'] ?>">
                                <div id="payment-element"></div>
                                <div id="card-element">
                                </div>
                                <button id="submit">

                                    <div class="spinner hidden" id="spinner"></div>

                                    <span id="button-text">Pay now</span>

                                </button>
                                <div id="payment-message" class="hidden"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>

<script src="https://js.stripe.com/v3/"></script>