<?php

namespace CollegeAdmin\Console\Commands;

use Illuminate\Console\Command;

class InstallCollegeAdminPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'college-admin:install {--force : Overwrite existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install and initialize the College Master Admin Panel package in one step';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('====================================================');
        $this->info('  Installing College Master Admin Panel (v' . \CollegeAdmin\CollegeAdmin::VERSION . ')');
        $this->info('====================================================');

        // 1. Publish Configuration
        $this->info('1. Publishing package configuration...');
        $this->callSilent('vendor:publish', [
            '--tag' => 'college-admin-config',
            '--force' => $this->option('force') ?? false,
        ]);

        // 2. Publish Static Assets (CSS, JS, Images, Vendor libraries)
        $this->info('2. Publishing Admin UI Assets (CSS, JS, Images)...');
        $this->callSilent('vendor:publish', [
            '--tag' => 'college-admin-assets',
            '--force' => true,
        ]);

        // 3. Publish SweetAlert Assets
        $this->info('3. Publishing SweetAlert assets...');
        $this->callSilent('vendor:publish', [
            '--provider' => 'RealRashid\SweetAlert\SweetAlertServiceProvider',
        ]);

        // 4. Create Storage Symlink
        $this->info('4. Ensuring storage symlink exists...');
        try {
            $this->callSilent('storage:link');
        } catch (\Throwable $e) {
            // Already linked
        }

        // 5. Run Migrations
        $this->info('5. Running database migrations...');
        $this->call('migrate', ['--force' => true]);

        // 6. Seed default roles, permissions, and initial admin
        $this->info('6. Seeding default roles, permissions, admin user & banners...');
        $this->call('db:seed', [
            '--class' => 'CollegeAdmin\\Database\\Seeders\\CollegeAdminSeeder',
            '--force' => true,
        ]);

        // 7. Clear route & view caches
        $this->info('7. Clearing caches...');
        $this->callSilent('config:clear');
        $this->callSilent('route:clear');
        $this->callSilent('view:clear');

        $this->newLine();
        $this->info('====================================================');
        $this->info('🎉 College Master Admin Panel is ready!');
        $this->info('👉 Access URL: ' . url(config('college-admin.route.prefix', 'admin') . '/login'));
        $this->info('🔑 Default Credentials:');
        $this->info('   - Email:    admin@gmail.com');
        $this->info('   - Password: 123456');
        $this->info('====================================================');

        return Command::SUCCESS;
    }
}
