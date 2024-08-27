<?php
namespace App\Controllers;

class Controller
{
    protected function errorResource($e)
    {
        return json_encode(['message' =>  $e->getMessage()]);
    }
}