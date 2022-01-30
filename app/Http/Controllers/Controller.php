<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getArrayFromJsonFile($file)
    {
        if(file_exists($file)){
            $json = file_get_contents($file);
            $data = json_decode($json, true);
        } else {
            $data = [];
        }
        return $data;
    }
}
