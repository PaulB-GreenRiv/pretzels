<?php

/**
 * Class Pretzel
 * This is the base pretzel class, just has whole wheat and toppings fields
 */
class Pretzel
{
    private $_wholeWheat;   //Boolean, is the pretzel whole wheat?
    private $_toppings;     //String Array, pretzel toppings

    /**
     * Pretzel constructor.
     * @param string $wholeWheat Is this a whole wheat pretzel?
     * @param array $toppings Toppings on the pretzel
     */
    public function __construct($wholeWheat = "", $toppings = array())
    {
        $this->_wholeWheat = $wholeWheat;
        $this->_toppings = $toppings;
    }

    /**
     * Returns whether or not the pretzel is whole wheat
     * @return mixed Is the pretzel whole wheat?
     */
    public function getWholeWheat()
    {
        return $this->_wholeWheat;
    }

    /**
     * Sets if the pretzel is whole wheat
     * @param mixed $wholeWheat do you want a whole wheat pretzel
     */
    public function setWholeWheat($wholeWheat)
    {
        $this->_wholeWheat = $wholeWheat;
    }

    /**
     * Gets toppings
     * @return mixed Toppings on the pretzel
     */
    public function getToppings()
    {
        if (empty($this->_toppings))
        {
            return array();
        }
        return $this->_toppings;
    }

    /**
     * Sets Toppings
     * @param mixed $toppings What toppings you want
     */
    public function setToppings($toppings)
    {
        $this->_toppings = $toppings;
    }

    /**
     * Determines pretzel cost
     * @return float Calculates and returns pretzel cost
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