<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/app/assets/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/app/assets/css/style.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/app/assets/css/checkout.css" />

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-light bg-light pt-2 ">
                <div class="container-fluid">
                    <h1>Cart</h1>
                    <div class=" col-sm-2 text-right">
                        <span class="px-3"><i class="fa fa-user px-2"></i><?= $_SESSION['name'] ?></span>
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

</body>

</html>