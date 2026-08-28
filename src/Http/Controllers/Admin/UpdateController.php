<?php

namespace CollegeAdmin\Http\Controllers\Admin;

use CollegeAdmin\CollegeAdmin;
use CollegeAdmin\Http\Controllers\Controller;
use CollegeAdmin\Services\VersionChecker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class UpdateController extends Controller
{
    /**
     * Display the System & Package Update manager.
     */
    public function index()
    {
        $currentVersion = CollegeAdmin::version();
        $updateInfo = VersionChecker::check();
        
        $systemInfo = [
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'PHP CLI / Built-in',
            'database_driver' => config('database.default'),
            'app_environment' => app()->environment(),
            'app_debug' => config('app.debug') ? 'Enabled' : 'Disabled',
        ];

        return view('college-admin::admin.settings.updates', compact('currentVersion', 'updateInfo', 'systemInfo'));
    }

    /**
     * Force check for remote updates.
     */
    public function check()
    {
        VersionChecker::clearCache();
        $updateInfo = VersionChecker::check();

        if (!empty($updateInfo['has_update'])) {
            return back()->with('info', "A new version v{$updateInfo['latest_version']} is available!");
        }

        return back()->with('success', 'You are already running the latest version of College Master Admin (v' . CollegeAdmin::version() . ').');
    }

    /**
     * Execute one-click in-app package update.
     */
    public function runUpdate()
    {
        try {
            // Run college-admin:update command
            Artisan::call('college-admin:update');
            $output = Artisan::output();

            VersionChecker::clearCache();

            return back()->with('success', 'Admin Panel successfully synchronized and updated to the latest assets and database state!');
        } catch (\Throwable $e) {
            return back()->with('error', 'Update error: ' . $e->getMessage());
        }
    }
}
