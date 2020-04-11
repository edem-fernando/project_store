<?php

namespace Source\Company;

use Source\Interfaces\CeoInterface;
use Source\Interfaces\Manufacturered;

class Manufacturer implements Manufacturered
{
    private $name;
    private $address = [];
    private $sector;
    private $ceo;

    public function __construct($name,$sector)
    {
        $this->setName($name);
        $this->setSector($sector);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getSector()
    {
        return $this->sector;
    }

    public function getCeo()
    {
        return $this->ceo;
    }

    private function setName($name)
    {
        if (!empty($name) && is_string($name)) {
            $this->name = $name;
        }
    }

    private function setSector($sector)
    {
        $this->sector = $sector;
    }

    public function setAddress($street, $number, $neighborhood)
    {
        $this->address["street"] = $street;
        $this->address["number"] = $number;
        $this->address["neighborhood"] = $neighborhood;
    }

    public function showAddress()
    {
        $message = "%s, Nº %s, bairro %s";
        vprintf($message,$this->getAddress());
    }

    public function setCeo(CeoInterface $ceo)
    {
        $this->ceo = $ceo;
    }

    public function showNameCeo()
    {
        return $this->getCeo()->getName();
    }
}
