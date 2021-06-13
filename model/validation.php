<?php

class Validation
{
    /* Pretzel Validation */
    // Type Validation
    static function validateType($type)
    {
        $validTypes = $GLOBALS['dataLayer']->getTypes();
        // Is the type in the list of valid types?
        if (!in_array($type, $validTypes)) {
            return false;
        }
        return true;
    }

    // Stuffing Validation
    static function validateStuffing($stuffing)
    {
        $validStuffings = $GLOBALS['dataLayer']->getStuffings();
        // Is the selected stuffing in the list of valid stuffings?
        if (!in_array($stuffing, $validStuffings)) {
            return false;
        }
        return true;
    }

    // Amount Validation
    static function validateAmount($amount)
    {
        $amount = (int)$amount;
        // Is the amount greater than 0?
        return (is_int($amount) && $amount >= 1);
    }

    /* Customer Validation */
    static function validateName($name)
    {
        // Is the chosen name more than 2 letters and non-numeric?
        return ctype_alpha($name) && (strlen($name) >= 2);
    }

    static function validatePhone($phone)
    {
        // Is the phone number 10 digits?
        return strlen($phone) == 10;
    }
}
