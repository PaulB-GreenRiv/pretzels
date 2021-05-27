<?php
// this is the controller for the pretzels project

// turn on error-reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);


// require autoload file
require_once ('vendor/autoload.php');
require_once ('model/data-layer.php');
require_once ('model/validation.php');
//require_once ('classes/pretzel.php');

//Start a session
session_start();

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

    $_SESSION['pretzel'] = new Pretzel();

    $userType = "";
    $userWheat = "";
    $userToppings = array("Nothing");
    $userStuffing = "";
    $userSauce = "";
    $userAmnt = "";

    // display the home page
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $userType = $_POST['pretzType'];
        $userStuffing = $_POST['stuffing'];
        $userSauce = $_POST['sauce'];
        $userAmnt = $_POST['amount'];

        // Validate Pretzel Type
        if (validateType($userType)) {
            $_SESSION['pretzel']->setType($userType);
            //$_SESSION['pretzType'] = $userType;
        }
        else {
            $f3->set('errors["pretzType"]', 'Please select a valid Type');
        }

        // Checks to see if toppings were chosen
        if (!empty($_POST['toppings'])) {
            $userToppings = $_POST['toppings'];
            $_SESSION['pretzel']->setToppings(implode(", ", $userToppings));
            //$_SESSION['toppings'] = implode(", ", $userToppings);
        }
        else {
            $userToppings = array("Nothing");
            $_SESSION['pretzel']->setToppings(implode(", ", $userToppings));
            //$_SESSION['toppings'] = "Nothing";
        }

        // Validate Stuffing, if user chose Stuffed
        if ($userType == "Stuffed") {
            if (validateStuffing($userStuffing)) {
                $_SESSION['pretzel']->setStuffing($userStuffing);
                //$_SESSION['stuffing'] = $userStuffing;
            }
            else {
                $f3->set('errors["pretzStuffing"]', 'Please select a valid Stuffing');
            }
        }

        // Validate Amount, if user chose Bitesize
        if ($userType == "Bitesize") {
            if (validateAmount($userAmnt)) {
                $_SESSION['pretzel']->setAmount($userAmnt);
                //$_SESSION['amount'] = $userAmnt;
            }
            else {
                $f3->set('errors["pretzAmnt"]', 'Please select a valid amount (1 or more)');
            }
        }

        $isWW = $_POST['isWholeWheat'];
        if ($isWW == "yesWholeWheat") {
            $userWheat = "Yes";
        } else {
            $userWheat = "No";
        }

        $_SESSION['pretzel']->setWholeWheat($userWheat);
        $_SESSION['pretzel']->setSauce($userSauce);
        //$_SESSION['isWholeWheat'] = $userWheat;
        //$_SESSION['sauce'] = $userSauce;

        // Continue if there are no errors
        if (empty($f3->get('errors'))) {
            header('location: summary');
        }
    }

    $f3->set('userType', $userType);
    $f3->set('types', getTypes());
    $f3->set('userWheat', $userWheat);
    $f3->set('userToppings', $userToppings);
    $f3->set('toppings', getToppings());
    $f3->set('userStuffing', $userStuffing);
    $f3->set('stuffings', getStuffings());
    $f3->set('userSauce', $userSauce);
    $f3->set('sauces', getSauces());
    $f3->set('userAmnt', $userAmnt);

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