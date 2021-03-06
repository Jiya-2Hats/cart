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
define('DB_USER', 'cart_user');
define('DB_PASSWORD', 'admin');
define('DB_NAME', 'cart');

define('PAYMENT_GATEWAY', 'Stripe');
define('PAYMENT_GATEWAY_JS', ['StripeCheckout.js', 'CheckoutFormTemplate.js']);

// Stripe configuration
define('PAYMENT_API_KEY', 'sk_test_51K444KSDyd8jioSTszLKklBta1Sz2sonZO6DCYU0Rr8f711Z4Mkxl5fzxppGmd8FWdCk5MBHilmKZSxbEg4hy7Tk00MMyxfPCK');
define('PAYMENT_PUBLISHABLE_KEY', 'pk_test_51K444KSDyd8jioSTlcaX9034Z1RFjSEBzMr42g2MR8JD19e2pXBOeXsbxlLY2631cdVRdnMUrG3xfZ6vzrENqbmx000jUbT4yx');



//Product Order
define('ORDER_SUCCESS_STATUS', 1);
define('ORDER_FAILURE_STATUS', 0);
define('ORDER_SUCCESS_MESSAGE', 'Order success');
define('ORDER_FAILURE_MESSAGE', 'Order Failed');
