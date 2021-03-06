<?php

// Database configuration
require_once ($_SERVER['DOCUMENT_ROOT']."/../config.php");

class DataLayer
{
    // Add a field for the database object
    private $_dbh;

    // Define a constructor
    function __construct()
    {
        //Connect to the database
        try {
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            //echo "Connected to database!";
        }   //If the connection fails
        catch (PDOException $e) {
            echo $e->getMessage();
            die ("Golly Gee!");
        }
    }

    // Save Customer to Database
    function saveCustomer($customer)
    {
        //1. Define the query
        $sql = "INSERT INTO customertest(first_name, last_name, phone, address, street, city, state)
                VALUES (:first, :last, :phone, :address, :street, :city, :state)";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $statement->bindParam(':first', $_SESSION['customer']->getFName());
        $statement->bindParam(':last', $_SESSION['customer']->getLName());
        $statement->bindParam(':phone', $_SESSION['customer']->getPhone());
        $statement->bindParam(':address', $_SESSION['customer']->getAddressNum());
        $statement->bindParam(':street', $_SESSION['customer']->getStreet());
        $statement->bindParam(':city', $_SESSION['customer']->getCityCounty());
        $statement->bindParam(':state', $_SESSION['customer']->getState());

        //4. Execute the query
        $statement->execute();

        //5. Process the results (get ID)
        $id = $this->_dbh->LastInsertId();
        return $id;
    }

    // Save Order to Database
    function saveOrder($custID)
    {
        //1. Define the query
        $sql = "INSERT INTO ordertest(customer_id) 
                VALUES (:custid)";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $statement->bindParam(':custid', $custID);

        //4. Execute the query
        $statement->execute();

        //5. Process the results (get ID)
        $id = $this->_dbh->LastInsertId();
        return $id;
    }

    // Save Pretzel to Database
    function savePretzel($pretzel, $orderid)
    {
        //1. Define the query
        $sql = "";
        if ($_SESSION['pretzel'] instanceof StuffedPretzel) // If a Stuffed Pretzel was ordered
        {
            $sql = "INSERT INTO pretzeltest(order_id, is_whole_wheat, pretzel_type, toppings, stuffing) 
                    VALUES (:orderid, :wholewheat, :pretztype, :toppings, :stuffing)";
        } else if ($_SESSION['pretzel'] instanceof PretzelBites) {  // If Bitesize Pretzels were ordered
            $sql = "INSERT INTO pretzeltest(order_id, is_whole_wheat, pretzel_type, toppings, 
                        dipping_sauce, bites_amount) 
                    VALUES (:orderid, :wholewheat, :pretztype, :toppings, :sauce, :amount)";
        } else {   // Regular Pretzel order
            $sql = "INSERT INTO pretzeltest(order_id, is_whole_wheat, pretzel_type, toppings) 
                    VALUES (:orderid, :wholewheat, :pretztype, :toppings)";
        }

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $wholeWheat = $_SESSION['pretzel']->getWholeWheat();
        $toppings = implode(", ", $_SESSION['pretzel']->getToppings());

        // Binds Parameters of all pretzel orders
        $statement->bindParam(':orderid', $orderid);
        $statement->bindParam(':wholewheat', $wholeWheat);
        $statement->bindParam(':toppings', $toppings);

        // Binds Parameters from specific pretzel orders
        $pretzelType = "Regular";
        if ($_SESSION['pretzel'] instanceof StuffedPretzel) { // Stuffed fields
            $pretzelType = "Stuffed";
            $stuffing = $_SESSION['pretzel']->getStuffing();
            $statement->bindParam(':stuffing', $stuffing);
        } else if ($_SESSION['pretzel'] instanceof PretzelBites) { // Bites Fields
            $pretzelType = "Bitesize";
            $sauce = $_SESSION['pretzel']->getSauce();
            $amount = $_SESSION['pretzel']->getAmount();
            $statement->bindParam(':sauce', $sauce);
            $statement->bindParam(':amount', $amount);
        }
        $statement->bindParam(':pretztype', $pretzelType);

        //4. Execute the query
        $statement->execute();

        //5. Process the results (get ID)
        $id = $this->_dbh->LastInsertId();
        return $id;
    }

    // Grab pretzels based on order ID
    function getOrders($orderID)
    {
        //1. Define the query
        $sql = "SELECT * 
                FROM pretzeltest 
                WHERE (order_id = $orderID)";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Execute the query
        $statement->execute();

        //4. Return the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Grab orders based on first and name
    function getOrdersName($fName, $lName)
    {
        //1. Define the query
        $sql = "SELECT *
                FROM ordertest 
                INNER JOIN customertest ON ordertest.customer_id = customertest.customer_id
                INNER JOIN pretzeltest ON pretzeltest.order_id = ordertest.order_id
                WHERE (customertest.first_name = :fName && customertest.last_name = :lName)";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind Parameters
        $statement->bindParam(':fName', $fName, PDO::PARAM_STR);
        $statement->bindParam(':lName', $lName, PDO::PARAM_STR);

        //4. Execute the query
        $statement->execute();

        //5. Return the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getTypes() // Pretzel Types
    {
        return array("Regular", "Stuffed", "Bitesize");
    }

    function getToppings()  // Toppings
    {
        return array("Salt", "Pepper", "Parmesan Cheese", "Paprika", "Anchovies",
            "Cinnamon", "Poppy Seeds", "Sesame Seeds", "Dried Garlic", "Dried Onion",
            "Bacon");
    }

    function getStuffings() // Stuffings
    {
        return array("Cream Cheese", "Tuna", "Bacon", );
    }

    function getSauces()    // Dipping Sauces
    {
        return array("Yellow Mustard", "Honey Mustard", "Pizza Sauce", "Cheese", "Ketchup", "BBQ", "Caramel", "Icing");
    }

    function getStateShorts()   // States
    {
        return array("AK", "AL", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "ID", "IL", "IN",
            "IO", "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY",
            "NC", "ND", "OH", "OK", "OR", "PA", "PR", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA",
            "WV", "WI", "WY");
    }
}

