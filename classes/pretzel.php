<?php

class Pretzel
{
    //private $_type;         //String
    private $_wholeWheat;   //Boolean
    private $_toppings;     //String Array

    public function __construct($wholeWheat = "", $toppings = array())
    {
        $this->_wholeWheat = $wholeWheat;
        $this->_toppings = $toppings;
    }

    /**
     * @return mixed
     */
    public function getWholeWheat()
    {
        return $this->_wholeWheat;
    }

    /**
     * @param mixed $wholeWheat
     */
    public function setWholeWheat($wholeWheat)
    {
        $this->_wholeWheat = $wholeWheat;
    }

    /**
     * @return mixed
     */
    public function getToppings()
    {
        return $this->_toppings;
    }

    /**
     * @param mixed $toppings
     */
    public function setToppings($toppings)
    {
        $this->_toppings = $toppings;
    }

    /**
     * @return float
     */
    public function getCost()
    {
        $baseCost = 1.00;
        if ($this->_wholeWheat == "Yes")
        {
            $baseCost = 2.00;
        }
        foreach ($this->_toppings as $top)
        {
            $baseCost += 0.25;
        }

        return $baseCost;
    }
}