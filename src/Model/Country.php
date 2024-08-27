<?php
namespace App\Model;

class Country
{
    public $name;
    public $population;
    public $capital;
    public $flag;

    public function __construct($name, $population, $capital, $flag)
    {
        $this->name = $name;
        $this->population = $population;
        $this->capital = $capital;
        $this->flag = $flag;
    }

    public function getCountryData()
    {
        return [
            'name' => $this->name,
            'population' => $this->population,
            'capital' => $this->capital,
            'flag' => $this->flag,
        ];
    }

    public function getCountryByCode($code)
    {
        // Assuming you have a way to retrieve the country by code
        // For this example, we'll just return the current country
        return [
            'name' => $this->name,
            'population' => $this->population,
            'capital' => $this->capital,
            'flag' => $this->flag,
        ];
    }

}