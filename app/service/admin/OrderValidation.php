<?php

class OrderValidation
{
    private $email;
    public function __construct()
    {
    }

    public function validate($orderList, $fraudMailList)
    {
        foreach ($orderList as $key => $listItem) {
            $this->email =  $listItem['email'];
            $orderList[$key]['score'] = $this->validateEmailStructure() + $this->validateEmailDomain() + $this->fraudEmailValidation();
        }
        return json_decode(json_encode($orderList));
    }


    private function validateEmailStructure()
    {
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {

            return 0;
        }
        return 1;
    }

    private function validateEmailDomain()
    {

        $domain = explode("@", $this->email);
        // if (checkdnsrr(array_pop($domain), "AAAA")) {
        //     echo "Valid Email<br/>";
        // } else {
        //     echo "Invalid Email<br/>";
        // }
        $domain = explode("@", $this->email);
        return checkdnsrr(array_pop($domain), "AAAA") ? 0 : 1;
    }

    private function fraudEmailValidation()
    {
        return 0;
    }
}
