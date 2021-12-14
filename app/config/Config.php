<?php

//Application configuration
define('APP_ROOT', dirname(dirname(dirname(__FILE__))));
define('BASE_URL', 'http://localhost/cart');
define('HEADER_LOCATION', 'Location: ' . BASE_URL);

//MVC Configuration
define('DEFAULT_CONTROLLER', 'Login');
define('DEFAULT_METHOD', 'index');
define('DEFAULT_PARAMETERS', []);

//Guest Login
define('GUEST_EMAIL', 'guest@gmail.com');
define('GUEST_NAME', 'Guest');

// Database configuration
define('DB_HOSTNAME', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'admin');
define('DB_NAME', 'cart');

// Stripe configuration
define('STRIPE_API_KEY', 'sk_test_51K444KSDyd8jioSTszLKklBta1Sz2sonZO6DCYU0Rr8f711Z4Mkxl5fzxppGmd8FWdCk5MBHilmKZSxbEg4hy7Tk00MMyxfPCK');
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51K444KSDyd8jioSTlcaX9034Z1RFjSEBzMr42g2MR8JD19e2pXBOeXsbxlLY2631cdVRdnMUrG3xfZ6vzrENqbmx000jUbT4yx');
