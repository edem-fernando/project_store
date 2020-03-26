<?php

namespace ProjectStore;

use ProjectStore\CeoInterface;

class Ceo implements CeoInterface
{
    private $name;
    private $dateOfBirth;
    private $address = [];

    public function __construct($name,$dateOfBirth)
    {
        $this->setName($name);
        $this->setDateOfBirth($dateOfBirth);
    }
    private function setName($name)
    {
        if (!empty($name) && is_string($name)) {
            $this->name = $name;
        }
    }
    public function getName()
    {
        return $this->name;
    }
    private function setDateOfBirth($dateOfBirth) {
        $this->dateOfBirth = $dateOfBirth;
    }
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }
    public function setAddress($street,$number,$neighborhood)
    {
        $this->address["street"] = $street;
        $this->address["number"] = $number;
        $this->address["neighborhood"] = $neighborhood;
    }
    public function getAddress()
    {
        return $this->address;
    }
    public function showAddressCeo()
    {
        $message = "Localização: %s, Nº %s, bairro %s";
        vprintf($message,$this->getAddress());
    }
}