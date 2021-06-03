<?php

class Validation
{
    static function validateType($type)
    {
        $validTypes = $GLOBALS['dataLayer']->getTypes();

        if (!in_array($type, $validTypes)) {
            return false;
        }
        return true;
    }

    static function validateStuffing($stuffing)
    {
        $validStuffings = $GLOBALS['dataLayer']->getStuffings();

        if (!in_array($stuffing, $validStuffings)) {
            return false;
        }
        return true;
    }

    static function validateAmount($amount)
    {
        $amount = (int)$amount;
        return (is_int($amount) && $amount >= 1);
    }
}

