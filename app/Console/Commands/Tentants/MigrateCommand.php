<?php

namespace App\Console\Commands\Tentants;

use App\Facade\Tenant as FacadeTenant;
use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'migrate db for each tenant';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tenants=Tenant::get();
        foreach($tenants as $tenant){
            // TenantService::SwitchToTenant($tenant);
            FacadeTenant::SwitchToTenant($tenant);
            $this->info('start migrate : '.$tenant->domain);
            $this->info('---------------------------------');
            Artisan::call('migrate:fresh --path=database/migrations/tenants --database=tenant');
            $this->info(Artisan::output());
            $this->info('---------------------------------');
            $this->info('start seeder : '.$tenant->domain);
            Artisan::call('db:seed --class=Database\Seeders\Tenants\UsersSeeder --database=tenant');
            $this->info('---------------------------------');

        }
        return Command::SUCCESS;
    }
}
