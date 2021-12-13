<?php
session_start();

class SessionControl
{

    public static function checkSession()
    {
        return isset($_SESSION['sessionFlag']) ? true : false;
    }

    public static function createSession($userData)
    {
        foreach ($userData as $key => $val) {
            $_SESSION[$key] = $val;
        }

        $_SESSION['sessionFlag'] = true;
        return true;
    }

    public static function sessionDestroy()
    {
        unset($_SESSION['sessionFlag']);
        session_destroy();
    }
}
