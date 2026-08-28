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
    protected $description = 'Install and initialize the College Master Admin Panel package';

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
        $this->call('vendor:publish', [
            '--tag' => 'college-admin-config',
            '--force' => $this->option('force') ?? false,
        ]);

        // 2. Publish Static Assets (CSS, JS, Images, Vendor libraries)
        $this->info('2. Publishing Admin UI Assets (CSS, JS, Images)...');
        $this->call('vendor:publish', [
            '--tag' => 'college-admin-assets',
            '--force' => true,
        ]);

        // 3. Publish Spatie Permission migrations if not already published
        $this->info('3. Publishing Permission System migrations...');
        $this->call('vendor:publish', [
            '--provider' => 'Spatie\Permission\PermissionServiceProvider',
        ]);

        // 4. Run Migrations
        if ($this->confirm('Do you want to run the database migrations now?', true)) {
            $this->info('4. Running database migrations...');
            $this->call('migrate');
        }

        // 5. Seed default roles, permissions, and initial admin
        if ($this->confirm('Do you want to seed default roles, permissions, and admin user?', true)) {
            $this->info('5. Seeding default roles & permissions...');
            $this->call('db:seed', [
                '--class' => 'CollegeAdmin\\Database\\Seeders\\CollegeAdminSeeder',
            ]);
        }

        // 6. Clear route & view caches
        $this->info('6. Clearing caches...');
        $this->call('config:clear');
        $this->call('route:clear');
        $this->call('view:clear');

        $this->newLine();
        $this->info('🎉 College Master Admin Panel is ready for production!');
        $this->info('👉 Access the Admin Panel at: ' . url(config('college-admin.route.prefix', 'admin')));
        $this->info('Default Admin Credentials: admin@gmail.com / 123456');

        return Command::SUCCESS;
    }
}
