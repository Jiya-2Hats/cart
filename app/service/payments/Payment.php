<?php

namespace Payment\Payment;

interface Payment
{
    public function createPaymentIntent($amount);
    public function getStatus();
}
