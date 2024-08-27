<?php


use App\Controllers\CountryController;

return [
    'GET /' => [CountryController::class, 'welcome'],
    'GET /countries' => [CountryController::class, 'getTopCountries'],
    'GET /countries/region/{region}' => [CountryController::class, 'getCountriesByRegion']
];