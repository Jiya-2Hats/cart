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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/app/assets/css/checkout.css" />

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-light bg-light pt-2 ">
                <div class="container-fluid">
                    <h1>Cart</h1>
                    <div class="d-flex col-sm-1">
                        <span class="px-3"><i class="fa fa-user px-2"></i><?= $_SESSION['name'] ?></span>
                        <a href="logout.php">Logout</a>

                    </div>
                </div>
            </nav>
        </div>


        <div class="container">

            <div class="row py-4">

                <?php
                // $result = new Product;
                // $result = $result->getProductList();
                $result = "";
                if (is_array($result)) {
                    foreach ($result as $item) :
                        $i = 0; ?>

                        <div class="col-sm-3 py-5">
                            <form class="card pdtitem" method="POST" action="checkout.php">
                                <img src="assets/default_product1.png" alt="Denim Jeans" style="width:100%">

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
    <!-- <script src="js/checkout.js"></script> -->
</body>

</html>