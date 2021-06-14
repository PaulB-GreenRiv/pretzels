<?php

/**
 * Class Controller
 */
class Controller
{
    private $_f3; //router

    /**
     * Controller constructor.
     * @param $f3
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    /**
     * Home Page
     */
    function home()
    {
        //Display the home page
        $view = new Template();
        echo $view->render('views/home.html');
    }

    /**
     * Order Page
     */
    function order()
    {
        //Reinitialize session array
        $_SESSION = array();

        // Default variables
        $userType = "";
        $userWheat = "";
        $userToppings = array("Nothing");
        $userStuffing = "";
        $userSauce = "";
        $userAmnt = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Gets fields from Post
            $userType = $_POST['pretzType'];
            $userStuffing = $_POST['stuffing'];
            $userSauce = $_POST['sauce'];
            $userAmnt = $_POST['amount'];

            // Validate Pretzel Type
            if (Validation::validateType($userType)) {
            } else {
                $this->_f3->set('errors["pretzType"]', 'Please select a valid Type');
            }

            // Checks to see if toppings were chosen
            if (!empty($_POST['toppings'])) {
                $userToppings = $_POST['toppings'];
            } else {
                $userToppings = array("Nothing");
            }

            // Validate Stuffing, if user chose Stuffed
            if ($userType == "Stuffed") {
                if (Validation::validateStuffing($userStuffing)) {
                    $userStuffing = $_POST['stuffing'];
                } else {
                    $this->_f3->set('errors["pretzStuffing"]', 'Please select a valid Stuffing');
                }
            }

            // Validate Amount, if user chose Bitesize
            if ($userType == "Bitesize") {
                if (Validation::validateAmount($userAmnt)) {
                    $userAmnt = $_POST['amount'];
                } else {
                    $this->_f3->set('errors["pretzAmnt"]', 'Please select a valid amount (1 or more)');
                }
            }

            // Sets whole wheat field
            $isWW = $_POST['isWholeWheat'];
            if ($isWW == "yesWholeWheat") {
                $userWheat = "Y";
            } else {
                $userWheat = "N";
            }

            // Continue if there are no errors
            if (empty($this->_f3->get('errors'))) {

                // Sets pretzel type
                if ($userType == "Stuffed") {
                    $_SESSION['pretzel'] = new StuffedPretzel(
                        $userWheat, $userToppings, $userStuffing
                    );
                } else if ($userType == "Bitesize") {
                    $_SESSION['pretzel'] = new PretzelBites(
                        $userWheat, $userToppings, $userSauce, $userAmnt
                    );
                } else {
                    $_SESSION['pretzel'] = new Pretzel(
                        $userWheat, $userToppings
                    );
                }

                header('location: custInfo');
            }
        }

        // Set fields to hive
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

