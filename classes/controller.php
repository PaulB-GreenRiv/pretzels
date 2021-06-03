<?php

class Controller
{
    private $_f3; //router

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        //Display the home page
        $view = new Template();
        echo $view->render('views/home.html');
    }

    function order()
    {
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
            if (Validation::validateType($userType)) {
                $_SESSION['pretzel']->setType($userType);
                //$_SESSION['pretzType'] = $userType;
            }
            else {
                $this->_f3->set('errors["pretzType"]', 'Please select a valid Type');
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
                if (Validation::validateStuffing($userStuffing)) {
                    $_SESSION['pretzel']->setStuffing($userStuffing);
                    //$_SESSION['stuffing'] = $userStuffing;
                }
                else {
                    $this->_f3->set('errors["pretzStuffing"]', 'Please select a valid Stuffing');
                }
            }

            // Validate Amount, if user chose Bitesize
            if ($userType == "Bitesize") {
                if (Validation::validateAmount($userAmnt)) {
                    $_SESSION['pretzel']->setAmount($userAmnt);
                    //$_SESSION['amount'] = $userAmnt;
                }
                else {
                    $this->_f3->set('errors["pretzAmnt"]', 'Please select a valid amount (1 or more)');
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
            if (empty($this->_f3->get('errors'))) {
                header('location: summary');
            }
        }

        $this->_f3->set('userType', $userType);
        $this->_f3->set('types', $GLOBALS['dataLayer']->getTypes());
        $this->_f3->set('userWheat', $userWheat);
        $this->_f3->set('userToppings', $userToppings);
        $this->_f3->set('toppings', $GLOBALS['dataLayer']->getToppings());
        $this->_f3->set('userStuffing', $userStuffing);
        $this->_f3->set('stuffings', $GLOBALS['dataLayer']->getStuffings());
        $this->_f3->set('userSauce', $userSauce);
        $this->_f3->set('sauces', $GLOBALS['dataLayer']->getSauces());
        $this->_f3->set('userAmnt', $userAmnt);

        $view = new Template();
        echo $view->render('views/orderPage.html');
    }

    function summary()
    {
        // display the home page
        $view = new Template();
        echo $view->render('views/orderSummary.html');
    }

    function user()
    {
        // display the home page
        $view = new Template();
        echo $view->render('views/userProfile.html');
    }
}