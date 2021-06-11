<?php

/**
 * Represents a stuffed pretzel
 * Class StuffedPretzel
 */
class StuffedPretzel extends Pretzel
{
    private $_stuffing;     //String, Pretzel stuffing

    /**
     * StuffedPretzel constructor.
     * @param string $wholeWheat Is the pretzel whole wheat?
     * @param array $toppings Toppings on the pretzel
     * @param string $stuffing What stuffing is wanted
     */
    public function __construct($wholeWheat = "", $toppings = array(), $stuffing = "")
    {
        parent::__construct($wholeWheat, $toppings);
        $this->_stuffing = $stuffing;
    }

    /**
     * Gets stuffing
     * @return mixed|string Returns stuffing
     */
    public function getStuffing()
    {
        return $this->_stuffing;
    }

    /**
     * Sets stuffing
     * @param mixed|string $stuffing what stuffing do you want?
     */
    public function setStuffing($stuffing)
    {
        $this->_stuffing = $stuffing;
    }

    /**
     * Determines pretzel cost
     * @return float Calculates and returns pretzel cost
     */
    public function getCost()
    {
        $baseCost = 2.00;
        if (parent::getWholeWheat() == "Yes")
        {
            $baseCost = 3.00;
        }
        foreach (parent::getToppings() as $top)
        {
            $baseCost += 0.25;
        }

        return $baseCost;
    }
}