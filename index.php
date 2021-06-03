<?php
// this is the controller for the pretzels project

// turn on error-reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);


// require autoload file
require_once ('vendor/autoload.php');
//require_once ('model/data-layer.php');
//require_once ('model/validation.php');
//require_once ('classes/pretzel.php');

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

$f3->route( 'GET|POST /home', function (){
    $GLOBALS['con']->home();
});

$f3->route('GET|POST /order', function ($f3){
    $GLOBALS['con']->order();
});

$f3->route('GET|POST /summary', function (){
    $GLOBALS['con']->summary();
});

$f3->route('GET|POST /user', function (){
    $GLOBALS['con']->user();
});

// run Fat-Free
$f3->run();