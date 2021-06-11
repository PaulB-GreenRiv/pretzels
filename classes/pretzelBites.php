<?php

class PretzelBites extends Pretzel
{
    private $_sauce;        //String
    private $_amount;       //Integer

    public function __construct($wholeWheat = "", $toppings = array(), $sauce = "", $amount = 0)
    {
        parent::__construct($wholeWheat, $toppings);
        $this->_sauce = $sauce;
        $this->_amount = $amount;
    }

    /**
     * @return mixed|string
     */
    public function getSauce()
    {
        return $this->_sauce;
    }

    /**
     * @param mixed|string $sauce
     */
    public function setSauce($sauce)
    {
        $this->_sauce = $sauce;
    }

    /**
     * @return int|mixed
     */
    public function getAmount()
    {
        return $this->_amount;
    }

    /**
     * @param int|mixed $amount
     */
    public function setAmount($amount)
    {
        $this->_amount = $amount;
    }

    /**
     * @return float
     */
    public function getCost()
    {
        $baseCost = 1.00;
        if (parent::getWholeWheat() == "Yes")
        {
            $baseCost += (0.25 * $this->_amount);
        }
        else
        {
            $baseCost += (0.25 * $this->_amount);
        }

        foreach (parent::getToppings() as $top)
        {
            $baseCost += 0.25;
        }

        return $baseCost;
    }
}