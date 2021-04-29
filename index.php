<?php
// this is the controller for the pretzels project

// turn on error-reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require autoload file
require_once('vendor/autoload.php');

// :: invoke static method, -> invoke instance method
// instantiate Fat-Free
$f3 = Base::instance();

// define routes
// default route
$f3->route('GET /', function (){
    // display the home page
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /order', function (){
    // display the home page
    $view = new Template();
    echo $view->render('views/orderPage.html');
});

// run Fat-Free
$f3->run();