<?php

class OrderValidation
{
    public function __construct()
    {
    }

    public function validate($orderList)
    {
        // foreach ($orderList as $key => $listItem) {
        //     $orderList->key->score  = 0 + $this->validateEmailStructure($listItem->email);
        //     $orderList->key->score += $this->validateEmailDomain($listItem->email);
        // }
    }


    private function validateEmailStructure($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 1;
        }
        return 0;
    }

    private function validateEmailDomain($email)
    {
        $domain = explode("@", $email, 2);
        return checkdnsrr($domain[1]) ? 0 : 1;
    }
}
