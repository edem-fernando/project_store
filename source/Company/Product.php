<?php

namespace Source\Company;

use Source\Interfaces\Produce;
use Source\Interfaces\Manufacturered;

class Product implements Produce
{
    private $description;
    private $price;
    private $manufacturer;

    public function __construct($description,$price,$manufacturer)
    {
        $this->setDescription($description);
        $this->setPrice($price);
        $this->setManufacturer($manufacturer);
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    private function setDescription($description)
    {
        if (!empty($description) && is_string($description)) {
            $this->description = $description;
        }
    }

    private function setPrice($price)
    {
        if (is_numeric($price) && $price > 0) {
            $this->price = $price;
        }
    }

    private function setManufacturer(Manufacturered $manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    public function showNameManufactured()
    {
        return $this->getManufacturer()->getName();
    }

    public function showFormatPrice()
    {
        return number_format($this->getPrice(),"2",",",".");
    }
}