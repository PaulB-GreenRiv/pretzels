<?php

/**
 * Represents bite sized pretzels
 * Class PretzelBites
 */
class PretzelBites extends Pretzel
{
    private $_sauce;        //String, Dipping sauce
    private $_amount;       //Integer, Amount of pretzels

    /**
     * PretzelBites constructor.
     * @param string $wholeWheat Is it whole wheat?
     * @param array $toppings What toppings are wanted
     * @param string $sauce Dipping sauce wanted
     * @param int $amount Amount of bites requested
     */
    public function __construct($wholeWheat = "", $toppings = array(), $sauce = "", $amount = 0)
    {
        parent::__construct($wholeWheat, $toppings);
        $this->_sauce = $sauce;
        $this->_amount = $amount;
    }

    /**
     * Gets dipping sauce
     * @return mixed|string Returns dipping sauce
     */
    public function getSauce()
    {
        return $this->_sauce;
    }

    /**
     * Sets dipping sauce
     * @param mixed|string $sauce Dipping sauce wanted
     */
    public function setSauce($sauce)
    {
        $this->_sauce = $sauce;
    }

    /**
     * Gets the amount of bites
     * @return int|mixed Returns amount of bites
     */
    public function getAmount()
    {
        return $this->_amount;
    }

    /**
     * Sets the amount of bites
     * @param int|mixed $amount How many bites are wanted
     */
    public function setAmount($amount)
    {
        $this->_amount = $amount;
    }

    /**
     * Determines pretzel cost
     * @return float Calculates and returns pretzel cost
     */
    public function getCost()
    {
        $baseCost = 1.00;
        if (parent::getWholeWheat() == "Yes") {
            $baseCost += (0.25 * $this->_amount);
        } else {
            $baseCost += (0.20 * $this->_amount);
        }

        if (count(parent::getToppings()) > 0)
        {
            foreach (parent::getToppings() as $top) {
                $baseCost += 0.25;
            }
        }

        return number_format($baseCost, 2, '.', ',');
    }
}