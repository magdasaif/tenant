<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SystemMigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'migrate default db for system';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('---------------------------------');
            Artisan::call('migrate:fresh --path=database/migrations/system --database=system_db');
            $this->info(Artisan::output());
            $this->info('---------------------------------');
            $this->info('start seeder : ');
            Artisan::call('db:seed --database=system_db --class=Database\Seeders\System\TenantsSeeder');
            $this->info('---------------------------------');
        return Command::SUCCESS;
    }
}
