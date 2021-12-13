<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <!-- <script src="ordersuccess.js"></script> -->
</head>

<body>
    <div class="container">
        <div class="row py-5 ">
            <div class="col-sm-5 offset-3">
                <div class=" card p-2 text-center">
                    <h3> Payment Status</h3>
                    <div id="payment-message" class=""><?= (!empty($data['status'])) ? "Payment " . $data['status'] : ""; ?></div>
                    <span class="py-3"> <a href="<?= BASE_URL ?>/dashboard">Continue Shopping</a></span>
                </div>
            </div>
        </div>
    </div>


</body>

</html>