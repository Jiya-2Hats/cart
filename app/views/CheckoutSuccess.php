<script src="https://js.stripe.com/v3/"></script>

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