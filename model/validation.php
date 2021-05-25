<?php

function validateType($type)
{
    $validTypes = getTypes();

    if (!in_array($type, $validTypes)) {
        return false;
    }
    return true;
}

function validateStuffing($stuffing)
{
    $validStuffings = getStuffings();

    if (!in_array($stuffing, $validStuffings)) {
        return false;
    }
    return true;
}

function validateAmount($amount)
{
    return (is_int($amount) && $amount >= 1);
}