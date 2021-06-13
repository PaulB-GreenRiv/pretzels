<?php
// this is the controller for the pretzels project

// turn on error-reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);


// require autoload file
require_once ('vendor/autoload.php');

//Start a session
session_start();

// :: invoke static method, -> invoke instance method
// instantiate Fat-Free
$f3 = Base::instance();
$con = new Controller($f3);
$dataLayer = new DataLayer();

// define routes
// default route
$f3->route('GET /', function (){
    $GLOBALS['con']->home();
});

// Home Page
$f3->route( 'GET|POST /home', function (){
    $GLOBALS['con']->home();
});

// Order Form
$f3->route('GET|POST /order', function ($f3){
    $GLOBALS['con']->order();
});

// Summary Page
$f3->route('GET|POST /summary', function (){
    $GLOBALS['con']->summary();
});

// Customer Form
$f3->route('GET|POST /custInfo', function (){
    $GLOBALS['con']->custInfo();
});

// Search Database By Page
$f3->route('GET|POST /searchBy', function (){
    $GLOBALS['con']->searchBy();
});

// User or Order Info Page
$f3->route('GET|POST /user', function (){
    $GLOBALS['con']->user();
});

// run Fat-Free
$f3->run();