<?php

namespace App;

class Convert
{
    protected $price;

    public function __construct($price)
    {
        $this->price = $price;
    }

    public function priceInUsd()
    {
        return round($this->price * 37.94, 2);
    }

    public function priceInGbp()
    {
        return round($this->price * 48.27, 2);
    }

    public function priceInCad()
    {
        return round($this->price * 28.41, 2);
    }
}
