<?php

/**
 * Class Customer
 * represents a Customer
 */
class Customer
{
    private $_fName;        // First name
    private $_lName;        // Last name
    private $_phone;        // Phone Number
    private $_addressNum;   // Address Number
    private $_street;       // Street lived on
    private $_cityCounty;   // City / County
    private $_state;        // State

    /**
     * Customer constructor.
     * @param string $fName First Name
     * @param string $lName Last Name
     * @param int $phone Phone #
     * @param int $addressNum Address #
     * @param string $street Street
     * @param string $cityCounty City or COunty
     * @param string $state State
     */
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
     * Gets First Name
     * @return mixed|string Returns First Name
     */
    public function getFName()
    {
        return $this->_fName;
    }

    /**
     * Sets First Name
     * @param mixed|string $fName New First Name
     */
    public function setFName($fName)
    {
        $this->_fName = $fName;
    }

    /**
     * Gets Last Name
     * @return mixed|string Returns Last Name
     */
    public function getLName()
    {
        return $this->_lName;
    }

    /**
     * Sets Last Name
     * @param mixed|string $lName New Last Name
     */
    public function setLName($lName)
    {
        $this->_lName = $lName;
    }

    /**
     * Gets Phone #
     * @return int|mixed Returns Phone #
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * Sets Phone #
     * @param int|mixed $phone New Phone #
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * Gets Address #
     * @return int|mixed Returns Address #
     */
    public function getAddressNum()
    {
        return $this->_addressNum;
    }

    /**
     * Sets Address #
     * @param int|mixed $addressNum New Address #
     */
    public function setAddressNum($addressNum)
    {
        $this->_addressNum = $addressNum;
    }

    /**
     * Gets Street
     * @return mixed|string Returns Street
     */
    public function getStreet()
    {
        return $this->_street;
    }

    /**
     * Sets Street
     * @param mixed|string $street New Street
     */
    public function setStreet($street)
    {
        $this->_street = $street;
    }

    /**
     * Gets City or County
     * @return mixed|string Returns City or County
     */
    public function getCityCounty()
    {
        return $this->_cityCounty;
    }

    /**
     * Sets City or County
     * @param mixed|string $cityCounty New City or County
     */
    public function setCityCounty($cityCounty)
    {
        $this->_cityCounty = $cityCounty;
    }

    /**
     * Gets State
     * @return mixed|string Returns State
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * Sets State
     * @param mixed|string $state New State
     */
    public function setState($state)
    {
        $this->_state = $state;
    }


}