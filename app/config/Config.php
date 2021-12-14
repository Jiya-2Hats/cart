<?php

//Application configuration
define('AppRoot', dirname(dirname(dirname(__FILE__))));
define('BaseURL', 'http://localhost/cart');
define('HeaderLocation', 'Location: ' . BaseURL);

//MVC Configuration
define('DefaultController', 'Login');
define('DefaultMethod', 'index');
define('DefaultParameters', []);

//Guest Login
define('GuestEmail', 'guest@gmail.com');
define('GuestName', 'Guest');

// Database configuration
define('DBHostname', 'localhost');
define('DBUser', 'root');
define('DBPassword', 'admin');
define('DBName', 'cart');

// Stripe configuration
define('StripeAPIKey', 'sk_test_51K444KSDyd8jioSTszLKklBta1Sz2sonZO6DCYU0Rr8f711Z4Mkxl5fzxppGmd8FWdCk5MBHilmKZSxbEg4hy7Tk00MMyxfPCK');
define('StripePublishableKey', 'pk_test_51K444KSDyd8jioSTlcaX9034Z1RFjSEBzMr42g2MR8JD19e2pXBOeXsbxlLY2631cdVRdnMUrG3xfZ6vzrENqbmx000jUbT4yx');
