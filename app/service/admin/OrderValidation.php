<?php

class OrderValidation
{
    private $email;
    public function __construct()
    {
    }

    public function validate($orderList, $fraudMailList, $key)
    {
        foreach ($orderList as $key => $listItem) {
            $this->email =  $listItem['email'];
            $orderList[$key]['score'] = $this->validateEmailStructure() + $this->validateEmailDomain() + $this->fraudEmailValidation($fraudMailList) + $this->validateAddress($listItem['shipAddress'], $key);
        }
        return json_decode(json_encode($orderList));
    }

    private function validateEmailStructure()
    {
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) && preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $this->email)) {

            return 0;
        }
        return 25;
    }

    private function validateEmailDomain()
    {
        $domain = explode("@", $this->email);
        return checkdnsrr(array_pop($domain), "AAAA") ? 0 : 25;
    }

    private function fraudEmailValidation($fraudMailList)
    {

        return (array_search(strtolower($this->email), ($fraudMailList[0]))) ? 25 : 0;
    }

    private function validateAddress($shipAddress, $key)
    {

        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . str_replace(" ", "", $shipAddress) . '&key=AIzaSyANt2BsVQ42mBlAWjO0oF1-juiQu5gjAbc';
        $json = @file_get_contents($url);
        $data = json_decode($json);

        $status = $data->status;
        if ($status == "OK") {
            return 0;
        } else {
            return 25;
        }
    }
}
