<?php
namespace Tests\Feature;

use App\Service\Router;
use PHPUnit\Framework\TestCase;
use App\Controllers\CountryController;

class CountryApiTest extends TestCase
{
    private $router;

    public function setUp(): void
    {
        $routes = [
            'GET /countries' => [CountryController::class, 'getTopCountries'],
            'GET /countries?region={region}' => [CountryController::class, 'getCountriesByRegion'],
        ];
        $this->router = new Router($routes);
    }

    public function testGetTopTenCountriesApi()
    {
        $response = $this->router->dispatch('GET', '/countries');
        $this->assertJson($response);
        $this->assertCount(10, json_decode($response, true));
    }

    public function testGetCountriesByRegionApi()
    {
        $response = $this->router->dispatch('GET', '/countries?region=Europe');
        $this->assertJson($response);
        $this->assertGreaterThan(0, count(json_decode($response, true)));
    }
}