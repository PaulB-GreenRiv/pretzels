<?php

class DataLayer
{
    function getTypes()
    {
        return array("Regular", "Stuffed", "Bitesize");
    }

    function getToppings()
    {
        return array("salt", "pepper", "cheese", "paprika", "anchovies");
    }

    function getStuffings()
    {
        return array("cheese", "tuna", "bacon");
    }

    function getSauces()
    {
        return array("cheese", "ketchup", "bbq");
    }

    function getStateShorts()
    {
        return array("AK", "AL", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "ID", "IL", "IN",
            "IO", "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY",
            "NC", "ND", "OH", "OK", "OR", "PA", "PR", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA",
            "WV", "WI", "WY");
    }
}

