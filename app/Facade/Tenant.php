<?php
namespace App\Facade;

use Illuminate\Support\Facades\Facade;

class Tenant extends Facade{

    public static function getFacadeAccessor()
    {
        return 'Tenants';
    }
}