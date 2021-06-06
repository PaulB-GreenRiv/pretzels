<?php

class Customer
{
    private $_fName;
    private $_lName;
    private $_phone;
    private $_addressNum;
    private $_street;
    private $_cityCounty;
    private $_state;

    public function __construct($fName = "", $lName = "", $phone = 0, $addressNum = 0, $street = "",
                                $cityCounty = "", $state = "")
    {
        $this->_fName = $fName;
        $this->_lName = $lName;
        $this->_phone = $phone;
        $this->_addressNum = $addressNum;
        $this->_street = $street;
        $this->_cityCounty = $cityCounty;
        $this->_state = $state;
    }

    /**
     * @return mixed|string
     */
    public function getFName()
    {
        return $this->_fName;
    }

    /**
     * @param mixed|string $fName
     */
    public function setFName($fName)
    {
        $this->_fName = $fName;
    }

    /**
     * @return mixed|string
     */
    public function getLName()
    {
        return $this->_lName;
    }

    /**
     * @param mixed|string $lName
     */
    public function setLName($lName)
    {
        $this->_lName = $lName;
    }

    /**
     * @return int|mixed
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param int|mixed $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return int|mixed
     */
    public function getAddressNum()
    {
        return $this->_addressNum;
    }

    /**
     * @param int|mixed $addressNum
     */
    public function setAddressNum($addressNum)
    {
        $this->_addressNum = $addressNum;
    }

    /**
     * @return mixed|string
     */
    public function getStreet()
    {
        return $this->_street;
    }

    /**
     * @param mixed|string $street
     */
    public function setStreet($street)
    {
        $this->_street = $street;
    }

    /**
     * @return mixed|string
     */
    public function getCityCounty()
    {
        return $this->_cityCounty;
    }

    /**
     * @param mixed|string $cityCounty
     */
    public function setCityCounty($cityCounty)
    {
        $this->_cityCounty = $cityCounty;
    }

    /**
     * @return mixed|string
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param mixed|string $state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }


}