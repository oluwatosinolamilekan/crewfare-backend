<?php
namespace App\Controllers;

use Exception;
use App\Service\CountryService;


class CountryController extends Controller
{
    private $countryService;

    public function __construct()
    {
        $this->countryService = new CountryService();
    }


    public function welcome()
    {
        try {
            return json_encode(['message' => 'Welcome to Country Data App!']);
        } catch (Exception $e) {
            return $this->errorResource($e);
        }
    }


    public function getTopCountries()
    {
       try{
            $countries = $this->countryService->fetchCountries();

            $topCountries = $this->getTopCountriesData($countries);

            return json_encode($topCountries);
        }catch (Exception $e) {
            return $this->errorResource($e);
        }
    }


    public function getCountriesByRegion($region)
    {
       try{
            $countries = $this->countryService->fetchCountries();
            $region = strtolower(trim($region)); 
            $filteredCountries = array_filter($countries, function($country) use ($region) {
                return strtolower(trim($country['region'])) === $region;
            });

            if (empty($filteredCountries)) {
                return json_encode(['message' => 'Region not found']);
            }

            $topCountries = $this->getTopCountriesData($filteredCountries);

            return json_encode($topCountries);
        }catch (Exception $e) {
            return $this->errorResource($e);
        }
    }

    private function getTopCountriesData($countries)
    {
        usort($countries, function($a, $b) {
            return $b['population'] <=> $a['population'];
        });

        $topCountries = array_slice($countries, 0, 10);

        return array_map(function($country) {
            return [
                'name' => $country['name']['common'],
                'population' => $country['population'],
                'capital' => $country['capital'][0] ?? 'N/A',
                'flag' => $country['flags']['png']
            ];
        }, $topCountries);
    }
}