        // Display Order Page
        $view = new Template();
        echo $view->render('views/orderPage.html');
    }

    /**
     * Customer Info
     */
    function custInfo()
    {
        // Default variables
        $userFName = "";
        $userLName = "";
        $userPhone = 0;
        $userAddress = 0;
        $userStreet = "";
        $userCityCounty = "";
        $userState = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Set Post Variables
            $userFName = $_POST["firstName"];
            $userLName = $_POST["lastName"];
            $userPhone = $_POST["phone"];
            $userAddress = $_POST["address"];
            $userStreet = $_POST["street"];
            $userCityCounty = $_POST["cityCounty"];
            $userState = $_POST["state"];

            // Validate First Name
            if (Validation::validateName($userFName)) {
                $userFName = $_POST["firstName"];
            } else {
                $this->_f3->set('errors["firstName"]', 'Please use a valid name (non-numeric, 2+ letters)');
            }

            // Validate Last Name
            if (Validation::validateName($userLName)) {
                $userLName = $_POST["lastName"];
            } else {
                $this->_f3->set('errors["lastName"]', 'Please use a valid name (non-numeric, 2+ letters)');
            }

            // Validate Phone #
            if (Validation::validatePhone($userPhone)) {
                $userPhone = $_POST["phone"];
            } else {
                $this->_f3->set('errors["phone"]', 'Please enter a valid phone number (10 digits, style: ##########)');
            }

            // Validate Address #
            if (Validation::validateAddress($userAddress)) {
                $userAddress = $_POST["address"];
            } else {
                $this->_f3->set('errors["address"]', 'Please enter a valid address number, 
                or none at all (5 digits, style: #####)');
            }

            // Validate State
            if (Validation::validateState($userState)) {
                $userState = $_POST["state"];
            } else {
                $this->_f3->set('errors["state"]', 'Please select a valid state');
            }

            // Continue if there are no errors
            if (empty($this->_f3->get('errors'))) {
                $_SESSION['customer'] = new Customer(
                    $userFName, $userLName, $userPhone, $userAddress,
                    $userStreet, $userCityCounty, $userState
                );
                header('location: summary');
            }
        }

        // Set hive fields
        $this->_f3->set('states', $GLOBALS['dataLayer']->getStateShorts());
        $this->_f3->set('userFName', $userFName);
        $this->_f3->set('userLName', $userLName);
        $this->_f3->set('userPhone', $userPhone);
        $this->_f3->set('userAddress', $userAddress);
        $this->_f3->set('userStreet', $userStreet);
        $this->_f3->set('userCityCounty', $userCityCounty);
        $this->_f3->set('userState', $userState);

        // Display Customer Info Page
        $view = new Template();
        echo $view->render('views/customerInfo.html');
    }

    /**
     * Summary Page
     */
    function summary()
    {
        // Save User data to database
        $custID = $GLOBALS['dataLayer']->saveCustomer($_SESSION['customer']);

        // Save order data to database
        $ordID = $GLOBALS['dataLayer']->saveOrder($custID);

        // Save pretzel data to database
        $pretzID = $GLOBALS['dataLayer']->savePretzel($_SESSION['pretzel'], $ordID);

        // Sets ID and cost fields in the hive
        $this->_f3->set('pretzID', $ordID);
        $this->_f3->set('test', $pretzID);
        $this->_f3->set('pretzCost', $_SESSION['pretzel']->getCost());

        // display the Summary page
        $view = new Template();
        echo $view->render('views/orderSummary.html');
    }

    /**
     * Searching Database
     */
    function searchBy()
    {
        //Reinitialize session array
        $_SESSION = array();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sets variables to session depending on if the user searched by name or order
            if (sizeof($_POST) > 1) {
                $_SESSION['fName'] = $_POST['getDBFName'];
                $_SESSION['lName'] = $_POST['getDBLName'];
            } else {
                $_SESSION['orderNum'] = $_POST['getDBOrder'];
            }
            header('location: user');
        }

        // display the Summary page
        $view = new Template();
        echo $view->render('views/searchBy.html');
    }

    /**
     * User Page
     */
    function user()
    {
        // Default variables
        $userFName = "";
        $userLName = "";
        $ordNum = 0;
        $fullDetails = false;
        $result = array();

        if ($_SESSION['orderNum'] != NULL) {    // Search by Order Number
            $ordNum = $_SESSION['orderNum'];
            $result = $GLOBALS['dataLayer']->getOrders($ordNum);
        } else {                                // Search by name
            $userFName = $_SESSION['fName'];
            $userLName = $_SESSION['lName'];
            $result = $GLOBALS['dataLayer']->getOrdersName($userFName, $userLName);
            $fullDetails = true;
        }

        // Put result in hive
        $this->_f3->set('result', $result);

        if ($fullDetails) {
            // Sets User attributes if user searched by name
            $getID = $result[0]['order_id'];
            $getName = ($result[0]['first_name'] . " " . $result[0]['last_name']);
            $getAddress = ($result[0]['address'] . " "
                . $result[0]['street'] . ", (" . $result[0]['city'] . ", " . $result[0]['state'] . ")");

            // Set Hive attributes
            $this->_f3->set('fullDetails', true);
            $this->_f3->set('getID', $getID);
            $this->_f3->set('getName', $getName);
            $this->_f3->set('getAddress', $getAddress);
        }

        // display the Profile page
        $view = new Template();
        echo $view->render('views/userProfile.html');
    }
}