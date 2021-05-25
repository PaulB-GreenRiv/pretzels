<?php
// this is the controller for the pretzels project

// turn on error-reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

// require autoload file
require_once ('vendor/autoload.php');
require_once ('model/data-layer.php');
require_once ('model/validation.php');

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

$f3->route( 'GET|POST /home', function (){
    // display the home page
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /order', function ($f3){
    //Reinitialize session array
    $_SESSION = array();

    $userType = "";
    $userWheat = "";
    $userToppings = array();
    $userStuffing = "";
    $userSauce = "";
    $userAmnt = "";

    // display the home page
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $userType = $_POST['pretzType'];
        $userWheat = $_POST['isWholeWheat'];
        $userStuffing = $_POST['stuffing'];
        $userSauce = $_POST['sauce'];
        $userAmnt = $_POST['amount'];

        // Validate Pretzel Type
        if (validateType($userType)) {
            $_SESSION['pretzType'] = $userType;
        }
        else {
            $f3->set('errors["pretzType"]', 'Please select a valid Type');
        }

        // Checks to see if toppings were chosen
        if (empty($_POST['toppings'])) {
            $userToppings = $_POST['toppings'];
        }
        else {
            $userToppings = implode(", ", $_POST['toppings']);
        }

        // Validate Stuffing, if user chose Stuffed
        if ($userType == "Stuffed") {
            if (validateStuffing($userStuffing)) {
                $_SESSION['stuffing'] = $userStuffing;
            }
            else {
                $f3->set('errors["pretzStuffing"]', 'Please select a valid Stuffing');
            }
        }

        // Validate Amount, if user chose Bitesize
        if ($userType == "Bitesize") {
            if (validateAmount($userAmnt)) {
                $_SESSION['amount'] = $userAmnt;
            }
            else {
                $f3->set('errors["pretzAmnt"]', 'Please select a valid amount (1 or more)');
            }
        }

        $isWW = $_POST['isWholeWheat'];
        if ($isWW == "yesWholeWheat") {
            $_SESSION['isWholeWheat'] = "Yes";
        } else {
            $_SESSION['isWholeWheat'] = "No";
        }
        $_SESSION['toppings'] = $userToppings;
        $_SESSION['sauce'] = $_POST['sauce'];

        // Continue if there are no errors
        if (empty($f3->get('errors'))) {
            header('location: summary');
        }
    }

    $view = new Template();
    echo $view->render('views/orderPage.html');
});

$f3->route('GET|POST /summary', function (){
    // display the home page
    $view = new Template();
    echo $view->render('views/orderSummary.html');
});

$f3->route('GET|POST /user', function (){
    // display the home page
    $view = new Template();
    echo $view->render('views/userProfile.html');
});

// run Fat-Free
$f3->run();