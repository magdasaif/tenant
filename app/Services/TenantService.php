<?php

namespace App\Services;

use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\ValidationException;

class TenantService{

    private $tenant;
    private $domain;
    private $database;
    //===========================================================================================
    public function SwitchToTenant(Tenant $tenant){
        // dd($tenant);
        if(!$tenant instanceof Tenant){
            throw ValidationException::withMessages(['error'=>'not registered domain']);
        }

        $this->tenant=$tenant;
        $this->domain=$tenant->domain;
        $this->database=$tenant->database;

        DB::purge('sysytem_db');
        DB::purge('tenant');
        Config::set('database.connections.tenant.database',$tenant->database);
        DB::connection('tenant')->reconnect();
        DB::setDefaultConnection('tenant');
    }

    //===========================================================================================
    public function SwitchToDefault(){
        DB::purge('sysytem_db');
        DB::purge('tenant');
        DB::connection('sysytem_db')->reconnect();
        DB::setDefaultConnection('sysytem_db');
    }
    //===========================================================================================
    public function getTenant(){
        return $this->tenant;
    }
    //===========================================================================================
    public function getDomain(){
        return $this->domain;
    }
    //===========================================================================================
    public function getDatabase(){
        return $this->database;
    }
}