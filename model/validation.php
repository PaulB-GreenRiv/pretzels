<?php

class Validation
{
    /* Pretzel Validation */
    // Type Validation
    static function validateType($type)
    {
        $validTypes = $GLOBALS['dataLayer']->getTypes();

        if (!in_array($type, $validTypes)) {
            return false;
        }
        return true;
    }

    // Stuffing Validation
    static function validateStuffing($stuffing)
    {
        $validStuffings = $GLOBALS['dataLayer']->getStuffings();

        if (!in_array($stuffing, $validStuffings)) {
            return false;
        }
        return true;
    }

    // Amount Validation
    static function validateAmount($amount)
    {
        $amount = (int)$amount;
        return (is_int($amount) && $amount >= 1);
    }

    /* Customer Validation */

    static function validateName($name)
    {
        return ctype_alpha($name);
    }

    static function validatePhone($phone)
    {
        return (is_int($phone) and ($phone > 1000000000 and $phone < 9999999999));
    }
}

