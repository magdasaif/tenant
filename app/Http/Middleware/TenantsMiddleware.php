<?php

namespace App\Http\Middleware;

use App\Facade\Tenant as FacadeTenant;
use Closure;
use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TenantsMiddleware
{
    //===========================================================================================
    public function handle(Request $request, Closure $next){
        // dd(DB::getDefaultConnection());
        $host=$request->getHost();
        $tenant=Tenant::where('domain',$host)->first();
        if(isset($tenant)){
            // TenantService::SwitchToTenant($tenant);
            FacadeTenant::SwitchToTenant($tenant);
        }else{
            throw ValidationException::withMessages(['error'=>'not registered domain']);
        }        
        return $next($request);
    }
    //===========================================================================================

}
