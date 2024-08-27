<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Controllers\CountryController;

class CountryControllerTest extends TestCase
{
    public function testWelcome()
    {
        $controller = new CountryController();
        $response = $controller->welcome();
        $this->assertJson($response);
        $this->assertEquals('Welcome to Country Data App!', json_decode($response, true)['message']);
    }

    public function testGetTopTenCountries()
    {
        $controller = new CountryController();
        $response = $controller->getTopCountries();
        $this->assertJson($response);
        $this->assertCount(10, json_decode($response, true));
    }

    public function testGetCountriesByRegion()
    {
        $controller = new CountryController();
        $response = $controller->getCountriesByRegion('Europe');
        $this->assertJson($response);
        $this->assertGreaterThan(0, count(json_decode($response, true)));
    }
}