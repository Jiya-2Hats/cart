<div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-light bg-light pt-2 ">
            <div class="container-fluid">
                <h1>Cart</h1>
                <div class=" col-sm-2 text-right">
                    <span class="px-3"><?= $_SESSION['name'] ?></span>
                    <a href="<?= BASE_URL ?>/login/logout">Logout</a>
                </div>
            </div>
        </nav>
    </div>


    <div class="container">

        <div class="row py-4">

            <?php
            $productData = $data['productData'];
            if (is_array($productData)) {
                foreach ($productData as $item) :
                    $i = 0; ?>

                    <div class="col-sm-3 py-5">
                        <form class="card productItem" method="POST" action="<?= BASE_URL ?>/checkout">
                            <img src="<?= BASE_URL ?>/app/assets/images/default_product1.png" alt="Product Image" style="width:100%">

                            <div class="px-2 pt-5">
                                <input type="hidden" name="productId" id="productId" value="<?= $item->id ?>">
                                <h3><?= $item->name ?></h1>
                                    <p class="price" id="amount"><?= $item->amount ?></p>
                                    <p><?= $item->description ?></p>
                                    <button class="pay-btn">Pay Now</button>
                            </div>
                        </form>
                    </div>
            <?php $i++;
                endforeach;
            } ?>
            <div id="payment-message" class="hidden"></div>


        </div>
    </div>
</div>
<script src="https://js.stripe.com/v3/"></script>