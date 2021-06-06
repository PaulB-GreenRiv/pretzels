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

        $userType = "";
        $userWheat = "";
        $userToppings = array("Nothing");
        $userStuffing = "";
        $userSauce = "";
        $userAmnt = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userType = $_POST['pretzType'];
            $userStuffing = $_POST['stuffing'];
            $userSauce = $_POST['sauce'];
            $userAmnt = $_POST['amount'];

            // Validate Pretzel Type
            if (Validation::validateType($userType)) {
                //$_SESSION['pretzType'] = $userType; - Nothing else is here
            }
            else {
                $this->_f3->set('errors["pretzType"]', 'Please select a valid Type');
            }

            // Checks to see if toppings were chosen
            if (!empty($_POST['toppings'])) {
                $userToppings = $_POST['toppings'];
                //$_SESSION['pretzel']->setToppings(implode(", ", $userToppings));
                //$_SESSION['toppings'] = implode(", ", $userToppings);
            }
            else {
                $userToppings = array("Nothing");
                //$_SESSION['pretzel']->setToppings(implode(", ", $userToppings));
                //$_SESSION['toppings'] = "Nothing";
            }

            // Validate Stuffing, if user chose Stuffed
            if ($userType == "Stuffed") {
                if (Validation::validateStuffing($userStuffing)) {
                    $userStuffing = $_POST['stuffing'];
                    //$_SESSION['pretzel']->setStuffing($userStuffing);
                    //$_SESSION['stuffing'] = $userStuffing;
                }
                else {
                    $this->_f3->set('errors["pretzStuffing"]', 'Please select a valid Stuffing');
                }
            }

            // Validate Amount, if user chose Bitesize
            if ($userType == "Bitesize") {
                if (Validation::validateAmount($userAmnt)) {
                    $userAmnt = $_POST['amount'];
                    //$_SESSION['pretzel']->setAmount($userAmnt);
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

            //$_SESSION['pretzel']->setWholeWheat($userWheat);
            //$_SESSION['pretzel']->setSauce($userSauce);
            //$_SESSION['isWholeWheat'] = $userWheat;
            //$_SESSION['sauce'] = $userSauce;

            // Continue if there are no errors
            if (empty($this->_f3->get('errors'))) {

                if ($userType == "Stuffed")
                {
                    $_SESSION['pretzel'] = new StuffedPretzel($userWheat, $userToppings, $userStuffing);
                }
                else if ($userType == "Bitesize")
                {
                    $_SESSION['pretzel'] = new PretzelBites($userWheat, $userToppings, $userSauce, $userAmnt);
                }
                else
                {
                    $_SESSION['pretzel'] = new Pretzel($userWheat, $userToppings);
                }

                header('location: custInfo');
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

    function custInfo()
    {
        $userFName = "";
        $userLName = "";
        $userPhone = 0;
        $userAddress = 0;
        $userStreet = "";
        $userCityCounty = "";
        $userState = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userFName = $_POST["firstName"];
            $userLName = $_POST["lastName"];
            $userPhone = $_POST["phone"];
            $userAddress = $_POST["address"];
            $userStreet = $_POST["street"];
            $userCityCounty = $_POST["cityCounty"];
            $userState = $_POST["state"];

            if (Validation::validateName($userFName)) {
                $userFName = $_POST["firstName"];
            } else {
                $this->_f3->set('errors["firstName"]', 'Please use a valid name (non-numeric, 2+ letters)');
            }

            if (Validation::validateName($userLName)) {
                $userLName = $_POST["lastName"];
            } else {
                $this->_f3->set('errors["lastName"]', 'Please use a valid name (non-numeric, 2+ letters)');
            }

            if (!(Validation::validatePhone($userPhone))) {
                $userPhone = $_POST["phone"];
            } else {
                $this->_f3->set('errors["phone"]', 'Please enter a valid phone number (style: ##########)');
            }

            // Continue if there are no errors
            if (empty($this->_f3->get('errors'))) {
                $_SESSION['customer'] = new Customer($userFName, $userLName, $userPhone, $userAddress, $userStreet, $userCityCounty, $userState);
                header('location: summary');
            }
        }

        $this->_f3->set('states', $GLOBALS['dataLayer']->getStateShorts());
        $this->_f3->set('userFName', $userFName);
        $this->_f3->set('userLName', $userLName);
        $this->_f3->set('userPhone', $userPhone);
        $this->_f3->set('userAddress', $userAddress);
        $this->_f3->set('userStreet', $userStreet);
        $this->_f3->set('userCityCounty', $userCityCounty);
        $this->_f3->set('userState', $userState);

        $view = new Template();
        echo $view->render('views/customerInfo.html');
    }

    function summary()
    {
        var_dump($_SESSION);
        // display the Summary page
        $view = new Template();
        echo $view->render('views/orderSummary.html');
    }

    function user()
    {
        // display the Profile page
        $view = new Template();
        echo $view->render('views/userProfile.html');
    }
}