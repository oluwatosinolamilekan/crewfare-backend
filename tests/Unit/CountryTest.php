<?php
namespace Tests\Unit;

use App\Model\Country;
use PHPUnit\Framework\TestCase;

class  CountryTest extends TestCase
{
    public function testGetCountryData()
    {
        $model = new Country('United States', 331002651, 'Washington D.C.', 'https://flag.example.com');
        $data = $model->getCountryData();
        $this->assertIsArray($data);
        $this->assertGreaterThan(0, count($data));
    }

    public function testGetCountryByCode()
    {
        $model = new Country('United States', 331002651, 'Washington D.C.', 'https://flag.example.com');
        $country = $model->getCountryByCode('US');
        $this->assertIsArray($country);
        $this->assertEquals('United States', $country['name']);
    }
}