<?php

session_start();
class SessionControl
{

    public static function checkSession()
    {
        return isset($_SESSION['sessionFlag']) ? true : false;
    }

    public static function createSession($email, $name)
    {
        if (!empty($email) && !empty($name)) {

            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
            $_SESSION['sessionFlag'] = true;
            return true;
        }
    }
}
