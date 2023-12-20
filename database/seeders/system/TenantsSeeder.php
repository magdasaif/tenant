<?php

namespace Database\Seeders\System;

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenants=[
            ['name'=>'tenant1','domain'=>'tenant1.localhost','database'=>'tenant_1'],
            ['name'=>'tenant2','domain'=>'tenant2.localhost','database'=>'tenant_2'],
            ['name'=>'tenant3','domain'=>'tenant3.localhost','database'=>'tenant_3'],
        ];
        Tenant::insert($tenants);
    }
}
