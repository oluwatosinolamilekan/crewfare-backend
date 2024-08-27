<?php

namespace App\Service;

class CountryService
{
    private $apiUrl = 'https://restcountries.com/v3.1/all';
    private $cacheFile = __DIR__ . '/../../cache/countries.json';
    private $cacheTime = 3600; // Cache for 1 hour

    public function fetchCountries()
    {
        if (file_exists($this->cacheFile) && (time() - filemtime($this->cacheFile) < $this->cacheTime)) {
            $response = file_get_contents($this->cacheFile);
        } else {
            $response = file_get_contents($this->apiUrl);
            file_put_contents($this->cacheFile, $response);
        }
        return json_decode($response, true);
    }
}