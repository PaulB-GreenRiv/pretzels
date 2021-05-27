<?php

class Pretzel
{
    private $_type;         //String
    private $_wholeWheat;   //Boolean
    private $_toppings;     //String Array
    private $_stuffing;     //String
    private $_sauce;        //String
    private $_amount;       //Integer

    public function __construct()
    {
        $this->_type = "";
        $this->_wholeWheat = false;
        $this->_toppings = array();
        $this->_stuffing = "";
        $this->_sauce = "";
        $this->_amount = 0;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->_type = $type;
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
     * @return string
     */
    public function getStuffing()
    {
        return $this->_stuffing;
    }

    /**
     * @param string $stuffing
     */
    public function setStuffing($stuffing)
    {
        $this->_stuffing = $stuffing;
    }

    /**
     * @return mixed
     */
    public function getSauce()
    {
        return $this->_sauce;
    }

    /**
     * @param mixed $sauce
     */
    public function setSauce($sauce)
    {
        $this->_sauce = $sauce;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->_amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->_amount = $amount;
    }


}