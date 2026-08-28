<?php

namespace CollegeAdmin\Console\Commands;

use CollegeAdmin\CollegeAdmin;
use CollegeAdmin\Services\VersionChecker;
use Illuminate\Console\Command;

class UpdateCollegeAdminPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'college-admin:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update assets, run migrations, and clear cache after updating the College Admin package';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('====================================================');
        $this->info('  Updating College Master Admin Panel to v' . CollegeAdmin::VERSION);
        $this->info('====================================================');

        // 1. Force re-publish fresh CSS/JS assets
        $this->info('1. Synchronizing Admin Assets (CSS, JS, Fonts, Images)...');
        $this->call('vendor:publish', [
            '--tag' => 'college-admin-assets',
            '--force' => true,
        ]);

        // 2. Run new migrations
        $this->info('2. Running any new database migrations...');
        $this->call('migrate', ['--force' => true]);

        // 3. Clear version checker cache and framework caches
        $this->info('3. Clearing system and view cache...');
        VersionChecker::clearCache();
        $this->call('view:clear');
        $this->call('route:clear');
        $this->call('config:clear');

        $this->newLine();
        $this->info('✅ College Admin Panel successfully updated to v' . CollegeAdmin::VERSION . '!');
        return Command::SUCCESS;
    }
}
