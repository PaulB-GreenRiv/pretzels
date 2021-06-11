<?php

class StuffedPretzel extends Pretzel
{
    private $_stuffing;     //String

    public function __construct($wholeWheat = "", $toppings = array(), $stuffing = "")
    {
        parent::__construct($wholeWheat, $toppings);
        $this->_stuffing = $stuffing;
    }

    /**
     * @return mixed|string
     */
    public function getStuffing()
    {
        return $this->_stuffing;
    }

    /**
     * @param mixed|string $stuffing
     */
    public function setStuffing($stuffing)
    {
        $this->_stuffing = $stuffing;
    }

    /**
     * @return float
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