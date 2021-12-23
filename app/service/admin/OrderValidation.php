<?php

use SebastianBergmann\Environment\Console;

class OrderValidation implements Email
{
    private $email;
    public function __construct()
    {
    }

    public function validate($orderList, $fraudMailList, $key)
    {
        foreach ($orderList as $key => $listItem) {
            $this->email =  $listItem['email'];
            $violation['emailStructure'] = $this->validateEmailStructure();
            $violation['emailDomain']  =   $this->validateEmailDomain();
            $violation['fraudEmail']  =  $this->fraudEmailValidation($fraudMailList);
            $violation['invalidAddress'] = $this->validateAddress($listItem['shipAddress'], $key);

            $orderList[$key]['score'] = 0;
            foreach ($violation as $item) {
                $orderList[$key]['score'] += $item;
            }
            $orderList[$key]['violation'] = $violation;
        }
        return json_decode(json_encode($orderList));
    }

    public function validateEmailStructure()
    {
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) && preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $this->email)) {

            return 0;
        }
        return 25;
    }

    public function validateEmailDomain()
    {
        $domain = explode("@", $this->email);
        $domain = array_pop($domain);
        return checkdnsrr(trim($domain), "MX") ? 0 : 25;
    }

    public function fraudEmailValidation($fraudMailList)
    {
        return (array_search(strtolower($this->email), ($fraudMailList[0]))) ? 25 : 0;
    }

    public function validateAddress($address, $key)
    {


        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&key=' . trim($key->apiKey);

        $json = @file_get_contents($url);
        $data = json_decode($json);
        $status = $data->status;
        if ($status == "OK") {
            if ($data->results[0]->partial_match == true) {
                $partialAddress = similar_text($data->results[0]->formatted_address, $address, $perc);
                return $perc * 25 / 100;
            }

            return 0;
        } else {
            return 25;
        }
    }

    public function validateEmailAndAddresss($validateData, $fraudMailList, $key)
    {
        $this->email = $validateData['email'];
        $violation['emailStructure'] = $this->validateEmailStructure();
        $violation['emailDomain']  =   $this->validateEmailDomain();
        $violation['fraudEmail']  =  $this->fraudEmailValidation($fraudMailList);
        $violation['invalidAddress'] = $this->validateAddress($validateData['address'], $key);
        return $violation;
    }
}
